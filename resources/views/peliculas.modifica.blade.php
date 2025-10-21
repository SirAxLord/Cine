<x-layouts.app :title="__('Modificar Película')">
    <div>
        <flux:heading size="lg">{{ __('Modificar Película') }}</flux:heading>
        <flux:text class="mt-2">{{ __('Actualiza los datos de la película') }}</flux:text>
    </div>
    <form method="POST" action="{{ route('peliculas.update', $pelicula->id) }}" class="mt-6 space-y-6">
        @csrf
        @method('PATCH')
        <div>
            <flux:label for="title" value="{{ __('Título de la Película') }}" />
            <flux:input id="title" name="title" type="text" class="mt-1 block w-full" :value="$pelicula->title" required autofocus autocomplete="title" />
            @foreach ($errors->get('title') as $message)
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @endforeach
        </div>

        <div>
            <flux:label for="genre" value="{{ __('Género') }}" />
            <flux:input id="genre" name="genre" type="text" class="mt-1 block w-full" :value="$pelicula->genre" required autocomplete="genre" />
            @foreach ($errors->get('genre') as $message)
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @endforeach
        </div>

        <div>
            <flux:label for="duration" value="{{ __('Duración (mins)') }}" />
            <flux:input id="duration" name="duration" type="number" class="mt-1 block w-full" :value="$pelicula->duration" required autocomplete="duration" />
            @foreach ($errors->get('duration') as $message)
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @endforeach
        </div>

        <div>
            <flux:label for="director" value="{{ __('Director') }}" />
            <flux:input id="director" name="director" type="text" class="mt-1 block w-full" :value="$pelicula->director" required autocomplete="director" />
            @foreach ($errors->get('director') as $message)
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @endforeach
        </div>

        <div class="flex justify-end">
            <flux:button type="submit">{{ __('Actualizar película') }}</flux:button>
        </div>
    </form>
</x-layouts.app>