<?php include 'includes/header.php'; ?>  

<?php 
if(!empty($_POST)) {
  $app['db']->Insert('whish_lists', [
    'list_title' => $app['db']->CleanDBData($_POST['title']),
    'list_subtitle' => $app['db']->CleanDBData($_POST['subtitle']),
    'list_code' => $app['db']->CleanDBData($_POST['code'])
  ]);
} 
?>

<title>Opret ønskeliste</title>

<?php include 'templates/crud.php'; ?>
  </head>

  <body class="text-center">
    <form class="form-signin" action="" method="post">
      <h1 class="h3 mb-3 font-weight-normal">Ny ønskeliste</h1>
      <label for="title" class="sr-only">Titel *</label>
      <input type="text" name="title" id="title" class="form-control" placeholder="Titel *" required="" autofocus="">
      <label for="subtitle" class="sr-only">Undertitel</label>
      <input type="text" name="subtitle" id="subtitle" class="form-control" placeholder="Undertitel">
      <label for="code" class="sr-only">Kode</label>
      <input type="text" name="code" id="code" class="form-control" placeholder="Kodebeskyttet">
 
      <button class="btn btn-lg btn-primary btn-block" type="submit">Opret ønskeliste</button>
      <br>
      <a class="mt-5 mb-3" href="<?php echo $app['url']; ?>">Gå tilbage</a>
      <p class="mt-5 mb-3 text-muted"><?php echo $app['name']; ?></p>
    </form> 