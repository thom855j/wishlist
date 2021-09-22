<?php include '../app/includes/functions.php'; ?>;
<?php include '../app/templates/header.php'; ?>   

<?php 

$list_id = $_GET['list'];

if(!empty($_POST)) {

  $app['db']->Insert('wish_gifts', [
    'gift_name' => $app['db']->CleanDBData($_POST['name']),
    'gift_image' => $app['db']->CleanDBData($_POST['img']),
    'gift_qty' => $app['db']->CleanDBData($_POST['qty']),
    'gift_price' => $app['db']->CleanDBData($_POST['price']),
    'gift_link' => $app['db']->CleanDBData($_POST['link']),
    'gift_note' => $app['db']->CleanDBData($_POST['note']),
    'gift_list' => $list_id,
  ]);

  redirect('/gift/read?list=' . $list_id);
} 
?>

<title>Tilføj gave</title>

<?php include '../app/templates/crud.php'; ?>

  </head>

  <body class="text-center">
    <form class="form-signin" action="" method="post" enctype="multipart/form-data">
      <h1 class="h3 mb-3 font-weight-normal">Nyt ønske</h1>
      <label for="name" class="sr-only">Navn *</label>
      <input type="text" name="name" id="name" class="form-control" placeholder="Navn på øsnke" required="" autofocus="">
      <label for="img" class="sr-only">Billedlink</label>
      <input type="text" name="img" id="img" class="form-control" placeholder="Billedelink">
      <label for="price" class="sr-only">Pris</label>
      <input type="number" step=".01" name="price" id="price" class="form-control" placeholder="Pris">
      <label for="price" class="sr-only">Link</label>
      <input type="url" name="link" id="link" class="form-control" placeholder="Link">
      <label for="note" class="sr-only">Note</label>
      <input type="text" name="note" id="note" class="form-control" placeholder="Note">
      <label for="qty" class="sr-only">Ønsket antal</label>
      <input type="number" name="qty" id="qty" class="form-control" placeholder="Antal">
      <button class="btn btn-lg btn-primary btn-block" type="submit">Gem ønske</button>
      <br>
      <a class="mt-5 mb-3" href="<?php url(); ?>/gift/read?list=<?php echo $list_id; ?>">Gå tilbage</a>
      <p class="mt-5 mb-3 text-muted"><?php app('name'); ?></p>
    </form> 