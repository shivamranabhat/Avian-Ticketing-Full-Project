document.addEventListener("DOMContentLoaded", function () {
    const navbar = document.querySelector(".navbar");
    const logo = document.querySelector(".logo");

    // Scroll event listener
    window.addEventListener("scroll", function () {
        if (window.scrollY > 0) {
            navbar.classList.add("fixed","top-0","left-0",'px-22','py-2',"z-30","bg-white",'w-full',"shadow-lg"); // Add 'fixed' class when scrolling
            logo.classList.add("w-20"); // Reduce logo size when scrolling
            logo.classList.remove("w-30"); // Reduce logo size when scrolling
        } else {
            navbar.classList.remove("fixed","top-0","left-0",'px-22','py-2',"z-30","bg-white",'w-full',"shadow-lg"); // Remove 'fixed' class when at the top
            logo.classList.remove("w-20"); // Reduce logo size when scrolling
            logo.classList.add("w-30"); // Reduce logo size when scrolling
        }
    });
});