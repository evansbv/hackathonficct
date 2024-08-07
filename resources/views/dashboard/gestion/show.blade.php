<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalles Gestion
        </h2>
    </x-slot>

     <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                 <div class="p-6 bg-white border-b border-gray-200">

    <h1>Gestion : {{$gestion->id}}</h1>
    @include('dashboard.fragment._errors-form')
    <br>
    <form action="{{route('gestion.update', $gestion)}}" method="post">
    	@csrf
    	@method("PUT")

    	<label>Nombre Gestion</label>
    	<input type="text" class="form-control" name="nombre" value="{{ old('nombre',$gestion->nombre) }}">

    	<label>Descripcion </label>
    	<input type="text" class="form-control" name="descripcion" value="{{ old('descripcion',$gestion->descripcion) }}">

    	<label>Observacion</label>
    	<input type="text" class="form-control" name="observacion" value="{{ old('observacion',$gestion->observacion) }}">

    	<label>Inicio </label>
    	<input type="date" class="form-control" name="inicio" value="{{ old('inicio',$gestion->inicio) }}">

    	<label>Fin </label>
    	<input type="date" class="form-control" name="fin" value="{{ old('fin',$gestion->fin) }}">
    </form>

           		</div>
            </div>
        </div>
    </div>
</x-app-layout>
