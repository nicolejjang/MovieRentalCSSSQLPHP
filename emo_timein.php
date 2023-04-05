<?php
session_start();
if(!isset($_SESSION['id'])){
    header("location: login.php");
}
require_once "dbconnect.php";
$sql = "SELECT * FROM employee_attendance";
$result = mysqli_query($con, $sql);

$sql2 = "SELECT * FROM employee_timeout";
$result2 = mysqli_query($con, $sql2);
?>
<html lang="en">
<head>
    <link rel="stylesheet" href="emo_timeinStyle.css">  
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	<meta charset="utf-8" />
	<title>Table Style</title>
	<meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; width=device-width;">
</head>

<body>
<div class="table-title">
        <h3>Time In</h3>
        <a href="admin.php"><i class="fa fa-home"></i>Home</a>
</div>
<table class="table-fill">
    <thead>
        <tr>
            <th class="text-left">Id</th>
            <th class="text-left">First Name</th>
            <th class="text-left">Last Name</th>
            <th class="text-left">Time In</th>
            <th class="text-left">Date</th>
        </tr>
    </thead>
<tbody class="table-hover">
<?php
    while($row = mysqli_fetch_array($result)){
        echo "<tr>";
        echo "<td class = text-left>";
        echo "$row[id]";
        echo "</td>";
        echo "<td class = text-left>";
        echo "$row[fname]";
        echo "</td>";
        echo "<td class = text-left>";
        echo "$row[lname]";
        echo "</td>";
        echo "<td class = text-left>";
        echo "$row[time_in]";
        echo "</td>";
        echo "</td>";
        echo "<td class = text-left>";
        echo "$row[today_date]";
        echo "</td>";
        echo "</tr>";
    }
    ?>
</tbody>
</table>
<br><br>
<table class="table-fill">
    <thead>
        <tr>
            <th class="text-left">Id</th>
            <th class="text-left">First Name</th>
            <th class="text-left">Last Name</th>
            <th class="text-left">Time Out</th>
            <th class="text-left">Date</th>
        </tr>
    </thead>
<tbody class="table-hover">
<?php
    while($row2 = mysqli_fetch_array($result2)){
        echo "<tr>";
        echo "<td class = text-left>";
        echo "$row2[id]";
        echo "</td>";
        echo "<td class = text-left>";
        echo "$row2[fname]";
        echo "</td>";
        echo "<td class = text-left>";
        echo "$row2[lname]";
        echo "</td>";
        echo "<td class = text-left>";
        echo "$row2[time_out]";
        echo "</td>";
        echo "</td>";
        echo "<td class = text-left>";
        echo "$row2[today_date]";
        echo "</td>";
        echo "</tr>";
    }
    ?>
   
</tbody>
</table>
</body>
</html> 