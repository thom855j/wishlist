<?php 

include '../app/includes/functions.php'; 

$cookie_name = $app['cookie_name'];

$list_request = $app['db']->CleanDBData($_GET['id']);
$list = $app['db']->Select("SELECT * FROM wish_lists WHERE list_id = '$list_request' OR list_link = '$list_request'"); 

if(!empty($list)) {
  $list_id = $list[0]['list_id'];
}

if(!empty($list[0]['list_code']) && !list_auth($list_id)) {
  redirect('/guest/login?list=' . $list_id);
}

if(!empty($list)) {
  $gifts = $app['db']->Select("SELECT * FROM wish_gifts WHERE gift_list = '$list_id'"); 

  if(isset($_COOKIE[$cookie_name])) {
    $session_hash = $_COOKIE[$cookie_name];
    $visitor = $app['db']->Select("SELECT * FROM wish_sessions WHERE session_list = '$list_id' AND session_hash = '$session_hash'"); 
    if(!empty($visitor)) {
      $visitor = json_decode($visitor[0]['session_gifts'], true);
    }
  }
}


?>

<?php include '../app/templates/header.php'; ?>   
<?php include '../app/templates/app.php'; ?>
<title>Ønskeliste: <?php echo $list[0]['list_title']; ?></title>
</head>
<body>

<?php include '../app/templates/nav.php'; ?>
  
  <main>


  
  <?php if(!empty($gifts)): ?>
    <h2 id="produkter" class="display-6 text-center mb-4"><?php echo $list[0]['list_title']; ?></h2>

    <p class="text-center"><?php echo $list[0]['list_subtitle']; ?></p>
    <h4 class="text-center font-weight-bold">Dato: <?php echo date('d-m-Y', strtotime($list[0]['list_date'])); ?></h4>

    <?php if(auth()): ?>
    <a href="<?php echo $app['url'] ?>/list/read"><button type="button" class=" btn btn-secondary">Tilbage til lister</button></a>
    <?php endif; ?>
    <button onClick="window.print()" type="button" class="no-print btn btn-success">Print ønskeliste</button>
    
    <div class="table-responsive">
      <table class="table text-center">
        <thead>
          <tr>
            <th></th>
            <th>Navn</th>
            <th>Note</th>
            <th>Pris</th>
            <th>Link</th>
            <th>Ønsket antal</th>
            <th class="no-print">Antal købt</th>
            <th>Status</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach($gifts as $gift): ?>
          <tr>
          <?php if(!empty($gift['gift_image'])): ?>
            <td><a target="_blank" href="public/uploads/<?php echo $list_id; ?>/<?php echo $gift['gift_image']; ?>"><img src="public/uploads/<?php echo $list_id; ?>/<?php echo $gift['gift_image']; ?>" width="100" height="100"></a></td>
             <?php else: ?>
                <td><img src="<?php echo $app['url']; ?>/public/img/no-image.png" width="100" height="100"></td>
              <?php endif; ?>
            <td><?php echo $gift['gift_name']; ?></td>
            <td><?php echo $gift['gift_note']; ?></td>
            <td>
           <?php if(!empty($gift['gift_price'])): ?>
            <?php echo number_format($gift['gift_price'],2,',','.'); ?> kr.
            <?php endif; ?>
            </td>
            <td>
              <?php if(!empty($gift['gift_link'])): ?>
              <a target="_blank" href="<?php echo $gift['gift_link']; ?>">Link</a>
              <?php endif; ?>
            </td>
            <td>
              <?php if(!empty($gift['gift_qty'])): ?>
              <?php echo $gift['gift_qty']; ?>
             <?php endif; ?>
            </td>
            <td class="no-print">
              <?php if(!empty($gift['gift_reservations'])): ?>
              <?php echo $gift['gift_reservations']; ?>
              <?php endif; ?>
            </td>
            <td>
            <?php 
              $gift_id = $gift['gift_id']; 
            ?>
            <?php if($gift['gift_qty'] != $gift['gift_reservations']): ?>
              <form class="no-print" action="<?php url('/guest/reserve'); ?>" method="post">
              <input type="number" id="qty" name="qty" min="1" max="<?php echo $gift['gift_qty'] - $gift['gift_reservations']; ?>" value="1" required>
              <input type="hidden" name="gift" value="<?php echo $gift['gift_id']; ?>">
              <input type="hidden" name="list" value="<?php echo $gift['gift_list']; ?>">
              <input onclick="return confirm('Er du sikker på du vil reservere denne gave?');" type="submit" class="btn btn-primary" value="Reservér">
              </form>
            <?php else: ?>
              <p style="font-style: italic; font-weight: bold; width: 150px;">ER ALLE ALLEREDE KØBT AF ANDRE</p>
            <?php endif; ?>     
            <?php if(isset($visitor[$gift_id])): ?>
                <p>Du har reserveret: <?php echo $visitor[$gift_id] ?></p>
                <a onclick="return confirm('Er du sikker?');" href="<?php echo $app['url']; ?>/guest/reserve?delete=1&gift=<?php echo $gift['gift_id']; ?>&list=<?php echo $gift['gift_list']; ?>&qty=<?php echo $visitor[$gift_id] ?>" class="btn btn-secondary">Fortryd reservation?</a>
            <?php endif; ?>
              </td>
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