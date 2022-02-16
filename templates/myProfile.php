<div class="container space-bottom">
    <h1 class="main-title">Mi perfil</h1>

    <div class="my-profile-buttons">
        <a href="myLots.php" class="button button-inline">Mis Productos</a>
        <a href="myRates.php" class="button button-inline">Mis Pujas</a>
        <a href="editMyInfo.php" class="button button-inline">Editar Mis Datos de Contacto</a>
    </div>

    <p>Nombre <br><b><?= htmlspecialchars($user['name']) ?></b></p>
    <p>Email <br><b><?= htmlspecialchars($user['email']) ?></b></p>
    <p>Detalles de contacto <br><b class="pre-wrap"><?= htmlspecialchars($user['contacts']) ?></b></p>

</div>
