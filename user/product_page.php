<?php
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    $brand_name =filter_input(INPUT_GET, 'brand_name');
    $cat_name = filter_input(INPUT_GET, 'cat_name');
    
?>
<?php
	class proPage extends mysqli{
		public function cunnection(string $hostNmae,string $userNane){
			$this->connect($hostNmae,$userNane);
			if($this->connect_error){
				echo ("Error to connect".$this->connect_error);
			}
		}
		public function db_select(string $db_name){
			if(!$this->select_db($db_name)){
				echo ('Database not found'.$this->error);
			}
		}
	}
$pro_obj = new proPage();
$pro_obj->cunnection('localhost','root');
$pro_obj->db_select('e_com');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>product_page</title>
	<link rel="stylesheet" href="css/product_page.css">
</head>
<style type="text/css">
	
</style>
<body>
	<?php
		if($brand_name == true){


	?>
	<div class="show_product_container">
		<div class="show_prouct_main">
			<section>
				<h3><?php echo $brand_name;?></h3>
			</section>
			<?php
				$product_table_query = $pro_obj->query("SELECT * FROM `e_com`.`product` WHERE `product_brand`= '$brand_name'");
				while ($product_table_all_data = $product_table_query->fetch_object()) {

					?>
					<a href="home.php?page=add_cart&&product_id=<?=$product_table_all_data->product_id ?>">
			<div class="product_single_show">
				
					<div class="product_content">
						<div class="product_img">
							<?php
							$product_code_for_pro_img = $product_table_all_data->product_code;
							$pro_img = $product_code_for_pro_img."(0)";
							?>
							<img src="../img/product/<?php print $pro_img?>.jpg" alt="<?=$product_table_all_data->product_name?>">
						</div>
						<div class="brand_img_for_pro">
							<?php
								$query_for_brand_logo_for_problock = $pro_obj->query("SELECT * FROM `e_com`.`brand` WHERE `brand_name`='$product_table_all_data->product_brand'");
								$brand_table_all_data_for_problock_brnad_logo = $query_for_brand_logo_for_problock->fetch_object();
							?>
							<img src="data:image;base64,<?php print $brand_table_all_data_for_problock_brnad_logo->brand_logo ?>">
						</div>
						<div class="product_name">
							<h5><?= $product_table_all_data->product_name?></h5>
						</div>
						<div class="product_price">
							<h4><?php echo '$'.$product_table_all_data->product_price ?></h4>
						</div>
						<div class="cart_button">
							<input type="submit" value="Add to Cart">
						</div>
					</div>
				
			</div>
			</a>
			<?php
				}
			?>
			
			

			
		</div>
	</div>

<?php

}
 if($cat_name == true){

?>
	<div class="show_product_container">
		<div class="show_prouct_main">
			<section>
				<h3><?php echo $cat_name;?></h3>
			</section>
			<?php
				$product_table_query = $pro_obj->query("SELECT * FROM `e_com`.`product` WHERE `category_name`= '$cat_name'");
				while ($product_table_all_data = $product_table_query->fetch_object()) {

					?>
					<a href="home.php?page=add_cart&&product_id=<?=$product_table_all_data->product_id ?>">
			<div class="product_single_show">
				
					<div class="product_content">
						<div class="product_img">
							<?php
							$product_code_for_pro_img = $product_table_all_data->product_code;
							$pro_img = $product_code_for_pro_img."(0)";
							?>
							<img src="../img/product/<?php print $pro_img?>.jpg" alt="<?=$product_table_all_data->product_name?>">
						</div>
						<div class="brand_img_for_pro">
							<?php
								$query_for_brand_logo_for_problock = $pro_obj->query("SELECT * FROM `e_com`.`brand` WHERE `brand_name`='$product_table_all_data->product_brand'");
								$brand_table_all_data_for_problock_brnad_logo = $query_for_brand_logo_for_problock->fetch_object();
							?>
							<img src="data:image;base64,<?php print $brand_table_all_data_for_problock_brnad_logo->brand_logo ?>">
						</div>
						<div class="product_name">
							<h5><?= $product_table_all_data->product_name?></h5>
						</div>
						<div class="product_price">
							<h4><?php echo '$'.$product_table_all_data->product_price ?></h4>
						</div>
						<div class="cart_button">
							<input type="submit" value="Add to Cart">
						</div>
					</div>
				
			</div>
			</a>
			<?php
				}
			?>
			
			

			
		</div>
	</div>

<?php

}
?>
</body>
</html>



<!-- <div style="color: #FF9000; font-size: 26px;">$ <?=$pro_table_all_data_by_proID->product_price?></div>
							<br>
							<div style="color: rgba(0,0,0,0.4); font-size: 16px";>Quentity &nbsp;<input type="" name=""><span style="font-size: 12px; margin-left: 20px; font-family: cursive;">Only <?= $pro_table_all_data_by_proID->product_quentity?> left</span></div> -->