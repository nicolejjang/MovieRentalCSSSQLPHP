<?php
session_start();
if (!isset($_SESSION['name'])) {
  header('location: login.php');
}
require_once 'dbconnect.php';
$sql = "SELECT * FROM movies";
$result1 = mysqli_query($con, $sql);
$result2 = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="home.css">
  <script src="https://kit.fontawesome.com/fd5070ead1.js" crossorigin="anonymous"></script>
  <meta charset="utf-8">
  <title>Movie Rental System</title>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
  jQuery(document).ready(function ($) {

$('#checkbox').change(function(){
  setInterval(function () {
      moveRight();
  }, 4000);
});

var slideCount = $('#slider ul li').length;
var slideWidth = $('#slider ul li').width();
var slideHeight = $('#slider ul li').height();
var sliderUlWidth = slideCount * slideWidth;

$('#slider').css({ width: slideWidth, height: slideHeight });

$('#slider ul').css({ width: sliderUlWidth, marginLeft: - slideWidth });

  $('#slider ul li:last-child').prependTo('#slider ul');

  function moveLeft() {
      $('#slider ul').animate({
          left: + slideWidth
      }, 200, function () {
          $('#slider ul li:last-child').prependTo('#slider ul');
          $('#slider ul').css('left', '');
      });
  };

  function moveRight() {
      $('#slider ul').animate({
          left: - slideWidth
      }, 200, function () {
          $('#slider ul li:first-child').appendTo('#slider ul');
          $('#slider ul').css('left', '');
      });
  };

  $('a.control_prev').click(function () {
      moveLeft();
  });

  $('a.control_next').click(function () {
      moveRight();
  });

});    
</script>
</head>
<body>
<div class="sidebar-container">
  <div class="sidebar-logo">
     A.B.M.R: Movie Rental Website
  </div>
  <ul class="sidebar-navigation">
     <li>
      <a href="#">
        <i class="fas fa-user" aria-hidden="true"></i> User: <?=$_SESSION['name']?>
      </a>
    </li>
    <li class="header">Navigation</li>
    <li>
      <a href="Homepage2.php">
        <i class="fa fa-home"></i>Home
      </a>
    </li>
    <li>
      <a href="profile.php">
        <i class="fas fa-user"></i>  Profile
      </a>
    </li>
    <li>
      <a href="carts.php">
      <i class="fas fa-shopping-cart"></i>  Rent a Movie
      </a>
    </li>
    <li>
      <a href="logout.php">
      <i class="fas fa-sign-out-alt"></i>Logout</a>
    </li>
</div>

<div class="content-container">

  <div class="container-fluid">

  <div class="capt">
        <h1 align = center>AVAILABLE MOVIES</h1>
  </div>
<div id="slider">
  <a href="#" class="control_next">>></a>
  <a href="#" class="control_prev"><<</a>
  <ul>
    <?php
    while($row1 = mysqli_fetch_array($result1)){
      echo "<li>";?>
      <img src="<?php echo $row1['image']; ?>" width="1300px" height="1300px">
      <?php
      echo "</li>";
    }
    ?>
    </ul>
</div>

<div class="slider_option">
  <input type="checkbox" id="checkbox">
  <label for="checkbox">Autoplay</label>
</div>

      <div class="capt">
      </div>
      <div class="movies">
        <?php 
          while($row2 = mysqli_fetch_array($result2)){
            echo "<div class= first>";?>
            <img src="<?php echo $row2['image']; ?>" height="220" width="200">
            <?php
            echo "<div class= title>";
            echo "<p><u>".$row2['movie_name']."</u></p>";
            echo "<p>"."<b>"."IMDb: "."</b>".$row2['rating']."</p>";
            echo "<p>"."<b>"."Genre: "."</b>".$row2['genre']."</p>";
            echo "<p>"."<b>"."Director: "."</b>".$row2['director']."</p>";
            echo "</div>";
            echo "</div>";
          }
         ?>
        </div>
      </div>
    </div>
</div>
</body>
</html>