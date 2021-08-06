<?php

namespace App\Http\Controllers;
use App\Models\historys;
use Illuminate\Http\Request;

class HistorysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $historys = Historys::orderBy('id', 'desc')->paginate(3);
        return view('historys.index', compact('historys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('historys.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
           //validate the request...

           $request->validate([
            'nama' => 'required|unique:historys|max:255',
            'tahun' => 'required|unique:historys|max:255',
        ]);

        $historys = new Historys;
      
        $historys->nama = $request->nama;
        $historys->tahun = $request->tahun;

        $historys->save();

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $history = Historys::where('id', $id)->first();
        return view('historys.show', ['history' => $history]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $history = Historys::where('id', $id)->first();
        return view('historys.edit', ['history' => $history]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|unique:historys|max:255',
            'tahun' => 'required|unique:historys|max:255',
            
        ]);

        Historys::find($id)->update([
            'nama' => $request->nama,
            'tahun' => $request->tahun
        ]);

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Historys::find($id)->delete();
        return redirect('/');
    }
}
