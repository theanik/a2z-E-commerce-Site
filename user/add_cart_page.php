
<?php
if(!isset($_SESSION)){
	session_start();
}
$session_id = session_id();
// print $session_id;

//echo $product_id;
$product_id = filter_input(INPUT_GET, 'product_id');
?>
<?php
	class addcartPage extends mysqli{
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
								echo "<meta http-equiv='refresh' content='0;url='>";
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


	

	


$ac_obj = new addcartPage();
$ac_obj->cunnection('localhost','root');
$ac_obj->db_select('e_com');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Add cart</title>
	<!-- <link rel="stylesheet" href="css/normalize.css" /> -->
    <!-- <link rel="stylesheet" href="css/foundation.css" /> -->
    <!-- <link rel="stylesheet" href="css/demo.css" /> -->
    <link rel="stylesheet" href="css/add_cart_page.css">

    <script src="js/vendor/modernizr.js"></script>
    <script src="js/vendor/jquery.js"></script>
     <script type="text/javascript" src="dist/xzoom.min.js"></script>
	  <!-- <link rel="stylesheet" type="text/css" href="css/xzoom.css" media="all" />  -->

	  <!-- hammer plugin here -->
	  <!-- <script type="text/javascript" src="hammer.js/1.0.5/jquery.hammer.min.js"></script>   -->
	  <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	  <!-- <link type="text/css" rel="stylesheet" media="all" href="fancybox/source/jquery.fancybox.css" /> -->
	  <!-- <link type="text/css" rel="stylesheet" media="all" href="magnific-popup/css/magnific-popup.css" /> -->
	  <!-- <script type="text/javascript" src="fancybox/source/jquery.fancybox.js"></script> -->
	  <!-- <script type="text/javascript" src="magnific-popup/js/magnific-popup.js"></script>        -->
</head>
<style type="text/css">
	

</style>
<body>
	<div class="add_cart_container_001">
		<div class="add_cart_main_001">
			<div class="add_cart_main_001_left">
				<?php
						$pro_table = $ac_obj->query("SELECT * FROM `e_com`.`product` WHERE product_id = '$product_id'");
						if($pro_table==true){
							$pro_table_all_data_by_proID = $pro_table->fetch_object();
						}else{
							echo "query error";
						}

						$pro_code_for_show_img=$pro_table_all_data_by_proID->product_code;
						$pro_img1=$pro_code_for_show_img."(0)";
						$pro_img2=$pro_code_for_show_img."(1)";
						$pro_img3=$pro_code_for_show_img."(2)";
						$pro_img4=$pro_code_for_show_img."(3)";

					?>
				<div class="zooming_slider">
					
					<section id="default" class="padding-top0">
					    <div class="row">
					     
					      <div class="large-5 column">
					        <div class="xzoom-container">
					          <img class="xzoom" id="xzoom-default" src="../img/product/<?php print $pro_img1?>.jpg" xoriginal="../img/product/<?php print $pro_img1?>.jpg" />
					          <div class="xzoom-thumbs">
					            <a href="../img/product/<?php print $pro_img1?>.jpg"><img class="xzoom-gallery" width="80" src="../img/product/<?php print $pro_img1?>.jpg"  xpreview="../img/product/<?php print $pro_img1?>.jpg""></a>
					            <a href="../img/product/<?php print $pro_img2?>.jpg"><img class="xzoom-gallery" width="80" src="../img/product/<?php print $pro_img2?>.jpg"></a>
					            <a href="../img/product/<?php print $pro_img3?>.jpg"><img class="xzoom-gallery" width="80" src="../img/product/<?php print $pro_img3?>.jpg" ></a>
					            <a href="../img/product/<?php print $pro_img4?>.jpg"><img class="xzoom-gallery" width="80" src="../img/product/<?php print $pro_img4?>.jpg"></a>
					          </div>
					        </div>        
					      </div>
					      <!-- <div class="large-7 column"></div> -->
					    </div>
					    </section>
				</div>
				<div class="cart_containt">

					<div class="cart_cntaint_main">
						
						<div class="cart_cntaint_main_sec_01">
							<h2><?= $pro_table_all_data_by_proID->product_name?></h2>
							<span style="color: skyblue; font-size: 13px;">Rate this product <span style="color: rgba(0,0,0,0.4);">||&nbsp;&nbsp;&nbsp;
															<span class="fa fa-star checked"></span>
															<span class="fa fa-star checked"></span>
															<span class="fa fa-star checked"></span>
															<span class="fa fa-star"></span>
															<span class="fa fa-star"></span>
														</span></span>
							<br>
							<span style="color: rgba(0,0,0,0.4); font-size: 12px;">Brand : <a href="" style="color: skyblue;"><?=$pro_table_all_data_by_proID->product_brand?></a></span>

						</div>
						<div class="cart_cntaint_main_sec_02">
							<span style="color: #FF9000; font-size: 26px;">$ <?=$pro_table_all_data_by_proID->product_price?></span>
							<!-- <span style="color: rgba(0,0,0,0.4); font-size: 16px";>Quentity &nbsp;<input type="number" name="pro_quentity" value="<?php print $pro_quentity?>"><span style="font-size: 12px; margin-left: 20px; font-family: cursive;">Only <?= $pro_table_all_data_by_proID->product_quentity?> left</span> -->
						</div>
						
						<!-- <div class="cart_container_main_sec_input_quentity">
							<h4>Quantity</h4>
							<input type="button" value="-" id="moins" onclick="minus()">
							<form method="post"">
						    <input type="text" name="pro_quentity">
								</form>
						    
						    <input type="button" value="+" id="plus" onclick="plus()"><span style="font-size: 12px; margin-left: 20px; font-family: cursive; color: rgba(0,0,0,0.8);">Only <?= $pro_table_all_data_by_proID->product_quentity?> left</span>
							
						 </div> -->
						
						<div class="cart_cntaint_main_sec_03">
							<form method="post">
								<div class="quentity_input_sec">
									<!-- Change the `data-field` of buttons and `name` of input field's for multiple plus minus buttons-->
									<h4>Quantity</h4>
											
											   <div class="quentity_input_field">

												 <button type="button" id="sub" class="sub">-</button>
													    <input type="text" id="1" value="1" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" name="quantity" />
													    <button type="button" id="add" class="add">+</button>
											   	 <!-- <button type="button" class="button hollow circle" data-quantity="minus" data-field="quantity">
											      <i class="fa fa-minus" aria-hidden="true"></i>
											    </button>
											  
											  <input class="input-group-field" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" type="text" min="1" name="quantity" value="1">
											  
											    <button type="button" class="button hollow circle" data-quantity="plus" data-field="quantity">
											      <i class="fa fa-plus" aria-hidden="true"></i>
											    </button> -->
											    <span style="font-size: 12px; margin-left: 20px; font-family: cursive;">Only <?= $pro_table_all_data_by_proID->product_quentity?> left</span>
											   </div>
											  


								</div>
							<div class="cart_btn_sec">
								<input type="submit" value="Buy Now" name="buynow" id="buynow">
								<input type="submit" name="addcart" value="Add to cart" id="cart_btn">
							</div>
							</form>
						</div>
						
						
					</div>
				</div>
			</div>
<?php
						if(isset($_POST['addcart'])){
							$ck_quentity = filter_input(INPUT_POST, 'quantity');
							$single_pro_price = $pro_table_all_data_by_proID->product_price;
							$product_total_price = $ck_quentity*$single_pro_price;
							$pro_name = $pro_table_all_data_by_proID->product_name;
							$item_name = $pro_table_all_data_by_proID->item_name;
							$cat_name = $pro_table_all_data_by_proID->category_name;
							$pro_price = $pro_table_all_data_by_proID->product_price;
							$pro_details = $pro_table_all_data_by_proID->product_details;
							$pro_brand = $pro_table_all_data_by_proID->product_brand;

							$ac_obj->Session_Id = $session_id;
							$ac_obj->Product_ID = $product_id;
							$ac_obj->ProductName = $pro_name;
							$ac_obj->ItemName = $item_name;
							$ac_obj->CategoryName = $cat_name;
							$ac_obj->ProductTotalPrice = $product_total_price;
							$ac_obj->ProductQuentity = $ck_quentity;
							$ac_obj->ProductPrice = $pro_price;
							$ac_obj->ProductDetails = $pro_details;
							$ac_obj->ProductBrand = $pro_brand;
							$ac_obj->Date = date('d-m-y');
							$ac_obj->addtoCart();
						}


					?>
			<div class="add_cart_main_001_right">
				<div class="add_cart_main_right_01">
					<div class="right_section_01">
						<h4><i class="fal fa-location-arrow"></i>&nbsp;&nbsp;Delivery Option</h4><br>
						<p><i class="fal fa-map-marker-alt"></i>&nbsp;&nbsp;Dhaka,Dhaka-south,BanglaDesh</p>
						<a href="">Change</a>
					</div>
					<div class="right_sec_02">
						<section>
							<h4><i class="fal fa-truck"></i>&nbsp;&nbsp;Home Delivery</h4>
							<span style="font-size: 10px;"><i class="fal fa-clock"></i>&nbsp;&nbsp;4-5 days</span>
							<h3 style="float: right;">$45</h3>
						</section>
						<section style="margin-top: 10px;">
							<h5>Cash on delivary Available</h5>
						</section>
					</div>
					<div class="right_sec_03">
						<section>
							<h4><i class="fal fa-sync-alt"></i>&nbsp;&nbsp;Retutn & warranty</h4>
							<h5><i class="fal fa-clock"></i>&nbsp;&nbsp;7 day's Return's</h5>
							<h5><i class="fas fa-times-octagon"></i>&nbsp;&nbsp;Warrenty Not available</h5>
						</section>

					</div>
					<div class="right_sec_04">
						<h4><i class="fas fa-shopping-basket"></i>&nbsp;&nbsp;Sold By</h4>
						<span style="font-size: 16px;"><i class="fal fa-arrow-square-right"></i>&nbsp;&nbsp;<a href="" style="color: skyblue"><?=$pro_table_all_data_by_proID->product_brand?></a></span>
						<?php

						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<style type="text/css">
		
	</style>
	<div class="add_cart_container_002">
		<div class="add_cart_main_002">
			<div class="add_cart_main_002_left">
				<div class="show_details_info">
					<div class="detail_head">
						<h3>Product details of <?= $pro_table_all_data_by_proID->product_name?></h3>
					</div>
					<div class="show_detais_01">
						
							<ul>
							<li><strong>Item Name : </strong><?= $pro_table_all_data_by_proID->item_name?></li>
							<li><strong>Category Name : </strong><?= $pro_table_all_data_by_proID->category_name?></li>
							<li><strong>About product : </strong><?= $pro_table_all_data_by_proID->product_details?></li>
						</ul>
						
					</div>
					<div class="show_detais_02">
						<section>
							<h3>Product Information</h3>
						</section>
						<p><?= $pro_table_all_data_by_proID->product_information?></p>
					</div>
				</div>
				<div class="add_review_sec">
					<div class="detail_head">
						<h3>Say something about this product</h3>
					</div >
					<div class="review_sec_01">
						<form method="post">
							<input type="text" name="add_review" placeholder="what's on your mind?">
							<input type="submit" name="submit_review" value="Add Review" />
						</form>
					</div>
					<div class="review_sec_02">
						<section>
							<h4>Pepole are say about this product</h4>
						</section>
						<div class="single_review">
							sdfgh
						</div>

					</div>
				</div>
			</div>
			
			
			<div class="show_simeler_pro">
				<div class="show_product_container">
		<div class="show_prouct_main">
			<section>
				<h3>Product</h3>
			</section>
			<?php
				$product_table_query = $ac_obj->query("SELECT * FROM `e_com`.`product`");
				$i = 0;
				while ($product_table_all_data = $product_table_query->fetch_object()){
						
					
					if($i < 4){
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
								$query_for_brand_logo_for_problock = $ac_obj->query("SELECT * FROM `e_com`.`brand` WHERE `brand_name`='$product_table_all_data->product_brand'");
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

					
		
				$i++;

				}

			?>
			
			

			
		</div>
	</div>
			</div>
		</div>
	</div>

	
	<script src="js/foundation.min.js"></script>
    <script src="js/setup.js"></script>
    <!-- <script src="quntity_click.js"></script> -->
    <script type="text/javascript">
//     	jQuery(document).ready(function(){
//     // This button will increment the value
//     $('[data-quantity="plus"]').click(function(e){
//         // Stop acting like a button
//         e.preventDefault();
//         // Get the field name
//         fieldName = $(this).attr('data-field');
//         // Get its current value
//         var currentVal = parseInt($('input[name='+fieldName+']').val());
//         // If is not undefined
//         if (!isNaN(currentVal) && currentVal < 10) {
//             // Increment
//             $('input[name='+fieldName+']').val(currentVal + 1);
//         } else {
//             // Otherwise put a 0 there
//             //$('input[name='+fieldName+']').val(0);
//         }
//     });
//     // This button will decrement the value till 0
//     $('[data-quantity="minus"]').click(function(e) {
//         // Stop acting like a button
//         e.preventDefault();
//         // Get the field name
//         fieldName = $(this).attr('data-field');
//         // Get its current value
//         var currentVal = parseInt($('input[name='+fieldName+']').val());
//         // If it isn't undefined or its greater than 0
//         if (!isNaN(currentVal) && currentVal < 0) {
//             // Decrement one
//             $('input[name='+fieldName+']').val(currentVal - 1);
//         } else {
//             // Otherwise put a 0 there
//             $('input[name='+fieldName+']').val(0);
//         }
//     });
// });
//var stockQuantit = " <?php echo $pro_table_all_data_by_proID->product_quentity?>"
	//alert(stockQuantit);
	

$('.add').click(function () {
	
		if ($(this).prev().val() < 10) {
    	$(this).prev().val(+$(this).prev().val() + 1);
		}
});
$('.sub').click(function () {
		if ($(this).next().val() > 1) {
    	if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
		}
});


    
    </script>

    
</body>
</html>

