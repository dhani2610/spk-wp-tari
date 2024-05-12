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
            <form action="{{ route('data-pembobotan-update', $pembobotan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card-body">
                    @include('components.form-message')
              
                    <div class="form-group mb-3">
                        <label for="name">Alternatif</label>

                        <select class="form-control select2 @error('id_alternatif') is-invalid @enderror" id="id_alternatif" name="id_alternatif" >
                           
                            @foreach ($alternatif as $item)
                                @foreach ($sanggar->where('id',$item->id_sanggar) as $s)
                                    <option value="{{$item->id}}" {{$s->id_alternatif == $item->id ? 'selected' : ''}}>{{ $s->nama_sanggar }}</option>
                                @endforeach
                            @endforeach
                        </select>
                        @error('id_alternatif')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                
                    <div class="form-group mb-3">
                        <label for="name">Kriteria</label>

                        <select class="form-control select2 @error('id_kriteria') is-invalid @enderror" id="id_kriteria" name="id_kriteria" >
                            @foreach ($kriteria as $item)
                                    <option value="{{$item->id}}" {{$pembobotan->id_kriteria == $item->id ? 'selected' : ''}}>{{ $item->nama_kriteria }}</option>
                            @endforeach
                        </select>
                        @error('id_kriteria')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="name">Nilai</label>
                        <input type="number" name="nilai" class="form-control @error('nilai') is-invalid @enderror" placeholder="Nilai untuk setiap Alternatif" value="{{ $pembobotan->nilai }}">

                        @error('nilai')
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