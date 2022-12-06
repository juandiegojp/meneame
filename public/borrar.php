<?php
session_start();
require '../vendor/autoload.php';

$id = obtener_post('id');

if (!isset($id)) {
    return volver();
}

$pdo = conectar();
$sent = $pdo->prepare("DELETE FROM noticias WHERE id = :id");
$sent->execute([':id' => $id]);

header('Location: /dashboard.php');