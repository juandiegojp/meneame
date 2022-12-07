<nav class="bg-white border-gray-200 dark:bg-gray-900">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl px-4 md:px-6 py-2.5">
        <a href="/index.php" class="flex items-center">
            <img src="https://cdn.worldvectorlogo.com/logos/clown-1.svg" class="h-6 mr-3 sm:h-9" alt="Flowbite Logo" />
            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">ClownFactory</span>
        </a>
        <div class="flex items-center">
            <!-- Nombre del ususario -->
            <?php if (\App\Tablas\Usuario::esta_logueado()) : ?>
                <p class="mr-6 text-sm font-medium text-gray-500 dark:text-white">
                    <?= hh(\App\Tablas\Usuario::logueado()->usuario) ?>
                </p>
            <?php endif ?>
            <!-- Modal toggle -->
            <?php if (!\App\Tablas\Usuario::esta_logueado()) : ?>
                <button class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button" data-modal-toggle="login">
                    Login
                </button>
            <?php else : ?>
                <a href="/logout.php" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                    Logout
                    <svg aria-hidden="true" class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </a>
            <?php endif ?>
        </div>
    </div>
</nav>