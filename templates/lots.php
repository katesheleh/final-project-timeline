<div class="container space-bottom">
    <h1 class="main-title">Categoría <span>«<?= htmlspecialchars($currentCategoryData['name']) ?>»</span></h1>
    <?php if (count($lots) === 0) : ?>
    <p>No hay productos en esta categoría por ahora</p>
    <?php endif ?>
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
            <a href="<?= htmlspecialchars($helpers -> updatePageNumber($currentPage > 1 ? $currentPage - 1 : 1)) ?>">
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
                Siguiente
            </a>
        </li>
    </ul>
    <?php endif ?>

</div>