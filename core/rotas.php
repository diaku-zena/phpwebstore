<?php

    $rotas = [
        "home" => "main@home",
        "loja" => "main@loja",
    ];

    // Rota inical por defeito
    $acao = "home";

    if(isset($_GET['a'])){
        if (!key_exists($_GET['a'], $rotas)) {
            $acao = "home";
        } else {
            $acao = $_GET["a"];
        }
    }


    //  Redirecionamento das rotas
    $partes = explode("@", $rotas[$acao]);
    $controller = "core\\controllers\\".ucfirst($partes[0]);
    $method  = $partes[1];

    $classMethod = new $controller();
    $classMethod->$method();

?>