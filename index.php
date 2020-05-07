<?php
    require_once("config.php");

    $user = new User();

    $user->login("SAMUEL@GMAIL.COM", "335231");
    //$user->loadById(3);

    //$list = User::getList();

    //$search = User::search("E");

    echo $user;
    //echo($root);

?>