// assets/js/galleryPreview.js
document.addEventListener("DOMContentLoaded", function () {
    // 1. Add Modal Preview
    const addPhotoInput = document.getElementById('featured_image');
    const addPreview = document.getElementById('previewPhoto');
    const addPlaceholder = document.getElementById('placeholderText');

    if (addPhotoInput && addPreview && addPlaceholder) {
        addPhotoInput.addEventListener('change', function (e) {
            const file = this.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    addPreview.src = e.target.result;
                    addPreview.classList.remove('hidden');
                    addPlaceholder.classList.add('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // 2. Edit Modals Preview
    document.querySelectorAll('[id^="edit-gallery_photo-"]').forEach(input => {
        const galleryId = input.id.replace('edit-gallery_photo-', '');
        const preview = document.getElementById(`edit-preview-${galleryId}`);

        if (!input || !preview) return;

        // Simpan src ASLI saat halaman dimuat
        const originalSrc = preview.src;

        input.addEventListener('change', function (e) {
            const file = this.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = originalSrc;
            }
        });

        // Reset saat modal ditutup
        const modal = input.closest(`[id^="edit-modal-"]`);
        if (modal) {
            modal.addEventListener('hidden.bs.modal', function () {
                preview.src = originalSrc;
                input.value = '';
            });
        }
    });

    // 3. Fallback untuk gambar error (HANYA sekali, hindari loop)
    document.querySelectorAll('img').forEach(img => {
        // Jangan tambahkan handler jika sudah ada
        if (img.dataset.errorHandler) return;
        img.dataset.errorHandler = 'true';

        img.addEventListener('error', function () {
            if (this.src.endsWith('/placeholder.jpg')) return;
            this.src = '/placeholder.jpg';
            this.alt = 'Image not found';
        });
    });
});