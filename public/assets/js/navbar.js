document.addEventListener('DOMContentLoaded', function () {
    const nav = document.querySelector('nav[data-navbar]');
    const jumbotron = document.getElementById('jumbotron');
    const logoWhite = document.getElementById('logo-white');
    const logoDark = document.getElementById('logo-dark');
    const links = document.querySelectorAll('nav a');
    const menuIcon = document.querySelector('nav svg');

    if (!nav || !jumbotron) return;

    // Hitung 80% dari tinggi jumbotron
    const jumbotronHeight = jumbotron.offsetHeight;
    triggerPoint = jumbotronHeight * 0.8; // 80%

    function updateNavbar() {
        const scrolled = window.pageYOffset;

        if (scrolled > triggerPoint) {
            // Sudah lewati 80% jumbotron → navbar putih
            nav.classList.add('bg-white', 'shadow-md');
            nav.classList.remove('bg-transparent');

            if (logoWhite) logoWhite.classList.add('hidden');
            if (logoDark) logoDark.classList.remove('hidden');

            links.forEach(link => {
                link.classList.remove('text-white');
                link.classList.add('text-gray-800');
            });

            if (menuIcon) {
                menuIcon.classList.remove('text-white');
                menuIcon.classList.add('text-gray-800');
            }
        } else {
            // Masih di atas 80% → navbar transparan
            nav.classList.remove('bg-white', 'shadow-md');
            nav.classList.add('bg-transparent');

            if (logoWhite) logoWhite.classList.remove('hidden');
            if (logoDark) logoDark.classList.add('hidden');

            links.forEach(link => {
                link.classList.add('text-white');
                link.classList.remove('text-gray-800');
            });

            if (menuIcon) {
                menuIcon.classList.add('text-white');
                menuIcon.classList.remove('text-gray-800');
            }
        }
    }

    // Jalankan saat load dan scroll
    updateNavbar();
    window.addEventListener('scroll', updateNavbar);

    // Re-calculate saat resize (jika jumbotron berubah tinggi)
    window.addEventListener('resize', function () {
        const newHeight = jumbotron.offsetHeight;
        triggerPoint = newHeight * 0.8;
        updateNavbar(); // Update tampilan
    });
});