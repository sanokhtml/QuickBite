<x-app-layout>
    <div class="max-w-2xl mx-auto py-12">
        <h1 class="text-2xl font-bold mb-6">Додати нову страву</h1>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-2xl shadow-sm space-y-6">
            @csrf

            <!-- Вибір ресторану -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Оберіть заклад</label>
                <select name="restaurant_id" class="w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500">
                    @foreach($restaurants as $restaurant)
                        <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                    @endforeach
                </select>
                @error('restaurant_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Назва страви -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Назва страви</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Напр: Біг Мак" 
                       class="w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Ціна -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Ціна (₴)</label>
                <input type="number" name="price" step="0.01" value="{{ old('price') }}" placeholder="0.00" 
                       class="w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500">
                @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Опис -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Опис страви</label>
                <textarea name="description" rows="3" placeholder="Склад, вага..." 
                          class="w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500">{{ old('description') }}</textarea>
                @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Фото -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Фото страви</label>
                <input type="file" name="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-xl font-bold hover:bg-indigo-700 transition">
                Зберегти страву
            </button>
        </form>
    </div>
</x-app-layout>