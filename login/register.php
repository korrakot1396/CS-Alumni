<?php

require_once 'connection.php';

if(isset($_REQUEST['btn_register']))
{
	$username	= strip_tags($_REQUEST['username']);
	$password	= strip_tags($_REQUEST['password']);
	$std_id     = strip_tags($_REQUEST['std_id']);
	$confirm    = strip_tags($_REQUEST['confirm']);

	if(empty($username)){
		echo "<script type='text/javascript'>alert('กรุณากรอก Username');</script>";
	}
	else if(empty($std_id)){
		echo "<script type='text/javascript'>alert('กรุณากรอก Student ID');</script>";
	}
	else if(empty($password)){
		echo "<script type='text/javascript'>alert('กรุณากรอก รหัสผ่าน');</script>";
	}
	else if(strlen($password) < 6){
		echo "<script type='text/javascript'>alert('กรุณากรอกรหัสผ่านอย่างน้อย 6 ตัว');</script>";
	}
	else if($confirm != $password){
		echo "<script type='text/javascript'>alert('รหัสผ่านไม่ตรงกัน');</script>";
	}
	else
	{
		try
		{
			$select_stmt=$db->prepare("SELECT std_id FROM user
										WHERE std_id='$std_id'");

			$select_stmt->execute(array(':std_id'=>$std_id));
			$row=$select_stmt->fetch(PDO::FETCH_ASSOC);
			


			if(!isset($errorMsg))
			{
				$new_password = password_hash($password, PASSWORD_BCRYPT);

				$query1 = "UPDATE user SET username='$username' WHERE std_id = '$std_id';";
				$query2 = "UPDATE user SET password ='$new_password' WHERE std_id = '$std_id';";

				
			

				
				$run = $db->prepare($query1);
				$run->execute();
				$run = $db->prepare($query2);
				$run->execute();								
				echo "<script type='text/javascript'>alert('คุณได้เป็นสมาชิกแล้ว');</script>";
				header("refresh:1; logout.php");
				}
			}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
<title>CS-Alumni Register</title>

<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<script src="js/jquery-1.12.4-jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>


<link rel="stylesheet" type="text/css" href="style2.css">




</head>
<body>
	<center>
			<div class="form-wrapper">
				<h3>CS Alumni Register</h3>
				<form action="register.php" method='post'>
				
				<div class="form-item">
				<input type="text" name="std_id" required=" required"  placeholder="Enter student id"  autofocus required  ></input>
				</div>
				   
				<div class="form-item">
				<input type="text" name="username" required="required" placeholder="Enter username" autofocus required  ></input>
   				</div>
				   
				<div class="form-item">
				<input type="password"  name="password" id="myInput" required="required" placeholder="Enter passowrd" required></input>
				</div>

				<div class="form-item">
				<input type="password" name="confirm"  id="myInput1" required="required" placeholder="Comfirm Password" required></input>
    			</div>

				<input type="checkbox" onclick="myFunction()">  Show Password
				

				<div class="button-panel">
				<input type="submit" class="button" title="Register" name="btn_register" value="Register"></input>
    			</div>
				</form>

				<div class="reminder">
    			<p>You have member? <a href="index.php">Login now</a></p>
   				 <p><a href="#">Forgot password?</a></p>
  				</div>
			</form>
			<br>
			<br>
			<br>
	
			</center>
		</div>
	</div>
</div>
<script>
function myFunction() {
  var x = document.getElementById("myInput");
  var y = document.getElementById("myInput1");
  if (x.type  === "password") {
	x.type = "text";
  } 
  if (y.type  === "password") {
	y.type = "text";
  } 
  else {
	x.type = "password";
	y.type = "password";
  }
}
</script>


	</body>
</html>
