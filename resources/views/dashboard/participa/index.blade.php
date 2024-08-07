<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Listado de Participaciones a Eventos
        </h2>
    </x-slot>

     <div class="py-4 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">


    @if((count($participas)>=0 && count($participas)<10)||Auth::user()->isAdmin())
	     <a class="btn btn-primary"" href="{{route('participa.create')}}">Registrar Participacion Evento</a>
	     @if(Auth::user()->isAdmin())
    	 <a class="btn btn-success"" href="{{route('participa.export')}}">Exportar a Excel</a>
    	 @endif
    @endif
    <table class="table">
          <tr>
            <th>Codigo Participacion</th>
            <th>Fecha</th>
            <th>Evento</th>
            <th>Equipo</th>
            <th>Proyecto</th>
            <th>Acciones</th>
          </tr>

         @forelse($participas as $p)
          <tr>
            <td>{{$p->id}}</td>
            <td>{{$p->fecha}}</td>
            <td>{{$p->evento->nombre}} </td>
            <td>{{$p->equipo->id}}-{{$p->equipo->nombre}} </td>
            <td>{{$p->descripcion}}</td>
            <td>
                <a class="btn btn-success" href="{{ route('participa.show', $p ) }}">Ver</a>

           @if($p->estado==0)
             	<a class="btn btn-warning" href="{{ route('participa.edit', $p) }}">Editar</a>
             	@if(Auth::user()->isAdmin())
                <form action="{{ route('participa.destroy', $p) }}" method="post" >
                	@csrf
                	@method("DELETE")
                	<button class="btn btn-danger" type="submit">Eliminar</button>
                </form>

                <a class="btn btn-primary" href="{{ route('participa.confirmar', $p) }}">Confirmar</a>
                @endif
            @else
               <a class="btn btn-primary" href="{{ route('participa.desconfirmar', $p) }}">DesConfirmar</a>
            @endif
            <a class="btn btn-success" href="{{ route('participa.imprimir', $p ) }}">Imprimir</a>
            </td>
          </tr>
          @empty
          <tr>
            <td><p>No hay participaciones</p></td>
          </tr>
          @endforelse

    </table>
	{{$participas->links()}}


           </div>
            </div>
        </div>
    </div>

</x-app-layout>
