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
        <h5 class="card-title text-uppercase">UBAH DATA</h5><hr />
            @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                <p class="alert alert-danger alert-dismissible fade show" role="alert">{{ $error }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </p>
            @endforeach
            @endif

            @if (session()->has('message'))
                <p class="alert alert-success alert-dismissible fade show" role="alert">{{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </p>
            @endif

            <form method="POST" action="{{ route('material.update', $material->materialid) }}" class="form-horizontal form-material m-t-40 needs-validation" enctype="multipart/form-data">
                @csrf
                {{ method_field('PUT') }}
                
                {{-- <input type="hidden" name="kegid" id="kegid" value="{{ !is_null($kegiatan->kegid) ? $kegiatan->kegid : '' }}"> --}}

                <div class="form-group row">
                    <label for="nama" class="col-md-12 col-form-label text-md-left">{{ __('Nama *') }}</label>

                    <div class="col-md-12">
                        <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') ?? $material->nama }}" maxlength="100" required autocomplete="nama" autofocus>

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

                        <select id="category" class="custom-select form-control" name='category'>
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
                        <input id="stock" type="text" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ old('stock') ?? $material->stock }}" maxlength="100" required autocomplete="stock" autofocus>

                        @error('stock')
                            <span class="invalid-feedback" role="alert">
                                <p class="text-danger">{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-info waves-effect waves-light m-r-10">
                            {{ __('Simpan') }}
                        </button>
                        <a href="{{ route('material.index') }}" class="btn btn-primary waves-effect waves-light m-r-10">
                            {{ __('Index material') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var id = '';
    var parentid = '';
    var kode = '';
    $(document).ready(function() {
        $('.form-control-select').select2();
        // id = "{{-- $kegiatan->kegid --}}";
        // parentid = "{{-- $kegiatan->progid --}}";
        // kode = "{{-- $kegiatan->kegkode --}}";

        // $('#progid').select2().on('change', function() {
        //     if ($('#progid').val() == "") {
        //         $('#kegkode').val('');
        //     }
        //     else if ($('#progid').val() == parentid) {
        //         $('#kegkode').val(kode);
        //     }
        //     else {
        //         var url = "{{ route('kegiatan.nextno', ':parentid') }}"
        //         url = url.replace(':parentid', $('#progid').val());
        //         url = url.replace(':id', id);
        //         $.ajax({
        //             url:url,
        //             type:'GET',
        //             success:function(data) {
        //                 $('#kegkode').val(data);
        //             }
        //         });
        //     }
        // }).trigger('change');
    });
</script>
</script>
@endsection
