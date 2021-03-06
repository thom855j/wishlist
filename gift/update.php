<?php 

include '../app/includes/functions.php';

$list_id = $_GET['list'];
$gift_id = $_GET['id'];
$img_file = '';

if(!empty($_POST)) {

  $app['db']->Update('wish_gifts', [
    'gift_name' => $app['db']->CleanDBData($_POST['name']),
    'gift_qty' => $app['db']->CleanDBData($_POST['qty']),
    'gift_price' => $app['db']->CleanDBData($_POST['price']),
    'gift_link' => $app['db']->CleanDBData($_POST['link']),
    'gift_note' => $app['db']->CleanDBData($_POST['note'])
  ], ['gift_id' => $gift_id, 'gift_list' => $list_id]);

  if(!empty($_FILES['img']['name'])) {
    $img_file = list_file_upload('img', $list_id);

    if(!$img_file) {
      redirect('/gift/read?list=' . $list_id);
    } else {
      $current_img = $_POST['current_img'];

      $file = "../public/uploads/$list_id/$current_img";
  
      if(file_exists($file)) {
        unlink($file);
      }
  
      $app['db']->Update('wish_gifts', [
        'gift_image' => $img_file,
      ], ['gift_id' => $gift_id, 'gift_list' => $list_id]);
    }

  }

  redirect('/gift/read?list=' . $list_id);

} 

$gift = $app['db']->Select('select * from wish_gifts where gift_id = ' . $gift_id)[0];
?>

<?php include '../app/templates/header.php'; ?> 
<title>Rediger gave</title>

<?php include '../app/templates/crud.php'; ?>

  </head>

  <body class="text-center">
    <form class="form-signin" action="" method="post" enctype="multipart/form-data">
      <h1 class="h3 mb-3 font-weight-normal">Rediger gave</h1>
      <label for="name" class="sr-only">Navn *</label>
      <input type="text" name="name" id="name" class="form-control" placeholder="Navn på øsnke" required="" autofocus="" value="<?php echo $gift['gift_name'] ?>">
      <label for="img" class="sr-only">Billedlink</label>
      <input type="file" name="img" id="img" class="form-control" placeholder="Billedelink" value="<?php echo $gift['gift_image'] ?>">
      <input type="hidden" name="current_img" value="<?php echo $gift['gift_image'] ?>">
      <label for="price" class="sr-only">Pris</label>
      <input type="number" step=".01" name="price" id="price" class="form-control" placeholder="Pris" value="<?php echo $gift['gift_price'] ?>">
      <label for="link" class="sr-only">Link</label>
      <input type="url" name="link" id="link" class="form-control" placeholder="Link" value="<?php echo $gift['gift_link'] ?>">
      <label for="note" class="sr-only">Note</label>
      <input type="text" name="note" id="note" class="form-control" placeholder="Note" value="<?php echo $gift['gift_note'] ?>">
      <label for="qty" class="sr-only">Ønsket antal</label>
      <input type="number" name="qty" id="qty" class="form-control" placeholder="Antal" value="<?php echo $gift['gift_qty'] ?>">
      <button class="btn btn-lg btn-primary btn-block" type="submit">Gem ønske</button>
      <br>
      <a class="mt-5 mb-3" href="<?php echo $app['url']; ?>/gift/read?list=<?php echo $list_id; ?>">Gå tilbage</a>
      <p class="mt-5 mb-3 text-muted"><?php echo $app['name']; ?></p>
    </form> 