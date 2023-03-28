<?php

// // connect to MongoDB
require_once __DIR__ . '/../vendor/autoload.php';
$mongo = new MongoDB\Client("mongodb://localhost:27017");
$db = $mongo->guviprofile;

// // get the logged in user's username from session or cookie
// // $unique_reference_id = $_SESSION['unique_reference_id'] ?? $_COOKIE['unique_reference_id'];
//  $unique_reference_id ="64227b797204a";
$unique_reference_id = $_GET['unique_reference_id'];
// // fetch the user information from MongoDB
$user = $db->user_profile->findOne(['unique_reference_id' =>$unique_reference_id ]);
// $user = array(
//         'status'=>'success',
//         'name' => 'John Doe',
//         'email' => 'johndoe@example.com',
//         'age' => 30
//     );

// return the user information as JSON
echo json_encode($user);


?>
