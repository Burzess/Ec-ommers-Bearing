<x-guest-layout>
    <div class="min-h-screen bg-white flex flex-col items-center justify-center p-4 font-['Poppins']">

        <!-- Logo -->
        <div class="w-full max-w-[500px] mb-[-60px] mt-[-30px]">
            <img src="{{ asset('images/logo_bearindo.png') }}" alt="Logo Bearindo" class="w-full h-auto object-contain">
        </div>

        <!-- Red Card Container -->
        <div class="relative w-full max-w-[600px] min-h-[350px] bg-[#a20202] rounded-[60px] flex flex-col items-center justify-center p-6 shadow-xl">

            <!-- Status Messages -->
            <div class="absolute top-4 left-1/2 transform -translate-x-1/2 text-center">
                <x-auth-session-status class="text-white text-sm" :status="session('status')" />
            </div>

            <form method="POST" action="{{ route('login') }}" class="w-full max-w-[400px] flex flex-col items-center space-y-4 mt-6">
                @csrf

                <!-- Username Input -->
                <div class="w-full">
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="Masukkan Username"
                        class="w-full h-[60px] rounded-[8px] border border-[#020202] bg-white pl-[25px] text-[16px] font-bold text-[#666666] placeholder:text-[#666666] focus:border-[#395697] focus:ring-[#395697]"
                    />
                    <x-input-error :messages="$errors->get('email')" class="text-white text-sm mt-1" />
                </div>

                <!-- Password Input -->
                <div class="w-full">
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="Masukkan Password"
                        class="w-full h-[60px] rounded-[8px] border border-[#020202] bg-white pl-[25px] text-[16px] font-bold text-[#666666] placeholder:text-[#666666] focus:border-[#395697] focus:ring-[#395697]"
                    />
                    <x-input-error :messages="$errors->get('password')" class="text-white text-sm mt-1" />
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="w-full flex items-center justify-between text-white text-sm">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-200 text-[#395697] shadow-sm focus:ring-[#395697]" name="remember">
                        <span class="ms-2 font-semibold">{{ __('Remember me') }}</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="font-bold text-gray-200 hover:text-white underline">{{ __('Lupa Password?') }}</a>
                    @endif
                </div>

                <!-- LOGIN Button -->
                <button type="submit" class="w-[140px] h-[50px] rounded-[20px] bg-[#395697] text-[24px] font-bold text-white hover:bg-[#2a437a] flex items-center justify-center shadow-lg">
                    LOGIN
                </button>

            </form>

            <!-- Register Link -->
            <p class="text-center text-[14px] font-semibold text-gray-200 mt-6">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-bold text-[#395697] hover:text-[#2a437a] underline">Daftar sekarang</a>
            </p>
        </div>
    </div>
</x-guest-layout>
