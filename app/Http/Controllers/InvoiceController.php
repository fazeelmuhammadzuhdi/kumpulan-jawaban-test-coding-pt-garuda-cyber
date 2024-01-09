<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\Invoice;
use App\Models\Voucher;
use App\Models\Customer;
use App\Http\Requests\InvoiceStoreRequest;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::paginate(10);
        return view('invoice.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        $tenants = Tenant::all();

        return view('invoice.create', compact('customers', 'tenants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InvoiceStoreRequest $request)
    {
        // create invoice number dengan uniq

        $date = now()->format('YmdHis');
        $data = $request->validated();
        $data['transaction_date'] = now();
        $data['invoice_number']  = $date . '' . rand(1111, 9999);
        // dd($data);
        $invoice = Invoice::create($data);

        // Distribute voucher jika tersedia
        $voucher = $this->distributeVoucher($invoice);

        if ($voucher) {
            flash()->success('Voucher Memenuhi Syarat Dan Berhasil Dibagikan');
            return redirect()->route('invoices.index');
        } else {
            flash()->addError('Voucher tidak memenuhi syarat');
            return redirect()->route('invoices.index');
        }
    }

    private function distributeVoucher(Invoice $invoice)
    {
        // Cek apakah customer sudah pernah mendapatkan voucher dan sudah memenuhi syarat
        $invoice = $invoice->fresh();
        $voucherDistributed = $invoice->voucherDistributed();
        if ($invoice->amount >= 1000000 && !$voucherDistributed) {
            $voucher = Voucher::create([
                'code_voucher' => uniqid(),
                'expiry_date' => now()->addMonth(3),
                'customer_id' => $invoice->customer_id,
                'invoice_id' => $invoice->id,
                'voucher_value' => 10000
            ]);
            // update bahwasannya voucher sudah dibagikan
            $invoice->update(['voucher_distributed' => true]);
            return $voucher;
        } else {
            return null;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        $invoice->load('customer', 'tenant', 'voucher');

        return view('invoice.show', compact('invoice'));
    }


    public function destroy(Invoice $invoice)
    {
        // cek apakah customer data yang mau dihapus sudah mempunyai coude_voucer, jika sudah punya maka data yang ada ditable voucher juga harus dihapus
        if ($invoice->voucher) {
            $invoice->voucher->delete();
            $invoice->delete();
        } else {
            $invoice->delete();
        }
        return back();
    }
}
