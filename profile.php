<?php
session_start();
require_once 'dbconnect.php';

$stmt = $con->prepare('SELECT first_name, middle_name, last_name, birthday, phone_number, email, password, picture FROM user_info where id = ? ');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($fname, $mname, $lname, $bday,$u_number,$email,$password, $photo);
$stmt->fetch();
$stmt->close();
?>
<?php
function function_alert($message) {
    echo "<script>alert('$message');</script>";
}
$name = $_SESSION['name'];

if (isset($_POST['upload'])) {
	$dir = "ProfilePic";
	$file = $dir ."/". $_SESSION['id']."-".$_FILES['pic']['name'];
	$upload = move_uploaded_file($_FILES['pic']['tmp_name'], $file);
	$id = $_SESSION['id'];
	if ($upload) {
		$sql = "UPDATE user_info SET picture = '$file' WHERE id = $id ";
		$res = mysqli_query($con,$sql);
		if ($res) {
			$photo = $file;
		}else{
			echo "Error 101"; // update error
		}
	}else{
		echo "Error 100"; //Error While uploading
	}
}
if (isset($_POST['save'])) {
	if ($_POST['oldpass'] != $password) {
		function_alert("Current password is not the same with the old password!");
	}else if ($_POST['newpass'] != $_POST['Renewpass']) {
		function_alert("New password and Re Enter new password should be the same!");
	}
	$new_password = $_POST['newpass'];
	$id = $_SESSION['id'];
	$sql = "UPDATE user_info SET password = '$new_password' WHERE id = '$id' ";
	$stmt = $con->prepare($sql);
	$stmt->execute();
	$password = $new_password;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="profilestyle.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">	
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<meta charset="utf-8">
		  <meta name="viewport" content="width=device-width, initial-scale=1">
		<title></title>
		<style type="text/css">
		.user-pic {
			float: center;
		}
		.size {
			width: 10em;
		}
		</style>
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Profile</h1>
				<a href="Homepage2.php"><i class="fa fa-home"></i>Home</a>
			</div>
		</nav>
		
		<div class="content">
			<h2>User Information</h2>
			<div class="user-pic">
			<p>
			<img src="<?php echo $photo; ?>" alt = "" class="size">
			<br><br>
			<form action="" method="post" enctype="multipart/form-data">
				<input type="file" name="pic">
				<input type="submit" name="upload" value="Confirm Picture">
			</form>
			<br>
			   First Name  : <?=$fname?><br>
			   Middle Name : <?=$mname?><br>
			   Last Name   : <?=$lname?><br>
			   Birthday    : <?=$bday?>
			</p>
			
			<br>
			<h2>Contact Information</h2>
			<p>Email  : <?=$email?><br>
			   Phone Number: <?=$u_number?>
			</p>
			<h2>Account Information</h2>
			<p>Username: <?=$_SESSION['name']?><br>
			   Password: <input type="password" value="<?=$password?>" id="myInput" readonly>
			   			 <input type="checkbox" onclick="viewPassword()">Show Password
			   <script>
			   	function viewPassword(){
			   		var x = document.getElementById("myInput");
			   		if(x.type === "password"){
			   			x.type = "text";
			   		}else{
			   			x.type = "password";
			   		}
			   	}
			   </script>
			</p>		
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Change Password</button>
			<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">Change Password</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form method="post" action="profile.php">
						<div class="modal-body">
							<table>
								<tr>
									<td>
										Old-Password: 
									</td>
									<td>
										<input type="password" name="oldpass" placeholder="Old-Password"><br>
									</td>
								</tr>
								<tr>
									<td>
										New-Password: 
									</td>
									<td><input type="password" name="newpass" placeholder="New-Password"><br></td>
								</tr>
								<tr>
									<td>
										Re-Enter New Password: 
									</td>
									<td><input type="password" name="Renewpass" placeholder="Re-Enter New-Password"></td>
								</tr>
							
							</table>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
       						<button type="submit" class="btn btn-primary" name = "save">Save changes</button>
						</div>
						</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>