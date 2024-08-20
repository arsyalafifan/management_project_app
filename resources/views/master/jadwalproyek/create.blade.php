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

            <form method="POST" action="{{ route('jadwalproyek.store') }}" class="form-horizontal form-material m-t-40 needs-validation" enctype="multipart/form-data">
                @csrf

                <div class="form-group row">
                    <label for="namaproyek" class="col-md-12 col-form-label text-md-left">{{ __('NamaProyek *') }}</label>

                    <div class="col-md-12">
                        <input id="namaproyek" type="text" class="form-control @error('namaproyek') is-invalid @enderror" name="namaproyek" value="{{ old('namaproyek') }}" maxlength="100" required autocomplete="namaproyek" autofocus>

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
                        <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ old('location') }}" maxlength="100" required autocomplete="location" autofocus>

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
                        <input id="startdate" type="date" class="form-control @error('startdate') is-invalid @enderror" name="startdate" value="{{ old('startdate') }}" required autocomplete="name">

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
                        <input id="finishdate" type="date" class="form-control @error('finishdate') is-invalid @enderror" name="finishdate" value="{{ old('finishdate') }}" required autocomplete="name">

                        @error('finishdate')
                            <span class="invalid-feedback" role="alert">
                                <p class="text-danger">{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                </div>

                {{-- <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="form-control-label text-right mr-2 mt-3" for="status">Status</label>
                            <input type="checkbox" id="status" name="status" value="1">
                        </div>
                    </div>
                </div> --}}

                <div class="form-group row mb-0">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-info waves-effect waves-light m-r-10">
                            {{ __('Simpan') }}
                        </button>
                        <a href="{{ route('jadwalproyek.index') }}" class="btn btn-primary waves-effect waves-light m-r-10">
                            {{ __('Kembali') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // $(document).ready(function() {
    //     $('.custom-select').select2();

    //     var url = "{{ route('kelas.nextno') }}";
    //     $.ajax({
    //         url: url,
    //         type: 'GET',
    //         success: function(data) {
    //             $('#nokelas').val(data);
    //         }
    //     });

        // $('#nokelas').on('focus', function() {
        //     if ($('#nokelas').val() == "") {
        //         $('#nokelas').val('');
        //     }
        //     else {
        //         var url = "{{ route('kelas.nextno') }}"
        //         // url = url.replace(':id', $('#nokelas').val());
        //         $.ajax({
        //             url:url,
        //             type:'GET',
        //             success:function(data) {
        //                 $('#nokelas').val(data);
        //             }
        //         });
        //     }
        // }).trigger('focus');
    });
</script>
@endsection
