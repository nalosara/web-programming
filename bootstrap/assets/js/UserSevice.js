var UserService = {
    init: function () {
      var token = localStorage.getItem("user_token");
      if (token) {
        window.location.replace("index.html");
      }
      $("#login-form").validate({
        submitHandler: function (form, validator) {
          var entity = {
            email : $("#email_login").val(),
            password : $("#password_login").val(),
          }
          UserService.login(entity);
        },
      });
      $("#signup-form").validate({
        submitHandler: function (form) {
            var entity = {
                email : $("#email_signup").val(),
                password : $("#password_signup").val(),
                full_name : $("#full_name").val(),
                phone : $("#phone").val(),
              }
          UserService.signup(entity);
        },
      });
    },
    login: function (entity) {
        console.log(entity);
      $.ajax({
        url: "rest/login",
        type: "POST",
        data: JSON.stringify(entity),
        contentType: "application/json",
        dataType: "json",
        success: function (result) {
          localStorage.setItem("user_token", result.token);
          window.location.replace("index.html");
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
           
          toastr.error(XMLHttpRequest.responseJSON.message);
        },
      });
    },

    signup: function (entity) {
        $.ajax({
          url: "rest/signup",
          type: "POST",
          data: JSON.stringify(entity),
          contentType: "application/json",
          dataType: "json",
          success: function (result) {
            localStorage.setItem("user_token", result.token);
            window.location.replace("index.html");
          },
          error: function (XMLHttpRequest, textStatus, errorThrown) {
            toastr.error(XMLHttpRequest.responseJSON.message);
          },
        });
      },
  
    logout: function () {
      localStorage.clear();
      window.location.replace("login.html");
    },
};