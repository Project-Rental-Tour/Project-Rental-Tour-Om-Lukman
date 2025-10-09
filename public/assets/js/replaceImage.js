document.addEventListener("DOMContentLoaded", function () {
    // === 1. Universal Preview Handler (untuk semua input dengan data-preview) ===
    document.querySelectorAll('input[type="file"][data-preview]').forEach(input => {
        const previewId = input.dataset.preview;
        const preview = document.getElementById(previewId);
        const placeholder = document.getElementById(`placeholder-${previewId}`) ||
            document.querySelector(`[id^="placeholder-"][id$="-${previewId}"]`);

        if (!preview) return;

        // Simpan src asli jika ada (untuk form edit)
        const originalSrc = preview.src && !preview.src.includes('data:') ? preview.src : null;

        input.addEventListener('change', function () {
            const file = this.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    if (placeholder) placeholder.classList.add('hidden');
                };
                reader.readAsDataURL(file);
            } else if (originalSrc) {
                // Kembalikan ke gambar asli (untuk form edit)
                preview.src = originalSrc;
                preview.classList.remove('hidden');
                if (placeholder) placeholder.classList.remove('hidden');
            } else {
                // Kosongkan preview (untuk form add)
                preview.src = '';
                preview.classList.add('hidden');
                if (placeholder) placeholder.classList.remove('hidden');
            }
        });
    });

    // === 2. Edit Modals Reset (tetap dipertahankan untuk modal edit) ===
    document.querySelectorAll('[id^="edit-gallery_photo-"]').forEach(input => {
        const galleryId = input.id.replace('edit-gallery_photo-', '');
        const modal = input.closest(`[id^="edit-modal-"]`);
        const preview = document.getElementById(`edit-preview-${galleryId}`);

        if (modal && preview) {
            modal.addEventListener('hidden.bs.modal', function () {
                const originalSrc = preview.dataset.originalSrc || '';
                preview.src = originalSrc;
                input.value = '';
                // Reset placeholder jika ada
                const placeholder = document.getElementById(`placeholder-edit-preview-${galleryId}`);
                if (placeholder) placeholder.classList.remove('hidden');
            });

            // Simpan src asli saat modal dibuka
            modal.addEventListener('shown.bs.modal', function () {
                if (!preview.dataset.originalSrc) {
                    preview.dataset.originalSrc = preview.src;
                }
            });
        }
    });

    // === 3. Fallback untuk gambar error ===
    document.querySelectorAll('img').forEach(img => {
        if (img.dataset.errorHandler) return;
        img.dataset.errorHandler = 'true';

        img.addEventListener('error', function () {
            this.alt = 'Image not found';
        });
    });
});