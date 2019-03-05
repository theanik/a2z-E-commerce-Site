<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
   //include 'db_connect.php';
?>
<?php
	class addNewAdmin extends mysqli{
		public $admin_name = false;
		public $admin_email = false;
		public $admin_address = false;
		public $admin_pass = false;
		public $confirm_pass = false;
		public $admin_type = false;

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

		public function addAdmin(){
			$this->connection('localhost','root');
			$this->DB_select('e_com');
			if(($this->admin_name && $this->admin_email && $this->admin_address && $this->admin_pass && $this->confirm_pass && $this->admin_type) == true){
				if($this->admin_pass == $this->confirm_pass){
				$add_query = $this->query("INSERT INTO `e_com`.`e_com_admin_panel` (`Admin_name`, `Admin_email`, `Admin_address`, `Admin_password`, `Admin_type`, `Admin_active_status` ) VALUES ('$this->admin_name', '$this->admin_email','$this->admin_address', '$this->admin_pass', '$this->admin_type', '0')");
					if($add_query == true){
						if($this->affected_rows > 0){
							$this->admin_name = '';
							$this->admin_email = '';
							$this->admin_address = '';
							$this->admin_pass = '';
							$this->confirm_pass = '';
							$this->admin_type = '';
							//echo "Data ADD";
							echo "<script>alert('Admin Add Successfully')</script>";
						}
						else{
							echo "<script>alert('Admin is not Add')</script>";
						}
					}
					else{
						echo "query faild";
					}
				}else{
					echo "<script>alert('Password are not match...! Please try again')</script>";
				}
			}
			else{
				echo "not okk";
			}

		}
	}

	$add_obj = new addNewAdmin();
	

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="">
	<title>Add new Admin</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" media="all">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" media="all">
	<link rel="stylesheet" type="text/javascript" href="js/bootstrap.js">
</head>
<style type="text/css">
	body{
		font-family: Arial, Helvetica, sans-serif;
	}
	.body_sec{
		width: 100%;
	}
	.form label{
		color: #605CA8;
		font-size: 18px;
		}
	.form input{
		height: 40px;
	}
	.form button{
		background-color: #605CA8;
		border: none;
		border-radius: 2px;
		text-align: center;
		padding: 8px 15px;
		width: auto;
		color: #ffffff;
	}
	.form button:hover{
		background-color: green;
	}
	.footer_free_space{
		height: 110px;
		width: 100%;
	}
</style>
<body>
	<div class="container">
		<div class="row">
			<h1 style="color: #605CA8; margin-top: 20px;">Add New Admin</h1>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="body_sec">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-3"></div>
						<div class="col-md-6">
							<div class="form">
								<form method="post" enctype="multipart/form-data">
<?php

	$name = filter_input(INPUT_POST, 'ad_name');
	$email = filter_input(INPUT_POST, 'ad_email');
	$address = filter_input(INPUT_POST, 'ad_address');
	$password = filter_input(INPUT_POST, 'ad_pass');
	$c_password = filter_input(INPUT_POST, 'confirm_pass');
	$type = filter_input(INPUT_POST, 'admin_type');

	if(isset($_POST['submit_admin_data'])){
		$add_obj->admin_name = $name;
		$add_obj->admin_email = $email;
		$add_obj->admin_address = $address;
		$add_obj->admin_pass = $password;
		$add_obj->confirm_pass = $c_password;
		$add_obj->admin_type = $type;
		$add_obj->addAdmin();
	}
	?>
									<label>Admin Name :</label>
									<input type="text" name="ad_name" placeholder="Admin Name" required="1" class="form-control">
									<label>Admin Email :</label>
									<input type="email" name="ad_email" placeholder="Admin Email" required="1" class="form-control">
									<label class="mt-3">Admin Contact Address :</label><br>
									<textarea name="ad_address" rows="3" class="
									form-control" required="1" placeholder="Enter Admin Address"></textarea>
									<label>Admin Password :</label>
									<input type="Password" name="ad_pass" placeholder="Admin Password" required="1" class="form-control">
									<label>Confirm Password :</label>
									<input type="Password" name="confirm_pass" placeholder="Confirm Password" required="1" class="form-control">
									<label>Select Admin type :</label>
									<select class="form-control" name="admin_type">
										<option hidden="">Select Admim type</option>
										<option>Primary Admin</option>
										<option>Secoundry Admin</option>
									</select>
									<br>
									<button style="" name="submit_admin_data">Submit Admin Data</button>
								</form>
							</div>
						</div>
						<div class="col-md-3"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="footer_free_space">
		
	</div>
</body>
</html>