<?php

try {
    DEFINE('HOST','localhost');
    DEFINE('DB','new_pizzas'); 
    DEFINE('USER','root');
    DEFINE('PASSWORD','');
  
    $conect = new PDO ('mysql:host='.HOST.';dbname='.DB,USER,PASSWORD);
    $conect -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $erro) {
    echo "<strong>Erro de PDO = </strong> ".$erro->getMessage();
}






