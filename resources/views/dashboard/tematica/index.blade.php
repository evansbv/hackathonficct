<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Listar Tematicas
        </h2>
    </x-slot>

     <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
	@if(Auth::user()->isAdmin())
	   <a class="btn btn-primary"" href="{{route('tematica.create')}}">Registrar Tematica</a>
	@endif
    <table class="table">
          <tr>
            <th>Numero</th>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Estado</th>
            <th>Acciones</th>
          </tr>
         @forelse($tematicas as $t)
          <tr>
            <td>{{$t->id}}</td>
            <td>{{$t->nombre}}</td>
            <td>{!!$t->descripcion!!}</td>
            <td>{{$t->estado==0? 'Activo': 'Inactivo'}}</td>
            <td>
            <a class="btn btn-success" href="{{route('tematica.show',$t)}}">Ver</a>
            <a class="btn btn-warning" href="{{route('tematica.edit',$t)}}">Editar</a>
            @if(Auth::user()->isAdmin())
	        <form action="{{route('tematica.destroy',$t)}}" method="post" >
            	@csrf
            	@method("DELETE")
            	<button class="btn btn-danger" type="submit">{{$t->estado==1? 'Activar': 'Desactivar'}}</button>
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
    {{$tematicas->links()}}


           </div>
            </div>
        </div>
    </div>
</x-app-layout>
