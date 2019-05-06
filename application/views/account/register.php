<head>
    <link rel="stylesheet" type="text/css" href="/public_files/css/default.css">
	<script src="/public_files/scripts/dist/jquery.validate.min.js"></script>
	<script src="/public_files/scripts/register.js"></script>
</head>

<div class="form__wrapper">
   <form class="form" id="form" role="form" method="post">
      <h1>Регистрация</h1>
      <div class="fields">
         <label for="login">Ваш логин:</label>
         <input type="text" id="login" name="login" value="" placeholder="Login" class="form-control">
      </div>
      <div class="fields">
         <label for="full_name">Фамилия и имя:</label>
         <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Иванов Иван">
      </div>
      <div class="fields">
         <label for="pass1">Пароль:</label>
         <input type="password" id="pass1" value="" >
      </div>
      <div class="fields">
         <label for="pass2">Пароль еще раз:</label>
         <input type="password" id="pass2" value="" >
      </div>
 
 
      <button type="submit" name="button" id="send">Отправить</button>
   </form>
</div>