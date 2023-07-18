import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js', 
                'resources/css/app.scss', 
                'resources/css/form.css',
                'resources/css/navbar.css',
            ],
            refresh: true,
        }),
    ],
});
