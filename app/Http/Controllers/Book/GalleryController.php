<?php

namespace App\Http\Controllers\Book;
use App\Entity\Book\Gallery;
class GalleryController extends Controller{
    function gallery()
    {
        return view('gallery');
    }
}
