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
        console.log(data)
        var response = JSON.parse(data);
        if (response.status === 'success') {
          // authentication successful
          var unique_reference_id = response.unique_reference_id;
          localStorage.setItem('email', email);
          localStorage.setItem('password', password);
          console.log(data)
          window.location.href = './profile.html?unique_reference_id=' + unique_reference_id;
        } else if(response.status === 'f') {
          // authentication failed
          alert("sothing working")
          
          // alert("Something went wrong.");
          // const errorAlert = $('<div>').addClass('alert alert-danger').text('Login failed. Please check your email and password.');
          // $('#display').empty().append(errorAlert);
          // $('#status').text('');
          // $('#email').val('');
          // $('#password').val('');
          // setTimeout(() => {
          //   errorAlert.alert('close');
          // }, 2000);
        }
      },
      // error: function(xhr, textStatus, error) {
      //   console.log(xhr.statusText);
      //   console.log(textStatus);
      //   console.log(error);
        // alert("Check your code");
      // },
    });
  });
});
