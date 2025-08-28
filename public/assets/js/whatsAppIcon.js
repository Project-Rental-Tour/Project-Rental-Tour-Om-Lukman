document.addEventListener('DOMContentLoaded', function () {
    const whatsappButton = document.getElementById('whatsapp-float');
    if (!whatsappButton) return;

    const jumbotron = document.getElementById('jumbotron');
    if (!jumbotron) return;

    // Hitung 80% dari tinggi jumbotron
    const eightyPercentHeight = jumbotron.offsetHeight * 0.5;

    // Fungsi untuk cek scroll dan tampilkan/menyembunyikan tombol
    function toggleWhatsApp() {
        if (window.scrollY > eightyPercentHeight) {
            whatsappButton.classList.remove('scale-0', 'opacity-0');
            whatsappButton.classList.add('scale-100', 'opacity-100');
            // Tambahkan animasi bounce ringan
            whatsappButton.classList.add('animate-bounce-slow');
        } else {
            whatsappButton.classList.remove('scale-100', 'opacity-100', 'animate-bounce-slow');
            whatsappButton.classList.add('scale-0', 'opacity-0');
        }
    }

    // Cek saat halaman dimuat dan saat scroll
    window.addEventListener('load', toggleWhatsApp);
    window.addEventListener('scroll', throttle(toggleWhatsApp, 100));
});

// Optimasi performa: throttle untuk scroll event
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
    }
}