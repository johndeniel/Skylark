import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

const appUrl = process.env.APP_URL;

export default defineConfig({
    server: {
        hmr: {
            host: appUrl,
        }
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
});
