<?php
// Database info
$db_host = 'studentmysql.miun.se';
$db_user = 'maed1801';
$db_pass = 'p2r6yp0p';
$db_name = 'maed1801';

// Create connection
$db_conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if(!$db_conn) {
    die('Could not connect: ' . mysqli_error());
}