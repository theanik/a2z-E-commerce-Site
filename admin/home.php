<?php
if(!isset($_SESSION)){
	session_start();
}

// if(isset($_COOKIE["log_time"])){
// 	 if(count($_COOKIE['log_time'] > 0)){
// 	 	header('location: home_page.php');
// 	 }else{

// 	 	$coockunset_query = "UPDATE `e_com`.`e_com_admin_panel` SET `Admin_active_status`='0' WHERE `Admin_id`='$admin_id'";
// 	 	$coockunset_query_result = $Alobj->query($coockunset_query);
// 	 	header('location: home.php');

// 	 }
// 	}
	// else{
	// 	header('location: home.php');
	// }
// $ck = $_COOKIE['log_time'];
// var_dump($ck);


?>
<?php

/**
* 
*/
class AdminLogin extends mysqli
{
	
	public function connection(string $hostName, string $userName){
	        $this->connect($hostName, $userName);
	        if($this->connect_errno){
	            echo('Error to connect '.$this->connect_error);
	        }
	    }
	    public function DB_select(string $databaseName){
	        if(!$this->select_db($databaseName)){
	            echo('Database not found '.$this->error);
	        }
	    }
	    protected $AdminEmail = false;
	    protected $AdminPass = false;
	    public function CheckUserInput(string $email, string $pass){
	    	if(!empty($email)){
	    		$this->AdminEmail = $this->real_escape_string($email);
	    		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
	    			echo "Invalide Email Address...!!!";
	    		}else{
	    			if(!empty($pass)){
	    				$this->AdminPass = $this->real_escape_string($pass);
	    			}else{
	    				echo "Enter Your Password.";
	    			}
	    		}
	    	}else{
	    		echo ('Please Enter your Email...');
	    	}
	    }
	    public function verifyLoginInfo(){
	    	$checkStatus = $activeStatus = NULL;
	    	if(($this->AdminEmail && $this->AdminPass) == true){
	    	  $find_query = "SELECT * FROM `e_com`.`e_com_admin_panel` WHERE Admin_email='$this->AdminEmail'";
	    	  $query_result = $this->query($find_query);
	    	  if($query_result){
	    	  	$all_data = $query_result->fetch_assoc();
	    	  	//echo $all_data['Admin_email'];
	    	  	if($this->AdminEmail==$all_data['Admin_email'] && $this->AdminPass==$all_data['Admin_password']){
	    	  			//echo "okkkkkkkkkkkkkkk";
	    	  			$admin_email = $all_data['Admin_email'];//for cookie
	    	  			$admin_pass = $all_data['Admin_password'];//for cokkie
	    	  			$checkStatus = TRUE;
	    	  			$activeStatus = $all_data['Admin_active_status'];
	    	  			$admin_id = $all_data['Admin_id'];
	    	  	}else{
	    	  		$checkStatus = FALSE;
	    	  	}

	    	  	if(!($checkStatus == FALSE)){
	    	  		if($activeStatus == true){
						echo "Can not login. This uasr are already loged in...";
	    	  		}else{
	    	  			$up_query = "UPDATE `e_com`.`e_com_admin_panel` SET `Admin_active_status`='1' WHERE `Admin_id`='$admin_id'";
	    	  			$up_query_result = $this->query($up_query);
	    	  			if($up_query_result){
	    	  				if($this->affected_rows > 0){
	    	  					$_SESSION['admin_id'] = $admin_id;

	    	  					setcookie("log_email",$admin_email, time() + 3600, '/');
	    	  					setcookie("log_pass", $admin_pass, time() + 36000,'/');
	    	  					

	    	  					header("location: home_page.php");
	    	  					$this->close();
	    	  					
	    	  				}else{
                                echo('Something went wrong...');
                            }
	    	  			}else{
	    	  				echo "Query Error";
	    	  			}
	    	  		}
	    	  	}else{
	    	  		echo "Incorrect Information...please try again.";
	    	  	}
	    	  }else{
	    	  	echo "Query Error";
	    	  }
	    	}else{
	    		echo "fill up all field";
	    	}
	    }
}
$Alobj = new AdminLogin();
$Alobj->connection('localhost','root');
$Alobj->DB_select('e_com');

?>

<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="">
	<title>E-com || admin login</title>
	<link rel="icon"  href="../img/icon-shop.png">
</head>
<style type="text/css">
	*{
		margin:0 auto;
		padding: 0;
		box-sizing: border-box;
	}
	body{
		background-color: #EEEEEE;
		font-family: sans-serif;
	}
	.admin_login_form_container{

		background-color: #ffffff;
		margin:70px auto;
		width: 50%;
		height: 480px;
		border: 0.5px #cccccc solid;
		padding: 20px;
		border-radius: 2px;
	}
	.admin_login_form_container > section{
		width: 100%;
		text-align: center;
		padding: 10px;
		border-bottom: 0.5px #cccccc dashed;
	}
	.admin_login_form_container > section > h1{
		color: #605CA8;
		font-size: 40px;
		font-style: italic;
	}
	#admin_login_form{
		padding: 10px;
		position: relative;
		width: 100%;
		border-bottom: 0.5px #cccccc dashed;
	}
	#admin_login_form > fieldset{
		border:none;
		padding: 5px;
	}
	#admin_login_form > fieldset > ul{
		list-style: none;
		margin-left: 20%;
		margin-top: 1%;
	}
	#admin_login_form > fieldset > ul >li{
		color:#605CA8;
		font-size: 20px;
		font-weight: bold;
		padding: 5px;
	}
	#admin_login_form > fieldset > ul >li > input{
		height: 35px;
		width: 60%;
		padding: 5px;
		border:1px #cccccc solid;
		color:#5a3b43;
		border-radius: 2px;
	}
	#admin_login_form > fieldset > button{
		background-color: #605CA8;
		color: #ffffff;
		text-shadow: rgb(0,0,0,0.1);
		padding: 8px 16px;
		border: none;
		text-align: center;
		margin-left: 21%;
		cursor:pointer;
	}
	#admin_login_form > fieldset > button:hover{
		background-color: #339900;
	}
	#admin_login_form > fieldset > button:active{
		background-color: #605CA8;
	}
	.footer_sec ul{
		list-style: none;
		margin-top: 20px;
		margin-left: 21%;
	}
	.footer_sec ul > li{
		padding: 2px;
		font-size: 15px;
	}
	.footer_sec a{
		color: #605CA8;
	}
	.footer_sec a:active{
		color: red;
	}
	.show_notice{
		color: red;
		text-align: center;
	}
</style>
<body>
	<div class="admin_login_form_container">
		<section>
			<h1>E-com Admin LogIn</h1>
		</section>
<?php
$email = filter_input(INPUT_POST, 'admin_email');
$password = filter_input(INPUT_POST, 'admin_pass');

?>
		<form method="post" id="admin_login_form" autocomplete="off">
			<fieldset>
				<ul>
					<li>User Name or Email</li>
					<li><input type="text" name="admin_email" placeholder="Enter Email" autofocus="" value="<?= $email; ?>">
				</ul>
			</fieldset>
			<fieldset>
				<ul>
					<li>User Password</li>
					<li><input type="Password" name="admin_pass" placeholder="Emter Password">
				</ul>
			</fieldset>
			<fieldset>
				<button name="login_submit" value="LogIn">LogIn</button>
			</fieldset>
			<fieldset>
				<div class="show_notice">
					<?php
					if(isset($_POST['login_submit'])){
						$Alobj->CheckUserInput($email,$password);
						$Alobj->verifyLoginInfo();
					}

					?>
				</div>
			</fieldset>
		</form>
		<div class="footer_sec">
			<form method="post">
				<ul>
					<li><a href="">Forgote Password?</a></li>
					<li><a href="">new in e-com admin panel?</a></li>
				</ul>
			</form>
		</div>
	</div>
</body>
</html>