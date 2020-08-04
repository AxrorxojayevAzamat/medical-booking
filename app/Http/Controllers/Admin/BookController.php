<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use \App\Entity\Book\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage-call-center');
    }
    
    public function index(Request $request)
    {
        $search = $request->all();
        
        if (!empty($search)) {
            $query = Book::select(['books.*', 'us.*', 'pr.*'])
            ->join('users as us', 'books.user_id', '=', 'us.id')
            ->join('profiles as pr', 'pr.user_id', '=', 'us.id')
            ->orderBy('booking_date', 'asc');
        } else {
            $query = Book::select(['books.*', 'us.*', 'pr.*'])
            ->join('users as us', 'books.user_id', '=', 'us.id')
            ->join('profiles as pr', 'pr.user_id', '=', 'us.id')
            ->orderBy('booking_date', 'asc')
            ->whereDate('books.booking_date', '>=', Carbon::today());
        }

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
        $bookingList = $query->paginate(30);
        return view('admin.books.index', compact('bookingList'));
    }
}
