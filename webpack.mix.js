const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 |
 */

/* mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps(); */
    
// stylesheets
mix.sass('resources/sass/app.scss', 'public/css')
   .options({
       processCssUrl: false
   });

// javascript
mix.js('resources/js/app.js', 'public/js');

// env
if(mix.inProduction())
{
    mix.version();
}
else
{
    mix.sourceMaps(false, 'inline-source-map');
    mix.browserSync('http://localhost:8000')
}

// backend - back-office
mix.copyDirectory('resources/backend', 'public/backend');
//mix.copyDirectory('resources/frontend', 'public/frontend'); 
