<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Actualizar Tematica
        </h2>
    </x-slot>

     <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                 <div class="p-6 bg-white border-b border-gray-200">


    <h1>Tematica : {{$tematica->id}}</h1>
    @include('dashboard.fragment._errors-form')
    <br>
    <form action="{{route('tematica.update', $tematica)}}" method="post"  enctype="multipart/form-data" >
    	@csrf
    	@method("PUT")

    	<label>Nombre Tematica</label>
    	<input type="text" class="form-control" name="nombre" value="{{ old('nombre',$tematica->nombre) }}">

    	<label>Descripcion </label>
    	{{--<input type="text" class="form-control" name="descripcion" value="{{ old('descripcion',$tematica->descripcion) }}">--}}
    	<textarea class="ckeditor form-control" name="descripcion">{{ old('descripcion',$tematica->descripcion) }}</textarea>

    	<label>Documento</label>
    	{{--<textarea  class="form-control" name="documento" rows="5" cols="100" >{{ old('documento',$tematica->documento) }}</textarea>--}}
        <textarea class="ckeditor form-control" name="documento">{{ old('documento',$tematica->documento) }}</textarea>

    	<label>Encabezado de Tematica</label>
    	<img src="{{ URL::asset('images')}}/{{old('cabeza',$tematica->cabeza) }}" alt="..." width="150" height="160">
    	<br>
    	<input type="file" class="form-control" name="cabeza" value="{{ old('cabeza',$tematica->cabeza) }}">

    	<input type="hidden" class="form-control" name="estado" value="{{ old('estado',$tematica->estado) }}">

       <button class="btn btn-success mt-3" type="submit">Actualizar Tematica</button>
    </form>


           		</div>
            </div>
        </div>
    </div>
</x-app-layout>
<script src="//cdn.ckeditor.com/4.20.1/full/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>
