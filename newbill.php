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
 			<div class="col-md-4 col-md-offset-1">
 				<!-- <form > -->
 					<div class="form-group ">
 					<label for="">Products : </label>
 						<select name="products" class="form-control" id="products"  required>
 							<option value="">Select Product </option>
 							<?php 
 							include'dbconnect.php';
$select="SELECT * FROM `Products`,`Volume` WHERE Volume.v_volume=Products.p_volume";

 							$result=$con->query($select);
							while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
							{
								echo '<option value="'.$row["p_id"].'$+$'.$row["p_name"].'$+$'.$row["v_volume"].'$+$'.$row["p_price"].'">'.$row["p_name"].'&nbsp;&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;&nbsp;'.$row["v_volume"].'  &nbsp;&nbsp;&nbsp;&nbsp; Rs.'.$row["p_price"].'/-</option>';
							}
 							 
							?>
 						</select>
 					</div>
 					<div class="form-group">
 						<label for="">Quantity : </label>
 						<input type="number" id="ni" class="form-control" placeholder="No of Items...." value="4" required>
 					</div>
 					<button id="add-to-cart" class="btn btn-primary">Add Product</button>
 				<!-- </form> -->
 			</div>
 			<div class="col-md-5 col-md-offset-1">
 				<h3>Items In Cart : </h3>
 				<div id="items">
 					<table  class="table table-hover"><tr><th>Item Name </th><th>Weight</th><th>Price</th><th>Quantity</th><th>Amount</th></tr>
 					<tr></tr>
 				</div>
 			</div>
 		</div>
 	</div>
 	<!-- <div style="position: fixed;top: 0;left: 0;bottom: 0;right: 0;background-color: rgba(0,0,0,0.2);display: none;"> -->
 		<div id="print-area">
 			
 		</div>
 	</div>
   <!-- jquery -->
   <script type="text/javascript" src="js/jquery.min.js"></script>
   <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script>
  		$(document).ready(function(){
  			var list;
  			list={"items":[]};
  			var i=0;
  			$('#add-to-cart').click(function(){
  					var str=$("#products").val();
  					var nitem=$("#ni").val();
  					var res=str.split("$+$");
  					list.items[i]={"id":res[0],"name":res[1],"weight":res[2],"price":res[3],"quantity":nitem,"total":res[3]*nitem};
						printcart();
  					i++;
  			});
  			function printcart(){
  				var sum=0;
  				var thead='<table  class="table table-hover" style="max-height:50vh;overflow-y: scroll;"><tr><th>Item Name </th><th>Weight</th><th>Price</th><th>Quantity</th><th>Amount</th></tr>';
  				var tdata=thead;
  				for(var j=0;j<i+1;j++){
  				 tdata=tdata+"<tr><td>"+list.items[j].name+"</td><td>"+list.items[j].weight+"</td><td>"+list.items[j].price+"</td><td>"+list.items[j].quantity+"</td><td>"+list.items[j].total+"</td></tr>";
  				 	sum=sum+list.items[j].total;
  				}
  				tdata=tdata+'</table><div style="border-top:1px solid rgba(0,0,0,0.9);"><h4 style="float:left;">Total Amount : </h4><h4 style="float:right;">'+sum+'</h4><br><br><div class="text-center"><button class="btn btn-success" onclick="window.print();" style="font-weight:bold;">Print Bill</button></div>';
						$('#items').html(tdata);      				

  			}
  			$("#generate").click(function(){
  				$.ajaxSetup ({
  					cache: false
  				});
  				var dataString = 'list='+ encodeURIComponent(list);
  				$.ajax({
  					type: "POST",
  					url: "generate.php",
  					data: dataString,
  					success: function(msg) {
  						// $('#print-area').html(msg);
  						// alert(msg);
  						console.log(msg);
  						// $('#print-area').css("display":"block");
  					},
  					error: function(ob,errStr) {
  						// $('#output').html('ERROR TRY AGAIN......!');
  						console.log("error");
  					}
  				});
  			});
	     });
    	</script>
 </body>
 </html>