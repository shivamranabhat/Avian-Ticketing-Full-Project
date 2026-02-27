<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings | Avian Pass</title>
    <link rel="stylesheet" href="{{asset('assets/pass/css/style.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">
        @theme {
        --color-primary: #545459;
        --color-secondary: #242E44;
        --bg-active: #c2c4f1;
        --color-purple: #3338D0;
        --shadow-box: rgba(0, 0, 0, 0.24) 0px 3px 8px;;
      }
    </style>
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Owl Carousel JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    

</head>

<body>

    
    {{$slot}}

    <livewire:pass.footer />

    
    <script src="{{asset('assets/pass/js/pass/navbar.js')}}"></script>
    <script src="{{asset('assets/pass/js/pass/accordionPass.js')}}"></script>
    <script src="{{asset('assets/pass/js/pass/slider.js')}}"></script>
    <script src="{{asset('assets/pass/js/pass/profileImgStick.js')}}"></script>
    <script src="{{asset('assets/pass/js/accordion.js')}}"></script>

</body>

</html>