@props(['user', 'size' => 'w-12 h-12'])

@if ($user->image)
    <img src="{{ $user->imageUrl() }}" alt="{{ $user->name }}"
        class="{{ $size }} rounded-full">
 @else
    <img src="https://cdn.vectorstock.com/i/500p/46/76/gray-male-head-placeholder-vector-23804676.jpg"
        alt="Dummy avatar" class="{{ $size }} rounded-full">
@endif