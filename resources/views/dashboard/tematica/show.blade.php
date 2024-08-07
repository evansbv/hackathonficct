<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalles Tematica
        </h2>
    </x-slot>

     <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                 <div class="p-6 bg-white border-b border-gray-200">


             <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 ">
                   Tematica : {{ $tematica->id }}  <br> Nombre : {{ $tematica->nombre }}
                   <img src="{{ URL::asset('images')}}/{{old('cabeza',$tematica->cabeza) }}" width="50%" alt="Hackathon FICCT - header">
					<br>
 				   <div class="ml-12">
 						<div class="grid grid-cols-1 md:grid-cols-1">
 						  {!! $tematica->descripcion !!}
 						</div>
                   </div>
                   <br>
                   <div class="ml-12">
 						<div class="grid grid-cols-1 md:grid-cols-1">
 						  {!! $tematica->documento !!}
 						</div>
                   </div>
				<br>



   {{--
    <h1>Evento : {{$evento->id}}</h1>
    @include('dashboard.fragment._errors-form')
    <br>

    <form action="{{route('evento.update', $evento)}}" method="post">
    	@csrf
    	@method("PUT")

    	<label>Gestion</label>
    	@foreach($gestiones as $g)
    		@if($g->id == $evento->gestion_id)
    		  <input type="text" class="form-control" name="gestion_id" value="{{$g->nombre}}">
    		 @endif
    	@endforeach

    	<label>Nombre Evento</label>
    	<input type="text" class="form-control" name="nombre" value="{{ old('nombre',$evento->nombre) }}">

    	<label>Descripcion </label>
    	<input type="text" class="form-control" name="descripcion" value="{{ old('descripcion',$evento->descripcion) }}">

    	<label>Documento</label>
        <textarea class="ckeditor form-control" name="documento">{{ old('documento',$evento->documento) }}</textarea>

    	<label>Inicio </label>
    	<input type="date" class="form-control" name="inicio" value="{{ old('inicio',$evento->inicio) }}">

    	<label>Fin </label>
    	<input type="date" class="form-control" name="fin" value="{{ old('fin',$evento->fin) }}">

    	<label>Encabezado de Evento</label>
    	<img src="{{ URL::asset('images')}}/{{old('cabeza',$evento->cabeza) }}" alt="..." width="50%" height="160">
    	<br>


    	<label>Pie de Evento</label>
    	<img src="{{ URL::asset('images')}}/{{old('pie',$evento->pie) }}" alt="..." width="50%" height="160">
    	<br>

    </form>
    --}}

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
