<?php
header('Content-Type: text/html; charset=UTF-8');
error_reporting(0);

//conexion a BBDD
    require_once '../BackEnd/Conexion.php';
    $conexion = new Connection();
    $conexion->get_connected();

//Consultas Sql
    require_once '../BackEnd/Producto.php';
    require_once '../BackEnd/Categoria.php';

    $orden = $_POST['Ordenar'];
    if ($orden != '') { 
        $ordenPrecio = 'order by price '.$orden;
    }        
    
    $producto = new Producto();
    $Mproducto = $producto->MostrarProductos($ordenPrecio);

    $Categoria = new Categoria();
    $VerCategoria = $Categoria->MostrarNombreCategoria();
  

?>
<!DOCTYPE html>
<html lang="es">
    <head>
    	<title>Bsale DESAFÍO</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
        <meta charset="UTF-8">
        <meta name="title" content="Tienda Online">
        <meta name="description" content="Descripción Tienda Online">    
    </head>
    <body>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>        

        <div class="container col-md-12">
            <p class="fw-bold fs-1">Nuestra Tienda <span class="badge bg-warning">OnLine</span></p>   
            <div class="row">
                <div class="col-md-3 mb-3">
                    <form class="col" action="Bsale.php" method="post">
                    <nav class="navbar navbar-expand-lg bg-light shadow">
                        <div class="col">
                            <span class="navbar-brand p-3 "> <span class="badge bg-warning mb-3 fs-5">Categorías</span> </span>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">                                
                                <div class="col list-group">                          
                                    <?php 
                                    $idCategoria = $_POST['idCategoria'];
                                    while($linea = mysql_fetch_array($VerCategoria, MYSQL_ASSOC)){
                                            $id              = $linea['id']; 
                                            $nombreCategoria = $linea['name']; 
                                    ?>                                        
                                    <div class="list-group-item list-group-item-secundary text-uppercase border border-0 border-top">
                                       <input class="form-check-input" type="radio" name="idCategoria" value="<?php echo $id ?>" onchange="submit()" id="flexCheckDefault<?php echo $id ?>" <?php                                    
                                            if($idCategoria == $id ){
                                                echo 'checked';
                                            }
                                           ?>>
                                        <label class="form-check-label" for="flexCheckDefault<?php echo $id ?>">
                                            <?php echo $nombreCategoria ?>      
                                        </label>                                
                                   </div>
                                    <?php } ?>                     
                                  
                                    <div class="input-group mb-3 col p-3">
                                          <input type="search" class="form-control" placeholder="Buscar" aria-label="Buscar" aria-describedby="button-addon2">
                                          <button class="btn btn-outline-success" type="submit" id="button-addon2">Buscar</button>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </nav>
                </div>
            
                <div class="col-md-9">  
                <!----Mostrar Filtro Ordenar------------------------------>
                    <div class="row g-2 mb-3">
                        <div class="col" id="Ncard" name="Ncard"> </div>   
                        <div class="col">
                            <select class="form-select" name="Ordenar" onchange="submit()">
                                <option value="ASC" <?php if($orden == 'ASC'){echo 'selected';}?> >Menor Precio</option>
                                <option value="DESC" <?php if($orden == 'DESC'){echo 'selected';}?> >Mayor Precio</option>
                            </select>
                        </div>
                    </div>
                    </form>
                <!----Fin Mostrar Filtro Ordenar------------------------------>    
                <!----While contador card------------------------------------->  
                        <?php 
                        $num = 0;
                        $cantidad = 0;
                        while($num <= $cantidad){
                                $num++;
                        ?>
                <!----Fin while contador card--------------------------------->      
                    <div class="row row-cols-1 row-cols-md-4 g-4">  
                        
                    <?php 
                        if ($idCategoria > 0) { 
                            $Mproducto = $producto->FiltrarPorCategoria($idCategoria, $ordenPrecio);
                        } 

                    while($line = mysql_fetch_array($Mproducto, MYSQL_ASSOC)){
                        $nombreProduct = $line['name']; 
                        $imagen        = $line['url_image'];
                        $precio        = $line['price'];
                        $descuento     = $line['discount'];
                    ?>                   
                        <div class="col card-group mb-3" >
                            <div class="card shadow">
                                <?php $num++; ?>      
                                <img src="<?php echo $imagen; ?>" class="rounded mx-auto d-block" alt="..." width="150" height="150" >
                                <div class="card-body lh-1">                                                                 
                                    <p class="lh-1"> <?php echo $nombreProduct; ?></p>
                                    <?php
                                    if ($descuento == 0) {
                                        echo '<span class="fw-bold">'. '$ ',$precio.'</span><br>';   
                                    }
                                    elseif ($descuento != 0) { 
                                        $DescPeso = $precio/100 * $descuento; ?>                                      
                                        <span class="text-decoration-line-through">$ <?php echo $precio; ?> </span><br>
                                        <span class="fw-bold text-danger"> $ <?php echo $precio-$DescPeso; ?> </span> 
                                <?php } ?>

                                </div>
                            </div>
                        </div>
                    <?php } } ?>
                       
                    </div>
                </div>
            </div>
        </div>
        
    </body>
</html>
<script>
    var timer = setTimeout(function(){
        var Total = <?php echo $num ?>-1;
        var loadingText = document.querySelector('#Ncard');
        loadingText.innerText = Total + ' encontrados';
    }, 10);
</script>