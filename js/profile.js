$(document).ready(function() {
  // Retrieve user data from server using AJAX
 
  $('#logme').on('click', (event) => {
    event.preventDefault();
    clearLocalStorage()
    // redirect the user to the index.html
    window.location.href = './index.html';
  });
  const urlParams = new URLSearchParams(window.location.search);
  const unique_reference_id = urlParams.get('unique_reference_id');
  $.ajax({
    url: "./php/profile.php",
    method: "GET",
    dataType: "json",
    data: {
      unique_reference_id: unique_reference_id,
    },
    success: function(data) {
      // populate the form fields with the user information
      $("#uniquereferenceid").val(data.unique_reference_id);
      $("#username").append(data.first_name);
      $("#name").val(data.first_name);
      $("#phone").val(data.phonenumber);
      $("#birthdate").val(data.date_of_birth);
      $("#guardian-name").val(data.gaurdian_name);
      $("#guardian-contact").val(data.gaurdian_phone_number);
     
      $("#address1").val(data.address.address_line1);
      
      $("#address2").val(data.address.address_line2);

      
      $("#pincode").val(data.address.
        pincode);
      $("#state").val(data.address.state);
      // set the user's name in the welcome message
      // $("#myname").text(data.name);
    },
    error: function() {
      alert("Error fetching user information");
    }
  });

  $("#edit-btn").click(function(event) {
    event.preventDefault(); // Prevent the form from being reset
    // Enable input fields for editing
    $("input, textarea").removeAttr("disabled");
    // Show save and cancel buttons
    $("#edit-btn").fadeOut(200, function() {
      $("#save-btn, #cancel-btn").fadeIn(200);
    });
  });
  
  
  $("#cancel-btn").click(function(event) {
    event.preventDefault();
    // Disable input fields and hide save and cancel buttons with fade effect
    $("input, textarea").attr("disabled", "disabled");
    $("#save-btn, #cancel-btn").fadeOut(200, function() {
      $("#edit-btn").fadeIn(200);
    });
  });
  
  
  $("#save-btn").click(function(event) {
    event.preventDefault();
    // Send updated user data to server using AJAX
    $.ajax({
      url: "./php/update.php",
      type: "POST",
      data: {
        uniquereferenceid:$("#uniquereferenceid").val(),
        name: $("#name").val(),
        phone: $("#phone").val(),
        birthdate: $("#birthdate").val(),
        guardian_name: $("#guardian-name").val(),
        // username: $("#username").val(),
        guardiancontact:$("#guardian-contact").val(),
        address1: $("#address1").val(),
        address2: $("#address2").val(),
        pincode: $("#pincode").val(),
        state:$("#state").val()
        // address: {
        //   address_line1: $("#address").val(),
        //   address_line2: $("#address2").val(),
        //   city: $("#city").val(),
        //   state: $("#state").val(),
        //   country: $("#country").val(),
        //   zipcode: $("#zipcode").val(),
        // },
      },
      success: function(data) {
        alert("User information updated successfully");
        // Disable input fields and hide save and cancel buttons
        $("input, textarea").attr("disabled", "disabled");
        $("#save-btn, #cancel-btn").hide();
        $("#edit-btn").show();
        // Display a success message to the user
        
      },
      error: function(data) {
        // Display an error message to the user
        alert("Error updating user information");
      }
    });
  });
  
  

  function clearLocalStorage() {
    localStorage.clear();
  }
  
  
  // let timeout;
  
  // Start the timer when the user logs in or performs an action
  // function startTimer() {
  //   timeout = setTimeout(logout, 5 * 60 * 1000); // 5 minutes in milliseconds
  // }
  
  // Reset the timer when the user performs an action
  // function resetTimer() {
  //   clearTimeout(timeout);
  //   startTimer();
  // }
  
  // // Logout the user and redirect to the login page
  // function logout() {
  //   // Perform any necessary cleanup or logging out on the server-side
  //   window.location.href = "index.html"; // Redirect to the login page
  // }
  
  // // Call the startTimer function when the user logs in or performs an action
  // startTimer();
  
  // // Call the resetTimer function on any user activity, such as clicking a button or typing
  // document.addEventListener("click", resetTimer);
  // document.addEventListener("keydown", resetTimer);
});










