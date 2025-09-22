<?php
require_once("../includes/auth.php");
require_once("../includes/db.php");

if (isset($_SESSION['all_permissions']) && $_SESSION['all_permissions'] === true) {
    // Admin: skip permission check
} else {
    $userPerms = getUserPermissions($_SESSION['user_id'], $conn);
    if (!in_array('dashboard', $userPerms)) {
        die("Access denied.");
    }
}

// Get counts for dashboard summary
$users_count = $conn->query("SELECT COUNT(*) FROM users")->fetch_row()[0];
$blogs_count = $conn->query("SELECT COUNT(*) FROM blogs")->fetch_row()[0];
$services_count = $conn->query("SELECT COUNT(*) FROM services")->fetch_row()[0];
$testimonials_count = $conn->query("SELECT COUNT(*) FROM testimonials")->fetch_row()[0];
$contacts_count = $conn->query("SELECT COUNT(*) FROM contacts")->fetch_row()[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <style>
    body {
      background: #181818;
      color: #fff;
    }
    .sidebar {
      min-height: 100vh;
      background: #111;
      padding-top: 2rem;
    }
    .sidebar .nav-link {
      color: #fff;
      font-size: 1.1rem;
      margin-bottom: 0.5rem;
      border-radius: 0.4rem;
      transition: background 0.2s;
    }
    .sidebar .nav-link.active,
    .sidebar .nav-link:hover {
      background: #222;
      color: #D4AF37;
    }
    .sidebar .bi {
      font-size: 1.2rem;
      margin-right: 0.7rem;
      vertical-align: -0.125em;
    }
    .profile-box {
      background: #222;
      border-radius: 0.5rem;
      padding: 1.2rem;
      margin-top: 2rem;
      text-align: center;
    }
    .profile-box .bi-person-circle {
      font-size: 2.5rem;
      color: #D4AF37;
    }
    .dashboard-cards .card {
      background: #222;
      border: none;
      color: #fff;
      border-radius: 0.7rem;
    }
    .dashboard-cards .card-title {
      color: #D4AF37;
      font-size: 2.2rem;
    }
    .dashboard-cards .card-text {
      font-size: 1.1rem;
      letter-spacing: 1px;
    }
    @media (max-width: 991px) {
      .sidebar {
        min-height: auto;
        padding-top: 1rem;
      }
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row flex-nowrap">
      <!-- Sidebar -->
      <nav class="col-lg-2 col-md-3 sidebar d-flex flex-column">
        <a href="dashboard.php" class="nav-link active"><i class="bi bi-speedometer2"></i> Dashboard</a>
        <a href="users.php" class="nav-link"><i class="bi bi-people"></i> Users</a>
        <a href="testimonials.php" class="nav-link"><i class="bi bi-chat-quote"></i> Testimonials</a>
        <a href="services.php" class="nav-link"><i class="bi bi-gear"></i> Services</a>
        <a href="permissions.php" class="nav-link"><i class="bi bi-shield-lock"></i> Permissions</a>
        <a href="contacts.php" class="nav-link"><i class="bi bi-envelope"></i> Contact</a>
        <a href="blogs.php" class="nav-link"><i class="bi bi-journal-text"></i> Blogs</a>
        <div class="mt-auto">
          <div class="profile-box">
            <i class="bi bi-person-circle"></i>
            <div class="mt-2 fw-bold"><?= htmlspecialchars($_SESSION['user_name'] ?? 'Admin') ?></div>
            <div class="small text-secondary"><?= htmlspecialchars($_SESSION['role'] ?? '') ?></div>
            <a href="profile.php" class="btn btn-sm btn-outline-light mt-2">Profile</a>
            <a href="logout.php" class="btn btn-sm btn-danger mt-2 ms-2">Logout</a>
          </div>
        </div>
      </nav>
      <!-- Main Content -->
      <main class="col-lg-10 col-md-9 ms-sm-auto px-4 py-4">
        <h1 class="mb-4">Admin Dashboard</h1>
        <div class="row dashboard-cards g-4">
          <div class="col-md-4">
            <div class="card text-center">
              <div class="card-body">
                <div class="card-title"><?= $users_count ?></div>
                <div class="card-text"><i class="bi bi-people"></i> Users</div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card text-center">
              <div class="card-body">
                <div class="card-title"><?= $blogs_count ?></div>
                <div class="card-text"><i class="bi bi-journal-text"></i> Blogs</div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card text-center">
              <div class="card-body">
                <div class="card-title"><?= $services_count ?></div>
                <div class="card-text"><i class="bi bi-gear"></i> Services</div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card text-center">
              <div class="card-body">
                <div class="card-title"><?= $testimonials_count ?></div>
                <div class="card-text"><i class="bi bi-chat-quote"></i> Testimonials</div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card text-center">
              <div class="card-body">
                <div class="card-title"><?= $contacts_count ?></div>
                <div class="card-text"><i class="bi bi-envelope"></i> Contacts</div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
</body>
</html>