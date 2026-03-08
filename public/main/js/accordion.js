document.querySelectorAll('.accordion-trigger').forEach(button => {
      button.addEventListener('click', () => {
        const accordionItem = button.parentElement;
        const content = button.nextElementSibling;
        const isOpen = button.getAttribute('aria-expanded') === 'true';
        const icon = button.querySelector('svg');

        // Close all others (optional – remove if you want independent / multiple open)
        document.querySelectorAll('.accordion-item').forEach(item => {
          if (item !== accordionItem) {
            item.querySelector('.accordion-trigger').setAttribute('aria-expanded', 'false');
            item.querySelector('.accordion-content').style.maxHeight = null;
            item.querySelector('svg').classList.remove('rotate-180');
          }
        });

        // Toggle current
        button.setAttribute('aria-expanded', !isOpen);
        icon.classList.toggle('rotate-180');

        if (!isOpen) {
          content.style.maxHeight = content.scrollHeight + 'px';
        } else {
          content.style.maxHeight = null;
        }
      });
    });