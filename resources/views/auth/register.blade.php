<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/" >
                <img src="{{ asset('storage/web/images/logo.png')}}" width="75px" alt="logo web">
                <h2 class="text-center"><b>Go</b>Heart <br> Login</h2>
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="nombre" :value="__('Nombre')" />

                <x-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" :value="old('nombre')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="contraseña" :value="__('Contraseña')" />

                <x-input id="contraseña" class="block mt-1 w-full"
                                type="password"
                                name="contraseña"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="contraseña_confirmation" :value="__('Contraseña Password')" />

                <x-input id="contraseña_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="contraseña_confirmation" required />
            </div>

            <div class="flex items-center justify-start mt-4">
                
                <label for="privacidad" class="inline-flex items-center">
                    <input id="privacidad" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="privacidad" required>
                    <span class="ml-2 text-sm text-gray-600">{!! trans('auth.consent') !!} *</span>
                </label>
            </div>
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    Estas registrado? 
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
            <div class="flex items-center justify-center mt-4">
                <a class="underline text-sm text-white hover:text-gray-800 bg-blue-500 m-auto p-3 rounded" href="{{ route('home') }}">
                    Ir a la pagina inicial
                </a>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
