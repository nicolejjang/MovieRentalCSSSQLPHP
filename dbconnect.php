<?php
$server = 'localhost:3307';
$user = 'root';
$pass= '';
$db = 'movierental';

// $server = 'sql201.epizy.com';
// $user = 'epiz_30478000';
// $pass= '8SsVk8HgS9fx';
// $db = 'epiz_30478000_movierental';

$con = new mysqli($server, $user, $pass, $db);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 
?>