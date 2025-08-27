document.addEventListener('DOMContentLoaded', function () {
    const filters = document.querySelectorAll('.category-filter');
    const cards = document.querySelectorAll('.blog-card');

    // Filter logic
    filters.forEach(button => {
        button.addEventListener('click', function () {
            // Update active class
            filters.forEach(btn => btn.classList.remove('active', 'bg-blue-600', 'text-white'));
            filters.forEach(btn => btn.classList.add('bg-gray-100', 'text-gray-600'));

            this.classList.remove('bg-gray-100', 'text-gray-600');
            this.classList.add('active', 'bg-blue-600', 'text-white');

            const filter = this.getAttribute('data-filter');

            cards.forEach(card => {
                if (filter === 'all' || card.getAttribute('data-type') === filter) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    // Animasi Fade-In saat scroll
    const fadeElements = document.querySelectorAll('.animate-fade-up');
    const fadeObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
            }
        });
    }, { threshold: 0.1 });

    fadeElements.forEach(el => {
        fadeObserver.observe(el);
    });
});