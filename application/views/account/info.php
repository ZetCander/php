<head>
    <link rel="stylesheet" type="text/css" href="/public_files/css/default.css">
</head>

<h1>Информация о пользователе</h1>

<div class="new">
   <a>Полное имя: <?php echo $vars['user']['full_name']; ?></a><br>

   <a>
      Последнее действие в <?php echo $vars['user']['last_auth']; ?> (UTC+3:00)
   </a><br>

   <?php if(!empty($vars['phones'])): ?>
      <b>Телефонные номера, привязанные к сотруднику:</b><br>
   <?php else: ?>
      <b>Нет телефонных номеров, привязанных к сотруднику.</b><br>
   <?php endif; ?>

   <?php foreach($vars['phones'] as $phone): ?>
      <a href="/phone/info?id=<?php echo $phone['id']; ?>">
			<?php echo $phone['number']; ?><br>
		</a>
   <?php endforeach; ?>
</div>

<?php if(isset($_COOKIE['login'])): ?>
	<div class="delete">
		<a href="/change/user/?id=<?php echo $vars['user']['id']; ?>">Редактировать пользователя</a>
   </div>
<?php endif; ?>