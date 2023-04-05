<?php
session_start();
if(isset($_SESSION['id'])){
    header("location: login.php");
}
?>
<html>
    <title>
        Employee Attendance
    </title>
    <body>
    <?php
    include "emo_timein.php";
    ?>
    </body>
</html>