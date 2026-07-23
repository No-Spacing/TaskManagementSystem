import { createApp, h } from 'vue'

import { createInertiaApp } from '@inertiajs/vue3'

import PrimeVue from 'primevue/config';
import Aura from '@primeuix/themes/aura';
import Lara from '@primeuix/themes/lara'
import Ripple from 'primevue/ripple';
import ToastService from 'primevue/toastservice';
import AnimateOnScroll from 'primevue/animateonscroll';
import { animator } from 'chart.js';
import { MotionPlugin } from 'motion-v'

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true }) 
        return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
        .use(plugin)
        .use(PrimeVue, {
            ripple: true,
            theme: {
                preset: {
                ...Aura,
                semantic: {
                    ...Aura.semantic,
                    primary: {
                        50: '#e7f7fc',   // very light
                        100: '#9ceeea',
                        200: '#21eba7',
                        500: '#1bd6cd',  // main brand color
                        600: '#0b8b85',  // hover
                        700: '#07ad92'   // active
                    },
                }
                },
                options: {
                darkModeSelector: '.my-app-dark'
                }
            }
        })
        .use(ToastService)
        .directive('ripple', Ripple)
        .directive('animateonscroll', AnimateOnScroll)
        .use(MotionPlugin)
        .mount(el)
    },
})