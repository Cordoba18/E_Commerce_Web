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
                'resources/js/productProfile.js',
                'resources/js/ShoppingCart.js',
                'resources/js/customer.js',
                'resources/js/VerificationEmail.js',
                'resources/js/VerificationEmailpassword.js',
                'resources/js/WishList.js',
                'resources/js/purchaseForm.js',
                'resources/js/home.js',
                // ------CSS----------
                'resources/css/app.scss',
                'resources/css/home.css',
                'resources/css/customerprofile.css',
                'resources/css/form.css',
                'resources/css/ProductCatalog.css',
                'resources/css/paginaProducto.css',
                'resources/css/navbar.css',
                'resources/css/purchaseform.css',
                'resources/css/purchaseconfirmation.css',
                'resources/css/ValidateEmail.css',
                'resources/css/shoppingcart.css',
                'resources/css/recoverpassword.css',
            ],
            refresh: true,
        }),
    ],
});
