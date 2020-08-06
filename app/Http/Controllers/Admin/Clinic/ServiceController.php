<?php


namespace App\Http\Controllers\Admin\Clinic;


use App\Entity\Clinic\Clinic;
use App\Entity\Clinic\Service;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Services\CreateRequest;
use App\Http\Requests\Admin\Services\UpdateRequest;
use App\Services\Manage\ClinicServicesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ServiceController extends Controller
{
    private $service;

    public function __construct(ClinicServicesService $service)
    {
        $this->middleware('can:dashboard-panel');
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $query = Service::orderByDesc('updated_at');

        if (!empty($value = $request->get('name'))) {
            $query->where(function ($query) use ($value) {
                $query->where('name_uz', 'ilike', '%' . $value . '%')
                    ->orWhere('name_ru', 'ilike', '%' . $value . '%');
            });
        }

        $services = $query->paginate(20);

        return view('admin.services.index', compact('services'));
    }

    public function create()
    {

        return view('admin.services.create');
    }

    public function store(CreateRequest $request)
    {
        try {
            $service = $this->service->create($request);

            return redirect()->route('admin.services.show', $service);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function show(Service $service)
    {
        return view('admin.services.show', compact('service'));
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(UpdateRequest $request, Service $service)
    {
        try {
            $service = $this->service->update($service->id, $request);

            return redirect()->route('admin.services.show', $service);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Service $service)
    {
        if (!Gate::allows('admin-panel')) {
            abort(403);
        }

        $this->service->removeImage($service->id);
        $service->delete();

        return redirect()->route('admin.services.index');
    }

    public function removeImage(Service $service)
    {
        if (!Gate::allows('admin-panel')) {
            abort(403);
        }

        if ($this->service->removeImage($service->id)) {
            return response()->json('The image is successfully deleted!');
        }
        return response()->json('The image is not deleted!', 400);
    }

    public function first(Clinic $clinic, Service $service)
    {
        try {
            $this->service->moveServiceToFirst($clinic->id, $service->id);
            return redirect()->to(route('admin.clinics.show', $clinic) . '#services');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function up(Clinic $clinic, Service $service)
    {
        try {
            $this->service->moveServiceUp($clinic->id, $service->id);
            return redirect()->to(route('admin.clinics.show', $clinic) . '#services');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function down(Clinic $clinic, Service $service)
    {
        try {
            $this->service->moveServiceDown($clinic->id, $service->id);
            return redirect()->to(route('admin.clinics.show', $clinic) . '#services');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function last(Clinic $clinic, Service $service)
    {
        try {
            $this->service->moveServiceToLast($clinic->id, $service->id);
            return redirect()->to(route('admin.clinics.show', $clinic) . '#services');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
