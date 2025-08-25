document.addEventListener('DOMContentLoaded', function () {
    const options = {
        threshold: 0.5,
        once: true
    };

    const observer = new IntersectionObserver(function (entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = entry.target.querySelector('[data-target]');
                const finalValue = parseInt(target.getAttribute('data-target').replace(/[^0-9]/g, ''));
                let start = 0;
                const duration = 2000;
                const increment = Math.ceil(finalValue / (duration / 16));

                const timer = setInterval(() => {
                    start += increment;
                    if (start >= finalValue) {
                        start = finalValue;
                        clearInterval(timer);
                    }
                    target.textContent = start.toLocaleString() + (finalValue > 100 ? '+' : '');
                }, 16);
                observer.unobserve(entry.target);
            }
        });
    }, options);

    document.querySelectorAll('.stats-box').forEach(box => observer.observe(box));
});