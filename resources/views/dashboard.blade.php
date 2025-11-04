<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
        </div>
    </div>
    <div>
        <form action="{{ route('reportes.peliculas-salas') }}" method="POST">
            @csrf
            <label for="file-upload" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Upload file
                <i class="ml-2 fas fa-upload"></i>
            </label>
            @isset($salas)
            <select name="sala_id" id="salas" class="mt-1 block w-full">
                @foreach ($salas as $sala)
                    <option value="{{ $sala->id }}">{{ $sala->name }}</option>
                @endforeach
            </select>
            @else
            <div class="text-sm text-gray-600 dark:text-gray-300 mt-2">No hay salas cargadas para seleccionar.</div>
            @endisset
            <button type="submit" class="mt-4 inline-flex items-center rounded-md !bg-blue-600 px-3 py-1.5 !text-white hover:!bg-blue-700 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">Generar PDF</button>
        </form>
    </div>
</x-layouts.app>
