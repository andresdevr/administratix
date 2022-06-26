const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');
 
mix.js('resources/administratix/js/app.js', 'public/administratix/js/app.js')
    .sass('resources/administratix/sass/app.scss', 'public/administratix/css/app.css')
    .copyDirectory('resources/administratix/images', 'public/administratix/images')
    .options({
        postCss: [ 
            tailwindcss('./tailwind.config.js') 
        ],
    });


if (mix.inProduction()) {
    mix.version();
}