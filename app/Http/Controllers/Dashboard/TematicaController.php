<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Tematica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TematicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->isAdmin()){
            $tematicas = Tematica::latest()->paginate(10);

            return view('dashboard.tematica.index',compact('tematicas'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.tematica.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => "required|unique:tematicas",
            'descripcion' => "required",
            'documento' => "required",
            'cabeza' => "required",
        ]);
        $validated['estado'] = 1;
        //dd($request->toarray());
        //dd($validated);
        //cabeza
        $filename = time().".".$request["cabeza"]->extension();
        $validated['cabeza'] = $filename;
        //dd($filename);
        $request["cabeza"]->move(public_path("images"),$filename);
        //dd($validated);
        Tematica::create($validated);
        echo "Tematica Registrado...";
        return  redirect()->route('tematica.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tematica  $tematica
     * @return \Illuminate\Http\Response
     */
    public function show(Tematica $tematica)
    {
        return view('dashboard.tematica.show',compact('tematica'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tematica  $tematica
     * @return \Illuminate\Http\Response
     */
    public function edit(Tematica $tematica)
    {
        return view('dashboard.tematica.edit',compact('tematica'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tematica  $tematica
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tematica $tematica)
    {
        $validated = $request->validate([
            'nombre' => "required|unique:tematicas,nombre,".$tematica->id,
            'descripcion' => "required",
            'documento' => "required",
            'cabeza' => "required",
            'estado' => "required"
        ]);
        //dd($request->toarray());
        //dd($validated);
        //cabeza
        $filename = time().".".$request["cabeza"]->extension();
        $validated['cabeza'] = $filename;
        //dd($filename);
        $request["cabeza"]->move(public_path("images"),$filename);
        //dd($validated);
        $tematica->update($validated);
        echo "actualizado...";
        return  redirect()->route('tematica.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tematica  $tematica
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tematica $tematica)
    {
        $tematica->update(['estado' => ! $tematica->estado]);
        echo "eliminar...";
        return  redirect()->route('tematica.index');
    }
}
