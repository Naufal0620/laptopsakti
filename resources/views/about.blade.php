<x-app-layout>
    <div class="py-16 bg-slate-50 min-h-screen">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Hero Section -->
            <div class="text-center mb-16">
                <span class="px-4 py-1.5 rounded-full bg-primary-50 text-primary-600 text-xs font-black uppercase tracking-widest border border-primary-100">
                    Tentang Kami
                </span>
                <p class="mt-4 text-4xl sm:text-6xl font-black tracking-tight text-slate-900 leading-tight">
                    LaptopSakti
                </p>
                <p class="mt-4 max-w-xl text-slate-500 mx-auto text-base sm:text-lg font-medium leading-relaxed">
                    Kami hadir untuk melayani kebutuhan komputasi Anda dengan jajaran laptop berspesifikasi sakti, bergaransi resmi, dan berkualitas premium.
                </p>
            </div>

            <!-- Visual & Owner Profile Grid -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 items-center mb-20 bg-white p-8 sm:p-12 rounded-2xl border border-slate-100 shadow-xl shadow-slate-100/50">
                <div class="relative md:col-span-5">
                    <div class="aspect-[4/5] bg-slate-900 rounded-xl overflow-hidden shadow-lg border border-slate-200">
                        <img src="{{ asset('images/ceo_laptopsakti.jpeg') }}" alt="Dedy Kiswanto, M.Kom. - Owner LaptopSakti" class="w-full h-full object-cover object-top">
                    </div>
                    <div class="absolute -bottom-6 -right-6 bg-primary-600 text-white p-6 rounded-xl shadow-xl hidden sm:block border border-primary-500/20">
                        <p class="text-2xl font-black italic leading-none mb-1">Owner</p>
                        <p class="text-[9px] uppercase tracking-widest font-black opacity-80 leading-none">LaptopSakti.com</p>
                    </div>
                </div>
                
                <div class="space-y-6 md:col-span-7">
                    <h3 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight leading-tight">Profil Owner</h3>
                    <p class="text-slate-600 leading-relaxed text-sm font-medium">
                        <span class="font-bold text-slate-800">Dedy Kiswanto, M.Kom.</span> merupakan Owner LaptopSakti.com, yang berfokus menyediakan laptop berkualitas untuk kebutuhan pendidikan, pekerjaan, pemrograman, desain, dan administrasi. Setiap produk diperiksa secara menyeluruh, meliputi kondisi fisik, fungsi perangkat, serta kesiapan penggunaan sebelum ditawarkan kepada pelanggan.
                    </p>
                    <p class="text-slate-600 leading-relaxed text-sm font-medium">
                        Selain menjalankan LaptopSakti.com, Dedy Kiswanto merupakan dosen pada Program Studi Ilmu Komputer Universitas Negeri Medan. Informasi akademik dan aktivitas profesionalnya dapat diverifikasi melalui situs <a href="https://csunimed.com" target="_blank" rel="noopener noreferrer" class="text-primary-600 hover:text-primary-700 font-bold transition">csunimed.com</a> dan SIMPEG Universitas Negeri Medan <a href="https://simpeg.unimed.ac.id/" target="_blank" rel="noopener noreferrer" class="text-primary-600 hover:text-primary-700 font-bold transition break-all">https://simpeg.unimed.ac.id/</a>.
                    </p>
                </div>
            </div>

            <!-- Credentials & Bank Accounts Section -->
            <div class="mb-20">
                <div class="text-center mb-10">
                    <span class="px-4 py-1.5 rounded-full bg-primary-50 text-primary-600 text-xs font-black uppercase tracking-widest border border-primary-100">
                        Kredensial & Pembayaran
                    </span>
                    <h3 class="mt-4 text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">Informasi Toko & Rekening Resmi</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Left: Store Info Card -->
                    <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-100 shadow-xl shadow-slate-100/50 flex flex-col justify-between space-y-6">
                        <div class="space-y-6">
                            <!-- Address -->
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-primary-50 rounded-xl flex items-center justify-center text-primary-600 flex-shrink-0">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-sm font-black text-slate-900 uppercase tracking-wider mb-1">Alamat Toko</h4>
                                    <p class="text-slate-600 text-sm font-medium leading-relaxed">
                                        Perumahan Bandar Setia Asri Jalan Pembinaan Hulu Percut Seituan.
                                    </p>
                                </div>
                            </div>

                            <!-- WhatsApp -->
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-primary-50 rounded-xl flex items-center justify-center text-primary-600 flex-shrink-0">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-sm font-black text-slate-900 uppercase tracking-wider mb-1">Kontak Resmi</h4>
                                    <p class="text-slate-600 text-sm font-medium leading-relaxed">
                                        <a href="https://wa.me/6285276983434" target="_blank" rel="noopener noreferrer" class="text-slate-800 hover:text-primary-600 font-bold transition">
                                            085276983434 (Dedy Kiswanto)
                                        </a>
                                    </p>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-primary-50 rounded-xl flex items-center justify-center text-primary-600 flex-shrink-0">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-sm font-black text-slate-900 uppercase tracking-wider mb-1">Email</h4>
                                    <p class="text-slate-600 text-sm font-medium leading-relaxed">
                                        <a href="mailto:kiswanto.dedi@gmail.com" class="text-slate-800 hover:text-primary-600 font-bold transition">
                                            kiswanto.dedi@gmail.com
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Bank Accounts & Warning Card -->
                    <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-100 shadow-xl shadow-slate-100/50 flex flex-col justify-between space-y-6">
                        <div>
                            <!-- Warning Box -->
                            <div class="bg-amber-50/80 border-l-4 border-amber-500 p-4 rounded-r-xl mb-6">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-amber-600" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-xs font-bold text-amber-800 uppercase tracking-wider mb-0.5">Peringatan Rekening Resmi</p>
                                        <p class="text-xs text-amber-700 leading-relaxed font-medium text-justify">
                                            Seluruh pembayaran untuk transaksi di LaptopSakti.com hanya dilakukan melalui rekening resmi atas nama Dedy Kiswanto. Pastikan nama pemilik rekening telah sesuai sebelum melakukan transfer. LaptopSakti.com tidak bertanggung jawab atas pembayaran yang dilakukan ke rekening selain yang tercantum di bawah ini.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Accounts -->
                            <div class="space-y-4">
                                <!-- Bank Mandiri -->
                                <div class="p-4 bg-slate-50 rounded-xl border border-slate-100 flex items-center justify-between">
                                    <div>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-blue-50 text-blue-700 border border-blue-100 mb-1">
                                            Bank Mandiri
                                        </span>
                                        <p class="text-lg font-black text-slate-800 tracking-wider">1330010741312</p>
                                        <p class="text-xs text-slate-500 font-medium">a.n. Dedy Kiswanto</p>
                                    </div>
                                </div>

                                <!-- BSI -->
                                <div class="p-4 bg-slate-50 rounded-xl border border-slate-100 flex items-center justify-between">
                                    <div>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-teal-50 text-teal-700 border border-teal-100 mb-1">
                                            Bank Syariah Indonesia (BSI)
                                        </span>
                                        <p class="text-lg font-black text-slate-800 tracking-wider">7152683938</p>
                                        <p class="text-xs text-slate-500 font-medium">a.n. Dedy Kiswanto</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</x-app-layout>
