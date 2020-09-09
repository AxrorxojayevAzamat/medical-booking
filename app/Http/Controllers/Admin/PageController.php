<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity\Page;

class PageController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:manage-pages');
    }

    public function index()
    {
        $pages = Page::all();
        return view('pages.index', compact('pages'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'slug' => 'required',
            'title_uz' => 'required',
            'title_ru' => 'required',
            'content_uz' => 'required',
            'content_ru' => 'required'
        ]);


        $contacts = Page::create([
                    'slug' => $request->input('slug'),
                    'title_uz' => $request->input('title_uz'),
                    'title_ru' => $request->input('title_ru'),
                    'content_uz' => $request->input('content_uz'),
                    'content_ru' => $request->input('content_ru')
        ]);

        return redirect()->route('admin.pages.pages')->with('success', 'Успешно создан!');
    }

    public function create()
    {
        return view('pages.create');
    }

    public function view($id)
    {

        $page = Page::find($id);
        return view('pages.view', compact('page'));
    }

    public function edit($id)
    {
        $page = Page::find($id);
        return view('pages.edit', compact('page'));
    }

    public function editSave(Request $request)
    {

        $this->validate($request, [
            'slug' => 'required',
            'title_uz' => 'required',
            'title_ru' => 'required',
            'content_uz' => 'required',
            'content_ru' => 'required'
        ]);

        $page = Page::find($request->input('id'));
        $page->slug = $request->input('slug');
        $page->title_uz = $request->input('title_uz');
        $page->title_ru = $request->input('title_ru');
        $page->content_uz = $request->input('content_uz');
        $page->content_ru = $request->input('content_ru');
        $page->save();
        return redirect()->route('admin.pages.pages')->with('success', 'Успешно обновлено!');
    }

    public function slug($slug = null)
    {

        $page = Page::where('slug', $slug)->first();
        if ($page) {
            return view('pages.template', compact('page'));
        }

        return view('404');
    }

}
