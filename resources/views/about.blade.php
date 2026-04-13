<x-app-layout>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const img = document.querySelector('img[alt="Asian Bearindo Jaya"]');
            const placeholder = document.getElementById('image-placeholder');

            if (img) {
                img.addEventListener('error', function() {
                    img.style.display = 'none';
                    placeholder.style.display = 'flex';
                });

                // Check if image is already broken
                if (img.complete && img.naturalHeight === 0) {
                    img.style.display = 'none';
                    placeholder.style.display = 'flex';
                }
            }
        });
    </script>

    <!-- Main Content -->
    <div class="min-h-screen bg-white py-12">
        <div class="mx-auto max-w-[1440px] px-4 md:px-8">
            <!-- CONTACT US Heading -->
            <div class="mb-6 text-center">
                <h1 class="text-4xl font-bold text-black md:text-5xl">CONTACT US</h1>
            </div>

            <!-- Subtitle -->
            <div class="mb-8 text-center">
                <p class="text-xl text-black md:text-2xl">Hubungi Kami untuk Informasi Produk & Pemesanan</p>
            </div>

            <!-- Decorative Bars -->
            <div class="mb-12 flex justify-center gap-2">
                <div class="h-3 w-32 rounded bg-[#e18a8a]"></div>
                <div class="h-3 w-32 rounded bg-[#a20202]"></div>
                <div class="h-3 w-32 rounded bg-[#e18a8a]"></div>
            </div>

            <!-- Two Column Layout -->
            <div class="grid gap-8 lg:grid-cols-2">
                <!-- Contact Form -->
                <div class="rounded-3xl border-2 border-gray-300 bg-white p-8 shadow-lg">
                    <!-- Kirim Pesan Section Title -->
                    <div class="mb-6">
                        <h2 class="text-3xl font-bold text-black md:text-4xl">Kirim Pesan</h2>
                        <div class="mt-2 flex gap-2">
                            <div class="h-1 w-20 rounded bg-[#a20202]"></div>
                            <div class="h-1 w-20 rounded bg-[#e18a8a]"></div>
                        </div>
                    </div>

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Nama Lengkap -->
                        <div class="relative">
                            <label for="name" class="block text-xl font-medium text-black mb-2">Nama Lengkap</label>
                            <div class="relative">
                                <svg class="absolute left-4 top-1/2 h-6 w-6 -translate-y-1/2 text-gray-500"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <input type="text" id="name" name="name" required
                                    class="w-full rounded-2xl border-2 border-gray-300 bg-white py-3 pl-12 pr-4 text-lg text-black placeholder-gray-500 focus:border-[#a20202] focus:outline-none"
                                    placeholder="Masukkan nama lengkap Anda">
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="relative">
                            <label for="email" class="block text-xl font-medium text-black mb-2">Email</label>
                            <div class="relative">
                                <svg class="absolute left-4 top-1/2 h-6 w-6 -translate-y-1/2 text-gray-500"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <input type="email" id="email" name="email" required
                                    class="w-full rounded-2xl border-2 border-gray-300 bg-white py-3 pl-12 pr-4 text-lg text-black placeholder-gray-500 focus:border-[#a20202] focus:outline-none"
                                    placeholder="Masukkan email Anda">
                            </div>
                        </div>

                        <!-- WhatsApp -->
                        <div class="relative">
                            <label for="whatsapp" class="block text-xl font-medium text-black mb-2">Nomor
                                WhatsApp</label>
                            <div class="relative">
                                <svg class="absolute left-4 top-1/2 h-6 w-6 -translate-y-1/2 text-gray-500"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <input type="tel" id="whatsapp" name="whatsapp" required
                                    class="w-full rounded-2xl border-2 border-gray-300 bg-white py-3 pl-12 pr-4 text-lg text-black placeholder-gray-500 focus:border-[#a20202] focus:outline-none"
                                    placeholder="Masukkan nomor WhatsApp Anda">
                            </div>
                        </div>

                        <!-- Subjek Pesan -->
                        <div class="relative">
                            <label for="subject" class="block text-xl font-medium text-black mb-2">Subjek
                                Pesan</label>
                            <div class="relative">
                                <select id="subject" name="subject" required
                                    class="w-full appearance-none rounded-2xl border-2 border-gray-300 bg-white py-3 pl-4 pr-12 text-lg text-black focus:border-[#a20202] focus:outline-none">
                                    <option value="">Pilih Subjek</option>
                                    <option value="inquiry">Pertanyaan Produk</option>
                                    <option value="order">Pemesanan</option>
                                    <option value="support">Dukungan Teknis</option>
                                    <option value="other">Lainnya</option>
                                </select>
                                <svg class="absolute right-4 top-1/2 h-6 w-6 -translate-y-1/2 text-gray-500"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>

                        <!-- Pesan Anda -->
                        <div class="relative">
                            <label for="message" class="block text-xl font-medium text-black mb-2">Pesan Anda</label>
                            <textarea id="message" name="message" rows="6" required
                                class="w-full resize-none rounded-2xl border-2 border-gray-300 bg-white p-4 text-lg text-black placeholder-gray-500 focus:border-[#a20202] focus:outline-none"
                                placeholder="Tulis pesan di sini..."></textarea>
                        </div>

                        <!-- Kirim Pesan Button -->
                        <div class="pt-4">
                            <button type="submit"
                                class="flex items-center justify-center gap-3 rounded-2xl bg-[#a20202] px-8 py-4 text-xl font-medium text-white transition-colors hover:bg-[#8a0202] focus:outline-none focus:ring-2 focus:ring-[#a20202] focus:ring-offset-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                                </svg>
                                Kirim Pesan
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Company Information -->
                <div class="space-y-8 bg-white rounded-3xl border-2 border-gray-300 p-8 shadow-lg">
                    <!-- Informasi Perusahaan Section Title -->
                    <div class="mb-6">
                        <h2 class="text-3xl font-bold text-black md:text-4xl">Informasi Perusahaan</h2>
                        <div class="mt-2 flex gap-2">
                            <div class="h-1 w-20 rounded bg-[#a20202]"></div>
                            <div class="h-1 w-20 rounded bg-[#e18a8a]"></div>
                        </div>
                    </div>

                    <!-- Company Name -->
                    <div class="px-6 flex items-start gap-4">
                        <div class="flex-shrink-0 mt-1">
                            <svg class="h-8 w-8 text-[#a20202]" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-medium text-black">Asian Bearindo Jaya - Surabaya</h3>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="px-6 flex items-start gap-4">
                        <div class="flex-shrink-0 mt-1">
                            <svg class="h-8 w-8 text-[#a20202]" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-xl font-medium text-black mb-2">Telepon</h4>
                            <p class="text-lg text-black">+62 812-3456-7890</p>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="px-6 flex items-start gap-4">
                        <div class="flex-shrink-0 mt-1">
                            <svg class="h-8 w-8 text-[#a20202]" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-xl font-medium text-black mb-2">Email</h4>
                            <p class="text-lg text-black">admin@asianbearindo.com</p>
                        </div>
                    </div>

                    <!-- Business Hours -->
                    <div class="px-6 flex items-start gap-4 pb-6">
                        <div class="flex-shrink-0 mt-1">
                            <svg class="h-8 w-8 text-[#a20202]" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-xl font-medium text-black mb-2">Jam Kerja</h4>
                            <p class="text-lg text-black">Senin - Jum'at</p>
                            <p class="text-xl font-bold text-black">08.00 - 17.00</p>
                        </div>
                    </div>

                    <!-- Lokasi & Maps -->
                    <div class="px-6 flex items-start gap-4">
                        <div class="flex-shrink-0 mt-1">
                            <svg class="h-8 w-8 text-[#a20202]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div class="w-full">
                            <h4 class="text-xl font-medium text-black mb-2">Lokasi Kami</h4>
                            <p class="text-lg text-black leading-relaxed mb-4">Jl. Tanjungsari no. 19, Sukomanunggal</p>
                            
                            <div class="h-64 overflow-hidden rounded-2xl bg-gray-200">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15831.43723628913!2d112.67946124076845!3d-7.25684857497332!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7ff936876686d%3A0xa3fa7db480604775!2sPT.%20Asian%20Bearindo%20Jaya%20(HQ)!5e0!3m2!1sid!2sid!4v1775962861342!5m2!1sid!2sid"
                                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if (session('success'))
        <div class="fixed bottom-4 right-4 z-50 rounded-lg bg-green-500 px-6 py-3 text-white shadow-lg">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="fixed bottom-4 right-4 z-50 rounded-lg bg-red-500 px-6 py-3 text-white shadow-lg">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</x-app-layout>
