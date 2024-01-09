<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voucher</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }

        .voucher-container {
            width: 500px;
            margin: 50px auto;
            padding: 20px;
            border: 2px solid #333;
            border-radius: 10px;
            background-color: #f9f9f9;
        }

        .voucher-header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .voucher-code {
            font-size: 18px;
            margin-bottom: 10px;
            color: #009688;
        }

        .voucher-expiration {
            font-size: 14px;
            color: #555;
        }
    </style>
</head>

<body>

    <div class="voucher-container">
        <div class="voucher-header">Selamat {{ $invoice->customer->name }} Kamu Mendapatkan Voucher Sebesar
            Rp. {{ number_format($invoice->voucher->voucher_value, 2) }}</div>
        <div class="voucher-code">Voucher Code: {{ $invoice->voucher->code_voucher }}</div>
        <div class="voucher-expiration">Expire Voucher On: {{ $invoice->voucher->expiry_date }}</div>
        <p><i>Catt : Silahkan Tukarkan Code Anda Dengan Membawa Voucher Ini Dan Juga Invoice Tempat Anda Berbelanja!</i>
        </p>
        {{-- <a href="{{ route('invoices.index') }}">
            Kembali Ke Halaman Invoice
        </a> --}}
    </div>

</body>

</html>

<script>
    window.print();
</script>
