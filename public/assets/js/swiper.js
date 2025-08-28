 document.addEventListener('DOMContentLoaded', function () {
        new Swiper('.testimonial-swiper', {
            // Default untuk mobile
            slidesPerView: 1,
            spaceBetween: 24,

            // Loop dan autoplay (opsional)
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },

            // Pagination & Navigation
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

            // Responsive breakpoints
            breakpoints: {
                // Tablet: 768px → tampilkan 2 card
                768: {
                    slidesPerView: 2,
                    spaceBetween: 10
                },

                // Desktop kecil: 1024px → tampilkan 3 card
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 10
                },

                // Desktop besar: 1280px → tampilkan 4 card
                1280: {
                    slidesPerView: 4,
                    spaceBetween: 10
                }
            }
        });
    });