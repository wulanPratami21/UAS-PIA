<?php

namespace App\Http\Controllers;
use App\Models\usahas;
use Illuminate\Http\Request;

class UsahasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usahas = Usahas::orderBy('id', 'desc')->paginate(3);
        return view('usahas.index', compact('usahas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usahas.create');
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
            'pt' => 'required|unique:usahas|max:255',
            'bagian' => 'required|unique:usahas|max:255',
            'tahun' => 'required|unique:usahas|max:255',
        ]);

        $usahas = new usahas;
      
        $usahas->pt = $request->pt;
        $usahas->bagian = $request->bagian;
        $usahas->tahun = $request->tahun;

        $usahas->save();

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
        $usaha = Usahas::where('id', $id)->first();
        return view('usahas.show', ['usaha' => $usaha]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usaha = Usahas::where('id', $id)->first();
        return view('usahas.edit', ['usaha' => $usaha]);
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
            'pt' => 'required|unique:usahas|max:255',
            'bagian' => 'required|unique:usahas|max:255',
            'tahun' => 'required|unique:usahas|max:255',
            
        ]);

        Usahas::find($id)->update([
            'pt' => $request->pt,
            'bagian' => $request->bagian,
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
        Usahas::find($id)->delete();
        return redirect('/');
    }
}
