import './bootstrap';
import 'remixicon/fonts/remixicon.css'
import Alpine from 'alpinejs'
import { Splide } from '@splidejs/splide';
import YouTubePlayer from 'youtube-player';
import '@splidejs/splide/css';
import tippy from 'tippy.js';
import 'tippy.js/dist/tippy.css';
import collapse from '@alpinejs/collapse'

window.Splide = Splide;
window.YouTubePlayer = YouTubePlayer
window.tippy = tippy

Alpine.plugin(collapse)
window.Alpine = Alpine

window.setProgressValue = function setProgressValue(el, value, maxValue) {
    const radius = parseInt(el.getAttribute('r'));
    const circumference = 2 * Math.PI * radius;
    const progressPercentage = (value / maxValue) * 100;
    const progressOffset = circumference - (progressPercentage / 100) * circumference;
    el.style.strokeDasharray = `${circumference}px`;
    el.style.strokeDashoffset = `${progressOffset}px`;
}

Alpine.start()


