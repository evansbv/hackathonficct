<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Listar Gestiones
        </h2>
    </x-slot>

     <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
	@if(Auth::user()->isAdmin())
	   <a class="btn btn-primary"" href="{{route('gestion.create')}}">Registrar Gestion</a>
	@endif
    <table class="table">
          <tr>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Observacion</th>
            <th>Inicio</th>
            <th>Fin</th>
            <th>Estado</th>
            <th>Acciones</th>
          </tr>
         @forelse($gestiones as $g)
          <tr>
            <td>{{$g->nombre}}</td>
            <td>{{$g->descripcion}}  </td>
            <td>{{$g->observacion}}</td>
            <td>{{$g->inicio}}</td>
            <td>{{$g->fin}}</td>
            <td>{{$g->estado==0? 'Activo': 'Inactivo'}}</td>
            <td>
            <a class="btn btn-success" href="{{route('gestion.show',$g)}}">Ver</a>
            <a class="btn btn-warning" href="{{route('gestion.edit',$g)}}">Editar</a>
            @if(Auth::user()->isAdmin())
	        <form action="{{route('gestion.destroy',$g)}}" method="post" >
            	@csrf
            	@method("DELETE")
            	<button class="btn btn-danger" type="submit">{{$g->estado==1? 'Activar': 'Desactivar'}}</button>
            </form>
			@endif
            </td>
          </tr>
          @empty
          <tr>
            <td>
               <p>No hay Gestiones</p>
            </td>
          </tr>
          @endforelse
    </table>
    {{$gestiones->links()}}


           </div>
            </div>
        </div>
    </div>
</x-app-layout>
