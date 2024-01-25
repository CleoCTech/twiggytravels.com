<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Cleo - Wenla Systems">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="{{ asset('css/style.css')}}" />
        {{-- <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('css/style.css')}}" /> --}}
        <!-- Scripts -->
        <script src="https://kit.fontawesome.com/b7957ff1f4.js" crossorigin="anonymous"></script>
        @routes
        {{-- @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"]) --}}
        @vite(['resources/js/app.js'])
        @inertiaHead
    </head>
    <body>
        @inertia

        
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            const btns =  document.querySelectorAll(".nav-btn");
            const slides =  document.querySelectorAll(".video-slide");

            var sliderNav = function(manual) {
                btns.forEach((btn) => {
                    btn.classList.remove("active")
                })
                slides.forEach((slide) => {
                    slide.classList.remove("active")
                })

                btns[manual].classList.add("active")
                slides[manual].classList.add("active")
            }
            
            btns.forEach((btn, i)=> {
                btn.addEventListener("click", () => {
                    sliderNav(i)
                })
            })
        </script>
        <script>
            // $(document).ready(function() {
            //     $('select').niceSelect();
            // });
        </script>
    </body>
</html>
