function initBlogInfiniteScroll() {
  let offset = 0;
  const limit = 2;
  let loading = false;
  let allLoaded = false;

  function loadBlogs() {
    if (loading || allLoaded) return;
    loading = true;
    document.getElementById('blog-loader').style.display = 'block';
    fetch('blogs_ajax.php?offset=' + offset)
      .then(res => res.text())
      .then(html => {
        if (html.trim() === "") {
          allLoaded = true;
        } else {
          document.getElementById('blog-list').insertAdjacentHTML('beforeend', html);
          offset += limit;
        }
        document.getElementById('blog-loader').style.display = 'none';
        loading = false;
      });
  }

  // Initial load
  loadBlogs();

  // Define onScroll outside so we can remove it later
  function onScroll() {
    if ((window.innerHeight + window.scrollY) >= (document.body.offsetHeight - 200)) {
      loadBlogs();
    }
  }

  window.addEventListener('scroll', onScroll);

  // Store for re-initialization if needed
  window._blogScrollCleanup = function() {
    window.removeEventListener('scroll', onScroll);
  };
}