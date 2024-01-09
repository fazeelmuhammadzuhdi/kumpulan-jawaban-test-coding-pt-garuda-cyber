@extends('layouts.main')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <a href="{{ route('customers.create') }}" class="btn btn-primary fw-bold mb-4">Add Customer</a>
        <div class="card">
            <h5 class="card-header">Daftar Customer</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Customer</th>
                            <th>No Telepon</th>
                            <th>Alamat</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($customers as $customer)
                            <tr>
                                <td>{{ $loop->iteration + ($customers->currentPage() - 1) * $customers->perPage() }}.</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->address }}</td>
                                <td>
                                    <form method="POST" action="{{ route('customers.destroy', $customer->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-primary">
                                            <i class="bx bx-edit-alt"></i> Edit
                                        </a>
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
                        {{ $customers->links() }}
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
