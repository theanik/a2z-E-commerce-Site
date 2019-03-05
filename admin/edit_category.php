<?php
if(!isset($_SESSION)){
	session_start();
}
if(!isset($_SESSION['admin_id'])){
	header('location: home.php');
}

$action_cat_id = base64_decode(filter_input(INPUT_GET, 'action_cat_id'));
?>
<?php
class updateCategory extends mysqli{

		public function connection(string $hostName, string $userName){
	        $this->connect($hostName, $userName);
	        if($this->connect_errno){
	            echo('Error to connect '.$this->connect_error);
	        }
	    }
		public function db_select(string $db_name){
			if(!$this->select_db($db_name)){
				echo "Database Not found..!".$this->errno;
			}
		}
		//edit cat
		public $ItemName = false;
		public $CategoryName = false;
		public $Category_image = false;
		public $CategoryId = false;
		public function updateCat(){
			if(($this->ItemName && $this->CategoryName && $this->CategoryId) == true){
			$up_query = "UPDATE `e_com`.`category` SET category_id = '$this->CategoryId', item_name = '$this->ItemName' , category_name = '$this->CategoryName',cat_img = '$this->Category_image' WHERE category_id = '$this->CategoryId'";
			$up_query_result =$this->query($up_query);
				if($up_query_result){
					if($this->affected_rows > 0){
						echo "<script>alert('Category Update successfully')</script>";
						echo "<meta http-equiv='refresh' content='0;url='";
					}else{
						echo "<script>alert('Category Update...Nothng change!!!')</script>";
						echo "<meta http-equiv='refresh' content='0;url='";
					}
				}else{
					echo "Error Query";
				}
			}else{
				echo "Error";
			}
		}
	}

$ucobj = new updateCategory();
$ucobj->connection('localhost','root');
$ucobj->db_select('e_com');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Edit Category</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" media="all">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" media="all">
	<link rel="stylesheet" type="text/javascript" href="js/bootstrap.js">
</head>
<style type="text/css">
	.head_sec{
		height: 37px;
		width: 100%;
		background-color: #605CA8;
		margin-top: 16px;

	}
	.head_sec h4{
		color: #ffffff;
		padding: 2px 0px 0px 4px;
	}
	.body_sec{
		width: 100%;
	}
	#label_s{
		font-size: 20px;color: #605CA8;
		margin-top: 7px;
	}
	button{
		padding: 8px 16px;
		background-color: #605CA8;
		border:none;
		border-radius: 4%;
		margin-top: 18px;
		text-align: center;
		color: #ffffff;
	}
	button:hover{
		background-color: green;
	}
	button:active{
		background-color: #605CA8;
	}
	.opt_sec a{
		padding: 10px 20px;
		border-radius: 3px;
		background-color: #57BFFF;
		box-shadow: rgb(0,0,0,235);
		color: #ffffff;
		text-decoration: none;
		float: right;
	}
	.opt_sec a:hover{
		background-color: #2268DE;
	}
</style>
<body>
	<div class="head_sec">
		<h4>Edit Category || Category ID : <?=$action_cat_id?></h4>
	</div>
<?php
$cat_table = $ucobj->query("SELECT * FROM `e_com`.`category` WHERE category_id='$action_cat_id'");
if($cat_table){
	if($ucobj->affected_rows > 0){
		$cat_data = $cat_table->fetch_object();
	}
}

//updet injection	
if(isset($_POST['up_cat'])){
	$item_name = filter_input(INPUT_POST, 'item_name');
	$cat_name = filter_input(INPUT_POST, 'cat_name');
	$cat_id = $action_cat_id;

	$img = $_FILES['img']['tmp_name'];
	$img = addslashes($img);
	$cat_img = file_get_contents($img);
	$cat_img = base64_encode($cat_img);

	$ucobj->ItemName = $item_name;
	$ucobj->CategoryName = $cat_name;
	$ucobj->CategoryId = $cat_id;
	$ucobj->Category_image = $cat_img;

	$ucobj->updateCat();
}
?>
	<div class="container-fluid">
		<div class="row">
			<div class="body_sec">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-3"></div>
						<div class="col-md-6">
							<form method="post" autocomplete="off" enctype="multipart/form-data">
								<label id="label_s" style="">Edit Item Name</label>
								<select name="item_name" class="form-control">
										<option><?=$cat_data->item_name?></option>
										<?php
											$item_table_select_query =$ucobj->query("SELECT * FROM `e_com`.`item`");
											if($item_table_select_query){
												if($item_table_select_query->num_rows > 0){
													while($col = $item_table_select_query->fetch_object()){
														?>
														<option><?php print $col->item_name?></option>
													<?php
												}
											}
										}
										?>
									</select>
									<label id="label_s" style="">Edit Category Name</label>
									<input type="text" name="cat_name" class="form-control" value="<?=$cat_data->category_name?>">
									<label id="label_s" style="">Category Image</label>
									<input type="file" name="img" class="form-control" placeholder="Category Image">
									<button name="up_cat">Update Category</button>
							</form>
						</div>
						<div class="col-md-3">
							<div class="opt_sec mt-4">
								<?php
	   							$url_cat_view = array('value' => base64_encode('view_category'));
	   						?>
	   						<a href="home_page.php?<?= http_build_query($url_cat_view) ?>"> < Back To View</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- <div class="row">
			<div class="form_sec">
				<form method="post">
					
				</form>
			</div>
			
		</div> -->
	</div>
</body>
</html>