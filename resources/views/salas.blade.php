<x-layouts.app :title="__('Salas')">
    <div class="flex items-center justify-between gap-4">
        <div>
            <flux:heading size="lg">{{ __('Salas') }}</flux:heading>
            <flux:text class="mt-1">{{ __('Administra las salas de tus sucursales.') }}</flux:text>
        </div>
        <flux:modal.trigger name="sala-create">
            <flux:button variant="primary">{{ __('Agregar Sala') }}</flux:button>
        </flux:modal.trigger>
    </div>

    <flux:modal name="sala-create" class="md:w-[480px]">
        <div>
            <flux:heading size="lg">{{ __('Agregar sala') }}</flux:heading>
            <flux:text class="mt-2">{{ __('Agrega todos los detalles de la sala') }}</flux:text>
        </div>
        <form method="POST" action="{{ route('salas.save') }}" class="mt-6 space-y-5">
            @csrf
            <div>
                <flux:label for="name" value="{{ __('Nombre de la Sala') }}" />
                <flux:input id="name" name="name" type="text" class="mt-1 block w-full" placeholder="{{ __('Ej. Sala 1') }}" required autofocus autocomplete="name" />
                @foreach ($errors->get('name') as $message)
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @endforeach
            </div>
            <div>
                <flux:label for="capacity" value="{{ __('Capacidad') }}" />
                <flux:input id="capacity" name="capacity" type="number" min="1" class="mt-1 block w-full" placeholder="{{ __('Ej. 100') }}" required autocomplete="capacity" />
                @foreach ($errors->get('capacity') as $message)
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @endforeach
            </div>
            <div>
                <flux:label for="sucursal_id" value="{{ __('Sucursal') }}" />
                <flux:select id="sucursal_id" name="sucursal_id" class="mt-1 block w-full" required>
                    <flux:select.option :value="''" disabled selected>{{ __('Selecciona una sucursal') }}</flux:select.option>
                    @foreach ($sucursales as $sucursal)
                        <flux:select.option :value="$sucursal->id">{{ $sucursal->name }}</flux:select.option>
                    @endforeach
                </flux:select>
                @foreach ($errors->get('sucursal_id') as $message)
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @endforeach
            </div>
            <div class="flex items-center gap-4 pt-2">
                <flux:button type="submit">{{ __('Guardar Sala') }}</flux:button>
                <flux:button type="button" class="text-neutral-500 hover:text-neutral-700 dark:text-neutral-400 dark:hover:text-neutral-200" x-on:click="$dispatch('close')">{{ __('Cancelar') }}</flux:button>
            </div>
        </form>
    </flux:modal>

    <div class="mt-6 overflow-hidden bg-white dark:bg-neutral-800 shadow-sm ring-1 ring-black ring-opacity-5 rounded-lg">
        <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-700">
            <thead class="bg-neutral-50 dark:bg-neutral-700">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">ID</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">Nombre</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">Capacidad</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">Sucursal</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-neutral-800 divide-y divide-neutral-200 dark:divide-neutral-700">
                @forelse ($salas as $sala)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-neutral-900 dark:text-neutral-100">{{ $sala->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-neutral-900 dark:text-neutral-100">{{ $sala->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-neutral-900 dark:text-neutral-100">{{ $sala->capacity }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-neutral-900 dark:text-neutral-100">{{ $sala->sucursal->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <form method="GET" action="{{ route('salas.show', $sala->id) }}">
                                    <flux:button type="submit" class="inline-flex items-center rounded-md !bg-blue-600 px-3 py-1.5 !text-white hover:!bg-blue-700 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">{{ __('Modificar') }}</flux:button>
                                </form>
                                <form method="POST" action="{{ route('salas.delete', $sala->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <flux:button type="submit" class="inline-flex items-center rounded-md !bg-red-600 px-3 py-1.5 !text-white hover:!bg-red-700 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">{{ __('Eliminar') }}</flux:button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-sm text-neutral-500 dark:text-neutral-400">{{ __('No hay salas registradas todavía.') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</x-layouts.app>
