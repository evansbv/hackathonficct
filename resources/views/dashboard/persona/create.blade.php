<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Registrar Participante
        </h2>
    </x-slot>

     <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                 <div class="p-6 bg-white border-b border-gray-200">


    <h1>Registrar Participante</h1>
    @include('dashboard.fragment._errors-form')
    <br>
    <form action="{{route('persona.store')}}" method="post" enctype="multipart/form-data">
    	@csrf
    	<label>Registro </label>
    	<input type="text" class="form-control" name="registro" value="{{ old('registro') }}" placeholder="2120001122">

    	<label>Carrera</label>
    	<input type="text" class="form-control" name="carrera" value="{{ old('carrera') }}" placeholder="187-3">

    	<label>Carnet de Identidad </label>
    	<input type="text" class="form-control" name="ci" value="{{ old('ci') }}" placeholder="3924681-SCZ">

    	<label>Nombres</label>
    	<input type="text" class="form-control" name="nombres" value="{{ old('nombres') }}" placeholder="Juan Carlos">

    	<label>Apellidos </label>
    	<input type="text" class="form-control" name="apellidos" value="{{ old('apellidos') }}" placeholder="Perez Perez">

    	<label>Fecha Nacimento </label>
    	<input type="date" class="form-control" name="nacimiento" value="{{ old('nacimiento') }}" placeholder="1980-06-01">

    	<label>Direccion </label>
    	<input type="text" class="form-control" name="direccion" value="{{ old('direccion') }}" placeholder="Av. Busch">

    	<label>E-Mail </label>
    	<input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="juanperez@gmail.com">

    	<label>Celular </label>
    	<input type="text" class="form-control" name="celular" value="{{ old('celular') }}" placeholder="700-23421">
    	<label>Foto </label>
    	<input type="file" class="form-control" name="foto" value="{{ old('foto') }}">

       <button class="btn btn-success mt-3" type="submit">Registrar Participante</button>
    </form>

           		</div>
            </div>
        </div>
    </div>
</x-app-layout>
