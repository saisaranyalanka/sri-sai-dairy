<?php 
include'session.php';
 ?>
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
  			<div class="col-md-10 col-md-offset-1">
  				<div role="tabpanel">
  					<!-- Nav tabs -->
  					<ul class="nav nav-tabs" role="tablist" style="width: 100%;">
  						<li role="presentation" class="active" style="width: 50%;text-align: center;">
  							<a href="#home" aria-controls="home" role="tab" data-toggle="tab" style="color: green;">Add Product</a>
  						</li>
  						<li role="presentation" style="width: 50%;text-align: center;">
  							<a href="#tab" aria-controls="tab" role="tab" data-toggle="tab" style="color: green;">Add Stock</a>
  						</li>
  					</ul>
  				
  					<!-- Tab panes -->
  					<div class="tab-content">
  						<div role="tabpanel" class="tab-pane active" id="home">
  							<div class="row">
  								<div class="col-md-6 col-md-offset-3">
  								<h3 class="text-center">Add Product</h3>
  										<div class="form-group">
  											<label for="">Product Name : </label>
  											<input type="text" class="form-control" id="" placeholder="Product Name.......">
  										</div>
  										<div class="form-group">
  											<label for="">Product Quantity : </label>
  											<select name="quantity" class="form-control" id="">
  												<option value="">Select Quantity</option>
  												<?php 
  												include 'dbconnect.php';
  												$select="SELECT * FROM `Volume`";
  												$result=$con->query($select);
													while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
													{
														echo '<option value="'.$row["v_volume"].'">'.$row["v_name"].'</option>';
													}

  												 ?>
  											</select>
  										</div>
  										<div class="form-group">
  											<label for="">Product Price : </label>
  											<input type="number" name="price" class="form-control" placeholder="Enter Price....">
  										</div>
  										<div class="form-group">
  											<label for="">Product Stock : </label>
  											<input type="number" name="stock" class="form-control" placeholder="Enter Stock....">
  										</div>
  									
  										
  									
  										<button type="submit" class="btn btn-primary">Submit</button>
  								</div>
  							</div>
  						</div>
  						<div role="tabpanel" class="tab-pane" id="tab">
  						<br>
							<div class="row">
								<div class="col-md-6 col-md-offset-3">
										 					<div class="form-group ">
										 					<label for="">Products : </label>
										 						<select name="products" class="form-control" id="stock-product"  required>
										 							<option value="">Select Product </option>
										 							<?php 
										 							include'dbconnect.php';
										$select="SELECT * FROM `Products`,`Volume` WHERE Volume.v_volume=Products.p_volume";

										 							$result=$con->query($select);
																	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
																	{
																		echo '<option value="'.$row["p_id"].'">'.$row["p_name"].'&nbsp;&nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp;&nbsp;'.$row["v_volume"].'  &nbsp;&nbsp;&nbsp;&nbsp; Rs.'.$row["p_price"].'/-</option>';
																	}
										 							 
																	?>
										 						</select>
										 					</div>
										<div class="form-group">
											<label for="">Product Stock : </label>
											<input type="number" class="form-control" id="stock-value" placeholder="Enter stock....">
										</div>
									
										
									
										<button type="submit" id="add-stock" class="btn btn-primary">Add Stock</button>
								</div>
							</div>

  						</div>
  					</div>
  				</div>
  			</div>
  		</div>
  	</div>
  	




      <!-- jquery -->
      <script type="text/javascript" src="js/jquery.min.js"></script>
      <script type="text/javascript" src="js/bootstrap.min.js"></script>
      <script>
      	$(document).ready(function(){
      		$("#add-stock").click(function(){
      			$.ajaxSetup ({
      				cache: false
      			});
      			var product=$('stock-product').val();
      			var stock=$('stock-amount').val();
      			var dataString = 'pid='+ encodeURIComponent(product)+'pstock='+ encodeURIComponent(stock);
      			$.ajax({
      				type: "POST",
      				url: "additionstock.php",
      				data: dataString,
      				success: function(msg) {
      					// $('#print-area').html(msg);
      					alert(msg);
      					// console.log(msg);
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