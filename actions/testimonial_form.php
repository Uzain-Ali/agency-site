<?php
require_once("../includes/auth.php");
require_once("../includes/db.php");

$isEdit = isset($_GET['id']);
$testimonial = [
    'client_name' => '',
    'feedback' => '',
    'avatar' => ''
];

if ($isEdit) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM testimonials WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res->num_rows) {
        $testimonial = $res->fetch_assoc();
    }
    $stmt->close();
}

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $client_name = $conn->real_escape_string($_POST['client_name']);
    $feedback = $conn->real_escape_string($_POST['feedback']);

    // Handle avatar upload
    $avatar = $testimonial['avatar'];
    if (!empty($_FILES['avatar']['name'])) {
        $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/agency-site/uploads/testimonials/";
        $avatar = uniqid() . "_" . basename($_FILES["avatar"]["name"]);
        $target_file = $target_dir . $avatar;
        move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file);
    }

    if ($isEdit) {
        $id = intval($_POST['id']);
        $stmt = $conn->prepare("UPDATE testimonials SET client_name=?, feedback=?, avatar=? WHERE id=?");
        $stmt->bind_param("sssi", $client_name, $feedback, $avatar, $id);
        $stmt->execute();
        $stmt->close();
        header("Location: ../admin/testimonials.php?updated=1");
        exit;
    } else {
        $stmt = $conn->prepare("INSERT INTO testimonials (client_name, feedback, avatar) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $client_name, $feedback, $avatar);
        if ($stmt->execute()) {
            header("Location: ../admin/testimonials.php?added=1");
            exit;
        } else {
            $error = "Error occurred.";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $isEdit ? 'Edit Testimonial' : 'Add Testimonial' ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <style>
    .sidebar { min-height: 100vh; background: #111; padding-top: 2rem; }
.sidebar .nav-link { color: #fff; font-size: 1.1rem; margin-bottom: 0.5rem; border-radius: 0.4rem; transition: background 0.2s; }
.sidebar .nav-link.active, .sidebar .nav-link:hover { background: #222; color: #D4AF37; }
.sidebar .bi { font-size: 1.2rem; margin-right: 0.7rem; vertical-align: -0.125em; }
.profile-box { background: #222; border-radius: 0.5rem; padding: 1.2rem; margin-top: 2rem; text-align: center; }
.profile-box .bi-person-circle { font-size: 2.5rem; color: #D4AF37; }
@media (max-width: 991px) { .sidebar { min-height: auto; padding-top: 1rem; } }
    body { background: #181818; color: #fff; }
    .main-content { min-height: 100vh; }
    .form-label { color: #D4AF37; }
    .form-control { background: #222; color: #fff; border: 1px solid #333; }
    .form-control:focus { border-color: #D4AF37; box-shadow: none; }
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
        <h1 class="mb-4 text-center"><?= $isEdit ? 'Edit Testimonial' : 'Add Testimonial' ?></h1>
        <?php if ($error): ?>
          <div class="alert alert-danger text-center"><?= $error ?></div>
        <?php endif; ?>
        <div class="d-flex justify-content-center align-items-center" style="min-height:60vh;">
          <form method="post" enctype="multipart/form-data" class="bg-black p-4 rounded shadow-sm w-100" style="max-width:500px;">
            <?php if ($isEdit): ?>
              <input type="hidden" name="id" value="<?= $testimonial['id'] ?>">
            <?php endif; ?>
            <div class="mb-3">
              <label class="form-label" for="client_name"><i class="bi bi-person"></i> Client Name</label>
              <input type="text" class="form-control" id="client_name" name="client_name" required value="<?= htmlspecialchars($testimonial['client_name']) ?>">
            </div>
            <div class="mb-3">
              <label class="form-label" for="feedback"><i class="bi bi-chat-quote"></i> Feedback</label>
              <textarea class="form-control" id="feedback" name="feedback" rows="3" required><?= htmlspecialchars($testimonial['feedback']) ?></textarea>
            </div>
            <div class="mb-3">
              <label class="form-label" for="avatar"><i class="bi bi-image"></i> Avatar</label>
              <input type="file" class="form-control" id="avatar" name="avatar" <?= $isEdit ? '' : 'required' ?>>
              <?php if ($isEdit && $testimonial['avatar']): ?>
                <div class="mt-2">
                  <img src="../public/assets/testimonials/<?= htmlspecialchars($testimonial['avatar']) ?>" alt="Avatar" style="width:80px;border-radius:50%;">
                </div>
              <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-gold w-100"><?= $isEdit ? 'Update Testimonial' : 'Add Testimonial' ?></button>
          </form>
        </div>
      </main>
    </div>
  </div>
</body>
</html>