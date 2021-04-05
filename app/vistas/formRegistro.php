
 <?php ob_start() ?>  

   <section class="main">
   <h1><?php   
   if(isset($params['mensajeError'])){
	  echo $params['mensajeError'];
   }
   ?></h1>
   
    <div class="container">
        <div class="row">
            <div class="col-sm-5 login-form">
                <div class="panel panel-default">
                    <div class="panel-intro text-center">
                        <h1 class="logo text-uppercase"><i class="fa fa-user"></i> Registro</h1>
                    </div>
                    <div class="panel-body">
                        <form action="index.php?ctl=formRegistro" method="POST" class="">
                            <div class="form-group"><label for="r_nombreUser">Nombre y apellido:</label><input name="r_nombreUser" type="text" placeholder=""  required="" class="form-control input-lg"></div>
                            <div class="form-group"><label for="r_username">Nombre de usuario:</label><input name="r_username" type="text" placeholder="" required="" class="form-control input-lg"></div>
                            <div class="form-group"><label for="r_email">Correo electrónico:</label><input name ="r_email" id="r_email" type="email"  required="" class="form-control input-lg"></div>
                            <div class="form-group"><label for="r_pass">Contraseña:</label><input id="pass" name="r_pass" type="password" required="" class="form-control input-lg"></div>
                            
                            <div class="form-group"><label for="r_pais">Pais:</label><input name="r_pais" type="text"  required="" class="form-control input-lg"></div>
                            <div class="form-group"><label for="r_city">Ciudad:</label><input id="r_city" name="r_city" type="text"  required="" class="form-control input-lg"></div>
                            <div class="form-group">
                                <div class="checkbox"><label for="terms" class="string optional"><input id="terms" type="checkbox" required="" style=""  class=""><a class="ckTerm" href="#"> Estoy de acuerdo con los términos y condiciones de uso</a></label></div>
                            </div>
                            <div class="form-group"><button  name="btnRegistro" type="submit" class="btn btn-block btn-custom">Registrarse</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $contenido = ob_get_clean();?>
<?php if(isset($_SESSION['userName'])){?>
<?php include 'cabeceraLogado.php' ?>
<?php }else{ ?>
<?php include 'cabecera.php' ?>
<?php }?> 

