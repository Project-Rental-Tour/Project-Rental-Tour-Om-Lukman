document.addEventListener('DOMContentLoaded', function () {
    const whatsappButton = document.getElementById('whatsapp-float');
    if (!whatsappButton) return;

    const jumbotron = document.getElementById('jumbotron');

    // Jika jumbotron TIDAK ADA, langsung tampilkan tombol
    if (!jumbotron) {
        whatsappButton.classList.remove('scale-0', 'opacity-0');
        whatsappButton.classList.add('scale-100', 'opacity-100');
        whatsappButton.classList.add('animate-bounce-slow');
        return; // Hentikan eksekusi lebih lanjut
    }

    // Jika jumbotron ADA, gunakan logika scroll (80% tinggi jumbotron)
    const eightyPercentHeight = jumbotron.offsetHeight * 0.5;

    function toggleWhatsApp() {
        if (window.scrollY > eightyPercentHeight) {
            whatsappButton.classList.remove('scale-0', 'opacity-0');
            whatsappButton.classList.add('scale-100', 'opacity-100');
            whatsappButton.classList.add('animate-bounce-slow');
        } else {
            whatsappButton.classList.remove('scale-100', 'opacity-100', 'animate-bounce-slow');
            whatsappButton.classList.add('scale-0', 'opacity-0');
        }
    }

    // Jalankan sekali saat halaman selesai loading
    toggleWhatsApp();

    // Pasang event listener scroll dengan throttle
    window.addEventListener('scroll', throttle(toggleWhatsApp, 100));
});

// Fungsi throttle untuk optimasi performa
function throttle(func, limit) {
    let inThrottle;
    return function () {
        const args = arguments;
        const context = this;
        if (!inThrottle) {
            func.apply(context, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    };
}