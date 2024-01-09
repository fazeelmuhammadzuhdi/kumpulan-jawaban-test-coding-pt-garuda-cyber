@extends('layouts.main')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Edit Tenant &raquo; {{ $tenant->name }}</h5>
                        <small class="text-muted float-end">Input Information Tenant</small>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('tenants.update', $tenant) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Penyewa</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name"
                                        class="form-control @error('name', $tenant->name) is-invalid @enderror"
                                        id="basic-default-name" placeholder="Contoh : Fazeel" value="{{ old('name') }}"
                                        autofocus />
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Usaha</label>
                                <div class="col-sm-10">
                                    <input type="text" name="business_name"
                                        class="form-control @error('business_name') is-invalid @enderror"
                                        id="basic-default-business_name" placeholder="Contoh : Clothing"
                                        value="{{ old('business_name', $tenant->business_name) }}" autofocus />
                                    @error('business_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-dark">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
