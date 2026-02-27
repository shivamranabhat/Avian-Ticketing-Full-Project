window.addEventListener("load", function () {
    const stickyCol = document.getElementById("right-sticky-col");
    const venueDiv = document.getElementById("extras");

    if (!stickyCol || !venueDiv) return;

    if (window.innerWidth <= 1231) return;

    const originalTop = stickyCol.offsetTop;
    const initialWidth = stickyCol.offsetWidth + "px";

    function handleScroll() {
        const scrollTop = window.scrollY;
        const venueBottom =
            venueDiv.getBoundingClientRect().bottom + window.scrollY;

        if (
            scrollTop > originalTop &&
            scrollTop < venueBottom - stickyCol.offsetHeight - 100
        ) {
            stickyCol.style.position = "fixed";
            stickyCol.style.top = "100px";
            stickyCol.style.width = initialWidth;
        } else if (scrollTop >= venueBottom - stickyCol.offsetHeight - 100) {
            stickyCol.style.position = "absolute";
            stickyCol.style.top =
                venueBottom - stickyCol.offsetHeight + "px";
            stickyCol.style.width = initialWidth;
        } else {
            stickyCol.style.position = "relative";
            stickyCol.style.top = "0";
            stickyCol.style.width = "";
        }
    }

    window.addEventListener("scroll", handleScroll);
});
