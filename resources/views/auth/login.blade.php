<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/" >
                <img src="{{ asset('storage/web/images/logo.png')}}" width="75px" alt="logo web">
                <h2 class="text-center"><b>Go</b>Heart <br> Login</h2>
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        @if (session('error'))
            <div class="text-red-500">
                {!! session('error') !!}
            </div>
        @endif

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ trans('auth.remember') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ trans('auth.forgotPassword') }}
                    </a>
                @endif
                <a class="underline text-sm text-white hover:text-gray-800 bg-gray-500 m-auto p-1 rounded" href="{{ route('register') }}">
                   <small>Registrate</small>
                </a>
                <x-button class="ml-3">
                    {{ trans('auth.login') }}
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
