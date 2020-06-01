<?php

require_once "../login/connection.php";

if(isset($_REQUEST['btn_register']))
{
	$username	= strip_tags($_REQUEST['username']);
	$email     = strip_tags($_REQUEST['email']);
	$firstname = strip_tags($_REQUEST['firstname']);
	$lastname = strip_tags($_REQUEST['lastname']);
	$password	= strip_tags($_REQUEST['password']);

	if(empty($username)){
		echo "<script type='text/javascript'>alert('กรุณากรอก Username');</script>";
	}
	else if(empty($email)){
		echo "<script type='text/javascript'>alert('กรุณากรอก Email');</script>";
	}
	else if(empty($firstname)){
		echo "<script type='text/javascript'>alert('กรุณากรอก Firstname');</script>";
	}
	else if(empty($lastname)){
		echo "<script type='text/javascript'>alert('กรุณากรอก Lastname');</script>";
	}
	else if(empty($password)){
		echo "<script type='text/javascript'>alert('กรุณากรอก');</script>";
	}
	else if(strlen($password) < 6){
		echo "<script type='text/javascript'>alert('กรุณากรอกรหัสผ่านอย่างน้อย 6 ตัว');</script>";
	}
	else
	{
		try
		{
			$select_stmt=$db->prepare("SELECT email FROM user
										WHERE email='$email'");

			$select_stmt->execute(array(':email'=>$email));
			$row=$select_stmt->fetch(PDO::FETCH_ASSOC);
			


			if(!isset($errorMsg))
			{
				$new_password = password_hash($password, PASSWORD_BCRYPT);

				$query1 = "INSERT INTO user (username,password, firstname, lastname, email)
				VALUES ('$username', '$new_password', '$firstname', '$lastname', '$email');";
	
				
				$run = $db->prepare($query1);
				$run->execute();
									
				echo "<script type='text/javascript'>alert('คุณได้เพิ่มเจ้าหน้าที่ภาควิชาแล้ว');</script>";
				header("refresh:1; indexafterlogin.php");
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

 <link href="../css/cssfile.css" rel="stylesheet">
      <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
      <script src="https://kit.fontawesome.com/f818570924.js"></script>
      <script src="../js/javas.js"></script>
      <link href="https://fonts.googleapis.com/css?family=Mitr|Nunito&display=swap"
          rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
            rel="stylesheet">
      <link rel="stylesheet" href="http://www.jacklmoore.com/colorbox/example1/colorbox.css" />

<title>Add Office</title>

<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<script src="js/jquery-1.12.4-jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="styleofficer.css">

</head>
<body>

	<center>
       
		<form action="#" method="post">
			<div class="form-wrapper">
				<h3>Add Office</h3>
				<br>

				<div class="form-item">
					Username
				<input type="text" name="username" required="required" placeholder="Enter username" autofocus required ></input>
   				</div>

				<div class="form-item">
					Email
				<input type="email" name="email" required="required" placeholder="Enter email" autofocus required ></input>
   				</div>

				<div class="form-item">
					Firstname
				<input type="text" name="firstname" required="required" placeholder="Enter firstname" autofocus required ></input>
   				</div>

				<div class="form-item">
					Lastname
				<input type="text" name="lastname" required="required" placeholder="Enter lastname" autofocus required ></input>
				</div> 
				   
				<div class="form-item">
					Password
				<input type="password" name="password" required="required" placeholder="Enter passowrd" required></input>
    			</div>				
				
				<div class="button-panel">
				<input type="submit" class="button" title="Register" name="btn_register" value="ADD OFFICER"></input>
				</div>
				
				<div class="reminder">
    			<a href="indexafterlogin.php">Back</a>
  				</div>

            </form>
            <br>
			<br>
            <br>
            <br>
            <br>
            <br>
			</center>
        
		</div>

	</div>

	</div>
</div>


	</body>
</html>
