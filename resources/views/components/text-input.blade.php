@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-none bg-gray-100 focus:bg-gray-200 focus:ring-2 focus:ring-indigo-100 rounded-full py-3.5 px-6 text-gray-700 transition duration-200']) }}>
