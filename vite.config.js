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
                    // Separate PrimeVue components & icons into their own chunk
                    if (id.includes('primevue') || id.includes('@primevue') || id.includes('primeicons')) {
                        return 'primevue';
                    }
                    // Bundle core Vue and Inertia dependencies together
                    if (id.includes('vue') || id.includes('@inertiajs')) {
                        return 'vendor-vue';
                    }
                    // Everything else in node_modules goes here
                    return 'vendor';
                }
            },
        },
    },
});
