<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Entity\Book\Book;

class BookController extends Controller {

    public function index(Request $request) {
        $bookingList = Book::orderBy('id');
//                select(['books.*', 'us.*', 'pr.*'])
//                        ->leftJoin('users as us', 'books.user_id', '=', 'us.id')
//                        ->leftJoin('profiles as pr', 'pr.user_id', '=', 'us.id')
        return view('admin.books.index', compact('bookingList'));
    }

}
