<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Listar Participantes
        </h2>
    </x-slot>

     <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
    @if((count($personas)>=0 && count($personas)<4)||Auth::user()->isAdmin())
	<a class="btn btn-primary"" href="{{route('persona.create')}}">Registrar Participante</a>
		 @if(Auth::user()->isAdmin())
    	  <a class="btn btn-success"" href="{{route('persona.export')}}">Exportar a Excel</a>
    	 @endif
	@endif
    <table class="table">
          <tr>
            <th>Registro</th>
            <th>Carrera</th>
            <th>Nombre Completo</th>
            <th>Celular</th>
            <th>Correo</th>
            <th>Acciones</th>
          </tr>
         @forelse($personas as $p)
          <tr>
            <td>{{$p->registro}}</td>
            <td>{{$p->carrera}}</td>
            <td>{{$p->nombres}} {{$p->apellidos}} </td>
            <td>{{$p->celular}}</td>
            <td>{{$p->email}}</td>
            <td>
            <a class="btn btn-success" href="{{route('persona.show',$p)}}">Ver</a>
            <a class="btn btn-warning" href="{{route('persona.edit',$p)}}">Editar</a>
            @if(Auth::user()->isAdmin())
            <form action="{{route('persona.destroy',$p)}}" method="post" >
            	@csrf
            	@method("DELETE")
            	<button class="btn btn-danger" type="submit">Eliminar</button>
            </form>
			@endif
            </td>
          </tr>
          @empty
          <tr>
            <td><p>No hay participantes</p></td>
          </tr>
          @endforelse
    </table>
    {{$personas->links()}}


           </div>
            </div>
        </div>
    </div>
</x-app-layout>
