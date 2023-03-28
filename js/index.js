$(document).ready(function() {
    $("#login-btn").click(loadLoginForm);
    $("#register-btn").click(loadRegisterForm);
   

  });

function loadLoginForm() {
    $.get("login.html", function(data) {
      $("#form-container").html(data);
    });
  }
  
  function loadRegisterForm() {
    $.get("register.html", function(data) {
      $("#form-container").html(data);
      
    });
  }

  