<x-app-layout>
    <div class="bg-black h-screen overflow-hidden relative">
        <!-- Back Button -->
        <a href="{{ route('home') }}" class="fixed top-6 left-6 z-[60] bg-black/50 hover:bg-black/70 text-white p-3 rounded-full transition-all shadow-2xl backdrop-blur-sm border border-white/10 group">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>

        <div class="h-full overflow-y-scroll snap-y snap-mandatory hide-scrollbar">
            @forelse($videos as $video)
                <div class="h-full w-full snap-start snap-always flex items-center justify-center relative bg-black">
                    <div class="video-container-fixed">
                        <x-video-player :video="$video" />
                    </div>
                </div>
            @empty
                <div class="h-full w-full flex items-center justify-center text-white italic">
                    Belum ada video untuk dijelajahi.
                </div>
            @endforelse
        </div>
    </div>

    <style>
        /* Hide scrollbar for Chrome, Safari and Opera */
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        .hide-scrollbar {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }

        /* Adjust video player internal spacing for full screen feel */
        .video-container-fixed {
            width: 100vw;
            height: 100vh;
            max-width: 450px; /* Standard mobile width */
            margin: 0 auto;
            position: relative;
            background: black;
        }

        .aspect-\[9\/16\] {
            aspect-ratio: 9/16;
            height: 100%;
            width: 100%;
            margin-bottom: 0 !important;
            border-radius: 0 !important;
        }
    </style>
</x-app-layout>