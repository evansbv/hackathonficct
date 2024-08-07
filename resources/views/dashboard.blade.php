<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Bienvenido a la HACKATHON-FICCT
                    esperamos que puedas aprender muchas de las tecnologias que se daran en
                    la capacitacion de los participantes del este evento.<br><br>

                    Para ello te pedimos:<br>
                    1.- Registrar Equipo (Nombre que tendra tu equipo).<br>
                    2.- Registrar a los Participantes (Compañeros que conformaran tu equipo).<br>
					3.- Registrar Participaciones (Con esta informacion te Habilitas para la Competicion).<br>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
