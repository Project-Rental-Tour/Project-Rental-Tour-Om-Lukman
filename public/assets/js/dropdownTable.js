function toggleMenu(button) {
    const dropdown = button.nextElementSibling;
    dropdown.classList.toggle('hidden');

    // Tutup dropdown lainnya yang mungkin terbuka
    document.querySelectorAll('.relative .absolute:not(.hidden)').forEach(el => {
        if (el !== dropdown) {
            el.classList.add('hidden');
        }
    });
}

// Tutup dropdown ketika klik di luar
document.addEventListener('click', function (e) {
    if (!e.target.closest('.relative')) {
        document.querySelectorAll('.relative .absolute').forEach(el => {
            el.classList.add('hidden');
        });
    }
});