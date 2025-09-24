<?php
// filepath: c:\xampp\htdocs\agency-site\public\about.php
include("../config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>About Us - Agency</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link href="<?= ASSETS_URL ?>/style.css" rel="stylesheet">
  <style>
    body { min-height: 100vh; color: #fff; overflow-x: hidden; }
    .bg-video { position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; object-fit: cover; z-index: -1; opacity: 0.5; pointer-events: none; }
  </style>
</head>
<body>
  <video class="bg-video" autoplay muted loop playsinline>
    <source src="<?= ASSETS_URL ?>/bg-video.mp4" type="video/mp4">
  </video>
  <?php include("navbar.php"); ?>
  <div style="height:120px;"></div>
  <div id="content">

  <!-- Hero Section -->
  <section class="container py-5 text-center about-section fade-in-section">
    <h1 class="display-4 about-title mb-3">About Our Agency</h1>
    <p class="lead mb-4">We are passionate creators, developers, and strategists building the digital future for our clients.</p>
  </section>

  <!-- Curve Image Top, Text Below -->
  <section class="container about-section fade-in-section">
    <img src="<?= ASSETS_URL ?>/about1.jpg" class="curve-img-top mb-4" alt="Our Team">
    <div class="px-3 pb-4 text-center">
      <h2 class="about-title mb-3">Our Story</h2>
      <p class="fs-5">Founded in 2018, Agency has grown from a small team of enthusiasts into a full-service digital agency. We believe in innovation, transparency, and delivering measurable results for every client.</p>
    </div>
  </section>

  <!-- Text Above, Curve Image Bottom -->
  <section class="container about-section fade-in-section">
    <div class="px-3 pt-4 text-center">
      <h2 class="about-title mb-3">Our Mission</h2>
      <p class="fs-5">To empower businesses of all sizes with cutting-edge web, design, SEO, and QA solutions that drive growth and success in the digital world.</p>
    </div>
    <img src="<?= ASSETS_URL ?>/about2.jpg" class="curve-img-bottom mt-4" alt="Our Mission">
  </section>

  <!-- Usual About Content -->
  <section class="container about-section fade-in-section">
    <div class="row align-items-center">
      <div class="col-md-6">
        <h3 class="about-title mb-3">Why Choose Us?</h3>
        <ul class="fs-5">
          <li><i class="bi bi-check-circle-fill text-success me-2"></i> Experienced & Creative Team</li>
          <li><i class="bi bi-check-circle-fill text-success me-2"></i> Transparent Process</li>
          <li><i class="bi bi-check-circle-fill text-success me-2"></i> 24/7 Support</li>
          <li><i class="bi bi-check-circle-fill text-success me-2"></i> 100% Satisfaction Guarantee</li>
        </ul>
      </div>
      <div class="col-md-6 text-center">
        <img src="<?= ASSETS_URL ?>/about3.jpg" class="img-fluid rounded shadow" alt="Why Choose Us" style="max-height:300px;">
      </div>
    </div>
  </section>

  <section class="container about-section fade-in-section text-center">
    <h3 class="about-title mb-3">Meet Our Team</h3>
    <div class="row justify-content-center">
      <div class="col-6 col-md-3 mb-4">
        <img src="<?= ASSETS_URL ?>/team1.jpg" class="rounded-circle mb-2" alt="Team 1" style="width:100px;height:100px;object-fit:cover;">
        <div class="fw-bold">Alex Smith</div>
        <div class="text-secondary small">CEO & Founder</div>
      </div>
      <div class="col-6 col-md-3 mb-4">
        <img src="<?= ASSETS_URL ?>/team2.jpg" class="rounded-circle mb-2" alt="Team 2" style="width:100px;height:100px;object-fit:cover;">
        <div class="fw-bold">Priya Patel</div>
        <div class="text-secondary small">Lead Designer</div>
      </div>
      <div class="col-6 col-md-3 mb-4">
        <img src="<?= ASSETS_URL ?>/team3.jpg" class="rounded-circle mb-2" alt="Team 3" style="width:100px;height:100px;object-fit:cover;">
        <div class="fw-bold">James Lee</div>
        <div class="text-secondary small">Lead Developer</div>
      </div>
      <div class="col-6 col-md-3 mb-4">
        <img src="<?= ASSETS_URL ?>/team4.jpg" class="rounded-circle mb-2" alt="Team 4" style="width:100px;height:100px;object-fit:cover;">
        <div class="fw-bold">Sara Kim</div>
        <div class="text-secondary small">SEO Specialist</div>
      </div>
    </div>
  </section>
  </div>

  <?php include("footer.php"); ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= ASSETS_URL ?>/app.js"></script>
</body>
</html>