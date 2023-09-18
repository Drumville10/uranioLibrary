<?php
    include("../template/header.php");
    include("../config/db.php");

    $txtID=(isset($_POST['txtId']))?$_POST['txtId']:"";
    $productName=(isset($_POST['productName']))?$_POST['productName']:"";
    $productImg=(isset($_FILES['productImg']['name']))?$_FILES['productImg']['name']:"";
    $action=(isset($_POST['action']))?$_POST['action']:"";


    switch($action){
        case "add":
            $querySQL = $conection->prepare("INSERT INTO libros (nombre, imagen) VALUES (:productName, :productImg)");
            $querySQL ->bindParam(':productName',$productName);
            $querySQL ->bindParam(':productImg',$productImg);
            $querySQL ->execute();
            break;
        case "edit":
            if ($productImg != ""){
                $querySQL = $conection->prepare("UPDATE libros SET nombre = :name, imagen = :img WHERE id = :id");
                $querySQL ->bindParam(':name',$productName);
                $querySQL ->bindParam(':img',$productImg);
                $querySQL ->bindParam(':id',$txtID);
                $querySQL ->execute();
            }else{
                $querySQL = $conection->prepare("UPDATE libros SET nombre = :name WHERE id = :id");
                $querySQL ->bindParam(':name',$productName);
                $querySQL ->bindParam(':id',$txtID);
                $querySQL ->execute();
            };
            break;
        case "cancel":
            echo "presionar botón cancelar";
            break;
        case "select":
            $querySQL = $conection->prepare("SELECT * FROM libros WHERE id =:id");
            $querySQL -> bindParam(':id',$txtID);
            $querySQL ->execute();
            $book = $querySQL->fetcH(PDO::FETCH_LAZY);

            $txtName = $book['nombre'];
            $txtImg = $book['imagen'];
            break;
        case "delete":
            $querySQL = $conection->prepare("DELETE FROM libros WHERE id = :id");
            $querySQL ->bindParam(':id',$txtID);
            $querySQL -> execute();
            break;
    }

    $querySQL = $conection->prepare("SELECT * FROM libros");
    $querySQL->execute();
    $listBoks=$querySQL->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container">
    <div class="row">
        <div class="col-md-5">
            <div class="card mt-5">
                <div class="card-header">
                    Datos de Libro
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">ID:</label>
                            <input type="text" class="form-control" value="<?php echo $txtID?>" name="txtId" id="txtId" placeolder="ID">
                        </div>
                        <div class="form-group">
                            <label for="">Nombre</label>
                            <input type="text" class="form-control" value="<?php echo $txtName?>" name="productName" id="productName" placeholder="Nombre de prodcuto">
                        </div>
                        <div class="form-group">
                            <label for="">Imagen</label>
                            <input type="file" class="form-control" value="<?php echo $txtImg?>" name="productImg" id="productImg" placeholder="Nombre de prodcuto">
                        </div>
                        <div class="btn-group mt-2" role="group" aria-label="">
                            <button type="submit" name="action" value="add" class="btn btn-success">Agregar</button>
                            <button type="submit" name="action" value="edit" class="btn btn-warning">Editar</button>
                            <button type="submit" name="action" value="cancel" class="btn btn-info">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <table class="table table table-hover table-sm mt-5">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($listBoks as $book) :?>
                    <tr>
                        
                            <th><?php echo $book['id'];?></th>
                            <td><?php echo $book['nombre'];?></td>
                            <td><?php echo $book['imagen'];?></td>
                            <td>
                            <form method="POST">
                                <input type="text" name="txtId" value="<?php echo $book['id']?>" hidden>
                                <button type="submit" name="action" value="select" class="btn btn-primary btn-sm ">Seleccionar</button> 
                                <button type="submit" name="action" value="delete" class="btn btn-danger btn-sm">Borrar</button> 
                            </td>
                        </form>
                    </tr>
                    <?php endforeach?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
    include("../template/footer.php");
?>