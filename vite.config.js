import { defineConfig } from 'vite';
import { resolve } from 'path';  // Import the resolve function from the 'path' module
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        rollupOptions: {
            input: {
                main: resolve(__dirname, 'resources/views/welcome.blade.php'),
            },
        },
    },
});


