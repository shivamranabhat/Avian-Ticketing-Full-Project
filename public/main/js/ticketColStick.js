window.onload = function () {
    const stickyCol = document.getElementById('right-sticky-col');
    const venueDiv = document.getElementById('venue');

    // Only proceed if required elements are found
    if (!stickyCol || !venueDiv) {
        return;
    }

    const originalPosition = stickyCol.getBoundingClientRect().top + window.scrollY;
    const initialWidth = window.getComputedStyle(stickyCol).width;


    const timingOffset = 150; // Adjust for spacing

    function handleCombinedScroll() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        // Sticky column behavior
        const venueBottom = venueDiv.getBoundingClientRect().bottom + window.scrollY;
        if (scrollTop > originalPosition && scrollTop < venueBottom - stickyCol.offsetHeight) {
            stickyCol.style.width = initialWidth;
            stickyCol.style.position = 'fixed';
            stickyCol.style.top = '100px';
        } else if (scrollTop >= venueBottom - stickyCol.offsetHeight) {
            stickyCol.style.position = 'absolute';
            stickyCol.style.top = `${venueBottom - stickyCol.offsetHeight}px`;
        } else {
            stickyCol.style.width = 'auto';
            stickyCol.style.position = 'relative';
            stickyCol.style.top = 'initial';
        }

    }

    if (window.innerWidth > 1231) {
        window.onscroll = handleCombinedScroll;
    }
};