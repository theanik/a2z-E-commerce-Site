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
class ProDetails extends mysqli{
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
$pdobj = new ProDetails();
$pdobj->cunnection('localhost','root');
$pdobj->dbselect('e_com');
?>
<!--  -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Product Details</title>
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
		/*float: left;*/
		color: #ffffff;
		margin-top: 16px;
	}
	.header h4{
		margin-top: 5px;
	}
	.pro_details_main{
		width: 100%;
		/*margin-bottom: 70px;*/
	}
	.pro_details_td{
		width: 80%;
		float: left;
		margin: 20px 0px 0px 0px;
		border-top: 1px #605CA8 solid;
		border-right: .05px #605CA8 dotted;
	}
	.pro_details_td ul{
		list-style: none;
	}
	.pro_details_td ul li{
		color: #605CA8;
		padding: 10px 10px 10px 0px;
		border-bottom: 0.2px #605CA8 dotted;
		line-height: auto;
		text-align: justify;
		
	}
	.pro_img_main{
		height: 180px;
		width: 100%;
		float: left;
		margin-bottom: 50px;

	}
	/*.pro_img_main ul{
		list-style: none;
	}
	.pro_img_main ul li{
		float: left;
		height: 180px;
		width: 100%;
	}*/
	.img_single{
		height: 100%;
		width: 24%;
		margin-right: 1%;
		/*background-color: #cccccccc;*/
		float: left;
	}
	.img_single img{
		height: 100%;
		width: 100%;
	}
	.opt_sec{
		float: right;
		margin-left: 3%;
		height: auto;
		width: 17%;
		margin-top: 30px;
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
	.free_sec{
		height: 20px;
		/*background-color: #cccccc;*/
		width: 100%;
		float: left;
		border-top: 0.2px #605CA8 solid;
	}
</style>
<body>
	<div class="header">
		<section>
			<h4>View Product || Product Details || Product ID : <?=$pro_action_id?></h4>
		</section>
	</div>
	<?php
	$pro_table = $pdobj->query("SELECT * FROM `e_com`.`product` WHERE `product_id`='$pro_action_id'");
	if($pro_table){
		if($pdobj->affected_rows > 0){
			$pro_table_all_data = $pro_table->fetch_object();
		}
	}else{
		echo "Error Query";
	}

	?>
	<div class="pro_details_main">
		<div class="pro_details_td">
			<ul>
				<li><b>Product Name : </b><?=$pro_table_all_data->product_name ?></li>
				<li><b>Product Code : </b><?=$pro_table_all_data->product_code?></li>
				<li><b>Item Name : </b><?=$pro_table_all_data->item_name ?></li>
				<li><b>Category Name : </b><?=$pro_table_all_data->category_name ?></li>
				<li><b>Product Price : </b><?=$pro_table_all_data->product_price ?></li>
				<li><b>Product Quentity : </b><?=$pro_table_all_data->product_quentity ?></li>
				<li><b>Product Informaion : </b><?=$pro_table_all_data->product_information ?></li>
				<li><b>Product Details : </b><?=$pro_table_all_data->product_details ?></li>
				<li><b>Brand Name : </b><?=$pro_table_all_data->product_brand ?></li>
				<li style="border-bottom: none;"><b>Product Image : </b>
				</li>
			</ul>
			<?php
				$pro_code_for_show_img=$pro_table_all_data->product_code;
				$pro_img1=$pro_code_for_show_img."(0)";
				$pro_img2=$pro_code_for_show_img."(1)";
				$pro_img3=$pro_code_for_show_img."(2)";
				$pro_img4=$pro_code_for_show_img."(3)";
				// echo $pro_code_for_show_img=$pro_table_all_data->product_code;

			?>
			<div class="pro_img_main">
				<div class="img_single">
					<img src="../img/product/<?php print $pro_img1?>.jpg" alt="">
				</div>	
				<div class="img_single">
					<img src="../img/product/<?php print $pro_img2?>.jpg" alt="">
				</div>	
				<div class="img_single">
					<img src="../img/product/<?php print $pro_img3?>.jpg" alt="">
				</div>	
				<div class="img_single">
					<img src="../img/product/<?php print $pro_img4?>.jpg" alt="">
				</div>	
			</div>
		</div>

		<div class="opt_sec">
			<?php
				$url_edit_pro = array('value' => base64_encode('edit_product'));
			?>
			<a href="home_page.php?<?= http_build_query($url_edit_pro)?>?&&pro_action_id=<?= base64_encode($pro_action_id)?>">Edit Product</a><br><br><br><br>
			<?php
	   			$url_pro_view = array('value' => base64_encode('view_product'));
	   		?>
	   		<a href="home_page.php?<?= http_build_query($url_pro_view) ?>"> < Back To View</a>
		</div>
		
	</div>
	<div class="free_sec">
		<h6 style="color: #605CA8; float: right;">&copy;<a href="" style="color: #605CA8;">Anik Anwar</a>    <?php echo date("Y")?></h6>
	</div>
</body>
</html>