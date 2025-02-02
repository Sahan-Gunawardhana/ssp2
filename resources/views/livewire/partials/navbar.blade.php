<header class="sticky top-0 z-50 bg-white shadow-sm">
    <nav class="container flex items-center justify-between px-4 py-3 mx-auto">
        <div class="flex items-center">
            <img src="{{ asset('images/pawsome.png') }}" alt="Pawsome Logo" class="w-24 h-16">
            <span class="ml-2 text-xl font-semibold text-black">Pawsome Pet Care</span>
        </div>
        <div class="flex items-center space-x-6">
            <a wire:navigate href="{{ url('/') }}" 
                class="text-lg link {{ request()->is('/') ? 'text-green-500 font-bold' : '' }}">Home</a>

            <a wire:navigate href="{{ url('/store') }}" 
                class="text-lg link {{ request()->is('store') ? 'text-green-500 font-bold' : '' }}">Shop</a>

            @auth
                <a wire:navigate href="/appointments" 
                    class="text-lg link {{ request()->is('appointments') ? 'text-green-500 font-bold' : '' }}">Services</a>
            @endauth

            @guest
                <a wire:navigate href="{{ route('login') }}" 
                    class="text-lg link {{ request()->is('login') ? 'text-green-500 font-bold' : '' }}">Services</a>
            @endguest

            @auth
                @livewire('navigation-menu')
                <a wire:navigate href="{{ url('/cart') }}" class="flex items-center space-x-2 link {{ request()->is('cart') ? 'text-green-500 font-bold' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000">
                        <path d="M280-80q-33 0-56.5-23.5T200-160q0-33 23.5-56.5T280-240q33 0 56.5 23.5T360-160q0 33-23.5 56.5T280-80Zm400 0q-33 0-56.5-23.5T600-160q0-33 23.5-56.5T680-240q33 0 56.5 23.5T760-160q0 33-23.5 56.5T680-80ZM246-720l96 200h280l110-200H246Zm-38-80h590q23 0 35 20.5t1 41.5L692-482q-11 20-29.5 31T622-440H324l-44 80h480v80H280q-45 0-68-39.5t-2-78.5l54-98-144-304H40v-80h130l38 80Zm134 280h280-280Z"/>
                    </svg>
                
                    <!-- Cart item count -->
                    <span class="px-2 py-1 text-xs font-bold text-white bg-red-500 rounded-full">
                        {{ $total_count}}
                    </span>
                </a>
            @endauth
        </div>
    </nav>
</header>