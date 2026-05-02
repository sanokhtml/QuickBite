<x-app-layout>
    <div class="max-w-3xl mx-auto py-12 px-4">
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
            <h1 class="text-3xl font-black text-gray-900 mb-8 text-center uppercase tracking-tighter">Реєстрація закладу</h1>

            <form action="{{ route('restaurant.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Назва закладу -->
                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Назва ресторану / кафе</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Напр: Burger King" required
                           class="w-full rounded-2xl border-gray-100 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 transition-all border-none py-4 px-6">
                    @error('name') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                </div>

                <!-- Категорія -->
                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Тип кухні</label>
                    <select name="category_id" class="w-full rounded-2xl border-gray-100 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 transition-all border-none py-4 px-6">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                </div>

                <!-- Опис -->
                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Про заклад</label>
                    <textarea name="description" rows="3" placeholder="Розкажіть про ваші особливості..."
                              class="w-full rounded-2xl border-gray-100 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 transition-all border-none py-4 px-6">{{ old('description') }}</textarea>
                    @error('description') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                </div>

                <!-- Баннер -->
                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Головне фото (Баннер)</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-100 border-dashed rounded-3xl hover:border-indigo-400 hover:bg-indigo-50 transition-all group">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-300 group-hover:text-indigo-400 transition-colors" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600 justify-center">
                                <label class="relative cursor-pointer font-bold text-indigo-600 hover:text-indigo-500">
                                    <span>Завантажити файл</span>
                                    <input type="file" name="cover" class="sr-only" required>
                                </label>
                            </div>
                            <p class="text-xs text-gray-400">PNG, JPG до 2MB</p>
                        </div>
                    </div>
                    @error('cover') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase mb-2">Час доставки</label>
                        <input type="text" name="delivery_time" placeholder="20-30" 
                            class="w-full rounded-2xl border-none bg-gray-50 py-4 px-6">
                    </div>
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase mb-2">Ціна доставки</label>
                        <input type="number" step="0.01" name="delivery_price" placeholder="48.00" 
                            class="w-full rounded-2xl border-none bg-gray-50 py-4 px-6">
                    </div>
                </div>

                <button type="submit" class="w-full bg-indigo-600 text-white py-5 rounded-2xl font-black text-lg hover:bg-indigo-700 shadow-xl shadow-indigo-100 transition-all active:scale-95 uppercase tracking-widest">
                    Зареєструвати заклад
                </button>
            </form>
        </div>
    </div>
</x-app-layout>