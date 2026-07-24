import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue'

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
        vue(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
    build: {
        chunkSizeWarningLimit: 1000,
        rollupOptions: {
            onwarn(warning, warn) {
                // Ignore Rollup's invalid annotation warning for PURE comments
                if (warning.code === 'INVALID_ANNOTATION') return;

                // Pass through all other warnings
                warn(warning);
            },
        },
        output: {
            manualChunks(id) {
                if (id.includes('node_modules')) {
                    // Pull PrimeVue, themes, and PrimeIcons out of app.js
                    if (id.includes('primevue') || id.includes('@primevue') || id.includes('@primeuix')) {
                    return 'vendor-primevue';
                    }
                    // Pull Motion plugin / VueUse out
                    if (id.includes('@vueuse') || id.includes('motion')) {
                    return 'vendor-motion';
                    }
                    // Pull Vue framework and Inertia out
                    if (id.includes('vue') || id.includes('@inertiajs')) {
                    return 'vendor-vue';
                    }
                }
            },
        },
    },
});
