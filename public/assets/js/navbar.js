document.addEventListener('DOMContentLoaded', function () {
    const nav = document.querySelector('nav[data-navbar]');
    if (!nav) return;

    const jumbotron = document.getElementById('jumbotron');
    const logoWhite = document.getElementById('logo-white');
    const logoDark = document.getElementById('logo-dark');
    const menuToggle = nav.querySelector('[data-collapse-toggle]');
    const menuIcon = nav.querySelector('svg');
    const menuTargetId = menuToggle?.getAttribute('aria-controls');
    const menuTarget = menuTargetId ? document.getElementById(menuTargetId) : null;

    let triggerPoint = 0;
    let hasJumbotron = !!jumbotron;
    let isMobileMenuOpen = false;

    // Fungsi untuk mengatur navbar ke mode "putih"
    function setNavbarToWhite() {
        nav.classList.add('bg-white', 'shadow-md');
        nav.classList.remove('bg-transparent');

        if (logoWhite) logoWhite.classList.add('hidden');
        if (logoDark) logoDark.classList.remove('hidden');

        nav.querySelectorAll('a').forEach(link => {
            link.classList.remove('text-white');
            link.classList.add('text-gray-800');
        });

        if (menuIcon) {
            menuIcon.classList.remove('text-white');
            menuIcon.classList.add('text-gray-800');
        }
    }

    // Fungsi untuk mengatur navbar ke mode "transparan" (hanya jika ada jumbotron)
    function setNavbarToTransparent() {
        nav.classList.remove('bg-white', 'shadow-md');
        nav.classList.add('bg-transparent');

        if (logoWhite) logoWhite.classList.remove('hidden');
        if (logoDark) logoDark.classList.add('hidden');

        nav.querySelectorAll('a').forEach(link => {
            link.classList.add('text-white');
            link.classList.remove('text-gray-800');
        });

        if (menuIcon) {
            menuIcon.classList.add('text-white');
            menuIcon.classList.remove('text-gray-800');
        }
    }

    // Inisialisasi navbar
    if (!hasJumbotron) {
        // Jika tidak ada jumbotron → langsung putih
        setNavbarToWhite();
    } else {
        // Ada jumbotron → default transparan
        setNavbarToTransparent();
        triggerPoint = jumbotron.offsetHeight * 0.8;
    }

    // Fungsi update saat scroll
    function updateNavbar() {
        const scrolled = window.pageYOffset;

        if (isMobileMenuOpen) {
            setNavbarToWhite(); // Saat menu mobile terbuka, selalu putih
        } else {
            if (hasJumbotron && scrolled > triggerPoint) {
                setNavbarToWhite();
            } else if (hasJumbotron) {
                setNavbarToTransparent();
            }
            // Jika tidak ada jumbotron, tidak perlu ubah (sudah putih)
        }
    }

    // Jalankan sekali saat load
    updateNavbar();

    // Tambahkan event listener hanya jika ada jumbotron
    if (hasJumbotron) {
        window.addEventListener('scroll', updateNavbar);
        window.addEventListener('resize', function () {
            triggerPoint = jumbotron.offsetHeight * 0.8;
            updateNavbar();
        });
    }

    // Handle toggle menu mobile
    if (menuToggle && menuTarget) {
        menuToggle.addEventListener('click', function () {
            menuTarget.classList.toggle('hidden');
            isMobileMenuOpen = !menuTarget.classList.contains('hidden');
            updateNavbar();
        });
    }
});