import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // -------------JS-----------
                'resources/js/app.js',
                'resources/js/navBarResponsive.js',
                'resources/js/productCarousel.js',
                'resources/js/Slider.js',
                // ------CSS----------
                'resources/css/app.scss',
                'resources/css/home.css',
                'resources/css/form.css',
                'resources/css/ProductCatalog.css',
                'resources/css/paginaProducto.css',
                'resources/css/navbar.css',
                'resources/css/purchaseform.css',
                'resources/css/purchaseconfirmation.css',
            ],
            refresh: true,
        }),
    ],
});
