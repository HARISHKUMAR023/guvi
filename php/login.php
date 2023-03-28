<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "guvitest";
$conn = mysqli_connect($host, $username, $password, $database);

// check if connection succeeded
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// get email and password from AJAX request
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);


// query database to check if email exists
$query = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $query);

// check if query succeeded and if user was found
if ($result && mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $stored_password = $row['password'];
  // verify password
  if (password_verify($password, $stored_password)) {
    // authentication successful
    // echo json_encode(array('status'=>'succes'));
      
    // $unique_reference_id = $row['unique_reference_id'];
    $unique_reference_id = $row['randomid'];
    echo json_encode(array('status' => 'success', 'unique_reference_id' => $unique_reference_id));
    
  } else {
    // authentication failed
    echo 'failure';
  }
} else {
  // email not found
  echo 'failure';
}

// close database connection
mysqli_close($conn);
?>