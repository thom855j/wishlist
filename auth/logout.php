<?php 

include '../app/includes/functions.php'; 

session_logout();

cookie_logout();

redirect('/');