@extends('layouts.main')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pages/</span> {{ $title }}</h4>

        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Upload Gambar</h5>
                        <small class="text-muted float-end">Input Information Tasks</small>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('tasks.update', $task->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="basic-default-name">Gambar Lama</label>
                                <div class="col-sm-9">
                                    <img src="{{ asset($task->gambar) }}" alt="No Image" width="100" class="img-fluid">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="basic-default-name">Upload Gambar Tugas
                                </label>
                                <div class="col-sm-9">
                                    <input type="file" name="gambar" class="form-control">
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary">Upload Gambar</button>
                                    <button type="button" class="btn btn-warning mx-2"  onclick="window.location.href='{{ route('tasks.index') }}'">Kembali</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
