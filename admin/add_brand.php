<?php
if(!isset($_SESSION)){
	session_start();
}
if(!isset($_SESSION['admin_id'])){
	header('location: home.php');
}
?>
<?php
class addBrand extends mysqli
{
	//db connection
	public function db_connection(string $host_name, string $user_name){
		$this->connect($host_name, $user_name);
		if($this->connect_errno){
			echo "Error to connect...!".$this->connect_errno;
		}
	}
	public function db_select(string $db_name){
		if(!$this->select_db($db_name)){
			echo ('Database not found..!'.$this->erron);
		}

	}
	public $brand_name = false;
	public $brand_logo = false;
	public function addnewBrand(){
		if(($this->brand_name && $this->brand_logo) == true){
			$brand_add_query = "INSERT INTO `e_com`.`brand` (`brand_name`,`brand_logo`) VALUES ('$this->brand_name','$this->brand_logo')";
			$brand_add_query_result = $this->query($brand_add_query);
			if($brand_add_query_result == true){
				if($this->affected_rows > 0){
					echo "<script>alert('Brand add successfully')</script>";
				}
			}
		}else{
			echo "erron";
		}
	}
}
$obj_addBrand = new addBrand();
$obj_addBrand->db_connection('localhost','root');
$obj_addBrand->db_select('e_com');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Brand Mangement</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" media="all">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" media="all">
	<link rel="stylesheet" type="text/javascript" href="js/bootstrap.js">
</head>
<style type="text/css">
	.header_sec{
		height: 37px;
		width: 100%;
		background-color: #605CA8;
		margin-top: 16px;
	}
	.header_sec h4{
		color: #ffffff;
		padding: 2px 0px 0px 4px;
	}
	.body_sec{
		width: 100%;
		margin-top: 30px;
	}
	.label_s label{
		font-size: 40px;
		color: #605CA8;
	}
	.form_sec button{
		background-color: #605CA8;
		border:none;
		border-radius: 4%;
		margin-top: 17px;
		text-align: center;
		color: #ffffff;
		padding:8px 16px;
	}
	.form_sec button:hover{
		background-color: green;
	}
	.form_sec button:active{
		background-color: #605CA8;
	}
	#test{
		background-color: #849df0;
	}
</style>
<body>
	<div class="header_sec">
		<section>
			<h4>E-com || Add New Brand</h4>
		</section>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="body_sec">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-3">
							
						</div>
<?php
	
	
	if(isset($_POST['submit_item'])){
		
		$brand_name = filter_input(INPUT_POST, 'brand_name');
		// print $brand_name;
		$img = $_FILES['img']['tmp_name'];
		$img = addslashes($img);
		$brand_logo = file_get_contents($img);
		$brand_logo = base64_encode($brand_logo);

		
		$obj_addBrand->brand_name = $brand_name;
		$obj_addBrand->brand_logo = $brand_logo;
		$obj_addBrand->addnewBrand();
	}

?>
						<div class="col-md-6">
							<div class="form_sec">
							<form method="post" enctype="multipart/form-data">
									<label style="font-size: 20px;color: #605CA8;">Brand Name</label>
									<input type="text" name="brand_name" class="form-control" placeholder="Brand Name">
									<label style="font-size: 20px;color: #605CA8;">Brand Logo</label><br>
									<input type="file" name="img" value="" id="test" placeholder="Choose a logo"><br>
									<button class="" name="submit_item">Submit</button>
								</form>
							</div>
						</div>
						<div class="col-md-3">
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>