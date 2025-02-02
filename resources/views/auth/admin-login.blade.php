<x-guest-layout>
    <div class="max-w-md p-6 mx-auto mt-10 bg-white rounded-lg shadow-lg">
        
        <x-validation-errors class="mb-4" />
        <h1 class="text-center ">Admin Login</h1>    
        @session('status')
            <div class="mb-4 text-sm font-medium text-green-600">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block w-full mt-1" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="text-sm text-gray-600 ms-2">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ms-4">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
        <script>
            document.querySelector('form').addEventListener('submit', function(event){
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            fetch('/api/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    email: email,
                    password: password
                })
            })
            .then(response => response.json())
            .then(data => {
                // Assuming the API returns a plain text token in `data.token`
                if (data.token) {
                    // Save the token in localStorage
                    localStorage.setItem('authToken', data.token);
                    console.log('Token saved:', data.token);
                } else {
                    alert('Login failed: Token not received');
                }
            })
            .catch(error => {
                console.error('Login failed', error);
                alert('An error occurred. Please try again.');
            });
        });
        </script>
    </div>
</x-guest-layout>
