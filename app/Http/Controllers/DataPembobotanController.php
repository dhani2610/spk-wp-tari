<?php

namespace App\Http\Controllers;

use App\Models\DataAlternatif;
use App\Models\DataKriteria;
use App\Models\DataPembobotan;
use App\Models\DataSanggarTari;
use Illuminate\Http\Request;

class DataPembobotanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Data Pembobotan List';
        $data['breadcumb'] = 'Data Pembobotan List';
        $data['pembobotan'] = DataPembobotan::orderby('id', 'asc')->get();
        $data['kriteria'] = DataKriteria::orderby('id', 'asc')->get();
        $data['alternatif'] = DataAlternatif::orderby('id', 'asc')->get();
        $data['sanggar'] = DataSanggarTari::orderby('id', 'asc')->get();
        // dd($data);   

        return view('data-pembobotan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = 'Data Pembobotan Create';
        $data['breadcumb'] = 'Data Pembobotan Create';
        $data['kriteria'] = DataKriteria::orderby('id', 'asc')->get();
        $data['alternatif'] = DataAlternatif::orderby('id', 'asc')->get();
        $data['sanggar'] = DataSanggarTari::orderby('id', 'asc')->get();


        return view('data-pembobotan.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'id_alternatif'   => 'required',
            'id_kriteria'   => 'required',
            'nilai'   => 'required',
        ]);

        $data = new DataPembobotan();
        $data->id_alternatif = $validateData['id_alternatif'];
        $data->id_kriteria = $validateData['id_kriteria'];
        $data->nilai = $validateData['nilai'];
        $data->save();

        return redirect()->route('data-pembobotan-list')->with(['success' => 'Added successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataPembobotan  $dataPembobotan
     * @return \Illuminate\Http\Response
     */
    public function show(DataPembobotan $dataPembobotan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataPembobotan  $dataPembobotan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['page_title'] = 'Data Pembobotan Edit';
        $data['breadcumb'] = 'Data Pembobotan Edit';
        $data['pembobotan'] = DataPembobotan::find($id);
        $data['kriteria'] = DataKriteria::orderby('id', 'asc')->get();
        $data['alternatif'] = DataAlternatif::orderby('id', 'asc')->get();
        $data['sanggar'] = DataSanggarTari::orderby('id', 'asc')->get();
        // dd($data);   

        return view('data-pembobotan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataPembobotan  $dataPembobotan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'id_alternatif'   => 'required',
            'id_kriteria'   => 'required',
            'nilai'   => 'required',
        ]);

        $data = DataPembobotan::find($id);
        $data->id_alternatif = $validateData['id_alternatif'];
        $data->id_kriteria = $validateData['id_kriteria'];
        $data->nilai = $validateData['nilai'];
        $data->save();

        return redirect()->route('data-pembobotan-list')->with(['success' => 'Edited successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataPembobotan  $dataPembobotan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = DataPembobotan::find($id);
        $data->delete();

        return redirect()->route('data-pembobotan-list')->with(['success' => 'Deleted successfully!']);
    }
}
