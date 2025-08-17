// Function to handle image preview for all modals
function initializeImagePreview() {
    // Handle image preview for add modal
    const addUploadFoto = document.getElementById('profile_photo');
    const addPreviewFoto = document.getElementById('previewPhoto');

    if (addUploadFoto && addPreviewFoto) {
        addUploadFoto.addEventListener('change', function (e) {
            const [file] = addUploadFoto.files;
            if (file) {
                addPreviewFoto.src = URL.createObjectURL(file);
            }
        });
    }

    // Handle image preview for edit modals
    document.querySelectorAll('[id^="uploadFoto-"]').forEach(uploadInput => {
        const userId = uploadInput.id.split('-')[1];
        const previewId = `previewFoto-${userId}`;
        const previewElement = document.getElementById(previewId);

        if (uploadInput && previewElement) {
            uploadInput.addEventListener('change', function (e) {
                const [file] = uploadInput.files;
                if (file) {
                    previewElement.src = URL.createObjectURL(file);
                }
            });
        }
    });
}

// Initialize when DOM is loaded
document.addEventListener("DOMContentLoaded", function () {
    initializeImagePreview();
});