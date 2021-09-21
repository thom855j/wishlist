<?php include 'includes/header.php' ?>

<title>Log på</title>
<?php include 'templates/crud.php'; ?>
  </head>

  <body class="text-center">
    <form class="form-signin">
    <h1 class="h3 mb-3 font-weight-normal">Min Ønskeliste</h1>
      <p class=" mb-3">Log venligst ind</p>
      <label for="inputEmail" class="sr-only">Email</label>
      <input type="email" id="inputEmail" class="form-control" placeholder="Email" required="" autofocus="">
      <label for="inputPassword" class="sr-only">Kode</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="Kode" required="">
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Husk mig
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Log på</button>
      <br>
      <a class="mt-5 mb-3" href="<?php echo $app['url']; ?>">Gå tilbage</a>
      <p class="mt-5 mb-3 text-muted"><?php echo $app['name']; ?></p>
    </form>
    