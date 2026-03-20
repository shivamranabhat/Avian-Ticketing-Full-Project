<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avian</title>
    <link rel="stylesheet" href="{{ asset('main/css/style.css') }}">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
</head>

<body>

    {{$slot}}
    <script src="{{ asset('main/js/slider.js') }}"></script>
    <script src="{{ asset('main/js/navbar.js') }}"></script>
</body>

</html>