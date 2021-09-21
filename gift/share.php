<?php include '../app/functions.php'; ?>   
<?php include '../app/templates/header.php'; ?>   

<?php include '../app/templates/app.php'; ?>

<?php 
$list_id = $app['db']->CleanDBData($_GET['id']);
$list = $app['db']->Select('select * from whish_lists where list_id = ' . $list_id); 

if(!empty($list)) {
  $products = $app['db']->Select('select * from whish_gifts where gift_list = ' . $list_id); 
}
?>

<title>Ønskeliste: <?php echo $list[0]['list_title']; ?></title>
</head>
<body>

<div class="container py-3">
  <header>
    <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
      <a href="<?php echo $app['url'] ?>" class="d-flex align-items-center text-dark text-decoration-none">
    <span class="fs-4"><?php echo $app['name']; ?></span>
      </a>

      <?php include '../app/templates/nav.php'; ?>
    </div>
  </header>
  
  <main>
      
  <?php if(!empty($products)): ?>

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
          <?php foreach($products as $product): ?>
          <tr>
            <td><img src="<?php echo $app['url']; ?>/public/uploads/eis.png" width="150" height="100"></td>
            <td><?php echo $product['gift_name']; ?></td>
            <td><?php echo $product['gift_price']; ?> kr.</td>
            <td>
              <?php if(!empty($product['gift_link'])): ?>
              <a href="<?php echo $product['gift_link']; ?>">Link</a>
              <?php endif; ?>
            </td>
            <td><?php echo $product['gift_note']; ?></td>
            <td><?php echo $product['gift_qty']; ?></td>
            <td><?php echo $product['gift_reservations']; ?></td>
            <td>
            <form action="<?php echo $app['url']; ?>/gift/reserve" method="post">
            <input type="number" id="qty" name="qty" min="1" max="<?php echo $product['gift_qty']; ?>" value="1" required>
            <input type="hidden" name="gift" value="<?php echo $product['gift_id']; ?>">
            <input type="hidden" name="list" value="<?php echo $product['gift_list']; ?>">
            <input type="submit" class="btn btn-primary" value="Reservér">
            <a href="<?php echo $app['url']; ?>/gift/reserve?product=1&list=3&remove=1" class="btn btn-secondary">Fortryd</a>
          </form>
          </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <?php else: ?>
      <h2 id="produkter" class="display-6 text-center mb-4"><?php echo $list[0]['list_title']; ?></h2>
    <p class="text-center"><?php echo $list[0]['list_subtitle']; ?></p>
    <h4 class="text-center font-weight-bold">Dato: <?php echo date('d-m-Y H:i', strtotime($list[0]['list_date'])); ?></h4>
 
      <h3 class="text-center">Ingen ønsker, endnu.</h3>
 
<?php endif; ?>
   
  </main>

  

  <?php include '../app/templates/footer.php'; ?>    