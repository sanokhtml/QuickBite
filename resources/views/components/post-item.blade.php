<div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition-all group">
    <a href="{{ route('restaurant.show', $restaurant->slug) }}">
        <!-- Баннер -->
        <div class="h-44 overflow-hidden relative">
            <img src="{{ $restaurant->getFirstMediaUrl('covers') ?: asset('images/default.png') }}" 
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        </div>

        <!-- Інфо -->
        <div class="p-5">
            <h2 class="text-xl font-bold text-gray-900 mb-1">{{ $restaurant->name }}</h2>
            
            <div class="flex items-center gap-4 text-sm font-bold text-gray-400">
                <!-- Час доставки -->
                <span>{{ $restaurant->delivery_time ?? '20-30' }} хв</span>
                
                <!-- Ціна доставки -->
                <span class="text-gray-900">{{ number_format($restaurant->delivery_price, 2) }} ₴</span>
            </div>
        </div>
    </a>
</div>