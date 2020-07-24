<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;

use App\Entity\User\User;

class BookController extends Controller
{
    public function review(User $user)
    {
        return view('book.review');
    }
}
