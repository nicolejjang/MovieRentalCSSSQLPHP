<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="registerstyle.css">
	<meta charset="utf-8">
	<title>Registration Form Part B</title>
</head>
<body>

<div class="container">        
  <div class="sidenav">
    <div class="content">
      <h1>Register Account</h1><br/>
      <p class="line"></p>
      <p> <a href="login.php"> Already a member? <br/>Login!</a></p><br/>
      </div>        
  </div>
    
  <div class="signupform">
    <div class="form" align="center">
    	<?php
        if(@$_GET['Empty']==true)
        {
    	?>
        <div class="error"><?php echo "<h4 style = 'color:red;'>". $_GET['Empty']. "</h4>" ?></div>
      <?php
        }
      ?>
    </div>
    <center>
    <form method="POST" id="form_id" name="form_id">        
      <input type="text" placeholder="First Name" id="fname" name="fname"/><br/>
      <input type="text" placeholder="Middle Name" id="mname" name="mname"/><br/>  
      <input type="text" placeholder="Last Name" id="lname" name="lname" /><br/>
      <input type="date" placeholder="Birthday" id="bday" name="bday" /><br/>  
      <input type="text" placeholder="Email" id="email" name="email" /><br/>      
      <input type="text" placeholder="Phone number" id="pno" name="pno" /><br/> 
      <hr>      
      <input type="text" placeholder="Username" id="uname" name="uname" /><br/>              
      <input type="password" placeholder="Password" id="pwd" name="pwd" minLength="5" /><br/>
      <input type="password" placeholder="Confirm-Password" id="cpwd" name="cpwd" minLength="5" /><br/>
      <button type="submit" id="signup" name="signup">
        <span class="signup">Sign up</span>
      </button>
      <div id="btnmodal" class="modal">
        <div class="modal-content">
          <p>Thanks for signing up!</p>
        </div>
      </div>
    </form></center>
    <?php
    require_once 'dbconnect.php';

		if ($con->connect_error) {
  			die("Connection failed: " . $con->connect_error);
		}
		function function_alert($message) {
    echo "<script>alert('$message');</script>";
		}
		if(isset($_POST['signup'])){
			if(empty($_POST['fname']) || empty($_POST['mname']) ||empty($_POST['lname']) || empty($_POST['bday'])||empty($_POST['email']) || empty($_POST['pno'])||empty($_POST['uname']) || empty($_POST['pwd']) || empty($_POST['cpwd'])){
				header("location:register.php?Empty= All fields Requires an Input!");
			}
		} 
		if (isset($_POST['signup'])){
			if ($_POST['pwd'] === $_POST['cpwd']) {
	    		$fName = $_POST['fname'];
					$mName	= $_POST['mname'];
					$lName = $_POST['lname'];
					$bDay = $_POST['bday'];
					$eMail = $_POST['email'];
					$pNumber = $_POST['pno'];
					$uName = $_POST['uname'];
					$pWord = $_POST['pwd'];

					$check = "SELECT * FROM user_info where user_name = '$uName' ";
					$result = mysqli_query($con, $check);

					if (mysqli_num_rows($result) > 0) {
						function_alert("Username Already Taken!");
					}else{
						$sql = "INSERT INTO user_info (first_name, middle_name, last_name, birthday, phone_number, email, user_name, password, status, picture)
	       				VALUES ('$fName', '$mName','$lName','$bDay','$pNumber','$eMail','$uName','$pWord','user', 'ProfilePic/default.jpg')";
	       		if ($con -> query($sql) == TRUE){
	       			echo "<p align = center>Signup Complete</p>";
	       		}else
	       			echo "Error: " . $sql . "<br>" . $con->error;
					}

	    	}else
	    		echo "<p align = center>Password and Confirm Password are not the same!</p>";
		$con->close();
		}
?>
  </div>      
</div>
</body>
</html>