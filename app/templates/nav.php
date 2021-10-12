<div class="container-xl py-3">
  <header>
    <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
      <a href="<?php
      if(!auth()) {
        url(); 
      } else {
        url('/list/read'); 
      }
       ?>" class="d-flex align-items-center text-dark text-decoration-none">
    <span class="fs-4"><?php app('name'); ?></span>
      </a>
      <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
            <?php if(!auth()): ?>  
            <a class="p-2 text-dark text-decoration-none" href="<?php url('/auth/signup'); ?>">Opret profil</a>
            <a class="p-2 text-dark text-decoration-none" href="<?php url('/auth/login'); ?>">Log på</a>
              <?php else: ?>
                <a class="p-2 text-dark text-decoration-none" href="<?php url('/list/read'); ?>">Mine lister</a>
            <a class="p-2 text-dark text-decoration-none" href="<?php url('/auth/logout'); ?>">Log ud</a>
            <?php endif; ?>
          </nav>

          </div>

</header>