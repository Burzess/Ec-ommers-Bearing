<x-app-layout>
    <div class="min-h-screen bg-white py-8 sm:py-10">
        <div class="mx-auto max-w-[1100px] px-3 sm:px-4">
            <section class="isolate">
                <div class="relative mx-auto h-[220px] w-full max-w-[760px] text-center sm:h-[220px]">
                    <div class="pointer-events-none absolute inset-0 z-0">
                        <div class="h-full w-full bg-center bg-no-repeat opacity-35"
                            style="background-image: url('{{ asset('images/semua_bearing.jpg') }}'); background-size: 60% auto; background-position: center 30%;">
                        </div>
                        <div class="absolute inset-0 bg-white/40"></div>
                    </div>

                    <div class="relative z-10 mt-2 gap-2 sm:pt-2">
                        <h1 class="text-[20px] font-extrabold uppercase mt-6 text-black sm:text-[40px]">
                            Contact <span class="text-[#a20202]">Us</span>
                        </h1>
                        <p
                            class="mx-auto w-fit text-center items-center whitespace-nowrap text-[18px] font-medium text-black sm:text-[32px]">
                            Hubungi Kami untuk Informasi Produk & Pemesanan
                        </p>
                    </div>

                    <div class="relative z-10 mx-auto mt-2 h-6 w-full max-w-md sm:mt-3">
                        <div class="flex justify-center gap-2">
                            <div class="h-2 w-16 rounded bg-[#e19292]"></div>
                            <div class="h-2 w-16 rounded bg-[#a20202]"></div>
                            <div class="h-2 w-16 rounded bg-[#e19292]"></div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 grid gap-3 sm:mt-6 sm:grid-cols-[5fr_4fr] sm:items-stretch">
                    <div
                        class="h-full rounded-[20px] border-2 border-[#d1d1d1] bg-[#f7f7f7] p-4 shadow-sm sm:p-5 flex flex-col">
                        <div class="mb-4">
                            <h2 class="text-[24px] font-extrabold text-black sm:text-[28px]">Kirim Pesan</h2>
                            <div class="mt-2 flex gap-2">
                                <div class="h-2 w-14 rounded bg-[#a20202]"></div>
                                <div class="h-2 w-14 rounded bg-[#de8a8a]"></div>
                            </div>
                        </div>

                        <form action="{{ route('contact.store') }}" method="POST" class="flex h-full flex-col gap-3">
                            @csrf

                            <div class="relative">
                                <svg class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" class="hidden" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <input type="text" id="name" name="name" required
                                    class="w-full rounded-xl border border-[#500000]/50 bg-white py-3 pl-10 pr-3 text-sm font-medium text-black placeholder-gray-500 focus:border-[#500000] focus:outline-none focus:ring-1 focus:ring-[#500000]"
                                    placeholder="Nama Lengkap">
                            </div>

                            <div class="relative">
                                <svg class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <input type="email" id="email" name="email" required
                                    class="w-full rounded-xl border border-[#500000]/50 bg-white py-3 pl-10 pr-3 text-sm font-medium text-black placeholder-gray-500 focus:border-[#500000] focus:outline-none focus:ring-1 focus:ring-[#500000]"
                                    placeholder="Email">
                            </div>

                            <div class="relative">
                                <svg class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <input type="tel" id="whatsapp" name="whatsapp" required
                                    class="w-full rounded-xl border border-[#500000]/50 bg-white py-3 pl-10 pr-3 text-sm font-medium text-black placeholder-gray-500 focus:border-[#500000] focus:outline-none focus:ring-1 focus:ring-[#500000]"
                                    placeholder="Nomor What' sApp">
                            </div>

                            <div class="flex items-center justify-between gap-3">
                                <label for="subject" class="text-lg font-semibold text-black">Subjek Pesan</label>
                                <div class="relative mr-2 w-[402px] shrink-0 sm:mr-0">
                                    <select id="subject" name="subject" required
                                        class="w-full appearance-none rounded-xl border border-[#500000]/50 bg-white py-3 pl-3 pr-9 text-sm font-medium text-black focus:border-[#500000] focus:outline-none focus:ring-1 focus:ring-[#500000]">
                                        <option value="">Pilih Subjek</option>
                                        <option value="inquiry">Pertanyaan Produk</option>
                                        <option value="order">Pemesanan</option>
                                        <option value="support">Dukungan Teknis</option>
                                        <option value="other">Lainnya</option>
                                    </select>
                                    <svg class="pointer-events-none absolute right-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-500"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>

                            <div
                                class="rounded-2xl border border-[#500000]/50 bg-white px-3 py-3 focus-within:border-[#500000] focus-within:ring-1 focus-within:ring-[#500000]">
                                <label for="message" class="mb-2 block text-lg font-medium text-black">Pesan
                                    Anda</label>
                                <div class="mb-2 border-t border-[#500000]/40"></div>
                                <textarea id="message" name="message" rows="3" required
                                    class="w-full resize-none border-0 bg-transparent p-0 text-sm font-medium text-black placeholder-gray-500 focus:outline-none focus:ring-0"
                                    placeholder="Tulis pesan di sini..."></textarea>
                            </div>

                            <div class="mt-auto pt-2 justify-center flex">
                                <button type="submit"
                                    class="inline-flex min-w-[165px] items-center justify-center gap-2 rounded-xl bg-[#a20202] px-4 py-2 text-[18px] font-semibold text-white transition hover:bg-[#8a0202] text-center focus:outline-none focus:ring-2 focus:ring-[#a20202] focus:ring-offset-2 sm:text-[18px]">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.8" stroke="currentColor" class="h-4 w-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6 12 3.269 3.126A59.768 59.768 0 0 1 21.485 12 59.77 59.77 0 0 1 3.27 20.876L5.999 12Zm0 0h7.5" />
                                    </svg>
                                    Kirim Pesan
                                </button>
                            </div>
                        </form>
                    </div>

                    <div
                        class="h-full rounded-[20px] border-2 border-[#d1d1d1] bg-[#f7f7f7] p-4 shadow-sm sm:p-5 flex flex-col">
                        <div class="mb-4">
                            <h2 class="text-[24px] font-extrabold text-black sm:text-[28px]">Informasi Perusahaan</h2>
                            <div class="mt-2 flex gap-2">
                                <div class="h-2 w-14 rounded bg-[#a20202]"></div>
                                <div class="h-2 w-14 rounded bg-[#de8a8a]"></div>
                            </div>
                        </div>

                        <div class="flex flex-1 flex-col gap-4">
                            <div
                                class="flex items-start gap-3 rounded-xl border border-[#500000]/30 bg-white/60 px-3 py-3">
                                <svg class="mt-0.5 h-5 w-5 text-[#a20202]" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 7.5h18M5.25 3h13.5A2.25 2.25 0 0 1 21 5.25v13.5A2.25 2.25 0 0 1 18.75 21H5.25A2.25 2.25 0 0 1 3 18.75V5.25A2.25 2.25 0 0 1 5.25 3Z" />
                                </svg>
                                <p class="text-[14px] font-semibold text-black">Asian Bearindo Jaya</p>
                            </div>

                            <div
                                class="flex items-start gap-3 rounded-xl border border-[#500000]/30 bg-white/60 px-3 py-3">
                                <svg class="mt-0.5 h-5 w-5 text-[#a20202]" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657 13.414 20.9a2 2 0 0 1-2.827 0l-4.243-4.243a8 8 0 1 1 11.313 0Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                <p class="text-[14px] font-semibold leading-[24px] text-black">
                                    Jl. Tanjungsari no. 19,<br>
                                    Sukomanunggal Surabaya<br>
                                    Jawa Timur
                                </p>
                            </div>

                            <div
                                class="flex items-start gap-3 rounded-xl border border-[#500000]/30 bg-white/60 px-3 py-3">
                                <svg class="mt-0.5 h-5 w-5 text-[#a20202]" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 0 1 2-2h3.279a1 1 0 0 1 .95.684l1.497 4.493a1 1 0 0 1-.502 1.21l-2.257 1.13a11.042 11.042 0 0 0 5.517 5.516l1.13-2.257a1 1 0 0 1 1.21-.502l4.493 1.498A1 1 0 0 1 21 15.72V19a2 2 0 0 1-2 2h-1C9.716 21 3 14.284 3 6V5Z" />
                                </svg>
                                <p class="text-[14px] font-semibold text-black">+62 812-3456-7890</p>
                            </div>

                            <div
                                class="flex items-start gap-3 rounded-xl border border-[#500000]/30 bg-white/60 px-3 py-3">
                                <svg class="mt-0.5 h-5 w-5 text-[#a20202]" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 0 0 2.22 0L21 8M5 19h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2Z" />
                                </svg>
                                <p
                                    class="text-[14px] font-semibold underline decoration-black/40 underline-offset-2 text-black">
                                    admin@asianbearindo.com</p>
                            </div>

                            <div
                                class="flex items-start gap-3 rounded-xl border border-[#500000]/30 bg-white/60 px-3 py-3">
                                <svg class="mt-0.5 h-5 w-5 text-[#a20202]" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <div>
                                    <p class="text-[12px] font-semibold uppercase text-black">Senin - Jum'at</p>
                                    <p class="text-[20px] font-extrabold leading-none text-black">08.00 - 17.00</p>
                                </div>
                            </div>

                            <div class="mt-auto pt-2 justify-center flex">
                                <button type="button"
                                    class="inline-flex min-w-[165px] items-center justify-center gap-2 rounded-xl bg-[#dfdfe1] px-4 py-2 text-[18px] font-semibold text-black transition hover:bg-[#d5d5d9] text-center focus:outline-none focus:ring-2 focus:ring-[#9ca3af] focus:ring-offset-2 sm:text-[18px]">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"
                                        class="h-4 w-4">
                                        <path
                                            d="M2.25 4.5A2.25 2.25 0 0 1 4.5 2.25h15A2.25 2.25 0 0 1 21.75 4.5v15A2.25 2.25 0 0 1 19.5 21.75h-15A2.25 2.25 0 0 1 2.25 19.5v-15Zm2.73.75L12 10.27l7.02-5.02H4.98ZM20.25 6.7l-8.17 5.84a.75.75 0 0 1-.87 0L3 6.7v12.8c0 .414.336.75.75.75h16.5a.75.75 0 0 0 .75-.75V6.7Z" />
                                    </svg>
                                    Email Kami
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8">
                    <div class="mb-3 text-center">
                        <div class="flex justify-center">
                            <div class="relative inline-flex items-center justify-center">
                                <svg class="absolute -left-10 h-7 w-7 text-[#a20202]" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657 13.414 20.9a2 2 0 0 1-2.827 0l-4.243-4.243a8 8 0 1 1 11.313 0Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                <h2 class="text-[32px] font-extrabold text-black sm:text-[38px]">Lokasi Kami</h2>
                            </div>
                        </div>
                        <div class="mx-auto mt-2 flex w-fit gap-2">
                            <div class="h-2 w-16 rounded bg-[#de8a8a]"></div>
                            <div class="h-2 w-16 rounded bg-[#a20202]"></div>
                            <div class="h-2 w-16 rounded bg-[#de8a8a]"></div>
                        </div>
                    </div>

                    <div class="overflow-hidden rounded-2xl border border-gray-300 shadow-sm">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15831.43723628913!2d112.67946124076845!3d-7.25684857497332!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7ff936876686d%3A0xa3fa7db480604775!2sPT.%20Asian%20Bearindo%20Jaya%20(HQ)!5e0!3m2!1sid!2sid!4v1775962861342!5m2!1sid!2sid"
                            width="100%" height="330" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </section>
        </div>
    </div>

</x-app-layout>