<?php
session_start();
require '../vendor/autoload.php';

$login = obtener_post('usuario');
$password = obtener_post('password');

if (isset($login, $password)) {
    if ($usuario = \App\Tablas\Usuario::comprobar($login, $password)) {
        $_SESSION['login'] = serialize($usuario);
        return $usuario->es_admin() ? volver_admin() : volver();
    }
}