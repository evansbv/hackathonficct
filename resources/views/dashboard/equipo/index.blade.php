<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Listar Equipos
        </h2>
    </x-slot>

     <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
	@if(count($equipos)==0 || Auth::user()->isAdmin())
	   <a class="btn btn-primary"" href="{{route('equipo.create')}}">Registrar Equipo</a>
	@endif
    <table class="table">
          <tr>
            <th>Equipo</th>
            <th>Sigla</th>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th># Participantes</th>
            <th>Acciones</th>
          </tr>
         @forelse($equipos as $e)
          <tr>
            <td>{{$e->id}}</td>
            <td>{{$e->sigla}}</td>
            <td>{{$e->nombre}}</td>
            <td>{{$e->descripcion}}  </td>
            <td>{{$e->cantidad}}</td>
            <td>
            <a class="btn btn-success" href="{{route('equipo.show',$e)}}">Ver</a>
            <a class="btn btn-warning" href="{{route('equipo.edit',$e)}}">Editar</a>
            @if(Auth::user()->isAdmin())
	        <form action="{{route('equipo.destroy',$e)}}" method="post" >
            	@csrf
            	@method("DELETE")
            	<button class="btn btn-danger" type="submit">Eliminar</button>
            </form>
			@endif
            </td>
          </tr>
          @empty
          <tr>
            <td>
               <p>No hay Equipo</p>
            </td>
          </tr>
          @endforelse
    </table>
    {{$equipos->links()}}


           </div>
            </div>
        </div>
    </div>
</x-app-layout>
