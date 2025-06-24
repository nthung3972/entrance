import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/scss/app.scss',
                'resources/js/app.js',
                'resources/js/user/home.js',
                'resources/js/admin/search-hotel.js',
                'resources/js/admin/hotel-update.js',
                'resources/js/admin/hotel-delete.js',
                'resources/js/admin/booking-search.js'
            ],
            refresh: true,
        }),
    ],
});
