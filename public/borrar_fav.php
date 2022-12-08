<?php

session_start();

require '../vendor/autoload.php';

$id_noticia = obtener_get('id');

$pdo = conectar();
$sent = $pdo->prepare('DELETE FROM favoritos WHERE id_noticias = :id_noticia');
$sent->execute([':id_noticia' => $id_noticia]);

return header('Location: /favoritos.php');