@props(["category" => [], "all" => false])

@unless($all)
    <div class="swiper-slide menu-slide transition-all p-5 text-center cursor-pointer hover:bg-red-500 hover:text-white">
        <a href="{{ route('products.category', $category->id) }}">
        <input type="hidden" value="{{ asset($category->white_image) }}" class="whiteImage">
        <input type="hidden" value="{{ asset($category->image) }}" class="image">
        <div class="flex flex-col gap-4">
            <div>
                <img class="menu-icon mx-auto" src="{{ asset($category->image) }}"
                     alt="burger">
            </div>
            <div>
                <p>{{ $category->name }}</p>
            </div>
        </div>
        </a>
    </div>
@else
    <div class="swiper-slide menu-slide transition-all p-5 text-center cursor-pointer hover:bg-red-500 hover:text-white">
        <a href="{{ route('page.menu') }}">
            <div class="flex flex-col gap-4">
                <div>
                    <img class="menu-icon mx-auto" src="{{ asset('storage/icons/all.png') }}"
                         alt="All">
                </div>
                <div>
                    <p>All Categories</p>
                </div>
            </div>
        </a>
    </div>
@endunless
