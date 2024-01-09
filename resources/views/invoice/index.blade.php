@extends('layouts.main')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <a href="{{ route('invoices.create') }}" class="btn btn-primary fw-bold mb-4">Add Transaction</a>
        <div class="card">
            <h5 class="card-header">Daftar Transaction</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Invoice Number</th>
                            <th>Nama Penyewa Mall</th>
                            <th>Nama Customer</th>
                            <th>Total Belanja</th>
                            <th>Tanggal Transaksi</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($invoices as $invoice)
                            <tr>
                                <td>{{ $loop->iteration + ($invoices->currentPage() - 1) * $invoices->perPage() }}.</td>
                                <td>{{ $invoice->invoice_number }}</td>
                                <td>{{ $invoice->tenant->name }}</td>
                                <td>{{ $invoice->customer->name }}</td>
                                <td>Rp {{ number_format($invoice->amount, 2, ',', '.') }}</td>
                                <td>{{ $invoice->transaction_date }}</td>
                                <td>
                                    <form method="POST" action="{{ route('invoices.destroy', $invoice->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-dark">
                                            <i class="bx bx-eye"></i> Invoice
                                        </a>
                                        @if ($invoice->voucher_distributed == 1)
                                            <a href="{{ route('invoices.voucher', $invoice->id) }}" class="btn btn-primary"
                                                target="_blank">
                                                <i class="bx bx-eye"></i> Voucher Distribution
                                            </a>
                                        @else
                                            <button type="button" class="btn btn-warning">
                                                <i class="bx bx-eye"></i> No Voucher
                                            </button>
                                        @endif

                                        <button type="submit" class="btn btn-danger show_confirm"> <i
                                                class="bx bxs-trash-alt"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center fw-bold fs-5">
                                <td colspan="7">No Data</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
            <div class="container mt-3">
                <div class="row">
                    <div class="col-md-12">
                        {{ $invoices->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.8/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script type="text/javascript">
        $('.show_confirm').click(function(e) {
            var form = $(this).closest("form");
            e.preventDefault();
            Swal.fire({
                    title: 'Apakah Kamu Yakin?',
                    text: "Ingin Menghapus Data Ini ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Delete it!'
                })
                .then((willDelete) => {
                    if (willDelete.isConfirmed) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Data Berhasil Di Hapus',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        form.submit();
                    } else {
                        swal("Your imaginary file is safe!", {
                            icon: "info"
                        });
                    }
                })
        });
    </script>
@endsection
