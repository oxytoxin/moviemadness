import './bootstrap';
import 'remixicon/fonts/remixicon.css'
import Alpine from 'alpinejs'
import { Splide } from '@splidejs/splide';
import YouTubePlayer from 'youtube-player';
import '@splidejs/splide/css';
import tippy from 'tippy.js';
import 'tippy.js/dist/tippy.css';

window.Splide = Splide;
window.YouTubePlayer = YouTubePlayer
window.Alpine = Alpine
window.tippy = tippy

Alpine.start()

function lazyLoadImages(selector) {
    const images = document.querySelectorAll(selector);

    const options = {
        rootMargin: '0px',
        threshold: 0.1
    };

    const observer = new IntersectionObserver(function (entries, observer) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const image = entry.target;
                const src = image.getAttribute('data-src');

                if (src) {
                    image.setAttribute('src', src);
                    image.removeAttribute('data-src');
                    observer.unobserve(image);
                }
            }
        });
    }, options);

    images.forEach(image => {
        observer.observe(image);
    });
}

