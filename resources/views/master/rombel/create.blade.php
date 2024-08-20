<?php
use App\enumVar as enum;
?>
@extends('layouts.master')

@section('content')
<div class="card">
    <div class="card-body p-4">
        <h5 class="card-title text-uppercase">TAMBAH DATA</h5><hr />
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

            <form method="POST" action="{{ route('rombel.store') }}" class="form-horizontal form-material m-t-40 needs-validation" enctype="multipart/form-data">
                @csrf

                <div class="form-group row">
                    <label for="norombel" class="col-md-12 col-form-label text-md-left">{{ __('Nomor Rombel *') }}</label>

                    <div class="col-md-12">
                        <input id="norombel" type="text" class="form-control @error('norombel') is-invalid @enderror" name="norombel" value="{{ old('norombel') }}" maxlength="100" required autocomplete="norombel" autofocus>

                        @error('norombel')
                            <span class="invalid-feedback" role="alert">
                                <p class="text-danger">{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="namarombel" class="col-md-12 col-form-label text-md-left">{{ __('Nama Rombel *') }}</label>

                    <div class="col-md-12">
                        <input id="namarombel" type="text" class="form-control @error('namarombel') is-invalid @enderror" name="namarombel" value="{{ old('namarombel') }}" required autocomplete="name">

                        @error('namarombel')
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
                        <a href="{{ route('rombel.index') }}" class="btn btn-primary waves-effect waves-light m-r-10">
                            {{ __('Index Rombel') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.custom-select').select2();

        var url = "{{ route('rombel.nextno') }}";
        $.ajax({
            url: url,
            type: 'GET',
            success: function(data) {
                $('#norombel').val(data);
            }
        });

        // $('#norombel').on('focus', function() {
        //     if ($('#norombel').val() == "") {
        //         $('#norombel').val('');
        //     }
        //     else {
        //         var url = "{{ route('rombel.nextno') }}"
        //         // url = url.replace(':id', $('#norombel').val());
        //         $.ajax({
        //             url:url,
        //             type:'GET',
        //             success:function(data) {
        //                 $('#norombel').val(data);
        //             }
        //         });
        //     }
        // }).trigger('focus');
    });
</script>
@endsection
