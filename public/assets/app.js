document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll("[data-link]").forEach(link => {
    link.addEventListener("click", async (e) => {
      e.preventDefault();
      const url = link.getAttribute("href") || link.getAttribute("data-link");
      const response = await fetch(url, { headers: { "X-Requested-With": "XMLHttpRequest" } });
      const html = await response.text();
      document.body.innerHTML = html;
      window.history.pushState({}, "", url);
      // Re-attach event listeners after replacing body
      window.scrollTo(0, 0);
      setTimeout(attachAjaxLinks, 100);
    });
  });

  // Handle back/forward navigation
  window.addEventListener("popstate", () => {
    const url = window.location.pathname.split("/").pop();
    fetch(url, { headers: { "X-Requested-With": "XMLHttpRequest" } })
      .then(res => res.text())
      .then(html => {
        document.body.innerHTML = html;
        setTimeout(attachAjaxLinks, 100);
      });
  });

  function attachAjaxLinks() {
    document.querySelectorAll("[data-link]").forEach(link => {
      link.addEventListener("click", async (e) => {
        e.preventDefault();
        const url = link.getAttribute("href") || link.getAttribute("data-link");
        const response = await fetch(url, { headers: { "X-Requested-With": "XMLHttpRequest" } });
        const html = await response.text();
        document.body.innerHTML = html;
        window.history.pushState({}, "", url);
        window.scrollTo(0, 0);
        setTimeout(attachAjaxLinks, 100);
      });
    });
  }
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

