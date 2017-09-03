<?php 
if (isset($_POST["pid"])) {
 	# code...
 	// echo "Data Received";
 	$pid=$_POST["pid"];
 	$pstock=$_POST["pstock"];
 	include'dbconnect.php';
 	$select="SELECT p_stock from Products WHERE p_id='$pid'";
 	$result=$con->query($select);
 	 $row = $result->fetch_assoc();

 	    $stock=$row["p_stock"];

 		 $stock=$stock+$pstock;
 	$update="UPDATE Products SET p_stock='$stock' where p_id='$pid'";
 	if ($con->query($update)) {
 		# code...
 		echo '<h3 class="text-success">Stock Updated Successfully......!</h3>';
 	}else
 		echo '<h3 class="text-danger">Failed Try Again Later</h3>';

 }else
 		echo '<h3 class="text-danger">Failed Try Again Later</h3>';


 ?>