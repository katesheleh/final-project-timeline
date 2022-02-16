<div class="banner banner-top">
    <div class="container">
        <h2 class="banner-title">Timeline</h2>
        <p class="attention-text">Plataforma online con subastas en línea. <br />Aqui encontrarás lo que buscas
        </p>
        <ul>
            <?php foreach ($categories as $category): ?>
            <li>
                <a class="a" href="lots.php?category=<?= htmlspecialchars($category['tech_value']) ?>">
                    <?= htmlspecialchars($category['name']) ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<div class="container">
    <h1 class="main-title">Últimos productos añadidos</h1>

    <div class="cards">
        <?php foreach ($lots as $lot) : ?>
        <a class="single-card" href="lot.php?id=<?= htmlspecialchars($lot['id']) ?>">

            <img class="card-image" src="uploads/<?= htmlspecialchars($lot['image']) ?>"
                alt="<?= htmlspecialchars($lot['name']) ?>">

            <div class="card-content">
                <span class="card-subtitle"><?= htmlspecialchars($lot['cat_name']) ?></span>
                <h3 class="card-title"><?= htmlspecialchars($lot['name']) ?></h3>

                <div class="card-details">
                    <div class="card-price">
                        <p class="card-subtitle">Precio inicial</p>
                        <p class="card-price-value">
                            <?= htmlspecialchars($helpers -> formatPrice($lot['init_price'])) ?></p>
                    </div>

                    <?php $expirationDate = $helpers -> getTimeLeft($lot['expire_date']) ?>

                    <div
                        class="timer <?= $expirationDate['days'] < 1 && $expirationDate['hours'] < 1 && $expirationDate['minutes'] < 1 ? 'card-expiring' : ''?>">
                        Cierra en<br />
                        <?= $expirationDate['days'] . ' d : ' . $expirationDate['hours'] . ' h : ' . $expirationDate['minutes'] . ' min' ?>
                    </div>
                </div>
            </div>
        </a>
        <?php endforeach; ?>
    </div>
</div>

<div class="banner banner-bottom">
    <div class="container">
        <h2 class="banner-title">Empieza ya!</h2>
        <p class="attention-text">Ha llegado la hora :)
        </p>
        <ul class="promo__list">
            <li>
                <a class="a" href="registration.php">Regístrate</a>
            </li>
            <li>
                <a class="a" href="login.php">Iniciar sesión</a>
            </li>
        </ul>
    </div>
</div>
