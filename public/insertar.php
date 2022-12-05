<?php 

require '../vendor/autoload.php';

$usuario = obtener_post('usuario');
$titular = obtener_post('titular');

$pdo = conectar();
$sent = $pdo->prepare('INSERT INTO noticias (titular, cantidad, noticias_usuarios) VALUES (:titular, DEFAULT, :usuario)');
$sent->execute(['usuario' => $usuario, ':titular' => $titular]);

return volver();