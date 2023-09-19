<?php 
    include('template/header.php')
?>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="jumbotron">
                    <h1 class="display-4">Bienvenido <?php echo $userName;?></h1>
                    <p class="lead">TVamos a administrar nuestros loibros en el sitio web.</p>
                    <hr class="my-4">
                    <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
                    <a class="btn btn-primary btn-lg" href="sections/products.php" role="button">Administrar Libros</a>
                </div>
            </div>
        </div>
    </div>

<?php
    include('template/footer.php')
?>