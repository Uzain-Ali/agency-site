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
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top bg-black">
    <div class="container">
      <a class="navbar-brand text-white" href="#" data-link="index.php">Agency</a>
      <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navMenu">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item">
            <a class="nav-link text-white" href="#" data-link="/"><i class="bi bi-house-door me-1"></i>Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="#" data-link="blogs.php"><i class="bi bi-journal-text me-1"></i>Blogs</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="#" data-link="services.php"><i class="bi bi-gear me-1"></i>Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="#" data-link="about.php"><i class="bi bi-people me-1"></i>About Us</a>
          </li>
        </ul>
        <a class="btn btn-gold ms-lg-3 mt-3 mt-lg-0" href="#" data-link="contact.php"><i class="bi bi-envelope me-1"></i>Contact Us</a>
      </div>
    </div>
  </nav>
  <div style="margin-top:80px;"></div>


    <!-- Content container -->
    <div id="content" class="container py-4">
      <?php include_once("sections.php"); ?>
    </div>
  
    <!-- Footer -->
             <hr class="border-secondary my-4">

    <footer class="footer-main text-white pt-5 pb-3 mt-5 bg-black">
      <div class="container">
        <div class="row">
          <!-- Logo & Tagline -->
          <div class="col-md-4 mb-4 mb-md-0 text-center text-md-start">
            <div class="d-flex align-items-center mb-2">
              <img src="assets/logo.png" alt="Agency Logo" style="height:40px;width:auto;" class="me-2">
              <span class="fs-4 fw-bold">Agency</span>
            </div>
            <p class="small mb-0">Building the digital future with passion and expertise.</p>
          </div>
          <!-- Quick Links -->
          <div class="col-md-4 mb-4 mb-md-0 text-center">
            <h6 class="fw-bold mb-3">Quick Links</h6>
            <ul class="list-unstyled">
              <li><a href="#" class="footer-link" data-link="/">Home</a></li>
              <li><a href="#" class="footer-link" data-link="services.php">Services</a></li>
              <li><a href="#" class="footer-link" data-link="blogs.php">Blogs</a></li>
              <li><a href="#" class="footer-link" data-link="about.php">About Us</a></li>
              <li><a href="#" class="footer-link" data-link="contact.php">Contact Us</a></li>
            </ul>
          </div>
          <!-- Contact Info -->
          <div class="col-md-4 text-center text-md-end">
            <h6 class="fw-bold mb-3">Contact Info</h6>
            <ul class="list-unstyled small mb-2">
              <li><i class="bi bi-envelope me-2"></i>info@agency.com</li>
              <li><i class="bi bi-telephone me-2"></i>+1 234 567 890</li>
              <li><i class="bi bi-geo-alt me-2"></i>123 Digital Ave, Tech City</li>
            </ul>
            <div>
              <a href="#" class="text-white me-2"><i class="bi bi-facebook"></i></a>
              <a href="#" class="text-white me-2"><i class="bi bi-twitter"></i></a>
              <a href="#" class="text-white"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
        </div>
        <hr class="border-secondary my-4">
        <div class="text-center small">
          &copy; <?php echo date("Y"); ?> Digital Agency. All rights reserved.
        </div>
      </div>
    </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/app.js"></script>
</body>
</html>
