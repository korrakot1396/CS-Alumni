<?php

require_once 'connection.php';

session_start();

if(isset($_REQUEST['btn_forgot']))	
{
	$email	=strip_tags($_REQUEST["email"]);	
		
    if(empty($email)){
		echo "<script type='text/javascript'>alert('กรุณากรอกรหัสนิสิต...');</script>";
    }
	else
	{
        $select_stmt=$db->prepare("SELECT email FROM user WHERE email=:uemail ");
        $select_stmt->execute(array(':uemail'=>$email)); 
        $row=$select_stmt->fetch(PDO::FETCH_ASSOC); 
       
        

		
		if($email==$row["email"] ) 
		{
            $strTo = $row["email"];
	        $strSubject = "Click link for reset password";
	        $strHeader = "From: kitsada@ku.th";
	        $strMessage = "My Body & My Description";
	        $flgSend = mail($strTo,$strSubject,$strMessage,$strHeader);	
            echo "<script type='text/javascript'>alert('ส่งคำร้องไปทาง Email เรียบร้อย');</script>";
            
        }
        else
        {
            echo "<script type='text/javascript'>alert('คำร้องไม่ถูกส่งไปทาง Email');</script>";
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
    <h3>Send Email</h3>
	
    <div class="form-item">
		<input type="text" name="email" required="required" placeholder="Email" autofocus required ></input>
    </div>

    <div class="button-panel">
		<input type="submit" class="button" title="Forgot Password" name="btn_forgot" value="Send Email"></input>
    </div>



  </form>
</div>

</body>
</html>