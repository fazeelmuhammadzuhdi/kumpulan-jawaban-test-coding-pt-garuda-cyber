<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{

    public function voucher(Invoice $invoice)
    {
        $invoice->load('voucher', 'customer', 'tenant');

        // dd($invoice);
        return view('voucher.distributed', compact('invoice'));
    }

    public function create()
    {
        return view('voucher.redeem');
    }

    public function voucherRedeem(Request $request)
    {
        $validatedData = $request->validate(['code_voucher' => 'required']);
        $voucher = Voucher::where('code_voucher', $validatedData['code_voucher'])->first();
        // dd($voucher);
        if (!$voucher) {
            return redirect()->back()->with('error', 'Code Voucher Tidak Ditemukan!');
        }
        if ($voucher->redeemed) {
            return redirect()->back()->with('error', 'Code Voucher Sudah di Gunakan!');
        }
        if ($voucher->expiry_date < now()) {
            return redirect()->back()->with('error', 'Code Voucher Sudah Kadaluarsa!');
        }
        $voucher->update(['redeemed' => true]);
        return redirect()->back()->with('success', 'Voucher Berhasil di Gunakan!');
    }
}
