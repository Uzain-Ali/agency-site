<?php include("../includes/header.php"); ?>
<?php include("../includes/navbar.php"); ?>

<div class="container py-5">
  <div class="row">
    <div class="col-md-6">
      <h2>Contact Us</h2>
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
      <h2>Our Office</h2>
      <p>123 Street, City</p>
      <p>Email: info@agency.com</p>
      <iframe src="https://maps.google.com/maps?q=New%20York&t=&z=13&ie=UTF8&iwloc=&output=embed" 
              width="100%" height="250" style="border:0;"></iframe>
    </div>
  </div>
</div>

<?php include("../includes/footer.php"); ?>
