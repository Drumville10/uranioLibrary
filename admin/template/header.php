<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header("Location: ../index.php");
    }else{
        if($_SESSION['user']=="ok"){
            $userName=$_SESSION["userName"];
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

    <?php $url ="http://".$_SERVER['HTTP_HOST']."/uranioLibrary"?>

    <nav class="navbar navbar-expand-lg bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand">Uranio</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="#">Administrador</a>
                    <a class="nav-link" href="<?php echo $url?>/admin/home.php">Inicio</a>
                    <a class="nav-link" href="<?php echo $url?>/admin/sections/products.php">Libros</a>
                    <a class="nav-link" href="<?php echo $url?>/admin/sections/logout.php" >Cerrar</a>
                    <a class="nav-link" href="<?php echo $url?>">Ver Web</a>
                </div>
            </div>
        </div>
    </nav>