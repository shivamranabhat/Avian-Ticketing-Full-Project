document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.accordion').forEach(acc => {
    const toggle = acc.querySelector('.toggle-accordion');
    const arrow = acc.querySelector('.arrow-icon');

    toggle.addEventListener('click', () => {
      acc.classList.toggle('active');
      arrow?.classList.toggle('rotate-180');
    });
  });
});
