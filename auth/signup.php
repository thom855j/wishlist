<?php include '../app/functions.php'; ?>
<?php include '../app/templates/header.php' ?>

<?php
if(!empty($_POST)) {

  $email =  $app['db']->CleanDBData($_POST['email']);
  $username = explode('@', $email)[0];
  $password =  $app['db']->CleanDBData(md5($_POST['password']));

  $user = $app['db']->Select("SELECT * FROM whish_users WHERE user_email = '$email' ");

  if(!$user) {
      
    $user_id = $app['db']->Insert('whish_users', [
        'user_name' => $username,
        'user_email' => $email,
        'user_pass' => md5($password)
      ]);

      $_SESSION['user'] = $user_id;

     header('Location: ' . $app['url'] . '/list/read');
  } else {
?>
<div class="alert alert-danger" role="alert">
  Bruger eksisterer ikke eller forkerte oplysninger!
</div>
 <?php   
  }

} 
?>

<title>Opret profil</title>
<?php include '../app/templates/crud.php'; ?>
  </head>

  <body class="text-center">
    <form class="form-signin" method="post">
    <h1 class="h3 mb-3 font-weight-normal">Ønskelister</h1>
      <p class=" mb-3">Opret profil</p>
      <label for="inputEmail" class="sr-only">Email</label>
      <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email" required="" autofocus="">
      <label for="inputPassword" class="sr-only">Kode</label>
      <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Kode" required="">
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Jeg accepptere hjemmesidens vilkår og betingelser.
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Opret</button>
      <a class="mt-5 mb-3" href="<?php url('/auth/login'); ?>">Log på</a>
      <br>
      <a class="mt-5 mb-3" href="<?php url(); ?>">Gå tilbage</a>
      <p class="mt-5 mb-3 text-muted"><?php app('name'); ?></p>
    </form>
    