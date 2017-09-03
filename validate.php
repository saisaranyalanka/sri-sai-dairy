<?php		
	if (isset($_GET['email'])) {
		# code...
			$email= $_GET['email'];
			$password= $_GET['password'];
			include'dbconnect.php';
			$sqlselect = "SELECT * FROM `Staff` WHERE s_email='$email'";
			if ($result = $con->query($sqlselect))
			{
				// echo "Congrats.........you have successfully executed your query..........";
				while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
				{
					$uid=$row['s_id'];
					$uname=$row['s_name'];
		      $uemaill=$row['s_email'];
				 $upass=$row['s_password'];
				}
			}
			else
				echo "not retreved";

			if($password!=$upass)
			{
				 header("Location: /pp/dairy/");
				// echo "pass";
			}
			else
			{
				session_start();
				$_SESSION["ID"] = $uid;
				$_SESSION["NAME"] = $uname;
				header("Location: /pp/dairy/home.php");

			}
		$mysqli->close(); 
				




	}else
	{
		header('Location : /pp/dairy/');
	}

		?>
