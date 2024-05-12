<?php

namespace App\Http\Controllers;

use App\Models\DataSanggarTari;
use Illuminate\Http\Request;

class DataSanggarTariController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Sanggar Tari List';
        $data['breadcumb'] = 'Sanggar Tari List';
        $data['sanggar'] = DataSanggarTari::orderby('id', 'asc')->get();

        return view('data-sanggar.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = 'Sanggar Tari Create';
        $data['breadcumb'] = 'Sanggar Tari Create';

        return view('data-sanggar.create', $data);
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
            'nama_sanggar'   => 'required|string',
        ]);

        $data = new DataSanggarTari();
        $data->nama_sanggar = $validateData['nama_sanggar'];
        $data->save();

        return redirect()->route('sanggar-tari-list')->with(['success' => 'Added successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataSanggarTari  $dataSanggarTari
     * @return \Illuminate\Http\Response
     */
    public function show(DataSanggarTari $dataSanggarTari)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataSanggarTari  $dataSanggarTari
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['page_title'] = 'Sanggar Tari List';
        $data['breadcumb'] = 'Sanggar Tari List';
        $data['sanggar'] = DataSanggarTari::find($id);

        return view('data-sanggar.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataSanggarTari  $dataSanggarTari
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $validateData = $request->validate([
            'nama_sanggar'   => 'required|string',
        ]);

        $data = DataSanggarTari::find($id);
        $data->nama_sanggar = $validateData['nama_sanggar'];
        $data->save();

        return redirect()->route('sanggar-tari-list')->with(['success' => 'Edited successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataSanggarTari  $dataSanggarTari
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $data = DataSanggarTari::find($id);
        $data->delete();

        return redirect()->route('sanggar-tari-list')->with(['success' => 'Delete successfully!']);
    }
}
