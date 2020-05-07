<?php
    require_once("config.php");

    $root = new User();

    $root->loadById(3);

    echo($root);

?>