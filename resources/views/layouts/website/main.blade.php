<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=width-device, initial-scale=1, scaleable=no">
        @vite('resources/css/website.scss')
        @vite('resources/js/website.js')
    </head>
    </head>
    <body>
        <div id="website_main">

            @include('layouts.website.includes.header')

            @include('layouts.website.includes.nav')
            
            @include('layouts.website.includes.section_slider')

            @include('layouts.website.includes.section_store')
            
            @include('layouts.website.includes.footer')

        </div>
    </body>
</html>

<!-- @ yield('content') -->