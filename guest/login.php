<?php 

include '../app/includes/functions.php'; 

if(!empty($_POST)) {

    $list_id = $app['db']->CleanDBData($_GET['list']);
    $code =  $app['db']->CleanDBData($_POST['code']);
    $list = $app['db']->Select("SELECT * FROM wish_lists WHERE list_code = '$code' ");


  if(!empty($list)) {
    list_login($list_id);
    redirect('/' . $list_id);
  } 
}
?>
<?php include '../app/templates/header.php' ?>
<title>Kodebeskyttet ønskeliste</title>
<?php include '../app/templates/crud.php'; ?>
  </head>

  <body class="text-center">
    <form class="form-signin" method="post">
    <h1 class="h3 mb-3 font-weight-normal">Kodebeskyttet ønskeliste</h1>
      <p class=" mb-3">Bekræft venligst ønskelistens kode for at tilgå den.</p>
      <label for="code" class="sr-only">Kode</label>
      <input type="password" name="code" id="code" class="form-control" placeholder="Kode" required="">
      <button class="btn btn-lg btn-primary btn-block" type="submit">Bekræft kode</button>
      <br>
      <a class="mt-5 mb-3" href="<?php url(); ?>">Gå tilbage</a>
      <p class="mt-5 mb-3 text-muted"><?php app('name'); ?></p>
    </form>
    