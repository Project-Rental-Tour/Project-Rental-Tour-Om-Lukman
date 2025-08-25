// testimonial.js

class TestimonialModal {
    constructor(addModalId) {
        this.addModal = document.getElementById(addModalId);

        // Setup Add Modal
        this.ratingInput = this.addModal?.querySelector('#rating');
        this.addStars = this.addModal ? this.addModal.querySelectorAll('.star-btn[data-value]') : [];

        this.init();
    }

    init() {
        // Setup bintang untuk modal "Add"
        this.setupStars(this.addStars, this.ratingInput);

        // Reset rating ke 5 saat buka modal add
        if (this.addModal) {
            const addTrigger = document.querySelector(`[data-modal-target="${this.addModal.id}"]`);
            if (addTrigger) {
                addTrigger.addEventListener('click', () => {
                    if (this.ratingInput) {
                        this.ratingInput.value = 5;
                        this.highlightStars(this.addStars, 5);
                    }
                });
            }
        }

        // Setup semua modal edit (dinamis: edit-modal-1, edit-modal-2, dll)
        this.setupAllEditModals();
    }

    setupStars(stars, input) {
        if (!stars || !input) return;

        stars.forEach(btn => {
            btn.addEventListener('click', () => {
                const value = parseInt(btn.dataset.value);
                input.value = value;
                this.highlightStars(stars, value);
            });
        });
    }

    highlightStars(stars, selectedValue) {
        stars.forEach((btn, index) => {
            const icon = btn.querySelector('i');
            if (!icon) return;
            if (index < selectedValue) {
                icon.className = 'fas fa-star text-yellow-400 text-lg';
            } else {
                icon.className = 'far fa-star text-gray-300 text-lg';
            }
        });
    }

    // Setup semua modal edit (id mengandung "edit-modal-")
    setupAllEditModals() {
        document.querySelectorAll('[id^="edit-modal-"]').forEach(modal => {
            const stars = modal.querySelectorAll('.star-btn[data-value]');
            const ratingInput = modal.querySelector('#edit-rating');

            if (!stars.length || !ratingInput) return;

            // Saat modal dibuka, tampilkan bintang sesuai rating
            const openButton = document.querySelector(`[data-modal-toggle="${modal.id}"]`);
            if (openButton) {
                openButton.addEventListener('click', () => {
                    this.highlightStars(stars, parseInt(ratingInput.value));
                });
            }

            // Setup klik bintang
            this.setupStars(stars, ratingInput);
        });
    }
}

// Inisialisasi saat DOM siap
document.addEventListener('DOMContentLoaded', function () {
    window.testimonialModal = new TestimonialModal('add-modal'); // Ganti 'testimonial-modal' jadi 'add-modal'
});