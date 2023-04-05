<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="addempstyle.css">
	<meta charset="utf-8">
	<title>Add Employee</title>
	<script src ="https://kit.fontawesome.com/7748e27a7d.js"></script>
	<style type="text/css">
	</style>
</head>
<body>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1> </h1>
				<a href="admin.php"><i class="fa fa-home"></i>Home</a>
			</div>
		</nav>
	<div class="reg">
		<div class="form">
			<?php
        if(@$_GET['Empty']==true)
        {
    	?>
        <div class="error"><?php echo "<h4 style = 'color:red;'>". $_GET['Empty']. "</h4>" ?></div>
      <?php
        }
      ?>

			<form method="POST" style="text-align: center;">
				<i class="fas fa-user-plus" style="font-size: 22px; color:lightblue;text-shadow:2px 2px 4px #000000;"></i>
				<span class="title">Add New Employee</span> <br><br>
				<input type="text" name="fname" placeholder="First Name"> 
				<input type="text" name="mname" placeholder="Middle Name"> 
				<input type="text" name="lname" placeholder="Last Name">
				<input type="date" name="bday">
				<input type="text" name="email" placeholder="Email"> 
				<input type="text" name="num" placeholder="Phone Number"> 
				<hr>
				<input type="text" name="uname" placeholder="Username">
				<input type="password" name="pass" placeholder="Password">
				<input type="password" name="conpass" placeholder="Confirm Password"> <br>
				<hr>
				<button type="submit" name="add">ADD EMPLOYEE</button>
			</form>
<?php
session_start();
require_once 'dbconnect.php';
if (!isset($_SESSION['name'])) {
  header('location: login.php');
}
if(isset($_POST['add']))
{
	function function_alert($message) {
		echo "<script>alert('$message');</script>";
	}
	if ($_POST['pass'] === $_POST['conpass']) {
		$fName = $_POST['fname'];
		$mName	= $_POST['mname'];
		$lName = $_POST['lname'];
		$bDay = $_POST['bday'];
		$eMail = $_POST['email'];
		$pNumber = $_POST['num'];
		$uName = $_POST['uname'];
		$pWord = $_POST['pass'];

		$check = "SELECT * FROM user_info where user_name = '$uName' ";
		$result = mysqli_query($con, $check);

		if (mysqli_num_rows($result) > 0) {
			function_alert("Username Already Taken!");
		}else{
			$sql = "INSERT INTO user_info (first_name, middle_name, last_name, birthday, phone_number, email, user_name, password, status, picture)
	       		 VALUES ('$fName', '$mName','$lName','$bDay','$pNumber','$eMail','$uName','$pWord','employee', 'ProfilePic/default.jpg')";
	    if ($con -> query($sql) == TRUE){
	       			echo "<p align = center>Employee Added </p>";
	    }else
	       			echo "Error: " . $sql . "<br>" . $con->error;		
		}
	}else{
		if(empty($_POST['fname']) || empty($_POST['mname']) || empty($_POST['lname']) || empty($_POST['bday']) || empty($_POST['email']) || empty($_POST['num']) || empty($_POST['uname']) || empty($_POST['pass']) || empty($_POST['conpass'])){
			header("location:addemp.php?Empty= All fields Requires an Input!");
		  }else{
			function_alert("Password and Confirm Password are not the same!");
		  }
		
	}
  
}
	

$con->close();

?>
		</div>
	</div>

</body>
</html>