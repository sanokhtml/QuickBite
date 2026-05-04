@props(['href' => null])

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-6 py-3 bg-[#5F55F8] border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#766dfa] focus:bg-[#766dfa] active:bg-[#4e45d1] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md']) }}>
        {{ $slot }}
    </button>
@endif