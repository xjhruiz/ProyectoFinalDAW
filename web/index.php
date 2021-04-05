<?php
header("Access-Control-Allow-Origin: *");

require_once __DIR__ . '/../app/Config.php';
require_once __DIR__ . '/../app/Modelo.php';
require_once __DIR__ . '/../app/Controlador.php';
//Enrutamiento de las funcionalidades
$map = array(
				'inicio' => array('controlador' => 'Controlador','action' =>'inicio'),
				'formContacto'=> array('controlador' => 'Controlador','action' =>'mostrarFormContacto'),
				'formRegistro'=> array('controlador' => 'Controlador','action' =>'mostrarFormRegistro'),
				'login' => array('controlador' => 'Controlador','action' =>'login'),
				'cerrarSesion' => array('controlador' => 'Controlador','action' =>'salir'),
				'buscarReceta' => array('controlador' => 'Controlador','action' =>'getRecetaApi'),
				'publicarReceta' => array('controlador' => 'Controlador','action' =>'formPublicarReceta'),
				'recetasUsuarios' => array('controlador' => 'Controlador','action' =>'getRecetaUser'),
				'eliminarReceta' => array('controlador' => 'Controlador','action' =>'eliminarReceta'),
			);
session_start();



 // Parseo de la ruta
 if (isset($_GET['ctl']) ) {
     if (isset($map[$_GET['ctl']])) {
         $ruta = $_GET['ctl'];
     } else {
         header('Status: 404 Not Found');
         echo '<html><body><h1>Error 404: No existe la ruta <i>' .
                 $_GET['ctl'] .
                 '</p></body></html>';
         exit;
     }
  
 }else {
     $ruta = 'inicio';
 }
$controlador = $map[$ruta];

if (method_exists($controlador['controlador'],$controlador['action'])) {
     call_user_func(array( new $controlador['controlador'], $controlador['action']));
 } else {

     header('Status: 404 Not Found');
     echo '<html><body><h1>Error 404: El controlador <i>' .
             $controlador['controlador'] .
             '->' .
             $controlador['action'] .
             '</i> no existe</h1></body></html>';
 }

?>