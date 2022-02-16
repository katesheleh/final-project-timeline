<div class="container space-bottom">
    <h1 class="main-title">Mis pujas</h1>

    <?php foreach ($myRates as $rate): ?>
    <div class="my-rate-row <?= $rate['is_won'] === '1' ? 'my-rate-win' : ''?>">

        <img src="uploads/<?= htmlspecialchars($rate['image']) ?>" alt="<?= htmlspecialchars($rate['product_name']) ?>">

        <div>
            <h3 class="my-rate-title"><a
                    href="lot.php?id=<?= htmlspecialchars($rate['product_id']) ?>"><?= htmlspecialchars($rate['product_name']) ?></a>
            </h3>
            <?php $authorInformation = $dbTableUsers -> getSingleUserById($rate['product_author_id']) ?>
            <?= $rate['is_won'] === '1' ? "<p class='pre-wrap author-contacts'>" . htmlspecialchars($authorInformation['contacts']) . "</p>" : '' ?>
        </div>

        <div><?= htmlspecialchars($rate['cat_name']) ?></div>

        <div><?= htmlspecialchars($helpers -> formatPrice($rate['rate_value'])) ?></div>

        <div><?= htmlspecialchars($rate['rate_created']) ?></div>

        <div>
            <?php $expirationDate = $helpers -> getTimeLeft($rate['expire_date']) ?>
            <div
                class="timer <?= $expirationDate['days'] < 1 && $expirationDate['hours'] < 1 && $expirationDate['minutes'] < 1 ? 'card-expiring' : ''?> <?= $rate['is_won'] === '1' ? 'timer--win' : ''?>">

                <?= $rate['is_won'] === '1' && $expirationDate['days'] < 1 && $expirationDate['hours'] < 1 && $expirationDate['minutes'] < 1
                        ? 'Has ganado'
                        : ($expirationDate['days'] < 1 && $expirationDate['hours'] < 1 && $expirationDate['minutes'] < 1
                            ? 'Subasta terminada'
                            : $expirationDate['days'] . ' d : ' . $expirationDate['hours'] . ' h : ' . $expirationDate['minutes'] . ' min' ) //if the bet didn't win and remainingTime is more than 1 hour
                        ?>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

</div>
