                    <ul class="flex flex-wrap text-sm font-medium text-center text-body justify-center">
                        <li class="me-2">
                            <a href="/" class="
                            {{ request('category')
                                ? 'inline-block px-4 py-2 rounded-lg hover:text-gray-900 hover:bg-gray-100' 
                                : 'inline-block px-4 py-2.5 text-white bg-[#5F55F8] rounded-lg active'
                            }}"
                                aria-current="page">
                                Всі
                            </a>
                        </li>
                        @forelse ($categories as $category)
                            <li class="me-2">
                                <a href="{{ route('post.byCategory', $category) }}" 
                                class="{{
                                    Route::currentRouteNamed('post.byCategory') && request('category')->id == $category->id 
                                    ? 'inline-block px-4 py-2.5 text-white bg-[#5F55F8] rounded-lg active'
                                    : 'inline-block px-4 py-2.5 rounded-lg hover:text-gray-900 hover:bg-gray-200' 
                                }}" >
                                    {{ $category->name }}
                                </a>
                            </li>
                        @empty
                        {{ $slot }}
                        @endforelse
                    </ul>