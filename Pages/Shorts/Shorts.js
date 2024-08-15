// Mendapatkan semua elemen video dalam .ShortsVideoFrame
const videos = document.querySelectorAll('.ShortsVideo video');

// Menambahkan event listener untuk mendeteksi perubahan scroll
document.querySelector('.ShortsVideoFrame').addEventListener('scroll', () => {
    // Mendapatkan video yang sedang tampil dalam layar
    let visibleVideo = null;
    videos.forEach(video => {
        const bounds = video.getBoundingClientRect();
        if (bounds.top >= 0 && bounds.bottom <= window.innerHeight) {
            visibleVideo = video;
        }
    });

    // Memulai video yang terlihat saat ini
    if (visibleVideo) {
        visibleVideo.play();
    }

    // Menghentikan video yang tidak terlihat
    videos.forEach(video => {
        if (video !== visibleVideo) {
            video.pause();
        }
    });
});
