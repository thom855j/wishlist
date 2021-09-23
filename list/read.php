<?php

include '../app/includes/functions.php'; 

is_auth(); 

$user_id = user();
$lists = $app['db']->Select("SELECT * FROM wish_lists WHERE list_user = $user_id"); 
?>

<?php include '../app/templates/header.php'; ?>   
<?php include '../app/templates/app.php'; ?>
<?php include '../app/templates/nav.php'; ?>

<title>Mine ønskelister</title>
</head>


<body>

  
  <main>
      
    <h2 id="produkter" class="display-6 text-center mb-4">Mine ønskelister</h2>
    <a href="<?php echo $app['url'] ?>/list/create"><button type="button" class="btn btn-primary">Opret ønskeliste</button></a>

<?php if(!empty($lists)): ?>
    <div class="table-responsive">
      <table class="table text-center">
        <thead>
          <tr>
            <th>ID</th>
            <th>Titel</th>
            <th>Undertitel</th>
            <th>Udløbsdato</th>
            <th>Link</th>
            <th>Kode</th>
            <th>Handling</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach($lists as $list): ?>
          <tr>
            <td><?php echo $list['list_id']; ?></td>
            <td><?php echo $list['list_title']; ?></td>
            <td><?php echo $list['list_subtitle']; ?></td>
            <td><?php echo date('d-m-Y H:i', strtotime($list['list_date'])); ?></td>
            <td><a href="<?php echo $app['url']; ?>/<?php echo $list['list_id'] ?>">Link</a></td>
            <td><?php echo $list['list_code']; ?></td>
            <td>
            <a href="<?php echo $app['url']; ?>/gift/read?list=<?php echo $list['list_id']; ?>" class="btn btn-success">Ønsker</a>
              <a href="<?php echo $app['url']; ?>/list/update?id=<?php echo $list['list_id']; ?>" class="btn btn-warning">Rediger</a>
              <a onclick="return confirm('Er du sikker?');" href="<?php echo $app['url']; ?>/list/delete?id=<?php echo $list['list_id'] ?>" class="btn btn-danger">Slet</a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <?php else: ?>
      <br><br>
      <p>Ingen ønskelister, endnu.</p>
    <?php endif; ?> 
 

   
  </main>

  

  <?php include '../app/templates/footer.php'; ?>    