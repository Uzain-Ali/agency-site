document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll("[data-link]").forEach(link => {
    link.addEventListener("click", async (e) => {
      e.preventDefault();
      const url = link.getAttribute("href") || link.getAttribute("data-link");
      const response = await fetch(url, { headers: { "X-Requested-With": "XMLHttpRequest" } });
      const html = await response.text();
      const parser = new DOMParser();
      const doc = parser.parseFromString(html, "text/html");
      const newContent = doc.getElementById("content");
      if (newContent) {
        document.getElementById("content").innerHTML = newContent.innerHTML;
        window.scrollTo(0, 0);
        afterAsyncNavigation(url);
      }
      window.history.pushState({}, "", url);
      window.scrollTo(0, 0);
      setTimeout(attachAjaxLinks, 100);

      // Re-initialize blog infinite scroll if on blogs page
      if (window._blogScrollCleanup) window._blogScrollCleanup();
      if (url.includes('blogs.php')) {
        loadScript('assets/blogs.js', function() {
          if (typeof initBlogInfiniteScroll === "function") {
            initBlogInfiniteScroll();
          }
        });
      }
    });
  });

  // Handle back/forward navigation
  window.addEventListener("popstate", () => {
    const url = window.location.pathname.split("/").pop();
    fetch(url, { headers: { "X-Requested-With": "XMLHttpRequest" } })
      .then(res => res.text())
      .then(html => {
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, "text/html");
        const newContent = doc.getElementById("content");
        if (newContent) {
          document.getElementById("content").innerHTML = newContent.innerHTML;
          window.scrollTo(0, 0);
          afterAsyncNavigation(url);
        }
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
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, "text/html");
        const newContent = doc.getElementById("content");
        if (newContent) {
          document.getElementById("content").innerHTML = newContent.innerHTML;
          window.scrollTo(0, 0);
          afterAsyncNavigation(url);
        }
        window.history.pushState({}, "", url);
        window.scrollTo(0, 0);
        setTimeout(attachAjaxLinks, 100);

        // Re-initialize blog infinite scroll if on blogs page
        if (url.includes('blogs.php') && typeof initBlogInfiniteScroll === "function") {
          initBlogInfiniteScroll();
        }
      });
    });
  }



  // On initial load
  initFadeInSections();
});
function initFadeInSections() {
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
  window._fadeScrollCleanup = function() {
    window.removeEventListener('scroll', onScroll);
  };
}
// After async navigation, call this:
function afterAsyncNavigation(url) {
  // Clean up old listeners
  if (window._fadeScrollCleanup) window._fadeScrollCleanup();
  initFadeInSections();

  // Blog infinite scroll
  if (window._blogScrollCleanup) window._blogScrollCleanup();
  if (url.includes('blogs.php')) {
    loadScript('assets/blogs.js', function() {
      if (typeof initBlogInfiniteScroll === "function") {
        initBlogInfiniteScroll();
      }
    });
  }
}



function loadScript(src, callback) {
  const script = document.createElement('script');
  script.src = src;
  script.onload = callback || function(){};
  document.head.appendChild(script);
}