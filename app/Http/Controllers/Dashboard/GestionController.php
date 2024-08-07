<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Gestion;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class GestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->isAdmin()){
            $gestiones = Gestion::latest()->paginate(10);
        }
        return view('dashboard.gestion.index',compact('gestiones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.gestion.create');
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
            'nombre' => "required|unique:gestions",
            'descripcion' => "required",
            'observacion' => "",
            'inicio' => "required|unique:gestions",
            'fin' => "required|unique:gestions",
        ]);
        $validated['estado'] = 1;
        //dd($validated);
        Gestion::create($validated);
        echo "Gestion Registrada...";
        return  redirect()->route('gestion.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gestion  $gestion
     * @return \Illuminate\Http\Response
     */
    public function show(Gestion $gestion)
    {
        return view('dashboard.gestion.show',compact('gestion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gestion  $gestion
     * @return \Illuminate\Http\Response
     */
    public function edit(Gestion $gestion)
    {
        return view('dashboard.gestion.edit',compact('gestion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gestion  $gestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gestion $gestion)
    {
        $validated = $request->validate([
            'nombre' => "required|unique:gestions,nombre,".$gestion->id,
            'descripcion' => "required",
            'observacion' => "required",
            'inicio' => "required|unique:gestions,inicio,".$gestion->id,
            'fin' => "required|unique:gestions,fin,".$gestion->id,
        ]);
        $gestion->update($validated);
        echo "actualizado...";
        return  redirect()->route('gestion.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gestion  $gestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gestion $gestion)
    {
        Gestion::where('estado', '0')->update(['estado' => 1]);
        $gestion->update(['estado' => ! $gestion->estado]);
        echo "eliminar...";
        return  redirect()->route('gestion.index');
    }
}
