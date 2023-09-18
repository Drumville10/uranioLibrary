<?php
    include("../template/header.php");
?>
<?php
    print_r($_POST);
    print_r($_FILES);
?>
<div class="container">
    <div class="row">
        <div class="col-md-5">
            <div class="card mt-5">
                <div class="card-header">
                    Datos de Libro
                </div>
                <div class="card-body">
                    <form action="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">ID:</label>
                            <input type="text" class="form-control" name="textId" id="textId" placeolder="ID">
                        </div>
                        <div class="form-group">
                            <label for="">Nombre</label>
                            <input type="text" class="form-control" name="productName" id="productName" placeholder="Nombre de prodcuto">
                        </div>
                        <div class="form-group">
                            <label for="">Imagen</label>
                            <input type="file" class="form-control" name="productImg" id="productImg" placeholder="Nombre de prodcuto">
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
                    <tr>
                        <th>2</th>
                        <td>Aprende PHP</td>
                        <td>imagen.jpg</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm ">Seleccionar</button> 
                            <button type="button" class="btn btn-danger btn-sm">Borrar</button> 
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
    include("../template/footer.php");
?>