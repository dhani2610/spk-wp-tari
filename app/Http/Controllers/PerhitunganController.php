<?php

namespace App\Http\Controllers;

use App\Models\DataAlternatif;
use App\Models\DataKriteria;
use App\Models\DataPembobotan;
use App\Models\DataSanggarTari;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerhitunganController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Perhitungan';
        $data['breadcumb'] = 'Perhitungan';
        $data['sanggar'] = DataSanggarTari::orderby('id', 'asc')->get();
        $data['pembobotan'] = DataPembobotan::orderby('id', 'asc')->get();
        $data['kriteria'] = DataKriteria::orderby('id', 'asc')->get();
        $data['alternatif'] = DataAlternatif::orderby('id', 'asc')->get();
        $data['maxkriteria'] = DataKriteria::orderby('id', 'asc')->get()->sum('bobot');
      
        return view('perhitungan.index', $data);
    }
}
