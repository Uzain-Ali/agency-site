<?php
require_once("../includes/db.php");

$success = false;
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if email exists
    $exists = $conn->query("SELECT id FROM users WHERE email='$email'")->num_rows;
    if ($exists) {
        $error = "Email already registered.";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, role, approved) VALUES (?, ?, ?, 'editor', 0)");
        $stmt->bind_param("sss", $name, $email, $password);
        $stmt->execute();
        $stmt->close();
        $success = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Registration</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-5">
        <h2 class="mb-4 text-center">Register</h2>
        <?php if ($success): ?>
          <div class="alert alert-success">Registration successful! Wait for admin approval.</div>
        <?php elseif ($error): ?>
          <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form method="post" class="bg-black p-4 rounded">
          <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required autofocus>
          </div>
          <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <button class="btn btn-gold w-100" type="submit">Register</button>
        </form>
        <div class="mt-3 text-center">
          <a href="login.php" class="text-white">Back to Login</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>