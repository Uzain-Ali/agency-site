document.addEventListener("DOMContentLoaded", () => {
  const content = document.getElementById("content");

  document.querySelectorAll("[data-link]").forEach(link => {
    link.addEventListener("click", (e) => {
      e.preventDefault();
      const page = e.target.getAttribute("data-link");

      fetch(page)
        .then(res => res.text())
        .then(html => {
          content.innerHTML = html;
          window.history.pushState({}, "", page);
        })
        .catch(() => {
          content.innerHTML = "<div class='alert alert-danger'>Page failed to load</div>";
        });
    });
  });

  // Handle back/forward navigation
  window.addEventListener("popstate", () => {
    fetch(window.location.pathname.split("/").pop())
      .then(res => res.text())
      .then(html => { content.innerHTML = html; });
  });
});

// Fade-in on scroll for sections
document.addEventListener("DOMContentLoaded", () => {
  const fadeEls = document.querySelectorAll('.fade-in-section');
  const onScroll = () => {
    fadeEls.forEach(el => {
      const rect = el.getBoundingClientRect();
      if (rect.top < window.innerHeight - 60) {
        el.classList.add('is-visible');
      }
    });
  };
  onScroll();
  window.addEventListener('scroll', onScroll);
});