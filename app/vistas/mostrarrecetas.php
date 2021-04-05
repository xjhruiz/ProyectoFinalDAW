<?php  
				
		function getRecetasApi( $busqueda){
			$busqueda= str_replace(' ','+',$busqueda); 
		$APPID="1d7650dd";
        $APIKEY="76cd55584e94004892c0129825c87a27";
        $URLAPI = "https://test-es.edamam.com/search?q=$busqueda&app_id=$APPID&app_key=$APIKEY";
		$urlapiJson=file_get_contents($URLAPI);
		$urlapi_array= json_decode($urlapiJson,true);
		$resultado=$urlapi_array['to']; 
			if($resultado>1){
				return $urlapi_array;	
			}else{
				return null;
			}
		}
			if(isset($_GET['recetaBuscar']) && getRecetasApi($_GET['recetaBuscar'])!=null){
			getRecetasApi($_GET['recetaBuscar']);
			$urlapi_array = getRecetasApi($_GET['recetaBuscar']);
		}



?>
 <div class="container">
     <div class="row">
         <div class="col-md-3">
             <div class="well"><strong class="ng-binding">Recetas encontradas: <?php 
			
			if(isset( $urlapi_array)){
				echo $urlapi_array['to'];
			}
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
			
		if(isset( $urlapi_array)){
				$recetas = $urlapi_array['hits'];
			
			foreach ($recetas as $receta){
				$urlrecetasitio=$receta['recipe']['url'];
				$tituloReceta= $receta['recipe']['label'];
				$imagenreceta = $receta['recipe']['image'];
					$imgerror="'img/img404.png'";
				$sitioreceta = $receta['recipe']['source'];
				 echo "<div id='contimgerror' class=' col-md-6 contimg'>
                                 <h4>".$tituloReceta."</h4>
                                 <div class='card card-default'>
                                     <a href='".$urlrecetasitio."' class='card-link'>
                                         <span class='card-img'>";
										 ?>
										 
                                             <img src="<?php echo $imagenreceta ;?>"class="img-responsive img404" onerror="this.src='img/img404.png'" >
										<?php	 
                                echo "         </span>
                                         <span class='card-body'>
                                             <span class='h3 heading'>".$sitioreceta."</span><p>Lista de ingredientes</p>";
											 
								foreach($receta['recipe']['ingredientLines'] as $valor){
						echo "<p>".$valor ."</p>";
					}
                                            
                                       echo"  </span>
                                     </a>
                                 </div>


                             </div> ";
				
				
			}
		}else{
			echo "<div class=' mx-auto'>
                                 <h4>Introduzca el título de una receta </h4>
                                 <div class='card  card-nofound'>
                                     <div href='#' class='card-link'>
                                         <span class='card-img'>
                                             <img src='img/imgcard.png' class='img-responsive'>
                                         </span>
                                         <span class='card-body'>
                                             <span class='h3 heading'> Bienvenido busca una receta</span>
                                             <p>  </p>
                                         </span>
                                     </div>
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

