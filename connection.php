<?php

$message = '';
$username = 'root';
$password = 'root';
$db = new mysqli('localhost', $username, $password, 'sqlinject');

if ($db->connect_error){
	$message = $db->connect_error;
}
else{
	echo $message;
}
?>

