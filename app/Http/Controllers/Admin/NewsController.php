<?php

namespace App\Http\Controllers\Admin;

use App\Entity\News;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\News\CreateRequest;
use App\Http\Requests\Admin\News\UpdateRequest;
use App\Services\Manage\NewsService;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    private $service;

    public function __construct(NewsService $service)
    {
        $this->middleware('can:manage-news');
        $this->service = $service;
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
            $news = $this->service->create($request);

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
            $news = $this->service->update($news->id, $request);

            return redirect()->route('admin.news.show', $news);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy(News $news)
    {
        $this->service->removeImage($news->id);
        $news->delete();

        return redirect()->route('admin.news.index');
    }

    public function removeImage(News $news)
    {
        if ($this->service->removeImage($news->id)) {
            return response()->json('The image is successfully deleted!');
        }
        return response()->json('The image is not deleted!', 400);
    }
}
