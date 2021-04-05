<?php   ob_start()  ?>

 <div class="container">
 <h1>Bienvenido a las recetas de los usuarios</h1>
     <div class="row">
         <div class="col-md-3">
             <div class="well"><strong class="ng-binding">Recetas encontradas: <?php 
				$numRecetas=$params['numRecetas'];	
			 foreach ($params['recetasUserDB'] as $receta){ $numRecetas++; }
			 echo $numRecetas;
			?></strong></div>
             <div id="accordion" role="tablist" aria-multiselectable="true" class="panel-group">
                 <div class="panel panel-default">
                     <div id="headingThree" role="tab" class="panel-heading">
                         <h4 class="panel-title"><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree">Filtrar busqueda<span aria-hidden="true" class="glyphicon glyphicon-plus pull-right"></span></a></h4>
                     </div>
                     <div id="collapseThree" role="tabpanel" aria-labelledby="headingThree" aria-expanded="true" class="panel-collapse collapse in">
                         <div class="panel-body">
                             <div class="list-group">
                                 <div class="checkbox"><label><input type="checkbox" value=""  class="">Bajo en grasa</label></div>
                                 <div class="checkbox"><label><input type="checkbox" value=""   class="">Sin huevos</label></div>
                                 <div class="checkbox"><label><input type="checkbox" value=""   class="">Vegana</label></div>
                                 <div class="checkbox"><label><input type="checkbox" value=""   class="">Rico en proteinas</label></div>
                                 <div class="checkbox"><label><input type="checkbox" value=""  class="">Vegetariana</label></div>
								 <div class="checkbox"><label><input type="checkbox" value=""  class="">Sin gluten</label></div>
								 <div class="checkbox"><label><input type="checkbox" value=""  class="">Alto en fibra</label></div>
                                <div class="checkbox"><label><input type="checkbox" value=""  class="">Mis recetas</label></div>
                                 
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="col-md-9">
             <div class="well">
                <div class="row contimgerrorP">
                
                <?php
			$userLogado='pepe1234';
		if( count($params['recetasUserDB'])>0){
				$recetas = $params['recetasUserDB'];
			
			foreach ($recetas as $receta){
				$usuarioReceta=$receta['usuario'];
				$tituloReceta= $receta['titulo'];
				$imagenreceta = $receta['imgReceta'];
				 echo "<div id='contimgerror' class=' col-md-6 contimg'>
                                 <h4>".$tituloReceta."</h4>
                                 <div class='card card-default'>
                                     <div class='card-link'>
                                         <span class='card-img'>";
										 ?>
										 
                                             <img src="../app/imgDB/<?php echo $imagenreceta ;?>"class="img-responsive img404" onerror="this.src='img/img404.png'" >
										<?php	 
                                echo "         </span>
                                         <span class='card-body'>
                                             <span class='h3 heading'>".$usuarioReceta."</span>";
                                             if($_SESSION['userName']==$receta['usuario']){
                                               echo" <div ><a name='idRecetaDelete' id='btnEliminar' class='btnEliminar btn btn-danger' href='index.php?ctl=eliminarReceta&idRecetaDelete={$receta['recetaId']}'>
                                               <span class='glyphicon glyphicon-remove-circle'></span>
                                               Eliminar </a></div>"; 
                                             }
                                             
                                             
                                             
                                echo             "<p> Tiempo preparación ".$receta['tiempoPreparacion']."</p><p>Lista de ingredientes</p>";
						echo "<p>".$receta['ingredientes'] ."</p>";
						echo "<p>Pasos a seguir</p>";
						echo "<p>".$receta['pasos'] ."</p>";
					
			                             
                                       echo"  </span>
                                     </div>
                                 </div>


                             </div> ";
				
				
			}
		}else{
			echo "<div class=' mx-auto'>
                                 <h4>No se ha encontrado ninguna receta </h4>
                                 <div class='card card-default'>
                                     <a href='#' class='card-link'>
                                         <span class='card-img'>
                                             <img src='img/imgcard.png' class='img-responsive'>
                                         </span>
                                         <span class='card-body'>
                                             <span class='h3 heading'> Bienvenido busca una receta</span>
                                             <p>  </p>
                                         </span>
                                     </a>
                                 </div>


                             </div> 
                             
                             ";
			
		}	
			
			?>         
                     </div>   
                </div>
             </div>
			 <script>
			 
}
</script>
             
         </div>
         <hr>
     </div>
	 <?php $contenido = ob_get_clean(); ?>

	 
<?php
if(isset($_SESSION['userName']))?>
<?php include 'cabeceralogado.php' ?>