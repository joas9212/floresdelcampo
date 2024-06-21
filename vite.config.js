import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.scss',
                'resources/css/website.scss',
                'resources/js/app.js',
                'resources/js/website.js',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
          '@jquery': 'node_modules/jquery/dist/jquery.min.js',
          '@slick': 'node_modules/slick-carousel/slick/slick.min.js',
          '@slick_scss': 'node_modules/slick-carousel/slick/slick.scss',
          '@slick_theme_scss': 'node_modules/slick-carousel/slick/slick-theme.scss',
          '@bootstrap': 'node_modules/bootstrap/dist/js/bootstrap.bundle.min.js',
          '@select2_css': 'node_modules/select2/dist/css/select2.min.css',
          '@select2': 'node_modules/select2/dist/js/select2.min.js',
          '@chartjs': 'node_modules/chart.js/auto/auto.js',
        },
      },
});