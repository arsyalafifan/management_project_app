@extends('layouts.master')

@section('content')
<div class="card">
    <div class="card-body p-4">
        <h5 class="card-title text-uppercase">LIHAT DATA</h5><hr />
        <div class="form-group row mb-0 text-md-right">
            <div class="col-md-12">
                <a href="{{ route('jadwalproyek.create') }}" class="btn btn-info btn-sm waves-effect waves-light m-r-5"><i class="fa fa-plus-circle"></i> {{ __('Tambah') }}</a>
                <a href="{{ route('jadwalproyek.edit', $jadwalproyek->jadwalproyekid) }}" class="btn btn-warning btn-sm waves-effect waves-light m-r-5"><i class="fa fa-plus-circle"></i> {{ __('Ubah') }}</a>
            </div>
        </div>

        <div class="form-group row">
            <label for="nama" class="col-md-12 col-form-label text-md-left">{{ __('Nama Proyek *') }}</label>

            <div class="col-md-12">
                <input id="namaproyek" type="text" class="form-control @error('namaproyek') is-invalid @enderror" name="namaproyek" value="{{ $jadwalproyek->namaproyek }}" maxlength="100" disabled autocomplete="namaproyek" autofocus>

                @error('namaproyek')
                    <span class="invalid-feedback" role="alert">
                        <p class="text-danger">{{ $message }}</p>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="location" class="col-md-12 col-form-label text-md-left">{{ __('Location *') }}</label>

            <div class="col-md-12">
                <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ $jadwalproyek->location }}" maxlength="100" disabled autocomplete="location" autofocus>

                @error('location')
                    <span class="invalid-feedback" role="alert">
                        <p class="text-danger">{{ $message }}</p>
                    </span>
                @enderror
            </div>
        </div>


        <div class="form-group row">
            <label for="startdate" class="col-md-12 col-form-label text-md-left">{{ __('Start Date *') }}</label>

            <div class="col-md-12">
                <input id="startdate" type="date" class="form-control @error('startdate') is-invalid @enderror" name="startdate" value="{{ $jadwalproyek->startdate }}" disabled autocomplete="name">

                @error('startdate')
                    <span class="invalid-feedback" role="alert">
                        <p class="text-danger">{{ $message }}</p>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="finishdate" class="col-md-12 col-form-label text-md-left">{{ __('Finish Date *') }}</label>

            <div class="col-md-12">
                <input id="finishdate" type="date" class="form-control @error('finishdate') is-invalid @enderror" name="finishdate" value="{{ $jadwalproyek->finishdate }}" disabled autocomplete="name">

                @error('finishdate')
                    <span class="invalid-feedback" role="alert">
                        <p class="text-danger">{{ $message }}</p>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-12">
                <a href="{{ route('jadwalproyek.index') }}" class="btn btn-info waves-effect waves-light m-r-10">
                    {{ __('Index jadwalproyek') }}
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
