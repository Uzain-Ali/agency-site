<?php
include("../config.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Us - Agency</title>
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
    <section class="container contact-section fade-in-section py-5">
      <div class="row">
        <div class="col-md-6">
          <h2 class="contact-title mb-4">Contact Us</h2>
          <form action="../actions/contact_submit.php" method="POST">
            <div class="mb-3">
              <input type="text" name="name" class="form-control" placeholder="Your Name" required>
            </div>
            <div class="mb-3">
              <input type="email" name="email" class="form-control" placeholder="Your Email" required>
            </div>
            <div class="mb-3">
              <textarea name="message" class="form-control" placeholder="Your Message" required></textarea>
            </div>
            <button type="submit" class="btn btn-gold">Send</button>
          </form>
        </div>
        <div class="col-md-6">
          <h2 class="contact-title mb-4">Our Office</h2>
          <p>123 Street, City</p>
          <p>Email: info@agency.com</p>
          <iframe src="https://maps.google.com/maps?q=New%20York&t=&z=13&ie=UTF8&iwloc=&output=embed"
                  width="100%" height="250" style="border:0;"></iframe>
        </div>
      </div>
    </section>
  </div>
  <?php include("footer.php"); ?>

<div class="modal fade" id="thankYouModal" tabindex="-1" aria-labelledby="thankYouLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-dark">
      <div class="modal-header">
        <h5 class="modal-title" id="thankYouLabel">Thank You!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Your message has been sent successfully. We’ll get back to you soon.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-gold" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= ASSETS_URL ?>/app.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has("success")) {
      const thankYouModal = new bootstrap.Modal(document.getElementById("thankYouModal"));
      thankYouModal.show();
    }
  });
</script>

</body>
</html>

