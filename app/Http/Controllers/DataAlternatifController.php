<?php

namespace App\Http\Controllers;

use App\Models\DataAlternatif;
use App\Models\DataSanggarTari;
use Illuminate\Http\Request;

class DataAlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Data Alternatif List';
        $data['breadcumb'] = 'Data Alternatif List';
        $data['alternatif'] = DataAlternatif::orderby('id', 'asc')->get();
        $data['sanggar'] = DataSanggarTari::orderby('id', 'asc')->get();

        return view('data-alternatif.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = 'Data Alternatif Create';
        $data['breadcumb'] = 'Data Alternatif Create';
        $data['sanggar'] = DataSanggarTari::orderby('id', 'asc')->get();

        return view('data-alternatif.create', $data);
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
            'kode_alternatif'   => 'required|string',
            'id_sanggar'   => 'required',
        ]);

        $data = new DataAlternatif();
        $data->kode_alternatif = $validateData['kode_alternatif'];
        $data->id_sanggar = $validateData['id_sanggar'];
        $data->save();

        return redirect()->route('data-alternatif-list')->with(['success' => 'Added successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataAlternatif  $dataAlternatif
     * @return \Illuminate\Http\Response
     */
    public function show(DataAlternatif $dataAlternatif)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataAlternatif  $dataAlternatif
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['page_title'] = 'Data Alternatif Edit';
        $data['breadcumb'] = 'Data Alternatif Edit';
        $data['alternatif'] = DataAlternatif::find($id);
        $data['sanggar'] = DataSanggarTari::orderby('id', 'asc')->get();

        return view('data-alternatif.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataAlternatif  $dataAlternatif
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'kode_alternatif'   => 'required|string',
            'id_sanggar'   => 'required',
        ]);

        $data = DataAlternatif::find($id);
        $data->kode_alternatif = $validateData['kode_alternatif'];
        $data->id_sanggar = $validateData['id_sanggar'];
        $data->save();

        return redirect()->route('data-alternatif-list')->with(['success' => 'Edited successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataAlternatif  $dataAlternatif
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      
        $data = DataAlternatif::find($id);
        $data->delete();

        return redirect()->route('data-alternatif-list')->with(['success' => 'Deleted successfully!']);
    }
}
