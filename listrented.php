<?php
session_start();
if(!isset($_SESSION['id'])){
    header("location: login.php");
}
require_once "dbconnect.php";
$sql = "SELECT * FROM rented_movies";
$result = mysqli_query($con, $sql);
?>
<html lang="en">
<head>
    <link rel="stylesheet" href="listrentedStyle.css"> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	<meta charset="utf-8" />
	<title>Table Style</title>
	<meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; width=device-width;">
</head>

<body>
    <div class="table-title">
        <h3>Rented Movies</h3>
        <a href="admin.php"><i class="fa fa-home"></i>Home</a>

    </div>
<table class="table-fill">
    <thead>
        <tr>
            <th class="text-left">Id</th>
            <th class="text-left">User Name</th>
            <th class="text-left">Movie Name</th>
            <th class="text-left">Quantity</th>
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
        echo "$row[user_name]";
        echo "</td>";
        echo "<td class = text-left>";
        echo "$row[movie_name]";
        echo "</td>";
        echo "<td class = text-left>";
        echo "$row[quantity]";
        echo "</td>";
        echo "</tr>";
    }
    ?>
   
</tbody>
</table>
</body>
</html> 