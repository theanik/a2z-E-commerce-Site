<?php
if(!isset($_SESSION)){
	session_start();
}
if(!isset($_SESSION['admin_id'])){
	header('location: home.php');
}
?>
<?php
/**
* 
*/
class addProduct extends mysqli
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
	public $ProductName = false;
	public $ProductCode = false;
	public $ItemName = false;
	public $CategoryName = false;
	public $ProductPrice = false;
	public $ProductQuentity = false;
	public $ProductInfo = false;
	public $ProductDetails = false;
	public $ProductBrand = false;
	public function addnewPro(){
		if(($this->ProductName && $this->ProductCode && $this->ItemName && $this->CategoryName && $this->ProductPrice && $this->ProductQuentity && $this->ProductInfo && $this->ProductDetails && $this->ProductBrand) == true){

				$pro_add_query = "INSERT INTO `e_com`.`product`(`product_name`,`product_code`,`item_name`,`category_name`,`product_price`,`product_quentity`,`product_information`,`product_details`,`product_brand`)VALUES('$this->ProductName','$this->ProductCode','$this->ItemName','$this->CategoryName','$this->ProductPrice','$this->ProductQuentity','$this->ProductInfo','$this->ProductDetails','$this->ProductBrand')";

				$add_result = $this->query($pro_add_query);

				//echo $add_query_result;
				if($add_result == true){
					if($this->affected_rows > 0){
						echo "<script>alert('Product add successfully')</script>";
					}else{
						echo "<script>alert('Product is not add..!please try again...')</script>";
					}
				}else{
					echo "error query";
				}
		}else{
			echo "<script>alert('Fill up all field')</script>";
		}
	}
}

$obj = new addProduct();
$obj->connection('localhost','root');
$obj->DB_select('e_com');

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Add product</title>
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
	form{
		width: 100%;
	}
	label{
		color: #605CA8;
		font-size: 18px;
		margin-top: 10px;
		font-weight: bold;
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
	h1{
		color: #605CA8;
		font-family: sans-serif;
		margin-top: 20px;
	}
</style>
<body>
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
	
	if(isset($_POST['submit'])){
		// echo $product_name;
		// echo $product_id;
		// echo $item_name;
		// echo $cat_name;
		// echo $product_price;
		// echo $pro_info;
		// echo $pro_details;
		// echo $pro_brand;
		// echo "okkk";
		$pro_img = ($_FILES['proimg']['tmp_name']);
		for ($i=0; $i < count($pro_img); $i++) { 
			$img_name = $product_code."($i)";
			$loc = "../img/product/$img_name.jpg";
			move_uploaded_file($pro_img[$i], $loc);
		}
		$obj->ProductName = $product_name;
		$obj->ProductCode = $product_code;
		$obj->ItemName = $item_name;
		$obj->CategoryName = $cat_name;
		$obj->ProductPrice = $product_price;
		$obj->ProductQuentity = $product_quentity;
		$obj->ProductInfo = $pro_info;
		$obj->ProductDetails = $pro_details;
		$obj->ProductBrand = $pro_brand;
		$obj->addnewPro();
		// $loc = "../img/product/$product_id.jpg";
		// move_uploaded_file($_FILES['proimg']['tmp_name'], $loc);
	}
	?>
	<div class="header_sec">
		<section>
			<h4>E-com || Add New Product</h4>
		</section>
	</div>

<div class="container-fluid">
	<div class="row">
		<form method="post" enctype="multipart/form-data">
		<div class="body_sec">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-6">	
							<label>Product Name</label>
							<input type="text" name="product_name" class="form-control" placeholder="Enter Product Name">
							<label>Product Code</label>
							<input type="text" name="product_code" class="form-control" placeholder="Enter Product Code">
							<label>Item Name</label>
							<select name="item_name" id="" class="form-control">
									<option hidden="">Select Item</option>
									<?php
										$item_table = $obj->query("SELECT * FROM `e_com`.`category`");
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
							<label>Category Name</label>
							<select name="cat_name" id="" class="form-control">
									<option hidden="">Select Category</option>
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
							<label>Product Price</label>
							<input type="text" name="product_price" class="form-control" placeholder="Enter Product Price">
							<label>Product Quentity</label>
							<input type="text" name="product_quentity" class="form-control" placeholder="Enter Product Quentity">
							
					</div>
					<div class="col-md-6">
						<label>Product Information</label>
						<textarea name="pro_info" class="form-control" rows="3" placeholder="Enter Product Information"></textarea>
						<label>Product Details</label>
						<textarea name="pro_details" class="form-control" rows="3" placeholder="Enter Product Details"></textarea>
						<label>Product Image</label><br>
						<strong>Image 1</strong>
						<input type="file" name="proimg[]"><br><br>
						<strong>Image 2</strong>
						<input type="file" name="proimg[]"><br><br>
						<strong>Image 3</strong>
						<input type="file" name="proimg[]"><br><br>
						<strong>Image 4</strong>
						<input type="file" name="proimg[]"><br>
						<label>Brand Name</label>
						<select name="pro_brand" class="form-control">
							<option hidden="">Select Product Brand</option>
							<?php
								$brand_table = $obj->query("SELECT * FROM `e_com`.`brand`");
									if($brand_table){
										if($brand_table->num_rows > 0){
											while($brand_table_all_data = $brand_table->fetch_object()){
												?>
												<option><?php print $brand_table_all_data->brand_name ?></option>
												<?php
											}
										}
									}
							?>
						</select>
					</div>
				</div>
				<div class="row" style="margin-bottom: 80px;">
					<div class="col-md-3">
						<button name="submit">Submit Product</button>
					</div>
					<div class="col-md-9">
						
					</div>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>
								
</body>
</html>