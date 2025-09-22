<?php
require_once("../includes/auth.php");
require_once("../includes/db.php");

if (isset($_SESSION['all_permissions']) && $_SESSION['all_permissions'] === true) {
    // Admin: skip permission check
} else {
    $userPerms = getUserPermissions($_SESSION['user_id'], $conn);
    if (!in_array('services', $userPerms)) {
        die("Access denied.");
    }
}
$result = $conn->query("SELECT * FROM services ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin - Services</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <style>
    body { background: #181818; color: #fff; }
    .sidebar { min-height: 100vh; background: #111; padding-top: 2rem; }
    .sidebar .nav-link { color: #fff; font-size: 1.1rem; margin-bottom: 0.5rem; border-radius: 0.4rem; transition: background 0.2s; }
    .sidebar .nav-link.active, .sidebar .nav-link:hover { background: #222; color: #D4AF37; }
    .sidebar .bi { font-size: 1.2rem; margin-right: 0.7rem; vertical-align: -0.125em; }
    .profile-box { background: #222; border-radius: 0.5rem; padding: 1.2rem; margin-top: 2rem; text-align: center; }
    .profile-box .bi-person-circle { font-size: 2.5rem; color: #D4AF37; }
    @media (max-width: 991px) { .sidebar { min-height: auto; padding-top: 1rem; } }
    .main-content { min-height: 100vh; }
    .table thead th { color: #D4AF37; }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row flex-nowrap">
      <?php include 'sidebar.php'; ?>
      <main class="col-lg-10 col-md-9 ms-sm-auto px-4 py-4 main-content">
        <h1 class="mb-4">Services Management</h1>
        <a href="service_add.php" class="btn btn-success mb-3"><i class="bi bi-plus-circle"></i> Add Service</a>
        <div class="table-responsive">
          <table class="table table-dark table-striped align-middle">
            <thead>
              <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Description</th>
                <th>Basic Price</th>
                <th>Premium Price</th>
                <th>Image</th>
                <th>Created At</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
              <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['title']) ?></td>
                <td><?= htmlspecialchars($row['slug']) ?></td>
                <td><?= htmlspecialchars($row['description']) ?></td>
                <td><?= $row['price_basic'] ?></td>
                <td><?= $row['price_premium'] ?></td>
                <td>
                  <?php if ($row['image']): ?>
                    <img src="../public/assets/services/<?= htmlspecialchars($row['image']) ?>" alt="Service Image" style="width:40px;height:40px;">
                  <?php endif; ?>
                </td>
                <td><?= $row['created_at'] ?></td>
                <td>
                  <a href="service_edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                  <a href="service_delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this service?')"><i class="bi bi-trash"></i></a>
                </td>
              </tr>
            <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      </main>
    </div>
  </div>
</body>
</html>