<?php

namespace App\Http\Controllers;

use App\Entity\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::published()->orderByDesc('updated_at');
        $news = $query->paginate(10);

        return view('news.index', compact('news'));
    }

    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }
}
