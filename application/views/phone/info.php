<head>
    <link rel="stylesheet" type="text/css" href="/public_files/css/default.css">
</head>

<h1>Информация о телефоне</h1>

<div class="new">
   <a>Номер: <?php echo $vars['number']; ?></a><br>
      Сотрудник: <a href="/employee/info/?id=<?php echo $vars['user']; ?>">
      <?php echo $vars['userName']; ?></a><br>
      
   Отдел: <a href="/department/info/?id=<?php echo $vars['department']; ?>">
      <?php echo $vars['depName']; ?>
   </a><br>
   <a>
      Описание: <?php echo $vars['description']; ?>
   </a><br>
</div>

<?php if(isset($_COOKIE['login'])): ?>
	<div class="delete">
		<a href="/admin/delete/?type=phone&id=<?php echo $vars['id']; ?>">Удалить номер</a>
   </div>
<?php endif; ?>