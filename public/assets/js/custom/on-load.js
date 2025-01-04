document.addEventListener("DOMContentLoaded", function () {
  const fadeUpElements = document.querySelectorAll('.fade-up');
  const fadeInElements = document.querySelectorAll('.fade-in');

  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('animate');
        observer.unobserve(entry.target);  // Stop observing once the animation is triggered
      }
    });
  });

  fadeUpElements.forEach(element => {
    observer.observe(element);
  });

  fadeInElements.forEach(element => {
    observer.observe(element);
  });
});
