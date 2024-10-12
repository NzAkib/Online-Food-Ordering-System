<?php
session_start(); 
$login_error=''; 

if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['password'])) {
$login_error = "Username or Password is invalid";
}
else
{

$username=$_POST['username'];
$password=$_POST['password'];

require 'connection.php';
$conn = Connect();


$query = "SELECT username, password FROM CUSTOMER WHERE username=? AND password=? LIMIT 1";

$stmt = $conn->prepare($query);
$stmt -> bind_param("ss", $username, $password);
$stmt -> execute();
$stmt -> bind_result($username, $password);
$stmt -> store_result();

if ($stmt->fetch())  
{
	$_SESSION['login_user2']=$username; 
	header("location: foodlist.php"); 
} else {
$login_error = "Invalid Credentials";
}
mysqli_close($conn); 
}
}
?>