$(document).ready(() => {
    $('#login-form').on('submit', (event) => {
      event.preventDefault(); 
  
      // get form data
      const email = $('#email').val();
      const password = $('#password').val();
  
      // send AJAX request to ./php/login.php
      $.ajax({
        type: 'POST',
        url: './php/login.php',
        data: {
          email: email,
          password: password,
        },
        success: function(data) {
          var response = JSON.parse(data);
          if (response.status === 'success') {
            // authentication successful .status
            // $('#display').text('Welcome!');
            // $('#status').text('Redirecting...');
            // store email and password in local storage
            var unique_reference_id = response.unique_reference_id;
            localStorage.setItem('email', email);
            localStorage.setItem('password', password);
            // setTimeout(() => {
            //   window.location.href = './profile.html',uniqueReferenceId; // redirect to profile.html
            // }, 2000);
            window.location.href = './profile.html?unique_reference_id=' + unique_reference_id;

          } else {
            // authentication failed
            const alert = $('<div>').addClass('alert alert-danger').text('Login failed. Please check your email and password.');
            $('#display').empty().append(alert);
            $('#status').text('');
            $('#email').val('');
            $('#firstName').val('');
            $('#lastName').val('');
            $('#password').val('');
            setTimeout(() => {
              alert.alert('close');
            }, 2000);
          }
        },
        error: function(xhr, textStatus, error) {
          console.log(xhr.statusText);
          console.log(textStatus);
          console.log(error);
        },
      });
    });
  
    // // check if email and password are stored in local storage on page load
    // const storedEmail = localStorage.getItem('email');
    // const storedPassword = localStorage.getItem('password');
    // if (storedEmail && storedPassword) {
    //   // auto-fill email and password fields
    //   $('#email').val(storedEmail);
    //   $('#password').val(storedPassword);
    // }
  });
  