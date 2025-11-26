import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { viteStaticCopy } from "vite-plugin-static-copy";

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
       viteStaticCopy({
    targets: [
        {
            src: [
                'node_modules/@tabler/core/dist/css/*.min.css'
            ],
            dest: 'css'
        },
        {
            src: [
                'node_modules/@tabler/core/dist/js/*.min.js'
            ],
            dest: 'js'
        },
        {
            src: 'node_modules/@tabler/core/dist/libs/*',
            dest: 'libs'
        },
        {
            src: 'node_modules/@tabler/core/dist/img/*',
            dest: 'img'
        },
    ]
})
    ],
});
