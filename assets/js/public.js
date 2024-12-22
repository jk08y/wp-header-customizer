(function() {
    'use strict';

    // Lazy loading implementation
    document.addEventListener('DOMContentLoaded', function() {
        const lazyImages = document.querySelectorAll('img[data-src]');
        
        const imageObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.add('whc-fade-in');
                    observer.unobserve(img);
                }
            });
        });

        lazyImages.forEach(function(img) {
            imageObserver.observe(img);
        });
    });

    // Performance monitoring
    const performance = {
        init: function() {
            if (window.performance && window.performance.timing) {
                window.addEventListener('load', this.measureTiming.bind(this));
            }
        },

        measureTiming: function() {
            const timing = window.performance.timing;
            const interactive = timing.domInteractive - timing.navigationStart;
            const dcl = timing.domContentLoadedEventEnd - timing.navigationStart;
            const complete = timing.domComplete - timing.navigationStart;

            console.log('Interactive:', interactive + 'ms');
            console.log('DOMContentLoaded:', dcl + 'ms');
            console.log('Complete:', complete + 'ms');
        }
    };

    performance.init();
})();