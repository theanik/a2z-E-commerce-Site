<?php 
	if(!isset($_SESSION)){
		session_start();
	}

?>
<?php
 /**
  * user sugn up class
  */
 class UserSignup extends mysqli
 {
 	public function cunnection(string $hostNmae,string $userNane){
			$this->connect($hostNmae,$userNane);
			if($this->connect_error){
				echo ("Error to connect".$this->connect_error);
			}
		}
		public function db_select(string $db_name){
			if(!$this->select_db($db_name)){
				echo ('Database not found'.$this->error);
			}
		}
	public $userName = false;
	public $userEmail = false;
	public $userPhone = false;
	public $userPass = false;
	public $date_of_birth = false;
	public $Gender = false;
	public $userAddress = false;


	public function userSingUpData(){
		if(($this->userName && $this->userEmail && $this->userPhone && $this->userAddress && $this->userPass) == true){
			$user_data_insert_query = "INSERT INTO `e_com`.`user_data` (user_name, user_email, user_phone_number, user_pass, date_of_birth, gender, user_address) VALUES ('$this->userName','$this->userEmail','$this->userPhone','$this->userPass','$this->date_of_birth','$this->Gender','$this->userAddress')";
			$user_data_insert_query_result = $this->query($user_data_insert_query);
			if($user_data_insert_query_result == true){
				if($this->affected_rows > 0){
					echo "<script>alert('Welcome to you a2z shopping')</script>";
				}else{
					echo "<script>alert('somethig mau wrong....please try again')</script>";
				}
			}else{
				echo "querry error";
			}
		}
	}

 }
$signUp_obj = new UserSignup();
$signUp_obj->cunnection('localhost','root');
$signUp_obj->db_select('e_com');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>user sign up</title>
	<link rel="stylesheet" href="css/user_sign_up.css">
</head>
<style type="text/css">
	
</style>
<body>
	<div class="sign_up_from_main_header">
		<h2>Create your a2z Account</h2>
	</div>
<?php
	$nameError = $emailError = $phoneError = $passError = "";
	$user_name = $user_email = $user_phone = $date_of_birth = $user_address = "";
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		if(empty($_POST['user_name'])){
			$nameError = "User Name is required";
		}else{
			$user_name = filter_input(INPUT_POST, 'user_name');
		}
		if(!empty($_POST['user_email'])){
			
			if (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
			     $emailError = "Invalid email format"; 
			   }else{
			   	$user_email = filter_input(INPUT_POST, 'user_email');
			   }

		}else{
			
			$emailError = "User Email is required";
			
		}
		if(empty($_POST['user_phone'])){
			$phoneError = "User phonenumber is required";
		}else{
			$user_phone = filter_input(INPUT_POST, 'user_phone');
		}
		if(empty($_POST['user_password'])){
			$passError = "User Password is required";
		}else{
			$user_password = filter_input(INPUT_POST, 'user_password');
		}
		$month = filter_input(INPUT_POST, 'date_of_birth_month');
		$date = filter_input(INPUT_POST, 'date_of_birth_date');
		$year = filter_input(INPUT_POST, 'date_of_birth_year');
		$date_of_birth = $month."-".$date."-".$year;
		$gender = filter_input(INPUT_POST, 'gender');
		$user_address = filter_input(INPUT_POST, 'user_address');
	}
	
	if(isset($_POST['sign_up'])){
		if(($user_name && $user_email && $user_phone)==true){

		$signUp_obj->userName = $user_name;
		$signUp_obj->userEmail = $user_email;
		$signUp_obj->userPhone = $user_phone;
		$signUp_obj->userPass = $user_password;;
		$signUp_obj->date_of_birth = $date_of_birth;
		$signUp_obj->Gender = $gender;
		$signUp_obj->userAddress = $user_address;
		$signUp_obj->userSingUpData();
	}
	}


?>
	<div class="sign_up_form_container">
		<div class="sign_up_from_main">
			
			<form method="post" enctype="multipart/form-data" autocomplete="off">
				<div class="sign_up_from_main_left">
					<fieldset>
						<ul>
							<li><label>Full Name</label><span class="error_elert"><?php print $nameError;?></span></li>
							<li><input type="text" name="user_name" placeholder="Enter Full Name" value="<?=$user_name?>"></li>
						</ul>
					</fieldset>
					<fieldset>
						<ul>
							<li><label>Email</label><span class="error_elert"><?php print $emailError;?></span></li>
							<li><input type="text" name="user_email" placeholder="Enter Email" value="<?=$user_email?>"></li>
						</ul>
					</fieldset>
					<fieldset>
						<ul>
							<li><label>Phone</label><span class="error_elert"><?php print $phoneError;?></span></li>
							<li><input type="text" name="user_phone" placeholder="Enter your phonenumber" value="<?=$user_phone?>" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"></li>
						</ul>
					</fieldset>
					<fieldset>
						<ul>
							<li><label>Password</label><span class="error_elert"><?php print $passError;?></span></li>
							<li><input type="Password" name="user_password" placeholder="Enter your password" value=""></li>
						</ul>
					</fieldset>
					<fieldset>
						<ul>
							<li><label>Birthday</label></li>
							<li><select name="date_of_birth_month" id="" rows="">
								<option hidden="">Month</option>
								<option value="1">January</option>
								<option value="2">Febuary</option>
								<option value="3">March</option>
								<option value="4">April</option>
								<option value="5">May</option>
								<option value="6">June</option>
								<option value="7">July</option>
								<option value="8">August</option>
								<option value="9">September</option>
								<option value="10">October</option>
								<option value="11">Nobember</option>
								<option value="12">December</option>
								
							</select>
								<select name="date_of_birth_date" id="" rows="7">
									<option value="">Date</option>
									<?php
										for ($i=1; $i <=31 ; $i++) { 
											# code...
										
									?>
									<option><?=$i?></option>
									<?php
										}
									?>
									

								</select>
								<select name="date_of_birth_year" id=""  rows="7">
									<option value="">Year</option>
									<?php
										for ($i=1950; $i <=2015 ; $i++) { 
											# code...
										
									?>
									<option><?=$i?></option>
									<?php
										}
									?>
								</select>
							</li>
						</ul>
					</fieldset>
					<fieldset>
						<ul>
							<li><label>Gender</label></li>
							<li><span class="gender">Female</span><input type="radio" name="gender" value="female"><span class="gender" style="margin-left: 20px;">Male</span><input type="radio" name="gender" value="male">
							</li>
							
						</ul>
					</fieldset>
				</div>
				<div class="sign_up_from_main_right">
					<fieldset>
						<ul>
							<li><label>Address</label></li>
							<li><textarea name="user_address" id="" rows="3" ><?=$user_address?></textarea></li>
						</ul>
					</fieldset>
					<fieldset>
						<ul>
							<li><input type="checkbox" checked><span style="color: rgba(0,0,0,0.5); font-size: 12px; margin-left:10px;"> Keep me sign up</span></li>
							<li><input type="submit" name="sign_up" value="Sing Up" id="sign_up"></li>
							<li><span style="font-size: 12px;color: rgba(0,0,0,0.3);">By clicking "SIGN UP" I agree to <a href="" style="text-decoration: none; color: skyblue;">a2z</a> Policy</span></li>
							<li><span style="font-size: 12px;color: rgba(0,0,0,0.3);">OR,sign up with</span></li>
							<li><input type="submit" value="Sing Up With Email" id="Sign_up_email"></li>
							<li><button class="sign_up_facebook"><i class="fab fa-facebook-f"></i>&nbsp;&nbsp;facebook</button><button class="sign_up_Gp"><i class="fab fa-google-plus-g"></i>&nbsp;&nbsp;Google +</button></li>
						</ul>
					</fieldset>
				</div>
			</form>
		</div>
	</div>
</body>
</html>