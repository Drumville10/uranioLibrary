<?php
    include("template/header.php");
    include("template/navbar.php");
    include("admin/config/db.php");

    $querySQL=$conection->prepare("SELECT * FROM libros");
    $querySQL->execute();
    $listItems=$querySQL->fetchAll(PDO::FETCH_ASSOC);

?>
    <div class="container">
        <div class="row mt-5">
        <?php foreach ($listItems as $items):?>
            <div class="col-12 col-md-6 col-lg-3 mt-5">
                <div class="card" style="width: 18rem;">
                    <img src="img/<?php echo $items["imagen"];?>" class="card-img-top" alt="..." style="max-height: 400px;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $items["nombre"];?></h5>
                        <a href="#" class="btn btn-primary">Ver producto</a>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
        </div>
    </div>

<?php
    include("template/footer.php");
?>