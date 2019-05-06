$(function(){
  $("#form").validate({
    rules: {
      login: {
        required: true,
        minlength: 3.
      },
      full_name: {
        required: true,
        minlength: 3.
      },
      pass1: {
        required: true,
      },
      pass2: {
        equalTo: "#pass1"
      }
    },
    messages: {
      login: {
        required: "Поле логин обязательно для заполнения",
        minlength: jQuery.validator.format("Длина логина должна быть больше 3-х символов")
      }
    },
});