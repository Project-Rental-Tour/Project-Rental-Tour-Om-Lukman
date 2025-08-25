// testimonial.js

class TestimonialModal {
    constructor(addModalId, editModalId) {
        this.addModal = document.getElementById(addModalId);
        this.editModal = document.getElementById(editModalId);

        this.ratingInput = this.addModal?.querySelector('#rating');
        this.editRatingInput = this.editModal?.querySelector('#edit-rating');

        this.addStars = this.addModal ? this.addModal.querySelectorAll('.star-btn[data-value]') : [];
        this.editStars = this.editModal ? this.editModal.querySelectorAll('.star-btn[data-value]') : [];

        this.init();
    }

    init() {
        this.setupStars(this.addStars, this.ratingInput);
        this.setupStars(this.editStars, this.editRatingInput);

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
    }

    setupStars(stars, input) {
        if (!stars.length || !input) return;

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
                icon.className = 'fas fa-star text-yellow-400';
            } else {
                icon.className = 'far fa-star text-gray-300';
            }
        });
    }

    // Fungsi untuk di-call saat buka modal edit
    fillStars(starContainer, rating) {
        const stars = starContainer?.querySelectorAll('.star-btn');
        if (!stars) return;
        stars.forEach((btn, index) => {
            const icon = btn.querySelector('i');
            if (index < rating) {
                icon.className = 'fas fa-star text-yellow-400';
            } else {
                icon.className = 'far fa-star text-gray-300';
            }
        });
    }
}

// Inisialisasi saat DOM siap
document.addEventListener('DOMContentLoaded', function () {
    window.testimonialModal = new TestimonialModal('testimonial-modal', 'edit-modal');
});