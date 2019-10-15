<?php
// Database info
$db_host = 'localhost';
$db_name = 'moment5';
$db_user = 'moment5';
$db_pass = 'moment5';

// Create connection
$db_conn = new mysqli($db_host, $db_name, $db_user, $db_pass);
if(!$db_conn) {
    die('Could not connect: ' . mysqli_error());
}