<?php include 'includes/header.php'; ?>   

<?php include 'templates/app.php'; ?>

<?php

$list_id = $app['db']->CleanDBData($_GET['list']);
$list = $app['db']->Select('select * from whish_lists where list_id = ' . $list_id);

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

      <?php include 'includes/nav.php'; ?>
    </div>
  </header>
  
  <main>
      
  <h2 id="produkter" class="display-6 text-center mb-4"><?php echo $list[0]['list_title']; ?></h2>
    <p class="text-center"><?php echo $list[0]['list_subtitle']; ?></p>
    <a href="<?php echo $app['url'] ?>/product-new.php"><button type="button" class=" btn btn-primary">Tilføj ønske</button></a>
    <a href="<?php echo $app['url'] ?>/list.php"><button type="button" class=" btn btn-secondary">Tilbage til lister</button></a>

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
          <tr>
            <td>2</td>
            <td><img src="<?php echo $app['url']; ?>/uploads/eis.png" width="100" height="50"></td>
            <td>Test</td>
            <td>5</td>
            <td>0</td>
            <td>25 kr.</td>
            <td>Ønsket meget!</td>
            <th><a href="">Test</a></th>
            <td>
              <a href="<?php echo $app['url']; ?>/product-edit.php?id=1&list=3" class="btn btn-warning">Rediger</a>
              <a href="" class="btn btn-danger">Slet</a>
          </td>
          </tr>
        </tbody>
      </table>
    </div>
 

   
  </main>

  

  <?php include 'includes/footer.php'; ?>    