<?php
session_start();
if (!isset($_SESSION['name'])) {
    header('location: login.php');
  }
include_once 'dbconnect.php';
$id = $_SESSION['id'];
$sql = "SELECT * FROM user_info where id = $id";
$result = mysqli_query($con, $sql);


if(isset($_POST['in'])){
    date_default_timezone_set('Asia/Manila');
    $time = date('g:i:a ');
    $date = date('d-m-y');
    while($row = mysqli_fetch_array($result)){
        $fname = $row['first_name'];
        $lname = $row['last_name'];
        $insert = "INSERT INTO employee_attendance (fname, lname, time_in, today_date)
                   VALUES (' $fname', ' $lname', '$time','$date')";

        if ($con -> query($insert) == TRUE){
            echo "<p align = center>Time In Complete!</p>";
        }else
            echo "Error: " . $insert . "<br>" . $con->error;
    }
}
if(isset($_POST['out'])){
    date_default_timezone_set('Asia/Manila');
    $time = date('g:i:a ');
    $date = date('d-m-y');
    while($row = mysqli_fetch_array($result)){
        $fname = $row['first_name'];
        $lname = $row['last_name'];
        $insert = "INSERT INTO employee_timeout(fname, lname, time_out, today_date)
                   VALUES (' $fname', ' $lname', '$time','$date')";
        if ($con -> query($insert) == TRUE){
            echo "<p align = center>Time Out Complete!</p>";
        }else
            echo "Error: " . $insert . "<br>" . $con->error;
    }
}
?>
<html>
    <head>
        <link rel="stylesheet" href="timeStyle.css">
        <script>
        Number.prototype.pad = function(n) {
            for (var r = this.toString(); r.length < n; r = 0 + r);
                return r;
        };
        function updateClock() {
            var now = new Date();
            var milli = now.getMilliseconds(),
            sec = now.getSeconds(),
            min = now.getMinutes(),
            hou = now.getHours(),
            mo = now.getMonth(),
            dy = now.getDate(),
            yr = now.getFullYear();
            var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            var tags = ["mon", "d", "y", "h", "m", "s", "mi"],
            corr = [months[mo], dy, yr, hou.pad(2), min.pad(2), sec.pad(2), milli];
            for (var i = 0; i < tags.length; i++)
                document.getElementById(tags[i]).firstChild.nodeValue = corr[i];
            }
            function initClock() {
                updateClock();
                window.setInterval("updateClock()", 1);
            }
        </script>
        <title>Time In Employee</title>
    </head>

    <body onload="initClock()">
        <div class="header">
        <nav class="navtop">
			<div>
				<h1> </h1>
				<a href="employee.php"><i class="fa fa-home"></i>Dashboard</a>
			</div>
		</nav>
	    </div>
        <div id="timedate">
            <a id="mon">January</a>
            <a id="d">1</a>,
            <a id="y">0</a><br />
            <a id="h">12</a> :
            <a id="m">00</a>:
            <a id="s">00</a>:
            <a id="mi">000</a>
        </div>
        <div align ="center">
            <br><br><br>
            <form method="post">
                <input type="submit" value="Time In" name ="in" style="height:50px; width:100px">
                <input type="submit" value="Time Out" name = "out" style="height:50px; width:100px">
            </form>
        </div>
    </body>
</html>