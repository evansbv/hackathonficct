<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Evento;
use App\Models\Gestion;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->isAdmin()){
            $eventos = Evento::orderBy('inicio', 'DESC')->paginate(10);
            $gestiones = Gestion::latest()->paginate(10);

             return view('dashboard.evento.index',compact('eventos','gestiones'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->isAdmin()){
            $gestiones = Gestion::latest()->paginate(10);

            return view('dashboard.evento.create',compact('gestiones'));
        }
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
            'gestion_id' => "required",
            'nombre' => "required|unique:eventos",
            'descripcion' => "required",
            'documento' => "required",
            'inicio' => "required|unique:eventos",
            'fin' => "required|unique:eventos",
            'cabeza' => "required",
            'pie' => "required",
        ]);
        $validated['estado'] = 1;
        //dd($request->toarray());
        //dd($validated);
        //cabeza
        $filename = time().".".$request["cabeza"]->extension();
        $validated['cabeza'] = $filename;
        //dd($filename);
        $request["cabeza"]->move(public_path("images"),$filename);
        //pie
        $filename = time().".".$request["pie"]->extension();
        $validated['pie'] = $filename;
        //dd($filename);
        $request["pie"]->move(public_path("images"),$filename);
        //dd($validated);
        Evento::create($validated);
        echo "Evento Registrado...";
        return  redirect()->route('evento.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function show(Evento $evento)
    {
        //dd($evento->toarray());
        if(Auth::user()->isAdmin()){
            $gestiones = Gestion::latest()->paginate(10);

            return view('dashboard.evento.show',compact('evento','gestiones'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function edit(Evento $evento)
    {
        if(Auth::user()->isAdmin()){
            $gestiones = Gestion::latest()->paginate(10);
        }
        return view('dashboard.evento.edit',compact('evento','gestiones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evento $evento)
    {
        $validated = $request->validate([
            'gestion_id' => "required",
            'nombre' => "required|unique:eventos,nombre,".$evento->id,
            'descripcion' => "required",
            'documento' => "required",
            'inicio' => "required|unique:eventos,inicio,".$evento->id,
            'fin' => "required|unique:eventos,fin,".$evento->id,
            'cabeza' => "required",
            'pie' => "required",
            'estado' => "required"
        ]);
        //dd($request->toarray());
        //dd($validated);
        //cabeza
        $filename = time().".".$request["cabeza"]->extension();
        $validated['cabeza'] = $filename;
        //dd($filename);
        $request["cabeza"]->move(public_path("images"),$filename);
        sleep(2);
        //pie
        $filename = time().".".$request["pie"]->extension();
        $validated['pie'] = $filename;
        //dd($filename);
        $request["pie"]->move(public_path("images"),$filename);
        //dd($validated);
        $evento->update($validated);
        echo "actualizado...";
        return  redirect()->route('evento.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evento $evento)
    {
        $evento->update(['estado' => ! $evento->estado]);
        echo "eliminar...";
        return  redirect()->route('evento.index');
    }
    public function publicar()
    {
        //$eventos = Evento::where('estado', '=', 0)->get();
        //$evento=$eventos->first();
        $eventos = Evento::orderBy('inicio', 'DESC')->paginate(2);

        //if($evento!=null){
        //dd($evento);
        return view('dashboard.evento.publicar',compact('eventos'));
        //return view('welcome',compact('evento'));
        //}else{
        //     echo "SIN EVENTO";
        //}
    }
}
