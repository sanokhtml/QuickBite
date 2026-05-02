<x-app-layout>
    <div x-data="{ 
        cart: [], 
        addToCart(product) {
            this.cart.push({
                id: product.id,
                name: product.name,
                price: parseFloat(product.price)
            });
        },
        getTotal() {
            return this.cart.reduce((sum, item) => sum + item.price, 0).toFixed(2);
        }
    }" class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 flex gap-8">

        <!-- ЛІВА ЧАСТИНА: МЕНЮ ЗАКЛАДУ -->
        <div class="flex-1">
            <div class="mb-8">
                <!-- Обкладинка ресторану -->
                <div class="w-full h-64 bg-gray-200 rounded-3xl overflow-hidden shadow-sm">
                     <img src="{{ $restaurant->getFirstMediaUrl('covers') ?: asset('images/default-banner.png') }}" 
                          class="w-full h-full object-cover">
                </div>
                <h1 class="text-4xl font-black mt-8 text-gray-900">{{ $restaurant->name }}</h1>
                <p class="text-gray-500 mt-2">{{ $restaurant->description }}</p>
            </div>

            <!-- Список страв (продуктів) -->
            <div class="space-y-6">
                @foreach($restaurant->products as $product)
                <div class="flex items-center justify-between bg-white p-4 rounded-3xl shadow-sm border border-gray-50 transition hover:shadow-md">
                    <div class="flex gap-6 items-center">
                        <!-- Фото страви (використовуємо твій метод imageUrl) -->
                        <img src="{{ $product->imageUrl() }}" class="w-24 h-24 rounded-2xl object-cover shadow-sm">
                        
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">{{ $product->name }}</h3>
                            <p class="text-gray-400 text-sm mt-1">
                                {{ $product->description }}
                            </p>
                            <div class="mt-2">
                                <span class="text-xl font-black text-gray-900">{{ number_format($product->price, 2) }} ₴</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Кнопка додавання (Alpine.js) -->
                    <button @click="addToCart({ id: {{ $product->id }}, name: '{{ $product->name }}', price: {{ $product->price }} })" 
                            class="bg-gray-100 p-3 rounded-full hover:bg-indigo-600 hover:text-white transition group">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </button>
                </div>
                @endforeach
            </div>
        </div>

        <!-- ПРАВА ЧАСТИНА: КОШИК (Твій Sticky-блок) -->
        <div class="w-96">
            <div class="bg-white p-8 rounded-3xl shadow-xl sticky top-8 border border-gray-50">
                <h2 class="text-2xl font-black text-gray-800 mb-6 text-center">Ваше замовлення</h2>

                <!-- Динамічний список товарів -->
                <div class="space-y-4 max-h-[400px] overflow-y-auto pr-2 mb-6">
                    <template x-if="cart.length === 0">
                        <p class="text-gray-400 text-center text-sm px-4">
                            Ви ще не додали жодної страви. Оберіть щось смачненьке!
                        </p>
                    </template>

                    <template x-for="(item, index) in cart" :key="index">
                        <div class="flex justify-between items-center bg-gray-50 p-3 rounded-2xl border border-gray-100">
                            <div>
                                <p class="font-bold text-gray-800 text-sm" x-text="item.name"></p>
                                <button @click="cart.splice(index, 1)" class="text-[10px] text-red-400 uppercase font-black hover:text-red-600 transition">Видалити</button>
                            </div>
                            <span class="font-black text-indigo-600" x-text="item.price.toFixed(2) + ' ₴'"></span>
                        </div>
                    </template>
                </div>

                <!-- Підсумок -->
                <div x-show="cart.length > 0" x-transition class="pt-6 border-t border-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <span class="text-gray-400 font-bold uppercase text-xs tracking-widest">Разом до сплати:</span>
                        <span class="text-3xl font-black text-indigo-600" x-text="getTotal() + ' ₴'"></span>
                    </div>
                    <button class="w-full bg-indigo-600 text-white py-4 rounded-2xl font-bold text-lg hover:bg-indigo-700 shadow-lg shadow-indigo-100 transition active:scale-95">
                        Оформити замовлення
                    </button>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>