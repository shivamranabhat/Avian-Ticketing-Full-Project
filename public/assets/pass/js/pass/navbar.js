document.addEventListener("DOMContentLoaded", function () {
    const navbar = document.querySelector(".navbar");


    // Scroll event listener
    window.addEventListener("scroll", function () {
        if (window.scrollY > 0) {
            navbar.classList.add("fixed","top-6","left-0","z-30",'w-[90%]','md:w-[70%]',"right-0","mx-auto","shadow-lg"); // Add 'fixed' class when scrolling
        } else {
            navbar.classList.remove("fixed","top-6","left-0","z-30",'w-[90%]','md:w-[70%]',"right-0","mx-auto","shadow-lg"); // Remove 'fixed' class when at the top
        }
    });
});