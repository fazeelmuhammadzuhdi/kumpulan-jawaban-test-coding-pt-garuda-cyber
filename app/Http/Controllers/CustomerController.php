<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerStoreRequest;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::paginate(10);
        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerStoreRequest $request)
    {
        try {
            $data = $request->validated();
            Customer::create($data);
            flash()->addSuccess('Data Customer Berhasil Di Tambahkan');
            return to_route('customers.index');
        } catch (\Throwable $e) {
            flash()->addError($e->getMessage());
            return to_route('customers.create');
        }
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerStoreRequest $request, Customer $customer)
    {
        try {
            $data = $request->validated();
            $customer->update($data);
            flash()->addSuccess('Data Berhasil Di Update');
            return to_route('customers.index');
        } catch (\Throwable $e) {
            flash()->addError($e->getMessage());
            return to_route('customers.create');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        try {
            $customer->delete();
            return back();
        } catch (\Throwable $e) {
            flash()->addError($e->getMessage());
            return back();
        }
    }
}
