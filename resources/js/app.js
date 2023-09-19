import './bootstrap';

import 'flowbite';
import AOS from 'aos';

import * as PusherPushNotifications from "@pusher/push-notifications-web";

import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
import collapse from '@alpinejs/collapse'
import Clipboard from "@ryangjchandler/alpine-clipboard"

import jQuery from 'jquery';
import Swal from 'sweetalert2';


//import persist from "@alpinejs/persist"; // @see https://alpinejs.dev/plugins/persist
// @see https://alpinejs.dev/plugins/collapse
import intersect from "@alpinejs/intersect"; // @see https://alpinejs.dev/plugins/intersect

import hljs from "highlight.js/lib/core";
import xml from "highlight.js/lib/languages/xml";

/*
    Date Utility Library
    @see https://day.js.org/
*/
//import dayjs from "dayjs";

/*
    Carousel Library
    @see https://swiperjs.com/
*/
import Swiper from "swiper/bundle";

//import Sortable from "sortablejs";

/*
    Charts Libraries
    @see https://apexcharts.com/
*/
//import ApexCharts from "apexcharts";

/*
    Tables Libraries
    @see https://gridjs.io/
*/
//import * as Gridjs from "gridjs";

//  Forms Libraries
//import "@caneara/iodine"; // @see https://github.com/caneara/iodine
//import * as FilePond from "filepond"; // @see https://pqina.nl/filepond/
//import FilePondPluginImagePreview from "filepond-plugin-image-preview"; // @see https://pqina.nl/filepond/docs/api/plugins/image-preview/
//import Quill from "quill/dist/quill.min"; // @see https://quilljs.com/
//import flatpickr from "flatpickr"; // @see https://flatpickr.js.org/
//import Tom from "tom-select/dist/js/tom-select.complete.min"; // @see https://tom-select.js.org/

// Import Fortawesome icons
//import "@fortawesome/fontawesome-free/css/all.css";

// Helper Functions
import * as helpers from "./utils/helpers";

// Pages Scripts
import * as pages from "./pages";

// Global Store
import store from "./store";

// Breakpoints Store
import breakpoints from "./utils/breakpoints";

// Alpine Components
import usePopper from "./components/usePopper";
import accordionItem from "./components/accordionItem";

// Alpine Directives
import tooltip from "./directives/tooltip";
import inputMask from "./directives/inputMask";

// Alpine Magic Functions
import notification from "./magics/notification";
//import clipboard from "./magics/clipboard";

import SimpleBar from "simplebar";



//import focus from '@alpinejs/focus'




//Alpine.plugin(NotificationsAlpinePlugin);


window.$ = jQuery;

window.Swal = Swal;


window.Alpine = Alpine;


// Register HTML, XML language for highlight.js
// Just for demo purpose only for highlighting code
hljs.registerLanguage("xml", xml);
hljs.configure({ ignoreUnescapedHTML: true });

// Register plugin image preview for filepond
//FilePond.registerPlugin(FilePondPluginImagePreview);

window.hljs = hljs;
//window.dayjs = dayjs;
window.SimpleBar = SimpleBar;
window.Swiper = Swiper;
//window.Sortable = Sortable;
//window.ApexCharts = ApexCharts;
//window.Gridjs = Gridjs;
//window.FilePond = FilePond;
//window.flatpickr = flatpickr;
//window.Quill = Quill;
//window.Tom = Tom;

window.helpers = helpers;
window.pages = pages;

//Alpine.plugin(persist);

Alpine.plugin(intersect);
Alpine.plugin(collapse)
Alpine.plugin(Clipboard.configure({
    onCopy: () => {
        notification({
            text: "Lien copier ",
            variant: "info",
            duration: 1500,
            position: 'right-bottom'
        });
    }
}))
//Alpine.plugin(focus)
Alpine.directive("tooltip", tooltip);
Alpine.directive("input-mask", inputMask);


Alpine.magic("notification", () => notification);
//Alpine.magic("clipboard", () => clipboard);

Alpine.store("breakpoints", breakpoints);

Alpine.store("global", store);

Alpine.data("usePopper", usePopper);
Alpine.data("accordionItem", accordionItem);




AOS.init();
//Alpine.start();

Livewire.start();


window.addEventListener('load', function () {
    const preloader = document.querySelector(".app-preloader");


    if (!preloader) return;

    setTimeout(() => {
        preloader.classList.add("animate-[cubic-bezier(0.4,0,0.2,1)_fade-out_500ms_forwards]");
        setTimeout(() => {
            preloader.remove();
        }, 1000);
    }, 150);
});



document.addEventListener('livewire:navigated', () => {


    window.scrollTo({
        top: 0,
        left: 0,
        behavior: 'smooth'
    });

})






Livewire.on('notify', function (event) {

   /* Swal.fire({
        position: 'top-end',
        toast: event[0].toast ? event[0].toast : true,
        icon: event[0].icon,
        title: event[0].message,
        showConfirmButton: false,
        timer: 1500
    }); */

    notification({
        text: event[0].message,
        variant: event[0].icon,
        duration: 1500,
        position: 'right-bottom'
    });
})
Livewire.on('error', function (event) {

    Swal.fire({


        icon: event[0].icon,
        title: event[0].title,
        text: event[0].message,
        showConfirmButton: true,

    })
})






    localStorage.getItem("dark") === "true" &&
    document.documentElement.classList.add("dark");



document.addEventListener('Keydown', (e) => {

    if (!e.target.hasAttribute('wire:navigate'))
        return;

    if (e.key.toLowerCase() == 'enter')
        Alpine.navigate(e.target.href);

});
