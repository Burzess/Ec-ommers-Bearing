<x-guest-layout>
    <div class="sm:mx-auto sm:w-full sm:max-w-sm mb-6">
        <h2 class="mt-2 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign in to your account</h2>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" />
            <div class="mt-2">
                <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Enter your email" />    
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />    
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between">
                <x-input-label for="password" :value="__('Password')" />
                @if (Route::has('password.request'))
                    <div class="text-sm leading-6">
                        <a href="{{ route('password.request') }}" class="font-semibold text-red-600 hover:text-red-500 transition-colors">
                            {{ __('Forgot password?') }}
                        </a>
                    </div>
                @endif
            </div>
            <div class="mt-2">
                <x-text-input id="password"
                                type="password"
                                name="password"
                                required autocomplete="current-password" placeholder="Enter your password" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" /> 
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-red-600 focus:ring-red-600" name="remember">        
            <label for="remember_me" class="ml-3 block text-sm leading-6 text-gray-900">{{ __('Remember me') }}</label>
        </div>

        <div>
            <x-primary-button>
                {{ __('Sign in') }}
            </x-primary-button>
        </div>
    </form>

    <p class="mt-10 text-center text-sm text-gray-500">
        Not a member?
        <a href="{{ route('register') }}" class="font-semibold leading-6 text-red-600 hover:text-red-500 transition-colors">Create an account</a>
    </p>
