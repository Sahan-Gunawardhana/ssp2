<x-guest-layout>
    <div class="max-w-md p-6 mx-auto mt-10 bg-white rounded-lg shadow-lg">
        <h2 class="mb-4 text-3xl font-bold text-center text-green-500">Welcome Back!</h2>
        <x-validation-errors class="mb-4" />

        @if (session('status'))
        <div class="mb-4 text-sm font-medium text-green-600">
            {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block mb-1 font-semibold text-gray-700">{{ __('Pet Owner Email') }}</label>
                <x-input id="email" class="block w-full p-2 border border-gray-300 rounded-lg" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mb-4">
                <label for="password" class="block mb-1 font-semibold text-gray-700">{{ __('Password') }}</label>
                <x-input id="password" class="block w-full p-2 border border-gray-300 rounded-lg" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="flex items-center mb-4">
                <x-checkbox id="remember_me" name="remember" />
                <label for="remember_me" class="ml-2 text-sm text-gray-600">{{ __('Remember my furry friends!') }}</label>
            </div>

            <div class="flex items-center justify-between mb-4">
                @if (Route::has('password.request'))
                <a class="text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
                @endif
            </div>

            <x-button class="w-full py-2 mb-4 text-white bg-green-500 rounded-lg hover:bg-green-600">
                {{ __('Log in to Your Pawsome Account!') }}
            </x-button>

            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="block mt-4 font-semibold text-center text-green-500 hover:text-green-700">
                {{ __('Join the Pawsome Family!') }}
            </a>
            @endif
        </form>
    </div>
    <script>
        document.querySelector('form').addEventListener('submit', function(event){
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            axios.post('api/login',{
                email: email,
                password: password
            })
            .then(response => {
                localStorage.setItem('authToken', response.data.token);
            })
            .catch(error => {
                console.error('login failed', error);
                alert('Invalid login creds');
            })
        })
    </script>
</x-guest-layout>
        

