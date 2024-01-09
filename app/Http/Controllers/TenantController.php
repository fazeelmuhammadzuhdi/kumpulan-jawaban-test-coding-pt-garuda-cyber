<?php

namespace App\Http\Controllers;

use App\Http\Requests\TenantStoreRequest;
use App\Models\Tenant;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tenants = Tenant::paginate(10);
        return view('tenants.index', compact('tenants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tenants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TenantStoreRequest $request)
    {
        try {
            $data = $request->validated();
            Tenant::create($data);
            flash()->addSuccess('Data Tenant Berhasil Di Tambahkan');
            return to_route('tenants.index');
        } catch (\Throwable $e) {
            flash()->addError($e->getMessage());
            return to_route('tenants.create');
        }
    }

    public function edit(Tenant $tenant)
    {
        return view('tenants.edit', compact('tenant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TenantStoreRequest $request, Tenant $tenant)
    {
        try {
            $data = $request->validated();
            $tenant->update($data);
            flash()->addSuccess('Data Berhasil Di Update');
            return to_route('tenants.index');
        } catch (\Throwable $e) {
            flash()->addError($e->getMessage());
            return to_route('tenants.create');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant)
    {
        try {
            $tenant->delete();
            return back();
        } catch (\Throwable $e) {
            flash()->addError($e->getMessage());
            return back();
        }
    }
}
