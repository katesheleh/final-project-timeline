<div class="container space-bottom">
    <div class="lots">
        <?php if (count($foundedProducts) === 0) : ?>
        <h1 class="main-title">No se ha encontrado nada para la búsqueda de «<span><?= $textForSearch ?></span>»</h1>

        <?php else: ?>
        <h1 class="main-title">Resultados de la búsqueda de «<span><?= $textForSearch ?></span>»</h1>

        <div class="cards">

            <!-- Lots list -->
            <?php foreach ($foundedProducts as $lot): ?>
            <a class="single-card" href="lot.php?id=<?= htmlspecialchars($lot['id']) ?>">

                <img class="card-image" src="uploads/<?= htmlspecialchars($lot['image']) ?>"
                    alt="<?= htmlspecialchars($lot['name']) ?>">

                <div class="card-content">
                    <span class="card-subtitle"><?= htmlspecialchars($lot['category_name']) ?></span>
                    <h3 class="card-title"><?= htmlspecialchars($lot['name']) ?></h3>

                    <div class="card-details">
                        <div class="card-price">
                            <span class="card-subtitle">Precio inicial</span>
                            <span class="card-price-value">
                                <?= htmlspecialchars($helpers -> formatPrice($lot['init_price'])) ?>
                            </span>
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


        <?php if ($pagesTotal > 1) : ?>
        <ul class="pagination">
            <li>
                <a
                    href="<?= htmlspecialchars($helpers -> updatePageNumber($currentPage > 1 ? $currentPage - 1 : 1)) ?>">
                    Anterior</a>
            </li>

            <?php foreach ($pages as $page) : ?>
            <li>
                <a class="<?= intval($page) === intval($currentPage) ? 'active' : '' ?>"
                    href="<?= htmlspecialchars($helpers -> updatePageNumber($page)) ?>"><?= $page ?></a>
            </li>
            <?php endforeach; ?>

            <li>
                <a
                    href="<?= htmlspecialchars($helpers -> updatePageNumber($currentPage < $pagesTotal ? $currentPage + 1 : $pagesTotal)) ?>">
                    Siguiente</a>
            </li>
        </ul>
        <?php endif ?>

        <?php endif ?>
    </div>

</div>
