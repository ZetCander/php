<head>
    <link rel="stylesheet" type="text/css" href="/public_files/css/default.css">
	<script src="/public_files/scripts/dist/jquery.validate.min.js"></script>
	<script src="/public_files/scripts/login.js"></script>
</head>

<div class="form__wrapper">
   <form class="form" id="form" role="form" method="post">
      <h1>Вход</h1>
      <div class="fields">
         <label for="login">Ваш логин:</label>
         <input type="text" id="login" name="login" value="" placeholder="Login" class="form-control">
      </div>
      <div class="fields">
         <label for="password">Пароль:</label>
         <input type="password" class="form-control" id="password" name="password" placeholder="Password">
      </div>

      <button type="submit" name="button" id="send">Войти</button>
   </form>
</div>