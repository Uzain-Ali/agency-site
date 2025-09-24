<?php
// filepath: c:\xampp\htdocs\agency-site\public\service-detail.php
include("../config.php");

// Service data (could be dynamic from DB)
$services = [
  'web' => [
    'title' => 'Web Development',
    'desc' => 'We build robust, scalable, and modern web solutions tailored to your business needs.',
    'projects' => [
      ['img' => ASSETS_URL.'/1.jpg', 'title' => 'E-Commerce Platform', 'desc' => 'A scalable online store for a global brand.'],
      ['img' => ASSETS_URL.'/2.jpeg', 'title' => 'Portfolio Website', 'desc' => 'A modern portfolio for a creative professional.'],
      ['img' => ASSETS_URL.'/3.jpeg', 'title' => 'Startup Landing Page', 'desc' => 'A high-converting landing page for a tech startup.'],
    ]
  ],
  'graphics' => [
    'title' => 'Graphics Design',
    'desc' => 'Creative branding, UI/UX, and visual design for your business.',
    'projects' => [
      ['img' => ASSETS_URL.'/4.jpeg', 'title' => 'Brand Identity', 'desc' => 'Complete branding for a new business.'],
      ['img' => ASSETS_URL.'/5.jpeg', 'title' => 'Event Poster', 'desc' => 'Creative poster design for a tech event.'],
      ['img' => ASSETS_URL.'/6.jpeg', 'title' => 'Social Media Kit', 'desc' => 'Engaging graphics for social campaigns.'],
    ]
  ],
  'seo' => [
    'title' => 'SEO Optimization',
    'desc' => 'Boost your online visibility and organic reach with our SEO services.',
    'projects' => [
      ['img' => ASSETS_URL.'/3.jpeg', 'title' => 'Traffic Growth', 'desc' => 'Doubled organic traffic for a SaaS company.'],
      ['img' => ASSETS_URL.'/5.jpeg', 'title' => 'Local SEO', 'desc' => 'Improved local search ranking for a retailer.'],
      ['img' => ASSETS_URL.'/2.jpeg', 'title' => 'Content Strategy', 'desc' => 'SEO-driven content plan for a blog network.'],
    ]
  ],
  'qa' => [
    'title' => 'Quality Assurance',
    'desc' => 'Testing and QA for flawless digital experiences.',
    'projects' => [
      ['img' => ASSETS_URL.'/6.jpeg', 'title' => 'App Testing', 'desc' => 'Comprehensive QA for a mobile app launch.'],
      ['img' => ASSETS_URL.'/1.jpg', 'title' => 'Automation Suite', 'desc' => 'Automated tests for a SaaS platform.'],
      ['img' => ASSETS_URL.'/4.jpeg', 'title' => 'Performance Audit', 'desc' => 'Load testing for a high-traffic website.'],
    ]
  ]
];

$key = isset($_GET['service']) && isset($services[$_GET['service']]) ? $_GET['service'] : 'web';
$service = $services[$key];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($service['title']) ?> - Service Detail</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link href="assets/style.css" rel="stylesheet">
  <style>
    body { min-height: 100vh; color: #fff; overflow-x: hidden; }
    .bg-video { position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; object-fit: cover; z-index: -1; opacity: 0.5; pointer-events: none; }
    .section-fade { background: rgba(24,24,24,0.25); border-radius: 1rem; margin-bottom: 2.5rem; }
    .project-card { background:rgba(24,24,24,0.45); color:#D4AF37; border-radius:1rem; }
    .project-card .card-text { color: #fff; }
    .plan-toggle .btn { min-width: 120px; }
    .plan-card { background:rgba(24,24,24,0.45); color:#fff; border-radius:1rem; border:2px solid #D4AF37; }
    .plan-card.premium { border-color: #fff; background:rgba(212,175,55,0.18); color:#181818; }
    .plan-card .plan-title { color: #D4AF37; }
    .plan-card.premium .plan-title { color: #fff; }
  </style>
</head>
<body>
  <video class="bg-video" autoplay muted loop playsinline>
    <source src="<?= ASSETS_URL ?>/bg-video.mp4" type="video/mp4">
  </video>
  <?php include("navbar.php"); ?>
  <div style="height:120px;"></div>
  <div id="content">

  <!-- Service Hero -->
  <section class="container py-5 fade-in-section section-fade text-center">
    <h1 class="display-4 mb-3" style="color:#D4AF37;"><?= htmlspecialchars($service['title']) ?></h1>
    <p class="lead mb-4"><?= htmlspecialchars($service['desc']) ?></p>
    <a href="services.php" class="btn btn-outline-gold"><i class="bi bi-arrow-left"></i> All Services</a>
  </section>

  <!-- Featured Projects -->
  <section class="container fade-in-section section-fade">
    <h2 class="mb-4 text-center" style="color:#D4AF37;">Featured Projects</h2>
    <div class="row g-4">
      <?php foreach($service['projects'] as $proj): ?>
      <div class="col-md-4">
        <div class="project-card card h-100">
          <img src="<?= $proj['img'] ?>" class="card-img-top" alt="<?= htmlspecialchars($proj['title']) ?>">
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($proj['title']) ?></h5>
            <p class="card-text"><?= htmlspecialchars($proj['desc']) ?></p>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- Plans Section -->
  <section class="container fade-in-section section-fade" id="plans">
    <h2 class="mb-4 text-center" style="color:#D4AF37;">Choose Your Plan</h2>
    <div class="d-flex justify-content-center mb-4 plan-toggle">
      <button class="btn btn-gold me-2" id="basicBtn" onclick="showPlan('basic')">Basic</button>
      <button class="btn btn-outline-light" id="premiumBtn" onclick="showPlan('premium')">Premium</button>
    </div>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="plan-card p-4 h-100" id="plan1">
          <h5 class="plan-title mb-3">Starter <?= $key === 'web' ? 'Website' : ($key === 'graphics' ? 'Logo Design' : ($key === 'seo' ? 'SEO Audit' : 'QA Review')) ?></h5>
          <ul class="list-unstyled mb-4">
            <li>✔ 1 Project</li>
            <li>✔ Email Support</li>
            <li>✔ Delivery in 7 days</li>
          </ul>
          <div class="fs-3 mb-2">$199</div>
          <a href="contact.php" class="btn btn-gold">Get Started</a>
        </div>
      </div>
      <div class="col-md-4">
        <div class="plan-card p-4 h-100" id="plan2">
          <h5 class="plan-title mb-3">Business <?= $key === 'web' ? 'Site' : ($key === 'graphics' ? 'Brand Kit' : ($key === 'seo' ? 'Growth' : 'Automation')) ?></h5>
          <ul class="list-unstyled mb-4">
            <li>✔ Up to 3 Projects</li>
            <li>✔ Priority Support</li>
            <li>✔ Delivery in 5 days</li>
          </ul>
          <div class="fs-3 mb-2">$399</div>
          <a href="contact.php" class="btn btn-gold">Get Started</a>
        </div>
      </div>
      <div class="col-md-4">
        <div class="plan-card p-4 h-100" id="plan3">
          <h5 class="plan-title mb-3">Enterprise <?= $key === 'web' ? 'Solution' : ($key === 'graphics' ? 'Identity' : ($key === 'seo' ? 'Domination' : 'Suite')) ?></h5>
          <ul class="list-unstyled mb-4">
            <li>✔ Unlimited Projects</li>
            <li>✔ Dedicated Manager</li>
            <li>✔ Delivery in 3 days</li>
          </ul>
          <div class="fs-3 mb-2">$799</div>
          <a href="contact.php" class="btn btn-gold">Get Started</a>
        </div>
      </div>
    </div>
  </section>
  </div>

  <?php include("footer.php"); ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= ASSETS_URL ?>/app.js"></script>
  <script>
    // Toggle plans
    function showPlan(type) {
      const cards = document.querySelectorAll('.plan-card');
      const basicBtn = document.getElementById('basicBtn');
      const premiumBtn = document.getElementById('premiumBtn');
      if(type === 'premium') {
        cards.forEach(card => card.classList.add('premium'));
        premiumBtn.classList.remove('btn-outline-light');
        premiumBtn.classList.add('btn-gold');
        basicBtn.classList.remove('btn-gold');
        basicBtn.classList.add('btn-outline-light');
      } else {
        cards.forEach(card => card.classList.remove('premium'));
        basicBtn.classList.remove('btn-outline-light');
        basicBtn.classList.add('btn-gold');
        premiumBtn.classList.remove('btn-gold');
        premiumBtn.classList.add('btn-outline-light');
      }
    }
  </script>
</body>
</html>