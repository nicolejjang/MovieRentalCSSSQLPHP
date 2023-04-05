<?php
session_start();
if(!isset($_SESSION['name'])){
    header("location: login.php");
}

require_once "dbconnect.php";

if(isset($_POST['confirm'])){
    $movie_name = $_POST['movie_name'];
    $dir_name = $_POST['dir_name'];
    $genre = $_POST['genre'];
    $date = $_POST['date'];
    $rating = $_POST['rating'];
    $duration = $_POST['duration'];
    $stock = $_POST['stock'];
    $price = $_POST['price'];
    //for the poster
    $dir = "Movies";
    $file = $dir ."/".$_FILES['pic']['name'];
    $upload = move_uploaded_file($_FILES['pic']['tmp_name'], $file);
    $id = $_SESSION['id'];
    if ($upload) {
        $sql = "INSERT INTO movies (movie_name, director, genre, year_released, rating, duration, price, stock, image)
                VALUES('$movie_name', '$dir_name', '$genre', '$date', '$rating', '$duration','$price' ,'$stock', '$file')";
		$res = mysqli_query($con,$sql);
		if ($upload) {
			
		}else{
			echo "Error 101"; // Adding Error
		}
	}else{
		echo "Error 100"; //Error While Adding
	}
}
?>
<html>
<head>
    <link rel="stylesheet" href="addmovieStyle.css">
    <script src="https://kit.fontawesome.com/fd5070ead1.js" crossorigin="anonymous"></script>
    <title>Add Movie</title>
</head>

<body>
    <div class="container">
        <form class="well form-horizontal" action=" " method="post" id="contact_form" enctype="multipart/form-data">
            <fieldset>
                <!-- Form Name -->
                <legend style="font-size: 50px;text-align:center">Add New Movie!</legend>
                <div class = "form-group">
                <?php
                if($_SESSION['name'] == 'admin'){
                    echo "<a href=admin.php><i class = fa fa-home></i>Home</a>";
                }else{
                    echo "<a href=employee.php><i class = fa fa-home></i>Home</a>";
                }
                
                ?>
                
                </div>
                <!-- Text input-->

                <div class="form-group">
                    <label class="col-md-4 control-label">Movie Name</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input name="movie_name" placeholder="Ex: Red Notice" class="form-control" type="text">
                        </div>
                    </div>
                </div>

                <!-- Text input-->

                <div class="form-group">
                    <label class="col-md-4 control-label">Director</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input name="dir_name" placeholder="Ex: Rawson Thurber" class="form-control" type="text">
                        </div>
                    </div>
                </div>

                <!-- Select Basic -->

                <div class="form-group">
                    <label class="col-md-4 control-label">Genre</label>
                    <div class="col-md-4 selectContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                            <select name="genre" class="form-control selectpicker">
                                <option value=" ">Please select Genre</option>
                                <option value="Action">Action</option>
                                <option value="Adventure">Adventure</option>
                                <option value="Animaton">Animation</option>
                                <option value="Anime"> Anime</option>
                                <option value="Comedy">Comedy</option>
                                <option value="Crime and Mystery">Crime and Mystery</option>
                                <option value="Drama">Drama</option>
                                <option value="Documentary">Documentary</option>
                                <option value="Fantasy">Fantasy</option>
                                <option value="Fictoin">Fiction</option>
                                <option value="History">History</option>
                                <option value="Horror">Horror</option>
                                <option value="Romance">Romance</option>
                                <option value="Satire"> Satire</option>
                                <option value="Science Fiction"> Science Fiction</option>
                                <option value="Speculative">Speculative</option>
                                <option value="Thriller">Thriller</option>
                                <option value="Western">Western</option>
                            </select>
                        </div>
                    </div>
                </div>


                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label">Released Date</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <input name="date" placeholder="Ex: 2021-11-05" class="form-control" type="text">
                        </div>
                    </div>
                </div>


                <!-- Text input-->

                <div class="form-group">
                    <label class="col-md-4 control-label">Rating #</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                            <input name="rating" placeholder="1 to 10" class="form-control" type="text">
                        </div>
                    </div>
                </div>

                <!-- Text input-->

                <div class="form-group">
                    <label class="col-md-4 control-label">Duration</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                            <input name="duration" placeholder="0h 00m" class="form-control" type="text">
                        </div>
                    </div>
                </div>

                <!-- Text input-->

                <div class="form-group">
                    <label class="col-md-4 control-label">Price</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                            <input name="price" placeholder="Ex: 500" class="form-control" type="text">
                        </div>
                    </div>
                </div>

                <!-- Text input-->

                <div class="form-group">
                    <label class="col-md-4 control-label">Stock</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                            <input name="stock" placeholder="1 to 100" class="form-control" type="text">
                        </div>
                    </div>
                </div>

                <!-- Success message -->
                <div class="alert alert-success" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i> Thanks for contacting us, we will get back to you shortly.</div>

                <!-- Button -->
                <div class="form-group">
                 <label for="pic">Movie Poster</label>
                    <input type="file" name="pic">
                    <label class="col-md-4 control-label"></label>
                    <div class="col-md-4">
                        <button type="submit" name = "confirm" class="btn btn-warning">Confirm <span class="glyphicon glyphicon-send"></span></button>
                    </div>
                </div>

            </fieldset>
        </form>
    </div>
    </div><!-- /.container -->

</body>
</html>