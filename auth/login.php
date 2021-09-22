<?php include '../app/functions.php'; ?>
<?php include '../app/templates/header.php' ?>

<?php
if(!empty($_POST)) {

  $login =  $app['db']->CleanDBData($_POST['login']);
  $password =  $app['db']->CleanDBData(md5($_POST['password']));
  $user = $app['db']->Select("SELECT * FROM whish_users WHERE user_email = '$login' OR user_name = '$login' AND user_pass = '$password' ")[0];


  if($user) {
    login($user['user_id']);
    redirect('/list/read');
  } else {
?>
<div class="alert alert-danger" role="alert">
  Bruger eksisterer ikke eller forkerte oplysninger!
</div>
 <?php   
  }

} 
?>

<title>Log på</title>
<?php include '../app/templates/crud.php'; ?>
  </head>

  <body class="text-center">
    <form class="form-signin" method="post">
    <h1 class="h3 mb-3 font-weight-normal">Ønskelister</h1>
      <p class=" mb-3">Log på</p>
      <label for="login" class="sr-only">Email/brugernavn</label>
      <input type="text" name="login" id="login" class="form-control" placeholder="Email eller brugernavn" required="" autofocus="">
      <label for="inputPassword" class="sr-only">Kode</label>
      <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Kode" required="">
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Husk mig
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Log på</button>
      <a class="mt-5 mb-3" href="<?php url('/auth/signup'); ?>">Opret profil</a>
      <br>
      <a class="mt-5 mb-3" href="<?php url(); ?>">Gå tilbage</a>
      <p class="mt-5 mb-3 text-muted"><?php app('name'); ?></p>
    </form>
    