<?php
if(!isset($_SESSION)){
	session_start();
}
if(!isset($_SESSION['admin_id'])){
	header('location: home.php');
}
$pro_action_id = base64_decode(filter_input(INPUT_GET, 'pro_action_id'));
?>
<?php
/**
* 
*/
class EditProduct extends mysqli
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
	public $ProductId = false;
	public $ProductName = false;
	public $ProductCode = false;
	public $ItemName = false;
	public $CategoryName = false;
	public $ProductPrice = false;
	public $ProductQuentity = false;
	public $ProductInfo = false;
	public $ProductDetails = false;
	public $ProductBrand = false;
	public function updatePro(){
		if(($this->ProductId && $this->ProductName && $this->ProductCode && $this->ItemName && $this->CategoryName && $this->ProductPrice && $this->ProductQuentity && $this->ProductInfo && $this->ProductDetails && $this->ProductBrand) == true){

				$up_query = "UPDATE `e_com`.`product` SET product_id = '$this->ProductId' , product_name = '$this->ProductName' , product_code = '$this->ProductCode' , item_name = '$this->ItemName' , category_name = '$this->CategoryName' , product_price = '$this->ProductPrice' , product_quentity = '$this->ProductQuentity' , product_information = '$this->ProductInfo' , product_details = '$this->ProductDetails' , product_brand = '$this->ProductBrand' WHERE product_id = '$this->ProductId' and product_code = '$this->ProductCode'";

				$up_query_result = $this->query($up_query);
				if($up_query_result == true){
					if($this->affected_rows > 0){
						echo "<script>alert('Product Update successfully')</script>";
						echo "<meta http-equiv='refresh' content='0;url='";
					}else{
						echo "<script>alert('Product Update...Nothing Change!!!')</script>";
						echo "<meta http-equiv='refresh' content='0;url='";
					}
				}else{
					echo "error query";
				}
		}else{
			echo "<script>alert('Fill up all field')</script>";
		}
	}
}
$obj = new EditProduct();
$obj->connection('localhost','root');
$obj->DB_select('e_com');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Edit Product</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" media="all">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" media="all">
	<link rel="stylesheet" type="text/javascript" href="js/bootstrap.js">
</head>
<style type="text/css">
	.header_content{
		height: 37px;
		width: 100%;
		background-color: #605CA8;
		margin: 16px 0px 0px 0px;
	}
	.header_content h4{
		color: #ffffff;
		padding: 2px 0px 0px 5px;
	}
	.body_sec{
		width: 100%;
		/*background-color: #cccccc;*/
		margin: 20px 0px 0px 0px;

	}
	label{
		color: #605CA8;
		font-size: 18px;
		margin-top: 10px;
		/*font-weight: bold;*/
	}
	strong{
		color: #605CA8;
	}
	button{
		background-color: #605CA8;
		border: none;
		color: #ffffff;
		padding: 10px 20px;
		cursor: pointer;
		margin-top: 20px;
		border-radius: 2px;
	}
	button:hover{
		background-color: green;
	}
	button:active{
		background-color: #605CA8;
	}
	.free_sec{
		height: 20px;
		/*background-color: #cccccc;*/
		width: 100%;
		float: left;
		border-top: 0.2px #605CA8 solid;
		margin-top: 40px;
	}
	#back_link{
		background-color: #1188CB;
		padding: 10px 20px;
		text-decoration: none;
		color: #ffffff;
		border-radius: 3px;
		/*margin-top: 20px;*/
	}
	#back_link:hover{
		background-color: #0069D9;
	}
</style>
<body>
	<div class="header_content">
		<h4>Edit Product || Product ID : <?=$pro_action_id?></h4>
	</div>
	<?php
	$pro_table = $obj->query("SELECT * FROM `e_com`.`product` WHERE `product_id`='$pro_action_id'");
	if($pro_table){
		if($obj->affected_rows > 0){
			$pro_table_all_data = $pro_table->fetch_object();
		}
	}else{
		echo "Error Query";
	}

	?>
	<!-- update -->
	<?php
		$product_name = filter_input(INPUT_POST, 'product_name');
		$product_code = filter_input(INPUT_POST, 'product_code');
		$item_name = filter_input(INPUT_POST, 'item_name');
		$cat_name = filter_input(INPUT_POST, 'cat_name');
		$product_price = filter_input(INPUT_POST, 'product_price');
		$product_quentity = filter_input(INPUT_POST, 'product_quentity');
		$pro_info = filter_input(INPUT_POST, 'pro_info');
		$pro_details = filter_input(INPUT_POST, 'pro_details');
		$pro_brand = filter_input(INPUT_POST, 'pro_brand');

		if(isset($_POST['up_product'])){

			$pro_img = ($_FILES['proimg']['tmp_name']);
			for ($i=0; $i < count($pro_img); $i++) { 
			$img_name = $product_code."($i)";
			$loc = "../img/product/$img_name.jpg";
			move_uploaded_file($pro_img[$i], $loc);
			}

		$obj->ProductId = $pro_action_id;
		$obj->ProductName = $product_name;
		$obj->ProductCode = $product_code;
		$obj->ItemName = $item_name;
		$obj->CategoryName = $cat_name;
		$obj->ProductPrice = $product_price;
		$obj->ProductQuentity = $product_quentity;
		$obj->ProductInfo = $pro_info;
		$obj->ProductDetails = $pro_details;
		$obj->ProductBrand = $pro_brand;
		$obj->updatePro();
		}

	?>

	<form method="post" enctype="multipart/form-data">
		<div class="container-fluid">
			<div class="row">
				<div class="body_sec">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6">
							<label>Edit Product Name</label>
							<input type="text" name="product_name" class="form-control" value="<?= $pro_table_all_data->product_name?>">
							<label>Edit Product Code</label>
							<input type="text" name="product_code" class="form-control" value="<?= $pro_table_all_data->product_code?>">
							<label>Edit Item Name</label>
							<select name="item_name" id="" class="form-control" value="">
									<option><?=$pro_table_all_data->item_name ?></option>
									<?php
										$item_table = $obj->query("SELECT * FROM `e_com`.`item`");
										if($item_table){
											if($item_table->num_rows > 0){
												while($item_table_all_data = $item_table->fetch_object()){
													?>
													<option><?php print $item_table_all_data->item_name ?></option>
													<?php
												}
											}
										}
									?>
							</select>
							<label>Edit Category Name</label>
							<select name="cat_name" id="" class="form-control">
									<option><?=$pro_table_all_data->category_name ?></option>
									<?php
										$category_table = $obj->query("SELECT * FROM `e_com`.`category`");
										if($category_table->num_rows > 0){
											while($category_table_all_data = $category_table->fetch_object()){
												?>
												<option><?php print $category_table_all_data->category_name ?></option>
												<?php
											}
										}
									?>
							</select>
							<label>Edit Product Price</label>
							<input type="text" name="product_price" class="form-control" value="<?=$pro_table_all_data->product_price ?>">
							<label>Edit Product Quentity</label>
							<input type="text" name="product_quentity" class="form-control" value="<?=$pro_table_all_data->product_quentity ?>">

							</div>


							<div class="col-md-6">
							<label>Edit Product Information</label>
							<textarea name="pro_info" class="form-control" rows="4"><?=$pro_table_all_data->product_information ?></textarea>
							<label>Edit Product Details</label>
							<textarea name="pro_details" class="form-control" rows="4"><?=$pro_table_all_data->product_details ?></textarea>
							<label>Edit Product Image</label><br>
							<strong>Image 1</strong>
							<input type="file" name="proimg[]"><br><br>
							<strong>Image 2</strong>
							<input type="file" name="proimg[]"><br><br>
							<strong>Image 3</strong>
							<input type="file" name="proimg[]"><br><br>
							<strong>Image 4</strong>
							<input type="file" name="proimg[]"><br>
							<label>Edit Brand Name</label>
							<select name="pro_brand" class="form-control">
								<option><?=$pro_table_all_data->product_brand ?></option>
								<?php
									$item_table = $obj->query("SELECT * FROM `e_com`.`item`");
										if($item_table){
											if($item_table->num_rows > 0){
												while($item_table_all_data = $item_table->fetch_object()){
													?>
													<option><?php print $item_table_all_data->item_name ?></option>
													<?php
												}
											}
										}
								?>
							</select>


							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-3">
					<button name="up_product">Update Product</button>
				</div>
				<div class="col-md-6">
					
				</div>
				<div class="col-md-3 mt-4">
					<?php
						$url_pro_details = array('value' => base64_encode('pro_details'));
						//$url_pro_id = array('pro_action_id' => '');
						?>
					<a href="home_page.php?<?= http_build_query($url_pro_details)?>?&&pro_action_id=<?= base64_encode($pro_table_all_data->product_id)?>" id="back_link"> < Back To Details</a>
				</div>
			</div>
		</div>

	</form>
	<div class="free_sec">
		<h6 style="color: #605CA8; float: right;">&copy;<a href="" style="color: #605CA8;">Anik Anwar</a>    <?php echo date("Y")?></h6>
	</div>
</body>
</html>