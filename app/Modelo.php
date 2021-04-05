<?php
class ModeloSingleton extends Config{
	private $db;
	private $filas = array();
	private static $instancia;
	//Constructor patronSingleton privado evita la creación de objetos fuera de la clase y ahora recursos
	private function __construct (){
		$dbhost=(Config::$mvc_bd_hostname);
		$dbname=Config::$mvc_bd_nombre;
		$dbuser=Config::$mvc_bd_usuario;
		$dbpass=Config::$mvc_bd_clave;
		try{
			$this-> db= new PDO("mysql:host=".$dbhost.";port=33065;dbname=".$dbname.";charset=utf8",$dbuser,$dbpass);
		}catch(PDOException $e){
			die("¡Error en la conexion ! " .$e->getMessage());
		}
	}
	//método singleton que crea instancia si no está creada
	public function singleton(){
		if(!isset(self::$instancia)){
			$miclase=__CLASS__;
			self::$instancia= new $miclase;
		}
		return self::$instancia;
	}
	// Evita que el objeto se pueda clonar
	public function __clone(){
		trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR); 
	}
	// Cierra conexión asignándole valor null
	public function __destroy(){
		$this->db=null;
	}
	//Funcionalidad Registro Usuarios
	public function registrarUsuarios($nomApe, $nomUser,$email,$password,$pais,$ciudad){
		 $nomApe = htmlspecialchars($nomApe);
         $nomUser = htmlspecialchars($nomUser);
         $email = htmlspecialchars($email);
         $password = htmlspecialchars($password);
         $pais = htmlspecialchars($pais);
         $ciudad = htmlspecialchars($ciudad);
		 
		 $sql= "insert into usuarios (nombreApe, nombreUser, email, password, pais, ciudad) values(?,?,?,?,?,?)";
		try{
				$consulta = $this->db->prepare($sql);
				
			  $consulta->bindParam(1,$nomApe, PDO::PARAM_STR);
			   $consulta->bindParam(2,$nomUser, PDO::PARAM_STR);
			    $consulta->bindParam(3,$email,PDO::PARAM_STR);
				 $consulta->bindParam(4,$password,PDO::PARAM_STR);
				  $consulta->bindParam(5,$pais,PDO::PARAM_STR);
				   $consulta->bindParam(6,$ciudad,PDO::PARAM_STR);
				$consulta->execute();
			}catch(PDOException $e){
				die("Error al ejecutar la consulta :" . $e->getMessage());
			}
         return $consulta;
	}
	//Funcionalidad del Registro de usuarios comprueba que el nombre de usuario no esté ya registrado
	public function comprobarUsuarioExistente($nomUser){
		 $id = htmlspecialchars($nomUser);
		 $sql="select * from usuarios where nombreUser = :user";
		 try{
		 $consulta = $this->db->prepare($sql);
		 $consulta ->execute([':user'=>$nomUser]);
		 }catch(PDOException $e){
			 die("Error al ejecutar la consulta :" . $e->getMessage());
		 }
		 if($consulta ->rowCount() >0){
			 return true;
		 }else{
			 return false;
		 }
	}
	//Comprueba que el usuario esté en la base de datos
	public function login($mail, $pass){
		 $mail = htmlspecialchars($mail);
		 $pass = htmlspecialchars($pass);
         $sql = "select * from usuarios where email = :email and password = :pass ";
		 try{
		 $consulta = $this->db->prepare($sql);
		$consulta->bindParam('email',$mail, PDO::PARAM_STR);
		$consulta->bindParam('pass',$pass, PDO::PARAM_STR);
		 $consulta->execute();
		 $row = $consulta->fetch(PDO::FETCH_ASSOC);
		 }catch(PDOException $e){
			  die("Error al ejecutar la orden :" . $e->getMessage());
		  }
			return $row;
		
	}
	//Comprueba que los datos introducidos esté correctamente y que todos sean string
	public function validarDatos($nomApe, $nomUser,$email,$password,$pais,$ciudad){
         return (is_string($nomApe) &
                 is_string($nomUser) &
                 is_string($email) &
                 is_string($password) &
                 is_string($pais) &
                 is_string($ciudad));
     }
	// Petición a la api Edaman
	public function getReceta($recetaBuscar){
		
		$APPID="1d7650dd";
        $APIKEY="76cd55584e94004892c0129825c87a27";
        $URLAPI = "https://test-es.edamam.com/search?q=".urlencode($recetaBuscar)."&app_id=$APPID&app_key=$APIKEY";
		$urlapiJson=file_get_contents($URLAPI);
		$urlapi_array= json_decode($urlapiJson,true);
			return $resultado = $urlapi_array;
		
	}
	//Funcionalidad publicar receta usuarios. Formatos permitidos JPG PNG JPEG Tamaño maximo 1mb
	public function publicarReceta($tituloR,$imgR,$tiempoPreR,$ingredientesR,$pasosR,$usuario){
		 $tituloR = htmlspecialchars($tituloR);
         $tiempoPreR = htmlspecialchars($tiempoPreR);
         $ingredientesR = htmlspecialchars($ingredientesR);
         $pasosR = htmlspecialchars($pasosR);
		  $sql= "insert into recetas (titulo, imgReceta, tiempoPreparacion, ingredientes, pasos,usuario) values(?,?,?,?,?,?)";
		try{
			$consulta = $this->db->prepare($sql);
				
			$consulta->bindParam(1,$tituloR);
			$consulta->bindParam(2,$imgR);
			$consulta->bindParam(3,$tiempoPreR);
			$consulta->bindParam(4,$ingredientesR);
			$consulta->bindParam(5,$pasosR);
			$consulta->bindParam(6,$usuario);
				
			$consulta->execute();
			}catch(PDOException $e){
				die("Error al ejecutar la consulta :" . $e->getMessage());
			}
			return $consulta;
	}
	//Comprueba que ningún dato esté vacío a la hora de publicar una receta.
	public function validarDatosReceta($tituloR,$imgR,$tiempoPreR,$ingredientesR,$pasosR){
		
		if(empty($tituloR)){
			return $mensajeError='Introduzca el título de la receta';
		}else if(empty($tiempoPreR)){
			return $mensajeError="Introduzca el Tiempo de preparación de la receta";
		}else if(empty($ingredientesR)){
			return $mensajeError="Introduzca el ingrediente  de la receta";
		}else if(empty($pasosR)){
			return $mensajeError="Introduzca el paso de la receta";
		}else if(empty($imgR)){
			return $mensajeError="Introduzca la imagen de la receta";
		}else{
			return null;
		}
	}
	//Lista las recetas de los usuarios que han publicado
	public function verRecetasUsuarios(){
		$sql= "select * from recetas order by recetaID desc";
		try{
			$consulta = $this->db->query($sql);
			
			$consulta->execute();
			if($consulta->rowCount()>0){
				while($row=$consulta->fetch(PDO::FETCH_ASSOC)){
					$this->filas[]=$row;
				}
			}
			}catch(PDOException $e){
				die("Error al ejecutar la consulta :" . $e->getMessage());
			}
			return $this->filas;
	}
	//Elimina la receta del usuario que la publicó 
	public function eliminarRecetaUser($idReceta){
		 $idReceta = htmlspecialchars($idReceta);
		 
		 $sqlElimnaReceta='delete from recetas where recetaId= :id';
		 try{
			 $consulta = $this->db->prepare($sqlElimnaReceta);
			 $consulta->bindParam('id',$idReceta,PDO::PARAM_INT);
			 $consulta->execute();
			 
		 }catch(PDOException $e){
			 die("Error al ejecutar la orden :" . $e->getMessage());
		 }
		 return $consulta;
	 }
	 //Funcionalidad que obtiene el nombre de la img del servidor para luego borrarla
	 public function getNombreImgBorarIMGDB($idReceta){
		 
		 $sqlElimnaRecetaIMGDB="select * from recetas where recetaId = :id";
		 try{
			 $consulta = $this->db->prepare($sqlElimnaRecetaIMGDB);
			 $consulta->bindParam('id',$idReceta,PDO::PARAM_INT);
			 $consulta->execute();
			 $imgRow = $consulta->fetch(PDO::FETCH_ASSOC);
			 
		 }catch(PDOException $e){
			 die("Error al ejecutar la orden :" . $e->getMessage());
		 }
		 return $imgRow;
		 
	 }
}
?>