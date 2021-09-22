<?php include 'app/functions.php'; ?>
<?php include 'app/templates/header.php'; ?>   

<title><?php echo $app['title']; ?></title>

<?php include 'app/templates/app.php'; ?>
  </head>
  <body>


  <?php include 'app/templates/nav.php'; ?>


  <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
      <h1 class="display-4 fw-normal">Ønskelister</h1>
      <p class="fs-5 text-muted">til alle begivenheder</p>
      <p>Tilføj ønsker. På den måde, du plejer. Tilpasser sig dine behov.</p>
      <a href="<?php echo $app['url'] ?>/auth/signup"><button type="button" class="w-25 btn btn-lg btn-primary">Opret profil</button></a>
    </div>

<?php include 'app/templates/footer.php'; ?>    