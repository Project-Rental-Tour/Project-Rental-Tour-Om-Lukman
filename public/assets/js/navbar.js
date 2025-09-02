// resources/js/navbar.js
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

    // Tentukan trigger point
    if (hasJumbotron) {
        triggerPoint = jumbotron.offsetHeight * 0.8;
    } else {
        // Tanpa jumbotron → langsung putih
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

    // Fungsi update navbar
    function updateNavbar() {
        const scrolled = window.pageYOffset;

        // Jika menu mobile terbuka → paksa jadi putih
        if (isMobileMenuOpen) {
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
        // Jika tidak terbuka → ikuti scroll
        else {
            if (hasJumbotron && scrolled > triggerPoint) {
                nav.classList.add('bg-white', 'shadow-md');
                nav.classList.remove('bg-transparent');
            } else {
                nav.classList.remove('bg-white', 'shadow-md');
                nav.classList.add('bg-transparent');
            }

            // Update logo & text sesuai posisi scroll
            if (hasJumbotron) {
                if (scrolled > triggerPoint) {
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
                } else {
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
            }
        }
    }

    // Jalankan saat load
    updateNavbar();

    // Scroll listener
    if (hasJumbotron) {
        window.addEventListener('scroll', updateNavbar);
        window.addEventListener('resize', function () {
            triggerPoint = jumbotron.offsetHeight * 0.8;
            updateNavbar();
        });
    }

    // Handle klik hamburger
    if (menuToggle && menuTarget) {
        menuToggle.addEventListener('click', function () {
            // Toggle hidden class
            menuTarget.classList.toggle('hidden');

            // Update status: jika tidak hidden → terbuka
            isMobileMenuOpen = !menuTarget.classList.contains('hidden');

            // Update UI
            updateNavbar();
        });
    }
});