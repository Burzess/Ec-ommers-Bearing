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

            <!-- Description -->
            <div class="text-center text-white text-sm mb-6 max-w-[400px]">
                Lupa password? Masukkan email Anda dan kami akan mengirimkan link reset password.
            </div>

            <form method="POST" action="{{ route('password.email') }}" class="w-full max-w-[400px] flex flex-col items-center space-y-4">
                @csrf

                <!-- Email Input -->
                <div class="w-full">
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="Email"
                        class="w-full h-[60px] rounded-[8px] border border-[#020202] bg-white pl-[25px] text-[16px] font-bold text-[#666666] placeholder:text-[#666666] focus:border-[#395697] focus:ring-[#395697]"
                    />
                    <x-input-error :messages="$errors->get('email')" class="text-white text-sm mt-1" />
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-[200px] h-[50px] rounded-[20px] bg-[#395697] text-[16px] font-bold text-white hover:bg-[#2a437a] flex items-center justify-center shadow-lg">
                    KIRIM LINK RESET
                </button>

            </form>

            <!-- Back to Login Link -->
            <p class="text-center text-[14px] font-semibold text-[#666666] mt-6">
                <a href="{{ route('login') }}" class="font-bold text-[#395697] hover:text-[#2a437a] underline">Kembali ke Login</a>
            </p>
        </div>
    </div>
</x-guest-layout>
