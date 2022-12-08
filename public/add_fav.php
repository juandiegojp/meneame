<?php
session_start();

require '../vendor/autoload.php';

$noticia = obtener_get('id');
$usuario = obtener_get('usuario');

var_dump($noticia, $usuario);
if (App\Genérico\Favoritos::comprobar($noticia)) {
    $_SESSION['error'] = 'Error: No puedes guardar dos veces la misma noticia.';
    return volver();
}

$pdo = conectar();
$sent = $pdo->prepare('INSERT INTO favoritos VALUES (:usuario, :noticia)');
$sent->execute([':usuario'=>$usuario,':noticia'=>$noticia]);
$_SESSION['exito'] = 'Noticia añadida con éxito.';
return volver();