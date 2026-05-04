<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">{{ __('Інформація профілю') }}</h2>
        
    </header>

    {{-- Форма верифікації --}}
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    {{-- Основна форма --}}
    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{-- Вивід помилок валідації --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded shadow-sm">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        

        {{-- Поле вибору файлу --}}
        <div class="flex flex-col items-center mb-6">
            <div class="relative cursor-pointer" onclick="document.getElementById('avatar-input').click();">
                <div class="w-32 h-32 rounded-full bg-[#5F55F8] flex items-center justify-center overflow-hidden border-4 border-white shadow-md">
                    @if($user->hasMedia('avatars'))
                        <img src="{{ $user->getFirstMediaUrl('avatars') }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-white text-5xl font-bold">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                    @endif
                </div>
            <input type="file" id="avatar-input" name="avatar" class="hidden" onchange="this.form.submit();">
        </div>

    <h2 class="mt-4 text-2xl font-bold text-gray-800">{{ $user->name }}</h2>
    <p class="text-gray-500">{{ $user->email }}</p>
</div>

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" name="username" type="text" class="mt-1 block w-full" :value="old('username', $user->username)" required />
            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="bg-[#5F55F8] hover:bg-indigo-700 rounded-full py-3 px-10 font-bold transition ml-auto block">
                {{ __('Зберегти зміни') }}
            </x-primary-button>
            @if (session('status') === 'profile-updated')
                <p class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>