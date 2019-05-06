<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $title; ?></title>
		<link rel="stylesheet" type="text/css" href="/public_files/css/default.css">
		<script src="/public_files/scripts/lib/jquery.js"></script>
		<script src="/public_files/scripts/form.js"></script>
	</head>

	<body>
		<?php echo $content; ?>

		<?php if(isset($_COOKIE['login'])): ?>
			<div class="logout">
				<a href="/exit">Выйти из системы</a>
			</div>
			<div class="main">
				<a href="/">На главную</a>
			</div>
		<?php endif; ?>
	</body>

</html>