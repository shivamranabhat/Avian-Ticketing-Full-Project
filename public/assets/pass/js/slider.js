$(document).ready(function () {
    $(".event-slider").owlCarousel({
        items: 5,
        margin:30,
        loop: true,
        autoplay: true,
        autoplayTimeout: 3000,
        smartSpeed: 1000,        // slide transition speed (ms)
        autoplaySpeed: 1000,     // autoplay transition speed
        nav: false,
        dots: false,
        responsive: {
            // For large screens (desktop)
            1200: {
                items: 4, 
            },
            // For medium screens (tablets)
            768: {
                items: 2.2, 
            },
            // For small screens (mobile)
            0: {
                items: 1.5,
            }
        }
    });

    $(".featured-slider").owlCarousel({
        loop: true,
        center: true,
        margin: 10,
        autoplay: true,
        autoplayTimeout: 3000,
        smartSpeed: 1000,
        autoplaySpeed: 1000,
        nav: false,
        dots: false,
        responsive: {
            1200: {
                items: 3.4
            },
            768: {
                items: 2.4
            },
            0: {
                items: 1.4
            }
        }
    });

    $(".activity-slider").owlCarousel({
        items: 5,
        margin:30,
        loop: true,
        autoplay: true,
        autoplayTimeout: 3000,
        smartSpeed: 1000,        // slide transition speed (ms)
        autoplaySpeed: 1000,     // autoplay transition speed
        nav: false,
        dots: false,
        responsive: {
            // For large screens (desktop)
            1200: {
                items: 4, 
            },
            // For medium screens (tablets)
            768: {
                items: 2.2, 
            },
            // For small screens (mobile)
            0: {
                items: 1.5,
            }
        }
    });
    $("#banner-slider").owlCarousel({
        items: 1,
        margin:30,
        loop: true,
        autoplay: true,
        autoplayTimeout: 3000,
        nav: false,
        dots: true,
        smartSpeed: 1000,        // slide transition speed (ms)
        autoplaySpeed: 1000,     // autoplay transition speed
        nav: false,
        dots: true,

        responsive: {
            0: {
                items: 1,
            }
        }
    });
    $("#activity-banner-slider").owlCarousel({
        items: 2,
        margin:20,
        loop: true,
        autoplay: true,
        autoplayTimeout: 3000,
        nav: false,
        dots: true,
        smartSpeed: 1000,        // slide transition speed (ms)
        autoplaySpeed: 1000,     // autoplay transition speed
        nav: false,
        dots: true,
         responsive: {
            // For large screens (desktop)
            1200: {
                items: 2, 
            },
            768: {
                items: 1.1, 
            }
        }

    });
    $(".partner-slider").owlCarousel({
        items: 5,
        loop: true,
        autoplay: true,
        autoplayTimeout: 3000,
        nav: false,
        dots: false,
        smartSpeed: 1000,        // slide transition speed (ms)
        autoplaySpeed: 1000,     // autoplay transition speed
        responsive: {
            // For large screens (desktop)
            1200: {
                items: 5, 
            },
            // For medium screens (tablets)
            768: {
                items: 3.5, 
            },
            480: {
                items: 2.5, 
            },
            // For small screens (mobile)
            0: {
                items: 2,
            }
        }
    });
   
    const eventSlider = $(".event-slider");
    const activitySlider = $(".activity-slider");
   
    // $("#slidePrev").click(function () {
    //     eventSlider.trigger("prev.owl.carousel"); // Move to previous slide
    // });

    $("#slideNext").click(function () {
        eventSlider.trigger("next.owl.carousel"); // Move to next slide
    });
    $("#activitySlideNext").click(function () {
        activitySlider.trigger("next.owl.carousel"); // Move to next slide
    });

});