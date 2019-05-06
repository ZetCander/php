<head>
	<link rel="stylesheet" type="text/css" href="/public_files/css/list.css">
</head>

<body>
	<ol class="department">
		<?php foreach ($vars as $department): ?>
			<li>
				<a href="#"><?php echo $department['phone']['number']?></a>
			</li>
		<?php endforeach ?>
	</ol>	

	<a href='/department/create'>Создать новый отдел</a>
</body>