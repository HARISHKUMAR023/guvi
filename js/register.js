$(document).ready(function() {
  $('form').submit(function(event) {
    event.preventDefault(); // prevent the form from submitting normally
    var formData = {
      email: $('#email').val(),
      firstName: $('#firstName').val(),
      lastName: $('#lastName').val(),
      password: $('#password').val(),
      // confirmPassword: $('#Conform Password').val()
    };

    $.ajax({
      type: 'POST',
      url: './php/register.php', // specify the PHP script that will process the data
      data: formData,
      dataType: 'json',
      encode: true
    })
    .done(function(data) {
      console.log(data);
      alert("the register sucessfull") // log the response from the server to the console
      
       // Clear form fields
       $('#email').val('');
       $('#firstName').val('');
       $('#lastName').val('');
       $('#password').val('');// reload the page after successful registration
    })
    .fail(function(data) {
      console.log('Error:', data);
      alert("the register error")
      $('#email').val('');
      $('#firstName').val('');
      $('#lastName').val('');
      $('#password').val(''); // log any errors to the console
    });
  });
});
