import './bootstrap';
import 'remixicon/fonts/remixicon.css'
import Alpine from 'alpinejs'
import anime from 'animejs';
import { Splide } from '@splidejs/splide';
import '@splidejs/splide/css';


window.anime = anime;
window.Splide = Splide;
window.Alpine = Alpine

Alpine.start()
