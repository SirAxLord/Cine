<x-layouts.app :title="__('Películas')">
    <div class="flex items-center justify-between gap-4">
        <div>
            <flux:heading size="lg">{{ __('Películas') }}</flux:heading>
            <flux:text class="mt-1">{{ __('Administra las películas de tu cine.') }}</flux:text>
        </div>
        <flux:modal.trigger name="pelicula-create">
            <flux:button variant="primary">{{ __('Agregar Película') }}</flux:button>
        </flux:modal.trigger>
    </div>

    

    <!--Import Section -->
    <div class="overflow-hidden rounded-xl border border-dashed border-neutral-200 dark:border-neutral-700 p-6 mt-6">
        <div class="mb-4">
            <flux:heading size="md">{{ __('Importar Películas desde CSV') }}</flux:heading>
            <flux:text class="mt-1">{{ __('Selecciona un archivo CSV con los datos de las películas para importarlas al sistema.') }}</flux:text>
        </div>
        <form method="POST" action="{{ route('peliculas.importar') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <flux:label for="archivo" value="{{ __('Archivo CSV') }}" />
                <flux:input id="archivo" name="archivo" type="file" accept=".csv,.xls,.xlsx" class="mt-1 block w-full" required />
                @foreach ($errors->get('archivo') as $message)
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @endforeach
            </div>
            <div class="flex justify-end">
                <flux:button type="submit">{{ __('Importar Películas') }}</flux:button>
            </div>
        </form>
    </div>

    <div class="mt-6 bg-white dark:bg-neutral-800 shadow-sm ring-1 ring-black ring-opacity-5 rounded-lg">
        <div class="w-full overflow-x-auto">
        <table class="min-w-[720px] md:min-w-full md:table-fixed divide-y divide-neutral-200 dark:divide-neutral-700">
            <thead class="bg-neutral-50 dark:bg-neutral-700">
                <tr>
                    <th scope="col" class="md:w-[60px] px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">ID</th>
                    <th scope="col" class="md:w-[260px] px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">Título</th>
                    <th scope="col" class="md:w-[180px] px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">Género</th>
                    <th scope="col" class="md:w-[120px] px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">Duración</th>
                    <th scope="col" class="md:w-[200px] px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">Director</th>
                    <th scope="col" class="md:w-[220px] px-6 py-3 text-left text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                @forelse ($peliculas as $pelicula)
                    <tr>
                        <td class="md:w-[60px] px-6 py-4 whitespace-nowrap text-neutral-900 dark:text-neutral-100">{{ $pelicula->id }}</td>
                        <td class="md:w-[260px] px-6 py-4 text-neutral-900 dark:text-neutral-100" title="{{ $pelicula->title }}"><div class="md:truncate">{{ $pelicula->title }}</div></td>
                        <td class="md:w-[180px] px-6 py-4 text-neutral-900 dark:text-neutral-100" title="{{ $pelicula->genre }}"><div class="md:truncate">{{ $pelicula->genre }}</div></td>
                        <td class="md:w-[120px] px-6 py-4 whitespace-nowrap text-neutral-900 dark:text-neutral-100">{{ $pelicula->duration }} mins</td>
                        <td class="md:w-[200px] px-6 py-4 text-neutral-900 dark:text-neutral-100" title="{{ $pelicula->director }}"><div class="md:truncate">{{ $pelicula->director }}</div></td>
                        <td class="md:w-[220px] px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <form method="GET" action="{{ route('peliculas.show', $pelicula->id) }}">
                                    <flux:button type="submit" class="inline-flex items-center rounded-md !bg-blue-600 px-3 py-1.5 !text-white hover:!bg-blue-700 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">{{ __('Modificar') }}</flux:button>
                                </form>
                                <form method="POST" action="{{ route('peliculas.delete', $pelicula->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <flux:button type="submit" class="inline-flex items-center rounded-md !bg-red-600 px-3 py-1.5 !text-white hover:!bg-red-700 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">{{ __('Eliminar') }}</flux:button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-neutral-500 dark:text-neutral-400">{{ __('No hay películas disponibles.') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>

    <flux:modal name="pelicula-create" class="md:w-[480px]">
        <div>
            <flux:heading size="lg">{{ __('Agregar película') }}</flux:heading>
            <flux:text class="mt-2">{{ __('Agrega todos los detalles de la película') }}</flux:text>
        </div>
        <form method="POST" action="{{ route('peliculas.save') }}" class="mt-6 space-y-6">
            @csrf
            <div>
                <flux:label for="title" value="{{ __('Título de la Película') }}" />
                <flux:input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" placeholder="Título de la Película" required autofocus autocomplete="title" />
                @foreach ($errors->get('title') as $message)
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @endforeach
            </div>
            <div>
                <flux:label for="genre" value="{{ __('Género') }}" />
                <flux:input id="genre" name="genre" type="text" class="mt-1 block w-full" :value="old('genre')" placeholder="Género" required autocomplete="genre" />
                @foreach ($errors->get('genre') as $message)
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @endforeach
            </div>
            <div>
                <flux:label for="duration" value="{{ __('Duración (mins)') }}" />
                <flux:input id="duration" name="duration" type="number" class="mt-1 block w-full" :value="old('duration')" placeholder="Duración (mins)" required autocomplete="duration" />
                @foreach ($errors->get('duration') as $message)
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @endforeach
            </div>
            <div>
                <flux:label for="director" value="{{ __('Director') }}" />
                <flux:input id="director" name="director" type="text" class="mt-1 block w-full" :value="old('director')" placeholder="Director" required autocomplete="director" />
                @foreach ($errors->get('director') as $message)
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @endforeach
            </div>
            <div class="flex justify-end">
                <flux:button type="submit">{{ __('Agregar película') }}</flux:button>
            </div>
        </form>
    </flux:modal>
</x-layouts.app>
