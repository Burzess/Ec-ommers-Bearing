<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Hapus Akun
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Setelah akun Anda dihapus, seluruh data akun akan dihapus permanen. Pastikan Anda sudah menyimpan data
            penting sebelum melanjutkan.
        </p>
    </header>

    <button type="button" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="inline-flex items-center justify-center rounded-lg bg-[#500000] px-8 py-3 text-sm font-bold uppercase tracking-wide text-white transition hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-[#500000] focus:ring-offset-2">
        Hapus Akun
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                Apakah Anda yakin ingin menghapus akun?
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                Tindakan ini tidak dapat dibatalkan. Masukkan password Anda untuk mengonfirmasi penghapusan akun secara
                permanen.
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="Password" class="sr-only" />

                <x-text-input id="password" name="password" type="password"
                    class="mt-1 block w-3/4 focus:ring-[#500000]" placeholder="Masukkan password" />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <button type="button" x-on:click="$dispatch('close')"
                    class="inline-flex items-center justify-center rounded-lg border border-[#500000] bg-white px-6 py-2 text-sm font-semibold text-[#500000] transition hover:bg-[#f6eeee] focus:outline-none focus:ring-2 focus:ring-[#500000] focus:ring-offset-2">
                    Batal
                </button>

                <button type="submit"
                    class="ms-3 inline-flex items-center justify-center rounded-lg bg-[#500000] px-6 py-2 text-sm font-bold uppercase tracking-wide text-white transition hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-[#500000] focus:ring-offset-2">
                    Hapus Akun
                </button>
            </div>
        </form>
    </x-modal>
</section>