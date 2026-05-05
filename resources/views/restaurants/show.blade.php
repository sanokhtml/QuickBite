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
    }" class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 flex flex-col lg:flex-row gap-8">

        <div class="flex-1 w-full">
            <div class="mb-8">
                <div class="w-full h-48 sm:h-64 bg-gray-200 rounded-3xl overflow-hidden shadow-sm">
                     <img src="{{ $restaurant->getFirstMediaUrl('covers') ?: asset('images/default-banner.png') }}" 
                          class="w-full h-full object-cover">
                </div>
                <h1 class="text-3xl sm:text-4xl font-black mt-8 text-gray-900">{{ $restaurant->name }}</h1>
                <p class="text-gray-500 mt-2 text-sm sm:text-base">{{ $restaurant->description }}</p>
                @can('admin')
                    <form action="{{ route('restaurant.destroy', $restaurant->id) }}" method="POST" onsubmit="return confirm('Ви впевнені, що хочете видалити цей заклад?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white p-3 rounded-2xl shadow-sm transition transform active:scale-95 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            <span class="text-sm font-bold hidden sm:inline">Видалити заклад</span>
                        </button>
                    </form>
                @endcan
            </div>

            <div class="space-y-6">
                @foreach($restaurant->products as $product)
                <div class="flex flex-col sm:flex-row sm:items-center justify-between bg-white p-4 sm:p-6 rounded-3xl shadow-sm border border-gray-50 transition hover:shadow-md gap-4">
                    <div class="flex gap-4 sm:gap-6 items-center">
                        <img src="{{ $product->imageUrl() }}" class="w-20 h-20 sm:w-24 sm:h-24 rounded-2xl object-cover shadow-sm shrink-0">
                        
                        <div>
                            <h3 class="text-base sm:text-lg font-bold text-gray-800">{{ $product->name }}</h3>
                            <p class="text-gray-400 text-xs sm:text-sm mt-1">
                                {{ $product->description }}
                            </p>
                            <div class="mt-2">
                                <span class="text-lg sm:text-xl font-black text-gray-900">{{ number_format($product->price, 2) }} ₴</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex justify-end">
                            @can('admin')
                                <form action="{{ route('product.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Видалити цю страву?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 p-2 rounded-full hover:bg-red-50 transition">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            @endcan
                        <button @click="addToCart({ id: {{ $product->id }}, name: '{{ $product->name }}', price: {{ $product->price }} })" 
                                class="bg-gray-100 p-3 rounded-full hover:bg-indigo-600 hover:text-white transition group">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        {{-- @can('admin')
            <div class="absolute top-4 right-4 z-10">
                <form action="{{ route('restaurant.destroy', $restaurant->id) }}" method="POST" onsubmit="return confirm('Ви впевнені, що хочете видалити цей заклад?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-full shadow-md transition transform active:scale-95">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </form>
            </div>
        @endcan --}}

        <div class="w-full lg:w-96 shrink-0">
            <div class="bg-white p-6 sm:p-8 rounded-3xl shadow-xl lg:sticky lg:top-8 border border-gray-50">
                <h2 class="text-xl sm:text-2xl font-black text-gray-800 mb-6 text-center">Ваше замовлення</h2>

                <div class="space-y-4 max-h-[300px] lg:max-h-[400px] overflow-y-auto pr-2 mb-6">
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
                            <span class="font-black text-indigo-600 text-sm" x-text="item.price.toFixed(2) + ' ₴'"></span>
                        </div>
                    </template>
                </div>

                <div x-show="cart.length > 0" x-transition class="pt-6 border-t border-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <span class="text-gray-400 font-bold uppercase text-[10px] sm:text-xs tracking-widest">Разом до сплати:</span>
                        <span class="text-2xl sm:text-3xl font-black text-indigo-600" x-text="getTotal() + ' ₴'"></span>
                    </div>
                    <button class="w-full bg-indigo-600 text-white py-4 rounded-2xl font-bold text-base sm:text-lg hover:bg-indigo-700 shadow-lg shadow-indigo-100 transition active:scale-95">
                        Оформити замовлення
                    </button>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>