<?php 
session_start();
if (!isset($_SESSION['name'])) {
	header('location: login.php');
}
require_once 'dbconnect.php';
if (isset($_POST['add_to_cart'])) {
	if (isset($_SESSION['shopping_cart'])) {
		$item_array_id = array_column($_SESSION['shopping_cart'], 'item_id');
		if (!in_array($_GET['id'], $item_array_id)) {
			$count	= count($_SESSION['shopping_cart']);
			$item_array = array(
						'item_id'=>$_GET['id'],
						'item_name'=>$_POST['hidden_name'],
						'item_price'=>$_POST['hidden_price'],
						'item_quantity'=>$_POST['quantity']
			);
			$_SESSION['shopping_cart'][$count] = $item_array;
		}else{
			echo '<script>alert("Item Already Added")</script>';
		}
	}else{
		$item_array = array(
						'item_id'=>$_GET['id'],
						'item_name'=>$_POST['hidden_name'],
						'item_price'=>$_POST['hidden_price'],
						'item_quantity'=>$_POST['quantity']
			);
		$_SESSION['shopping_cart'][0] = $item_array;
	}
}
if (isset($_GET['action'])) {
	if ($_GET['action'] == 'delete') {
		foreach ($_SESSION['shopping_cart'] as $key => $values) {
			if ($values['item_id'] == $_GET['id']) {
				unset($_SESSION['shopping_cart'][$key]);
				echo '<script>alert("Item Removed")</script>';
 				echo '<script>window.location="carts.php"</script>';
			}
		}
	}
}
if (isset($_POST['confirm'])) {
	if ($_POST['uname'] === $_SESSION['name']) {
		$uname = $_POST['uname'];
		$eMail = $_POST['email'];
		$phone = $_POST['phone'];
		$add = $_POST['add'];
		$pay = $_POST['payment'];

		foreach ($_SESSION['shopping_cart'] as $key => $values){
			$sql1 = "INSERT INTO orders (username,email, phone, address, payment,products,amount)
			         VALUES ('$uname','$eMail','$phone', '$add','$pay', '$values[item_name]','$values[item_price]')";

			if ($con -> query($sql1) == TRUE){
	    	}else
	       		 echo "Error: " . $sql1 . "<br>" . $con->error;

		    $sql2 = "INSERT INTO rented_movies (user_name, movie_name, quantity) 
					VALUES ('$_SESSION[name]', '$values[item_name]', '$values[item_quantity]')";
			if ($con -> query($sql2) == TRUE){
	       	    echo '<script>alert("Order Completed")</script>';
	   		}else
	            echo "Error: " . $sql2 . "<br>" . $con->error;
	    }
	}else{
		echo '<script>alert("Username not Found!")</script>';
	}
	foreach ($_SESSION['shopping_cart'] as $key => $values){
		$sql = "SELECT stock FROM movies WHERE movie_id = $values[item_id]";
		$res = mysqli_query($con,$sql);
		while ($row = mysqli_fetch_array($res)) {
			$new_stock = $row['stock'] - $values['item_quantity'];
			$sql1 = "UPDATE movies SET stock = '$new_stock' WHERE movie_id = $values[item_id]";
			$stmt = $con->prepare($sql1);
			$stmt -> execute();
		}
	}
	
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Cart</title>
	<script src="https://kit.fontawesome.com/fd5070ead1.js" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"> </script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<br>
<div class="container">
	<h3><a href="homepage2.php"><i class="fa fa-home"></i>Home</a></h3>
	<br><br><br>
	<h3 align="center"> RENT A MOVIE</h3>
	<br><br><br>
	<?php
	$sql = "SELECT * FROM movies";
	$res = mysqli_query($con, $sql);
	if (mysqli_num_rows($res)>0) {
		while($row = mysqli_fetch_array($res))
	{
	?>
	<div class="col-md-4">
		<form method="post" action="carts.php?action=add&id=<?php echo $row['movie_id']; ?>">
			<div style="border:3px solid #5cb85c; background-color:whitesmoke; border-radius:5px; padding:16px;" align="center">
				<img src="<?php echo $row['image']; ?>" height="220" width="200"><br>
				<h4 class = "text-info"><?php echo $row['movie_name']; ?></h4>
			    <h4 class="text-danger">Php <?php echo $row['price']; ?></h4>

			    <input type="text" name="quantity" value="1" class="form-control" />
			    <input type="hidden" name="hidden_name" value="<?php echo $row['movie_name']; ?>" />
			     <input type="hidden" name="hidden_price" value="<?php echo $row['price']; ?>" />
			      <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />
			</div>
		</form>
	</div>
	<?php
	}
	} 
	?>
	<div style="clear:both"></div>
	<br>
	<h3>Order Details</h3>
	<div class="table-responsive">
		<table class="table table-bordered">
			<tr>
				<th width="40%">Item Name</th>
 				<th width="10%">Quantity</th>
 				<th width="20%">Price</th>
 				<th width="15%">Total</th>
 				<th width="10%">Action</th>
			</tr>
			<?php
			if (!empty($_SESSION['shopping_cart'])) {
				$total = 0;
				foreach ($_SESSION['shopping_cart'] as $key => $values){
			?>
			<tr>
				<td><?php echo $values['item_name']; ?></td>
 				<td><?php echo $values['item_quantity']; ?></td>
 				<td><?php echo $values['item_price']; ?></td>
 				<td><?php echo number_format($values['item_quantity'] * $values['item_price'], 2);?></td>
 				<td>
 					<a href="carts.php?action=delete&id=<?php echo $values["item_id"];?>"><span class="text-danger">Remove</span></a>
 				</td>
			</tr>
			<?php
			$total = $total + ($values["item_quantity"] * $values["item_price"]);
 			}
			?>
			<tr>
				<td colspan="3" align="right">Total</td>
				<td align="right">
					Php <?php echo number_format($total, 2); ?>
				</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td><td>
				<td>
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Check Out</button>
			<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">Check Out</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form method="post" action="carts.php">
						<div class="modal-body">
							<table>
								<tr>
									<td>
										Username:
									</td>
									<td>
										<input type="text" name="uname" placeholder="Username"><br>
									</td>
								</tr>
								<tr>
									<td>
										Email:
									</td>
									<td><input type="text" name="email" placeholder="Email"><br></td>
								</tr>
								<tr>
									<td>
										Phone:
									</td>
									<td><input type="text" name="phone" placeholder="Contact Number"></td>
								</tr>
								<tr>
									<td>
										Address:
									</td>
									<td><input type="text" name="add" placeholder="Address"></td>
								</tr>
								<tr>
									<td>
										Payment Method:
									</td>
									<td>
										<select name="payment" id="payment">
											<option value="Cash">CASH</option>
											<option value="Gcash">GCASH</option>
											<option value="VISA">VISA</option>
											<option value="MASTER CARD">MASTER CARD</option>
										</select>
									</td>
								</tr>
							
							</table>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
       						<button type="submit" class="btn btn-primary" name = "confirm">Confirm</button>
						</div>
						</form>
						</div>
					</div>
				</div>
				</td>
			</tr>
			<?php 
			}
			?>
		</table>
	</div>
</div>
</body>
</html>