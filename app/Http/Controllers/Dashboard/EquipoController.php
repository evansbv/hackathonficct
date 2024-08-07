<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Equipo;
use Illuminate\Support\Facades\Auth;

class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->isAdmin())
            $equipos = Equipo::latest()->paginate(10);
       else{
           $equipos = Equipo::latest()->where('user_id', '=', Auth::id())
                               ->paginate(10);
       }
       return view('dashboard.equipo.index',compact('equipos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.equipo.create');
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
            'sigla' => "required|unique:equipos",
            'nombre' => "required|unique:equipos",
            'descripcion' => "required",
            'cantidad' => "required",
        ]);
        $validated['user_id'] = Auth::id();
        //dd($validated);
        Equipo::create($validated);
        echo "Equipo Registrado...";
        return  redirect()->route('equipo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function show(Equipo $equipo)
    {
        return view('dashboard.equipo.show',compact('equipo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipo $equipo)
    {
        return view('dashboard.equipo.edit',compact('equipo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipo $equipo)
    {
        $validated = $request->validate([
            'sigla' => "required|unique:equipos,sigla,".$equipo->id,
            'nombre' => "required|unique:equipos,nombre,".$equipo->id,
            'descripcion' => "required",
            'cantidad' => "required",
        ]);
        $equipo->update($validated);
        echo "actualizado...";
        return  redirect()->route('equipo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipo $equipo)
    {
        $equipo->delete();
        echo "eliminado...";
        return  redirect()->route('equipo.index');
    }
}
