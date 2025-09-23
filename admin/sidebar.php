<nav class="col-lg-2 col-md-3 sidebar d-flex flex-column">
  <a href="/agency-site/admin/dashboard.php" class="nav-link<?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? ' active' : '' ?>"><i class="bi bi-speedometer2"></i> Dashboard</a>
  <a href="/agency-site/admin/users.php" class="nav-link<?= basename($_SERVER['PHP_SELF']) == 'users.php' ? ' active' : '' ?>"><i class="bi bi-people"></i> Users</a>
  <a href="/agency-site/admin/testimonials.php" class="nav-link<?= basename($_SERVER['PHP_SELF']) == 'testimonials.php' ? ' active' : '' ?>"><i class="bi bi-chat-quote"></i> Testimonials</a>
  <a href="/agency-site/admin/services.php" class="nav-link<?= basename($_SERVER['PHP_SELF']) == 'services.php' ? ' active' : '' ?>"><i class="bi bi-gear"></i> Services</a>
  <a href="/agency-site/admin/permissions.php" class="nav-link<?= basename($_SERVER['PHP_SELF']) == 'permissions.php' ? ' active' : '' ?>"><i class="bi bi-shield-lock"></i> Permissions</a>
  <a href="/agency-site/admin/contacts.php" class="nav-link<?= basename($_SERVER['PHP_SELF']) == 'contacts.php' ? ' active' : '' ?>"><i class="bi bi-envelope"></i> Contact</a>
  <a href="/agency-site/admin/blogs.php" class="nav-link<?= basename($_SERVER['PHP_SELF']) == 'blogs.php' ? ' active' : '' ?>"><i class="bi bi-journal-text"></i> Blogs</a>
  <div class="mt-auto">
    <div class="profile-box">
      <i class="bi bi-person-circle"></i>
      <div class="mt-2 fw-bold"><?= htmlspecialchars($_SESSION['user_name'] ?? 'Admin') ?></div>
      <div class="small text-secondary"><?= htmlspecialchars($_SESSION['role'] ?? '') ?></div>
      <a href="/agency-site/admin/profile.php" class="btn btn-sm btn-outline-light mt-2">Profile</a>
      <a href="/agency-site/admin/logout.php" class="btn btn-sm btn-danger mt-2 ms-2">Logout</a>
    </div>
  </div>
</nav>