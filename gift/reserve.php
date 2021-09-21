<?php

include '../app/functions.php';

if(isset($_POST)) {

    $list = $_POST['list'];

}

redirect('/' . $list);