<div class="container container-short">
    <h1 class="main-title">Registrarse</h1>

    <form action="registration.php" method="post" autocomplete="off">

        <div class="form-row form-field <?= isset($formValidationErrors['email']) ? "form-field-error" : ""; ?>">
            <label>E-mail <sup>*</sup>
                <input type="text" name="email" placeholder="Introduce tu e-mail"
                    value="<?= htmlspecialchars($fieldsValidation -> getValuePostMethod('email')); ?>">
            </label>

            <?php if (isset($formValidationErrors['email'])) : ?>
            <div class="error-message"><?=$formValidationErrors['email']?></div>
            <?php endif ?>
        </div>

        <div class="form-row form-field <?= isset($formValidationErrors['password']) ? "form-field-error" : ""; ?>">
            <label>Contraseña <sup>*</sup>
                <input type="password" name="password" placeholder="Introduce la contraseña"
                    value="<?= htmlspecialchars($fieldsValidation -> getValuePostMethod('password')); ?>">
            </label>

            <?php if (isset($formValidationErrors['password'])) : ?>
            <div class="error-message"><?=$formValidationErrors['password']?></div>
            <?php endif ?>
        </div>

        <div class="form-row form-field <?= isset($formValidationErrors['name']) ? "form-field-error" : ""; ?>">
            <label>Nombre de usuario<sup>*</sup>
                <input type="text" name="name" placeholder="Introduce el nombre"
                    value="<?= htmlspecialchars($fieldsValidation -> getValuePostMethod('name')); ?>">
            </label>

            <?php if (isset($formValidationErrors['name'])) : ?>
            <div class="error-message"><?=$formValidationErrors['name']?></div>
            <?php endif ?>
        </div>

        <div class="form-row form-field  <?= isset($formValidationErrors['contacts']) ? "form-field-error" : ""; ?>">
            <label> Detalles de contacto <sup>*</sup>
                <textarea name="contacts"
                    placeholder="Escribe cómo contactar contigo"><?= htmlspecialchars($fieldsValidation -> getValuePostMethod('contacts')); ?></textarea>
            </label>
            <?php if (isset($formValidationErrors['contacts'])) : ?>
            <div class="error-message"><?=$formValidationErrors['contacts']?></div>
            <?php endif ?>
        </div>

        <button type="submit" class="button button-inline">Registrarse</button>
        <a class="text-link" href="login.php">Ya tengo una cuenta</a>
    </form>
</div>
