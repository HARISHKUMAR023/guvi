<?php
// Start Redis session
ini_set('session.save_handler', 'redis');
ini_set('session.save_path', 'tcp://redis-15057.c305.ap-south-1-1.ec2.cloud.redislabs.com:15057?timeout=2&auth=l7c3WlSesEfIzg2HXnFIay6ZgimmkonR');
session_start();

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


if ($result && mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $stored_password = $row['password'];

  if (password_verify($password, $stored_password)) {
    // Successful login
    
    // Store user information in session variables
    $_SESSION['email'] = $email;
    $_SESSION['unique_reference_id'] = $row['randomid'];
    
    // Return success response
    echo json_encode(array('status' => 'success', 'unique_reference_id' => $_SESSION['unique_reference_id']));
  } else {
    // Authentication failed
    echo 'failure';
  }
} else {
  // Email not found
  echo 'email not found';
}

// Close database connection
mysqli_close($conn);
?>
