$(document).ready(function () {

    const owl = $('.testimonials').owlCarousel({
        items: 1,
        loop: false,
        dots: false,
        nav: false,
        smartSpeed: 700
    });

    const prevBtn = $('#prevBtn');
    const nextBtn = $('#nextBtn');

    function updateButtons() {
        const carousel = owl.data('owl.carousel');
        const current = carousel.relative(carousel.current());
        const total = carousel.items().length;

        // Left button
        if (current === 0) {
            prevBtn.addClass('opacity-40 pointer-events-none');
        } else {
            prevBtn.removeClass('opacity-40 pointer-events-none');
        }

        // Right button
        if (current === total - 1) {
            nextBtn.addClass('opacity-40 pointer-events-none');
        } else {
            nextBtn.removeClass('opacity-40 pointer-events-none');
        }
    }

    // Run immediately on load
    updateButtons();

    // Run on every change
    owl.on('changed.owl.carousel', updateButtons);

    prevBtn.click(() => owl.trigger('prev.owl.carousel'));
    nextBtn.click(() => owl.trigger('next.owl.carousel'));

});