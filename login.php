<?php 
session_start();
if (isset($_SESSION['name'])) {
	header("location: Homepage2.php");
}
require_once 'dbconnect.php';
function function_alert($message) {
    echo "<script>alert('$message');</script>";
}
if ($stmt = $con->prepare('SELECT id, password, status FROM user_info WHERE user_name = ?')) {

	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();

if ($stmt->num_rows > 0) {
$stmt->bind_result($id, $password, $status);
$stmt->fetch();

	if ($_POST['password'] === $password && $status === "user"){
		session_regenerate_id();
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['name'] = $_POST['username'];
		$_SESSION['id'] = $id;
		header('Location: Homepage2.php');
	}else if($_POST['password'] === $password && $status === "admin") {
		session_regenerate_id();
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['name'] = $_POST['username'];
		$_SESSION['id'] = $id;
		header('Location: admin.php');
	}else if($_POST['password'] === $password && $status === "employee"){
		session_regenerate_id();
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['name'] = $_POST['username'];
		$_SESSION['id'] = $id;
		header('Location: employee.php');
	}

}
$stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="loginStyle.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	<meta charset="utf-8">
	<title>Part B Login</title>
</head>
<body>
<div class="login">
			<h1>Login</h1>
			<form  method="post">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Username" id="user_name" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<input type="submit" value="Login" name="login">
			</form>
			 <p align = center> <a href="register.php"> Not a member?<br/>Create Account!</a><br/>
			<a href="Homepage.php"> Home</a></p>
		</div>
</body>
</html>