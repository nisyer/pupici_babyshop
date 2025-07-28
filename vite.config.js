import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import fg from 'fast-glob'; // 1️⃣ new import

// 2️⃣ grab all .css files in resources/css/
const cssFiles = fg.sync('resources/css/**/*.css');

export default defineConfig({
    plugins: [
        laravel({
            input: [
                ...cssFiles, // 3️⃣ inject all CSS files
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
