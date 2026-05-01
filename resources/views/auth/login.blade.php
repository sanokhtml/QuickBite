<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="mb-4">
        <a href="/" class="text-sm text-gray-600 hover:text-[#5F55F8] flex items-center transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            На головну
        </a>
    </div>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <h2 class="text-3xl font-bold text-gray-800 mb-8">Login</h2>
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-8">
            @if (Route::has('password.request'))
                <a class="text-sm text-gray-400 hover:text-[#5F55F8] transition-colors font-medium" href="{{ route('password.request') }}">
                    {{ __('Забули пароль?') }}
                </a>
            @endif

            <x-primary-button class="px-8 py-3 bg-[#5F55F8] hover:bg-indigo-700 rounded-full text-white font-bold shadow-lg shadow-indigo-100 transition">
                {{ __('Увійти') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>