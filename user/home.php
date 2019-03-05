<?php
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
$page = filter_input(INPUT_GET, 'page');
//$page = base64_decode(filter_input(INPUT_GET, 'page'));
 $session_id = session_id();
error_reporting(E_ERROR | E_PARSE);
?>
<?php
	class HomePage extends mysqli{
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

	    private $userEmail = false;
	    private $userPass = false;
	    public function checkInput(string $email, string $pass){
	    	if(!empty($email)){
	    		$this->userEmail = $this->real_escape_string($email);
	    		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
	    			echo "Invalide email address...";
	    		}else{
	    			if(!empty($pass)){
	    				$this->userPass = $this->real_escape_string($pass);
	    			}else{
	    				echo "Enter your password";
	    			}
	    		}
	    	}else{
	    		echo "Please Enter Your Email...";
	    	}
	    }

	    public function verifylogInfo(){
	    	if(($this->userEmail && $this->userPass) == true){
	    		$email_find_query = "SELECT * FROM `e_com`.`user_data` WHERE `user_email`='$this->userEmail'";
	    		$query_result =  $this->query($email_find_query);
	    		if($query_result == true){
	    			$user_all_data = $query_result->fetch_assoc();
	    			if($this->userEmail == $user_all_data['user_email'] && $this->userPass == $user_all_data['user_pass']){
	    					$user_email=$user_all_data['user_email'];
	    					//$user_name = $user_all_data['user_name'];
	    					// $_SESSION['user_email']=true;
	    					$_SESSION['user_email'] = $user_email;
	    					
	    					//header("location:home.php");
	    					 //var_dump($_SESSION['user_email']);
	    					
	    					echo "<script>swal('LogIn Successfull', 'clicked the button! to continue shopping', 'success');</script>";
	    					echo "<meta http-equiv='refresh' content='0;url='>";

	    			}else{
	    				//$_SESSION['null'] = false;
	    				//echo "<meta http-equiv='refresh' content='0;url='>";
	    				echo "<script>swal('Can not LogIn', 'Your info is not correct.! Please try Again..', 'error')</script>";
	    			}
	    		}else{
	    			echo "error query";
	    		}
	    	}
	    }
	}
		
$home_obj = new HomePage();
$home_obj->connection('localhost','root');
$home_obj->DB_select('e_com');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
	<title>E-com || Online Shoping</title>
	<link rel="icon"  href="../img/icon-shop.png">
	<link rel="stylesheet" type="text/css" href="fontawesome-free-5.3.1-web/css/all.css">
	<link rel="stylesheet" type="text/css" href="css/home.css">
	<script src="js/sweetalert.min.js">
		import swal from 'sweetalert';

	</script>
	
</head>
<style type="text/css">
	
</style>
<body>
	<?php
	//this statement for cout sessin addd product
		$sql = "SELECT count(session_id) AS total FROM `e_com`.`e_com_addcart` WHERE `session_id`='$session_id'";
		//$add_cart_select = "SELECT * FROM `e_com`.`e_com_addcart` WHERE `session_id`='$session_id'";
		$add_cat_table = $home_obj->query($sql);
		$add_cart_all_data = $add_cat_table->fetch_object();
		$num_rows = $add_cart_all_data->total;
		
	?>
	<div class="main_navbar_sec" id="myHeader">
		<div class="navbar_main_container">
			<div class="navbar_logo_sec">
				<ul>
					<li class="all_menu" style="width:40%; font-size:50px; font-weight:bold;">&equiv;</li>
					
					<li>
						
						<a href="home.php">
						<h2 style="width: 60%">
							<span style="color:#009999;">a</span><span style="color:#FF9900; font-size: 50px;" >2</span><span style="color:#009999;">z</span>
						</h2>
						</a>
					</li>
				</ul>
			</div>
			
			<!--  -->

			<?php
			$user_email=$_SESSION['user_email'];
			$query_user_table = $home_obj->query("SELECT * FROM e_com.user_data WHERE user_email = '$user_email'");
			$all_dataBy_email = $query_user_table->fetch_object();

			$user_name = $all_dataBy_email->user_name;
				
			?>
			<div class="navbar_search_bar">
				<form method="post">
					<input type="text" name="search" placeholder="Search..." />
					<input type="submit" name="click_search" value="Search" />
				</form>
			</div>
			
			<div class="header_container_03">
				<div class="list_column_01">
					<div class="list_content_01 hover">
						<span style="color: #FF9900;"><i style="font-size: 28px; color: #FF9900;" class="fal fa-caret-square-down"></i><span style="font-size: 18px; margin-left: 10px;">More</span></span>

					</div>
					<div class="help_details_content">
						<div id="arrow"></div>
						
					</div>
				</div>
				<div class="list_column_02">
					<div class="list_content_02 hover">
						<span style="color: #FF9900;"><!-- Your<br><strong> Account</strong> --><i style="font-size: 28px; color: #FF9900;" class="fal fa-user"></i><span style="font-size: 18px; margin-left: 10px;"><?php print $user_name;?></span></span>
					</div>
						
					<div class="account_login_section">
						<div id="arrow"></div>
						<div class="account_cotnent">
						<!-- <form action="" method="post"> -->
							<?php
								if($_SESSION['user_email'] == true){

							?>
							<form method="post">
							<input name="logout" type="submit" value="Logout"><br><br>
						</form>
							<?php
								}else{
							?>
							<input type="submit" name="log_in" value="LogIn"  onclick="document.getElementById('id01').style.display='block'" style="width:auto;"/><br><br>
								<?php
									}

								?>
								<?php
								
									if($_SESSION['user_email'] == false){
								?>
							
							<p>New coustomer?&nbsp;<a href="home.php?page=sign_up">sign up</a></p><br>
							<?php
								}else{
							?>
							<p>To &nbsp;<a href="home.php?page=sign_up"><?php print $user_name;?></a></p><br>
							<?php
								}
							?>
							<hr style="color: rgba(0,0,0,0.2);">
							<br>
							<label>Your order number</label><br>
							<input type="text"><br><br>
							<label for="" type="text">Your email</label><br>
							<input type="text"><br><br>
							<input type="submit" name="treak" value="Treak" /><br><br>
						<!-- </form> -->
					</div>

					</div>
				</div>
				<div class="list_column_03">
					<?php
						//$i=0;
						//while($add_cart_all_data = $add_cat_table->fetch_assoc()){
							//++$i;
							//echo "<meta http-equiv='refresh' content='0;url='>";
						//}
					?>
					<div class="list_content_03 hover">
						<a href="home.php?page=cart_details"><span style="font-size: 28px; color: #FF9900;"><i #id ="cart_icon_style" class="fal fa-shopping-cart"></i>&nbsp;<span style="">(<?php print $num_rows?>)</span></span></a>
					</div>
				</div>
			</div>
		</div>
	</div>
								
<?php
	$user_email = filter_input(INPUT_POST, 'user_email');
	$user_pass = filter_input(INPUT_POST, 'user_pass');
	//$_SESSION['user_email'] = false;
	// $ck_session = session_id();
	// echo $ck_session;
	// ($_SESSION['user_email']);
?>
	<div id="id01" class="modal">
  
  <form class="modal-content animate" action="" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <h3><span style="color:#009999;">a</span><span style="color:#FF9900; font-size: 30px;" >2</span><span style="color:#009999;">z</span> login</h3>
    </div>
	
    <div class="container">
      <label for="uname"><b>User Email</b></label>
      <input type="text" placeholder="Enter UserEmail" name="user_email" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="user_pass" required>
        
      <button type="submit" name="submit">Login</button>
      <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>
    </div>
	<div class="action_div">
		<?php
			if(isset($_POST['submit'])){
				$home_obj->checkInput($user_email,$user_pass);
				$home_obj->verifylogInfo();

			}
			if(isset($_POST['logout'])){
				//session_destroy();
				$_SESSION['user_email'] = false;
				echo "<meta http-equiv='refresh' content='0;url='>";
			}
		?>

	</div>
    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" id="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

		

	<!--  -->

	<!-- mid contant -->

	<div class="page_contant_sec">
		<?php

			switch ($page) {
				case 'product':
					require 'product_page.php';
					break;
				case 'add_cart':
					require 'add_cart_page.php';
					break;
				case 'sign_up':
					require 'user_sign_up.php';
					break;
				case 'cart_details':
					require 'cart_details.php';
					break;
				case 'shopping_cart':
					require 'shopping_cart.php';
					break;
				default:
					require 'home_page_content.php';
					break;
			}
		?>
	</div>
	<!--  -->

	<div class="showSideNav">
		
		<div id="mySidenav" class="sidenav">
		  <a href="#" id="about">About</a>
		  <a href="#" id="blog">Blog</a>
		  <a href="#" id="projects">Projects</a>
		  <a href="#" id="contact">Contact</a>
		</div>
	</div>
	<!--  -->
	<div class="footer_main_content_section">
	<div class="footer_content_section">
		
		
		
		<div class="fotter_container">
		<div class="fotter_content">
			<div class="col">   
				<!-- 1 -->
				<h4>Coustomer Service</h4>
					<a href="">Help center</a><br>
					<a href="">How to shop on a2z</a><br>
					<a href="">Treak your order</a><br>
					<a href="">Why shop on a2z</a><br>
					<a href="">Replance & refused</a><br>
					<a href="">Concuct us</a><br>
					<a href="">Payment partners</a><br>

					<h4 style="margin-top: 15px;">Make Money with Us</h4>

					<a href="">Become a Sales Consultant</a><br>
					<a href="">Become an Affiliate Partner</a><br>
					<a href="">Seller Hub</a><br>
					<a href="">Code of Conduct</a><br>
			</div>

<!-- 3 -->

			<div class="col">
					<h4>About Us</h4>
					<a href="">Help center</a><br>
					<a href="">How to shop on a2z</a><br>
					<a href="">Treak your order</a><br>
					<a href="">Why shop on a2z</a><br>
					<a href="">Replance & refused</a><br>
					<a href="">Concuct us</a><br>
					<a href="">Payment partners</a><br>

					<h4 style="margin-top: 15px;">Get to Know Us</h4>
					<a href="">Press Corner</a><br>
					<a href="">Visit our Blog</a><br>
			</div>

<!-- 3 -->

			<div class="col">
					<h4>a2z International</h4>
					<a href="">Nepal</a><br>
					<a href="">Pakistan</a><br>
					<a href="">Treak your order</a><br>
					<a href="">Myanmar</a><br>
					<a href="">Sri Lanka</a><br>
					<a href="">India</a><br>
			</div>

<!-- 4 -->

			<div class="col">
				<h4>Join Us</h4>
			<ul>
				<li><a href=""><img src="images/logo/facebook.jpg" alt=""></a></li>
				<li><a href=""><img src="images/logo/youtuve.png" alt=""></a></li>
				<li><a href=""><img src="images/logo/google+.png" alt=""></a></li>
				<li><a href=""><img src="images/logo/isstrgram.jpg" alt=""></a></li>
				<li><a href=""><img src="images/logo/turtwewx.png" alt=""></a></li>
				<!-- <li><a href=""><img src="../images/logo" alt=""></a></li> -->
			</ul>
			<br><br><br>
			<h4>Payment method & payment partner</h4>
			<ul>
				<li><a href=""><img src="images/logo/bikashx.png" alt=""></a></li>
				<li><a href=""><img src="images/logo/mastercard.png" alt=""></a></li>
				<li><a href=""><img src="images/logo/visa.png" alt=""></a></li>
				<li><a href=""><img src="images/logo/cash.png" alt=""></a></li>
			</ul>
			</div>
		</div>
	</div>
		
		
		
	</div>
	
</div>
<div class="credit_sec">
		<div class="credit_content_sec">
			<p>DEsign & Devoloped by <a href="">Anik Anwar</a></p>
		</div>
	</div>
<script>
window.onscroll = function() {myFunction()};

var header = document.getElementById("myHeader");
var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}

// let preScroll = window.pageYOffset;
// window.onscroll = function(){
// 	let currentScroll = window.pageYoffset;
// 	if(preScroll > currentScroll){
// 		document.getElementById('myHeader').style.top = '0';
// 	}else{
// 		document.getElementById('myHeader').style.top = '-50px';
// 	}
// } 
</script>
<?php

//$_SESSION['user_email'] = null;
?>
</body>
</html>