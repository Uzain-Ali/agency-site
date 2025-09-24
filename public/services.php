<?php
// filepath: c:\xampp\htdocs\agency-site\public\services.php
include("../config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Our Services - Agency</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link href="assets/style.css" rel="stylesheet">
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
  <section class="container py-5 fade-in-section section-fade text-center">
    <h1 class="display-4 mb-3" style="color:#D4AF37;">Our Professional Services</h1>
    <p class="lead mb-4">Empowering your business with world-class digital solutions.</p>
    <a href="#plans" class="btn btn-gold btn-lg">See Plans</a>
  </section>

  <!-- Services Overview -->
  <section class="container fade-in-section section-fade">
    <div class="row g-4 text-center">
      <div class="col-md-3">
        <div class="service-card p-4 h-100">
          <i class="bi bi-code-slash service-icon mb-3"></i>
          <h5>Web Development</h5>
          <p class="card-text">Custom websites, portals, and web apps for your business.</p>
          <a href="service-detail.php?service=web" class="btn btn-outline-gold mt-2">Learn More</a>
        </div>
      </div>
      <div class="col-md-3">
        <div class="service-card p-4 h-100">
          <i class="bi bi-brush service-icon mb-3"></i>
          <h5>Graphics Design</h5>
          <p class="card-text">Branding, UI/UX, and creative visuals that stand out.</p>
          <a href="service-detail.php?service=graphics" class="btn btn-outline-gold mt-2">Learn More</a>
        </div>
      </div>
      <div class="col-md-3">
        <div class="service-card p-4 h-100">
          <i class="bi bi-graph-up-arrow service-icon mb-3"></i>
          <h5>SEO Optimization</h5>
          <p class="card-text">Boost your online visibility and organic reach.</p>
          <a href="service-detail.php?service=seo" class="btn btn-outline-gold mt-2">Learn More</a>
        </div>
      </div>
      <div class="col-md-3">
        <div class="service-card p-4 h-100">
          <i class="bi bi-shield-check service-icon mb-3"></i>
          <h5>Quality Assurance</h5>
          <p class="card-text">Testing and QA for flawless digital experiences.</p>
          <a href="service-detail.php?service=qa" class="btn btn-outline-gold mt-2">Learn More</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Why Choose Us -->
  <section class="container fade-in-section section-fade">
    <div class="row align-items-center">
      <div class="col-md-6">
        <img src="<?= ASSETS_URL ?>/team.jpg" alt="Our Team" class="img-fluid rounded shadow">
      </div>
      <div class="col-md-6">
        <h2 class="mb-3" style="color:#D4AF37;">Why Choose Our Agency?</h2>
        <ul class="list-unstyled fs-5">
          <li><i class="bi bi-check-circle-fill text-success me-2"></i> Experienced & Certified Professionals</li>
          <li><i class="bi bi-check-circle-fill text-success me-2"></i> Transparent Pricing & Fast Delivery</li>
          <li><i class="bi bi-check-circle-fill text-success me-2"></i> 24/7 Support & Maintenance</li>
          <li><i class="bi bi-check-circle-fill text-success me-2"></i> 100% Satisfaction Guarantee</li>
        </ul>
      </div>
    </div>
  </section>

  <!-- Call to Action -->
  <section class="container fade-in-section section-fade text-center py-5">
    <h2 class="mb-3" style="color:#D4AF37;">Ready to start your project?</h2>
    <p class="lead mb-4">Contact us today for a free consultation and quote.</p>
    <a href="contact.php" class="btn btn-gold btn-lg">Contact Us</a>
  </section>
  </div>

  <?php include("footer.php"); ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= ASSETS_URL ?>/app.js"></script>
</body>
</html>