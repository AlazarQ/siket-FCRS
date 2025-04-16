import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        
    ],
    server: {
        host: 'localhost', // Allow access from any device on the network
        port: 9092,       // Ensure this is the port Vite is running on
    },
});
