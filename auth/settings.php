<?php 

include '../app/includes/functions.php'; 

$user_id = user();
$user = $app['db']->Select("SELECT * FROM wish_users WHERE user_id = '$user_id' ")[0];

if(!empty($_POST)) {

  $email =  $app['db']->CleanDBData($_POST['email']);
  $username = explode('@', $email)[0];
  $password =  $app['db']->CleanDBData(md5($_POST['password']));

  $user = $app['db']->Select("SELECT * FROM wish_users WHERE user_email = '$email' ");

  if(!$user) {
      
    $user_id = $app['db']->Insert('wish_users', [
        'user_name' => $username,
        'user_email' => $email,
        'user_pass' => md5($password)
      ]);

      $_SESSION['user'] = $user_id;

     header('Location: ' . $app['url'] . '/list/read');
  }
}
?>

<?php include '../app/templates/header.php' ?>
<title>Profil indstillinger</title>
<?php include '../app/templates/crud.php'; ?>
  </head>

  <body class="text-center">
    <form class="form-signin" method="post">
    <h1 class="h3 mb-3 font-weight-normal">Profil indstillinger</h1>
      <p class=" mb-3">Rediger profil</p>
      <label for="inputEmail" class="sr-only">Email</label>
      <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email" required="" autofocus="" value="<?php echo $user['user_email'] ?>">
      <label for="inputPassword" class="sr-only">Kode</label>
      <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Kode" required="" val>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Opret</button>
      <a class="mt-5 mb-3" href="<?php url('/auth/login'); ?>">Log på</a>
      <br>
      <a class="mt-5 mb-3" href="<?php url(); ?>">Gå tilbage</a>
      <p class="mt-5 mb-3 text-muted"><?php app('name'); ?></p>
    </form>
    