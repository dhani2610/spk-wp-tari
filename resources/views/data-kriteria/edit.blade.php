@extends('layouts.app')

@section('style')

@endsection

@section('breadcumb')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">{{ ($breadcumb ?? '') }}</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">home</li>
                    <li class="breadcrumb-item">/</li>
                    <li class="breadcrumb-item"><a href="{{ route('master-data.index') }}">Master Data</a></li>
                    <li class="breadcrumb-item">/</li>
                    <li class="breadcrumb-item active"><a href="{{ route('users.index') }}">{{ ($breadcumb ?? '') }}</a></li>
                </ol>
            </div>

        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header text-center bg-gray1" style="border-radius:10px 10px 0px 0px;">
                <h3 class="card-title text-white">
                  {{ $breadcumb }}
                </h3>
            </div>
            <form action="{{ route('data-kriteria-update', $kriteria->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card-body">
                    @include('components.form-message')
              
                    <div class="form-group mb-3">
                        <label for="name">Kode Kriteria</label>
                        <input type="text" class="form-control @error('kode_kriteria') is-invalid @enderror" id="kode_kriteria" name="kode_kriteria" value="{{ old('kode_kriteria') ?? $kriteria->kode_kriteria }}"  placeholder="Enter ">

                        @error('kode_kriteria')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="name">Nama Kriteria</label>
                        <input type="text" class="form-control @error('nama_kriteria') is-invalid @enderror" id="nama_kriteria" name="nama_kriteria" value="{{ old('nama_kriteria') ?? $kriteria->nama_kriteria }}"  placeholder="Enter ">

                        @error('nama_kriteria')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="name">Bobot</label>
                        <input type="number" class="form-control @error('bobot') is-invalid @enderror" id="bobot" name="bobot" value="{{ old('bobot') ?? $kriteria->bobot }}"  placeholder="Enter ">

                        @error('bobot')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
          

                    <div class="form-group mb-3">
                        <label>Status</label>
                        <select class="form-control @error('status') is-invalid @enderror" name="status">
                            <option value="COST" {{ $kriteria->status == 'COST' ? 'selected' : '' }}>COST</option>
                            <option value="BENEFIT" {{ $kriteria->status == 'BENEFIT' ? 'selected' : '' }}>BENEFIT</option>
                        </select>
                        @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer bg-gray1" style="border-radius:0px 0px 10px 10px;">
                    <button type="submit" class="btn btn-success btn-footer">Save</button>
                </div>
            </form>
        </div>
    </div>


</div>
@endsection

@section('script')

@endsection