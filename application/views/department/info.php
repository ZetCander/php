<head>
    <link rel="stylesheet" type="text/css" href="/public_files/css/default.css">
</head>

<h1>Информация об отделе</h1>

<div class="new">
   <a>Название отдела: <?php echo $vars['department']['name']; ?></a><br>

   <?php if(!empty($vars['phones'])): ?>
      <b>Телефонные номера, привязанные к отделу:</b><br>
   <?php else: ?>
      <b>Нет телефонных номеров, привязанных к отделу.</b><br>
   <?php endif; ?>

   <?php foreach($vars['phones'] as $phone): ?>
      <a href="/phone/info?id=<?php echo $phone['id']; ?>">
			<?php echo $phone['number']; ?><br>
		</a>
   <?php endforeach; ?>
</div>

<?php if(isset($_COOKIE['login'])): ?>
	<div class="delete">
		<a href="/change/department/?id=<?php echo $vars['department']['id']; ?>">Редактировать отдел</a>
   </div>
<?php endif; ?>