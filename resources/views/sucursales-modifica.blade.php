<x-layouts.app :title="__('Modificar sucursal')">
    <div>
        <flux:heading size="lg">Modificar sucursal</flux:heading>
        <flux:text class="mt-2">Modifica los detalles de la sucursal </flux:text>
    </div>
    <form method="POST" action="{{ route('sucursales.update', $sucursal->id) }}" class="mt-6 space-y-6">
        @csrf
        @method('PATCH')
        <div>
            <flux:label for="name" value="{{ __('Nombre de la sucursal') }}" />
            <flux:input id="name" name="name" type="text" class="mt-1 block w-full" :value="$sucursal->name" required autofocus autocomplete="name" />
            @foreach ($errors->get('name') as $message)
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @endforeach
        </div>

        <div>
            <flux:label for="address" value="{{ __('Dirección') }}" />
            <flux:input id="address" name="address" type="text" class="mt-1 block w-full" :value="$sucursal->address" required autocomplete="address" />
            @foreach ($errors->get('address') as $message)
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @endforeach
        </div>
        <div>
            <flux:label for="phone" value="{{ __('Teléfono') }}" />
            <flux:input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="$sucursal->phone" required autocomplete="phone" />
            @foreach ($errors->get('phone') as $message)
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @endforeach
        </div>
        <div>
            <flux:label for="director" value="{{ __('Director') }}" />
            <flux:input id="director" name="director" type="text" class="mt-1 block
                w-full" :value="$sucursal->director" required autocomplete="director" />
            @foreach ($errors->get('director') as $message)
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @endforeach
        </div>
        <div class="flex gap-4">
            <flux:button type="submit">{{ __('Guardar cambios') }}</flux:button>
            <flux:button as="a" href="{{ route('sucursales.index') }}" class="text-neutral-500 hover:text-neutral-700 dark:text-neutral-400 dark:hover:text-neutral-200">{{ __('Cancelar') }}</flux:button>
        </div>
    </form>
</x-layouts.app>