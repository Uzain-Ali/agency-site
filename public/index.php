<?php include("../config/config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Agency - Digital Future</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link href="assets/style.css" rel="stylesheet">
    <style>
    body {
      min-height: 100vh;
      color: #fff;
      overflow-x: hidden;
    }
    .bg-video {
      position: fixed;
      top: 0; left: 0;
      width: 100vw;
      height: 100vh;
      object-fit: cover;
      z-index: -1;
      opacity: 0.5;
      pointer-events: none;
    }

  </style>
</head>
<body>
  <!-- Video Background -->
  <video class="bg-video" autoplay muted loop playsinline>
    <source src="assets/bg-video.mp4" type="video/mp4">
    Your browser does not support the video tag.
  </video>
  <?php include("navbar.php"); ?>
<div style="height:100px;"></div>
  <div class="content-overlay">
    <div id="content" class="container py-4">
      <?php include_once("sections.php"); ?>
    </div>
    <hr class="border-secondary my-4">
    <?php include("footer.php"); ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/app.js"></script>
</body>
</html>