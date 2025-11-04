<x-layouts.app :title="__('Detalle de función')">
    <div class="flex items-center justify-between gap-4">
        <div>
            <flux:heading size="lg">{{ __('Detalle de función') }}</flux:heading>
            <flux:text class="mt-1">{{ $funcion->pelicula->title }}</flux:text>
        </div>
        <a href="{{ route('funciones.user.index') }}" class="inline-flex items-center rounded-md !bg-neutral-600 px-3 py-1.5 !text-white hover:!bg-neutral-700 text-sm">{{ __('Volver') }}</a>
    </div>

    <div class="mt-6 grid gap-4 md:grid-cols-2">
        <div class="rounded-lg bg-white dark:bg-neutral-800 p-4 ring-1 ring-black ring-opacity-5">
            <flux:heading size="sm" class="mb-2">{{ __('Película') }}</flux:heading>
            <div class="space-y-1 text-neutral-700 dark:text-neutral-200">
                <p><strong>{{ __('Título:') }}</strong> {{ $funcion->pelicula->title }}</p>
                <p><strong>{{ __('Género:') }}</strong> {{ $funcion->pelicula->genre }}</p>
                <p><strong>{{ __('Duración:') }}</strong> {{ $funcion->pelicula->duration }} {{ __('min') }}</p>
            </div>
        </div>

        <div class="rounded-lg bg-white dark:bg-neutral-800 p-4 ring-1 ring-black ring-opacity-5">
            <flux:heading size="sm" class="mb-2">{{ __('Sala') }}</flux:heading>
            <div class="space-y-1 text-neutral-700 dark:text-neutral-200">
                <p><strong>{{ __('Sala:') }}</strong> {{ $funcion->sala->name }}</p>
                @if(optional($funcion->sala->sucursal)->name)
                    <p><strong>{{ __('Sucursal:') }}</strong> {{ $funcion->sala->sucursal->name }}</p>
                @endif
            </div>
        </div>

        <div class="rounded-lg bg-white dark:bg-neutral-800 p-4 ring-1 ring-black ring-opacity-5 md:col-span-2">
            <flux:heading size="sm" class="mb-2">{{ __('Función') }}</flux:heading>
            <div class="grid gap-3 md:grid-cols-3 text-neutral-700 dark:text-neutral-200">
                <p><strong>{{ __('Fecha y hora:') }}</strong> {{ optional($funcion->start_time)->format('Y-m-d H:i') }}</p>
                <p><strong>{{ __('Termina:') }}</strong> {{ optional($funcion->end_time)->format('Y-m-d H:i') }}</p>
                <p><strong>{{ __('Tipo:') }}</strong> {{ $funcion->type }}</p>
                <p><strong>{{ __('Costo:') }}</strong> ${{ number_format($funcion->cost, 2) }}</p>
            </div>
        </div>
    </div>
</x-layouts.app>
