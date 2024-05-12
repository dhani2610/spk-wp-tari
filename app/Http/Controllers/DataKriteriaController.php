<?php

namespace App\Http\Controllers;

use App\Models\DataKriteria;
use Illuminate\Http\Request;

class DataKriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Data Kriteria List';
        $data['breadcumb'] = 'Data Kriteria List';
        $data['kriteria'] = DataKriteria::orderby('id', 'asc')->get();

        return view('data-kriteria.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = 'Data Kriteria Create';
        $data['breadcumb'] = 'Data Kriteria Create';

        return view('data-kriteria.create', $data);
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
            'kode_kriteria'   => 'required',
            'nama_kriteria'   => 'required',
            'bobot'   => 'required',
            'status'   => 'required',
        ]);

        $data = new DataKriteria();
        $data->kode_kriteria = $validateData['kode_kriteria'];
        $data->nama_kriteria = $validateData['nama_kriteria'];
        $data->bobot = $validateData['bobot'];
        $data->status = $validateData['status'];
        $data->save();

        return redirect()->route('data-kriteria-list')->with(['success' => 'Added successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataKriteria  $dataKriteria
     * @return \Illuminate\Http\Response
     */
    public function show(DataKriteria $dataKriteria)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataKriteria  $dataKriteria
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['page_title'] = 'Data Kriteria Edit';
        $data['breadcumb'] = 'Data Kriteria Edit';
        $data['kriteria'] = DataKriteria::find($id);

        return view('data-kriteria.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataKriteria  $dataKriteria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'kode_kriteria'   => 'required',
            'nama_kriteria'   => 'required',
            'bobot'   => 'required',
            'status'   => 'required',
        ]);

        $data = DataKriteria::find($id);
        $data->kode_kriteria = $validateData['kode_kriteria'];
        $data->nama_kriteria = $validateData['nama_kriteria'];
        $data->bobot = $validateData['bobot'];
        $data->status = $validateData['status'];
        $data->save();

        return redirect()->route('data-kriteria-list')->with(['success' => 'Edited successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataKriteria  $dataKriteria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = DataKriteria::find($id);
        $data->delete();

        return redirect()->route('data-kriteria-list')->with(['success' => 'Deleted successfully!']);
    }
}
