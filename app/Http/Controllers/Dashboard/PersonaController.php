<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Persona;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Charts\MyChart;

use App\Exports\PersonasExport;
use Maatwebsite\Excel\Facades\Excel;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->isAdmin())
            $personas = Persona::latest()->paginate(10);
        else{
            $personas = Persona::latest()->where('user_id', '=', Auth::id())
                                ->paginate(10);
        }
        //dd($personas->toarray());
        return view('dashboard.persona.index',compact('personas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.persona.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        //echo $request->input('registro');
        $persona = Persona::where('registro', '=', $request["registro"])->first();
        if($persona!=null){
            echo "Encontrado...";
            return  redirect()->route('persona.edit',['persona'=>$persona]);
            //return view('dashboard.persona.edit',compact('persona'));
        }
        else{
            echo "NO Encontrado...";
            $validated = $request->validate([
                'registro' => "required|unique:personas",
                'carrera' => "required",
                'ci' => "required|unique:personas",
                'nombres' => "required",
                'apellidos' => "required",
                'nacimiento' => "required",
                'direccion' => "required",
                'email' => "required|unique:personas",
                'celular' => "required",
                'foto' => "required",
            ]);
            $validated['user_id'] = Auth::id();
            //dd(Auth::id());
            //dd($validated);
            $filename = time().".".$request["foto"]->extension();
            $validated['foto'] = $filename;
            //dd($filename);
            $request["foto"]->move(public_path("images"),$filename);
            Persona::create($validated);
            echo "Registrado...";
            return  redirect()->route('persona.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function show(Persona $persona)
    {
        //return "Mostrar Persona"."<br>".$persona;
        return view('dashboard.persona.show',compact('persona'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function edit(Persona $persona)
    {
        //return "Editar Persona"."<br>".$persona;
        return view('dashboard.persona.edit',compact('persona'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Persona $persona)
    {
        $validated = $request->validate([
            'registro' => "required|unique:personas,registro,".$persona->id,
            'carrera' => "required",
            'ci' => "required|unique:personas,ci,".$persona->id,
            'nombres' => "required",
            'apellidos' => "required",
            'nacimiento' => "required",
            'direccion' => "required",
            'email' => "required|unique:personas,email,".$persona->id,
            'celular' => "required",
            'foto' => "required|mimes:jpeg,jpg,png|max:5120",
        ]);
        //dd($validated['foto']);
        //dd($persona->foto);
        $validated['user_id'] = Auth::id();
        Storage::disk("public_upload")->delete("images/".$persona->foto);
        //Storage::delete("images/".$persona->foto);
        $filename = time().".".$request["foto"]->extension();
        $validated['foto'] = $filename;
        //dd($filename);
        $request["foto"]->move(public_path("images"),$filename);
        //dd($validated);
        $persona->update($validated);
        echo "actualizado...";
        return  redirect()->route('persona.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function destroy(Persona $persona)
    {
        $persona->delete();
        echo "eliminado...";
        return  redirect()->route('persona.index');
        //return view('dashboard.persona.delete',compact('persona'));
    }
    public function estadistica(){
        $chart = new MyChart();
        $chart = $chart->My_Chart();
        return view('dashboard.persona.estadistica',compact('chart'));
        //$chart = new Chart();
        //return view('dashboard.persona.estadistica',['chart'=> $chart]);

    }
    public function export()
    {
        return Excel::download(new PersonasExport, 'personas.xlsx');
    }
}
