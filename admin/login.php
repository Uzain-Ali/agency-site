<?php
session_start();
require_once("../includes/db.php");

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE email='$email' LIMIT 1");
    $user = $result->fetch_assoc();
echo password_hash('admin', PASSWORD_DEFAULT);

    if ($user && password_verify($password, $user['password'])) {
        if ($user['role'] === 'admin') {
            // Admin: skip approval, grant all permissions
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['all_permissions'] = true;
            header("Location: dashboard.php");
            exit;
        } elseif (isset($user['approved']) && !$user['approved']) {
            $error = "Your account is pending approval by admin.";
        } else {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            unset($_SESSION['all_permissions']);
            header("Location: dashboard.php");
            exit;
        }
    } else {
        $error = "Invalid credentials.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <h2 class="mb-4 text-center">Admin Login</h2>
        <?php if ($error): ?>
          <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form method="post" class="bg-black p-4 rounded">
          <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required autofocus>
          </div>
          <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <button class="btn btn-gold w-100" type="submit">Login</button>
        </form>
        <div class="mt-3 text-center">
          <a href="register.php" class="text-white">Register</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>