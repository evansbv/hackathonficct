<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Evento;
use App\Models\Tematica;
use App\Models\Equipo;
use App\Models\Persona;
use Illuminate\Support\Facades\DB;
use PDF;

use App\Models\Participa;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

use App\Exports\ParticipasExport;
use Maatwebsite\Excel\Facades\Excel;


class ParticipaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Acceso mediante la relaciones
        //dd(Auth::user()->personas()->first()->toarray());//todos los datos de la 1er persona
        //dd(Auth::user()->personas()->first()->id);//el id de la 1er persona
        //dd(Auth::user()->equipo()->first()->toarray());//todos los datos de la 1er equipo
        //dd(Auth::user()->equipo()->first()->sigla);//sigla del 1er equipo
        /*$participas = DB::table('participas')
        ->where('participas.equipo_id',Auth::user()->equipo()->first()->id)
        ->join('eventos', 'participas.evento_id', '=', 'eventos.id')
        ->join('tematicas', 'participas.tematica_id', '=', 'tematicas.id')
        //->select('equipo_id.id', 'eventos.nombre', 'tematica.nombre')
        ->get();*/
        //dd($participas);
        //$equipos=Auth::user()->equipo()->first();
        //dd($equipos->toarray());
        //$personas=Auth::user()->personas();
        //dd($personas->first()->toarray());
        if(Auth::user()->isAdmin()){
            //$participas = Participa::join('eventos', 'participas.evento_id', '=', 'eventos.id') ->where('eventos.estado', '=', 0)->paginate(10);
            $participas = Participa::join('eventos', 'participas.evento_id', '=', 'eventos.id')->select('participas.*', 'eventos.nombre')->where('eventos.estado', '=', 0)->paginate(10);
            //dd($participas->toarray());
        }
        else{
            if(Auth::user()->equipo()->first()!=null)
                $participas = Participa::where('equipo_id', '=', Auth::user()->equipo()->first()->id)
                                         ->paginate(10);
            else{
                $msg="Debes Registrar un Equipo...";
                $ruta='equipo.index';
                return  redirect()->route('participa.mensaje',['msg'=>$msg,'ruta'=>$ruta]);
            }
        }

        return view('dashboard.participa.index',compact('participas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if(Auth::user()->isAdmin()){
            $tematicas = Tematica::get();
            $eventos = Evento::get();
            $equipos = Equipo::get();
            $personas = Persona::get();
        }
        else{
            $tematicas = Tematica::where('estado', '=', 0)->get();
            $eventos = Evento::where('estado', '=', 0)->get();
            $equipos = Equipo::where('user_id', '=', Auth::id())->get();
            $personas = Persona::where('user_id', '=', Auth::id())->get();
            //dd($personas);
            //dd(Auth::user()->personas()->first());
            if(Auth::user()->personas()->first()==null){
                $msg="Debes Registrar al menos un Participante...";
                $ruta='persona.index';
                return  redirect()->route('participa.mensaje',['msg'=>$msg,'ruta'=>$ruta]);
            }

        }
        //dd($personas);
        //dd($equipos->get());
        //dd(Equipo::where('user_id', '=', Auth::user()->id)->toSql());
        //dd(Auth::user()->equipo());
        //$equipos = Equipo::get();
        $qrfname='nuevo.png';
        $qrtext='https://hackathon.ficct.uagrm.edu.bo/';
        QrCode::format('png')->size(100)->merge('images/logoficct.png',.2,true)->generate($qrtext,'qrcodes/'.$qrfname);
        //QrCode::format('png')->size(100)->generate($qrtext,'qrcodes/'.$qrfname);
        return view('dashboard.participa.create',compact('eventos','tematicas','equipos','personas','qrfname'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $validated = $request->validate([
            //'evento_id' => "required|unique:participas,evento_id,".$request->evento_id."|unique:participas,equipo_id,".$request->equipo_id,
            'evento_id' => "required",
            'equipo_id'  => "required",
            'tematica_id' => "required",
            'descripcion' => "required"
        ],
        [
            'equipo_id.unique'=>'Este Equipo ya esta Registrado para este Evento.',
        ]);
        $validated['fecha'] = date('Y-m-d h:m:s');
        $validated['user_id'] = Auth::id();
        //dd($validated);
        //dd($request->persona);
            foreach($request->persona as $persona_id){
                $equipo_id=$validated['equipo_id'];
                //$sql="'INSERT INTO equipos_personas (equipo_id,persona_id,created_at,updated_at) VALUES (?, ?, ?, ?)', [$equipo_id,$persona_id,  \Carbon\Carbon::now(), \Carbon\Carbon::now()]);" ;
                DB::insert('INSERT INTO equipos_personas (equipo_id,persona_id,created_at,updated_at) VALUES (?, ?, ?, ?)', [$equipo_id,$persona_id,  \Carbon\Carbon::now(), \Carbon\Carbon::now()]);
                //echo $sql.'<br>';
            }
            //echo $sql.'<br>';
            //DB::insert($sql);

        Participa::create($validated);
        echo "Paricipacion Registrada...";
        return  redirect()->route('participa.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Participa  $participa
     * @return \Illuminate\Http\Response
     */
    public function show(Participa $participa)
    {
        $tematicas = Tematica::get();
        if(Auth::user()->isAdmin()){
            $eventos = Evento::get();
            $equipos = Equipo::get();
            //$equipos = Equipo::where('user_id', '=', $participa->id)->get();
            //dd($equipos->toarray());
            //$personas = Persona::get();
            $personas = Persona::where('user_id', '=', $participa->user_id)->get();
            //dd($personas->toarray());
             //dd($participa);
        }
        else{
            $eventos = Evento::get();
            $equipos = Equipo::where('user_id', '=', Auth::id())->get();
            $personas = Persona::where('user_id', '=', Auth::id())->get();
        }
        $qrfname="$participa->id.png";
        $qrtext="Codigo Participacion : $participa->id\nFecha : $participa->fecha\nProyecto : $participa->descripcion\nEquipo : ".$participa->equipo->nombre;
        QrCode::format('png')->size(100)->merge('images/logoficct.png',.2,true)->generate($qrtext,'qrcodes/'.$qrfname);
        return view('dashboard.participa.show',compact('participa','eventos','tematicas','equipos','personas','qrfname'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Participa  $participa
     * @return \Illuminate\Http\Response
     */
    public function edit(Participa $participa)
    {
        $tematicas = Tematica::get();
        if(Auth::user()->isAdmin()){
            $eventos = Evento::get();
            $equipos = Equipo::get();
            //$personas = Persona::get();
            $personas = Persona::where('user_id', '=', $participa->user_id)->get();
        }
        else{
            $eventos = Evento::where('estado', '=', 0)->get();
            $equipos = Equipo::where('user_id', '=', Auth::id())->get();
            $personas = Persona::where('user_id', '=', Auth::id())->get();
        }
        $qrfname="$participa->id.png";
        $qrtext="Codigo Participacion : $participa->id\nFecha : $participa->fecha\nProyecto : $participa->descripcion\nEquipo : ".$participa->equipo->nombre;
        QrCode::format('png')->size(100)->merge('images/logoficct.png',.2,true)->generate($qrtext,'qrcodes/'.$qrfname);

        return view('dashboard.participa.edit',compact('participa','eventos','tematicas','equipos','personas','qrfname'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Participa  $participa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Participa $participa)
    {
        $validated = $request->validate([
            'equipo_id'  => "required|unique:participas,equipo_id,".$participa->id,
            'evento_id' => "required",
            'tematica_id' => "required",
            'descripcion' => "required"
        ]);
        $validated['fecha'] = date('Y-m-d h:m:s');
        $validated['user_id'] = Auth::id();
        //dd($validated);
        $equipo_id=$validated['equipo_id'];
        DB::table('equipos_personas')->where('equipo_id', $equipo_id)->delete();
        foreach($request->persona as $persona_id){
            $equipo_id=$validated['equipo_id'];
            $sql="'INSERT INTO equipos_personas (equipo_id,persona_id,created_at,updated_at) VALUES (?, ?, ?, ?)', [$equipo_id,$persona_id,  \Carbon\Carbon::now(), \Carbon\Carbon::now()]);" ;
            DB::insert('INSERT INTO equipos_personas (equipo_id,persona_id,created_at,updated_at) VALUES (?, ?, ?, ?)', [$equipo_id,$persona_id,  \Carbon\Carbon::now(), \Carbon\Carbon::now()]);
            //echo $sql.'<br>';
        }


        $participa->update($validated);
        echo "Paricipacion Actualizada...";
        return  redirect()->route('participa.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Participa  $participa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Participa $participa)
    {
        $eq=DB::table('equipos_personas')->where('equipo_id',$participa->equipo_id);
        //dd($eq);
        $eq->delete();
        $participa->delete();
        echo "eliminado...";
        return  redirect()->route('participa.index');
    }

    public function mensaje($msg,$ruta)
    {
        //echo $msg,' ',$ruta;
        return view('dashboard.participa.mensaje',compact('msg','ruta'));
    }
    public function confirmar(Participa $participa)
    {
        $validated['estado'] = '1';
        //dd($validated);
        $participa->update($validated);
        echo "Confirmado...";
        return  redirect()->route('participa.index');
    }
    public function desconfirmar(Participa $participa)
    {
        $validated['estado'] = '0';
        //dd($validated);
        $participa->update($validated);
        echo "DesConfirmado...";
        return  redirect()->route('participa.index');
    }
    public function imprimir(Participa $participa)
    {
        $tematicas = Tematica::get();
        if(Auth::user()->isAdmin()){
            $eventos = Evento::get();
            $equipos = Equipo::get();
            //$personas = Persona::get();
            $personas = Persona::where('user_id', '=', $participa->user_id)->get();
            //dd($participa);
            //dd($personas);
        }
        else{
            $eventos = Evento::where('estado', '=', 0)->get();
            $equipos = Equipo::where('user_id', '=', Auth::id())->get();
            $personas = Persona::where('user_id', '=', Auth::id())->get();
        }
        $qrfname="$participa->id.png";
        $qrtext="Codigo Participacion : $participa->id\nFecha : $participa->fecha\nProyecto : $participa->descripcion\nEquipo : ".$participa->equipo->nombre;
        QrCode::format('png')->size(100)->merge('images/logoficct.png',.2,true)->generate($qrtext,'qrcodes/'.$qrfname);

        $data = [
            'title' => 'Bienvenido a la Hackathon',
            'date' => date('m/d/Y'),
            'eventos' => $eventos,
            'equipos' => $equipos,
            'tematicas' => $tematicas,
            'participa' => $participa,
            'personas' => $personas,
            'qrfname' => $qrfname
        ];
        $pdf = PDF::loadView('dashboard.participa.imprimir',$data);

        return $pdf->download('confirma-participacion.pdf');
        //echo "Imprimir Formulario...";
        //return  redirect()->route('participa.index');
    }
    public function export()
    {
        return Excel::download(new ParticipasExport, 'participaciones.xlsx');
    }
}
