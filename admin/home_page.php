<?php
if(!isset($_SESSION)){
	session_start();
}
if(!isset($_SESSION['admin_id'])){
	header('location: home.php');
}

// if(!isset($_COOKIE['log_time'])){
// 	header('location: home.php');
// }
include("db_connect.php");

$admin_id = $_SESSION['admin_id'];
?>
<?php
	$page = base64_decode(filter_input(INPUT_GET, 'value'))

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>E-com admin panel</title>
	<link rel="icon"  href="../img/icon-shop.png">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" media="all">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" media="all">
	<link rel="stylesheet" type="text/javascript" href="js/bootstrap.js">
</head>
<style type="text/css">
	*{
		margin: 0 auto;
		padding: 0;
		box-sizing: border-box;
	}

	.logo{
		color: #ffffff;
		position: inline-block;
		background-color: #605CA8;
		height: 80px;
		width: 100%;
		padding: 20px;
	}
	
	.dash_bar{
		position: fixed;
		background-color: #3b3b3b3b;
		height: 100%;
		padding: 0px;
		width: 22%;
		margin: 0px;
		line-height: 50px;
		margin-left: -15px;
		/*overflow-x: auto;*/
		overflow-y: scroll;
	}
	.body_section{
		width: 100%;
		padding: 0;
		margin:0;
		
	}
	.content{
		background-color: ;
		width: 100%;
		margin: 0px;
		padding: 0px;
		margin-left: -20px;
	}
	.dash_bar ul li a{
		text-decoration: none;
		text-decoration-style: none;
	}
	.dash_bar ul li:hover{
		background-color: #D2D2D2;
	}
	.logo a{
		text-decoration: none;
		color: #ffffff;
	}
	.logo a:hover{
		color: #ffffff;
		text-decoration:none;
	}




/*------------------------*/

.main_div{
	position: relative;
	display: inline-block;
}
.droup_down_div{
	display: none;
	position: absolute;
	background-color: #D2D2D2;
	min-width: 160px;
	box-shadow: rgb(0,0,0,0.8);
	z-index: 1;
	margin-left: 50px;
	border-radius: 6%;
}
.droup_down_div a{
	text-decoration: none;
	padding: 15px;
	display: block;
	padding: 12px 16px;
}
.droup_down_div a:hover{
	background-color: #FFFFFF;
}
.main_div:hover .droup_down_div{ display: block;}

.admin_profile{
	height: auto;
	padding: 10px 0px 0px 20px;
	width: 100%;
}
.admin_profile a{
	text-decoration: none;
	color: #605CA8;
}
#acitve_sign{
	height: 10px;
	width: 10px;
	background-color: green;
	float: right;
	margin-top: 20px;
	margin-right: 40px;
	border-radius: 50%;
}
#logout_btn{
	padding:2px 6px;
}
</style>
<body>
	<!-- menu bar section -->
	<!-- <div class="container-fluid">
		<div class="row">
			<div class="header_section">
				<div class="col-md-12">
					<div class="row">
						
							<div class="col-md-3" style="">
								<div class="logo">
									<a href="home_page.php?value=home"><h2>E-com</h2></a>
								</div>
							</div>
							<div class="col-md-3">
								
							</div>
							<div class="col-md-4">
								<input type="text" name="" class="form-control mt-4" placeholder="Search" style="height: 40px;">
							</div>
							<div class="col-md-1">
								<button class="form-control btn btn-outline-primary mt-4">Search</button>
							</div>
							<div class="col-md-1">
								<button class="btn btn-outline-primary mt-4" style="width:auto;">Log out</button>
							</div>
					</div>
				</div>
			</div>
		</div>
	</div> -->
	<!-- body section -->
	<div class="container-fluid">
		<div class="row">
			<div class="body_section">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-3">
							<div class="dash_bar">
								<!--  -->
								<div class="logo">
									<a href="home_page.php"><h2>E-com</h2></a>
								</div>
								<!--  -->
								<?php
									$admin_table = $conn->query("SELECT * FROM `e_com`.`e_com_admin_panel` WHERE Admin_id='$admin_id'");
									if($admin_table){
										if($conn->affected_rows > 0){
											$admin_data = $admin_table->fetch_object();
										}
									}
								//$admin_data->Admin_email;
								?>
								<?php
									if(isset($_POST['admin_logout'])){
										$AS_up_query = $conn->query("UPDATE `e_com`.`e_com_admin_panel` SET Admin_active_status = '0' WHERE Admin_id = '$admin_id'");
										if($AS_up_query){
											if($conn->affected_rows > 0){
												setcookie("log_email",$admin_data->Admin_email, time() - 1, '/');
												setcookie('log_pass',$admin_data->Admin_password, time() -1,'/');
												header('location: home.php');
												session_destroy();

											}
										}else{
											echo "error";
										}
									}
								?>
								<div class="admin_profile">
									<h5>My Profile</h5>

									<a href=""><?=$admin_data->Admin_name?> <div id="acitve_sign"></div></a>
									<form method="post">
										<button name="admin_logout" id="logout_btn" class="btn btn-outline-primary">Logout</button>
									</form>
								</div>
								<ul class="list-group">
									<li class="form-control"><a href="">Genarel setting</a></li>

									<li class="form-control">
										<div class="main_div">
											<a href="">Brand menagemnet</a>
											<div class="droup_down_div">
												<?php
													$url_add_brand = array(
														'value' => base64_encode('add_brand')
													);
												?>
	   											 <a name="action_value" href="home_page.php?<?= http_build_query($url_add_brand) ?>">Add Brand</a>
	   											
	   											 <a href="">View Brand</a>
  											</div>
										</div>
									</li>
									<li class="form-control">
										<div class="main_div">
											<a href="" class="sub_item_opt">Item menagement</a>
											<div class="droup_down_div">
												<?php
												$url_add_item = array(
													'value' => base64_encode('item')
												);

												?>
	   											 <a name="action_value" href="home_page.php?<?=http_build_query($url_add_item) ?>">Add Item</a>
	   											 <?php
	   											 $url_item_view = array(
	   											 	'value' => base64_encode('view_item')
	   											 );
	   											 ?>
	   											 <a href="home_page.php?<?=http_build_query($url_item_view) ?>">View Item</a>
  											</div>
										</div>
									</li>
									<li class="form-control">
										<div class="main_div">
											<a href="" class="sub_item_opt">Category menagement</a>
											<div class="droup_down_div">
												<?php
													$url_add_category = array(
														'value' => base64_encode('category')
													);
												?>
	   											 <a name="action_value" href="home_page.php?<?= http_build_query($url_add_category) ?>">Add Category</a>
	   											 <?php
	   											 $url_cat_view = array(
	   											 	'value' => base64_encode('view_category')
	   											);
	   											 ?>
	   											 <a href="home_page.php?<?= http_build_query($url_cat_view) ?>">View Category</a>
  											</div>
										</div>
									</li>
									<li class="form-control">
										<div class="main_div">
											<a href="" class="sub_item_opt">Product menagement</a>
											<div class="droup_down_div">
												<?php
													$url_add_product = array('value' => base64_encode('product'));
												?>
	   											 <a name="action_value" href="home_page.php?<?= http_build_query($url_add_product) ?>">Add Prouduct</a>
	   											 <?php
	   											 	$url_pro_view = array('value' => base64_encode('view_product'));
	   											 ?>
	   											 <a href="home_page.php?<?= http_build_query($url_pro_view) ?>">View Product</a>
  											</div>
										</div>
									</li>
									<?php
										$url_slider_man = array('value' => base64_encode('slider_man'));
									?>
									<li class="form-control"><a href="home_page.php?<?php print(http_build_query($url_slider_man))?>">Slider image</a></li>
									<li class="form-control"><a href="">Footer managemant</a></li>
									<li class="form-control">
										<div class="main_div">
											<a href="" class="sub_item_opt">Admin Managemant</a>
											<div class="droup_down_div">
												<?php
	   											 	$url_admin_add = array(
	   											 		'value' => base64_encode('add_admin')
	   											 	);
	   											 ?>
	   											 <a href="home_page.php?<?= http_build_query($url_admin_add) ?>">Add New Admin</a>
	   											 <?php
	   											 	$url_admin_view = array(
	   											 		'value' => base64_encode('view_admin')
	   											 	);
	   											 ?>
	   											 <a href="home_page.php?<?= http_build_query($url_admin_view) ?>">View All admin</a>
  											</div>
										</div>
									</li>
									<li class="form-control"><a href="">Customer Details</a></li>
									<?php
										$url_sale_details = array('value' => base64_encode('sale_details'));

									?>
									<li class="form-control"><a href="home_page.php?<?= http_build_query($url_sale_details)?>">Seles Details</a></li>
									<li class="form-control"><a href="">About Us</a></li>
									<li class="form-control"><a href="">&nbsp;</a></li>
								</ul>
							</div>
						</div>
						<div class="col-md-9">
							<div class="content">
								<?php
								//echo $admin_id = $_SESSION['admin_id'];
									switch ($page) {
										case 'item':
											include "insert_item.php";
											break;
										case 'category':
											include "insert_category.php";
											break;
										case 'product':
											include "add_product.php";
											break;
										case 'add_admin':
											include 'add_admin.php';
											break;
										case 'view_admin':
											require 'admin_view.php';
											break;
										case 'view_item':
											require 'view_item.php';
											break;
										case 'view_category':
											require 'view_category.php';
											break;
										case 'view_product':
											require 'view_product.php';
											break;
										case 'pro_details':
											require 'pro_details.php';
											break;
										case 'edit_product':
											require 'edit_product.php';
											break;
										case 'edit_item':
											require 'edit_item.php';
											break;
										case 'edit_category':
											require 'edit_category.php';
											break;
										case 'admin_details':
											require 'admin_details.php';
											break;
										case 'add_brand':
											require 'add_brand.php';
											break;
										case 'slider_man':
											require 'slider_man.php';
											break;
										case 'sale_details':
											require 'sale_details.php';
											break;
										case 'rendom_sale':
											require 'rendom_sale.php';
											break;
										case 'today_sale':
											require 'today_sale.php';
											break;
										default:
											require 'home_page_content.php';
											break;
									}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- drop down option -->


</body>
</html>