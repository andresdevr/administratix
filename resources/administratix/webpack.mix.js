const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');
 
mix.js('resources/admin/js/app.js', 'public/js/administratix.js')
    .sass('resources/admin/sass/app.scss', 'public/css/administratix.css')
    .options({
        postCss: [ 
            tailwindcss('./tailwind.config.js') 
        ],
    }) 
    .version();