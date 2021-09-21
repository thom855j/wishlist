<?php include '../app/functions.php'; ?>;
<?php include '../app/templates/header.php'; ?>   


<?php include '../app/templates/app.php'; ?>

<?php

$list_id = $app['db']->CleanDBData($_GET['list']);
$list = $app['db']->Select('select * from whish_lists where list_id = ' . $list_id);

$gifts = $app['db']->Select('select * from whish_gifts where gift_list = ' . $list_id);

?>

<title>Gaver</title>
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
      
  <h2 id="produkter" class="display-6 text-center mb-4"><?php echo $list[0]['list_title']; ?></h2>
    <p class="text-center"><?php echo $list[0]['list_subtitle']; ?></p>
    <p class="text-center"><?php echo date('d-m-Y H:i', strtotime($list[0]['list_date'])); ?></p>
    <a href="<?php echo $app['url'] ?>/gift/create?list=<?php echo $list[0]['list_id']; ?>"><button type="button" class=" btn btn-primary">Tilføj ønske</button></a>
    <a href="<?php echo $app['url'] ?>/list/read"><button type="button" class=" btn btn-secondary">Tilbage til lister</button></a>

    <?php if(!empty($gifts)): ?>
    <div class="table-responsive">
      <table class="table text-center">
        <thead>
          <tr>
            <th>ID</th>
            <th>Billede</th>
            <th>Navn</th>
            <th>Pris</th>
            <th>Link</th>
            <th>Note</th>
            <th>Ønsket</th>
            <th>Reserveret</th>
            <th>Handling</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach($gifts as $gift): ?>
            <tr>
              <td><?php echo $gift['gift_id']; ?></td>
              <?php if(!empty($gift['gift_image'])): ?>
              <td><img src="<?php echo $gift['gift_image']; ?>" width="150" height="100"></td>
              <?php else: ?>
                <td><img src="<?php echo $app['url']; ?>/public/img/no-image.png" width="150" height="100"></td>
              <?php endif; ?>
              <td><?php echo $gift['gift_name']; ?></td>
              <td><?php echo $gift['gift_price']; ?></td>
              <?php if(!empty($gift['gift_link'])): ?>
              <th><a target="_blank" href="<?php echo $gift['gift_link']; ?>">Link</a></th>
              <?php else: ?>
                <td></td>
              <?php endif; ?>
              <td><?php echo $gift['gift_note']; ?></td>
              <td><?php echo $gift['gift_qty']; ?></td>
              <td><?php echo $gift['gift_reservations']; ?></td>
              <td>
                <a href="<?php echo $app['url']; ?>/gift/update?id=<?php echo $gift['gift_id']; ?>&list=<?php echo $list_id; ?>" class="btn btn-warning">Rediger</a>
                <a href="" class="btn btn-danger">Slet</a>
            </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
 <?php endif; ?>

   
  </main>

  

  <?php include '../app/templates/footer.php'; ?>    