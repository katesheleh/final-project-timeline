<div class="container container-short">
    <h1 class="main-title">Iniciar sesión</h1>

    <form action="login.php" method="post">
        <div class="form-row form-field <?= isset($formValidationErrors['userEmail']) ? 'form-field-error' : ''; ?>">
            <label>E-mail <sup>*</sup>
                <input type="text" name="userEmail" placeholder="Introduce tu e-mail"
                    value="<?= htmlspecialchars($fieldsValidation -> getValuePostMethod('userEmail')); ?>">
            </label>

            <?php if (isset($formValidationErrors['userEmail'])) : ?>
            <div class="error-message"><?=$formValidationErrors['userEmail']?></div>
            <?php endif ?>
        </div>

        <div class="form-row form-field <?= isset($formValidationErrors['userPassword']) ? 'form-field-error' : ''; ?>">
            <label>Contraseña <sup>*</sup>
                <input type="password" name="userPassword" placeholder="Introduce la contraseña"
                    value="<?= htmlspecialchars($fieldsValidation -> getValuePostMethod('userPassword')); ?>">
            </label>
            <?php if (isset($formValidationErrors['userPassword'])) : ?>
            <div class="error-message"><?=$formValidationErrors['userPassword']?></div>
            <?php endif ?>
        </div>

        <button type="submit" class="button">Iniciar sesión</button>
    </form>
</div>
