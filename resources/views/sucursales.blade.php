<x-layouts.app :title="__('Sucursales')">
    <div class="flex items-center justify-between gap-4">
        <div>
            <flux:heading size="lg">{{ __('Sucursales') }}</flux:heading>
            <flux:text class="mt-1">{{ __('Administra las sucursales de tu cine.') }}</flux:text>
        </div>
        <flux:modal.trigger name="sucursal-create">
            <flux:button variant="primary">{{ __('Agregar Sucursal') }}</flux:button>
        </flux:modal.trigger>
    </div>

    <div class="mt-6 overflow-hidden bg-white dark:bg-neutral-800 shadow-sm ring-1 ring-black ring-opacity-5 rounded-lg">
        <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-700">
            <thead class="bg-neutral-50 dark:bg-neutral-700">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">ID</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">Nombre</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">Dirección</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">Teléfono</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">Director</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-neutral-800 divide-y divide-neutral-200 dark:divide-neutral-700">
                @forelse ($sucursales as $sucursal)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-neutral-900 dark:text-neutral-100">{{ $sucursal->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-neutral-900 dark:text-neutral-100">{{ $sucursal->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-neutral-900 dark:text-neutral-100">{{ $sucursal->address }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-neutral-900 dark:text-neutral-100">{{ $sucursal->phone }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-neutral-900 dark:text-neutral-100">{{ $sucursal->director }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <form method="GET" action="{{ route('sucursales.show', $sucursal->id) }}">
                                    <flux:button type="submit" class="inline-flex items-center rounded-md !bg-blue-600 px-3 py-1.5 !text-white hover:!bg-blue-700 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">{{ __('Modificar') }}</flux:button>
                                </form>
                                <form method="POST" action="{{ route('sucursales.delete', $sucursal->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <flux:button type="submit" class="inline-flex items-center rounded-md !bg-red-600 px-3 py-1.5 !text-white hover:!bg-red-700 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">{{ __('Eliminar') }}</flux:button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-sm text-neutral-500 dark:text-neutral-400">{{ __('No hay sucursales registradas todavía.') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <flux:modal name="sucursal-create" class="md:w-[480px]">
        <div>
            <flux:heading size="lg">{{ __('Agregar sucursal') }}</flux:heading>
            <flux:text class="mt-2">{{ __('Agrega todos los detalles de la sucursal') }}</flux:text>
        </div>
        <form method="POST" action="{{ route('sucursales.save') }}" class="mt-6 space-y-6">
            @csrf
            <div>
                <flux:label for="name" value="{{ __('Nombre de la sucursal') }}" />
                <flux:input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" placeholder="Ej. Cinemanía Centro" required autofocus autocomplete="name" />
                @foreach ($errors->get('name') as $message)
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @endforeach
            </div>

            <div>
                <flux:label for="address" value="{{ __('Dirección') }}" />
                <flux:input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address')" placeholder="Ej. Av. Siempre Viva 123" required autocomplete="address" />
                @foreach ($errors->get('address') as $message)
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @endforeach
            </div>
            <div>
                <flux:label for="phone" value="{{ __('Teléfono') }}" />
                <flux:input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone')" placeholder="Ej. 55 1234 5678" required autocomplete="phone" />
                @foreach ($errors->get('phone') as $message)
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @endforeach
            </div>
            <div>
                <flux:label for="director" value="{{ __('Director') }}" />
                <flux:input id="director" name="director" type="text" class="mt-1 block w-full" :value="old('director')" placeholder="Nombre del responsable" required autocomplete="director" />
                @foreach ($errors->get('director') as $message)
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @endforeach
            </div>
            <div class="flex items-center gap-4">
                <flux:button type="submit">{{ __('Guardar') }}</flux:button>
                <flux:button type="button" class="text-neutral-500 hover:text-neutral-700 dark:text-neutral-400 dark:hover:text-neutral-200" x-on:click="$dispatch('close')">
                    {{ __('Cancelar') }}
                </flux:button>
            </div>
        </form>
    </flux:modal>
</x-layouts.app>