<nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
      <a class="p-2 text-dark text-decoration-none" href="<?php echo $app['url'] ?>/list/read">Mine lister</a>
      <?php if(!auth()): ?>  
      <a href="<?php echo $app['url'] ?>/auth/signup"><button type="button" class="w-100 btn  btn-primary">Opret profil</button></a>
      <a href="<?php echo $app['url'] ?>/auth/login"><button type="button" class="w-100 btn  btn-secondary">Log på</button></a>
        <?php else: ?>
      <a href="<?php echo $app['url'] ?>/auth/logout"><button type="button" class="w-100 btn  btn-danger">Log ud</button></a>
      <?php endif; ?>
    </nav>