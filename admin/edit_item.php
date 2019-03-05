<?php
if(!isset($_SESSION)){
	session_start();
}
if(!isset($_SESSION['admin_id'])){
	header('location: home.php');
}

$action_item_id = base64_decode(filter_input(INPUT_GET, 'action_item_id'));
?>

<?php
class EditItem extends mysqli
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

	public $item_id = false;
	public $item_name = false;
	public $brand_name = false;
	public $brand_logo = false;
	public function cKInput(){
		if(!empty($brand_logo)){
			echo "Must be selected Image";
		}else{

		}
	}
	public function UpdateItem(){
		if(($this->item_id && $this->item_name && $this->brand_name && $this->brand_logo) == true){
			$item_up_query = "UPDATE `e_com`.`item` SET item_id = '$this->item_id' , item_name = '$this->item_name' , brand_name = '$this->brand_name' , brand_logo = '$this->brand_logo' WHERE item_id = '$this->item_id'";
			$item_up_query_result = $this->query($item_up_query);
			if($item_up_query_result == true){
				if($this->affected_rows > 0){
					echo "<script>alert('Item Update successfully')</script>";
					echo "<meta http-equiv='refresh' content='0;url='";
				}else{
					echo "<script>alert('Item Update...Nothing change!!!')</script>";
					echo "<meta http-equiv='refresh' content='0;url='";
				}
			}
		}else{
			echo "<script>alert('Fill Up all field')</script>";
			echo "<meta http-equiv='refresh' content='0;url='";
		}
	}
}

$obj_editItem = new EditItem();
$obj_editItem->db_connection('localhost','root');
$obj_editItem->db_select('e_com');

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" media="all">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" media="all">
	<link rel="stylesheet" type="text/javascript" href="js/bootstrap.js">
</head>
<style type="text/css">
	.header_sec{
		height: 37px;
		width: 100%;
		background-color: #605CA8;
		margin: 16px 0px 0px 0px;
	}
	.header_sec h4{
		color: #ffffff;
		padding:2px 0px 0px 4px;
	}
	.body_sec{
		width: 100%;
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
	.opt_sec a{
		padding: 10px 20px;
		border-radius: 3px;
		background-color: #57BFFF;
		box-shadow: rgb(0,0,0,235);
		color: #ffffff;
		text-decoration: none;
	}
	.opt_sec a:hover{
		background-color: #2268DE;
	}
</style>
<body>
	<div class="header_sec">
		<h4>Edit Item || Item ID : <?=$action_item_id?></h4>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="body_sec">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-3">
							
						</div>
						<div class="col-md-6">
							<div class="form_sec">
<?php
$item_table = $obj_editItem->query("SELECT * FROM `e_com`.`item` WHERE item_id = '$action_item_id'");
if($item_table){
	if($obj_editItem->affected_rows > 0){
		$item_data = $item_table->fetch_object();
	}
}

?>
<?php
	
	
	if(isset($_POST['update_item'])){
		$item_id = $action_item_id;
		$item_name = filter_input(INPUT_POST, 'item_name');
		$brand_name = filter_input(INPUT_POST, 'brand_name');
		$img = $_FILES['img']['tmp_name'];
		$img = addslashes($img);
		$brand_logo = file_get_contents($img);
		$brand_logo = base64_encode($brand_logo);

		$obj_editItem->item_id = $item_id;
		$obj_editItem->item_name = $item_name;
		$obj_editItem->brand_name = $brand_name;
		$obj_editItem->brand_logo = $brand_logo;
		$obj_editItem->UpdateItem();
		
	}

?>
								<form method="post" enctype="multipart/form-data">
									<!-- <label style="font-size: 20px;color: #605CA8;">Item ID:</label>
									<input type="text" name="item_id" class="form-control" value="<?=$item_data->item_id?>"> -->
									<label style="font-size: 20px;color: #605CA8;">Item Name</label>
									<input type="text" name="item_name" value="<?=$item_data->item_name?>" class="form-control">
									<label style="font-size: 20px;color: #605CA8;">Brand Name</label>
									<input type="text" name="brand_name" class="form-control" value="<?=$item_data->brand_name?>">
									<label style="font-size: 20px;color: #605CA8;">Brand Logo</label><br>
									<span style="color: red;">Image must be fill up</span><br>
									<input type="file" name="img" value="<?=$item_data->brand_logo?>" id="test"><br>
									
									<button class="" name="update_item">Update</button>
								</form>
							</div>
						</div>
						<div class="col-md-3 mt-5">
							<div class="opt_sec">
								<?php
	   							$url_pro_view = array('value' => base64_encode('view_item'));
	   						?>
	   						<a href="home_page.php?<?= http_build_query($url_pro_view) ?>"> < Back To View</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>