<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Registrar Equipo
        </h2>
    </x-slot>

     <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                 <div class="p-6 bg-white border-b border-gray-200">

    <h1>Equipo</h1>
    @include('dashboard.fragment._errors-form')
    <br>
    <form action="{{route('equipo.store')}}" method="post" >
    	@csrf
    	<label>Sigla </label>
    	<input type="text" class="form-control" name="sigla" value="{{ old('sigla') }}">

    	<label>Nombre Equipo</label>
    	<input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}">

    	<label>Descripcion </label>
    	<input type="text" class="form-control" name="descripcion" value="{{ old('descripcion') }}">

    	<label># Participantes</label>
    	<input type="text" class="form-control" name="cantidad" value="{{ old('cantidad') }}">

       <button class="btn btn-success mt-3" type="submit">Registrar</button>
    </form>

           		</div>
            </div>
        </div>
    </div>
</x-app-layout>
