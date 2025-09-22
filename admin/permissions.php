<?php
require_once("../includes/auth.php");
require_once("../includes/db.php");

// Only allow admin
if ($_SESSION['role'] !== 'admin') {
    die("Access denied.");
}

// Approve user
if (isset($_GET['approve'])) {
    $uid = intval($_GET['approve']);
    $conn->query("UPDATE users SET approved=1 WHERE id=$uid");
    header("Location: permissions.php");
    exit;
}

// Update permissions
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['uid'])) {
    $uid = intval($_POST['uid']);
    $perms = isset($_POST['permissions']) ? implode(',', $_POST['permissions']) : '';
    $conn->query("UPDATE users SET permissions='$perms' WHERE id=$uid");
    header("Location: permissions.php");
    exit;
}

$users = $conn->query("SELECT * FROM users ORDER BY created_at DESC");
$features = ['blogs', 'services', 'testimonials', 'contacts', 'dashboard'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Permissions</title>
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
        <h2 class="mb-4">User Approval & Permissions</h2>
        <div class="table-responsive">
          <table class="table table-dark table-striped align-middle">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Approved</th>
                <th>Permissions</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
            <?php while($u = $users->fetch_assoc()): ?>
              <tr>
                <td><?= htmlspecialchars($u['name']) ?></td>
                <td><?= htmlspecialchars($u['email']) ?></td>
                <td><?= $u['role'] ?></td>
                <td>
                  <?php if ($u['approved']): ?>
                    <span class="badge bg-success">Yes</span>
                  <?php else: ?>
                    <a href="?approve=<?= $u['id'] ?>" class="btn btn-sm btn-success">Approve</a>
                  <?php endif; ?>
                </td>
                <td>
                  <form method="post" class="d-flex flex-wrap align-items-center gap-2">
                    <input type="hidden" name="uid" value="<?= $u['id'] ?>">
                    <?php
                      $userPerms = $u['permissions'] ? explode(',', $u['permissions']) : [];
                      foreach ($features as $f):
                    ?>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="permissions[]" value="<?= $f ?>" id="perm-<?= $u['id'] ?>-<?= $f ?>"
                          <?= in_array($f, $userPerms) ? 'checked' : '' ?>>
                        <label class="form-check-label" for="perm-<?= $u['id'] ?>-<?= $f ?>"><?= ucfirst($f) ?></label>
                      </div>
                    <?php endforeach; ?>
                    <button class="btn btn-sm btn-primary ms-2" type="submit">Save</button>
                  </form>
                </td>
                <td>
                  <!-- Optionally add delete or edit user actions here -->
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