<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Actualizar Evento
        </h2>
    </x-slot>

     <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                 <div class="p-6 bg-white border-b border-gray-200">


    <h1>Evento : {{$evento->id}}</h1>
    @include('dashboard.fragment._errors-form')
    <br>
    <form action="{{route('evento.update', $evento)}}" method="post"  enctype="multipart/form-data" >
    	@csrf
    	@method("PUT")

    	<label>Gestion</label>
    	<select class="form-control" name="gestion_id">
    		<option value=""></option>
    		@foreach($gestiones as $g)
    			<option {{$g->id == old('gestion_id',$evento->gestion_id) ? 'selected' : ''}} value="{{$g->id}}">{{$g->nombre}}</option>
    		@endforeach
    	</select>

    	<label>Nombre Evento</label>
    	<input type="text" class="form-control" name="nombre" value="{{ old('nombre',$evento->nombre) }}">

    	<label>Descripcion </label>
    	<input type="text" class="form-control" name="descripcion" value="{{ old('descripcion',$evento->descripcion) }}">

    	<label>Documento</label>
    	{{--<textarea  class="form-control" name="documento" rows="5" cols="100" >{{ old('documento',$evento->documento) }}</textarea>--}}
        <textarea class="ckeditor form-control" name="documento">{{ old('documento',$evento->documento) }}</textarea>
    	<label>Inicio </label>
    	<input type="date" class="form-control" name="inicio" value="{{ old('inicio',$evento->inicio) }}">

    	<label>Fin </label>
    	<input type="date" class="form-control" name="fin" value="{{ old('fin',$evento->fin) }}">

    	<label>Encabezado de Evento</label>
    	<img src="{{ URL::asset('images')}}/{{old('cabeza',$evento->cabeza) }}" alt="..." width="150" height="160">
    	<br>
    	<input type="file" class="form-control" name="cabeza" value="{{ old('cabeza',$evento->cabeza) }}">

    	<label>Pie de Evento</label>
    	<img src="{{ URL::asset('images')}}/{{old('pie',$evento->pie) }}" alt="..." width="150" height="160">
    	<br>
    	<input type="file" class="form-control" name="pie" value="{{ old('pie',$evento->pie) }}">

    	<input type="hidden" class="form-control" name="estado" value="{{ old('estado',$evento->estado) }}">

       <button class="btn btn-success mt-3" type="submit">Actualizar Gestion</button>
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
