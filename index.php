<?php include 'includes/header.php'; ?>   

<title><?php echo $app['title']; ?></title>

<?php include 'templates/app.php'; ?>
  </head>
  <body>

<div class="container py-3">
  <header>
    <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
      <a href="<?php echo $app['url']; ?>" class="d-flex align-items-center text-dark text-decoration-none">
    <span class="fs-4"><?php echo $app['name']; ?></span>
      </a>
      <?php include 'includes/nav.php'; ?>
    </div>

    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
      <h1 class="display-4 fw-normal">Ønskelister</h1>
      <p class="fs-5 text-muted">til alle begivenheder</p>
      <p>Tilføj ønsker. På den måde, du plejer. Tilpasser sig dine behov.</p>
      <a href="<?php echo $app['url'] ?>/list-new.php"><button type="button" class="w-25 btn btn-lg btn-primary">Opret ønskeliste</button></a>
    </div>
  </header>

<?php include  'includes/footer.php'; ?>    