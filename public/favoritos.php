<?php session_start() ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.4/dist/flowbite.min.css" />
    <link href="/css/output.css" rel="stylesheet">
    <title>Portal</title>
</head>

<body>
    <?php
    require '../vendor/autoload.php';
    require '../src/_nav.php';
    require '../src/_login.php';
    $pdo = conectar();
    $sent = $pdo->query('SELECT * FROM favoritos f 
                        JOIN usuarios u ON f.id_usuarios = u.id
                        JOIN noticias n ON f.id_noticias = n.id;
                        ');
    /* u  ORDER BY n.cantidad DESC */
    ?>
    <div class="flex flex-col space-y-4 justify-center items-center">
        <?php foreach ($sent as $filas) : ?>
            <div class="w-1/2 p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                <p>
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                <?= $filas['titular'] ?>
                </h5>
                </p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                    <?= $filas['usuario'] ?>
                </p>
            </div>
        <?php endforeach; ?>
    </div>

    <script src="https://unpkg.com/flowbite@1.5.4/dist/flowbite.js"></script>
</body>

</html