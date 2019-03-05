<?php
if(isset($_POST['continue_a2z'])){
	echo ("<script>location.href='home.php'</script>");
	session_start();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<style type="text/css">
	*{
		margin: 0 auto;
		padding: 0;
		box-sizing: border-box;
	}
	body{
		background: #F4F4F4;
	}
	.show_massege_container{
		width: 70%;
		
		padding: 5px;
		border:0.5px solid #CCCC;
		box-shadow: 1px 3px 5px #cccc;
		background: #FFFFFF;
		height: 500px;
		margin: 50px auto;
		padding: 20px;
		font-family: sans-serif;
	}

	.show_massege_main{
		width: 100%;
		float: left;
		padding: 5px;
	}
	.header_msg{
		width: 100%;
		float: left;
		padding: 10px;
		text-align: center;
		color: #F99000;
	}
	.img_sec_container{
		width: 100%;
		float: left;
		padding: 10px;
		height: 250px; 
	}
	.img_sec_main{
		width: 80%;
		height: 100%;
		/*background: red;*/
	}
	.img_sec_main img{
		width: 100%;
		height: 100%;
	}
	.btn_and_msg_sec_cintainer{
		width: 100%;
		float: left;
		text-align: center;
		margin-top: 50px;
	}
	.btn_and_msg_sec_cintainer input[type='submit']{
		padding: 10px 20px;
		background: #F99000;
		color: #FFFFFF;
		font-size: 17px;
		cursor: pointer;
		border: none;
		box-shadow: 1px 3px 5px #CCC;
	}
</style>
<body>
	<div class="show_massege_container">
		<div class="show_massege_main">
			<div class="header_msg">
				<section>
					<h2>Happy Shopping With <span style="font-size: 40px;">a<span style="color: #009999;">2</span>z</span></h2>
				</section>
			</div>
			<div class="img_sec_container">
				<div class="img_sec_main">
					<img src="images/thank.gif" alt="">
				</div>
			</div>
			<div class="btn_and_msg_sec_cintainer">
				<form method="post">
				<input type="submit" name="continue_a2z" value="Continue To a2z">
			</form>
			</div>
		</div>
	</div>
</body>
</html>