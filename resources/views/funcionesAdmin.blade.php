<x-layouts.app :title="__('FuncionesAdmin')">
    <div class="flex items-center justify-between gap-4">
        <div>
            <flux:heading size="lg">{{ __('Funciones Admin') }}</flux:heading>
            <flux:text class="mt-2">{{ __('Gestión de funciones para administradores') }}</flux:text>
        </div>
        <div class="flex items-center gap-3">
            <form method="POST" action="{{ route('reportes.peliculas-salas') }}" class="flex items-center gap-2">
                @csrf
                <select name="sala_id" class="block w-48 rounded-md border border-neutral-300 bg-white px-2 py-1.5 text-sm text-neutral-900 dark:bg-neutral-800 dark:text-neutral-100 dark:border-neutral-700">
                    <option value="">{{ __('Todas las salas') }}</option>
                    @foreach ($salas as $sala)
                        <option value="{{ $sala->id }}">{{ $sala->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="inline-flex items-center rounded-md !bg-emerald-600 px-3 py-1.5 !text-white hover:!bg-emerald-700 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">
                    {{ __('Exportar PDF') }}
                </button>
            </form>
            <flux:modal.trigger name="funcion-create">
                <flux:button variant="primary">{{ __('Agregar Función') }}</flux:button>
            </flux:modal.trigger>
        </div>
    </div>

    <div class="mt-6 overflow-hidden bg-white dark:bg-neutral-800 shadow-sm ring-1 ring-black ring-opacity-5 rounded-lg">
        <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-700">
            <thead class="bg-neutral-50 dark:bg-neutral-700">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">{{ __('ID') }}</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">{{ __('Película') }}</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">{{ __('Sala') }}</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">{{ __('Fecha y Hora') }}</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">{{ __('Tipo') }}</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">{{ __('Costo') }}</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">{{ __('Acciones') }}</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-neutral-800 divide-y divide-neutral-200 dark:divide-neutral-700">
                @forelse ($funciones as $funcion)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-neutral-900 dark:text-neutral-100">{{ $funcion->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-neutral-900 dark:text-neutral-100">{{ $funcion->pelicula->title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-neutral-900 dark:text-neutral-100">{{ $funcion->sala->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-neutral-900 dark:text-neutral-100">{{ $funcion->start_time ? $funcion->start_time->format('Y-m-d H:i') : '' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-neutral-900 dark:text-neutral-100">{{ $funcion->type }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-neutral-900 dark:text-neutral-100">{{ $funcion->cost }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <form method="GET" action="{{ route('funciones.show', $funcion->id) }}" class="inline">
                                    <flux:button type="submit" class="inline-flex items-center rounded-md !bg-blue-600 px-3 py-1.5 !text-white hover:!bg-blue-700 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">{{ __('Modificar') }}</flux:button>
                                </form>
                                <form method="POST" action="{{ route('funciones.delete', $funcion->id) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <flux:button type="submit" class="inline-flex items-center rounded-md !bg-red-600 px-3 py-1.5 !text-white hover:!bg-red-700 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">{{ __('Eliminar') }}</flux:button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-neutral-500 dark:text-neutral-400">{{ __('No hay funciones registradas todavía.') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <flux:modal name="funcion-create" class="md:w-[520px]">
        <div>
            <flux:heading size="lg">{{ __('Agregar Función') }}</flux:heading>
            <flux:text class="mt-2">{{ __('Agrega todos los detalles de la función') }}</flux:text>
        </div>
        <form method="POST" action="{{ route('funciones.save') }}" class="mt-6 space-y-6">
            @csrf
            <div>
                <flux:label for="pelicula_id" value="{{ __('Película') }}" />
                <flux:select id="pelicula_id" name="pelicula_id" class="mt-1 block w-full" required>
                    <flux:select.option :value="''" disabled selected>{{ __('Selecciona una película') }}</flux:select.option>
                    @foreach ($peliculas as $pelicula)
                        <flux:select.option :value="$pelicula->id">{{ $pelicula->title }}</flux:select.option>
                    @endforeach
                </flux:select>
                @foreach ($errors->get('pelicula_id') as $message)
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @endforeach
            </div>
            <div>
                <flux:label for="sala_id" value="{{ __('Sala') }}" />
                <flux:select id="sala_id" name="sala_id" class="mt-1 block w-full" required>
                    <flux:select.option :value="''" disabled selected>{{ __('Selecciona una sala') }}</flux:select.option>
                    @foreach ($salas as $sala)
                        <flux:select.option :value="$sala->id">{{ $sala->name }}</flux:select.option>
                    @endforeach
                </flux:select>
                @foreach ($errors->get('sala_id') as $message)
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @endforeach
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <flux:label for="date" value="{{ __('Fecha') }}" />
                    <flux:input id="date" name="date" type="date" class="mt-1 block w-full" :value="old('date')" required />
                    @foreach ($errors->get('date') as $message)
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @endforeach
                </div>
                <div>
                    <flux:label for="time" value="{{ __('Hora') }}" />
                    <flux:input id="time" name="time" type="time" class="mt-1 block w-full" :value="old('time')" required />
                    @foreach ($errors->get('time') as $message)
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @endforeach
                </div>
            </div>
            <div>
                <flux:label for="tipo" value="{{ __('Tipo') }}" />
                <flux:input id="tipo" name="tipo" type="text" class="mt-1 block w-full" :value="old('tipo')" placeholder="Ej. 2D, 3D, IMAX" required />
                @foreach ($errors->get('tipo') as $message)
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @endforeach
            </div>
            <div>
                <flux:label for="costo" value="{{ __('Costo') }}" />
                <flux:input id="costo" name="costo" type="number" step="0.01" class="mt-1 block w-full" :value="old('costo')" placeholder="Costo del boleto" required />
                @foreach ($errors->get('costo') as $message)
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @endforeach
            </div>
            <div class="flex justify-end">
                <flux:button type="submit">{{ __('Agregar función') }}</flux:button>
            </div>
        </form>
    </flux:modal>
</x-layouts.app>