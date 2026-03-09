import { createApp, h } from 'vue'

import { createInertiaApp } from '@inertiajs/vue3'

import PrimeVue from 'primevue/config';
import Aura from '@primeuix/themes/aura';
import Ripple from 'primevue/ripple';

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue') 
        return pages[`./Pages/${name}.vue`]()
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
        .use(plugin)
        .use(PrimeVue, {
            theme: {
                preset: Aura,
                options: {
                    darkModeSelector: '.my-app-dark',
                }
            }
        })
        .directive('ripple', Ripple)
        .mount(el)
    },
})