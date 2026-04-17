<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Ubah Password
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Pastikan akun Anda menggunakan password yang kuat agar tetap aman.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div x-data="{ show: false }">
            <x-input-label for="update_password_current_password" :value="__('Password Saat Ini')" />
            <div class="relative mt-1">
                <x-text-input id="update_password_current_password" name="current_password" type="password"
                    x-bind:type="show ? 'text' : 'password'" class="block w-full pr-12 focus:ring-[#500000]"
                    autocomplete="current-password" />
                <button type="button" @click="show = !show"
                    class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 transition hover:text-[#500000]"
                    :aria-label="show ? 'Sembunyikan password' : 'Tampilkan password'">
                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.8" stroke="currentColor" class="h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.964-7.178Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    <svg x-show="show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.8" stroke="currentColor" class="h-5 w-5" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 3l18 18M10.73 5.08A10.45 10.45 0 0 1 12 5c4.64 0 8.58 3.01 9.96 7.18.07.21.07.43 0 .64a10.96 10.96 0 0 1-4.15 5.58M6.61 6.61A10.97 10.97 0 0 0 2.04 11.68c-.07.21-.07.43 0 .64C3.42 16.49 7.36 19.5 12 19.5c1.73 0 3.37-.42 4.8-1.16M9.88 9.88a3 3 0 1 0 4.24 4.24" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div x-data="{ show: false }">
            <x-input-label for="update_password_password" :value="__('Password Baru')" />
            <div class="relative mt-1">
                <x-text-input id="update_password_password" name="password" type="password"
                    x-bind:type="show ? 'text' : 'password'" class="block w-full pr-12 focus:ring-[#500000]"
                    autocomplete="new-password" />
                <button type="button" @click="show = !show"
                    class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 transition hover:text-[#500000]"
                    :aria-label="show ? 'Sembunyikan password' : 'Tampilkan password'">
                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.8" stroke="currentColor" class="h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.964-7.178Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    <svg x-show="show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.8" stroke="currentColor" class="h-5 w-5" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 3l18 18M10.73 5.08A10.45 10.45 0 0 1 12 5c4.64 0 8.58 3.01 9.96 7.18.07.21.07.43 0 .64a10.96 10.96 0 0 1-4.15 5.58M6.61 6.61A10.97 10.97 0 0 0 2.04 11.68c-.07.21-.07.43 0 .64C3.42 16.49 7.36 19.5 12 19.5c1.73 0 3.37-.42 4.8-1.16M9.88 9.88a3 3 0 1 0 4.24 4.24" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div x-data="{ show: false }">
            <x-input-label for="update_password_password_confirmation" :value="__('Konfirmasi Password')" />
            <div class="relative mt-1">
                <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password"
                    x-bind:type="show ? 'text' : 'password'" class="block w-full pr-12 focus:ring-[#500000]"
                    autocomplete="new-password" />
                <button type="button" @click="show = !show"
                    class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 transition hover:text-[#500000]"
                    :aria-label="show ? 'Sembunyikan password' : 'Tampilkan password'">
                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.8" stroke="currentColor" class="h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.964-7.178Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    <svg x-show="show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.8" stroke="currentColor" class="h-5 w-5" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 3l18 18M10.73 5.08A10.45 10.45 0 0 1 12 5c4.64 0 8.58 3.01 9.96 7.18.07.21.07.43 0 .64a10.96 10.96 0 0 1-4.15 5.58M6.61 6.61A10.97 10.97 0 0 0 2.04 11.68c-.07.21-.07.43 0 .64C3.42 16.49 7.36 19.5 12 19.5c1.73 0 3.37-.42 4.8-1.16M9.88 9.88a3 3 0 1 0 4.24 4.24" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit"
                class="inline-flex items-center justify-center rounded-lg bg-[#500000] px-8 py-3 text-sm font-bold uppercase tracking-wide text-white transition hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-[#500000] focus:ring-offset-2">
                Simpan
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">Tersimpan</p>
            @endif
        </div>
    </form>
</section>