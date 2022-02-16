<div class="container space-bottom">
    <h1 class="main-title">Mis productos</h1>
    <div class="cards">
        <?php foreach ($lots as $lot) : ?>
        <?php $expirationDate = $helpers -> getTimeLeft($lot['expire_date']) ?>
        <div class="single-card">
            <div class="myLots-actions">
                <a href="deleteLot.php?id=<?= htmlspecialchars($lot['id']) ?>" class="button button-attention">Eliminar</a>
                <!-- Delete Lot -->

                <!-- Edit only Active lot -->
                <?php if ($expirationDate['days'] < 1 && $expirationDate['hours'] < 1 && $expirationDate['minutes'] < 1) :?>
                <?= '' ?>
                <?php else: ?>
                <a href="editLot.php?id=<?= htmlspecialchars($lot['id']) ?>" class="button">Editar</a>
                <?php endif; ?>

            </div>

            <a href="lot.php?id=<?= htmlspecialchars($lot['id']) ?>">

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

                        <div
                            class="timer <?= $expirationDate['days'] < 1 && $expirationDate['hours'] < 1 && $expirationDate['minutes'] < 1 ? 'card-expiring' : ''?>">

                            <?= $expirationDate['days'] < 1 && $expirationDate['hours'] < 1 && $expirationDate['minutes'] < 1
                            ? 'Subasta terminada'
                            : 'Cierra en ' . $expirationDate['days'] . ' días ' . $expirationDate['hours'] . ' horas ' . $expirationDate['minutes'] . ' min' ?>
                        </div>
                    </div>
                </div>
            </a>
        </div>
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
