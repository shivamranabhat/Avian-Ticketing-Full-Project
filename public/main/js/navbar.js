document.addEventListener("DOMContentLoaded", function () {
    const navbar = document.querySelector(".navbar");
    const logo = document.querySelector(".logo");
    const menuToggle = document.getElementById('menu-toggle');
    const closeBtn = document.getElementById('close-menu');
    const mobileMenu = document.getElementById('mobile-menu');
    const backdrop = document.getElementById('menu-backdrop');
    const menuPanel = document.getElementById('menu-panel');
    const menuIcon = document.getElementById('menu-icon'); 

    // Scroll event listener
    window.addEventListener("scroll", function () {
        if (window.scrollY > 0) {
            navbar.classList.add("fixed","top-0","left-0",'px-4','md:px-22',"py-2","z-30","bg-white","w-full","shadow-lg"); // Add 'fixed' class when scrolling
            logo.classList.add("w-20"); // Reduce logo size when scrolling
            logo.classList.remove("w-30","py-4"); // Reduce logo size when scrolling
        } else {
            navbar.classList.remove("fixed","top-0","left-0","px-4","md:px-22","py-2","z-30","bg-white",'w-full',"shadow-lg"); // Remove 'fixed' class when at the top
            logo.classList.remove("w-20"); // Reduce logo size when scrolling
            logo.classList.add("w-30","py-4"); // Reduce logo size when scrolling
        }
    });


        function openMenu() {
            // Make overlay clickable
            mobileMenu.classList.remove('pointer-events-none');
            mobileMenu.classList.add('pointer-events-auto');

            // Fade in backdrop
            backdrop.classList.remove('opacity-0');
            backdrop.classList.add('opacity-100');

            // Slide in panel
            menuPanel.classList.remove('-translate-x-full');
            menuPanel.classList.add('translate-x-0');

            // Optional: hamburger → X
            if (menuIcon) menuIcon.classList.add('rotate');

            // Prevent body scroll
            document.body.style.overflow = 'hidden';
        }

        function closeMenu() {
            // Slide out panel first
            menuPanel.classList.remove('translate-x-0');
            menuPanel.classList.add('-translate-x-full');

            // Fade out backdrop
            backdrop.classList.remove('opacity-100');
            backdrop.classList.add('opacity-0');

            // Optional: X → hamburger
            if (menuIcon) menuIcon.classList.remove('rotate');

            // Allow body scroll again
            document.body.style.overflow = '';

            // After animation finishes → disable pointer events on overlay
            setTimeout(() => {
                if (!menuPanel.classList.contains('translate-x-0')) {
                    mobileMenu.classList.remove('pointer-events-auto');
                    mobileMenu.classList.add('pointer-events-none');
                }
            }, 400); // match transition duration
        }

        // Event listeners
        menuToggle?.addEventListener('click', openMenu);
        closeBtn?.addEventListener('click', closeMenu);

        // Click outside → close
        mobileMenu?.addEventListener('click', (e) => {
            if (e.target === mobileMenu || e.target === backdrop) {
                closeMenu();
            }
        });

        // Optional: Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && menuPanel?.classList.contains('translate-x-0')) {
                closeMenu();
            }
        });
});