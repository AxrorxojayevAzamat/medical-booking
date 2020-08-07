<?php

namespace App\Http\Controllers\Admin\CallCenter;

use App\Entity\Clinic\Timetable;
use App\Http\Controllers\Controller;
use App\Entity\User\User;
use App\Entity\Region;
use App\Entity\Clinic\Clinic;
use App\Entity\Clinic\Specialization;
use App\Entity\Book\Book;
use App\Entity\Celebration;
use App\Services\BookService;
use App\Services\BookSmsService;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Services\Book\Paycom\PaycomService;
use App\Services\Book\Click\ClickService;

class CallCenterController extends Controller
{

    use SendsPasswordResetEmails;

    private $service;
    private $bookService;
    private $paycomService;
    private $clickService;

    public function __construct(BookService $service, BookSmsService $bookService, PaycomService $paycomService, ClickService $clickService)
    {
        $this->service = $service;
        $this->bookService = $bookService;
        $this->paycomService = $paycomService;
        $this->clickService = $clickService;
        $this->middleware('can:manage-call-center');
    }

    public function index(Request $request)
    {
        $query = User::select(['users.*', 'pr.*'])
                ->leftJoin('profiles as pr', 'users.id', '=', 'pr.user_id')
                ->where('users.role', User::ROLE_USER)
                ->orderByDesc('created_at');

        if (!empty($value = $request->get('id'))) {
            $query->where('id', $value);
        }

        if (!empty($value = $request->get('name'))) {
            $query->where(function ($query) use ($value) {
                $query->where('pr.first_name', 'ilike', '%' . $value . '%')
                        ->orWhere('pr.last_name', 'ilike', '%' . $value . '%');
            });
        }

        if (!empty($value = $request->get('phone'))) {
            $query->where('users.phone', 'ilike', '%' . $value . '%');
        }

        if (!empty($value = $request->get('email'))) {
            $query->where('users.email', 'ilike', '%' . $value . '%');
        }

        if (!empty($value = $request->get('role'))) {
            $query->where('users.role', $value);
        }

        if (!empty($value = $request->get('status'))) {
            $query->where('users.status', $value);
        }

        $users = $query->paginate(5);

        return view('admin.call-center.index', compact('users'));
    }

    public function create()
    {
        return view('admin.call-center.create-patient');
    }

    public function storePatient(Request $request)
    {
        $user = User::newGuest(
                        $request['email'],
                        $request['phone'],
                        $request['first_name'],
                        $request['last_name'],
                        $request['middle_name'],
                        $request['birth_date'],
                        $request['gender']
        );
        $this->sendResetLinkEmail($request);
        return redirect()->route('admin.call-center.index')->with('success', 'Письмо со ссылкой отправлено на почту ' . $request['email']);
        ;
    }

    public function doctors(User $user, Request $request)
    {
        $region_id = $request->get('region');
        $city_id = $request->get('city');
        $type_id = $request->get('type');
        $spec_id = $request->get('spec');

        $query = User::select(['users.*', 'pr.*'])
                ->leftJoin('profiles as pr', 'users.id', '=', 'pr.user_id')
                ->join('timetables as ts', 'users.id', '=', 'ts.doctor_id')
                ->join('doctor_clinics as dc', 'users.id', '=', 'dc.doctor_id')
                ->join('doctor_specializations as ds', 'users.id', '=', 'ds.doctor_id')
                ->leftJoin('clinics as cs', 'dc.clinic_id', '=', 'cs.id')
                ->where('role', User::ROLE_DOCTOR)
                ->groupBy(['users.id', 'pr.user_id'])
                ->orderByDesc('users.created_at');


        $regionList = Region::where('parent_id', null)->pluck('name_ru', 'id');
        $cityList = $this->service->findCityByRegion($region_id);

        $clinicTypeList = Clinic::clinicTypeList();
        $specList = Specialization::all()->pluck('name_ru', 'id');
        $clinicList = $this->service->findClinicByType($type_id, $city_id, $region_id);


        if (!empty($region_id)) {
            $children = Region::where('parent_id', $region_id)->pluck('id')->toArray();
            $query->whereIn('cs.region_id', $children);
        }
        if (!empty($city_id)) {
            $query->where('cs.region_id', $city_id);
        }
        if (!empty($type_id)) {
            $query->where('cs.type', $type_id);
        }

        if (!empty($value = $request->get('clinic'))) {
            $query->where('cs.id', $value);
        }

        if (!empty($spec_id)) {
            $query->where('ds.specialization_id', $spec_id);
        }

        if (!empty($value = $request->get('name'))) {
            $query->where(function ($query) use ($value) {
                $query->where('pr.first_name', 'ilike', '%' . $value . '%')
                        ->orWhere('pr.last_name', 'ilike', '%' . $value . '%');
            });
        }

        $doctors = $query->paginate(20);

        return view('admin.call-center.patient-doctor', compact('user', 'doctors', 'regionList', 'cityList', 'clinicTypeList', 'specList', 'clinicList'));
    }

    public function show(User $user, User $doctor)
    {
        $clinicsId = Timetable::where('doctor_id', $doctor->id)->pluck('clinic_id')->toArray();
        $clinics = Clinic::whereIn('id', $clinicsId)
                ->orderByDesc('id')
                ->get();

        $specs = $doctor->specializations;
        $doctorTimetables = Timetable::where('doctor_id', $doctor->id)
                ->whereIn('clinic_id', $clinicsId)
                ->orderByDesc('clinic_id')
                ->get();

        $celebrationDays = Celebration::orderByDesc('id')->get();

        $doctorBooks = Book::where('doctor_id', $doctor->id)
                ->whereIn('clinic_id', $clinicsId)
                ->orderByDesc('clinic_id')
                ->get();

        $holidays = $this->service->celebrationDays($celebrationDays);
        $price = config('book.booking_price');

        return view('admin.call-center.show-doctor', compact('user', 'doctor', 'clinics', 'specs', 'doctorTimetables', 'doctorBooks', 'holidays', 'price'));
    }

    public function bookingDoctor(Request $request)
    {
        $paymentType = $request['payment_type'];
        $userId = $request['user_id'];
        $doctorId = $request['doctor_id'];
        $clinicId = $request['clinic_id'];
        $bookingDate = $request['calendar'];
        $timeStart = $request['radio_time'];
        $description = $request['description'];
        $amount = $request['amount'];
        $user = User::find($userId);
        $link = null;


        if ($paymentType == Book::PAYME) {

            $order = $this->paycomService->createBookOrder($userId, $doctorId, $clinicId, $bookingDate, $timeStart, $amount, $description);
            $cipher = 'm=' . config('paycom_config.merchant_id') . ';a=' . $amount * 100 . ';l=ru;ac.' . config('paycom_config.account') . '=' . $order->id . ';c=' . config('app.url') . '/api/call-center/book/paycom';
            $link = config('paycom_config.endpoint_check') . '/' . base64_encode($cipher);
        } else if ($paymentType == Book::CLICK) {

            $order = $this->clickService->createOrder($userId, $doctorId, $clinicId, $bookingDate, $timeStart, $amount, $description);
            $cipher = 'service_id=' . config('click.service_id') . '&merchant_id=' . config('click.merchant_id') . '&amount=' . $amount . '&transaction_param=' . $order->merchant_transaction_id . '&return_url=' . config('app.url') . 'api/call-center/book/click';
            $link = config('click.endpoint_check') . '/' . $cipher;
        }
        $this->bookService->toMailPayment($user->email, 'Оплата', 'Для оплаты перейдите по ссылке', 'Оператор колл центра', $link);

        return redirect()->route('admin.books.index')->with('success', 'Письмо для оплаты со ссылкой отправлено на почту ' . $user->email);
    }

}
