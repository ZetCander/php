<head>
    <link rel="stylesheet" type="text/css" href="/public_files/css/default.css">
</head>

<div class="form__wrapper">
   <form class="form" id="form" role="form" method="post">
      <h1>Новый телефонный номер</h1>
      <div class="fields">
         <label for="number">Номер:</label>
         <input type="text" id="number" name="number" class="form-control">
      </div>
      <div class="fields">
         <label for="user">Сотрудник:</label>
         <select  class="form-control" id="user" name="user">
            <?php foreach ($vars['employees'] as $id => $name): ?>
               <option value=<?php echo $id; ?>><?php echo $name;?></option>
            <?php endforeach; ?>
         </select>
      </div>

      <div class="fields">
         <label for="department">Отдел:</label>
         <select  class="form-control" id="department" name="department">
            <?php foreach ($vars['departments'] as $id => $name): ?>
               <option value=<?php echo $id; ?>><?php echo $name ;?></option>
            <?php endforeach; ?>
         </select>
      </div>

      <div class="fields">
         <label for="info">Информация:</label>
         <textarea id="info" name="info" class="form-control" placeholder="Введите информацию здесь"></textarea>
      </div>
      <button type="submit" name="button" id="send">Создать</button>
   </form>
</div>