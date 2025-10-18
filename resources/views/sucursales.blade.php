<x-layouts.app :title="__('Sucursales')">
    <h2>Sucursales</h2>
    <div>
        <flux:modal.trigger name="edit-profile">
            <flux:button variant="primary">Agregar Sucursal</flux:button>
        </flux:modal.trigger>
    </div>
    <div>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dirección</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teléfono</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Director</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($sucursales as $sucursal)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $sucursal->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $sucursal->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $sucursal->address }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $sucursal->phone }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $sucursal->director }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form method="POST" action="{{ route('sucursales.delete', $sucursal->id) }}">
                                @csrf
                                @method('DELETE')
                                <flux:button size="sm" class="text-red-600 hover:text-red-900" onclick="this.closest('form').submit();">Eliminar</flux:button>
                            </form>
                            <flux:brand href="{{ route('sucursales.show', $sucursal->id) }}" size="sm" class="text-blue-600 hover:text-blue-900">Modificar</flux:brand>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <flux:modal name="edit-profile" class="md:w-96">
        <div>
            <flux:heading size="lg">Agregar sucursales</flux:heading>
            <flux:text class="mt-2">Agrega todos los detalles de la sucursal </flux:text>
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