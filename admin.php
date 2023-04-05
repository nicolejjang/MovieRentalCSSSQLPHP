<?php
session_start();
if (!isset($_SESSION['name'])) {
  header('location: login.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin Panel</title>
<style>
	a{
		text-decoration: none;
	}
	.header{
		width: 100%;
		height: 50px;
		background-color:black;
	}
	.image {
		padding-top: 5px;
	}
	.abe {
		position: absolute;
		bottom: 300px;
		left: 459px;
		color: black;
	}
	.btn {
  border: none;
  outline: none;
  padding: 10px 16px;
  background-color: black;
  cursor: pointer;
  font-size: 18px;
  border-radius: 6px;
  color: white;
}
	.but {
		padding-left: 550px;
		padding-top: 5px;
	}

.active, .btn:hover {
  background-color: orange;
  color: white;
}
.href{
	color: white;
	text-underline-position: unset;
}
</style>
</head>
<body style="background: grey;">
	<div class="header">		
	</div>
	<div class="image">
		<img src="Movies/new.jpg" height="850" width="100%" alt="theater">
		<div class="abe"> <h1 style="font-size: 100px;"> ABEMARIA'S THEATER </h1></div>
	</div>
	<div class="header">
		<div class="but">
		<button class="btn"> <a class="href" href="addmovie.php"> Add New Movie </a> </button>
		<button class="btn"> <a class="href" href="emo_timein.php"> Employee Attendance </a> </button>
		<button class="btn"> <a class="href" href="listrented.php"> List of Rented Movies </a> </button>
		<button class="btn"> <a class="href" href="addemp.php"> Add New Employee </a> </button>
		<button class="btn"> <a class="href" href="logout.php"> Log out </a> </button>
		</div>
	</div>
</body>
</html>