@extends('layouts.main')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pages/</span> {{ $title }}</h4>

        <div class="card">
            <h5 class="card-header">Daftar Tugas {{ Auth::user()->name }}</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Tugas</th>
                            <th>Deskripsi Tugas</th>
                            <th>Status Tugas</th>
                            <th>Tandai Sebagai Selesai</th>
                            <th>Gambar</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($tasks as $task)
                            <tr>
                                <td>{{ $loop->iteration + ($tasks->currentPage() - 1) * $tasks->perPage() }}.</td>
                                <td>{{ $task->nama }}</td>
                                <td>{{ $task->deskripsi }}</td>
                                <td> {!! $task->status_teks !!}</td>
                                <td class="text-center">
                                    @if ($task->status === 0)
                                        <input type="checkbox" class="tandai-sebagai-selesai"
                                            data-task-id="{{ $task->id }}">
                                    @else
                                        <input type="checkbox" class="tandai-sebagai-selesai"
                                            data-task-id="{{ $task->id }}" checked disabled>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ asset($task->gambar) }}" target="_blank">
                                        @if ($task->gambar)
                                            <img src="{{ asset($task->gambar) }}" alt="Task Image" width="80"
                                                class="img-rounded img-fluid">
                                        @else
                                            <img src="{{ asset('assets/img/avatars/no-image.png') }}" alt="No Image"
                                                width="80" class="img-rounded img-fluid">
                                        @endif

                                    </a>
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('tasks.destroy', $task->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary">
                                            <i class="bx bx-edit-alt"></i> Upload Gambar
                                        </a>
                                        <button type="submit" class="btn btn-danger show_confirm"> <i
                                                class="bx bxs-trash-alt"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center fw-bold fs-5">
                                <td colspan="5">No Data</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
            <div class="container mt-3">
                <div class="row">
                    <div class="col-md-12">
                        {{ $tasks->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.8/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.tandai-sebagai-selesai').on('change', function() {
                var taskId = $(this).data('task-id');
                var status = this.checked ? 1 : 0; // Checkbox checked or not

                Swal.fire({
                    title: 'Anda Yakin ingin Menandai Tugas ini sebagai selesai?',
                    text: "Anda tidak dapat Mengubahnya lagi setelah ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Tandai Sebagai Selesai!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    location.reload();
                    if (result.isConfirmed) {
                        // Kirim permintaan ke server menggunakan AJAX

                        $.ajax({
                            url: '/tandai-sebagai-selesai/' + taskId,
                            type: 'POST',
                            data: {
                                _token: "{{ csrf_token() }}",
                                status: status
                            },
                            success: function(response, status) {
                                // Handle success, e.g., show a message
                                if (status == 200) {
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'success',
                                        title: response.text,
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then((response) => {
                                        location.reload();
                                    });
                                }
                            },
                            error: function(response, status) {
                                if (status == 400) {
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'error',
                                        title: response.text,
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then((response) => {
                                        response.reload();
                                    });
                                }
                            }
                        });
                    } else {
                        // Uncheck the checkbox if the user cancels the confirmation
                        $(this).prop('checked', !this.checked);
                    }
                });
            });
        });
        // $(document).ready(function() {
        //     $('.tandai-sebagai-selesai').on('change', function() {
        //         var taskId = $(this).data('task-id');
        //         var status = this.checked ? 1 : 0; // Checkbox checked or not

        //         if (confirm('Anda yakin ingin menandai tugas ini sebagai selesai?')) {
        //             // Send an AJAX request to update the task status
        //             $.ajax({
        //                 url: '/tandai-sebagai-selesai/' + taskId,
        //                 type: 'POST',
        //                 data: {
        //                     _token: "{{ csrf_token() }}",
        //                     status: status
        //                 },
        //                 success: function(response, status) {
        //                     // Handle success, e.g., show a message
        //                     if (status = '200') {
        //                         setTimeout(() => {
        //                             Swal.fire({
        //                                 position: 'center',
        //                                 icon: 'success',
        //                                 title: response.text,
        //                                 showConfirmButton: false,
        //                                 timer: 1500
        //                             }).then((response) => {
        //                                 location.reload();

        //                             })
        //                         });
        //                     }
        //                     // alert(response.message);
        //                     // location.reload();
        //                     // window.top.location = window.top.location
        //                 },
        //                 error: function(response, status) {
        //                     if (status = '400') {
        //                         setTimeout(() => {
        //                             Swal.fire({
        //                                 position: 'center',
        //                                 icon: 'danger',
        //                                 title: response.text,
        //                                 showConfirmButton: false,
        //                                 timer: 1500
        //                             }).then((response) => {
        //                                 location.reload();

        //                             })
        //                         });
        //                     }
        //                 }
        //             });
        //         } else {
        //             // Uncheck the checkbox if the user cancels the confirmation
        //             $(this).prop('checked', !this.checked);
        //         }
        //     });
        // });
    </script>

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
