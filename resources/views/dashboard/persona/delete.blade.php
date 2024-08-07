<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalles Participante
        </h2>
    </x-slot>

     <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                 <div class="p-6 bg-white border-b border-gray-200">

    <h1>Detalles Participante : {{$persona->id}}</h1>
    @include('dashboard.fragment._errors-form')
    <br>
    <a1>Para Eliminar a un Participante debe Contactarse con el Comite.</a1>
    <form action="{{route('persona.update', $persona)}}" method="post">
    	@csrf
    	@method("PUT")
    	<label>Registro </label>
    	<input type="text" class="form-control" name="registro" value="{{ old('registro',$persona->registro) }}">

    	<label>Carrera</label>
    	<input type="text" class="form-control" name="carrera" value="{{ old('carrera',$persona->carrera) }}">

    	<label>Carnet de Identidad </label>
    	<input type="text" class="form-control" name="ci" value="{{ old('ci',$persona->ci) }}">

    	<label>Nombres</label>
    	<input type="text" class="form-control" name="nombres" value="{{ old('nombres',$persona->nombres) }}">

    	<label>Apellidos </label>
    	<input type="text" class="form-control" name="apellidos" value="{{ old('apellidos',$persona->apellidos) }}">

    	<label>Fecha Nacimento </label>
    	<input type="date" class="form-control" name="nacimiento" value="{{ old('nacimiento',$persona->nacimiento) }}">

    	<label>Direccion </label>
    	<input type="text" class="form-control" name="direccion" value="{{ old('direccion',$persona->direccion) }}">

    	<label>E-Mail </label>
    	<input type="email" class="form-control" name="email" value="{{ old('email',$persona->email) }}">

    	<label>Celular </label>
    	<input type="text" class="form-control" name="celular" value="{{ old('celular',$persona->celular) }}">

    	<label>Foto </label>
    	<img src="{{ URL::asset('images')}}/{{old('foto',$persona->foto) }}" alt="Foto" width="150" height="160">

    </form>

           		</div>
            </div>
        </div>
    </div>
</x-app-layout>
