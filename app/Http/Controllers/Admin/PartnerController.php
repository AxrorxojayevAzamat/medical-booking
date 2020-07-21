<?php

namespace App\Http\Controllers\Admin;

use App\Entity;
use App\Entity\Partner;
use Illuminate\Http\Request;
use App\Services\PartnerService;
use App\Http\Controllers\Controller;
use App\Http\Requests\PartnerRequest;

class PartnerController extends Controller
{
    private $service;

    public function __construct(PartnerService $service)
    {
        $this->service = $service;
    }
    public function index()
    {
        $partners = Partner::all();
        return view('admin.partners.index', compact('partners'));
    }
    
    public function create()
    {
        $status = Partner::statusList();
        return view('admin.partners.create', compact('status'));
    }
    public function store(PartnerRequest $request)
    {
        $partner = $this->service->create($request);
        
        return redirect()->route('admin.partners.show', $partner);
    }
    public function show(Partner $partner)
    {
        $partner = Partner::findorFail($partner->id);
        $statuses= Partner::statusList();
        return view('admin.partners.show', compact('partner', 'statuses'));
    }
    public function edit(Partner $partner)
    {
        $partner = Partner::findorFail($partner->id);
        $statuses= Partner::statusList();
        return view('admin.partners.edit', compact('partner', 'statuses'));
    }
    public function update(PartnerRequest $request, Partner $partner)
    {
        try {
            $partner = $this->service->update($partner->id, $request);
            return redirect()->route('admin.partners.show', $partner)->with('success', 'Успешно!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    
    public function destroy(Partner $partner)
    {
        $partner = Partner::findorFail($partner->id);
        if ($partner->photo) {
            $photo = $this->service->deletePhotos($partner->id, $partner->photo);
            if ($photo==true) {
                $partner->delete();
            }
        }
        $partner->delete();
        
        return redirect()->route('admin.partners.index')->with('success', 'Удалено!');
    }
    public function deletePhoto(Partner $partner)
    {
        try {
            $this->service->removePhoto($partner->id);
            return response()->json('The main photo is successfully deleted!');
        } catch (\Exception $e) {
            return response()->json('The main photo is not deleted!', 400);
        }
    }

    public function first(Partner $partner)
    {
        try {
            $this->service->moveToFirst($partner->id);
            return redirect()->route('admin.partners.index');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function up(Partner $partner)
    {
        try {
            $this->service->moveUp($partner->id);
            return redirect()->route('admin.partners.show', $partner);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function down(Partner $partner)
    {
        try {
            $this->service->moveDown($partner->id);
            return redirect()->route('admin.partners.show', $partner);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function last(Partner $partner)
    {
        try {
            $this->service->moveToLast($partner->id);
            return redirect()->route('admin.partners.show', $partner);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
