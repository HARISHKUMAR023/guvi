<?php

// require_once __DIR__ . '/../vendor/autoload.php';

// // $client = new ;
// // $databases = $client->listDatabases();

// // foreach ($databases as $database) {
// //     echo $database->getName() . "<br>";
// // }


//    // connect to mongodb
//    function createrecordintomongodb($email,$randomid,$firstname,$lastname){
//    $m = new MongoDB\Client("mongodb://localhost:27017");
//    echo "Connection to database successfully";
	
//    // select a database
//    $db = $m->guviprofile;
//    echo "Database my selected";
//    $collection = $db->user_profile;
//    echo "Collection selected succsessfully";
	
//    $document = array([
//     'unique_reference_id'=>$randomid ,
//         'first_name'=>$firstname,
//         'last_name'=>$lastname,
//         'birth_date'=>"",
//         'phone_number'=>"",
//         'gaurdian_name'=>"",
//         'gaurdian_phone_number'=>"",
//         'address'=>[
//            'address_line1'=>"",
//            'address_line2'=>"",
//            'landmark'=>"",
//            'pincode'=>"",
//            'state'=>"" 
//         ]
//    ] 
//    );
	
//    $collection->insert($document);
//    echo "Document inserted successfully";
// }
?>
