<?php
$pro_name = filter_input(INPUT_POST, 'pro_name');
$pro_id = filter_input(INPUT_POST, 'pro_id');
$item_name =  filter_input(INPUT_POST, 'item_name');
$cat_name = filter_input(INPUT_POST, 'cat_name');
$pro_price = filter_input(INPUT_POST, 'pro_price');
$pro_quentity = filter_input(INPUT_POST, 'pro_quentity');
$pro_info = filter_input(INPUT_POST, 'pro_info');
$pro_details = filter_input(INPUT_POST, 'pro_details');

$pro_brand = filter_input(INPUT_POST, 'pro_brand');
if(isset($_POST['submit'])){

// $loc = "img/product/$pro_name.jpg";
// move_uploaded_file($_FILES['image']['tmp_name'], $loc);

echo $pro_name;
echo $pro_id;
echo $item_name;
echo $cat_name;
echo $pro_price;
echo $pro_quentity;
echo $pro_details;
echo $pro_brand;
echo "okkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" media="all">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" media="all">
	<link rel="stylesheet" type="text/javascript" href="js/bootstrap.js">
</head>
<style type="text/css">
	.header h1{
		color: #605CA8;
		margin-top: 30px;
		font-family: sans-serif;
	}
	.body_sec{
		width: 100%;
		margin-top: 30px;
	}
	.form_sec label{
		color: #605CA8;
		font-size: 22px;
		font-family: sans-serif;
		margin-top: 15px;
	}
	.form_sec strong{
		color: #605CA8;
		font-size: 18px;
		font-family: sans-serif;
	}
	button{
		padding: 10px 20px;
		background-color: #605CA8;
		border: none;
		color: #ffffff;
		border-radius: 2px;
		margin-top: 20px;
		cursor: pointer;
		
	}
	button:hover{
		background-color: green;
	}
	button:active{
		background-color: #605CA8;
	}
	button{
		background-color: #605CA8;
		border:none;
		border-radius: 4%;
		margin-top: 17px;
		text-align: center;
		color: #ffffff;
		padding:8px 16px;
	}
	button:hover{
		background-color: green;
	}
	button:active{
		background-color: #605CA8;
	}
	#test{
		background-color: #849df0;
	}
</style>
<body>
	<div class="container">
		<div class="row">
			<h2 style="color: #605CA8">Insert Product details</h2>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="body_sec">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6">
							<div class="form_sec">
								<form method="post" enctype="multipart/form-data">
									<label>Product Name</label>
									<input type="text" name="pro_name" class="form-control">
									<label>Product Id</label>
									<input type="text" name="pro_id" class="form-control">
									<label>Item Name</label>
									<select class="form-control" name="item_name">
										<option>Select Item</option>
									</select>
									<label>Category Name</label>
									<select class="form-control" name="cat_name">
										<option>Select Category</option>
									</select>
									<label>Product Price</label>
									<input type="text" name="pro_price" class="form-control">
									<label>Product Quentity</label>
									<input type="text" name="pro_quentity" class="form-control">
								</form>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form_sec">
								<form method="post" enctype="multipart/form-data">
									<label>Product Information</label>
									<textarea name="pro_info" class="form-control" rows="3"></textarea>
									<label>Product Details</label>
									<textarea name="pro_details" class="form-control" rows="3"></textarea>
									<label>Product Image</label><br>
									<strong>Image 1</strong>
									<input type="file" name="image"><br><br>
									<strong>Image 2</strong>
									<input type="file" name="pro_img[]"><br><br>
									<strong>Image 3</strong>
									<input type="file" name="pro_img[]"><br><br>
									<strong>Image 4</strong>
									<input type="file" name="pro_img[]"><br>
									<label>Brand Name</label>
									<input type="text" name="pro_brand" class="form-control">
								</form>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<form method="post" enctype="multipart/form-data">
								<button name="submit" type="submit">Submit</button>
							</form>
						</div>
						<div class="col-md-10"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>