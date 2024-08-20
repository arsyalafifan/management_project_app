<?php

$enumVar = new App\enumVar;

$listJabatanManpower = $enumVar->listJabatanManpower();
$listJabatanManpowerDesc = $enumVar->listJabatanManpower('desc');

?>
@extends('layouts.master')

@section('content')
<div class="card">
    <div class="card-body p-4">
        <h5 class="card-title text-uppercase">LIHAT DATA</h5><hr />
        <div class="form-group row mb-0 text-md-right">
            <div class="col-md-12">
                <a href="{{ route('manpower.create') }}" class="btn btn-info btn-sm waves-effect waves-light m-r-5"><i class="fa fa-plus-circle"></i> {{ __('Tambah') }}</a>
                <a href="{{ route('manpower.edit', $manpower->manpowerid) }}" class="btn btn-warning btn-sm waves-effect waves-light m-r-5"><i class="fa fa-plus-circle"></i> {{ __('Ubah') }}</a>
            </div>
        </div>

        <div class="form-group row">
            <label for="nama" class="col-md-12 col-form-label text-md-left">{{ __('Nama *') }}</label>

            <div class="col-md-12">
                <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ $manpower->nama }}" maxlength="100" disabled autocomplete="nama" autofocus>

                @error('nama')
                    <span class="invalid-feedback" role="alert">
                        <p class="text-danger">{{ $message }}</p>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="category" class="col-md-12 col-form-label text-md-left">{{ __('Category *') }}</label>

            <div class="col-md-12">

                <select id="category" class="custom-select form-control" name='category' disabled>
                    <option value="">-- Pilih Category --</option>
                    <option value="1" {{ '1' == $manpower->category ? 'selected' : '' }}>Indirect</option>
                    <option value="2" {{ '2' == $manpower->category ? 'selected' : '' }}>Direct</option>
                </select>

                @error('category')
                    <span class="invalid-feedback" role="alert">
                        <p class="text-danger">{{ $message }}</p>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="jabatan" class="col-md-12 col-form-label text-md-left">{{ __('Jabatan *') }}</label>

            <div class="col-md-12">

                <select id="jabatan" class="custom-select form-control" name='jabatan' disabled>
                    <option value="">-- Pilih Jabatan --</option>
                    @foreach ($listJabatanManpower as $id)
                        <option value="{{ $id }}" {{ $id == $manpower->jabatan ? 'selected' : '' }}>{{ $listJabatanManpowerDesc[$loop->index] }}</option>
                    @endforeach
                </select>

                @error('jabatan')
                    <span class="invalid-feedback" role="alert">
                        <p class="text-danger">{{ $message }}</p>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="tgljoin" class="col-md-12 col-form-label text-md-left">{{ __('Tanggal Join *') }}</label>

            <div class="col-md-12">
                <input id="tgljoin" type="date" class="form-control @error('tgljoin') is-invalid @enderror" name="tgljoin" value="{{ $manpower->tgljoin }}" disabled autocomplete="name">

                @error('tgljoin')
                    <span class="invalid-feedback" role="alert">
                        <p class="text-danger">{{ $message }}</p>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-md-12">
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="form-control-label text-right mr-2 mt-3" for="status">Status</label>
                    <input type="checkbox" id="status" name="status" value="1" {{ $manpower->status == 1 ? 'checked' : '' }} disabled>
                </div>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-12">
                <a href="{{ route('manpower.index') }}" class="btn btn-info waves-effect waves-light m-r-10">
                    {{ __('Index manpower') }}
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
    });
</script>
@endsection
