<x-layouts.app :title="__('Modificar sala')">
    <div>
        <flux:heading size="lg">{{ __('Modificar sala') }}</flux:heading>
        <flux:text class="mt-2">{{ __('Actualiza los datos de la sala') }}</flux:text>
    </div>
    <form method="POST" action="{{ route('salas.update', $sala->id) }}" class="mt-6 space-y-6">
        @csrf
        @method('PATCH')
        <div>
            <flux:label for="name" value="{{ __('Nombre de la Sala') }}" />
            <flux:input id="name" name="name" type="text" class="mt-1 block w-full" :value="$sala->name" required autofocus autocomplete="name" />
            @foreach ($errors->get('name') as $message)
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @endforeach
        </div>
        <div>
            <flux:label for="capacity" value="{{ __('Capacidad') }}" />
            <flux:input id="capacity" name="capacity" type="number" min="1" class="mt-1 block w-full" :value="$sala->capacity" required autocomplete="capacity" />
            @foreach ($errors->get('capacity') as $message)
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @endforeach
        </div>
        <div>
            <flux:label for="sucursal_id" value="{{ __('Sucursal') }}" />
            <flux:select id="sucursal_id" name="sucursal_id" class="mt-1 block w-full" required>
                @foreach ($sucursales as $sucursal)
                    <flux:select.option :value="$sucursal->id" :selected="$sala->sucursal_id === $sucursal->id">
                        {{ $sucursal->name }}
                    </flux:select.option>
                @endforeach
            </flux:select>
            @foreach ($errors->get('sucursal_id') as $message)
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @endforeach
        </div>
        <div class="flex items-center gap-4">
            <flux:button type="submit">{{ __('Guardar cambios') }}</flux:button>
            <flux:button as="a" href="{{ route('salas.index') }}" class="text-neutral-500 hover:text-neutral-700 dark:text-neutral-400 dark:hover:text-neutral-200">{{ __('Cancelar') }}</flux:button>
        </div>
    </form>
</x-layouts.app>
