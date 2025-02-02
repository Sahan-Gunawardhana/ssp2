<div class="w-full p-6 bg-white rounded-lg shadow-lg">
    

    <!-- Section Title and Description -->
    <section class="mb-12 text-center">
        <h2 class="mb-4 text-3xl font-bold">Explore Our Services</h2>
        <p class="mb-6 text-xl text-gray-600">Tailored solutions for your pet's every need, from personalized care to puppy day care.</p>
    </section>

    <!-- Services Grid -->
    <div class="grid gap-8 mb-12">
        <!-- Doggy Daycare Service -->
        <div class="flex flex-col items-start p-6 rounded-lg md:flex-row text-start">
            <div class="w-full pr-4 md:w-2/3">
                <h2 class="mb-4 text-2xl font-bold">Pawsome Doggy Daycare</h2>
                <p class="mb-4 text-gray-600">Your dog's home away from home, filled with fun, friends, and expert care!</p>
                <button class="fixed-button" wire:click="exploreDaycare">Explore</button>
            </div>
            <div class="w-full mt-4 md:w-1/3 md:mt-0">
                <img src="{{ asset('images/daycare.jpg') }}" alt="Doggy daycare" class="ft-card">
            </div>
        </div>

        <!-- Veterinary Care Service -->
        <div class="flex flex-col items-start p-6 rounded-lg md:flex-row">
            <div class="w-full pr-4 md:w-2/3">
                <h2 class="mb-4 text-2xl font-bold">Pawsome Veterinary Care</h2>
                <p class="mb-4 text-gray-600">Expert care to keep your pet healthy, happy, and thriving!</p>
                <button class="fixed-button" wire:click="exploreVeterinaryCare">Explore</button>
            </div>
            <div class="w-full mt-4 md:w-1/3 md:mt-0">
                <img src="{{ asset('images/catto.jpg') }}" alt="Veterinary care" class="ft-card">
            </div>
        </div>
    </div>

    <!-- Appointment Form -->
    @auth
    <form wire:submit.prevent="submit" class="w-full space-y-6">
        <!-- Pet Name -->
        <div>
            <label for="pet_name" class="block text-lg font-medium text-gray-700">Pet Name</label>
            <input type="text" id="pet_name" wire:model="pet_name" class="w-full p-3 mt-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            @error('pet_name') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        <!-- Pick-up Date -->
        <div class="flex space-x-4">
            <div class="w-full md:w-1/2">
                <label for="drop_off_date" class="block text-lg font-medium text-gray-700">Drop-off Date</label>
                <input type="date" id="drop_off_date" wire:model="drop_off_date"
                    class="w-full p-3 mt-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('drop_off_date') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="w-full md:w-1/2">
                <label for="pick_up_date" class="block text-lg font-medium text-gray-700">Pick-up Date</label>
                <input type="date" id="pick_up_date" wire:model="pick_up_date" class="w-full p-3 mt-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('pick_up_date') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
        
        </div>

        <!--Health conditions -->
        <div>
            <label for="health" class="block text-lg font-medium text-gray-700">Allergies/Health Conditions</label>
                <input type="text" id="health" wire:model="health" class="w-full p-3 mt-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('health') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>
        <!-- Notes -->
        <div>
            <label for="notes" class="block text-lg font-medium text-gray-700">Notes</label>
            <textarea id="notes" wire:model="notes" class="w-full p-3 mt-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
            @error('notes') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full fixed-button">
            Confirm
        </button>

        @if (session()->has('success'))
            <div class="mb-4 text-lg font-semibold text-green-500">{{ session('success') }}</div>
        @endif
        
        @if (session()->has('error'))
            <div class="mb-4 text-lg font-semibold text-red-500">{{ session('error') }}</div>
        @endif
    </form>
@endauth
@guest
    <p>Please log in to view and submit the form.</p>
@endguest
</div>