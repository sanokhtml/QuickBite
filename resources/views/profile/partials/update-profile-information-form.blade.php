<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">{{ __('Profile Information') }}</h2>
        <p class="mt-1 text-sm text-gray-600">{{ __("Update your account's profile information and email address.") }}</p>
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

        {{-- Показ поточного аватара --}}
        @if ($user->getFirstMedia('avatars'))
            <div class="mb-4">
                {{-- @dd($user->getMedia('avatars')) --}}
                <img src="{{ $user->imageUrl() }}" alt="{{ $user->name }}" class="rounded-full h-20 w-20 object-cover border border-gray-200">
            </div>
        @endif

        {{-- Поле вибору файлу --}}
        <div>
            <x-input-label for="image" :value="__('Avatar')" />
            <input id="image" name="image" type="file" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            <x-input-error :messages="$errors->get('image')" class="mt-2" />
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

        <div>
            <x-input-label for="bio" :value="__('Bio')" />
            <x-input-textarea id="bio" name="bio" class="block mt-1 w-full">{{ old('bio', $user->bio) }}</x-input-textarea>
            <x-input-error :messages="$errors->get('bio')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button type="submit">{{ __('Save') }}</x-primary-button>
            @if (session('status') === 'profile-updated')
                <p class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>