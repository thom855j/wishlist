<?php include 'includes/header.php'; ?>   

<?php include 'templates/app.php'; ?>

<?php $lists = $app['db']->Select('select * from whish_lists'); ?>

<title>Mine ønskelister</title>
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
      
    <h2 id="produkter" class="display-6 text-center mb-4">Mine ønskelister</h2>


    <div class="table-responsive">
      <table class="table text-center">
        <thead>
          <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Subtitle</th>
            <th>Link</th>
            <th>Kode</th>
            <th>Handling</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach($lists as $list): ?>
          <tr>
            <td><?php echo $list['list_id'] ?></td>
            <td><?php echo $list['list_title'] ?></td>
            <td><?php echo $list['list_subtitle'] ?></td>
            <td><a href="<?php echo $app['url'] ?>/share.php?id=<?php echo $list['list_id'] ?>">Link</a></td>
            <td><?php echo $list['list_code'] ?></td>
            <td>
            <a href="<?php echo $app['url']; ?>/product.php?list=<?php echo $list['list_id'] ?>" class="btn btn-success">Ønsker</a>
              <a href="<?php echo $app['url']; ?>/list-edit.php?id=<?php echo $list['list_id'] ?>" class="btn btn-warning">Rediger</a>
              <a onclick="return confirm('Er du sikker?');" href="<?php echo $app['url']; ?>/list-delete.php?id=<?php echo $list['list_id'] ?>" class="btn btn-danger">Slet</a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
 

   
  </main>

  

  <?php include 'includes/footer.php'; ?>    