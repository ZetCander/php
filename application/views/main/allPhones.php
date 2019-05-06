<head>
	<link rel="stylesheet" type="text/css" href="/public_files/css/list.css">
</head>

<body> 
	<?php foreach ($vars as $dep => $phoneInfo): ?>
		<ol class="phone">
		<?php echo $dep; ?>
			<div class="new">
				<?php foreach ($phoneInfo as $value): ?>
					<li>
						<a href="/phone/info?id=<?php echo $value['id']; ?>">
							<?php echo $value['number']; ?>
						</a>
					</li>
				<?php endforeach ?>
			</div>
		</ol>
	<?php endforeach ?>

	<?php if(isset($_COOKIE['login'])): ?>
		<div class="create">
			<a href="/phone/create">Добавить номер</a>
		</div>
	<?php endif; ?>
</body>