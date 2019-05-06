<div class="form__wrapper">
   <form class="form" id="form" role="form" method="post">
      <h1>Сотрудник</h1>
      <div class="fields">
         <label for="full_name">Имя и фамилия:</label>
         <input type="text" class="form-control" id="full_name" value="<?php echo $vars['full_name']; ?>" name="full_name">
      </div>
      <div class="fields">
         <label for="admin">Админ:</label>
<input type="checkbox" class="form-control" id="admin" <?php if(isset($vars['sudo'])): ?>checked<?php endif; ?> name="admin">
      </div>
      <button type="submit" name="button" id="send">Изменить</button>
   </form>
</div>