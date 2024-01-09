@extends('layouts.main')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Add New Transaction</h5>
                        <small class="text-muted float-end">Input Information Transaction</small>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('invoices.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Customer</label>
                                <div class="col-sm-10">
                                    <select id="defaultSelect"
                                        class="form-select @error('customer_id') is-invalid @enderror" name="customer_id">
                                        <option value="" selected>Pilih Customer</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}"
                                                @if (old('customer_id') == $customer->id) selected @endif>{{ $customer->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('customer_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Nama Penyewa</label>
                                <div class="col-sm-10">
                                    <select id="defaultSelect" class="form-select @error('tenant_id') is-invalid @enderror"
                                        name="tenant_id">
                                        <option value="" selected> Nama Penyewa Mall </option>
                                        @foreach ($tenants as $tenant)
                                            <option value="{{ $tenant->id }}"
                                                @if (old('tenant_id') == $tenant->id) selected @endif>{{ $tenant->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('tenant_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Total Belanja</label>
                                <div class="col-sm-10">
                                    <input type="number" name="amount"
                                        class="form-control @error('amount') is-invalid @enderror" id="basic-default-email"
                                        placeholder="Contoh : 1000000" value="{{ old('amount') }}" />
                                    @error('amount')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
