<?php
session_start();
require '../vendor/autoload.php';

$id = obtener_post('id');
$titular = obtener_post('titular');

var_dump($id, $titular);

$pdo = conectar();
$sent = $pdo->prepare("UPDATE noticias
SET titular = :titular
WHERE id = :id");
$sent->execute([
    ':id' => $id,
    ':titular' => $titular
]);

return header('Location: /dashboard.php');