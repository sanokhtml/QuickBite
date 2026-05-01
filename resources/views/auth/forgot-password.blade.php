<x-guest-layout>
    <div class="mb-6">
        <a href="/" class="text-sm text-gray-600 hover:text-[#5F55F8] flex items-center gap-2 transition-colors group">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span>На головну</span>
        </a>
    </div>

    <div class="mb-4 text-sm text-gray-600">
        {{ __('Забули пароль? Без проблем. Просто вкажіть вашу електронну адресу, і ми надішлемо вам посилання для скидання пароля.') }}
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <x-primary-button class="w-full justify-center py-3 bg-[#5F55F8] hover:bg-indigo-700 rounded-full text-white font-bold shadow-lg shadow-indigo-100 transition">
                {{ __('Надіслати посилання') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>