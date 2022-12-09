<?php session_start() ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.4/dist/flowbite.min.css" />
    <link href="/css/output.css" rel="stylesheet">
    <title>Registro</title>
</head>

<body>
    <?php
    require_once '../vendor/autoload.php';

    $registro = obtener_post('registro');
    $password = obtener_post('password');

    $clases_label = '';
    $clases_input = '';
    $error = false;

    if (isset($registro, $password)) {
        if ($usuario = App\Tablas\Usuario::comprobar_registro($registro, $password)) {
            $_SESSION['exito'] = '¡Cuenta creada con éxito. Ahora puedes loguearte en nuestra web!';
            // Loguear al usuario
            //$_SESSION['login'] = serialize($usuario);
            return volver();
        } else {
            // Mostrar error de validación
            $error = true;
            $clases_label = "text-red-700 dark:text-red-500";
            $clases_input = "bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500 dark:bg-red-100 dark:border-red-400";
        }
    }
    ?>
    <div class="container mx-auto">
        <?php require '../src/_nav.php' ?>
        <div class="mx-72">
            <form action="" method="POST">
                <div class="mb-6">
                    <label for="registro" class="block mb-2 text-sm font-medium <?= $clases_label ?>">Nombre de usuario</label>
                    <input type="text" name="registro" id="registro" class="border text-sm rounded-lg block w-full p-2.5 <?= $clases_input ?>">
                    <?php if ($error) : ?>
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-bold">¡Error!</span> Nombre de usuario o contraseña incorrectos</p>
                    <?php endif ?>
                </div>
                <div class="mb-6">
                    <label for="password" class="block mb-2 text-sm font-medium <?= $clases_label ?>">Contraseña</label>
                    <input type="password" name="password" id="password" class="border text-sm rounded-lg block w-full p-2.5  <?= $clases_input ?>">
                </div>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Registrar</button>
            </form>
        </div>
    </div>
    <script src="https://unpkg.com/flowbite@1.5.4/dist/flowbite.js"></script>
</body>

</html>