<head>
	<link rel="stylesheet" type="text/css" href="/public_files/css/list.css">
</head>

<body> 
	<div class="new">
		<?php foreach ($vars as $employee): ?>	
				<ol class="employee">
					<li>
						<a href="/employee/info?id=<?php echo $employee['id']; ?>">
							<?php echo $employee['full_name']; ?>
						</a>
					</li>
				</ol>	
		<?php endforeach ?>
	</div>
	
	<?php if(isset($_COOKIE['login'])): ?>
		<div class="create">
			<a href='/employee/create'>Добавить сотрудника</a>
		</div>
	<?php endif; ?>

</body>