 <div class="container container-short">
     <h1 class="main-title">Editar el producto <span>«<?= htmlspecialchars($lot['name']) ?>»</span></h1>

     <form method="post">

         <div class="form-row">

             <div class="col form-field">
                 <label>Nombre del producto <sup>*</sup>
                     <input type="text" name="lotName" placeholder="Introduce el nombre del producto"
                         value="<?= htmlspecialchars($lot['name']) ?>">
                 </label>
             </div>

             <div class="col form-field">
                 <label>Categoría <sup>*</sup>
                     <select name="lotCategory">
                         <?php $chosenValue = htmlspecialchars($lot['category_id']) ?>
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
             </div>
         </div>

         <div class="form-row form-field">
             <label>Descripción<sup>*</sup>
                 <textarea name="lotDesc"
                     placeholder="Escribe la descripción del producto"><?= htmlspecialchars($lot['description']) ?></textarea>
             </label>

         </div>

         <div class="form-row">
             <div class="col form-field">
                 <label>Precio inicial <sup>*</sup>
                     <input type="number" name="lotInitPrice" value="<?= htmlspecialchars($lot['init_price'])  ?>">
                 </label>
             </div>

             <div class="col form-field">
                 <label>Puja mínima <sup>*</sup>
                     <input type="number" name="lotRateStep" value="<?= htmlspecialchars($lot['rate_value'])  ?>">
                 </label>
             </div>
         </div>

         <button type="submit" class="button button-inline">Editar producto</button>
         <a href="myLots.php" class="text-link">Cancelar</a>

     </form>
 </div>
