import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.store('videoPlayer', {
    isMuted: localStorage.getItem('videoMuted') !== 'false',
    toggleMute() {
        this.isMuted = !this.isMuted;
        localStorage.setItem('videoMuted', this.isMuted);
    }
});

Alpine.start();
