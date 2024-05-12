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
@php
    $totalS = 0;
    $test = [];
    $varV = [];
@endphp
<div class="row mt-4">
  <div class="col-12">
    <div class="card">
      <div class="card-header bg-gray1" style="border-radius:10px 10px 0px 0px;">
        <div class="row">
          <div class="col-6 mt-1">
            <span class="tx-bold text-lg text-white" style="font-size:1.2rem;">
              <i class="mdi mdi-folder-outline"></i>
              {{ $breadcumb }}
            </span>
          </div>
        </div>

        <div class="row">
          <div class="col-6">
            @include('sweetalert::alert')
          </div>
        </div>
      </div>

      <div class="card-body">
        <table id="example" class="table table-hover table-bordered dt-responsive" style="width:100%">
          <thead>
            <tr>
              <th>No</th>
              <th>Alternatif</th>
              @foreach ($kriteria as $item)
                  <th>{{ $item->nama_kriteria }}</th>
              @endforeach
            </tr>
          </thead>
          <tbody>
            @foreach ($alternatif as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @foreach ($sanggar->where('id',$item->id_sanggar) as $s)
                            {{ $s->nama_sanggar }}
                        @endforeach
                    </td>
                    @foreach ($pembobotan as $bobot)
                        @if ($bobot->id_alternatif == $item->id)
                            <td>{{ $bobot->nilai }}</td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      
    </div>

    <div class="card">
        <div class="card-body">
            <h4 class="subtitle">Bagian 1 : Mencari Nilai W</h4>
            <hr>
            <p>Bobot Tiap Kriteria :</p>
            <p>W = [
                @foreach ($kriteria as $k)
                    {{ $k->bobot.' ,' }}
                @endforeach
                ]
            </p>
            <hr>
            <p>Pembobotan :</p>
            @php
                $b = 1;
            @endphp
            @foreach ($kriteria as $k)
                    <p>W{{ $b++ }} =
                        {{ intval($k->bobot) . '/' . intval($maxkriteria). ' = ' . round(intval($k->bobot) / intval($maxkriteria), 3) }}
                    </p>
            @endforeach

            <hr>
            <p>Normalisasi Berdasarkan Pembobotan :</p>
            @php
                $c = 1
            @endphp
            @foreach ($kriteria as $item)
                <p>W{{$c++}} =
                    @if ($item->status == 'COST')
                        {{round($item->bobot / $maxkriteria,3) * -1}}
                    @else
                        {{round($item->bobot / $maxkriteria,3)}}
                        
                    @endif
                </p>
            @endforeach

            <h4 class="subtitle">Bagian 2 : Mencari Nilai Vector (S)</h4>
            <p>Pembobotan :</p>
            @php
            $d = 1;
            $e = 1;
                $maxkriteria = DB::table('data_kriterias')->select(DB::raw('SUM(bobot) AS Total'))->first()->Total;
            @endphp
            
            @foreach ($alternatif as $item)
                <?php 
                    $test[$e] = 1;
                    $processedIDs = []
                ?>
                S<?= $d++ ?> =
                @foreach ($pembobotan->where('id_alternatif', $item->id) as $bobot)
                    @foreach ($kriteria as $k)
                        @php
                            $nilai = $bobot->nilai;
                            $bagibobot = $kriteria->where('id', $bobot->id_kriteria)->first();
                        @endphp
                        @if (!in_array($bagibobot->id, $processedIDs))
                            @php
                                $processedIDs[] = $bagibobot->id; 
                            @endphp
                            
                            @if ($bagibobot->status == 'COST')
                                ({{ $nilai }}<sup>{{ round($bagibobot->bobot / $maxkriteria, 3) * -1 }}</sup>)
                                <?php 
                                    $test[$e] *= pow($nilai, round($bagibobot->bobot / $maxkriteria, 3) * -1);
                                ?>
                            @else
                                ({{ $nilai }}<sup>{{ round($bagibobot->bobot / $maxkriteria, 3) }}</sup>)
                                <?php 
                                    $test[$e] *= pow($nilai, round($bagibobot->bobot / $maxkriteria, 3));
                                ?>
                            @endif
                        @endif
                       
                    @endforeach
                @endforeach
                = <?= round($test[$e], 3) ?>
               
               <?php $totalS = $totalS + $test[$e] ?>
               <?php $e++ ?>

                <br>
                <br>
            @endforeach
            <hr>
            <h4 class="subtitle">Bagian 3 : Mencari Nilai V (V)</h4>
            @php
                $f = 1;
                $g = 0;
            @endphp
            @foreach ($test as $t)
                <p>V{{ $f++ }} = {{ round($test[$loop->iteration],3). '/' . round($totalS, 3) }}
                    = {{ round(round($test[$loop->iteration],3) / round($totalS,3) , 3) }}
                </p>
            @endforeach
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-gray1" style="border-radius:10px 10px 0px 0px;">
          <div class="row">
            <div class="col-6 mt-1">
              <span class="tx-bold text-lg text-white" style="font-size:1.2rem;">
                <i class="mdi mdi-folder-outline"></i>
                Hasil
              </span>
            </div>
          </div>
        </div>
  
        <div class="card-body">
          <table id="example" class="table table-hover table-bordered dt-responsive" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Alternatif</th>
                <th>Nilai</th>
              </tr>
            </thead>
            <tbody>
                @php
                    $h = 1;
                    $i = 0;
                    $j = 0;
                @endphp
              @foreach ($alternatif as $item)
                @php
                    $varV[$loop->iteration] = 1;
                    $varV[$loop->iteration] = $test[$loop->iteration] / $totalS;
                @endphp
                  <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>
                          @foreach ($sanggar->where('id',$item->id_sanggar) as $s)
                              {{ $s->nama_sanggar }}
                          @endforeach
                      </td>
                      <td>
                        {{ round(round($test[$loop->iteration], 3) / round($totalS, 3),3) }}
                      </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        
      </div>
  </div>
</div>

@endsection

@section('script')
<script>
$('#example').dataTable();
</script>
@endsection