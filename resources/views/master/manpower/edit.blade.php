<?php
use App\enumVar as enum;
$enumVar = new App\enumVar;

$listJabatanManpower = $enumVar->listJabatanManpower();
$listJabatanManpowerDesc = $enumVar->listJabatanManpower('desc');
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

            <form method="POST" action="{{ route('manpower.update', $manpower->manpowerid) }}" class="form-horizontal form-material m-t-40 needs-validation" enctype="multipart/form-data">
                @csrf
                {{ method_field('PUT') }}
                
                {{-- <input type="hidden" name="kegid" id="kegid" value="{{ !is_null($kegiatan->kegid) ? $kegiatan->kegid : '' }}"> --}}

                <div class="form-group row">
                    <label for="nama" class="col-md-12 col-form-label text-md-left">{{ __('Nama *') }}</label>

                    <div class="col-md-12">
                        <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') ?? $manpower->nama }}" maxlength="100" required autocomplete="nama" autofocus>

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

                        <select id="jabatan" class="custom-select form-control" name='jabatan'>
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
                        <input id="tgljoin" type="date" class="form-control @error('tgljoin') is-invalid @enderror" name="tgljoin" value="{{ old('tgljoin') ?? $manpower->tgljoin }}" required autocomplete="name">

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
                            <input type="checkbox" id="status" name="status" value="1" {{ $manpower->status == 1 ? 'checked' : '' }}>
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-info waves-effect waves-light m-r-10">
                            {{ __('Simpan') }}
                        </button>
                        <a href="{{ route('manpower.index') }}" class="btn btn-primary waves-effect waves-light m-r-10">
                            {{ __('Index manpower') }}
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
        $('.custom-select').select2();
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
