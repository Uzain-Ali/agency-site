<nav class="navbar navbar-expand-lg fixed-top bg-transparent" style="background: rgba(24,24,24,0.25) !important;">
  <div class="container">
    <a href="<?= PUBLIC_URL ?>/" data-link="<?= PUBLIC_URL ?>/">
      <img src="<?= ASSETS_URL ?>/logo.png" class="rounded-circle mb-3" alt="Logo" style="width:150px;height:80px;object-fit:cover;">
    </a>
    <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item">
          <a class="nav-link text-white" href="<?= PUBLIC_URL ?>/" data-link="<?= PUBLIC_URL ?>/"><i class="bi bi-house-door me-1"></i>Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="<?= PUBLIC_URL ?>/blogs.php" data-link="<?= PUBLIC_URL ?>/blogs.php"><i class="bi bi-journal-text me-1"></i>Blogs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="<?= PUBLIC_URL ?>/services.php" data-link="<?= PUBLIC_URL ?>/services.php"><i class="bi bi-gear me-1"></i>Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="<?= PUBLIC_URL ?>/about.php" data-link="<?= PUBLIC_URL ?>/about.php"><i class="bi bi-people me-1"></i>About Us</a>
        </li>
      </ul>
      <a class="btn btn-gold ms-lg-3 mt-3 mt-lg-0" href="<?= PUBLIC_URL ?>/contact.php" data-link="<?= PUBLIC_URL ?>/contact.php"><i class="bi bi-envelope me-1"></i>Contact Us</a>
    </div>
  </div>
</nav>