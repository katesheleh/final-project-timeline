 <div class="container container-short">
     <h1 class="main-title">Añadir producto</h1>

     <form enctype="multipart/form-data" action="addLot.php" method="post">

         <div class="form-row">

             <div class="col form-field <?= isset($formValidationErrors['lotName']) ? "form-field-error" : ""; ?>">
                 <label>Nombre del producto <sup>*</sup>
                     <input type="text" name="lotName" placeholder="Introduce el nombre del producto"
                         value="<?= htmlspecialchars($fieldsValidation -> getValuePostMethod('lotName')); ?>">
                 </label>

                 <?php if (isset($formValidationErrors['lotName'])) : ?>
                 <div class="error-message"><?=$formValidationErrors['lotName']?></div>
                 <?php endif ?>
             </div>

             <div class="col form-field <?= isset($formValidationErrors['lotCategory']) ? "form-field-error" : ""; ?>">
                 <label>Categoría <sup>*</sup>
                     <select name="lotCategory">
                         <?php $chosenValue = htmlspecialchars($fieldsValidation -> getValuePostMethod('lotCategory')) ?>
                         <option disable selected value>Elige una categoría</option>
                         <?php foreach ($categories as $category): ?>
                         <option
                         <?php if (isset($chosenValue) && $chosenValue==htmlspecialchars($category['id'])) echo "selected";?>
                         value=<?= htmlspecialchars($category['id']) ?>>
                             <?= htmlspecialchars($category['name']) ?>
                         </option>
                         <?php endforeach; ?>
                     </select>
                 </label>

                 <?php if (isset($formValidationErrors['lotCategory'])) : ?>
                 <div class="error-message"><?=$formValidationErrors['lotCategory']?></div>
                 <?php endif ?>
             </div>
         </div>

         <div class="form-row form-field <?= isset($formValidationErrors['lotDesc']) ? "form-field-error" : ""; ?>">
             <label>Descripción<sup>*</sup>
                 <textarea name="lotDesc"
                     placeholder="Escribe la descripción del producto"><?= htmlspecialchars($fieldsValidation -> getValuePostMethod('lotDesc')); ?></textarea>
             </label>

             <?php if (isset($formValidationErrors['lotDesc'])) : ?>
             <div class="error-message"><?=$formValidationErrors['lotDesc']?></div>
             <?php endif ?>
         </div>

         <div class="form-row">
             <div class="col form-field <?= isset($formValidationErrors['lotImage']) ? "form-field-error" : ""; ?>">
                 <label>Imagen <sup>*</sup>
                     <input type="file" name="lotImage"
                         value="<?= htmlspecialchars($fieldsValidation -> getValuePostMethod('lotImage')); ?>">
                 </label>

                 <?php if (isset($formValidationErrors['lotImage'])) : ?>
                 <div class="error-message"><?=$formValidationErrors['lotImage']?></div>
                 <?php endif ?>
             </div>

             <div
                 class="col form-field <?= isset($formValidationErrors['lotExpirationDate']) ? "form-field-error" : ""; ?>">
                 <label>Fecha de cierre de la subasta <sup>*</sup>
                     <input type="date" name="lotExpirationDate"
                         value="<?= htmlspecialchars($fieldsValidation -> getValuePostMethod('lotExpirationDate')); ?>">
                 </label>
                 <?php if (isset($formValidationErrors['lotExpirationDate'])) : ?>
                 <div class="error-message"><?=$formValidationErrors['lotExpirationDate']?></div>
                 <?php endif ?>
             </div>
         </div>

         <div class="form-row">
             <div class="col form-field <?= isset($formValidationErrors['lotInitPrice']) ? "form-field-error" : ""; ?>">
                 <label>Precio inicial <sup>*</sup>
                     <input type="text" name="lotInitPrice" placeholder="0"
                         value="<?= htmlspecialchars($fieldsValidation -> getValuePostMethod('lotInitPrice')); ?>">
                 </label>

                 <?php if (isset($formValidationErrors['lotInitPrice'])) : ?>
                 <div class="error-message"><?=$formValidationErrors['lotInitPrice']?></div>
                 <?php endif ?>
             </div>

             <div class="col form-field <?= isset($formValidationErrors['lotRateStep']) ? "form-field-error" : ""; ?>">
                 <label>Puja mínima <sup>*</sup>
                     <input type="text" name="lotRateStep" placeholder="0"
                         value="<?= htmlspecialchars($fieldsValidation -> getValuePostMethod('lotRateStep')); ?>">
                 </label>

                 <?php if (isset($formValidationErrors['lotRateStep'])) : ?>
                 <div class="error-message"><?=$formValidationErrors['lotRateStep']?></div>
                 <?php endif ?>
             </div>
         </div>

         <button type="submit" class="button">Añadir producto</button>
     </form>
 </div>
