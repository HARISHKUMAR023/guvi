<?php
// Retrieve data from AJAX request
$email = $_POST['email'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$randomid = uniqid();

// Connect to MySQL database
$conn = mysqli_connect('localhost', 'root', '', 'guvitest');

// Check connection
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

// Check if the password is not empty
if (!empty($_POST['password'])) {
    
    $stmt = $conn->prepare("INSERT INTO users (email, first_name, last_name, password, randomid) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $email, $firstName, $lastName, $password, $randomid);

    // Execute SQL statement
    if ($stmt->execute()) {
        // Insert user profile data into MongoDB
        require_once __DIR__ . '/../vendor/autoload.php';
        $client = new MongoDB\Client("mongodb://localhost:27017");
        $collection = $client->guviprofile->user_profile;
        $result = $collection->insertOne([
            'unique_reference_id' => $randomid,
            'first_name' => $firstName ,
            'last_name'=> $lastName,
            'date_of_birth'=>'',
            'phonenumber'=> '',
            'gaurdian_name'=>'',
            'gaurdian_phone_number'=>'',
            'address'=>([
                   'address_line1'=> '',
                   'address_line2'=> '',
                   'pincode'=>'',
                   'state'=>''  
            ]),
           
        ]);
        
        // Return success response to AJAX request
        echo json_encode(array('status' => 'success', 'unireferenceid' => $randomid));
    } else {
        // Return error response to AJAX request
        echo json_encode(array('status' => 'error', 'message' => mysqli_error($conn)));
    }

    // Close statement
    $stmt->close();
} else {
    // Return error response to AJAX request
    echo json_encode(array('status' => 'error', 'message' => 'Password cannot be empty'));
}

// Close connection
mysqli_close($conn);
