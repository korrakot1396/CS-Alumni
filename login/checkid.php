<?php

require_once 'connection.php';

session_start();

if(isset($_REQUEST['btn_login']))	
{
	$std_id	=strip_tags($_REQUEST["txt_id"]);	
		
    if(empty($std_id)){
		echo "<script type='text/javascript'>alert('กรุณากรอกรหัสนิสิต...');</script>";
    }
	else
	{
        $select_stmt=$db->prepare("SELECT * FROM user WHERE std_id=:uidstd ");
        $select_stmt->execute(array(':uidstd'=>$std_id)); 
		$row=$select_stmt->fetch(PDO::FETCH_ASSOC); 

		if($std_id==$row["std_id"] ) 
		{
            $_SESSION["user_login"] = $row["std_id"];	
            
			echo "<script type='text/javascript'>alert('รหัสนิสิตนี้มีอยู่ในฐานข้อมูล');</script>";	
            header("refresh:1; ../login/register.php");
            
        }
        else
        {
            echo "<script type='text/javascript'>alert('ไม่มีรหัสนิสิตนี้ในฐานข้อมูล');</script>";
        }
    }	
}









?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style3.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.min.css" />
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
    <h3>Check Student ID</h3>
	
    <div class="form-item">
		<input type="text" name="txt_id" required="required" placeholder="STUDENT ID" autofocus required ></input>
    </div>

    <div class="button-panel">
		<input type="submit" class="button" title="Log In" name="btn_login" value="Check ID"></input>
    </div>
    
    <div class="reminder">
    <p>You have a member? <a href="index.php">Login</a></p>
    <p><a href="formforgot.php">Forgot password?</a></p>
    </div>

  </form>
</div>

</body>
</html>