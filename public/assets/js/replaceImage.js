// assets/js/galleryPreview.js
document.addEventListener("DOMContentLoaded", function () {
    // Add modal preview
    const addPhotoInput = document.getElementById('gallery_photo');
    const addPreview = document.getElementById('previewPhoto');
    const addPlaceholder = document.getElementById('placeholderText');

    if (addPhotoInput && addPreview && addPlaceholder) {
        addPhotoInput.addEventListener('change', function (e) {
            const file = this.files[0];
            if (file) {
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

    // Edit modals preview
    document.querySelectorAll('[id^="edit-gallery_photo-"]').forEach(input => {
        const galleryId = input.id.replace('edit-gallery_photo-', '');
        const preview = document.getElementById(`edit-preview-${galleryId}`);
        const currentImageLink = document.getElementById(`current-image-link-${galleryId}`);

        if (input && preview) {
            // Store original image source
            const originalSrc = preview.src;

            input.addEventListener('change', function (e) {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        preview.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                } else {
                    // Revert to original image if no file selected
                    preview.src = originalSrc;
                }
            });

            // Reset preview when modal is closed
            const modal = input.closest(`[id^="edit-modal-"]`);
            if (modal) {
                modal.addEventListener('hidden.bs.modal', function () {
                    preview.src = originalSrc;
                    input.value = ''; // Clear file input
                });
            }
        }
    });

    // View modals - ensure images load properly
    document.querySelectorAll('[id^="view-image"]').forEach(img => {
        // Add error handling for view modal images
        img.addEventListener('error', function () {
            this.src = '/placeholder-image.jpg'; // Fallback image
            this.alt = 'Image not found';
        });
    });
});