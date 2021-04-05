<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
       <title>Document</title> 
    <meta name="description" content="">
    <meta name="" content="">
    <!--- Estilos importantes -->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  
     <!-- Estilos pagina  -->
	  <link rel="stylesheet" href="css/header.css"  media="screen">
       <link rel="stylesheet" href="css/footer.css"  media="screen">
       <link rel="stylesheet" href="css/contacto.css"  media="screen">
       <link rel="stylesheet" href="css/registro.css"  media="screen">
       <link rel="stylesheet" href="css/contenidoprincipal.css"  media="screen">
       <link rel="stylesheet" href="css/mostrarrecetas.css"  media="screen">
      <!--Estilos pruebas--> 
       <!--<link rel="stylesheet" href="../../web/css/header.css"  media="screen">
       <link rel="stylesheet" href="../../web/css/footer.css"  media="screen">
       <link rel="stylesheet" href="../../web/css/contacto.css"  media="screen">-->
<script type="text/javascript">
	
	$(document).on("click", ".navbar-right .dropdown-menu", function(e){
		e.stopPropagation();
	});
    
$(document).ready(function (){
				$('.btnEliminar').click(function (evento){
			confirmar = confirm('¿Desea eliminar esta receta ?');
			if(confirmar==false){
				evento.preventDefault();
			}else{
				
			}})
			})
    
</script>
</head>
<!-- Nav -->
    <header >
       <nav class=" navbar-fixed-top navbar navbar-default navbar-expand-md navbar-light barra-menu">
       <div class="container">
	<div class="navbar-header  col ml-auto">
		<a class="navbar-brand" href="index.php?ctl=inicio">Comparte tu <b>Cocina</b></a>  		
		<button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle navbar-toggler ml-auto">
			<span class="navbar-toggler-icon"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
	</div>
	
	<div id="navbarCollapse" class="collapse navbar-collapse justify-content-start barMenu">
		<ul class="nav navbar-nav navbar-right ml-auto">
		    <li class="nav-item mgLe"><a href="index.php?ctl=formContacto" class="nav-link option">Contáctanos</a></li>
			<li class="nav-item">
				<a  type="button" data-toggle="dropdown" class="btn btn-primary get-started-btn  mt-1 mb-1 dropdown-toggle" href="#"><?php echo "Perfil {$_SESSION['userName']}  ";?><span class="caret"></span></a>
				<ul class="dropdown-menu optionLog">					
					<li class="optionP"><a class="receta" href="index.php?ctl=publicarReceta"><i class="fas fa-plus"></i>Publicar Receta</a></li>
					<li class="optionP" ><a  class="" href="index.php?ctl=recetasUsuarios"><i class="fas fa-search"></i>Buscar Receta de los usuarios</a></li>
					<li class="divider"></li>
					<li class="optionC"><a class="" href="index.php?ctl=cerrarSesion">Cerrar sesión</a></li>
				</ul>
			</li>
		</ul>
	</div>
	</div>
</nav>

</header>
<body>
<div class="container contenidoMain">


	<?php echo $contenido;
if(isset ($params['exito'])){
	 echo   $params['exito'];
 }
 if(isset ($params['mensajeErrorReceta'])){
	 echo   $params['mensajeErrorReceta'];
 }
	?>
	
</div>
	<?php include 'footer.php'; ?>
	
	
</body>

</html>