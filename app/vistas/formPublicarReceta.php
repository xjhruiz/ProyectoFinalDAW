<?php ob_start() ?>  

   <section class="main">
   <script>  </script>
    <div class="container">
        <div class="row">
            <div class="col-sm-5 login-form">
                <div class="panel panel-default">
                    <div class="panel-intro text-center">
                        <h1 class="logo text-uppercase"><i class="fas fa-pencil-alt"></i> Publicar nueva receta </h1>
                    </div>
                    <div class="panel-body">
                        <form action="index.php?ctl=publicarReceta" method="POST" class="" enctype="multipart/form-data">
                            <div class="form-group"><label for="r_Titulor">Título Receta</label><input name="r_Titulor" type="text" placeholder="Título de la receta"  required="" class="form-control input-lg"></div>
                            <div class="form-group"><label for="r_Imgr">Imágen Receta</label><input name="r_Imgr" type="file" placeholder="Busque una imagen de su receta" required="" class="form-control input-lg" accept="image/*">
							<input name="user" value="<?php if(isset($_SESSION['userName'])) echo $_SESSION['userName']?>" type="hidden">
							</div>
                            <div class="form-group"><label for="r_tiempoR">Tiempo de preparación </label><input name ="r_tiempoR" id="r_tiempoR" type="text"  required="" class="form-control input-lg"></div>
                            <div class="form-group"><label for="r_ingreR">Ingredientes de la receta </label><input name ="r_ingreR" id="r_ingreR" type="text"  required="" class="form-control input-lg"></div>
                            <div class="form-group"><label for="r_pasosR">Pasos a seguir </label><input name ="r_pasosR" id="r_pasosR" type="text"  required="" class="form-control input-lg"></div>
                            <div class="form-group"><button  name="btnPublicarReceta" type="submit" class="btn btn-block btn-custom"><i class="fas fa-save"></i> Publicar receta</button>
                            <button   type="reset" class="btn btn-block btn-custom"><i class="fas fa-times-circle"></i> Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $contenido = ob_get_clean();?>
<?php if(isset($_SESSION['userName'])){?>
<?php include 'cabeceralogado.php' ;
                                      } 
?>
