import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/App.css', 'resources/js/App.jsx'],
            refresh: true,
        }),
        react(),
    ],
});
