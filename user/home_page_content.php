<?php
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

    $session_id = session_id();
?>
<?php
	class HomeMain extends mysqli{
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
		public $Session_Id = false;
			public $Product_ID = false;
			public $ProductName = false;
			// public $ProductCode = false;
			public $ItemName = false;
			public $CategoryName = false;
			public $ProductTotalPrice = false;
			public $ProductQuentity = false;
			public $ProductPrice = false;
			public $ProductDetails = false;
			public $ProductBrand = false;
			public $Date;
		public function addtoCart(){
				if(($this->ProductName && $this->ItemName && $this->CategoryName && $this->ProductPrice && $this->ProductQuentity && $this->ProductDetails && $this->ProductBrand) == true){

						$pro_add_query = "INSERT INTO `e_com`.`e_com_addcart` 
			(session_id, 
			product_id, 
			product_name, 
			item_name, 
			category_name, 
			product_total_price, 
			product_quentity, 
			product_price, 
			product_details, 
			product_brand, 
			sale_date
			)
			VALUES
			('$this->Session_Id', 
			'$this->Product_ID', 
			'$this->ProductName', 
			'$this->ItemName', 
			'$this->CategoryName', 
			'$this->ProductTotalPrice', 
			'$this->ProductQuentity', 
			'$this->ProductPrice', 
			'$this->ProductDetails', 
			'$this->ProductBrand', 
			'$this->Date'
			)";

						$add_result = $this->query($pro_add_query);

						//echo $add_query_result;
						if($add_result == true){
							if($this->affected_rows > 0){
								
								echo "<script>swal('Product add to cart successfully')</script>";
								//echo "<meta http-equiv='refresh' content='0;url='>";
								
							}else{
								echo "<script>alert('Product is not add..!please try again...')</script>";

								echo "<meta http-equiv='refresh' content='0;url='>";
							}
						}else{
							echo "error query";
						}
				}else{
					echo "<script>alert('Fill up all field')</script>";
				}
			}
	}
$hm_obj = new HomeMain();
$hm_obj->cunnection('localhost','root');
$hm_obj->db_select('e_com');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Home page</title>
	 <link rel="stylesheet" href="swiper.min.css">
	 <link rel="stylesheet" href="css/home_page_content.css">
</head>
<style type="text/css">

</style>
<body>
	<div class="slider_content_container">
		<div class="slide_content_left">
			<div class="show_cat_list_main">
				<section>
					<h3>All Category</h3>
				</section>
				<ul>
					<?php
						$cat_table_query = $hm_obj->query("SELECT * FROM `e_com`.`category`");
						while($cat_table_all_data = $cat_table_query->fetch_object()){
							?>
							<a href="home.php?page=product&&cat_name=<?=$cat_table_all_data->category_name?>"><li><?=$cat_table_all_data->category_name?></li></a>
							<?php
						}
					?>
					<?php
						$cat_table_query = $hm_obj->query("SELECT * FROM `e_com`.`category`");
						while($cat_table_all_data = $cat_table_query->fetch_object()){
							?>
							<a href="home.php?page=product&&cat_name=<?=$cat_table_all_data->category_name?>"><li><?=$cat_table_all_data->category_name?></li></a>
							<?php
						}
					?>
					<?php
						$cat_table_query = $hm_obj->query("SELECT * FROM `e_com`.`category`");
						while($cat_table_all_data = $cat_table_query->fetch_object()){
							?>
							<a href="home.php?page=product&&cat_name=<?=$cat_table_all_data->category_name?>"><li><?=$cat_table_all_data->category_name?></li></a>
							<?php
						}
					?>
				</ul>
			</div>
		</div>
		<div class="slider_content_main">
			<div class="swiper-container">
			    <div class="swiper-wrapper">
			    	<?php
			    		$slide_table = $hm_obj->query('SELECT * FROM `e_com`.`slider_img`');
			    		while ($slide_table_all = $slide_table->fetch_object()) {
			    			?>
			    				<div class="swiper-slide"><img src="data:image;base64,<?php print $slide_table_all->img?>" alt=""></div>
			    			<?php
			    		}

			    	?>
			      
			      <!-- <div class="swiper-slide">Slide 2</div>
			      <div class="swiper-slide">Slide 3</div>
			      <div class="swiper-slide">Slide 4</div>
			      <div class="swiper-slide">Slide 5</div>
			      <div class="swiper-slide">Slide 6</div> -->
			      
			    </div>
			    <!-- Add Pagination -->
			    <div class="swiper-pagination"></div>
			    <!-- Add Arrows -->
			    <div class="swiper-button-next"></div>
			    <div class="swiper-button-prev"></div>
			</div>		
			

		</div>

		<div class="slide_content_right_addblock">
			
		</div>
	</div>

	<!-- mid section -->
	<div class="brand_show_container">
			<div class="brand_show_main">
				<section>
					<h3>Brand</h3>
				</section>
				<?php
					$bramd_table_query = $hm_obj->query("SELECT * FROM `e_com`.`brand`");
					while ($bramd_table_all_data = $bramd_table_query->fetch_object()) {
						?>
						<a href="home.php?page=product&&brand_name=<?= $bramd_table_all_data->brand_name?>">
						<div class="brand_show_single">
							
							<span class="brand_show_content">
								<span class="brand_img">
									<img src="data:image;base64,<?php print $bramd_table_all_data->brand_logo ?>">
								</span>
								<span class="brand_name">
									<h5><?=$bramd_table_all_data->brand_name?></h5>
								</span>
							</span>
							
						</div>
						</a>
						<?php
					}
				?>
				
				
			</div>
		</div>

	
	<!-- mid section 01 -->
	<style type="text/css">
		
	</style>

	<div class="show_product_container">
		<div class="show_prouct_main">
			<section>
				<h3>Product</h3>
			</section>
			<?php
			
			// $showCount = 3;
			// if(isset($_POST['show_more'])){
				
			// 	$showCount = $showCount + 3;
				
			// }
			// print $showCount;
			 	$product_table_query = $hm_obj->query("SELECT * FROM `e_com`.`product`");
			// 	$i = 0;
				while ($product_table_all_data = $product_table_query->fetch_object()) {
					//if($i<$showCount){
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
								$query_for_brand_logo_for_problock = $hm_obj->query("SELECT * FROM `e_com`.`brand` WHERE `brand_name`='$product_table_all_data->product_brand'");
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
							<form method="post">
							<button type="submit" value="<?=$product_table_all_data->product_id;?>" name="addcart">Add to Cart</button>
							
							 </form>
						</div>
					</div>
					
				
			</div>
			</a>
			<?php

				}
				// $i++;
				// }
			
			?>
			
			<?php
						if(isset($_POST['addcart'])){
							$product_id_from_btn = $_POST['addcart'];
							//echo $product_id_from_btn;
							$product_table_query_for_addCart_btn = $hm_obj->query("SELECT * FROM `e_com`.`product` WHERE product_id='$product_id_from_btn'");
							$all_pro_data_byId = $product_table_query_for_addCart_btn->fetch_object();
							$ck_quentity = 1;
							$single_pro_price = $all_pro_data_byId->product_price;
							$product_total_price = $ck_quentity*$single_pro_price;
							$pro_name = $all_pro_data_byId->product_name;
							$item_name = $all_pro_data_byId->item_name;
							$cat_name = $all_pro_data_byId->category_name;
							$pro_price = $all_pro_data_byId->product_price;
							$pro_details = $all_pro_data_byId->product_details;
							$pro_brand = $all_pro_data_byId->product_brand;

							$hm_obj->Session_Id = $session_id;
							$hm_obj->Product_ID = $product_id_from_btn;
							$hm_obj->ProductName = $pro_name;
							$hm_obj->ItemName = $item_name;
							$hm_obj->CategoryName = $cat_name;
							$hm_obj->ProductTotalPrice = $product_total_price;
							$hm_obj->ProductQuentity = $ck_quentity;
							$hm_obj->ProductPrice = $pro_price;
							$hm_obj->ProductDetails = $pro_details;
							$hm_obj->ProductBrand = $pro_brand;
							$hm_obj->Date = date("d-m-y");
							$hm_obj->addtoCart();
						}


					?>

			<div class="show_more_pro_btn_sec">
				<div class="show_more_pro_btn_sec_main">
					<form method="post">
					<input type="submit" value="SHOW MORE" name="show_more">
				</form>
				</div>
			</div>
			
		</div>
	</div>
	<!-- midsection 02 -->
	
	<div class="cat_show_container">
		<div class="cat_show_main">
			<section>
				<h3>Category</h3>
			</section>
			<?php
				$catagory_table_query = $hm_obj->query("SELECT * FROM `e_com`.`category`");
				while ($catagory_table_all_data = $catagory_table_query->fetch_object()) {
					?>
					<a href="home.php?page=product&&cat_name=<?=$catagory_table_all_data->category_name?>">
					<div class="cat_show_single" id="cscs">
						
						<span class="cat_show_content">
							<span class="cat_img">
								<img src="data:image;base64,<?php print $catagory_table_all_data->cat_img ?>">
							</span>
							<span class="cat_name">
								<h5><?=$catagory_table_all_data->category_name?></h5>
							</span>
						</span>
						
					</div>
					</a>
					<?php
				}
			?>
			
			
		</div>
	</div>
	<script src="swiper.min.js"></script>
	<script type="text/javascript">
		var swiper = new Swiper('.swiper-container', {
      spaceBetween: 30,
      centeredSlides: true,
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
// scroll bar
		// $(document).ready(function () {
  //         if (!$.browser.webkit) {
  //             $('.wrapper').html('<p>Sorry! Non webkit users. :(</p>');
  //         }
  //     });
  function timedRefresh(timeoutPeriod) {
	setTimeout("location.reload(true);",timeoutPeriod);
}

	</script>

</body>
</html>