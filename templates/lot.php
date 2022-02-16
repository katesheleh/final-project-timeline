<div class="container space-bottom">
    <h1 class="main-title"><?= htmlspecialchars($lot['name']) ?></h1>

    <div class="lot-wrapper">
        <div class="lot-col-left">
            <img src="uploads/<?= htmlspecialchars($lot['image']) ?>" alt="<?= htmlspecialchars($lot['name']) ?>">
            <p class="single-lot-category"><b>Categoría: </b><?= htmlspecialchars($lot['category_name']) ?></p>
            <p class="lot-description"><?= htmlspecialchars($lot['description']) ?></p>
        </div>

        <div class="lot-col-right">

            <div class="single-lot-information">

                <?php $expirationDate = $helpers -> getTimeLeft($lot['expire_date']) ?>

                <div
                    class="single-lot-times <?= $expirationDate['days'] < 1 && $expirationDate['hours'] < 1 && $expirationDate['minutes'] < 1 ? 'card-expiring' : ''?>">

                    <?= $expirationDate['days'] < 1 && $expirationDate['hours'] < 1 && $expirationDate['minutes'] < 1
                        ? 'Subasta terminada'
                        : 'Cierra en ' . $expirationDate['days'] . ' días ' . $expirationDate['hours'] . ' horas ' . $expirationDate['minutes'] . ' min' ?>

                </div>

                <div class="single-lot-current-price">
                    Precio actual<br>
                    <b><?= htmlspecialchars($helpers -> formatPrice(is_null($lot['last_price']) ? $lot['init_price'] : $lot['last_price'])) ?></b>
                </div>

                <!-- show if the product is active -->
                <?php if ($expirationDate['hours'] > 1 && $expirationDate['minutes'] > 1) : ?>
                <div class="single-lot-next-price">
                    Siguiente puja mínima
                    <b><?= htmlspecialchars($helpers -> formatPrice($currentMinRate));?></b>
                </div>
                <?php endif ?>


                <?php if ($isUserAuth === true && !$isRateMadeByCurrentUserID && ($expirationDate['minutes'] > 1) && (int)$lot['author_id'] !== (int)$currentUserId) : ?>

                <form action="lot.php?id=<?= $_GET['id'] ?>" method="post">
                    <div class="form-field">
                        <label>Hacer una puja
                            <input class="input-with-border" type="text" name="minRatePrice"
                                placeholder="<?= htmlspecialchars($helpers -> formatPrice($currentMinRate)) ?>">
                        </label>

                        <?php if (isset($formValidationErrors['minRatePrice'])) : ?>
                        <div class="error-message"><?=$formValidationErrors['minRatePrice']?></div>
                        <?php endif ?>
                    </div>
                    <button type="submit" class="button button-full-width">Pujar</button>
                </form>

                <?php endif ?>
            </div>

            <h3>Historia de las pujas (<span><?= htmlspecialchars(count($rates)) ?></span>)</h3>
            <?php foreach ($rates as $rate): ?>
            <div class="rates-history-item">
                <p><?= htmlspecialchars(date('d.m.Y H:i:s',strtotime($rate['created_date']))) ?></p>
                <p><?= htmlspecialchars($helpers -> formatPrice($rate['price'])) ?></p>
                <p><?= htmlspecialchars($rate['user_name']) ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
