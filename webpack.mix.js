let mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.disableNotifications();

mix
  .js("resources/assets/js/app.js", "public/js")
  .sass("resources/assets/sass/app.scss", "public/css")
  .sass("resources/assets/sass/post.scss", "public/css");
// .copy('node_modules/jquery/dist/jquery.min.js', 'public/assets/js')
// .copy('node_modules/slick-carousel/slick/slick.min.js', 'public/assets/js')
// .copy('node_modules/slick-carousel/slick/slick.css', 'public/assets/css')
// .copy('node_modules/slick-carousel/slick/slick-theme.css', 'public/assets/css')
// .copy('node_modules/ckeditor', 'public/js/ckeditor');
