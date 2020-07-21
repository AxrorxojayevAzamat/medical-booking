<?php

namespace App\Http\Controllers\Admin;

use App\Entity\News;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\News\CreateRequest;
use App\Http\Requests\Admin\News\UpdateRequest;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage-news');
    }

    public function index(Request $request)
    {
        $query = News::orderByDesc('updated_at');

        if (!empty($value = $request->get('title'))) {
            $query->where(function ($query) use ($value) {
                $query->where('title_uz', 'ilike', '%' . $value . '%')
                    ->orWhere('title_ru', 'ilike', '%' . $value . '%');
            });
        }

        if (!empty($value = $request->get('status'))) {
            $query->where('status', $value);
        }

        $news = $query->paginate(20);

        return view('admin.news.index', compact('news'));
    }

    public function create()
    {

        return view('admin.news.create');
    }

    public function store(CreateRequest $request)
    {
        try {
            $news = News::create([
                'title_uz' => $request->title_uz,
                'title_ru' => $request->title_ru,
                'menu_title_uz' => $request->menu_title_uz,
                'menu_title_ru' => $request->menu_title_ru,
                'description_uz' => $request->description_uz,
                'description_ru' => $request->description_ru,
                'content_uz' => $request->content_uz,
                'content_ru' => $request->content_ru,
                'status' => $request->status,
            ]);

            return redirect()->route('admin.news.show', $news);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function show(News $news)
    {
        return view('admin.news.show', compact('news'));
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(UpdateRequest $request, News $news)
    {
        try {
            $news->update([
                'title_uz' => $request->title_uz,
                'title_ru' => $request->title_ru,
                'menu_title_uz' => $request->menu_title_uz,
                'menu_title_ru' => $request->menu_title_ru,
                'description_uz' => $request->description_uz,
                'description_ru' => $request->description_ru,
                'content_uz' => $request->content_uz,
                'content_ru' => $request->content_ru,
                'status' => $request->status,
            ]);

            return redirect()->route('admin.news.show', $news);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy(News $news)
    {
        $news->delete();

        return redirect()->route('admin.news.index');
    }
}
