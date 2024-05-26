<?php

use core\classes\Database;

    session_start();

    // / Rotas 
    require_once("../config.php");
    require_once('../vendor/autoload.php');
    require_once("../core/rotas.php");

    $db = new Database();

    $db->insert("INSERT INTO clientts VALUES(?, ?)", [1, "Diaku"]);


?>