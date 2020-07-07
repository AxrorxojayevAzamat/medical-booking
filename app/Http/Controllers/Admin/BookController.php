<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Entity\Book\Book;

class BookController extends Controller {

    public function index(Request $request) {
        $query = Book::select(['books.*', 'us.*', 'pr.*'])
                ->join('users as us', 'books.user_id', '=', 'us.id')
                ->join('profiles as pr', 'pr.user_id', '=', 'us.id')
                ->orderByDesc('books.id')
        ;
        $bookingList = $query->paginate(10);
        return view('admin.books.index', compact('bookingList'));
    }

}
