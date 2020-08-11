<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Entity\Book\Book;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage-call-center');
    }
    
    public function index(Request $request)
    {
        $query = Book::select(['books.*', 'us.*', 'pr.*'])
                ->join('users as us', 'books.user_id', '=', 'us.id')
                ->join('profiles as pr', 'pr.user_id', '=', 'us.id')
                ->orderByDesc('books.created_at');

        if (!empty($value = $request->get('id'))) {
            $query->where('books.id', $value);
        }

        if (!empty($value = $request->get('full_name'))) {
            $query->where(function ($query) use ($value) {
                $query->where('first_name', 'ilike', '%' . $value . '%')
                        ->orWhere('last_name', 'ilike', '%' . $value . '%')
                        ->orWhere('middle_name', 'ilike', '%' . $value . '%');
            });
        }

        if (!empty($value = $request->get('booking_date'))) {
            $query->whereDate('books.booking_date', $value);
        }

        if (!empty($value = $request->get('time_start'))) {
            $query->whereRaw("TO_CHAR(books.time_start,'HH24:MI') = ?", $value);
        }

        if (!empty($value = $request->get('phone'))) {
            $query->where('users.phone', 'ilike', '%' . $value . '%');
        }

        if (!empty($value = $request->get('email'))) {
            $query->where('users.email', 'ilike', '%' . $value . '%');
        }
        $bookingList = $query->paginate(10);
        return view('admin.books.index', compact('bookingList','a'));
    }

    public function order_status($id,$order_status){
        $order=Book::find($id);
        $order->order_status=$order_status;
        $order->save();
        return redirect()->back()->with('success', 'Successfully changed');
    }

}
