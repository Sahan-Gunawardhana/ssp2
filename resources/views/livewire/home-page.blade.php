
<div class="container px-4 py-8 mx-auto">
    <!-- Welcome Section -->
    <section class="mb-12 text-center">
        <h1 class="mb-4 text-4xl font-bold">Welcome to Pawsome Pet Care</h1>
        <p class="mb-6 text-xl text-gray-600">Every pet's happiness starts with us!</p>
        @if (Route::has('login'))
        <nav class="flex justify-center flex-1 gap-6">
            @auth

            @else
            <a href="{{ route('login') }}" class="fixed-button ">Log in</a>
            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="fixed-button">Register</a>
            @endif
            @endauth
        </nav>
        @endif
    </section>
    <section class="mb-12 rounded-sm">
        <video src="{{ asset('videos/vid1.mp4') }}" class="object-cover w-full rounded-lg h-screen/2" autoplay controls muted></video>
    </section>
    <!-- Featured Products -->
    <section class="mb-12">
        <div class="grid items-start grid-cols-1 gap-6 md:grid-cols-2">
            <div>
                <h2 class="mb-4 text-2xl font-bold">Featured Products</h2>
                <p class="mb-4 text-gray-600">Discover top picks for your pet's happiness with our featured products!</p>
                <button class="fixed-button">Explore</button>
            </div>
            <div class="flex flex-col space-y-6">
                <img src="{{ asset('images/cattree.jpg') }}" alt="Cat tree" class="ft-card" />
                <img src="{{ asset('images/dogbed.jpg') }}" alt="Dog bed" class="ft-card" />
            </div>
        </div>
    </section>
    <!-- New Arrivals -->
    <section class="mb-12">
        <div class="grid items-start grid-cols-1 gap-6 md:grid-cols-2">
            <div>
                <h2 class="mb-4 text-2xl font-bold">New Arrivals</h2>
                <p class="mb-4 text-gray-600">Discover our new picks to make your pet's life happier and healthier!</p>
                <button class="fixed-button">Explore</button>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <img src="{{asset('images/harness.jpg')}}" alt="Pet harness" class="home-card" />
                <img src="{{asset('images/toys.jpg')}}" alt="Pet toys" class="home-card" />
                <img src="{{asset('images/catbag.webp')}}" alt="Pet accessories" class="home-card" />
                <img src="{{asset('images/catdog.jpg')}}" alt="Pet playing" class="home-card" />
            </div>
        </div>
    </section>
    <!-- Reviews Section -->
    <section class="mb-12">
        <h2 class="mb-4 text-2xl font-bold">Reviews</h2>
        <p class="mb-4 text-gray-600">See what our happy customers are saying about Pawsome Pet Care!</p>
        <button class="fixed-button">Leave a review</button>
        <div class="grid grid-cols-1 gap-6 mt-6 md:grid-cols-2">
            <div class="p-4 bg-teal-100 rounded-lg shadow-md">
                <h3 class="mb-2 font-semibold">Customer Name</h3>
                <p class="mb-2">This is where the review text will appear.</p>
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" stroke="currentColor">
                        <path d="M10 15l3.09 1.545-.832-3.905 2.948-2.687-3.896-.276L10 6l-1.31 3.682-3.896.276 2.948 2.687-.832 3.905L10 15z" />
                    </svg>
                    <svg class="w-5 h-5 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" stroke="currentColor">
                        <path d="M10 15l3.09 1.545-.832-3.905 2.948-2.687-3.896-.276L10 6l-1.31 3.682-3.896.276 2.948 2.687-.832 3.905L10 15z" />
                    </svg>
                    <svg class="w-5 h-5 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" stroke="currentColor">
                        <path d="M10 15l3.09 1.545-.832-3.905 2.948-2.687-3.896-.276L10 6l-1.31 3.682-3.896.276 2.948 2.687-.832 3.905L10 15z" />
                    </svg>
                    <svg class="w-5 h-5 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" stroke="currentColor">
                        <path d="M10 15l3.09 1.545-.832-3.905 2.948-2.687-3.896-.276L10 6l-1.31 3.682-3.896.276 2.948 2.687-.832 3.905L10 15z" />
                    </svg>
                    <svg class="w-5 h-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" stroke="currentColor">
                        <path d="M10 15l3.09 1.545-.832-3.905 2.948-2.687-3.896-.276L10 6l-1.31 3.682-3.896.276 2.948 2.687-.832 3.905L10 15z" />
                    </svg>
                </div>
                <p class="mt-2 text-sm text-gray-500">Date</p>
            </div>
    
            <!-- Repeat for more reviews -->
            <div class="p-4 bg-teal-100 rounded-lg shadow-md">
                <h3 class="mb-2 font-semibold">Customer Name</h3>
                <p class="mb-2">This is where the review text will appear.</p>
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" stroke="currentColor">
                        <path d="M10 15l3.09 1.545-.832-3.905 2.948-2.687-3.896-.276L10 6l-1.31 3.682-3.896.276 2.948 2.687-.832 3.905L10 15z" />
                    </svg>
                    <svg class="w-5 h-5 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" stroke="currentColor">
                        <path d="M10 15l3.09 1.545-.832-3.905 2.948-2.687-3.896-.276L10 6l-1.31 3.682-3.896.276 2.948 2.687-.832 3.905L10 15z" />
                    </svg>
                    <svg class="w-5 h-5 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" stroke="currentColor">
                        <path d="M10 15l3.09 1.545-.832-3.905 2.948-2.687-3.896-.276L10 6l-1.31 3.682-3.896.276 2.948 2.687-.832 3.905L10 15z" />
                    </svg>
                    <svg class="w-5 h-5 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" stroke="currentColor">
                        <path d="M10 15l3.09 1.545-.832-3.905 2.948-2.687-3.896-.276L10 6l-1.31 3.682-3.896.276 2.948 2.687-.832 3.905L10 15z" />
                    </svg>
                    <svg class="w-5 h-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" stroke="currentColor">
                        <path d="M10 15l3.09 1.545-.832-3.905 2.948-2.687-3.896-.276L10 6l-1.31 3.682-3.896.276 2.948 2.687-.832 3.905L10 15z" />
                    </svg>
                </div>
                <p class="mt-2 text-sm text-gray-500">Date</p>
            </div>
        </div>
    </section>
    <!-- Newsletter Subscription -->
    <section>
        <h2 class="mb-4 text-2xl font-bold">Subscribe to our Newsletter</h2>
        <p class="mb-4 text-gray-600">Stay updated with the latest pet care tips and deals—subscribe to our newsletter!</p>
        <form class="flex">
            <input type="email" placeholder="E-mail" class="flex-grow p-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-green-500">
            <button type="submit" class="px-4 py-2 text-white transition duration-300 bg-green-500 rounded-r-lg hover:bg-green-600">Subscribe</button>
        </form>
    </section>
</div>