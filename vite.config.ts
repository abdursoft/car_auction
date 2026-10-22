import inertia from '@inertiajs/vite';
import { wayfinder } from '@laravel/vite-plugin-wayfinder';
import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.ts'],
            refresh: true,
        }),
        inertia(),
        tailwindcss(),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        wayfinder({
            formVariants: true,
            command: 'cd /home/esycode/docker-php && docker compose exec -T -w /var/www/html/car_auction php php artisan wayfinder:generate --with-form',
        }), ,
    ],
    server: {
        host: '0.0.0.0',
        port: 5173,
        strictPort: true,

        cors: {
            origin: 'http://car-auction.local:8080',
        },

        hmr: {
            host: 'car-auction.local',
            clientPort: 5173,
        },
    },
});
