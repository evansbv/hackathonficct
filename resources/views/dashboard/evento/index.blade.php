<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Listar Eventos
        </h2>
    </x-slot>

     <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
	@if(Auth::user()->isAdmin())
	   <a class="btn btn-primary"" href="{{route('evento.create')}}">Registrar Evento</a>
	@endif
    <table class="table">
          <tr>
            <th>Gestion</th>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Inicio</th>
            <th>Fin</th>
            <th>Estado</th>
            <th>Acciones</th>
          </tr>
         @forelse($eventos as $e)
          <tr>
            <td>{{$e->gestion->nombre}}</td>
            <td>{{$e->nombre}}</td>
            <td>{{$e->descripcion}}</td>
            <td>{{$e->inicio}}</td>
            <td>{{$e->fin}}</td>
            <td>{{$e->estado==0? 'Activo': 'Inactivo'}}</td>
            <td>
            <a class="btn btn-success" href="{{route('evento.show',$e)}}">Ver</a>
            <a class="btn btn-warning" href="{{route('evento.edit',$e)}}">Editar</a>
            @if(Auth::user()->isAdmin())
	        <form action="{{route('evento.destroy',$e)}}" method="post" >
            	@csrf
            	@method("DELETE")
            	<button class="btn btn-danger" type="submit">{{$e->estado==1? 'Activar': 'Desactivar'}}</button>
            </form>
			@endif
            </td>
          </tr>
          @empty
          <tr>
            <td>
               <p>No hay Eventos</p>
            </td>
          </tr>
          @endforelse
    </table>
    {{$eventos->links()}}


           </div>
            </div>
        </div>
    </div>
</x-app-layout>
