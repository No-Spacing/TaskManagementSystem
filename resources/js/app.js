import { createApp, h } from 'vue'

import { createInertiaApp } from '@inertiajs/vue3'

import PrimeVue from 'primevue/config';
import Aura from '@primeuix/themes/aura';
import Ripple from 'primevue/ripple';
import ToastService from 'primevue/toastservice';

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue') 
        return pages[`./Pages/${name}.vue`]()
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
        .use(plugin)
        .use(PrimeVue, {
            ripple: true,
            theme: {
                preset: Aura,
                options: {
                    darkModeSelector: '.my-app-dark',
                }
            }
        })
        .use(ToastService)
        .directive('ripple', Ripple)
        .mount(el)
    },
})