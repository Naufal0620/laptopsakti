<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Admin - {{ config('app.name') }}</title>
        <link rel="icon" href="{{ asset('images/logos/laptopsakti_logo.svg') }}" type="image/svg+xml">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-900 bg-gray-50">
        <div class="min-h-screen flex">
            <!-- Sidebar -->
            <aside class="w-64 bg-white border-r border-gray-100 hidden lg:flex flex-col sticky top-0 h-screen">
                <div class="p-6 border-b border-gray-50">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3">
                        <x-application-logo class="w-10 h-10 text-primary-600" />
                        <span class="font-black text-xl tracking-tight text-gray-900">{{ config('app.name') }}</span>
                    </a>
                </div>
                
                <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
                    <x-admin-sidebar-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" icon="m3 12 2-2m0 0 7-7 7 7M5 10v10a1 1 0 0 0 1 1h3m10-11 2 2m-2-2v10a1 1 0 0 1-1 1h-3m-6 0a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1m-6 0h6">
                        Dashboard
                    </x-admin-sidebar-link>
                    <x-admin-sidebar-link :href="route('admin.products.index')" :active="request()->routeIs('admin.products.*')" icon="m16 11V7a4 4 0 0 0-8 0v4M5 9h14l1 12H4L5 9z">
                        Produk
                    </x-admin-sidebar-link>

                    <x-admin-sidebar-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')" icon="M12 4.354a4 4 0 1 1 0 5.292M15 21H3v-1a6 6 0 0 1 12 0v1zm0 0h6v-1a6 6 0 0 0-9-5.197">
                        User
                    </x-admin-sidebar-link>
                    <x-admin-sidebar-link :href="route('admin.videos.index')" :active="request()->routeIs('admin.videos.*')" icon="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                        Video
                    </x-admin-sidebar-link>
                    <x-admin-sidebar-link :href="route('admin.settings.index')" :active="request()->routeIs('admin.settings.*')" icon="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                        Settings
                    </x-admin-sidebar-link>
                </nav>

                <div class="p-4 border-t border-gray-50">
                    <a href="{{ route('home') }}" target="_blank" class="flex items-center p-3 text-sm font-bold text-gray-500 hover:text-primary-600 rounded-xl hover:bg-primary-50 transition group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-3 text-gray-400 group-hover:text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                        Lihat Toko
                    </a>
                </div>
            </aside>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
                <!-- Top Navbar -->
                <header class="bg-white border-b border-gray-100 h-16 flex items-center justify-between px-8 sticky top-0 z-20">
                    <div>
                        @if (View::hasSection('header'))
                            <div class="font-black text-xl text-gray-900 tracking-tight">
                                @yield('header')
                            </div>
                        @endif
                    </div>
                    
                    <div class="flex items-center space-x-6">
                        <div class="flex items-center text-sm">
                            <div class="flex flex-col text-right mr-3">
                                <span class="font-black text-gray-900 leading-none">{{ Auth::user()->name }}</span>
                                <span class="text-[10px] font-bold text-primary-600 uppercase tracking-widest mt-1">Administrator</span>
                            </div>
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="w-10 h-10 rounded-xl bg-gray-100 border border-gray-200 flex items-center justify-center text-gray-400 hover:text-primary-600 hover:bg-primary-50 transition">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('admin.profile.edit')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>
                </header>

                <main class="flex-1 overflow-y-auto p-8">
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-2xl border border-green-100 flex items-center shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-sm font-bold">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-6 p-4 bg-red-50 text-red-700 rounded-2xl border border-red-100 flex items-center shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-sm font-bold">{{ session('error') }}</span>
                        </div>
                    @endif

                    @yield('content')
                </main>
            </div>
        </div>

        @yield('floating_button')

        <!-- Image Compression Script -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const forms = document.querySelectorAll('form[enctype="multipart/form-data"]');
                forms.forEach(form => {
                    const fileInputs = form.querySelectorAll('input[type="file"]');
                    if (fileInputs.length === 0) return;

                    form.addEventListener('submit', async function(e) {
                        let hasImages = false;
                        fileInputs.forEach(input => {
                            for (let i = 0; i < input.files.length; i++) {
                                if (input.files[i].type.startsWith('image/')) {
                                    hasImages = true;
                                }
                            }
                        });

                        if (!hasImages) return;

                        // Prevent default submit
                        e.preventDefault();

                        // Disable submit button and show loading text
                        const submitBtn = form.querySelector('button[type="submit"]');
                        let originalBtnText = '';
                        if (submitBtn) {
                            originalBtnText = submitBtn.innerHTML;
                            submitBtn.disabled = true;
                            submitBtn.innerHTML = `
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg> Mengompres Gambar...
                            `;
                        }

                        // Compress each file input's files
                        for (let input of fileInputs) {
                            if (input.files.length === 0) continue;
                            const dt = new DataTransfer();
                            
                            for (let i = 0; i < input.files.length; i++) {
                                const file = input.files[i];
                                if (file.type.startsWith('image/')) {
                                    try {
                                        const compressed = await compressImage(file);
                                        dt.items.add(compressed);
                                    } catch (err) {
                                        console.error('Error compressing image:', err);
                                        dt.items.add(file); // fallback to original
                                    }
                                } else {
                                    dt.items.add(file);
                                }
                            }
                            input.files = dt.files;
                        }

                        // Submit form programmatically
                        form.submit();
                    });
                });

                async function compressImage(file, maxWidth = 1200, maxHeight = 1200, quality = 0.75) {
                    return new Promise((resolve, reject) => {
                        const reader = new FileReader();
                        reader.readAsDataURL(file);
                        reader.onload = (event) => {
                            const img = new Image();
                            img.src = event.target.result;
                            img.onload = () => {
                                const canvas = document.createElement('canvas');
                                let width = img.width;
                                let height = img.height;

                                if (width > height) {
                                    if (width > maxWidth) {
                                        height *= maxWidth / width;
                                        width = maxWidth;
                                    }
                                } else {
                                    if (height > maxHeight) {
                                        width *= maxHeight / height;
                                        height = maxHeight;
                                    }
                                }

                                canvas.width = width;
                                canvas.height = height;

                                const ctx = canvas.getContext('2d');
                                
                                // Set white background for transparent images
                                ctx.fillStyle = '#ffffff';
                                ctx.fillRect(0, 0, width, height);
                                
                                ctx.drawImage(img, 0, 0, width, height);

                                canvas.toBlob((blob) => {
                                    if (!blob) {
                                        reject(new Error('Canvas blob is null'));
                                        return;
                                    }
                                    const compressedFile = new File([blob], file.name, {
                                        type: 'image/jpeg',
                                        lastModified: Date.now(),
                                    });
                                    resolve(compressedFile);
                                }, 'image/jpeg', quality);
                            };
                            img.onerror = (err) => reject(img);
                        };
                        reader.onerror = (err) => reject(reader);
                    });
                }
            });
        </script>
    </body>
</html>
