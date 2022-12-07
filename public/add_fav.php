<?php
session_start();

require '../vendor/autoload.php';

$noticia = obtener_get('id');
$usuario = obtener_get('usuario');

var_dump($noticia, $usuario);

$pdo = conectar();
$sent = $pdo->prepare('INSERT INTO favoritos VALUES (:usuario, :noticia)');
$sent->execute([':usuario'=>$usuario,':noticia'=>$noticia]);

return header('Location: /favoritos.php');