<?php 

session_start();

require '../vendor/autoload.php';

$id = obtener_get('id');
$cantidad = obtener_get('cantidad');
$cantidad++;

$pdo = conectar();
$sent = $pdo->prepare('UPDATE noticias SET cantidad = :cantidad WHERE id = :id');
$sent->execute([':id' => $id, ':cantidad' => $cantidad]);
return volver();