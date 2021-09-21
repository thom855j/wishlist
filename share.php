<?php include 'includes/header.php'; ?>   

<?php include 'templates/app.php'; ?>

<?php 
$list_id = $app['db']->CleanDBData($_GET['id']);
$list = $app['db']->Select('select * from whish_lists where list_id = ' . $list_id); 

if(!empty($list)) {
  $products = $app['db']->Select('select * from whish_products where product_list = ' . $list_id); 
}
?>

<title>Ønskeliste</title>
</head>
<body>

<div class="container py-3">
  <header>
    <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
      <a href="<?php echo $app['url'] ?>" class="d-flex align-items-center text-dark text-decoration-none">
    <span class="fs-4"><?php echo $app['name']; ?></span>
      </a>

      <?php include 'includes/nav.php'; ?>
    </div>
  </header>
  
  <main>
      
  <?php if(!empty($products)): ?>

    <h2 id="produkter" class="display-6 text-center mb-4"><?php echo $list[0]['list_title']; ?></h2>
    <p class="text-center"><?php echo $list[0]['list_subtitle']; ?></p>
 

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
            <td><img src="<?php echo $app['url']; ?>/uploads/eis.png" width="150" height="100"></td>
            <td><?php echo $product['product_name']; ?></td>
            <td><?php echo $product['product_price']; ?> kr.</td>
            <td>
              <?php if(!empty($product['product_link'])): ?>
              <a href="<?php echo $product['product_link']; ?>">Link</a>
              <?php endif; ?>
            </td>
            <td><?php echo $product['product_note']; ?></td>
            <td><?php echo $product['product_qty']; ?></td>
            <td><?php echo $product['product_reservations']; ?></td>
            <td>
            <form action="<?php echo $app['url']; ?>/reserve.php" method="post">
            <input type="number" id="qty" name="qty" min="1" max="5" value="1" required>
            <input type="hidden" name="product" value="1">
            <input type="hidden" name="list" value="3">
            <input type="submit" class="btn btn-primary" value="Reservér">
            <a href="<?php echo $app['url']; ?>/reserve.php?product=1&list=3&remove=1" class="btn btn-secondary">Fortryd</a>
          </form>
          </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <?php else: ?>

      <p class="text-center">Ingen ønskeliste!</p>
 
<?php endif; ?>
   
  </main>

  

  <?php include 'includes/footer.php'; ?>    