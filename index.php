<?php
    require_once("config.php");

    $user = new User();

    //$user->login("SAMUEL@GMAIL.COM", "335231");
    //$user->loadById(3);

    //$list = User::getList();

    //$search = User::search("E");

    // $user->setUserLogin("may@GMAILL.COM");
    // $user->setUserPassword("SahudaiFSAI");
    // $user->insert();

    $user->loadById(7);
    $user->delete();


    echo $user;
    //echo($root);

?>