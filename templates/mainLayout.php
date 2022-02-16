<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <link href="./css/style.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&family=Roboto:wght@300;400;500;700;900&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="main-wrap">

        <aside class="mobile-menu close-mobile-menu" id="mobile-menu">
            <?php if ($isUserAuth === true) : ?>
            <a class="button" href="addLot.php">Añadir producto</a>
            <?php endif ?>

            <nav class="categories-list">
                <ul class="container">
                    <?php foreach ($categories as $category): ?>
                    <li>
                        <a href="lots.php?category=<?= htmlspecialchars($category['tech_value']) ?>">
                            <?= htmlspecialchars($category['name']) ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </nav>

            <form class="search-form" action="searchProduct.php" method="get">
                <input type="search" name="search" placeholder="Buscar productos"
                    value="<?= htmlspecialchars(isset($_GET['search']) ? $_GET['search'] : ''); ?>">

                <input class="search-button" type="submit" name="find" value="Buscar">
            </form>

        </aside>

        <header>
            <div class="container header-wrap">

                <a class="company-logo" href="/timeline">
                    <img src="./img/logo.png" height="70" alt="Logo Timeline">
                </a>

                <form class="search-form" action="searchProduct.php" method="get">
                    <input type="search" name="search" placeholder="Buscar productos"
                        value="<?= htmlspecialchars(isset($_GET['search']) ? $_GET['search'] : ''); ?>">

                    <input class="search-button" type="submit" name="find" value="Buscar">
                </form>

                <?php if ($isUserAuth === true) : ?>
                <a class="header-btn button" href="addLot.php">Añadir producto</a>
                <?php endif ?>

                <nav class="user-menu">
                    <?php if ($isUserAuth === true) : ?>
                    <div class="user-information">
                        <p><?= $currentUserName ?></p>
                        <a href="myProfile.php">Mi perfil</a>
                        <a href="logout.php">Cerrar la sesión</a>
                    </div>

                    <?php else: ?>
                    <ul class="login-menu">
                        <li><a href="registration.php">Regístrate</a></li>
                        <li><a href="login.php">Iniciar sesión</a></li>
                    </ul>
                    <?php endif ?>

                </nav>
                <button class="button mobile-menu-controller" id="mobile-menu-controller">X</button>
            </div>
        </header>

        <main>
            <nav class="categories-list">
                <ul class="container">
                    <?php foreach ($categories as $category): ?>
                    <li>
                        <a href="lots.php?category=<?= htmlspecialchars($category['tech_value']) ?>">
                            <?= htmlspecialchars($category['name']) ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </nav>

            <!-- Dynamic Page Content -->
            <?= $htmlMainContent ?>
        </main>
    </div>

    <footer>
        <div class="container footer-wrap">
            <a href="/timeline"><img src="./img/logo-no-word.png" height="50" alt="Logo Timeline"></a>
            <p>© 2021 Created by Katsiaryna Sheleh</p>
            <button id="scrollToTop" class="button">Ir arriba</button>
        </div>
    </footer>
    <script src="./js/script.js"></script>
</body>

</html>
