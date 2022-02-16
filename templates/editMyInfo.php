<div class="container container-short">
    <h1 class="main-title">Editar mis datos de contacto</h1>

    <form method="post" autocomplete="off">

        <div class="form-row form-field">
            <label>Nombre de usuario<sup>*</sup>
                <input type="text" name="name" value="<?= htmlspecialchars($user['name']); ?>">
            </label>
        </div>

        <div class="form-row form-field">
            <label> Detalles de contacto <sup>*</sup>
                <textarea name="contacts"><?= htmlspecialchars($user['contacts']); ?></textarea>
            </label>
        </div>

        <button type="submit" class="button button-inline">Cambiar</button>
        <a class="text-link" href="myProfile.php">Cancelar</a>
    </form>

</div>
