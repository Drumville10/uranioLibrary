<?php
    $host="localhost";
    $db="uraniolibrary";
    $user="root";
    $password="";

    try {
        $conection = new PDO("mysql:host=$host;dbname=$db",$user,$password);
        // if($conection){echo "conectado a DB";}
    }catch(Exception $ex){
        echo $ex->getMessage();
    }
?>