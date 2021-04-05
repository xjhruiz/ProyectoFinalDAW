<?php   ob_start()  ?>

    <h3><?php echo $params['mensaje'] ?> </h3>
    <h3> <?php echo $params['mensaje2'] ?> </h3>
            <h3> <?php if(isset($params['mensaje_error'])) echo $params['mensaje_error']; ?></h3>
<div class="container">          
 <section class="banner">
        <div class="container text-center">
            <h2 class="title">Comparte tu cocina con todo el mundo</h2>
            <p class="subtitle hidden-xs">¿ Qué te apetece cocinar hoy ?</p>
            <div class="row banner-search-box">
               <form  action="" method="get" class="">
                    <div class="col-md-8 col-sm-8 buscador">
					<input type="text" name="recetaBuscar" placeholder="Buscar receta..."  title="Introduzca un título" class="form-control input-lg search-first "></div>
                    <div class="col-md-4 col-sm-4 buscador"><button type="submit"
                     class="btn btn-custom btn-block btn-lg"><i class="fa fa-search"></i></button>
                     </div>
                </form>
            </div>
        </div>
    </section>
   
    </div>                   
 
    
    <?php include 'mostrarrecetas.php' ?>
    
<?php
if(isset ($params['mensajeok'])){
	   echo   $params['mensajeok'];
   }
 if(isset ($params['mensaje_ok2'])){
	 echo   $params['mensaje_ok2'];
 } 
 if(isset ($params['mensaje_error'])){
	 echo   $params['mensaje_error'];
 } 
 
?>
<?php $contenido = ob_get_clean(); ?>
<?php if(isset($_SESSION['userName'])){?>
<?php include 'cabeceralogado.php' ?>
<?php }else{ ?>
<?php include 'cabecera.php' ?>
<?php }?>
