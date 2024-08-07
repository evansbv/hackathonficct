<x-app-layout>

     <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                 <div class="p-6 bg-white border-b border-gray-200">

<table class="table">
<tr>
 <th>

    <div align='center'><h1>FORMULARIO DE INSCRIPCION</h1></div>
    <div align='left'><a2>Codigo Participacion : {{$participa->id}}</a2></div>
    <div align='right'><a2>Fecha : {{$participa->fecha}}</a2></div>
    @include('dashboard.fragment._errors-form')
    <br><div class="title m-b-md" align="right">
       <img src="{{ URL::asset('qrcodes')}}/{{old('foto',$qrfname) }}" alt="Qr">
       {{--<img src="data:image/png;base64,{!! base64_encode(QrCode::format('png')->size(100)->generate("Nro. : $participa->id\nFecha : $participa->fecha\nProyecto : $participa->descripcion\nEquipo : ".$participa->equipo->nombre)) !!}">--}}
    </div>
 </th>
 <tr>
  <td>
    <form action="{{route('participa.update', $participa)}}" method="post">
    	@csrf
    	@method("PUT")

    	<label>Evento</label>
    	@foreach($eventos as $e)
    		@if($e->id == $participa->evento_id)
    		  <input type="text" class="form-control" name="evento_id" value="{{$e->nombre}}">
    		 @endif
    	@endforeach

    	<label>Tematicas</label>
    	@foreach($tematicas as $t)
    		@if($t->id == $participa->tematica_id)
    		  <input type="text" class="form-control" name="tematica_id" value="{{$t->nombre}}">
    		 @endif
    	@endforeach

		<label>Equipo</label>
		@foreach($equipos as $e)
    		@if($e->id == $participa->equipo_id)
    		  <input type="text" class="form-control" name="equipo_id" value="{{$e->nombre}}">
    		 @endif
    	@endforeach

    	<label>Proyecto</label>
    	<input type="text" class="form-control" name="descripcion" value="{{ old('descripcion',$participa->descripcion) }}">

		<label>Personas</label>
    	@foreach($personas as $p)
    		<input type="hidden" class="form-control" name="persona[]" value="{{old('persona[$p->id]',$p->id)}}">
    	@endforeach
    </td>
  </tr>
</table>

    	<table class="table">
          <tr>
            <th>CI</th>
            <th>Registro</th>
            <th>Carrera</th>
            <th>Nombre Completo</th>
            <th>Correo</th>
          </tr>

         @forelse($personas as $p)
          <tr>
            <td>{{$p->ci}}</td>
            <td>{{$p->registro}}</td>
            <td>{{$p->carrera}} </td>
            <td>{{$p->nombres.' '.$p->apellidos}} </td>
            <td>{{$p->email}}</td>
          </tr>
          @empty
          <tr>
            <td><p>No hay participantes</p></td>
          </tr>
          @endforelse

    </table>
    </form>
    @switch($participa->estado)
        @case(1)
            <div align='left'><br><a2>Estado(Edicion=>Confirmado=>Aprobado) : "Confirmado"</a2></div>
            @break
        @case(2)
            <div align='left'><br><a2>Estado(Edicion=>Confirmado=>Aprobado) : "Aprobado"</a2></div>
            @break
        @default
            <div align='left'><br><a2>Estado(Edicion=>Confirmado=>Aprobado) : "Edicion"</a2></div>
	@endswitch

           		</div>
            </div>
        </div>
    </div>
</x-app-layout>
