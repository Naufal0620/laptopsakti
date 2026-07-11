@props(['video'])

<div 
    x-data="{ 
        isPlaying: false,
        observer: null,
        showPlayIcon: false,
        toggleMute() {
            $store.videoPlayer.toggleMute();
        },
        togglePlay() {
            if ($refs.player.paused) {
                $refs.player.play().catch(() => {});
                this.isPlaying = true;
            } else {
                $refs.player.pause();
                this.isPlaying = false;
            }
            this.showPlayIcon = true;
            setTimeout(() => this.showPlayIcon = false, 500);
        },
        async share() {
            const url = '{{ route('products.show', $video->product) }}';
            const shareData = {
                title: '{{ $video->product->name }}',
                text: 'Lihat laptop premium menarik ini di LaptopSakti!',
                url: url
            };
            try {
                if (navigator.share) {
                    await navigator.share(shareData);
                } else if (navigator.clipboard && navigator.clipboard.writeText) {
                    await navigator.clipboard.writeText(url);
                    alert('Link produk berhasil disalin!');
                } else {
                    // Fallback for non-secure contexts
                    const textArea = document.createElement('textarea');
                    textArea.value = url;
                    textArea.style.position = 'fixed';
                    textArea.style.left = '-9999px';
                    textArea.style.top = '0';
                    document.body.appendChild(textArea);
                    textArea.focus();
                    textArea.select();
                    try {
                        document.execCommand('copy');
                        alert('Link produk berhasil disalin!');
                    } catch (err) {
                        alert('Gagal menyalin link: ' + url);
                    }
                    document.body.removeChild(textArea);
                }
            } catch (err) {
                if (err.name !== 'AbortError') {
                    console.error('Error sharing:', err);
                }
            }
        }
    }" 
    x-init="
        observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    $refs.player.play().catch(() => {});
                    isPlaying = true;
                } else {
                    $refs.player.pause();
                    isPlaying = false;
                }
            });
        }, { threshold: 0.6 });
        observer.observe($el);

        $refs.player.addEventListener('play', () => isPlaying = true);
        $refs.player.addEventListener('pause', () => isPlaying = false);

        // Sync muted state with global store
        $watch('$store.videoPlayer.isMuted', value => {
            $refs.player.muted = value;
        });
        
        // Initial sync
        $refs.player.muted = $store.videoPlayer.isMuted;
    "
    class="relative w-full aspect-[9/16] bg-black rounded-xl overflow-hidden shadow-lg mb-4"
>
    {{-- Video Element --}}
    <video 
        x-ref="player"
        @click="togglePlay()"
        src="{{ asset('storage/' . $video->video_path) }}"
        poster="{{ $video->thumbnail_path ? asset('storage/' . $video->thumbnail_path) : '' }}"
        class="w-full h-full object-cover cursor-pointer"
        loop 
        playsinline
        preload="metadata"
    ></video>

    {{-- Play/Pause Indicator Overlay --}}
    <div 
        x-show="showPlayIcon"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-50"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-150"
        class="absolute inset-0 flex items-center justify-center pointer-events-none z-10"
        style="display: none;"
    >
        <div class="bg-black/40 p-5 rounded-full backdrop-blur-sm">
            <template x-if="isPlaying">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </template>
            <template x-if="!isPlaying">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </template>
        </div>
    </div>

    {{-- Overlay Controls --}}
    <div class="absolute bottom-6 right-4 flex flex-col items-center space-y-6 z-20">
        {{-- WhatsApp Order Link (Beli) --}}
        @php
            $whatsappNumber = \App\Models\Setting::getValue('admin_whatsapp_number', '6285270110305');
            $message = "Halo LaptopSakti! Saya tertarik untuk membeli laptop berikut:\n\n" .
                       "💻 Laptop: " . $video->product->name . "\n" .
                       "💵 Harga: Rp " . number_format($video->product->price, 0, ',', '.') . "\n\n" .
                       "Apakah laptop ini masih tersedia?";
            $waUrl = "https://wa.me/" . $whatsappNumber . "?text=" . rawurlencode($message);
        @endphp
        <a href="{{ $waUrl }}" target="_blank" rel="noopener noreferrer" class="flex flex-col items-center text-white">
            <div class="p-3 bg-white/10 backdrop-blur-md rounded-full hover:bg-white/20 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
            </div>
            <span class="text-[10px] mt-1 font-bold">Beli</span>
        </a>

        {{-- Share Action --}}
        <button 
            @click="share()"
            class="flex flex-col items-center text-white"
        >
            <div class="p-3 bg-white/10 backdrop-blur-md rounded-full hover:bg-white/20 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                </svg>
            </div>
            <span class="text-[10px] mt-1 font-bold">Share</span>
        </button>

        {{-- Mute Toggle --}}
        <button 
            @click.stop="toggleMute()" 
            class="p-2 bg-black/20 backdrop-blur-sm rounded-full text-white/70 hover:text-white transition"
        >
            <template x-if="$store.videoPlayer.isMuted">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2" />
                </svg>
            </template>
            <template x-if="!$store.videoPlayer.isMuted">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" />
                </svg>
            </template>
        </button>
    </div>

    {{-- Product Info Overlay --}}
    <div class="absolute bottom-6 left-4 right-16 text-white bg-gradient-to-t from-black/60 to-transparent p-4 rounded-xl backdrop-blur-[2px] z-20">
        <div class="flex items-center space-x-2 mb-1">
            <span class="bg-primary-500 text-[10px] font-extrabold px-2 py-0.5 rounded-full uppercase tracking-wider">Ready Stock</span>
        </div>
        <a href="{{ route('products.show', $video->product) }}" class="hover:underline">
            <h3 class="font-bold text-xl leading-tight mb-1">{{ $video->product->name }}</h3>
        </a>
        <p class="text-2xl font-black text-primary-400">Rp {{ number_format($video->product->price, 0, ',', '.') }}</p>
        <p class="text-xs opacity-70 mt-2 line-clamp-2">{{ $video->product->description }}</p>
    </div>
</div>
