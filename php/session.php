 <!-- ========== check the redies connection ========== -->



<?php
$redis = new Redis();
$redis->connect('redis-15057.c305.ap-south-1-1.ec2.cloud.redislabs.com', 15057);

// Authenticate with the Redis server
$redis->auth('l7c3WlSesEfIzg2HXnFIay6ZgimmkonR');

// Test the connection
if ($redis->ping() == '+PONG') {
    echo 'Connected to Redis server successfully!' . PHP_EOL;

    // Perform Redis operations
    // ...

} else {
    echo 'Failed to connect to Redis server.' . PHP_EOL;
}

$redis->close();
?>
