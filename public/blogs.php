<?php
// filepath: c:\xampp\htdocs\agency-site\public\blogs.php
include("../config.php");

// Fetch all blogs
$blogs = $conn->query("SELECT * FROM blogs ORDER BY created_at DESC");

// Fetch recent posts (last 5)
$recent = $conn->query("SELECT id, title, slug FROM blogs ORDER BY created_at DESC LIMIT 5");

// Example categories (replace with dynamic if you have a categories table)
$categories = [
    "Web Development",
    "Graphics Design",
    "SEO",
    "Quality Assurance",
    "Business"
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Agency Blogs</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link href="assets/style.css" rel="stylesheet">
  <style>
    body {
      min-height: 100vh;
      color: #fff;
      overflow-x: hidden;
    }
    .bg-video {
      position: fixed;
      top: 0; left: 0;
      width: 100vw;
      height: 100vh;
      object-fit: cover;
      z-index: -1;
      opacity: 0.5;
      pointer-events: none;
    }
        .blog-card {
      background: #222;
      border-radius: 1rem;
      box-shadow: 0 2px 16px rgba(0,0,0,0.2);
      margin-bottom: 2rem;
      overflow: hidden;
      transition: transform 0.2s;
    }
    .blog-card:hover {
      transform: translateY(-4px) scale(1.01);
      box-shadow: 0 4px 24px rgba(212,175,55,0.15);
    }
    .blog-card img {
      width: 100%;
      height: 220px;
      object-fit: cover;
      border-bottom: 1px solid #333;
    }
    .blog-card .card-body {
      padding: 1.5rem;
    }
    .blog-card .card-title {
      color: #D4AF37;
      font-size: 1.4rem;
      font-weight: 600;
    }
    .blog-card .card-text {
      color: #ccc;
      font-size: 1rem;
      margin-bottom: 1rem;
    }
    .blog-meta {
      font-size: 0.95rem;
      color: #aaa;
    }
    .widget {
      background: #181818;
      border-radius: 0.7rem;
      padding: 1.5rem 1rem;
      margin-bottom: 2rem;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }
    .widget-title {
      color: #D4AF37;
      font-size: 1.1rem;
      font-weight: 600;
      margin-bottom: 1rem;
      letter-spacing: 1px;
    }
    .widget-list {
      list-style: none;
      padding-left: 0;
      margin-bottom: 0;
    }
    .widget-list li {
      margin-bottom: 0.7rem;
    }
    .widget-list a {
      color: #fff;
      text-decoration: none;
      transition: color 0.2s;
    }
    .widget-list a:hover {
      color: #D4AF37;
      text-decoration: underline;
    }
    @media (max-width: 991px) {
      .blog-card img { height: 160px; }
      .blog-overlay { padding-top: 70px; }
    }

  </style>
</head>
<body>
  <!-- Video Background -->
  <video class="bg-video" autoplay muted loop playsinline>
    <source src="assets/bg-video.mp4" type="video/mp4">
    Your browser does not support the video tag.
  </video>
  <!-- Navbar -->
  <?php include("navbar.php"); ?>
  <div style="height:140px;"></div>
  <div id="content">
    <div class="blog-overlay">
      <div class="container">
        <div class="row">
          <!-- Blog Posts -->
          <div class="col-lg-8">
          <div id="blog-list"></div>
          <div id="blog-loader" class="text-center my-3" style="display:none;">
              <div class="spinner-border text-warning"></div>
          </div>
          </div>
          <!-- Sidebar Widgets -->
          <div class="col-lg-4">
            <!-- Recent Posts Widget -->
            <div class="widget">
              <div class="widget-title"><i class="bi bi-clock-history"></i> Recent Posts</div>
              <ul class="widget-list">
                <?php while($r = $recent->fetch_assoc()): ?>
                  <li>
                    <a href="blog-detail.php?id=<?= $r['id'] ?>">
                      <i class="bi bi-chevron-right"></i> <?= htmlspecialchars($r['title']) ?>
                    </a>
                  </li>
                <?php endwhile; ?>
              </ul>
            </div>
            <!-- Categories Widget -->
            <div class="widget">
              <div class="widget-title"><i class="bi bi-tags"></i> Categories</div>
              <ul class="widget-list">
                <?php foreach($categories as $cat): ?>
                  <li>
                    <a href="#"><i class="bi bi-tag"></i> <?= htmlspecialchars($cat) ?></a>
                  </li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include("footer.php"); ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
if (window._blogScrollCleanup) window._blogScrollCleanup();
if (typeof initBlogInfiniteScroll === "function") {
  initBlogInfiniteScroll();
}
</script>
</body>
</html>