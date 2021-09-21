<?php include 'includes/header.php'; ?>   

<?php 

$list_id = $app['db']->CleanDBData($_GET['id']);

if(!empty($_POST)) {
  $app['db']->Update('whish_lists', [
    'list_title' => $app['db']->CleanDBData($_POST['title']),
    'list_subtitle' => $app['db']->CleanDBData($_POST['subtitle']),
    'list_code' => $app['db']->CleanDBData($_POST['code'])
  ], ['list_id' => $list_id]);

  header('Location: ' . $app['url'] . '/list.php');
} 

$list = $app['db']->Select('select * from whish_lists where list_id = ' . $list_id)[0]; 

?>

<title>Rediger ønskeliste</title>

<?php include 'templates/crud.php'; ?>

  </head>

  <body class="text-center">
    <form class="form-signin" action="" method="post">
      <h1 class="h3 mb-3 font-weight-normal">Rediger ønskeliste</h1>
      <label for="title" class="sr-only">Titel *</label>
      <input type="text" name="title" id="title" class="form-control" placeholder="Titel *" required="" autofocus="" value="<?php echo $list['list_title'] ?>">
      <label for="subtitle" class="sr-only">Undertitel</label>
      <input type="text" name="subtitle" id="subtitle" class="form-control" placeholder="Undertitel" value="<?php echo $list['list_subtitle'] ?>">
      <label for="code" class="sr-only">Kode</label>
      <input type="text" name="code" id="code" class="form-control" placeholder="Kodebeskyttet" value="<?php echo $list['list_code'] ?>">
 
      <button class="btn btn-lg btn-primary btn-block" type="submit">Gem ønskeliste</button>
      <br>
      <a class="mt-5 mb-3" href="<?php echo $app['url']; ?>/list.php">Gå tilbage</a>
      <p class="mt-5 mb-3 text-muted"><?php echo $app['name']; ?></p>
    </form> 