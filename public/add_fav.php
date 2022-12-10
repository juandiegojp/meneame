<?php
session_start();

require '../vendor/autoload.php';

$noticia = obtener_get('id');
$usuario = obtener_get('usuario');
$pdo = conectar();

// Si la noticia ya está añadida, muestra mensaje de error y vuelve a home.
if (\App\Generico\Favoritos::comprobar($noticia)) {
    $_SESSION['error'] = 'Noticia borrada de tu lista de favoritos.';
    $sent = $pdo->prepare('DELETE FROM favoritos WHERE id_noticias = :noticia');
    $sent->execute([':noticia' => $noticia]);
    return volver();
}
$sent = $pdo->prepare('INSERT INTO favoritos VALUES (:usuario, :noticia)');
$sent->execute([':usuario'=>$usuario,':noticia'=>$noticia]);
$_SESSION['exito'] = 'Noticia añadida con éxito.';
return volver();