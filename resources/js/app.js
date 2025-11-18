import './bootstrap';
import AOS from 'aos';
import 'aos/dist/aos.css';

// Inisialisasi AOS
AOS.init({
   duration: 1000,
    once: false,  // Ini yang membuat animasi berulang
    offset: 100,
    mirror: true  // Animasi reverse saat scroll ke atas
});
window.onscroll = function () {
    const header = document.querySelector('header');
    const fixedNav = header.offsetTop;

    if (window.scrollY > fixedNav) {
        header.classList.add('navbar-fixed');
    } else {
        header.classList.remove('navbar-fixed');
    }
};

// Toggle menu hamburger
const hamburger = document.querySelector('#hamburger');
const navmenu = document.querySelector('#nav-menu');

hamburger.addEventListener('click', function () {
    this.classList.toggle('hamburger-active');
    navmenu.classList.toggle('hidden');
});

import flatpickr from "flatpickr";
import { Indonesian } from "flatpickr/dist/l10n/id.js";


flatpickr.localize({
  ...Indonesian,
  time_24hr: true  // ✅ Ini bagian penting untuk hilangkan AM/PM
});
