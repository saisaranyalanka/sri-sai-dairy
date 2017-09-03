<?php 
include'session.php';

// echo $_SESSION['NAME'];


 ?>
 <!DOCTYPE html>
 <html>
 <head>
     <title>Sri Sai Dairy</title>
     <link rel="stylesheet" href="css/bootstrap.min.css">
     <link rel="stylesheet" href="css/style.css">
 </head>
 <body>
 	<div class="text-center">
 		<h2>Sri Sai Dairy</h2>
 	</div>
 	<hr>

 	<div class="container-fluid">
 	<div class="row">
 		<div class="col-md-2 col-md-offset-3">
 			<a href="newbill.php"><button class="btn btn-success">New Bill</button></a>
 		</div>
 		<div class="col-md-2">
 			<a href="addstock.php"><button class="btn btn-success">Add Stock</button></a>
 		</div>
 		<div class="col-md-2">
 			<button class="btn btn-success">View Reports</button>
 		</div>
 	</div>
 	<br>
 		<div class="row">
 			<div class="col-md-12">
 				<table class="table table-hover">
 						<tr>
 							<th>Product ID</th>
 							<th>Product Name</th>
 							<th>Product Quantity</th>
 							<th>Product Price</th>
 							<th>Product Stock</th>
 						</tr>
 						
<?php 
include'dbconnect.php';
$select="SELECT * FROM `Products`,`Volume` WHERE Volume.v_volume=Products.p_volume";
$result=$con->query($select);
if ($result->num_rows > 0) {
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			echo '<tr>
 							<td>'.$row["p_id"].'</td>
 							<td>'.$row["p_name"].'</td>
 							<td>'.$row["v_name"].'</td>
 							<td>'.$row["p_price"].'</td>';
 							if ($row["p_stock"]>0) {
 								# code...
 								if ($row["p_stock"]<10) {
 									# code...
 									echo '<td style="color:orange;">'.$row["p_stock"].' (Less Quantity)</td>';
 								}else
 									echo '<td>'.$row["p_stock"].'</td>';

 							}else
 									echo '<td style="color:red;">'.$row["p_stock"].' (Out of Stock)</td>';

 							
 						echo '</tr>';
		}



	}else{
		echo "No Products Found";
	}


 ?>
 				</table>
 			</div>
 		</div>
 	</div>





     <!-- jquery -->
     <script type="text/javascript" src="js/jquery.min.js"></script>
     <script type="text/javascript" src="js/bootstrap.min.js"></script>
 </body>
 </html>