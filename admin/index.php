<?php
    session_start();
    if ($_POST){
        if(($_POST["user"]=="jorge")&&($_POST["password"]=="123456")){
            $_SESSION['user']="ok";
            $_SESSION['userName']="Jorge";
            header('Location: home.php');
        }else{
            $message = "El ususario o contraseña es incorrecto";
        }
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uranio Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-center mt-5">
                <div class="card mt-5" style="width:400px">
                    <div class="card-header">
                        <h1 class="card-title">Login</h1>
                    </div>
                    <?php if(isset($message)):?>
                        <div class="alert alert-dangermx-2" role="alert">
                            <?php echo $message;?>
                        </div>
                    <?php endif;?>
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">Usuario</label>
                                <input type="text" class="form-control" name="user" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Contraseña</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <button type="submit" class="btn btn-primary">Ingresar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>