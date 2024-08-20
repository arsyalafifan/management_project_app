<?php
use App\enumVar as enum;
use App\Helpers\Get_field;

$enumVar = new App\enumVar;
$listBulan = $enumVar->listBulan();
$listBulanDesc = $enumVar->listBulan('desc');

$listMinggu = $enumVar->listMinggu();
$listMingguDesc = $enumVar->listMinggu('desc');

$listJenisPagu = $enumVar->listJenisPagu();
$listJenisPaguDesc = $enumVar->listJenisPagu('desc');

$listJenisKebutuhan = $enumVar->listJenisKebutuhan($id = '');

$listCategory = $enumVar->listCategory();
$listCategoryDesc = $enumVar->listCategory('desc');
?>
@extends('layouts.master')

@section('content')
<style>

    .imageThumb {
    max-height: 75px;
    border: 2px solid;
    padding: 1px;
    cursor: pointer;
    }
    .pip {
    display: inline-block;
    margin: 10px 10px 0 0;
    }
    .remove {
    display: block;
    background: #444;
    border: 1px solid black;
    color: white;
    text-align: center;
    cursor: pointer;
    }
    .remove:hover {
    background: white;
    color: black;
    }

    .param_img_holder {
    display: none;  
    }

    .param_img_holder img.img-fluid {
    width: 110px;
    height: 70px;
    margin-bottom: 10px;
    }

    .dataTables_filter {
        display: none;
    }

    div.dt-buttons {
        float: right;
    }

    /* #detail-laporan-table {
        display: none;
    } */
    .btn-view-pengajuan:hover{
        background-color: rgb(24, 106, 154);
    }
    .modal {
        overflow-y:auto;
    }

    /* tbody {
        display:block;
        height:80vh;
        overflow:auto;
    }
    thead, tbody tr {
        display:table;
        width:100%;
        table-layout:fixed;
    }
    thead {
        width: calc( 100% - 1em )
    } */
</style>
<div class="card">
    <div class="card-body p-4">
        <h5 class="card-title text-uppercase">DAFTAR PROJECT</h5>
        <hr />
        <form class="form-material">
            {{-- <div class="form-group row">
                <div class="col-md-6 ">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="perusahaanid" class="col-md-12 col-form-label text-md-left">{{ __('Perusahaan') }}</label>
                        </div>
                        <div class="col-md-9">
                            <select id="perusahaanid" class="col-md-12 custom-select form-control" name='perusahaanid' autofocus {{ $isPerusahaan ? 'disabled' : '' }}>
                                <option  value="{{ $isPerusahaan ? $userPerusahaan->perusahaanid : ''}}">{{ $isPerusahaan ? $userPerusahaan->nama : '-- Pilih Perusahaan --' }}</option>
                                @foreach ($perusahaan as $item)
                                    <option value="{{$item->perusahaanid}}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="kotaid" class="col-md-12 col-form-label text-md-left">{{ __('Kota/Kabupaten') }}</label>
                        </div>
                        <div class="col-md-9">
                            <select id="kotaid" class="col-md-12 custom-select form-control" name='kotaid' autofocus>
                                <option value="">-- Pilih Kota/Kabupaten --</option>
                                @foreach ($kota as $item)
                                    <option value="{{$item->kotaid}}">{{  $item->kodekota . ' ' . $item->namakota }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="jenjang" class="col-md-12 col-form-label text-md-left">{{ __('Jenjang') }}</label>
                        </div>
                        <div class="col-md-9">
                            <select id="jenjang" class="col-md-12 custom-select form-control" name='jenjang' autofocus>
                                <option value="">-- Pilih Jenjang --</option>
                                    <option value="{{enum::JENJANG_SMA}}">{{  enum::JENJANG_DESC_SMA }}</option>
                                    <option value="{{enum::JENJANG_SMK}}">{{  enum::JENJANG_DESC_SMK }}</option>
                                    <option value="{{enum::JENJANG_SLB}}">{{  enum::JENJANG_DESC_SLB }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="jenis" class="col-md-12 col-form-label text-md-left">{{ __('Jenis') }}</label>
                        </div>
                        <div class="col-md-9">
                            <select id="jenis" class="col-md-12 custom-select form-control" name='jenis' autofocus>
                                <option value="">-- Pilih Jenis --</option>
                                    <option value="{{enum::JENIS_NEGERI}}">{{  enum::JENIS_DESC_NEGERI }}</option>
                                    <option value="{{enum::JENIS_SWASTA}}">{{  enum::JENIS_DESC_SWASTA }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="sekolahid" class="col-md-12 col-form-label text-md-left">{{ __('Sekolah') }}</label>
                        </div>
                        <div class="col-md-9">
                            <select id="sekolahid" class="col-md-12 custom-select form-control" name='sekolahid' autofocus {{ $isSekolah ? 'disabled' : '' }}>
                                <option value="{{ $isSekolah ? $userSekolah->sekolahid : ''}}">{{ $isSekolah ? $userSekolah->namasekolah : '-- Pilih Sekolah --' }}</option>
                                @foreach ($sekolah as $item)
                                    <option value="{{$item->sekolahid}}">{{  $item->namasekolah }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="form-group row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="search" class="col-md-12 col-form-label text-md-left">{{ __('Filter') }}</label>
                        </div>
                        <div class="col-md-9">
                            <input id="search" type="text" class="col-md-12 form-control" name="search" value="{{ old('search') }}" maxlength="100" autocomplete="search" placeholder="-- Filter --">
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="form-group row">
            <div class="col-md-12">
                @if (count($errors) > 0)
                @foreach ($errors->all() as $error)
                <p class="alert alert-danger alert-dismissible fade show" role="alert">{{ $error }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </p>
                @endforeach
                @endif

                @if (session()->has('success'))
                <p class="alert alert-success alert-dismissible fade show" role="alert">{{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </p>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" style="overflow-x: auto">
                {{-- <h3 class="card-title text-uppercase">PENGANGGARAN</h3> --}}
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered yajra-datatable table-striped" id="project-table">
                        <thead>
                            <tr>
                                <th>Lokasi</th>
                                <th>Activity</th>
                                <th>Category</th>
                                <th>PIC</th>
                                <th>Material</th>
                                <th>Target</th>
                                <th>Total Progress</th>
                                <th>QTY Total</th>
                                <th>QTY Progress</th>
                                <th>Material Progress</th>
                                <th>Remark</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody style="overflow-y: auto">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card p-4 mt-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <h3 class="card-title text-uppercase">MANPOWER</h3>
                            <hr>
                            <table class="table table-bordered yajra-datatable table-striped" id="manpower-table">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nama Manpower</th>
                                        <th class="text-center">Tanggal Join</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card p-4 mt-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <h3 class="card-title text-uppercase">PROGRESS PROJECT</h3>
                            <hr>
                            <table class="table table-bordered yajra-datatable table-striped" id="progress-table">
                                <thead>
                                    <tr>
                                        <th class="text-center" colspan="2">Waktu Pengerjaan</th>
                                        <th class="text-center" rowspan="2">Pekerjaan</th>
                                        <th class="text-center" rowspan="2">Qty Progress</th>
                                        {{-- <th class="text-center" rowspan="2">Progres Project</th> --}}
                                        <th class="text-center" rowspan="2">File</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">Dari</th>
                                        <th class="text-center">Sampai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal tambah project -->
<div class="modal" id="modal_project" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document" style="max-width: 720px;">
        <div class="modal-content p-3">
            <div class="modal-header d-flex">
                <h4 class="modal-title" id="modal-title-project"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="project-form" name="project-form" class="form-horizontal form-material needs-validation" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="projectid" name="projectid">
                    <input type="hidden" name="detail_project_mode" id="detail_project_mode"/>
                    <div class="form-group">
                        <label for="lokasi" class="control-label">Lokasi:</label>
                        <input id="detail_lokasi" type="text" step="any" class="form-control @error('lokasi') is-invalid @enderror" required name="lokasi" value="{{ (old('lokasi')) }}" autocomplete="name">
                    </div>
                    <div class="form-group">
                        <label for="activity" class="control-label">Activity:</label>
                        <input id="detail_activity" type="text" step="any" class="form-control @error('activity') is-invalid @enderror" required name="activity" value="{{ (old('activity')) }}" autocomplete="name">
                    </div>
                    <div class="form-group">
                        <label for="category" class="control-label">Category:</label>
                        <select id="detail_category" class="custom-select-project form-control" name='category' required>
                            <option value="">-- Pilih Category --</option>
                            @foreach ($listCategory as $id)
                                <option value="{{ $id }}">{{ $listCategoryDesc[$loop->index] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pic" class="control-label">PIC:</label>
                        <select id="detail_pic" class="custom-select-project form-control" name='pic' required>
                            <option value="">-- Pilih PIC --</option>
                            @foreach ($manpower as $item)
                                <option value="{{ $item->manpowerid }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="materialid" class="control-label">Material:</label>
                        <select id="detail_material" class="custom-select-project form-control" name='materialid' required>
                            <option value="">-- Pilih Material --</option>
                            @foreach ($material as $item)
                                <option value="{{ $item->materialid }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="target" class="control-label">Target:</label>
                        <input id="detail_target" type="date" class="form-control @error('target') is-invalid @enderror" required name="target" value="{{ (old('target')) }}" maxlength="100" autocomplete="name">
                    </div>
                    <div class="form-group">
                        <label for="qtytotal" class="control-label">Qty Total:</label>
                        <input id="detail_qtytotal" type="number" step="any" class="form-control @error('qtytotal') is-invalid @enderror" required name="qtytotal" value="{{ (old('qtytotal')) }}" autocomplete="name">
                    </div>
                    <div class="form-group">
                        <label for="detail_remark" class="control-label">Remark:</label>
                        <textarea class="form-control @error('detail_remark') is-invalid @enderror" name="remark" required id="detail_remark" cols="30" rows="10"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button value="btnSubmit" type="submit" id="btnSubmit" class="btn btn-primary btnSubmit"><i class="icon wb-plus" aria-hidden="true"></i>Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- modal tambah -->
<div class="modal" id="modal-detail-laporan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document" style="max-width: 720px;">
        <div class="modal-content p-3">
            <div class="modal-header d-flex">
                <h4 class="modal-title" id="modal_title_progress"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="project-progress-form" name="project-progress-form" class="form-horizontal form-material needs-validation" enctype="multipart/form-data">
                    @csrf
                    {{-- <input type="hidden" name="detailsarprasid" value={{ $detailsarpras->detailsarprasid }} id="detailsarprasid"/> --}}
                    <input type="hidden" id="progress_projectid" name="progress_projectid">
                    <input type="hidden" name="detail_mode" id="detail_mode"/>
                    <div class="form-group">
                        <label for="daritgl" class="control-label">Dari Tanggal:</label>
                        <input id="detail_daritgl" type="date" class="form-control @error('daritgl') is-invalid @enderror" name="daritgl" value="{{ (old('daritgl')) }}" maxlength="100" autocomplete="name">
                    </div>
                    <div class="form-group">
                        <label for="sampaitgl" class="control-label">Sampai Tanggal:</label>
                        <input id="detail_sampaitgl" type="date" class="form-control @error('sampaitgl') is-invalid @enderror" name="sampaitgl" value="{{ (old('sampaitgl')) }}" maxlength="100" autocomplete="name">
                    </div>
                    <div class="form-group">
                        <label for="pekerjaan" class="control-label">Pekerjaan:</label>
                        <input id="detail_pekerjaan" type="text" class="form-control @error('pekerjaan') is-invalid @enderror" name="pekerjaan" value="{{ (old('pekerjaan')) }}" autocomplete="name">
                    </div>
                    <div class="form-group">
                        <label for="qtymaterial" class="control-label">Qty Material:</label>
                        <input id="detail_qtymaterial" type="number" step="any" class="form-control @error('qtymaterial') is-invalid @enderror" name="qtymaterial" value="{{ (old('qtymaterial')) }}" autocomplete="name">
                    </div>
                    {{-- <div class="form-group">
                        <label for="progres" class="control-label">Progres Project (%):</label>
                        <input id="detail_progres" type="number" step="any" class="form-control @error('progres') is-invalid @enderror" name="progres" value="{{ (old('progres')) }}" autocomplete="name">
                    </div> --}}
                    <div class="form-group">
                        <label for="file" class="control-label">File:</label>
                        <input type="file" class="form-control file-input" name="file" required /><span style="font-size: 12px" class="help-block">Format: JPG, JPEG, PNG | Max: 2MB</span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button value="btnSubmit" type="submit" id="btnSubmit" class="btn btn-primary btnSubmit"><i class="icon wb-plus" aria-hidden="true"></i>Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- modal tambah manpower -->
<div class="modal" id="modal_manpower" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document" style="max-width: 720px; overflow-y:auto;">
        <div class="modal-content p-3">
            <div class="modal-header d-flex">
                <h4 class="modal-title" id="modal-title-manpower-form">Tambah Manpower</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>
                <form method="POST" id="manpower-form" name="manpower-form" class="form-horizontal form-material needs-validation" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="manpower_projectid" name="manpower_projectid">
                    <div class="form-group">
                        <label for="manpowerid" class="control-label">Manpower:</label>
                        <select id="detail_manpower_manpowerid" class="custom-select-manpower form-control" name='manpowerid'>
                            <option value="">-- Pilih Manpower --</option>
                            @foreach ($manpower as $item)
                            <option value="{{ $item->manpowerid }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info btn-save" id="">OK</button>
                        {{-- <button type="button" id="btn_simpan_detail" class="btn btn-primary"><i class="icon wb-plus"></i>Simpan --}}
                        {{-- </button> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- modal tambah manpower -->
{{-- <div class="modal" id="modal_manpower" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document" style="max-width: 720px; overflow-y:auto;">
        <div class="modal-content p-3">
            <div class="modal-header d-flex">
                <h4 class="modal-title" id="modal-title-manpower-form">Tambah Manpower</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>
                <form method="POST" id="detail-form" name="detail-form" class="form-horizontal form-material needs-validation" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="manpowerid" class="control-label">Manpower:</label>
                        <select id="detail_manpower_manpowerid" class="custom-select-detail-jumlah form-control" name='manpowerid'>
                            <option value="">-- Pilih Manpower --</option>
                            @foreach ($jenisperalatan as $item)
                            <option value="{{ $item->manpowerid }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jumlah" class="control-label">Jumlah:</label>
                        <input id="detail_jumlah_jumlah" type="number" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah" value="{{ (old('jumlah')) }}" autocomplete="name">
                    </div>
                    <div class="form-group">
                        <label for="satuan" class="control-label">Satuan:</label>
                        <input id="detail_jumlah_satuan" type="text" class="form-control @error('satuan') is-invalid @enderror" name="satuan" value="{{ (old('satuan')) }}" autocomplete="name">
                    </div>
                    <div id="form-file-container" class="form-group">
                        <label for="file" class="control-label">File:</label>
                        <input id="detail_jumlah_file" type="file" class="form-control file-input" name="file[]" multiple /><span style="font-size: 12px" class="help-block">Format: PDF, JPG, JPEG, PNG | Max: 2MB</span>
                        <div class="param_img_holder d-flex justify-content-center align-items-center">
                        </div>
                    </div>
                    <div id="edit-peralatan-table-container">
                        <table class="table table-bordered yajra-datatable table-striped" id="detail-edit-peralatan-table" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center">File</th>
                                    <th class="text-center" id="th-detail-form">Preview</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info btn-save" id="">OK</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}

<!-- foo table -->
<script src="{{asset('/dist/js/pages/footable-init.js')}}"></script>
<script src="{{asset('/dist/plugins/bower_components/footable/js/footable.all.min.js')}}"></script>
<script src="{{asset('/dist/plugins/bower_components/bootstrap-select/bootstrap-select.min.js')}}" type="text/javascript"></script>

<script>

    $(document).ready(function () {
        
        $('.custom-select').select2();

        $('.custom-select-project').select2({
            dropdownParent: $('#modal_project')
        });
        $('.custom-select-manpower').select2({
            dropdownParent: $('#modal_manpower')
        });


const validExtensions = ['jpeg', 'jpg', 'png', 'gif', 'webp'];

$('form').on('change', '.file-input', function(e) {
  const $input = $(this);
  const imgPath = $input.val();
  const $imgPreview = $input.closest('form').find('.param_img_holder');
  const extension = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();

    var clickedButton = this;
    var files = e.target.files,
    filesLength = files.length;

    if (typeof(FileReader) == 'undefined') {
        $imgPreview.html('This browser does not support FileReader');
        return;
    }

    for (let i = 0; i < filesLength; i++) {
        
        var f = files[i];

        if (validExtensions.includes(extension)) {
            $imgPreview.empty();
            var reader = new FileReader();
            reader.onload = function(e) {
                var file = e.target
                // $('<iframe/>', {
                //     src: e.target.result,
                //     height: 60,
                //     width: 60,
                // }).appendTo($imgPreview);

                $("<div class=\"pip\">" +
                "<img width=\"100%\" height=\"600px\" class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\" />" +
                // "<br/><div class=\"remove\">Remove image</div>" +
                "</div>").appendTo($imgPreview);
                // $(".remove").click(function(){
                //     $(this).parent(".pip").remove();
                // });
            }
            // $imgPreview.show();
            // reader.readAsDataURL($input[0].files[0]);
            reader.readAsDataURL(f);
    } else {
        $imgPreview.empty();
        swal.fire('Peringatan!', 'Ekstensi file tidak sesuai, silakan upload file dengan ekstensi: PDF, JPEG, JPG, PNG.', 'warning');

            // remove file ketika validasi ekstensi file gagal
            if(this.value){
                try{
                    this.value = ''; //for IE11, latest Chrome/Firefox/Opera...
                }catch(err){ }
                if(this.value){ //for IE5 ~ IE10
                    var form = document.createElement('form'),
                        parentNode = this.parentNode, ref = this.nextSibling;
                    form.appendChild(this);
                    form.reset();
                    parentNode.insertBefore(this,ref);
                }
            }
    }

    }
    });


        $('#kotaid').change(function () {
            projecttable.draw();
            $('#detail-laporan-table').hide();
        });
        $('#kecamatanid').change(function () {
            projecttable.draw();
            $('#detail-laporan-table').hide();
        });
        $('#jenjang').change(function () {
            projecttable.draw();
            $('#detail-laporan-table').hide();
        });
        $('#jenis').change(function () {
            projecttable.draw();
            $('#detail-laporan-table').hide();
        });
        $('#perusahaanid').change(function () {
            projecttable.draw();
            $('#detail-laporan-table').hide();
        });
        $('#sekolahid').change( function() { 
            projecttable.draw();
            $('#detail-laporan-table').hide();
        });

        $('#search').keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });

        $('#search').on('keyup', function (e) {
            if (e.key === 'Enter' || e.keyCode === 13) {
                projecttable.draw();
                 $('#detail-laporan-table').hide();
            }
        });
    });

    var v_listDataDetail = [];
    var v_listDetailDeleted = [];

        function resettablejumlah() {
            var v_listDataDetail = [];
            var v_listDetailDeleted = [];
            reloadTableDetailJumlah();
        }

        $("#btn_simpan_detail").click(function(){
            simpandatadetailjumlah();
        });

        function resetformdetailjumlah() {
            $("#project-form")[0].reset();
        // const $input = $('#detail_file')
        // const $imgPreview = $input.closest('div').find('.param_img_holder');
        // $imgPreview.empty();
        // removeImageValue('detail_file');
        // var v_max = 1;
        // if (v_listDataDetail.length > 0) {
        //     var v_maxobj = v_listDataDetail.reduce((prev, current) => (prev && prev.nourut > current.nourut) ? prev : current);
        //     v_max = parseInt(v_maxobj.nourut)+1;
        // }
        // $("#detail_detail_nourut").val(v_max);
        //alert(v_listDataDetail.length);
        //alert(v_listDataDetail.length + '->' + JSON.stringify(max));

        $('span[id^="err_detail_"]', "#project-form").each(function(index, el){
            $('#'+el.id).html("");
        });

        $('select[id^="detail_"]', "#project-form").each(function(index, el){
            var inputname = el.id.substring(7, el.id.length);
            if (inputname != "mode") {
                $("#"+el.id).val("").trigger('change');
            }
        });
        $('input[id^="detail_"]', "#project-form").each(function(index, el){
            var inputname = el.id.substring(7, el.id.length);
            if (inputname != "mode") {
                $("#"+el.id).val("");
            }
        });
        $('textarea[id^="detail_"]', "#project-form").each(function(index, el){
            var inputname = el.id.substring(7, el.id.length);
            if (inputname != "mode") {
                $("#"+el.id).val("");
            }
        });
        }

        function bindformdetailjumlah() {
            $('textarea[id^="detail_jumlah_"]', "#detail-form").each(function(index, el){
                var inputname = el.id.substring(14, el.id.length);
                //alert(inputname);
                if (inputname != "mode") {
                    $("#"+el.id).val(detailjumlahtable.rows( { selected: true } ).data()[0][inputname]);
                }
            });
            
            $('input[id^="detail_jumlah_"]', "#detail-form").each(function(index, el){
                var inputname = el.id.substring(14, el.id.length);
                //alert(inputname);
                if (inputname != "mode") {
                    $("#"+el.id).val(detailjumlahtable.rows( { selected: true } ).data()[0][inputname]);
                }
            });
            
            $('select[id^="detail_jumlah_"]', "#detail-form").each(function(index, el){
                var inputname = el.id.substring(14, el.id.length);
                //alert(inputname);
                if (inputname != "mode") {
                    $("#"+el.id).val(detailjumlahtable.rows( { selected: true } ).data()[0][inputname]).trigger('change');
                }
            });
        }

        function setenableddetailjumlah(value) {
            if (value) {
                $("#btn_simpan").show();
            }
            else {
                $("#btn_simpan").hide();
            }
            
            $('textarea[id^="detail_"]', "#aktivitashariandetail-form").each(function(index, el){
                $("#"+el.id).prop("readonly", !value);
            });
            $('input[id^="detail_"]', "#aktivitashariandetail-form").each(function(index, el){
                $("#"+el.id).prop("readonly", !value);
            });
            $('select[id^="detail_"]', "#aktivitashariandetail-form").each(function(index, el){
                $("#"+el.id).prop("disabled", !value);
            });
        }

        var v_modedetail = "";
        function showmodalprogress(mode) {
            v_modedetail = mode;
            $("#detail_project_mode").val(mode);
            resetformdetailjumlah();
            if (mode == "add") {
                $("#modal-title-project").html('Tambah Data');
                // $('#form-file-container').removeClass('d-none');
                // $('#edit-peralatan-table-container').addClass('d-none');
                setenableddetailjumlah(true);
            }
            else if (mode == "edit") {
                $("#modal-title-detail-form").html('Ubah Data');
                $('#form-file-container').addClass('d-none');
                $('#edit-peralatan-table-container').removeClass('d-none');
                bindformdetailjumlah();
                setenableddetailjumlah(true);
                var rowData = detailjumlahtable.rows( { selected: true } ).data()[0];
                var detailjumlahperalatanid = rowData.detailjumlahperalatanid;
                var jenisperalatanid = rowData.jenisperalatanid;

                var listJenisPeralatan = @json($jenisperalatan);
                let namaJenisPeralatan;
                listJenisPeralatan.forEach((value, index) => {
                    if(jenisperalatanid == value.jenisperalatanid) {
                        namaJenisPeralatan = value.nama;
                    }
                });

                loadEditFotoJenisPeralatan(detailjumlahperalatanid);
                $('#th-detail-peralatan').html('Foto ' + namaJenisPeralatan);
            }
            else {
                $("#modal-title-detail-form").html('Lihat Data');
                bindformdetailjumlah();
                setenableddetailjumlah(false);
            }
            
            $("#modal_project").modal('show');
        }

        function hidemodaldetailjumlah() {
            $("#modal-detail-form").modal('hide');
        }

        var progresstable;
        var manpowertable;
        var projecttable = $('#project-table').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            pageLength: 50,
            dom: 'Bfrtip',
            select: true,
            ordering: false,
            language: {
                lengthMenu: "Menampilkan _MENU_ data per halaman",
                zeroRecords: "Tidak ada data",
                info: "Halaman _PAGE_ dari _PAGES_",
                infoEmpty: "Tidak ada data",
                infoFiltered: "(difilter dari _MAX_ data)",
                search: "Pencarian :",
                paginate: {
                    previous: "Sebelumnya",
                    next: "Selanjutnya",
                }
            },
            ajax: {
                url: "{{ route('project.index') }}",
                dataSrc: function (response) {
                    response.recordsTotal = response.data.count;
                    response.recordsFiltered = response.data.count;
                    return response.data.data;
                },
                data: function (d) {
                    return $.extend({}, d, {
                        // "perusahaanid": $("#perusahaanid").val().toLowerCase(),
                        // "kotaid": $('#kotaid').val().toLowerCase(),
                        // "jenjang": $('#jenjang').val().toLowerCase(),
                        // "jenis": $('#jenis').val().toLowerCase(),
                        // "sekolahid": $('#sekolahid').val().toLowerCase(),
                        "search": $("#search").val().toLowerCase()
                    });
                }
            },
            buttons: {
                buttons: [
                    {
                        attr: {id: 'btn-tambahproject'},
                        text: '<i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah',
                        className: 'edit btn btn-primary btn-datatable mb-2',
                        action: function () {

                            // $('#modal_project').modal('show');
                            showmodalprogress('add');
                        }
                    },
                    {
                        text: '<i class="fa fa-trash" aria-hidden="true"></i> Hapus',
                        className: 'delete btn btn-danger btn-datatable mb-2',
                        action: function () {
                            if (projecttable.rows( { selected: true } ).count() <= 0) {
                                swal.fire("Data belum dipilih", "Silahkan pilih data yang akan dihapus", "error");
                                return;
                            }
                            
                            var id = projecttable.rows( { selected: true } ).data()[0]['projectid'];
                            var url = "{{ route('project.destroy', ':id') }}"
                            url = url.replace(':id', id);
                            swal.fire({   
                                title: "Apakah anda yakin akan menghapus data ini?",   
                                text: "Data yang terhapus tidak dapat dikembalikan lagi!",   
                                type: "warning",   
                                showCancelButton: true,   
                                confirmButtonColor: "#DD6B55",   
                                confirmButtonText: "Ya, lanjutkan!",   
                                closeOnConfirm: false 
                            }).then((result) => {
                                    if (result.isConfirmed) {
                                        $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });
                                    $.ajax({
                                        type: "DELETE",
                                        cache:false,
                                        url: url,
                                        dataType: 'JSON',
                                        data: {
                                            "_token": $('meta[name="csrf-token"]').attr('content')
                                        },
                                        success: function(json){
                                            var success = json.success;
                                            var message = json.message;
                                            var data = json.data;
                                            console.log(data);
                                            
                                            if (success == 'true' || success == true) {
                                                swal.fire("Berhasil!", "Data anda telah dihapus.", "success"); 
                                                projecttable.draw();
                                            }
                                            else {
                                                swal.fire("Error!", data, "error"); 
                                            }
                                        },
                                        error: function(jqXHR, textStatus, errorThrown) {
                                                var data = jqXHR.responseJSON;
                                                swal.fire("Gagal!", `${data.message}, anda tidak diizinkan untuk mengambil aksi ini!`, "error");
                                        }
                                    });   
                                }          
                            });
                        }
                    },
                    {
                        attr: {id: 'btn-selesai'},
                        text: '<i class="fa fa-check-square" aria-hidden="true"></i> Selesai',
                        className: 'edit btn btn-success btn-datatable mb-2',
                        action: function () {
                            if (projecttable.rows({
                                    selected: true
                                }).count() <= 0) {
                                swal.fire("Data belum dipilih",
                                    "Silahkan pilih data terlebih dahulu", "error");
                                return;
                            }

                            let status = projecttable.rows( { selected: true } ).data()[0]['status'];
                            let statusDesc = projecttable.rows( { selected: true } ).data()[0]['status'] == 5 ? 'Proses Tender' : '';

                            var rowData = projecttable.rows({ selected: true }).data()[0]; // Get selected row data
                            var projectid = rowData.projectid;
                            console.log(projectid);

                            let url = "{{ route('project.selesai', ':id') }}"
                            url = url.replace(':id', projectid);

                            swal.fire({   
                                title: "Konfirmasi",   
                                text: `Apakah anda yakin menyelesaikan data project ini?`,   
                                icon: "warning",   
                                showCancelButton: true,   
                                confirmButtonText: "Ya, lanjutkan!",   
                                closeOnConfirm: false 
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });
                                    $.ajax({
                                        type: "POST",
                                        cache:false,
                                        url: url,
                                        dataType: 'JSON',
                                        data: {
                                            "_token": $('meta[name="csrf-token"]').attr('content')
                                        },
                                        success: function(json){
                                            var success = json.success;
                                            var message = json.message;
                                            var data = json.data;
                                            console.log(data);
                                            
                                            if (success == 'true' || success == true) {
                                                swal.fire("Berhasil!", message, "success"); 
                                                // progresstable.draw();
                                                var rowData = projecttable.rows( {selected: true} ).data()[0]; // Get selected row data
                                                var projectid = rowData.projectid;
                                                projecttable.draw();
                                            }
                                            else {
                                                swal.fire("Error!", message, "error"); 
                                            }
                                        },
                                        error: function(jqXHR, textStatus, errorThrown) {
                                                var data = jqXHR.responseJSON;
                                                swal.fire("Gagal!", `${data.message}, anda tidak diizinkan untuk mengambil aksi ini!`, "error");
                                        }
                                    });  
                                }          
                            });
                        }
                    },
                ]
            },
            columns: [
                {
                    'orderData': 0,
                    data: 'lokasi',
                    render: function (data, type, row) {
                        if (row.lokasi != null) {
                            return row.lokasi;
                        }
                        else {
                            return '---'
                        }
                    },
                    name: 'lokasi'
                },
                {
                    'orderData': 1,
                    data: 'activity',
                    render: function (data, type, row) {
                        if (row.activity != null) {
                            return row.activity;
                        }
                        else {
                            return '---'
                        }
                    },
                    name: 'activity'
                },
                {'orderData': 2, data: 'category', name: 'category',
                    render: function(data, type, row) {
                        if(row.category != null) {
                            var listCategory = @json($listCategoryDesc);
                            let Desc;
                            listCategory.forEach((value, index) => {
                                if(row.category == index + 1) {
                                    Desc = value;
                                }
                            });
                            return Desc;
                        }else {
                            return '---'
                        }
                    }
                },
                {
                    'orderData': 3,
                    data: 'pic',
                    render: function (data, type, row) {
                        if (row.pic != null) {
                            return row.pic;
                        }
                        else {
                            return '---'
                        }
                    },
                    name: 'pic'
                },
                {
                    'orderData': 4,
                    data: 'materialid',
                    render: function(data, type, row){
                        if (row.materialid != null) {
                            return (row.nama);
                        }else{
                            return '---'
                        }
                    },
                    name: 'material'
                },
                {
                    'orderData': 5,
                    data: 'target',
                    render: function(data, type, row){
                        if (row.target != null) {
                            return (row.target);
                        }else{
                            return '---'
                        }
                    },
                    name: 'target'
                },
                {
                    'orderData': 6,
                    data: 'materialprogress',
                    render: function (data, type, row) {
                        if(row.qtytotal != null) { 
                            var materialprogress = row.qtyprogress / row.qtytotal * (100)
                            return `<div class="progress progress-lg">` +
                                        `<div class="progress-bar ${materialprogress <= 75 ? "progress-bar-info" : "progress-bar-success"} progress-bar-striped active" role="progressbar" style="width: ${materialprogress}%; role="progressbar""> ${materialprogress}% </div>` +
                                    `</div>`
                            // return `${row.progres} %`;
                        }
                    },
                    name: 'materialprogress',
                },
                {
                    'orderData': 7,
                    data: 'qtytotal',
                    render: function (data, type, row) {
                        if (row.qtytotal != null) {
                            return (row.qtytotal);
                        }else {
                            return '---'
                        }
                    },
                    name: 'qtytotal',
                },
                {
                    'orderData': 8,
                    data: 'qtyprogress',
                    render: function (data, type, row) {
                        if (row.qtyprogress != null) {
                            return (row.qtyprogress);
                        }else {
                            return '---'
                        }
                    },
                    name: 'qtyprogress',
                },
                {
                    'orderData': 9,
                    data: 'materialprogress',
                    render: function (data, type, row) {
                        if(row.qtytotal != null) { 
                            var materialprogress = row.qtyprogress / row.qtytotal * (100)
                            return `<div class="progress progress-lg">` +
                                        `<div class="progress-bar ${materialprogress <= 75 ? "progress-bar-info" : "progress-bar-success"} progress-bar-striped active" role="progressbar" style="width: ${materialprogress}%; role="progressbar""> ${materialprogress}% </div>` +
                                    `</div>`
                            // return `${row.progres} %`;
                        }
                    },
                    name: 'materialprogress',
                },
                {
                    'orderData': 10,
                    data: 'remark',
                    render: function (data, type, row) {
                        if(row.remark != null) { 
                            return row.remark;
                        }else {
                            return '---'
                        }
                    },
                    name: 'remark',
                },
                {
                    'orderData': 11,
                    data: 'status',
                    render: function (data, type, row) {
                        if(row.status == true) { 
                            return '<span class="badge badge-pill badge-success">V</span>';
                        }else {
                            return '<span class="badge badge-pill badge-danger">X</span>';
                        }
                    },
                    sClass : "text-center", 
                    name: 'status',
                },
            ],
            initComplete: function (settings, json) {
                $(".btn-datatable").removeClass("dt-button");
            },
            //order: [[1, 'asc']]
        });

        // hide histiry table
    $('#manpower-table').hide();
    // Initialize history table
    var manpowertable = $('#manpower-table').DataTable({
        responsive: true,
        processing: true,
        // serverSide: true,
        pageLength: 50,
        dom: 'Bfrtip',
        select: true,
        ordering: false,
        searching: false,
        language: {
            // lengthMenu: "Menampilkan _MENU_ data per halaman",
            zeroRecords: "Tidak ada data",
            info: "Halaman _PAGE_ dari _PAGES_",
            infoEmpty: "Tidak ada data",
            infoFiltered: "(difilter dari _MAX_ data)",
            search: "Pencarian :",
            paginate: {
                previous: "Sebelumnya",
                next: "Selanjutnya",
            }
        },
        // ... your detail-laporan-table initialization options ...
        columns: [
            {
                data: 'nama',
                name: 'nama',
                render: function(data, type, row) {
                    if(row.nama != null) {
                        return row.nama;
                    } 
                }
            },
            {
                data: 'tgljoin',
                name: 'tgljoin',
                render: function(data, type, row) {
                    if (row.tgljoin != null) {
                        return row.tgljoin;
                    }
                }
            },
        ],
        buttons: {
            buttons: [
                {
                    text: '<i class="fa fa-plus-circle aria-hidden="true"></i> Tambah',
                    className: 'edit btn btn-primary mb-3 btn-datatable',
                    action: function () {
                        if (projecttable.rows( {selected: true} ).count() <= 0) {
                            swal.fire("Data project belum dipilih", "Silakan pilih data project terlebih dahulu", "error");
                            return;
                        }
                        else{
                            var rowData = projecttable.rows({ selected: true }).data()[0]; // Get selected row data
                            var projectid = rowData.projectid;
                            $('#modal_manpower').modal('show');
                            $('#detail_manpower_manpowerid').val('').trigger('change');
                            $('#manpower_projectid').val(projectid);
                        }
                    }
                },
                {
                        text: '<i class="fa fa-trash" aria-hidden="true"></i> Hapus',
                        className: 'delete btn btn-danger btn-datatable mb-3',
                        action: function () {
                            if (manpowertable.rows( { selected: true } ).count() <= 0) {
                                swal.fire("Data belum dipilih", "Silahkan pilih data yang akan dihapus", "error");
                                return;
                            }
                            
                            var id = manpowertable.rows( { selected: true } ).data()[0]['projectmanpowerid'];
                            console.log(id);
                            var url = "{{ route('project.destroyManpower', ':id') }}"
                            url = url.replace(':id', id);
                            swal.fire({   
                                title: "Apakah anda yakin akan menghapus data ini?",   
                                text: "Data yang terhapus tidak dapat dikembalikan lagi!",   
                                type: "warning",   
                                showCancelButton: true,   
                                confirmButtonColor: "#DD6B55",   
                                confirmButtonText: "Ya, lanjutkan!",   
                                closeOnConfirm: false 
                            }).then((result) => {
                                    if (result.isConfirmed) {
                                        $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });
                                    $.ajax({
                                        type: "POST",
                                        cache:false,
                                        url: url,
                                        dataType: 'JSON',
                                        data: {
                                            "_token": $('meta[name="csrf-token"]').attr('content')
                                        },
                                        success: function(json){
                                            var success = json.success;
                                            var message = json.message;
                                            var data = json.data;
                                            console.log(data);
                                            
                                            if (success == 'true' || success == true) {
                                                swal.fire("Berhasil!", "Data anda telah dihapus.", "success"); 
                                                // manpowertable.draw();
                                                var rowData = projecttable.rows({ selected: true }).data()[0]; // Get selected row data
                                                var projectid = rowData.projectid;

                                                loadManpower(projectid);

                                            }
                                            else {
                                                swal.fire("Error!", data, "error"); 
                                            }
                                        },
                                        error: function(jqXHR, textStatus, errorThrown) {
                                                var data = jqXHR.responseJSON;
                                                swal.fire("Gagal!", `${data.message}, anda tidak diizinkan untuk mengambil aksi ini!`, "error");
                                        }
                                    });   
                                }          
                            });
                        }
                    },
                // {
                //     text: '<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Ubah',
                //     className: 'edit btn btn-warning mb-3 btn-datatable',
                //     action: function () {
                //         if (manpowertable.rows( { selected: true } ).count() <= 0) {
                //             swal.fire("Data belum dipilih", "Silahkan pilih data yang akan diubah", "error");
                //             return;
                //         }
                //         // var id = manpowertable.rows( { selected: true } ).data()[0]['detailsaprasid'];
                //         var rowData = manpowertable.rows({ selected: true }).data()[0]; // Get selected row data
                //         var detailpenganggaranid = rowData.detailpenganggaranid;

                //         $('#modal-detail-laporan').modal('show');
                //         showmodaldetail('edit');

                //         // $('#subkegid-edit option[value="'+subkegid+'"]').prop('selected', true);

                //         $('#modal-detail-laporan-penganggaran').modal('show');
                //         $('#btnSubmitParent').show();
                //         // $('#title-modal-detail-penganggaran').text('EDIT DETAIL PENGANGGARAN');
                //         // showDetailPaguPenganggaran(detailpenganggaranid);
                //         setenabledtbutton("0");
                //         // console.log(detailpenganggaranid);
                //     }
                // },
            ]
        },
    });

    function loadManpower(projectid) {
        var url = "{{ route('project.loadManpower', ':id') }}";
        url = url.replace(':id', projectid);

        $.ajax({
            url: url,
            type: "GET",
            success: function (response) {

                manpowertable.clear();

                for (var i = 0; i < response.data.count; i++) {
                    manpowertable.row.add({
                        projectmanpowerid: response.data.data[i].projectmanpowerid,
                        manpowerid: response.data.data[i].manpowerid,
                        nama: response.data.data[i].nama,
                        tgljoin: response.data.data[i].tgljoin,
                    });
                }

                manpowertable.draw();
                $('#manpower-table').show();
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

        // store detail jumlah sarpras  
        $(document).on('submit', '#detail-parent-form', function(e){
            e.preventDefault();

            var rowData = projecttable.rows({ selected: true }).data()[0]; // Get selected row data
            var detailpaguanggaranid = rowData.detailpaguanggaranid;
            console.log(detailpaguanggaranid);

            // var url = '';

            let url = "{{ route('progresfisik.selesai', ':id') }}"
            url = url.replace(':id', detailpaguanggaranid);
            
            // var formData = new FormData($('#detail-foto-peralatan-form')[0]);

            swal.fire({   
                title: "Konfirmasi",   
                text: `Apakah anda yakin menyelesaikan data laporan ini?`,   
                icon: "warning",   
                showCancelButton: true,   
                confirmButtonText: "Ya, lanjutkan!",   
                closeOnConfirm: false 
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        cache:false,
                        url: url,
                        dataType: 'JSON',
                        data: {
                            "_token": $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(json){
                            var success = json.success;
                            var message = json.message;
                            var data = json.data;
                            console.log(data);
                            
                            if (success == 'true' || success == true) {
                                swal.fire("Berhasil!", "Data pembangunan sudah masuk ke menu sarpras tersedia.", "success"); 
                                // progresstable.draw();
                                $('#modal-detail-parent').modal('hide');
                                var rowData = projecttable.rows( {selected: true} ).data()[0]; // Get selected row data
                                var sarpraskebutuhanid = rowData.sarpraskebutuhanid;
                                projecttable.draw();
                            }
                            else if (success == 'false' || success == false) {
                                swal.fire({
                                    title: 'Peringatan!',
                                    text: message + '. Apakah anda ingin mengisi data jenis peralatan?',
                                    icon: "warning",   
                                    showCancelButton: true,   
                                    confirmButtonText: "Ya, lanjutkan!",
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        var rowData = projecttable.rows({ selected: true }).data()[0]; // Get selected row data
                                        var detailpenganggaranid = rowData.detailpenganggaranid;
                                        console.log(detailpenganggaranid)

                                        loadDetailJenisPeralatan(detailpenganggaranid)

                                        $('#modal-detail-parent').modal('show');
                                        enableSelesaiButton('true');
                                    }
                                }); 
                            }
                            else {
                                swal.fire("Error!", message, "error"); 
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            var data = jqXHR.responseJSON;
                            console.log(data.errors);// this will be the error bag.
                            // printErrorMsg(data.errors);
                        }
                    })
                }
            })
        })

        const enableSelesaiButton = (condition) => {
            if (condition == 'true') {
                $('#btn-selesai-container').removeClass('d-none');
            } else if (condition == 'false') {
                $('#btn-selesai-container').addClass('d-none');
            }
        }

        function loadProgress(progressid) {
            var url = "{{ route('project.loadProgress', ':id') }}";
            url = url.replace(':id', progressid);

            $.ajax({
                url: url,
                type: "GET",
                success: function (response) {

                    progresstable.clear();

                    for (var i = 0; i < response.data.count; i++) {
                        progresstable.row.add({
                            projectprogressid: response.data.data[i].projectprogressid,
                            projectid: response.data.data[i].projectid,
                            pekerjaan: response.data.data[i].pekerjaan,
                            qtymaterial: response.data.data[i].qtymaterial,
                            tgldari: response.data.data[i].tgldari,
                            tglsampai: response.data.data[i].tglsampai,
                            progres: response.data.data[i].progres,
                            file: response.data.data[i].file,
                        });
                    }

                    progresstable.draw();
                    $('#progress-table').show();
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }

        // Listen for row selection event on project-table
        projecttable.on('select', function (e, dt, type, indexes) {
            var rowData = projecttable.rows(indexes).data()[0]; // Get selected row data
            var projectid = rowData.projectid;
            var progres = rowData.progres;
            var status = rowData.status;

            
            setenableprogresbutton(progres, status);

            // Load history table with selected projectid
            // loadproject-progress(projectid);

            loadManpower(projectid);
            loadProgress(projectid);
        });

        projecttable.on('deselect', function ( e, dt, type, indexes ) {
            var rowData = projecttable.rows(indexes).data()[0]; // Get selected row data
            var jenissarpras = rowData.jenissarpras;
            // hide history table
            $('#manpower-table').hide();
            $('#progress-table').hide();
            // showJenisPeralatanBtn('deselect', jenissarpras);
        });


    // hide histiry table
    $('#progress-table').hide();

    // Initialize history table
    var progresstable = $('#progress-table').DataTable({
        responsive: true,
        processing: true,
        // serverSide: true,
        pageLength: 50,
        dom: 'Bfrtip',
        select: true,
        ordering: false,
        searching: false,
        language: {
            // lengthMenu: "Menampilkan _MENU_ data per halaman",
            zeroRecords: "Tidak ada data",
            info: "Halaman _PAGE_ dari _PAGES_",
            infoEmpty: "Tidak ada data",
            infoFiltered: "(difilter dari _MAX_ data)",
            search: "Pencarian :",
            paginate: {
                previous: "Sebelumnya",
                next: "Selanjutnya",
            }
        },
        // ... your detail-laporan-table initialization options ...
        columns: [
            {
                data: 'tgldari',
                name: 'tgldari',
                render: function(data, type, row) {
                    if(row.tgldari != null) {
                        return DateFormat(row.tgldari);
                    } 
                    else {
                        return '-'
                    }
                }
            },
            {
                data: 'tglsampai',
                name: 'tglsampai',
                render: function(data, type, row) {
                    if (row.tglsampai != null) {
                        return DateFormat(row.tglsampai);
                    }
                    else {
                        return '-'
                    }
                }
            },
            {
                data: 'pekerjaan',
                name: 'pekerjaan',
                render: function(data, type, row) {
                    if (row.pekerjaan != null) {
                        return row.pekerjaan;
                    }
                    else {
                        return '-'
                    }
                }
            },
            {
                data: 'qtymaterial',
                name: 'qtymaterial',
                render: function(data, type, row) {
                    if (row.qtymaterial != null) {
                        return row.qtymaterial;
                    }
                    else {
                        return '-'
                    }
                }
            },
            // {
            //     data: 'progres',
            //     name: 'progres',
            //     render: function(data, type, row) {
            //         if(row.progres != null) {
            //             return `<div class="progress progress-lg">` +
            //                             `<div class="progress-bar ${row.progres <= 75 ? "progress-bar-info" : "progress-bar-success"} progress-bar-striped active" role="progressbar" style="width: ${row.progres}%; role="progressbar""> ${row.progres}% </div>` +
            //                         `</div>`;
            //         }
            //         else {
            //             return '-'
            //         }
            //     }
            // },
            {data: 'file', name: 'preview', 
                render: function (data, type, row){
                    if(row.file != null){
                        return "<div class=\"d-flex justify-content-center align-items-center\"><img src=\"/storage/uploaded/progressproject/"+row.file+"\" height=\"100\" /></div>";
                    }else{
                        return '---'
                    }
                }
                },
        ],
        buttons: {
            buttons: [
                {
                    text: '<i class="fa fa-plus-circle aria-hidden="true"></i> Tambah',
                    className: 'edit btn btn-primary mb-3 btn-datatable',
                    action: function () {
                        if (projecttable.rows( {selected: true} ).count() <= 0) {
                            swal.fire("Data project belum dipilih", "Silakan pilih data project terlebih dahulu", "error");
                            return;
                        }
                        else{
                            var rowData = projecttable.rows( {selected: true} ).data()[0]; // Get selected row data
                            var projectid = rowData.projectid;

                            $('#progress_projectid').val(projectid);

                            $('#modal-detail-laporan').modal('show');
                            showmodaldetail('add');
                        }
                    }
                },
                {
                    text: '<i class="fa fa-trash" aria-hidden="true"></i> Hapus',
                    className: 'delete btn btn-danger btn-datatable mb-3',
                    action: function () {
                        if (progresstable.rows( { selected: true } ).count() <= 0) {
                            swal.fire("Data belum dipilih", "Silahkan pilih data yang akan dihapus", "error");
                            return;
                        }
                        
                        var id = progresstable.rows( { selected: true } ).data()[0]['projectprogressid'];
                        console.log(id);
                        var url = "{{ route('project.destroyProgresproject', ':id') }}"
                        url = url.replace(':id', id);
                        swal.fire({   
                            title: "Apakah anda yakin akan menghapus data ini?",   
                            text: "Data yang terhapus tidak dapat dikembalikan lagi!",   
                            type: "warning",   
                            showCancelButton: true,   
                            confirmButtonColor: "#DD6B55",   
                            confirmButtonText: "Ya, lanjutkan!",   
                            closeOnConfirm: false 
                        }).then((result) => {
                                if (result.isConfirmed) {
                                    $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                $.ajax({
                                    type: "POST",
                                    cache:false,
                                    url: url,
                                    dataType: 'JSON',
                                    data: {
                                        "_token": $('meta[name="csrf-token"]').attr('content')
                                    },
                                    success: function(json){
                                        var success = json.success;
                                        var message = json.message;
                                        var data = json.data;
                                        console.log(data);
                                        
                                        if (success == 'true' || success == true) {
                                            swal.fire("Berhasil!", "Data anda telah dihapus.", "success"); 
                                            // progresstable.draw();
                                            var rowData = projecttable.rows({ selected: true }).data()[0]; // Get selected row data
                                            var projectid = rowData.projectid;

                                            loadProgress(projectid);

                                        }
                                        else {
                                            swal.fire("Error!", data, "error"); 
                                        }
                                    },
                                    error: function(jqXHR, textStatus, errorThrown) {
                                            var data = jqXHR.responseJSON;
                                            swal.fire("Gagal!", `${data.message}, anda tidak diizinkan untuk mengambil aksi ini!`, "error");
                                    }
                                });   
                            }          
                        });
                    }
                },
            ]
        },
    });

    function resetformdetail() {
        $("#project-progress-form")[0].reset();
        // const $input = $('#detail_file')
        // const $imgPreview = $input.closest('div').find('.param_img_holder');
        // $imgPreview.empty();
        // removeImageValue('detail_file');
        // var v_max = 1;
        // if (v_listDataDetail.length > 0) {
        //     var v_maxobj = v_listDataDetail.reduce((prev, current) => (prev && prev.nourut > current.nourut) ? prev : current);
        //     v_max = parseInt(v_maxobj.nourut)+1;
        // }
        // $("#detail_detail_nourut").val(v_max);
        //alert(v_listDataDetail.length);
        //alert(v_listDataDetail.length + '->' + JSON.stringify(max));

        $('span[id^="err_detail_"]', "#project-progress-form").each(function(index, el){
            $('#'+el.id).html("");
        });

        $('select[id^="detail_"]', "#project-progress-form").each(function(index, el){
            var inputname = el.id.substring(7, el.id.length);
            if (inputname != "mode") {
                $("#"+el.id).val("").trigger('change');
            }
        });
        $('input[id^="detail_"]', "#project-progress-form").each(function(index, el){
            var inputname = el.id.substring(7, el.id.length);
            if (inputname != "mode") {
                $("#"+el.id).val("");
            }
        });
        $('textarea[id^="detail_"]', "#project-progress-form").each(function(index, el){
            var inputname = el.id.substring(7, el.id.length);
            if (inputname != "mode") {
                $("#"+el.id).val("");
            }
        });
    }

    function bindformdetail() {
        $('input[id^="detail_"]', "#project-progress-form").each(function(index, el){
            var inputname = el.id.substring(7, el.id.length);
            //alert(inputname);
            if (inputname != "mode") {
                $("#"+el.id).val(progresstable.rows( { selected: true } ).data()[0][inputname]);
            }
        });
        
        $('select[id^="detail_"]', "#project-progress-form").each(function(index, el){
            var inputname = el.id.substring(7, el.id.length);
            //alert(inputname);
            if (inputname != "mode") {
                $("#"+el.id).val(progresstable.rows( { selected: true } ).data()[0][inputname]).trigger('change');
            }
        });

        $('textarea[id^="detail_"]', "#project-progress-form").each(function(index, el){
            var inputname = el.id.substring(7, el.id.length);
            //alert(inputname);
            if (inputname != "mode") {
                $("#"+el.id).val(progresstable.rows( { selected: true } ).data()[0][inputname]);
            }
        });
    }

    function setenableddetail(value) {
        if (value) {
            $("#btnSubmit").show();
        }
        else {
            $("#btnSubmit").hide();
        }
        
        $('textarea[id^=""]', "#project-progress-form").each(function(index, el){
            $("#"+el.id).prop("readonly", !value);
        });
        $('input[id^=""]', "#project-progress-form").each(function(index, el){
            $("#"+el.id).prop("readonly", !value);
        });
        $('select[id^=""]', "#project-progress-form").each(function(index, el){
            $("#"+el.id).prop("disabled", !value);
        });
    }

    var v_modedetail = "";
    function showmodaldetail(mode) {
        v_modedetail = mode;
        $("#detail_mode").val(mode);
        resetformdetail();
        if (mode == "add") {
            $("#modal_title_progress").html('Tambah Data');
            // setenableddetail(true);
            
            // console.log($("#detail_mode").val());
        }
        else if (mode == "edit") {
            $("#modal_title_progress").html('Ubah Data');
            bindformdetail();
            // setenableddetail(true);
        }
        else {
            $("#modal_title_progress").html('Lihat Data');
            bindformdetail();
            // setenableddetail(false);
        }
        
        $("#m_formshowdetail").modal('show');
    }

    function hidemodaldetail() {
        $("#m_formshowdetail").modal('hide');
    }

    function setenableprogresbutton(progres, selesai) {
        projecttable.buttons( '#btn-selesai' ).disable();
        if (progres >= 100 && selesai != true) {
            projecttable.buttons( '#btn-selesai' ).enable();
        }
        // else if (progres >= 100 || selesai == true) {
        //     projecttable.buttons( '#btn-selesai' ).disable();
        // }
        else {
            projecttable.buttons( '#btn-selesai' ).disable();
        }
    }

    // verifikasi kebutuhan sarpras 
    $(document).on('submit', '#project-form', function(e){
            var url = '';
            
            e.preventDefault();
            
            var formData = new FormData($('#project-form')[0]);
            
            if($("#detail_mode").val() == "add") {
                var url = "{{ route('project.store') }}"
                // url = url.replace(':id', id);   
            }else if($("#detail_mode").val() == "edit") {
                var url = "{{ route('project.update', ':id') }}"
                var id = progresstable.rows( { selected: true } ).data()[0]['project-progressid'];
                url = url.replace(':id', id); 
            }

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                contentType: false,
                processData: false,
                success: (json) => {
                    let success = json.success;
                    let message = json.message;
                    let data = json.data;
                    let errors = json.errors;

                    if (success == 'true' || success == true) {
                            swal.fire("Berhasil!", "Data project berhasil ditambah.", "success");
                            // var rowData = projecttable.rows({ selected: true }).data()[0]; // Get selected row data
                            // var detailpaguanggaranid = rowData.detailpaguanggaranid;
                            // loadproject-progress(detailpaguanggaranid);
                            projecttable.draw();
                            $('#project-form').trigger("reset");
                            $('#modal_project').modal('hide'); 
                    }
                    // else{
                    //     console.log(errors)
                    // }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                        var data = jqXHR.responseJSON;
                        console.log(data);
                        swal.fire("Gagal!", `${data.message}, anda tidak diizinkan untuk mengambil aksi ini!`, "error");
                }
            })
        })

    // store manpower  
    $(document).on('submit', '#manpower-form', function(e){
        e.preventDefault();
        
        var url = ''
        
        var formData = new FormData($('#manpower-form')[0]);

        $.ajax({
            type: 'POST',
            url: "{{ route('project.storeManpower') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: (json) => {
                let success = json.success;
                let message = json.message;
                let data = json.data;
                let errors = json.errors;

                if (success == 'true' || success == true) {
                        swal.fire("Berhasil!", "Berhasil menambah manpower.", "success");
                        var rowData = projecttable.rows({ selected: true }).data()[0]; // Get selected row data
                        var projectid = rowData.projectid;
                        loadManpower(projectid);
                        $('#manpower-form').trigger("reset");
                        $('#modal_manpower').modal('hide'); 
                }
                else{
                    console.log(message)
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                    var data = jqXHR.responseJSON;
                    console.log(data);
                    swal.fire("Gagal!", `${data.message}, anda tidak diizinkan untuk mengambil aksi ini!`, "error");
            }
        })
    })

    // store progress project  
    $(document).on('submit', '#project-progress-form', function(e){
        e.preventDefault();
        
        var url = ''
        
        var formData = new FormData($('#project-progress-form')[0]);

        $.ajax({
            type: 'POST',
            url: "{{ route('project.storeProjectprogess') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: (json) => {
                let success = json.success;
                let message = json.message;
                let data = json.data;
                let errors = json.errors;

                if (success == 'true' || success == true) {
                        swal.fire("Berhasil!", "Berhasil menambah progres project.", "success");
                        var rowData = projecttable.rows({ selected: true }).data()[0]; // Get selected row data
                        var projectid = rowData.projectid;
                        loadProgress(projectid);
                        $('#project-progress-form').trigger("reset");
                        $('#modal-detail-laporan').modal('hide'); 
                }else if (success == false && data == 'lessstock') {
                    swal.fire("Gagal!", message, "error");
                }
                // else{
                //     console.log(errors)
                // }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                    var data = jqXHR.responseJSON;
                    swal.fire("Gagal!", `${data.message}, anda tidak diizinkan untuk mengambil aksi ini!`, "error");
            }
        })
    })


    // store detail jumlah sarpras  
    $(document).on('submit', '#detail-foto-peralatan-form', function(e){
        e.preventDefault();

        var url = ''

        if ($('#detail_foto_mode').val() == 'add') {

            var rowDataJenisPeralatan = detailjumlahtable.rows({ selected: true }).data()[0]; // Get selected row data
            var detailjumlahperalatanid = rowDataJenisPeralatan.detailjumlahperalatanid;

            var url = "{{ route('progresfisik.storeDetailFotoPeralatan', ':id') }}";
            url = url.replace(':id', detailjumlahperalatanid); 
        } else if($('#detail_foto_mode').val() == 'edit'){

            var rowDataFotoPeralatan = fotoEditDetailJenisPeralatan.rows({ selected: true }).data()[0];
            var filedetailjumlahperalatanid = rowDataFotoPeralatan.filedetailjumlahperalatanid;

            var url = "{{ route('progresfisik.updateDetailFotoPeralatan', ':id') }}";
            url = url.replace(':id', filedetailjumlahperalatanid); 
        }
        
        var formData = new FormData($('#detail-foto-peralatan-form')[0]);

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            contentType: false,
            processData: false,
            success: (json) => {
                let success = json.success;
                let message = json.message;
                let data = json.data;
                let errors = json.errors;

                if (success == 'true' || success == true) {
                        swal.fire("Berhasil!", "Berhasil mengubah foto peralatan.", "success");
                        var rowData = detailjumlahtable.rows({ selected: true }).data()[0]; // Get selected row data
                        var detailjumlahperalatanid = rowData.detailjumlahperalatanid;
                        loadEditFotoJenisPeralatan(detailjumlahperalatanid);
                        // detailjumlahtable.draw();
                        $('#detail-foto-peralatan-form').trigger("reset");
                        $('#modal-detail-foto-peralatan').modal('hide'); 

                        const $imgPreview = $('#file').closest('div').find('.param_img_holder');
                        $imgPreview.empty();
                        // $('#file').val('');
                }
                // else{
                //     console.log(errors)
                // }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                    var data = jqXHR.responseJSON;
                    console.log(data.errors);// this will be the error bag.
                    // printErrorMsg(data.errors);
            }
        })
    })

</script>

@endsection
