<?php
require_once("../includes/auth.php");
require_once("../includes/db.php");

$isEdit = isset($_GET['id']);
$user = [
    'name' => '',
    'email' => '',
    'role' => 'editor',
    'approved' => 0
];

if ($isEdit) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res->num_rows) {
        $user = $res->fetch_assoc();
    }
    $stmt->close();
}

$error = '';
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $role = $_POST['role'];
    $approved = isset($_POST['approved']) ? 1 : 0;

    if ($isEdit) {
        $id = intval($_POST['id']);
        $stmt = $conn->prepare("UPDATE users SET name=?, email=?, role=?, approved=? WHERE id=?");
        $stmt->bind_param("sssii", $name, $email, $role, $approved, $id);
        $stmt->execute();
        $stmt->close();
        $success = true;
        header("Location: ../admin/users.php?updated=1");
        exit;
    } else {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, role, approved) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $name, $email, $password, $role, $approved);
        if ($stmt->execute()) {
            $success = true;
            header("Location: ../admin/users.php?added=1");
            exit;
        } else {
            $error = "Email already exists or error occurred.";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $isEdit ? 'Edit User' : 'Add User' ?></title>
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
    .form-label { color: #D4AF37; }
    .form-control, .form-select { background: #222; color: #fff; border: 1px solid #333; }
    .form-control:focus, .form-select:focus { border-color: #D4AF37; box-shadow: none; }
    .input-group-text { background: #222; color: #D4AF37; border: 1px solid #333; }
    .btn-gold { background-color: #D4AF37; color: #000; border: none; }
    .btn-gold:hover { background-color: #c9a233; color: #000; }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row flex-nowrap">
      <?php include_once '../admin/sidebar.php'; ?>
      <main class="col-lg-10 col-md-9 ms-sm-auto px-4 py-4 main-content">
        <h1 class="mb-4 text-center"><?= $isEdit ? 'Edit User' : 'Add User' ?></h1>
        <?php if ($error): ?>
          <div class="alert alert-danger text-center"><?= $error ?></div>
        <?php endif; ?>
        <div class="d-flex justify-content-center align-items-center" style="min-height:60vh;">
          <form method="post" class="bg-black p-4 rounded shadow-sm w-100" style="max-width:500px;">
            <?php if ($isEdit): ?>
              <input type="hidden" name="id" value="<?= $user['id'] ?>">
            <?php endif; ?>
            <div class="mb-3">
              <label class="form-label" for="name"><i class="bi bi-person"></i> Name</label>
              <input type="text" class="form-control" id="name" name="name" required value="<?= htmlspecialchars($user['name']) ?>">
            </div>
            <div class="mb-3">
              <label class="form-label" for="email"><i class="bi bi-envelope"></i> Email</label>
              <input type="email" class="form-control" id="email" name="email" required value="<?= htmlspecialchars($user['email']) ?>">
            </div>
            <?php if (!$isEdit): ?>
            <div class="mb-3">
              <label class="form-label" for="password"><i class="bi bi-key"></i> Password</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
            </div>
            <?php endif; ?>
            <div class="mb-3">
              <label class="form-label" for="role"><i class="bi bi-person-badge"></i> Role</label>
              <select class="form-select" id="role" name="role" required>
                <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                <option value="editor" <?= $user['role'] === 'editor' ? 'selected' : '' ?>>Editor</option>
              </select>
            </div>
            <div class="form-check mb-3">
              <input class="form-check-input" type="checkbox" id="approved" name="approved" <?= $user['approved'] ? 'checked' : '' ?>>
              <label class="form-check-label" for="approved"><i class="bi bi-check-circle"></i> Approved</label>
            </div>
            <button type="submit" class="btn btn-gold w-100"><?= $isEdit ? 'Update User' : 'Add User' ?></button>
          </form>
        </div>
      </main>
    </div>
  </div>
</body>
</html>