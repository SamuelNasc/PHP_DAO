<?php
    require_once("config.php");

    $sql = new Sql();
    $users = $sql->select("SELECT * FROM USERS");

    echo json_encode($users);
?>