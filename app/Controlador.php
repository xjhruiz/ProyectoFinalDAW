<?php
class Controlador{
	
	public function inicio(){
         $params = array(
             'mensaje' => "",
			 'mensaje2' => "",
         );
       
         require __DIR__ . '/vistas/contenidoPrincipal.php';
     }
	
	public function mostrarFormContacto(){
		
		 require __DIR__ . '/vistas/formContacto.php';
	}
	
	public function formPublicarReceta(){
		$n= ModeloSingleton::singleton();
		if(isset ($_POST['btnPublicarReceta'])){
			$validacion = $n->validarDatosReceta($_POST['r_Titulor'],$_FILES['r_Imgr'],$_POST['r_tiempoR'],$_POST['r_ingreR'],$_POST['r_pasosR']);
			$imgFile = $_FILES['r_Imgr']['name'];
				$tmp_dir= $_FILES['r_Imgr']['tmp_name'];
				$imgSize= $_FILES['r_Imgr']['size'];
			if($validacion == null){
				//Cargamos directorio para guardar imagenes en DB
				$carga_dirImag = __DIR__ . '/imgDB/';
				//obtenemos la extension img
				$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION));
				//comprobamos que se acepten solo jgp png jpeg 
				$valid_extensions = array('jpeg', 'jpg', 'png');
				//renombramos le imagen cargada
				$userpic = rand(1000,1000000).".".$imgExt;
				//comprobamos el formato
				if(in_array($imgExt, $valid_extensions)){			
				// comprobamos el tamaño 
					if($imgSize < 1000000){
					move_uploaded_file($tmp_dir,$carga_dirImag.$userpic);
					$n->publicarReceta($_POST['r_Titulor'],$userpic,$_POST['r_tiempoR'],$_POST['r_ingreR'],$_POST['r_pasosR'],$_SESSION['userName']);	
					}else{
					echo '<script type="text/javascript">alert("Su archivo es muy grande.!")</script>';
					}
				}else{
				echo '<script type="text/javascript">alert("Solo archivos JPG, JPEG, PNG & GIF son permitidos!")</script>';	
				}
			}else{
				echo  '<script type="text/javascript">alert("Compruebe que haya introducido todos los datos!")</script>';
			}
			if(!isset($params['mensajeErrorReceta'])){	
				if($n){
					echo  '<script type="text/javascript">alert("Receta insertada correctamente!")</script>';	
					header('Refresh:3; url=index.php?ctl=recetasUsuarios');		
				}
			}
		}
		require __DIR__ . '/vistas/formPublicarReceta.php';
	}
	
	public function eliminarReceta(){
		if(isset($_GET['idRecetaDelete'])){
			$n= ModeloSingleton::singleton();
			$idReceta=$_GET['idRecetaDelete'];
			$receta = $n->getNombreImgBorarIMGDB($idReceta);
				if($receta['recetaId'] ==$idReceta){
					$nombreRecetaAeliminarIMGDB=$receta['imgReceta'];
					echo $nombreRecetaAeliminarIMGDB;
					unlink( __DIR__ . "/imgDB/".$nombreRecetaAeliminarIMGDB);
				}
			$n->eliminarRecetaUser($idReceta);
			if($eliminado = $n->eliminarRecetaUser($idReceta)){
			header("Refresh:3; url=index.php?ctl=recetasUsuarios");
		 }
		}
	}
	
	public function getRecetaApi(){
		$n= ModeloSingleton::singleton();
		if (isset($_GET['recetaBuscar'])){	
			$resultado = $n->getReceta($_GET['recetaBuscar']);
	 require __DIR__ . '/vistas/mostrarrecetas.php';
 }else{
	 header('Location:index.php');
 }		
	}
	
	public function getRecetaUser(){
		$n= ModeloSingleton::singleton();
			$params = array('recetasUserDB' => $n->verRecetasUsuarios(),
							'numRecetas'	=>0,
			);
		require __DIR__ . '/vistas/mostrarrecetasuser.php';
	}
	
	public function mostrarFormRegistro(){
		$params = array(
             'name' => '',
             'userName' => '',
             'email' => '',
             'password' => '',
             'country' => '',
             'city' => '',
         );
		$n= ModeloSingleton::singleton();
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
             if ($n->validarDatos($_POST['r_nombreUser'], $_POST['r_username'],
                      $_POST['r_email'], $_POST['r_pass'], $_POST['r_pais'],
                      $_POST['r_city'])) {
						  if(!$n->comprobarUsuarioExistente($_POST['r_username'])){
							  $n->registrarUsuarios($_POST['r_nombreUser'], $_POST['r_username'],
                           $_POST['r_email'], $_POST['r_pass'], $_POST['r_pais'],
                           $_POST['r_city']);
						   $params['mensajeok'] = '<script type="text/javascript">alert("Registrado correctamente !")</script>';
							$_SESSION['userName']="{$_POST['r_username']}";
							$_SESSION['tiempo']=time();
							$_SESSION['expire'] = $_SESSION['tiempo'] + (5* 60);
						   header('Location:index.php');
						   $this->inicio();
						  }else{
							  $params['mensaje'] = '<script type="text/javascript">alert("Ese nombre de usuario ya existe !")</script>'; 
							  $params['mensajeError']="<div class='container'>El nombre de usuario {$_POST['r_username']} ya existe en la base de datos </div> ";  
						  }
             } else {
				 $n->validarDatos($_POST['r_nombreUser'], $_POST['r_username'],
                      $_POST['r_email'], $_POST['r_pass'], $_POST['r_pais'],
                      $_POST['r_city']);
                 $params = array(
                     'nombreUser' => $_POST['r_nombreUser'],
                     'username' => $_POST['r_username'],
                     'email' => $_POST['r_email'],
                     'pass' => $_POST['r_pass'],
                     'pais' => $_POST['r_pais'],
                     'city' => $_POST['r_city'],
                 );
                 $params['mensaje'] = 'No se ha podido registrar';
             }
         }
		 require __DIR__ . '/vistas/formRegistro.php';	
	}
	
	public function  login(){
		$params = array(
           'mensaje' => 'Control de acceso',
           'mensaje_error' => '',
       );
    $entrar = false;
if (isset($_POST['logEmail']) && isset($_POST['logPassword']))
 {
     $exito = $this->ChequearAcceso($_POST['logEmail'],$_POST['logPassword']);
     $entrar = $exito;
if ( !$exito ){
            $params['mensaje_error'] ='<script> alert( Usuario y contraseña no validos); </script>';
         }
     }
     // Si el chequeo ha sido correcto entrar en la página de inicio
     if ($entrar ){
		 $params['mensajeok'] ='<script> alert(Usuario y contraseña  validos); </script>';
     header('Location:index.php');
	 //$this->inicio();
	}else{
          $params['mensajeok']= '<script> alert(Usuario y contraseña incorrectos); </script>';
        header('Location:index.php'); 
     }
       //require __DIR__ .'/vistas/contenido.php';
	}
	
	private function ChequearAcceso($nombre,$usuario){
	$n= ModeloSingleton::singleton();
	$datos = $n->login($nombre,$usuario);
 if (($_POST['logEmail']==$datos["email"])&&($_POST['logPassword']==$datos['password']) ){
				$n=$datos['nombreUser'];
             $_SESSION['userName']="$n";
             $_SESSION['tiempo']=time();
			 $_SESSION['expire'] = $_SESSION['tiempo'] + (5* 60);
             $resu = true;
             }else{
             $resu = false;
             }
 return $resu;
}
	public function salir(){
		session_unset();
		session_destroy();
		header('Location:index.php');
		$this->inicio();
}

}
?>