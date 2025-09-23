<?php
require_once("../includes/auth.php");
require_once("../includes/db.php");

$isEdit = isset($_GET['id']);
$blog = [
    'title' => '',
    'slug' => '',
    'content' => '',
    'image' => ''
];

if ($isEdit) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM blogs WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res->num_rows) {
        $blog = $res->fetch_assoc();
    }
    $stmt->close();
}

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST['title']);
    $slug = $conn->real_escape_string($_POST['slug']);
    $content = $conn->real_escape_string($_POST['content']);

    // Handle image upload
    $image = $blog['image'];
    if (!empty($_FILES['image']['name'])) {
    $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/agency-site/uploads/blogs/";
    $image = uniqid() . "_" . basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $image;
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    }

    if ($isEdit) {
        $id = intval($_POST['id']);
        $stmt = $conn->prepare("UPDATE blogs SET title=?, slug=?, content=?, image=? WHERE id=?");
        $stmt->bind_param("ssssi", $title, $slug, $content, $image, $id);
        $stmt->execute();
        $stmt->close();
        header("Location: ../admin/blogs.php?updated=1");
        exit;
    } else {
        $stmt = $conn->prepare("INSERT INTO blogs (title, slug, content, image) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $title, $slug, $content, $image);
        if ($stmt->execute()) {
            header("Location: ../admin/blogs.php?added=1");
            exit;
        } else {
            $error = "Error occurred. Slug may already exist.";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $isEdit ? 'Edit Blog' : 'Add Blog' ?></title>
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
        <h1 class="mb-4 text-center"><?= $isEdit ? 'Edit Blog' : 'Add Blog' ?></h1>
        <?php if ($error): ?>
          <div class="alert alert-danger text-center"><?= $error ?></div>
        <?php endif; ?>
        <div class="d-flex justify-content-center align-items-center" style="min-height:60vh;">
          <form method="post" enctype="multipart/form-data" class="bg-black p-4 rounded shadow-sm w-100" style="max-width:500px;">
            <?php if ($isEdit): ?>
              <input type="hidden" name="id" value="<?= $blog['id'] ?>">
            <?php endif; ?>
            <div class="mb-3">
              <label class="form-label" for="title"><i class="bi bi-journal-text"></i> Title</label>
              <input type="text" class="form-control" id="title" name="title" required value="<?= htmlspecialchars($blog['title']) ?>">
            </div>
            <div class="mb-3">
              <label class="form-label" for="slug"><i class="bi bi-link-45deg"></i> Slug</label>
              <input type="text" class="form-control" id="slug" name="slug" required value="<?= htmlspecialchars($blog['slug']) ?>">
            </div>
            <div class="mb-3">
              <label class="form-label" for="content"><i class="bi bi-file-text"></i> Content</label>
              <textarea class="form-control" id="content" name="content" rows="5" required><?= htmlspecialchars($blog['content']) ?></textarea>
            </div>
            <div class="mb-3">
              <label class="form-label" for="image"><i class="bi bi-image"></i> Image</label>
              <input type="file" class="form-control" id="image" name="image" <?= $isEdit ? '' : 'required' ?>>
              <?php if ($isEdit && $blog['image']): ?>
                <div class="mt-2">
                  <img src="../public/assets/blogs/<?= htmlspecialchars($blog['image']) ?>" alt="Blog Image" style="width:80px;">
                </div>
              <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-gold w-100"><?= $isEdit ? 'Update Blog' : 'Add Blog' ?></button>
          </form>
        </div>
      </main>
    </div>
  </div>
</body>
</html>