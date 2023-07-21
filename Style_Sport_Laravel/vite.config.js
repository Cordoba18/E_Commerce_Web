import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js', 
                'resources/js/navBarResponsive.js', 
                'resources/css/app.scss', 
                'resources/css/form.css',
                'resources/css/productCatalog.css', 
                'resources/css/navbar.css', 
                'resources/css/purchaseform.css',
                'resources/css/purchaseconfirmation.css',
            ],
            refresh: true,
        }),
    ],
});
