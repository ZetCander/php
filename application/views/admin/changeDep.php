<div class="form__wrapper">
   <form class="form" id="form" role="form" method="post">
      <h1>Отдел</h1>
      <div class="fields">
         <label for="name">Название:</label>
         <input type="text" class="form-control" id="name" value="<?php echo $vars['name']; ?>" name="name">
      </div>
      <button type="submit" name="button" id="send">Изменить</button>
   </form>
</div>