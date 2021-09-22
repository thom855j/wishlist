<?php include '../app/functions.php'; ?>;
<?php include '../app/templates/header.php'; ?>  

<?php 

$list_id = $app['db']->CleanDBData($_GET['id']);

if(!empty($_POST)) {
  $phptime = $app['db']->CleanDBData($_POST['date']);
  $mysqltime = date('Y-m-d H:i:s', strtotime($phptime));

  $app['db']->Update('whish_lists', [
    'list_title' => $app['db']->CleanDBData($_POST['title']),
    'list_subtitle' => $app['db']->CleanDBData($_POST['subtitle']),
    'list_date' => $mysqltime,
    'list_code' => $app['db']->CleanDBData($_POST['code'])
  ], ['list_id' => $list_id]);

  header('Location: ' . $app['url'] . '/list/read');
} 

$list = $app['db']->Select('select * from whish_lists where list_id = ' . $list_id)[0]; 

?>


<title>Rediger ønskeliste</title>

<?php include '../app/templates/crud.php'; ?>
  </head>

  <body class="text-center">
    <form class="form-signin" action="" method="post">
      <h1 class="h3 mb-3 font-weight-normal">Ny ønskeliste</h1>
      <label for="title" class="sr-only">Titel *</label>
      <input type="text" name="title" id="title" class="form-control" placeholder="Titel *" required="" autofocus="" value="<?php echo $list['list_title']; ?>">
      <label for="subtitle" class="sr-only">Undertitel</label>
      <input type="text" name="subtitle" id="subtitle" class="form-control" placeholder="Undertitel" value="<?php echo $list['list_subtitle']; ?>">
      <label for="code" class="sr-only">Dato</label>
      <input type="text" name="date" id="date" class="form-control" placeholder="Dato for begivenhed" autocomplete="off" value="<?php echo $list['list_date']; ?>">
      <label for="code" class="sr-only">Kode</label>
      <input type="text" name="code" id="code" class="form-control" placeholder="Kodebeskyttet" value="<?php echo $list['list_code']; ?>">
 
      <button class="btn btn-lg btn-primary btn-block" type="submit">Gem ønskeliste</button>
      <br>
      <a class="mt-5 mb-3" href="<?php echo $app['url']; ?>/list/read">Gå tilbage</a>
      <p class="mt-5 mb-3 text-muted"><?php echo $app['name']; ?></p>
    </form> 
<?php include '../app/templates/scripts.php'; ?>
    <script>
  $( function() {
    $( "#date" ).datepicker({
      dateFormat: 'dd-mm-yy',
      onSelect: function(datetext) {
            var d = new Date(); // for now

            var h = d.getHours();
            h = (h < 10) ? ("0" + h) : h ;

            var m = d.getMinutes();
            m = (m < 10) ? ("0" + m) : m ;

            var s = d.getSeconds();
            s = (s < 10) ? ("0" + s) : s ;

            datetext = datetext + " " + h + ":" + m + ":" + s;

            $('#date').val(datetext);
        }
    });
  } );
  </script>