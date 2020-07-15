<?php

namespace App\Http\Controllers\Admin;

use App\Entity;
use App\Entity\Partner;
use App\Http\Controllers\Controller;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::all();
        return view('admin.partners.index', compact('partners'));
    }
    
    public function create()
    {
        return view('admin.partners.create');
    }
}
