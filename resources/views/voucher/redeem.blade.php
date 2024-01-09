@extends('layouts.main')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Voucher Reedem</h5>
                        <small class="text-muted float-end">Input Voucher Code</small>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('voucher.redeem') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Kode Voucher </label>
                                <div class="col-sm-10">
                                    <input type="text" name="code_voucher"
                                        class="form-control @error('code_voucher') is-invalid @enderror"
                                        id="basic-default-email" placeholder="Contoh : 6598c4xxx"
                                        value="{{ old('code_voucher') }}" />
                                    @error('code_voucher')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Reedem</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
