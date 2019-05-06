<head>
	<link rel="stylesheet" type="text/css" href="/public_files/css/list.css">
</head>

<body>
	<div class="new">
		<?php foreach ($vars as $department): ?>
			<ol class="department">
				<li>
					<a href="/department/info?id=<?php echo $department['id']; ?>">
						<?php echo $department['name']?>
					</a>
				</li>
			</ol>
		<?php endforeach ?>
	</div>
	
	<?php if(isset($_COOKIE['login'])): ?>
		<div class="create">
			<a href='/department/create'>Создать новый отдел</a>
		</div>
	<?php endif; ?>

</body>