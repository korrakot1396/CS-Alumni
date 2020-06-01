<?php

require_once 'connection.php';

session_start();

if(isset($_SESSION["user_login"]))	//ตรวจสอบผู้ใช้ระบบถ้าเข้าสู่ระบบไม่ได้จะกลับไปที่ index.php
{
	header("location: ../php/indexafterlogin.php");
}

if(isset($_REQUEST['btn_login']))	//ชื่อของปุ่มคือ "btn_login"
{
	$username	=strip_tags($_REQUEST["txt_username_email"]);	//textbox name คือ "txt_username_email"
	$email		=strip_tags($_REQUEST["txt_username_email"]);	//textbox name คือ "txt_username_email"
	$password	=strip_tags($_REQUEST["txt_password"]);			//textbox name คือ "txt_password"	

	if(empty($username)){
		$errorMsg[]="please enter username or email";	//ตรวจสอบ "username/email" ใน textbox ว่าไม่ empty (ว่าง)
	}
	else if(empty($email)){
		$errorMsg[]="please enter username or email";	//ตรวจสอบ "username/email" ใน textbox ว่าไม่ empty (ว่าง)
	}
	else if(empty($password)){
		$errorMsg[]="please enter password";	//ตรวจสอบ "passowrd" ใน textbox ว่าไม่ empty (ว่าง)
	}
	

	else
	{
		try
		{
			$select_stmt=$db->prepare("SELECT * FROM user WHERE username=:uname OR email=:uemail"); //sql select query เลือกข้อมูลจากใน db จากตาราง ที่ username หรือ email ก็ได้
			$select_stmt->execute(array(':uname'=>$username, ':uemail'=>$email));	//ค้นหาด้วย parameter
			$row=$select_stmt->fetch(PDO::FETCH_ASSOC); //ดึงข้อมูลออกมาจาก db

			if($select_stmt->rowCount() > 0)	//ตรวจสอบเงื่อนไขว่า rowCount > 0 ไหม ถ้ามากกว่าให้ทำการตรวจสอบเงื่อนไขต่อไป โดยใช้ฟังก์ชัน rowCount
			{
				if($username==$row["username"] OR $email==$row["email"]) //ตรวจสอบเงื่อไขว่า row == username หรือ email ไหม
				{
					if(password_verify($password, $row["password"])) //ตรวจสอบเงื่อนไขว่า password ตรงกับ db(ฐานข้อมูล) โดยใช้ฟังก์ชัน password_verify
					{
						$_SESSION["user_login"] = $row["id"];	//session name คือ "user_login"
						$loginMsg = "Successfully Login...";		//user login success message แสดงข้อความว่า login เสร็จสิ้น
						header("refresh:1; ../php/indexafterlogin.php");			//ทำการรอ refresh 2 วินาที ก่อน link ไป welcome.php
					}
					else
					{
						echo "<script type='text/javascript'>alert('wrong username or email or password');</script>"; //แสดง message ว่า password ผิด
					}
				}
				else
				{
					echo "<script type='text/javascript'>alert('wrong username or email or password');</script>"; //แสดง message ว่า username หรือ email ผิด
				}
			}
			else
			{
				echo "<script type='text/javascript'>alert('wrong username or email or password');</script>"; //แสดง message ว่า username หรือ email ผิด
			}
		}
		catch(PDOException $e)
		{
			$e->getMessage();
		}
	}
}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.min.css" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
    html,body {   
        padding: 0;   
        margin: 0;   
        width: 100%;   
        height: 100%;             
    }   
    #overlay {   
        position: absolute;  
        top: 0px;   
        left: 0px;  
        background: #ccc;   
        width: 100%;   
        height: 100%;   
        opacity: .75;   
        filter: alpha(opacity=75);   
        -moz-opacity: .75;  
        z-index: 999;  
        background: #fff url(http://i.imgur.com/DDA1om1.gif) 50% 50% no-repeat;
    }   
    .main-contain{
        position: absolute;  
        top: 0px;   
        left: 0px;  
        width: 100%;   
        height: 100%;   
        overflow: hidden;
    }
    </style>
</head>
<body>

<div id="overlay"></div>    
<div class="main-contain">
   <?php for($i=1;$i<=2000000;$i++){?>
    <?php } ?>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>  
<script type="text/javascript">
$(function(){
    $("#overlay").fadeOut();
    $(".main-contain").removeClass("main-contain");
});
</script>    

<div class="form-wrapper">
  
  <form action="#" method="post">
    <h3>CS Alumni Login</h3>
	
    <div class="form-item">
		<input type="text" name="txt_username_email" required="required" placeholder="Username" autofocus required ></input>
    </div>
    
    <div class="form-item">
		<input type="password" name="txt_password" id = "myInput" required="required" placeholder="Password" required></input>
    </div>
	<br>
	<input type="checkbox" onclick="myFunction()"> Show Password
	
    <div class="button-panel">
		<input type="submit" class="button" title="Log In" name="btn_login" value="Login"></input>
    </div>
  </form>
 
  <div class="reminder">
    <p>Not a member? <a href="checkid.php">Sign up now</a></p>
    <p><a href="#">Forgot password?</a></p>
  </div>
  
</div>
<script>
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type  === "password") {
	x.type = "text";
  } 
  else {
	x.type = "password";
  }
}
</script>
</body>
</html>