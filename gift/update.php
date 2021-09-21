<?php include '../app/config.php'; ?>;
<?php include '../app/templates/header.php'; ?>  

<title>Rediger produkt</title>

<?php include '../app/templates/crud.php'; ?>

  </head>

  <body class="text-center">
    <form class="form-signin" action="" method="post">
      <h1 class="h3 mb-3 font-weight-normal">Rediger gave</h1>
      <label for="title" class="sr-only">Navn *</label>
      <input type="text" name="title" id="title" class="form-control" placeholder="Titel *" required="" autofocus="">
      <label for="subtitle" class="sr-only">Undertitel</label>
      <input type="text" name="subtitle" id="subtitle" class="form-control" placeholder="Undertitel">
      <label for="code" class="sr-only">Kode</label>
      <input type="password" name="code" id="code" class="form-control" placeholder="Kodebeskyttet">
 
      <button class="btn btn-lg btn-primary btn-block" type="submit">Gem gave</button>
      <br>
      <a class="mt-5 mb-3" href="<?php echo $app['url']; ?>/gift/read?list=3">Gå tilbage</a>
      <p class="mt-5 mb-3 text-muted"><?php echo $app['name']; ?></p>
    </form> 