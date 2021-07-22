const mix = require('laravel-mix');

mix.sass('./resources/scss/app.scss', 'public/libs/css/app.css');
mix.js('./resources/js/app.js', 'public/libs/js/app.js');