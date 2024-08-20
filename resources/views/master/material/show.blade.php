<?php
use App\enumVar as enum;
$enumVar = new App\enumVar;
$listCategoryMaterial = $enumVar->listCategoryMaterial();
$listCategoryMaterialDesc = $enumVar->listCategoryMaterial('desc');
?>
@extends('layouts.master')

@section('content')
<div class="card">
    <div class="card-body p-4">
        <h5 class="card-title text-uppercase">LIHAT DATA</h5><hr />
        <div class="form-group row mb-0 text-md-right">
            <div class="col-md-12">
                <a href="{{ route('material.create') }}" class="btn btn-info btn-sm waves-effect waves-light m-r-5"><i class="fa fa-plus-circle"></i> {{ __('Tambah') }}</a>
                <a href="{{ route('material.edit', $material->materialid) }}" class="btn btn-warning btn-sm waves-effect waves-light m-r-5"><i class="fa fa-plus-circle"></i> {{ __('Ubah') }}</a>
            </div>
        </div>

        <div class="form-group row">
            <label for="nama" class="col-md-12 col-form-label text-md-left">{{ __('Nama *') }}</label>

            <div class="col-md-12">
                <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') ?? $material->nama }}" maxlength="100" disabled autocomplete="nama" autofocus>

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
                    @foreach ($listCategoryMaterial as $id)
                        <option value="{{ $id }}" {{ $id == $material->category ? 'selected' : '' }}>{{ $listCategoryMaterialDesc[$loop->index] }}</option>
                    @endforeach
                </select>

                @error('category')
                    <span class="invalid-feedback" role="alert">
                        <p class="text-danger">{{ $message }}</p>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="stock" class="col-md-12 col-form-label text-md-left">{{ __('Stock *') }}</label>

            <div class="col-md-12">
                <input id="stock" type="text" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ old('stock') ?? $material->stock }}" maxlength="100" disabled autocomplete="stock" autofocus>

                @error('stock')
                    <span class="invalid-feedback" role="alert">
                        <p class="text-danger">{{ $message }}</p>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-12">
                <a href="{{ route('material.index') }}" class="btn btn-info waves-effect waves-light m-r-10">
                    {{ __('Index material') }}
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
