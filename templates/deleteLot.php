 <div class="container container-short">
     <h1 class="main-title">Estas seguro que quieres eliminar «<?= htmlspecialchars($lot['name']) ?>»?</h1>

     <a href="myLots.php" class="button button-inline">Cancelar</a>

     <form method='post' class="delete-my-lot-form">
         <input type='hidden' name="lotIdToRemove" value="<?= htmlspecialchars($lot['id']) ?>">
         <button name="deleteMyLot" type="submit" class="button button-attention">Eliminar</button>
     </form>
 </div>
