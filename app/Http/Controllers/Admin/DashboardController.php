<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Entity\Contacts;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:dashboard-panel');
    }

    public function index()
    {
        return view('admin.dashboard');
    }

    public function contactsList()
    {
        return view('admin.contact.index', ['lists' => Contacts::orderBy('created_at', 'desc')->get()
        ]);
    }

}
