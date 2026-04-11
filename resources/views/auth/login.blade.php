<x-guest-layout>
    <!-- Background styling for the page -->
    <style>
        body {
            background-color: white !important;
        }
    </style>

    <!-- Side Graphics and Layout Container -->
    <div class="fixed top-0 left-0 w-full h-full overflow-hidden z-[-1] hidden md:block">
        <!-- Light transparent red curve -->
        <div class="absolute bg-[#e2caca] h-[1271px] left-[0] opacity-30 top-[0] w-[1440px] pointer-events-none"></div>
        <!-- Dark red curve shape -->
        <div class="absolute bg-[#a20202] h-[463px] left-[260px] rounded-[100px] top-[507px] w-[918px] pointer-events-none"></div>
    </div>

    <!-- Login Form Area Container -->
    <div class="relative z-10 w-full max-w-md mx-auto">
        <div class="mb-10 text-center relative">
            <h2 class="text-4xl font-sans font-bold text-white tracking-widest relative z-10 mt-12 bg-[#395697] inline-block px-10 py-3 rounded-[30px] shadow-lg">LOGIN</h2>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Username/Email -->
            <div class="relative">
                <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Masukkan Username" class="bg-white border-4 border-[#020202] border-solid w-full h-[91px] rounded-[10px] pl-[60px] text-xl font-sans font-bold text-[#666] focus:ring-[#395697] focus:border-[#395697] pt-[15px] pb-[15px]" />
                <div class="absolute left-6 top-1/2 -translate-y-1/2 h-[35px] w-[21px] flex items-center justify-center">
                    <div class="h-[35px] w-[2px] bg-[#020202] rotate-90"></div>
                </div>
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />

            <!-- Password -->
            <div class="relative mt-6">
                <x-text-input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Masukkan Password" class="bg-white border-4 border-[#020202] border-solid w-full h-[91px] rounded-[10px] pl-[60px] text-xl font-sans font-bold text-[#666] focus:ring-[#395697] focus:border-[#395697] pt-[15px] pb-[15px]" />
                <div class="absolute left-6 top-1/2 -translate-y-1/2 h-[35px] w-[21px] flex items-center justify-center">
                    <div class="h-[35px] w-[2px] bg-[#020202] rotate-90"></div>
                </div>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />

            <div class="flex items-center justify-between mt-4">
                <div class="flex items-center">
                    <input id="remember_me" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-[#395697] focus:ring-[#395697]" name="remember">
                    <label for="remember_me" class="ml-2 block text-sm leading-6 text-gray-900 font-semibold">{{ __('Remember me') }}</label>
                </div>

                @if (Route::has('password.request'))
                    <div class="text-sm leading-6">
                        <a href="{{ route('password.request') }}" class="font-bold text-[#395697] hover:text-blue-800 transition-colors">
                            {{ __('Lupa Password?') }}
                        </a>
                    </div>
                @endif
            </div>

            <div class="mt-8 text-center pt-8">
                <button type="submit" class="w-full bg-[#395697] hover:bg-blue-800 text-white font-bold py-4 rounded-[10px] text-xl tracking-wider transition-colors shadow-md border-2 border-black">
                    {{ __('MASUK') }}
                </button>
            </div>
        </form>

        <p class="mt-8 text-center text-sm font-semibold text-gray-600">
            Belum punya akun?
            <a href="{{ route('register') }}" class="font-bold leading-6 text-[#a20202] hover:text-red-900 transition-colors">Daftar sekarang</a>
        </p>
    </div>
</x-guest-layout>

