import { createApp, h } from 'vue'

import { createInertiaApp } from '@inertiajs/vue3'

import PrimeVue from 'primevue/config';
import Aura from '@primeuix/themes/aura';
import Ripple from 'primevue/ripple';
import ToastService from 'primevue/toastservice';
import AnimateOnScroll from 'primevue/animateonscroll';
import { animator } from 'chart.js';
import { MotionPlugin } from 'motion-v'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { MyCustomTheme } from './theme';
import { Link } from "@inertiajs/vue3";

createInertiaApp({
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
        .use(plugin)
        .use(PrimeVue, {
            ripple: true,
            theme: {
                preset: MyCustomTheme,
                options: {
                    darkModeSelector: '.my-app-dark',
                },
            },
        })
        .use(ToastService)
        .use(MotionPlugin)
        .directive('ripple', Ripple)
        .directive('animateonscroll', AnimateOnScroll)
        .component('Link', Link)
        .mount(el)
    },
})