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
    require '../src/_insertar.php';
    require '../src/_alerts.php';

    use Carbon\Carbon;

    $carrito = unserialize(carrito());

    $pdo = conectar();
    $sent = $pdo->query('SELECT * FROM usuarios u JOIN noticias n ON n.noticias_usuarios = u.id ORDER BY n.id DESC');
    ?>
    <?php if (\App\Tablas\Usuario::esta_logueado()) : ?>
        <nav class="bg-gray-50 dark:bg-gray-700">
            <div class="max-w-screen-xl px-4 py-3 mx-auto md:px-6">
                <div class="flex items-center justify-center">
                    <ul class="flex flex-row mt-0 mr-6 space-x-8 text-sm font-medium items-center">
                        <li>
                            <a href="#" class="text-gray-900 dark:text-white hover:underline" aria-current="page" data-modal-toggle="insertar">Publicar nueva noticia</a>
                        </li>
                        <li>
                            <a href="/dashboard.php" class="text-gray-900 dark:text-white hover:underline">Gestionar noticias</a>
                        </li>
                        <li>
                            <a href="/favoritos.php" class="text-gray-900 dark:text-white hover:underline">Favoritos</a>
                        </li>
                        <li>
                            <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg aria-hidden="true" class="mr-2 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path>
                                </svg>
                                <span class="inline-flex justify-center items-center ml-2 w-4 h-4 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">
                                    <?= $carrito->getTotalItems() ?>
                                </span>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    <?php endif; ?>

    <div class="flex flex-col space-y-4 justify-center items-center mt-2">
        <?php if (!$carrito->vacio()) : ?>
            <aside class="flex flex-col items-center w-1/4" aria-label="Sidebar">
                <div class="overflow-y-auto py-4 px-3 bg-gray-50 rounded dark:bg-gray-800">
                    <table class="mx-auto text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <th scope="col" class="py-3 px-6">Descripción</th>
                            <th scope="col" class="py-3 px-6">Cantidad</th>
                        </thead>
                        <tbody>
                            <?php foreach ($carrito->getLineas() as $id => $linea) : ?>
                                <?php
                                $noticia = $linea->getNoticia();
                                $cantidad = $linea->getCantidad();
                                ?>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="py-4 px-6"><?= $noticia->getTitular() ?></td>
                                    <td class="py-4 px-6 text-center"><?= $cantidad ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <div>
                    <a href="/vaciar_cart.php" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Vaciar carrito</a>
                    <a href="/comprar.php" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-900">Comprar</a>
                </div>
            </aside>
        <?php endif ?>
        <?php foreach ($sent as $filas) : ?>
            <?php $fecha = Carbon::parse($filas['created_at']); ?>
            <div class="w-1/2 p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-between">
                    <div class="flex justify-center items-center">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            <?= $filas['titular'] ?>
                        </h5>
                        <em class="font-normal text-gray-700 dark:text-gray-400 ml-2">
                            <?= $filas['usuario'] ?>
                        </em>
                    </div>
                    <a href="#" class="my-4 text-lg text-gray-500 hover:underline">
                        <?= $fecha->toFormattedDateString(); ?>
                    </a>
                </div>
                <div class="flex justify-between">
                    <a href="/incrementarLikes.php?id=<?= $filas['id'] ?>&cantidad=<?= $filas['cantidad'] ?>">
                        <button class="inline-flex items-center px-2 py-1.5 text-gray-800 bg-gray-100 border border-gray-200 rounded-lg dark:bg-gray-600 dark:text-gray-100 dark:border-gray-500">
                            <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                <path d="M9.39 265.4l127.1-128C143.6 131.1 151.8 128 160 128s16.38 3.125 22.63 9.375l127.1 128c9.156 9.156 11.9 22.91 6.943 34.88S300.9 320 287.1 320H32.01c-12.94 0-24.62-7.781-29.58-19.75S.2333 274.5 9.39 265.4z" />
                            </svg>
                            <span class="sr-only">Arrow key up</span>
                        </button>
                    </a>
                    <p><?= $filas['cantidad'] ?></p>
                    <a href="/decrementarLikes.php?id=<?= $filas['id'] ?>&cantidad=<?= $filas['cantidad'] ?>">
                        <button class="inline-flex items-center px-2 py-1.5 text-gray-800 bg-gray-100 border border-gray-200 rounded-lg dark:bg-gray-600 dark:text-gray-100 dark:border-gray-500">
                            <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                <path d="M310.6 246.6l-127.1 128C176.4 380.9 168.2 384 160 384s-16.38-3.125-22.63-9.375l-127.1-128C.2244 237.5-2.516 223.7 2.438 211.8S19.07 192 32 192h255.1c12.94 0 24.62 7.781 29.58 19.75S319.8 237.5 310.6 246.6z" />
                            </svg>
                            <span class="sr-only">Arrow key down</span>
                        </button>
                    </a>
                    <a href="/add_cart.php?id=<?= $filas['id'] ?>" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Comprar
                        <svg aria-hidden="true" class="ml-3 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                    <a href="add_fav.php?id=<?= $filas['id'] ?>&usuario=<?= $filas['noticias_usuarios'] ?>" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-pink-700 rounded-lg hover:bg-pink-800 focus:ring-4 focus:outline-none focus:ring-pink-300 dark:bg-pink-600 dark:hover:bg-pink-700 dark:focus:ring-pink-800">
                        &hearts;
                    </a>
                </div>

            </div>
        <?php endforeach; ?>
    </div>

    <script src="https://unpkg.com/flowbite@1.5.4/dist/flowbite.js"></script>
</body>

</html