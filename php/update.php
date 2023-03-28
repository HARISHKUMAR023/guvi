<?php

// connect to MongoDB
require_once __DIR__ . '/../vendor/autoload.php';
$mongo = new MongoDB\Client("mongodb://localhost:27017");
$db = $mongo->selectDatabase('guviprofile');

// get form data
$phone = $_POST['phone'];
$unique_reference_id = $_POST['uniquereferenceid'];
$birthdate = $_POST['birthdate'];
$guardian_name = $_POST['guardian_name'];
$guardian_contact = $_POST['guardiancontact'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$pincode = $_POST['pincode'];
$state = $_POST['state'];

// fetch the user information from MongoDB
$user = $db->user_profile->findOne(['unique_reference_id' => $unique_reference_id]);

// update the user information
$result = $db->user_profile->updateOne(
    ['unique_reference_id' => $unique_reference_id],
    [
        '$set' => [
            'date_of_birth' => $birthdate,
            'phonenumber' => $phone,
            'gaurdian_name' => $guardian_name,
            'gaurdian_phone_number' => $guardian_contact,
            'address' => [
                'address_line1' => $address1,
                'address_line2' => $address2,
                'pincode' => $pincode,
                'state' => $state,
            ],
        ],
    ]
);

// check if the update was successful
if ($result->getModifiedCount() == 1) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error']);
}
