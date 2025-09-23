<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
include("../config/config.php");

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$stmt = $conn->prepare("SELECT * FROM blogs WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
$blog = $res->fetch_assoc();
$stmt->close();
// Fetch other blogs for widgets (exclude current)
$widgetStmt = $conn->prepare("SELECT id, title, image FROM blogs WHERE id != ? ORDER BY created_at DESC LIMIT 5");
$widgetStmt->bind_param("i", $id);
$widgetStmt->execute();
$widgetRes = $widgetStmt->get_result();
$otherBlogs = [];
while ($row = $widgetRes->fetch_assoc()) {
    $otherBlogs[] = $row;
}
$widgetStmt->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $blog ? htmlspecialchars($blog['title']) . ' - Blog Detail' : 'Blog Not Found' ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link href="assets/style.css" rel="stylesheet">
  <style>
    body { min-height: 100vh; color: #fff; overflow-x: hidden; }
    .bg-video { position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; object-fit: cover; z-index: -1; opacity: 0.5; pointer-events: none; }
    .blog-overlay { background: rgba(24,24,24,0.65); min-height: 100vh; padding-top: 100px; padding-bottom: 40px; }
    .blog-meta { font-size: 1rem; color: #aaa; }
    .blog-content { color: #fff; font-size: 1.1rem; line-height: 1.7; }
    .btn-outline-gold { border: 1px solid #D4AF37; color: #D4AF37; background: transparent; }
    .btn-outline-gold:hover { background: #D4AF37; color: #181818; }
    .widget { background: #181818; border-radius: 0.7rem; padding: 1.5rem 1rem; margin-bottom: 2rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
    .widget-title { color: #D4AF37; font-size: 1.1rem; font-weight: 600; margin-bottom: 1rem; letter-spacing: 1px; }
    .widget-list { list-style: none; padding-left: 0; margin-bottom: 0; }
    .widget-list li { margin-bottom: 1rem; display: flex; align-items: center; }
    .widget-list img { width: 48px; height: 48px; object-fit: cover; border-radius: 0.4rem; margin-right: 0.7rem; border: 1px solid #333; }
    .widget-list a { color: #fff; text-decoration: none; transition: color 0.2s; font-weight: 500; }
    .widget-list a:hover { color: #D4AF37; text-decoration: underline; }
    @media (max-width: 991px) { .blog-overlay { padding-top: 70px; } }
  </style>
</head>
<body>
  <video class="bg-video" autoplay muted loop playsinline>
    <source src="assets/bg-video.mp4" type="video/mp4">
    Your browser does not support the video tag.
  </video>
  <?php include("navbar.php"); ?>
  <div style="height:140px;"></div>
  <div class="blog-overlay">
    <div class="container py-5 fade-in-section">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <?php if ($blog): ?>
            <h1 class="mb-3" style="color:#D4AF37;"><?= htmlspecialchars($blog['title']) ?></h1>
            <div class="blog-meta mb-3 text-secondary">
              <i class="bi bi-calendar"></i>
              <?= date("M d, Y", strtotime($blog['created_at'])) ?>
            </div>
            <?php if ($blog['image']): ?>
              <img src="/agency-site/uploads/blogs/<?= htmlspecialchars($blog['image']) ?>" alt="<?= htmlspecialchars($blog['title']) ?>" class="img-fluid rounded mb-4" style="max-height:350px;object-fit:cover;">
            <?php endif; ?>
            <div class="blog-content mb-4">
              <?= $blog['content'] ?>
            </div>
            <a href="blogs.php" class="btn btn-outline-gold"><i class="bi bi-arrow-left"></i> Back to Blogs</a>
          <?php else: ?>
            <div class="alert alert-danger">Blog not found.</div>
            <a href="blogs.php" class="btn btn-outline-gold mt-4"><i class="bi bi-arrow-left"></i> Back to Blogs</a>
          <?php endif; ?>
        </div>
        <!-- Widgets: Other Blogs -->
        <div class="col-lg-4">
          <div class="widget">
            <div class="widget-title"><i class="bi bi-journal-text"></i> Other Blogs</div>
            <ul class="widget-list">
              <?php foreach($otherBlogs as $ob): ?>
                <li>
                  <?php if ($ob['image']): ?>
                    <img src="/agency-site/uploads/blogs/<?= htmlspecialchars($ob['image']) ?>" alt="<?= htmlspecialchars($ob['title']) ?>">
                  <?php endif; ?>
                  <a href="blog-detail.php?id=<?= $ob['id'] ?>">
                    <?= htmlspecialchars($ob['title']) ?>
                  </a>
                </li>
              <?php endforeach; ?>
              <?php if (empty($otherBlogs)): ?>
                <li class="text-secondary">No other blogs found.</li>
              <?php endif; ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include("footer.php"); ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>