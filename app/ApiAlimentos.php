<?php     


		function getRecetasApi( $busqueda){
			
		$APPID="1d7650dd";
        $APIKEY="76cd55584e94004892c0129825c87a27";
        $URLAPI = "https://test-es.edamam.com/search?q=".urlencode($busqueda)."&app_id=$APPID&app_key=$APIKEY";
		
		$urlapiJson=file_get_contents($URLAPI);
		$urlapi_array= json_decode($urlapiJson,true);
		// var_dump($urlapi_array);
		//$resultado=$urlapi_array['count']; numero de recetas
		//echo "$resultado";
		$resultado=$urlapi_array['count']; 
			if($resultado>1){
				return $urlapi_array;
				/*$recetas = $urlapi_array['hits'];
				foreach ($recetas as $receta){
					echo $receta['recipe']['url']."<br>";
					echo $receta['recipe']['label']."<br>";
					echo $receta['recipe']['image']."<br>";
					echo $receta['recipe']['source']."<br>";
					foreach($receta['recipe']['dietLabels'] as $valor){
						echo "Rico en ".$valor."<br>";
					}
					foreach($receta['recipe']['ingredientLines'] as $valor){
						echo "Lista de ingrediente ".$valor ."<br>";
					}
					echo"<hr>";
				}*/
				
			}else{
				//echo "No se han encontrado recetas";
				return null;
			}
		
		
		
		
		
		}
		

		function pintarRecetas(){
			$urlapi_array = getRecetasApi($_GET['recetaBuscar']);
			echo $urlapi_array['to'];	
		}
		pintarRecetas();
		
		?> 
				<form method="GET">
                    <input type="text" name="recetaBuscar"> 
					<button type="submit"> Buscar </button>
                </form>