<?php
include("../config/config.php");

$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
$limit = 2;

$blogs = $conn->query("SELECT * FROM blogs ORDER BY created_at DESC LIMIT $limit OFFSET $offset");

while($blog = $blogs->fetch_assoc()):
?>
<div class="blog-card">
  <?php if ($blog['image']): ?>
    <img src="/agency-site/uploads/blogs/<?= htmlspecialchars($blog['image']) ?>" alt="<?= htmlspecialchars($blog['title']) ?>">
  <?php endif; ?>
  <div class="card-body">
    <div class="blog-meta mb-2">
      <i class="bi bi-calendar"></i>
      <?= date("M d, Y", strtotime($blog['created_at'])) ?>
    </div>
    <h2 class="card-title"><?= htmlspecialchars($blog['title']) ?></h2>
    <p class="card-text"><?= htmlspecialchars(mb_strimwidth(strip_tags($blog['content']), 0, 180, "...")) ?></p>
    <a href="blog-detail.php?id=<?= $blog['id'] ?>" class="btn btn-gold btn-sm"><i class="bi bi-arrow-right"></i> Read More</a>
  </div>
</div>
<?php endwhile; ?>