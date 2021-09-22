<?php include '../app/functions.php'; ?>   
<?php include '../app/templates/header.php'; ?>   

<?php include '../app/templates/app.php'; ?>

<?php 
$cookie_name = $app['cookie_name'];

$list_id = $app['db']->CleanDBData($_GET['id']);
$list = $app['db']->Select('select * from whish_lists where list_id = ' . $list_id); 

if(!empty($list)) {
  $gifts = $app['db']->Select('select * from whish_gifts where gift_list = ' . $list_id); 

  if(isset($_COOKIE[$cookie_name])) {
    $session_id = $_COOKIE[$cookie_name];
    $visitor = $app['db']->Select("SELECT * from whish_sessions where session_list = '$list_id' AND session_id = '$session_id'"); 
    if(!empty($visitor)) {
      $visitor = json_decode($visitor[0]['session_gifts'], true);
    }
  }
}


?>

<title>Ønskeliste: <?php echo $list[0]['list_title']; ?></title>
</head>
<body>

<?php include '../app/templates/nav.php'; ?>
  
  <main>


  
  <?php if(!empty($gifts)): ?>
    <h2 id="produkter" class="display-6 text-center mb-4"><?php echo $list[0]['list_title']; ?></h2>
    <p class="text-center"><?php echo $list[0]['list_subtitle']; ?></p>
    <h4 class="text-center font-weight-bold">Dato: <?php echo date('d-m-Y H:i', strtotime($list[0]['list_date'])); ?></h4>


    <div class="table-responsive">
      <table class="table text-center">
        <thead>
          <tr>
            <th></th>
            <th>Navn</th>
            <th>Pris</th>
            <th>Link</th>
            <th>Note</th>
            <th>Ønsket</th>
            <th>Reserveret</th>
            <th></th>
          </tr>
        </thead>

        <tbody>
          <?php foreach($gifts as $gift): ?>
          <tr>
          <?php if(!empty($gift['gift_image'])): ?>
              <td><img src="<?php echo $gift['gift_image']; ?>" width="150" height="100"></td>
              <?php else: ?>
                <td><img src="<?php echo $app['url']; ?>/public/img/no-image.png" width="150" height="100"></td>
              <?php endif; ?>
            <td><?php echo $gift['gift_name']; ?></td>
            <td><?php echo $gift['gift_price']; ?> kr.</td>
            <td>
              <?php if(!empty($gift['gift_link'])): ?>
              <a href="<?php echo $gift['gift_link']; ?>">Link</a>
              <?php endif; ?>
            </td>
            <td><?php echo $gift['gift_note']; ?></td>
            <td><?php echo $gift['gift_qty']; ?></td>
            <td><?php echo $gift['gift_reservations']; ?></td>
            <?php if($gift['gift_qty'] != $gift['gift_reservations']): ?>
            <td>
              <?php 
              $gift_id = $gift['gift_id']; 
              ?>
              <?php if(!isset($visitor[$gift_id])): ?>
            <form action="<?php url('/guest/reserve'); ?>" method="post">
            <input type="number" id="qty" name="qty" min="1" max="<?php echo $gift['gift_qty'] - $gift['gift_reservations']; ?>" value="1" required>
            <input type="hidden" name="gift" value="<?php echo $gift['gift_id']; ?>">
            <input type="hidden" name="list" value="<?php echo $gift['gift_list']; ?>">
            <input type="submit" class="btn btn-primary" value="Reservér">
            </form>
            <?php else: ?>
              <p>Du har reserveret: <?php echo $visitor[$gift_id] ?></p>
              <a onclick="return confirm('Er du sikker?');" href="<?php echo $app['url']; ?>/guest/reserve?delete=1&gift=<?php echo $gift['gift_id']; ?>&list=<?php echo $gift['gift_list']; ?>&qty=<?php echo $visitor[$gift_id] ?>" class="btn btn-secondary">Fortryd reservation?</a>
            <?php endif; ?>
            </td>
            <?php else: ?>
              <td>OK</td>
            <?php endif; ?>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <?php else: ?>
      <h4 class="text-center">Ingen ønsker eller inaktiv ønskeliste.</h4>
 
<?php endif; ?>
   
  </main>

  

  <?php include '../app/templates/footer.php'; ?>    