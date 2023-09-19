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
            $date = new DateTime();
            $fileName=($productImg!="")?$date->getTimestamp()."_".$_FILES["productImg"]["name"]:"img.png";
            $tmpImg = $_FILES["productImg"]["tmp_name"];
            if ($tmpImg!=""):
                move_uploaded_file($tmpImg,"../../img/".$fileName);
            endif;
            $querySQL ->bindParam(':productImg',$fileName);
            $querySQL ->execute();
            break;
        case "edit":
            if ($productImg != ""){
                $querySQL = $conection->prepare("UPDATE libros SET nombre = :name, imagen = :img WHERE id = :id");
                $querySQL ->bindParam(':name',$productName);
                $date = new DateTime();
                $fileName=($productImg!="")?$date->getTimestamp()."_".$_FILES["productImg"]["name"]:"img.png";
                $tmpImg = $_FILES["productImg"]["tmp_name"];
                if ($tmpImg!=""):
                    move_uploaded_file($tmpImg,"../../img/".$fileName);
                endif;

                $querySQL ->bindParam(':img',$fileName);
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
            $txtID ="";
            $productName="";
            $productImg="";
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
            $book=$querySQL->fetch(PDO::FETCH_LAZY);

            if(isset($book["imagen"])&&($book["imagen"]!="img.png")){
                if(file_exists("../../img/".$book["imagen"])){
                    unlink("../../img/".$book["imagen"]);
                }
            }
            
            $txtID ="";
            $productName="";
            $productImg="";
            break;
    }

    $querySQL = $conection->prepare("SELECT * FROM libros");
    $querySQL->execute();
    $listBoks=$querySQL->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card mt-5">
                <div class="card-header">
                    Datos de Libro
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">ID:</label>
                            <input type="text" class="form-control" value="<?php if(isset($txtID)) {echo $txtID;} ?>" name="txtId" id="txtId" placeholder="ID" required readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Nombre</label>
                            <input type="text" class="form-control" value="<?php if(isset($txtName)) {echo $txtName;}?>" name="productName" id="productName" placeholder="Nombre de prodcuto">
                        </div>
                        <div class="form-group">
                            <label for="">Imagen:</label>
                            <?php
                                if($txtImg!=""):
                            ?>
                                <div class="my-3 d-flex justify-content-center">
                                    <img src="../../img/<?php echo $book['imagen'];?>" alt="" style="width:90px;">
                                </div>
                            <?php endif;?>
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
        <div class="col-md-8">
            <table class="table table table-hover table-sm mt-5">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Imagen Nombre</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($listBoks as $book) :?>
                    <tr>
                        
                            <th><?php echo $book['id'];?></th>
                            <td>
                                <img src="../../img/<?php echo $book['imagen'];?>" alt="" style="width:50px;">
                            </td>
                            <td><?php echo $book['imagen'];?></td>
                            <td><?php echo $book['nombre'];?></td>
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