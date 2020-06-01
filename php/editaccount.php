<?php

require_once "../login/connection.php";

if(isset($_REQUEST['change']))
{
  $email	= strip_tags($_REQUEST['email']);
  $curpass	= strip_tags($_REQUEST['curpass']);
  $password= strip_tags($_REQUEST['password']);
  $confirm= strip_tags($_REQUEST['confirm']);
  

	if(empty($curpass)){
		echo "<script type='text/javascript'>alert('กรุณากรอก current password');</script>";
	}
	else if(empty($password)){
		echo "<script type='text/javascript'>alert('กรุณากรอก new password');</script>";
	}
	else if($confirm != $password){
		echo "<script type='text/javascript'>alert('กรุณากรอกรหัสผ่านให้ตรงกัน');</script>";
	} 
	else
	{
		try
		{
			$select_stmt=$db->prepare("SELECT * FROM user
										WHERE email='$email'");

			$select_stmt->execute(array(':email'=>$email));
			$row=$select_stmt->fetch(PDO::FETCH_ASSOC);
      
    

			
			if(password_verify($curpass, $row["password"]))
			{
        		$new_password = password_hash($password, PASSWORD_BCRYPT);
        
        		$query1 = "UPDATE user SET password ='$new_password' WHERE email = '$email';";
        
    
				$run = $db->prepare($query1);
				$run->execute();								
				echo "<script type='text/javascript'>alert('คุณได้ทำการเปลี่ยนรหัสผ่านแล้ว');</script>";
				header("refresh:1; indexafterlogin.php");
				}
			else
			{
				echo "<script type='text/javascript'>alert('รหัสผ่านเก่าของคุณผิด กรุณากรอกใหม่อีกครั้ง');</script>"; //แสดง message ว่า password ผิด
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

<title>Edit Account</title>

<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<script src="js/jquery-1.12.4-jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="styleeditaccount.css">


</head>
<body>

        
	<center>
	<div class="form-wrapper">
		<form action="editaccount.php" method="post">
		
        <h3>Change password</h3>
        
        <div class="form-item">
				<input type="text" name="email" required="required" placeholder="Enter email"  required ></input>
   			</div>

				<div class="form-item">
				<input type="password" name="curpass" id="myInput" required="required" placeholder="Enter current password"  required ></input>
   				</div>

				<div class="form-item">
				<input type="password" name="password" id="myInput1" required="required" placeholder="Enter new password"  required ></input>
   				</div>
				
				<div class="form-item">
				<input type="password" name="confirm"  id="myInput2" required="required" placeholder="Comfirm new password" required></input>
				</div>
				
				<input type="button"  value=" Show Password" onclick="myFunction()"> 
				
				
				<div class="button-panel">
				<input type="submit" class="button" title="Register" name="change" value="CHANGE password"></input>
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
			<br>
            <br>
            <br>
			<br>
			</center>
        
		</div>

	</div>

	</div>
</div>
<script>
function myFunction() {
  var x = document.getElementById("myInput");
  var y = document.getElementById("myInput1");
  var z = document.getElementById("myInput2");
  if (x.type  === "password") {
	x.type = "text";
  } 
  if (y.type  === "password") {
	y.type = "text";
  } 
  if (z.type  === "password") {
	z.type = "text";
  } 
  else {
	x.type = "password";
	y.type = "password";
	z.type = "password";
  }
}
</script>


	</body>
</html>
