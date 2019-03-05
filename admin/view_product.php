<?php
if(!isset($_SESSION)){
	session_start();
}
if(!isset($_SESSION['admin_id'])){
	header('location: home.php');
}
?>
<?php
class ViewPro extends mysqli{
	public function cunnection($host_name,$user){
		$this->connect($host_name,$user);
		if($this->connect_errno){
			echo "Error to connect".$this->connect_errno;
		}
	}
	public function dbselect($db_name){
		if(!$this->select_db($db_name)){
			echo ("Database not found".$this->errno);
		}
	}
}
$vpobj = new ViewPro();
$vpobj->cunnection('localhost','root');
$vpobj->dbselect('e_com');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Product view</title>
</head>
<style type="text/css">
	*{
		margin:0px auto;
		padding: 0px;
		box-sizing: border-box;
	}
	body{
		font-family: arial, sans-serif;
	}
	.header{
		height: 37px;
		width: 100%;
		background-color: #605CA8;
		float: left;
		color: #ffffff;
		margin-top: 16px;
	}
	.header h4{
		margin-top: 5px;
	}
	.pro_view_main{
		width: 100%;
	}
	.pro_view_th{
		height: 50px;
		width: 100%;
		margin-top: 10px;
		float: left;
		border-bottom: 2px #605CA8 solid;
		border-top: 1px #605CA8 solid;
	}
	.pro_view_th ul{
		list-style: none;
	}
	.pro_view_th ul li{
		float: left;
		color: #605CA8;
		padding: 7px 0px 0px 0px;
		font-weight: bold;
		line-height: 30px;
	}
	.pro_view_td{
		width: 100%;
		height: 45px;
		float: left;
		border-bottom: 1px #605CA8 solid;
		overflow: hidden;

	}
	.pro_view_td ul{
		list-style: none;
	}
	.pro_view_td ul li{
		float: left;
		color: #605CA8;
		line-height: 30px;
		/*width: 25%;*/
		padding: 7px 0px 0px 3px;
		

	}
	.pro_view_td:hover{
		background-color: #D2D2D2;
	}
	#del_button{
		padding: 0px 5px;
		margin-left: 12px;
	}
	#details_opt{
		background-color: #1188CB;
		padding: 3px 5px;
		text-decoration: none;
		color: #ffffff;
		border-radius: 3px;
	}
	#details_opt:hover{
		background-color: #0069D9;
	}
	.pro_img_view{
		height: 40px;
		width: 130px;
		padding: 0px;
		margin: 0px;
		margin-top: -5px;
	}
	.pro_img_view img{
		height: 100%;
		width: 100%;

	}
</style>
<body>
	<div class="header">
		<section>
			<h4>E-com Admin panel || View Product</h4>
		</section>
	</div>
	<div class="pro_view_main">
		<div class="pro_view_th">
			<ul>
				<li style="width: 10%;">Product ID</li>
				<li style="width: 19%;">Product Name</li>
				<li style="width: 14%;">Item Name</li>
				<li style="width: 15%;">Product Price</li>
				<li style="width: 12%;">Quentity</li>
				<li style="width: 16%">Product Img</li>
				<!-- <li style="width: 10%;">Brand</li> -->
				<li style="width: 14%;">Option</li>
			</ul>
		</div>
<?php
$pro_table = $vpobj->query("SELECT * FROM `e_com`.`product`");
if($pro_table){
	if($pro_table->num_rows > 0){
		while($pro_table_all_data = $pro_table->fetch_object()){
			?>
				<div class="pro_view_td">
					<ul>
						<li style="width: 10%;"><?=$pro_table_all_data->product_id ?></li>
						<li style="width: 19%; z-index: 1"><?=$pro_table_all_data->product_name ?></li>
						<li style="width: 14%;"><?=$pro_table_all_data->item_name ?></li>
						<li style="width: 15%;"><?=$pro_table_all_data->product_price ?></li>
						<li style="width: 12%;"><?=$pro_table_all_data->product_quentity ?></li>
						<li style="width: 16%">
							<div class="pro_img_view">
								<img src="../img/product/<?php print $pro_table_all_data->product_code.'(0)'?>.jpg">
							</div>
						</li>
						<!-- <li style="width: 10%;"><?=$pro_table_all_data->product_brand ?></li> -->
						<li style="width: 14%">
							<form method="post">
								<?php
								$url_pro_details = array('value' => base64_encode('pro_details'));
								//$url_pro_id = array('pro_action_id' => '');
								?>
								<a href="home_page.php?<?= http_build_query($url_pro_details)?>?&&pro_action_id=<?= base64_encode($pro_table_all_data->product_id)?>" id="details_opt">Details</a>
								<!-- <a href="home_page.php?<?= http_build_query($url_pro_details)?>&&pro_action_id=<?=$pro_table_all_data->product_id?>" id="details_opt">Details</a> -->
								<button id="del_button" name="pro_delete" class="btn btn-danger" value="<?=$pro_table_all_data->product_id ?>">Delete</button>
							</form>
						</li>
					</ul>
				</div>
			<?php
		}
	}
}

?>
<!-- button action -->
<?php
if(isset($_POST['pro_delete'])){
	$pro_del_id = filter_input(INPUT_POST, 'pro_delete');
	//echo $pro_del_id;
	$pro_del_query = $vpobj->query("DELETE FROM `e_com`.`product` WHERE product_id='$pro_del_id'");
	if($pro_del_query){
		if($vpobj->affected_rows > 0){
			echo "<meta http-equiv='refresh' content='0;url='>";
			echo "<script>alert('Product Deleted Successfully')</script>";
			
		}else{
			echo "<script>alert('Product Is not Deleted...Please try again.!!!')</script>";
		}
	}
}

?>
	</div>
</body>
</html>