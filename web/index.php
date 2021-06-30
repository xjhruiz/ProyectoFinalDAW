<?php
header("Access-Control-Allow-Origin: *");

//para cargar ficheros de otras rutas lo mejor es require 
//diferencias entre require y require_once => require_once actualización de require. Sólo carga el fichero una vez y si ya se ha cargado no lo carga otra vez

//mejor usar require  tuto lo usa
require __DIR__ . '/../app/Config.php';
require __DIR__ . '/../app/Modelo.php';
require __DIR__ . '/../app/Controlador.php';
//Enrutamiento de las funcionalidades

//TODO: LIST
//migrar a php 7: esta en php 5.6 para que funcione en hosting
//incluir auth en la sesión
//migrar a microservicios con docker
//usar PHPUnit
//
//Rutas de acceso mejor así o usar alternativa tuto
$map = array(
    'inicio' => array('controlador' => 'Controlador', 'action' => 'inicio'),
    'formContacto' => array('controlador' => 'Controlador', 'action' => 'mostrarFormContacto'),
    'formRegistro' => array('controlador' => 'Controlador', 'action' => 'mostrarFormRegistro'),
    'login' => array('controlador' => 'Controlador', 'action' => 'login'),
    'cerrarSesion' => array('controlador' => 'Controlador', 'action' => 'salir'),
    'buscarReceta' => array('controlador' => 'Controlador', 'action' => 'getRecetaApi'),
    'publicarReceta' => array('controlador' => 'Controlador', 'action' => 'formPublicarReceta'),
    'recetasUsuarios' => array('controlador' => 'Controlador', 'action' => 'getRecetaUser'),
    'eliminarReceta' => array('controlador' => 'Controlador', 'action' => 'eliminarReceta'),
);
session_start();

$url = strtok($_SERVER['REQUEST_URI'], '?');
echo $url;

// Parseo de la ruta
//si existe un parámetro que sea ctl en la url 
if (isset($_GET['ctl'])) {
    if (isset($map[$_GET['ctl']])) {
        $ruta = $_GET['ctl'];
    } else {
        header('Status: 404 Not Found');
        echo '<html><body><h1>Error 404: No existe la ruta <i>' .
            $_GET['ctl'] .
            '</p></body></html>';
        exit;
    }
} else {
    $ruta = 'inicio';
}
$controlador = $map[$ruta];

if (method_exists($controlador['controlador'], $controlador['action'])) {
    call_user_func(array(new $controlador['controlador'], $controlador['action']));
} else {

    header('Status: 404 Not Found');
    echo '<html><body><h1>Error 404: El controlador <i>' .
        $controlador['controlador'] .
        '->' .
        $controlador['action'] .
        '</i> no existe</h1></body></html>';
}
