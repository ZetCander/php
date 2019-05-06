$(function(){
  $("#form").validate({
    rules: {
      login: {
        required: true,
      },
      pasword: {
        required: true,
        minlength: 3.
      }
    },
    messages: {
      password: {
        required: "Поле пароль обязательно для заполнения",
      },
      login: {
        required: "Поле логин обязательно для заполнения",
        minlength: jQuery.validator.format("Длина логина должна быть больше 3-х символов")
      }
    },
  });
});