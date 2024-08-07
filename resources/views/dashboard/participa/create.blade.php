<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Registrar Participacion a Evento
        </h2>
    </x-slot>

     <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                 <div class="p-6 bg-white border-b border-gray-200">



    <center><h1>FORMULARIO DE INSCRIPCION</h1></center>
    @include('dashboard.fragment._errors-form')
    <br><div class="title m-b-md" align="right">
      <img src="{{ URL::asset('qrcodes')}}/{{old('foto',$qrfname) }}" alt="Qr" >
   </div>
    <form action="{{route('participa.store')}}" method="post" >
    	@csrf

    	<label>Evento</label>
    	<select class="form-control" name="evento_id">
    		<option value=""></option>
    		@foreach($eventos as $e)
    			<option {{$e->id == old('evento_id') ? 'selected' : ''}} value="{{$e->id}}">{{$e->nombre}}</option>
    		@endforeach
    	</select>

    	<label>Tematicas</label>
    	<select class="form-control" name="tematica_id">
    		<option value=""></option>
    		@foreach($tematicas as $t)
    			<option {{$t->id == old('tematica_id') ? 'selected' : ''}} value="{{$t->id}}">{{$t->nombre}}</option>
    		@endforeach
    	</select>
    	<label>Equipo</label>
    	<select class="form-control" name="equipo_id">
    		<option value=""></option>
    		@foreach($equipos as $e)
    			<option {{$e->id == old('equipo_id') ? 'selected' : ''}} value="{{$e->id}}">{{$e->nombre}}</option>
    		@endforeach
    	</select>

    	<label>Proyecto</label>
    	<input type="text" class="form-control" name="descripcion" value="{{ old('descripcion') }}">

		<label>Personas</label>
    	@foreach($personas as $p)
    		<input type="hidden" class="form-control" name="persona[]" value="{{old('persona[$p->id]',$p->id)}}">
    	@endforeach
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


       <button class="btn btn-success mt-3" type="submit">Registrar Participacion en Evento</button>
    </form>

           		</div>
            </div>
        </div>
    </div>
</x-app-layout>
