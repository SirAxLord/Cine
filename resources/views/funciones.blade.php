<x-layouts.app :title="__('Funciones')">
    <div class="flex items-center justify-between gap-4">
        <div>
            <flux:heading size="lg">{{ __('Funciones') }}</flux:heading>
            <flux:text class="mt-1">{{ __('Consulta las funciones disponibles.') }}</flux:text>
        </div>
    </div>

    <div class="mt-6 overflow-hidden bg-white dark:bg-neutral-800 shadow-sm ring-1 ring-black ring-opacity-5 rounded-lg">
        <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-700">
            <thead class="bg-neutral-50 dark:bg-neutral-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">{{ __('Película') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">{{ __('Sala') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">{{ __('Fecha y Hora') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">{{ __('Tipo') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">{{ __('Costo') }}</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">{{ __('') }}</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-neutral-800 divide-y divide-neutral-200 dark:divide-neutral-700">
                @forelse ($funciones as $funcion)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-neutral-900 dark:text-neutral-100">{{ $funcion->pelicula->title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-neutral-900 dark:text-neutral-100">{{ $funcion->sala->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-neutral-900 dark:text-neutral-100">{{ optional($funcion->start_time)->format('Y-m-d H:i') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-neutral-900 dark:text-neutral-100">{{ $funcion->type }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-neutral-900 dark:text-neutral-100">${{ number_format($funcion->cost, 2) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('funciones.user.show', $funcion->id) }}" class="inline-flex items-center rounded-md !bg-blue-600 px-3 py-1.5 !text-white hover:!bg-blue-700 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">{{ __('Ver detalles') }}</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-neutral-500 dark:text-neutral-400">{{ __('No hay funciones disponibles por ahora.') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layouts.app>
