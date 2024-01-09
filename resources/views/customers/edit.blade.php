@extends('layouts.main')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Edit Customer &raquo; {{ $customer->name }}</h5>
                        <small class="text-muted float-end">Input Information Customer</small>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('customers.update', $customer) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Customer</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name"
                                        class="form-control @error('name', $customer->name) is-invalid @enderror"
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
                                <label class="col-sm-2 col-form-label" for="basic-default-name">No Telepon</label>
                                <div class="col-sm-10">
                                    <input type="text" name="phone"
                                        class="form-control @error('phone') is-invalid @enderror" id="basic-default-phone"
                                        placeholder="Contoh : 08xxxx" value="{{ old('phone', $customer->phone) }}"
                                        autofocus />
                                    @error('phone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" name="email"
                                        class="form-control @error('email') is-invalid @enderror" id="basic-default-email"
                                        placeholder="Contoh : Fazeel@gmail.com" value="{{ old('email', $customer->email) }}"
                                        autofocus />
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Address</label>
                                <div class="col-sm-10">
                                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="address" cols="30"
                                        rows="2"> {{ old('address', $customer->address) }}
                                    </textarea>
                                    @error('address')
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
