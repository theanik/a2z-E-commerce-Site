<?php

if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
$session_id = session_id();
?>
<?php
class CartDtails extends mysqli{
	public function connection($host,$user){
		$this->connect($host,$user);
		if($this->connect_error){
			echo "Error to connect".$this->connect_error;
		}
	}
	public function databaseSelect($db_name){
		if(!$this->select_db($db_name)){
			echo "DataBase not found".$this->error;
		}
	}


}

$cd_obj = new CartDtails();
$cd_obj->connection('localhost','root');
$cd_obj->databaseSelect('e_com');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>cart show page</title>
	<link rel="stylesheet" type="text/css" href="fontawesome-free-5.3.1-web/css/all.css">
	<link rel="stylesheet" href="css/cart_details.css">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js">
		import swal from 'sweetalert';

	</script>

</head>
<style type="text/css">
	


</style>
<body>
	

	<div class="cart_details_container">
		<div class="cart_details_main">
			<div class="product_show_sec">
				<div class="product_show_sec_main">
					<div class="cart_header">
						<h3>Your Cart</h3>
					</div>
					<div class="show_single_item_container">
						<div class="show_single_main">
					<?php
					$sql = "SELECT count(session_id) AS total FROM `e_com`.`e_com_addcart` WHERE `session_id`='$session_id'";
		
		$add_cat_table = $home_obj->query($sql);
		$add_cart_all_data = $add_cat_table->fetch_object();
		$num_rows = $add_cart_all_data->total;
		


					$add_cart_tabele = $cd_obj->query("SELECT * FROM e_com.e_com_addcart WHERE session_id = '$session_id'");
					while($all_dataBy_session_id = $add_cart_tabele->fetch_object()){
						
				
	
		
	?>

							<div class="single_content">
								<?php
									$pro_id_for_img = $all_dataBy_session_id->product_id;
									//echo $pro_id_for_img;
									$pro_table_query_for_img = $cd_obj->query("SELECT * FROM e_com.product WHERE product_id = '$pro_id_for_img'");
									$pro_table_all_data = $pro_table_query_for_img->fetch_object();
									$pro_code_for_img = $pro_table_all_data->product_code;
									$pro_img = $pro_code_for_img."(0)";

								?>
								<div class="product_img">
									<a href="home.php?page=add_cart&&product_id=<?=$pro_id_for_img?>"><img src="../img/product/<?php print $pro_img?>.jpg" alt=""></a>
								</div>
								<div class="single_details">
									<div class="details_content">
										<div class="section_1">
											<h3><a href="home.php?page=add_cart&&product_id=<?=$pro_id_for_img?>"><?=$all_dataBy_session_id->product_name?></a></h3>
										</div>
										<div class="section_2">
											<span class="sec_2_txt">Categoty : <?=$all_dataBy_session_id->category_name?></span><br>
											<span class="sec_2_txt">Seller : <?=$all_dataBy_session_id->product_brand?></span><br>
											<h4>Price : $<?=$all_dataBy_session_id->product_price?></h4>
										</div>
										<div class="section_3">
									
											<h5>Update Quentity </h5>
												<div class="quentity_input">

												


												 <?php //print $all_dataBy_session_id->product_quentity;?>
												 	 <form method="post">
														 <button type="button" id="sub" class="sub">-</button>
													    <input type="text" id="1" value="<?php print $all_dataBy_session_id->product_quentity;?>" name="quantity" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"/>
													    <button type="button" id="add" class="add">+</button>
													<!-- 	<input type="text" name="quantity"> -->
													
													
											
													  <!--   <button value="<?=$all_dataBy_session_id->product_id?>" class="button hollow circle" data-quantity="minus" data-field="quantity">
													      <i class="fa fa-minus" aria-hidden="true"></i>
													    </button>
													      <input class="input-group-field" type="text" name="quantity" value="<?= $all_dataBy_session_id->product_quentity?>">
													     
													    <button value="<?=$all_dataBy_session_id->product_id?>" class="button hollow circle" data-quantity="plus" data-field="quantity">
													      <i class="fa fa-plus" aria-hidden="true"></i>
													    </button> -->
													   
											</div>
										</div>
									</div>
									
									<div class="button_content">
										<div class="button_div">
											
										
											<button name="remove_product" value="<?php echo $all_dataBy_session_id->product_id;?>"><i class="far fa-times" style="font-size: 30px;"></i><br>Remove</button>
										<button name="update" value="<?php echo $all_dataBy_session_id->product_id;?>"><i class="fas fa-edit" style="font-size: 30px;"></i><br>Update</button>
										 <!-- <button type="submit" name="update" value="submit">aa</button>  -->
										</form>
										</div>
										<div class="notic_sec">
											<span style="font-size: 12px; color: rgba(0,0,0,0.5); font-weight: bold;">Delivery in 4-5 Days || $45 </span><br><br>
											<span style="font-size: 12px; color: rgba(0,0,0,0.5);">7 days replecment policy</span>
										</div>
									</div>
								</div>

							</div>

							<?php
								}
							// }else{

							if($num_rows <= 0) {
							?>

						<div class="Messege_for_empty_cart">
							<div class="messege_for_empty_cart_main">
								<section>
									<h2>Your Cart is empty <i class="fal fa-smile"></i></h2>
								</section>
							</div>
						</div>
					<?php

						}
					?>
							
						</div>
						
					</div>
					<style type="text/css">
						
					</style>
					<div class="btn_sec">
						<form method="post">
						<div class="btn_sec_main">
							<?php
								if($num_rows > 0) {
							?>
							
							<input type="submit" name="check_out" value="Check Out" id="check_out">
							<?php
								}
							?>
							<input type="submit" name="continue_shopping" value=" < Continue Shopping" id="continue_shopping">
							
						</div>
						<?php

							 $user_email = $_SESSION['user_email'];
							 //echo $user_email;

						?>
						</form>
					</div>
					<span style="color: red;">
					<?php
					// $check_out_error = "Please Login First...";
						if(isset($_POST['check_out'])){
							if($_SESSION['user_email'] == true){
								//echo "<script>location=home.php?page=shopping_cart</script>"
								echo ("<script>location.href='home.php?page=shopping_cart'</script>");

							}else{
								echo "<script>swal('LogIn First', 'Please LogIn to continue...', 'error');</script>";
							}
						}
					?>
					</span>
				</div>
				
			</div>

			<?php
										
										
										if(isset($_POST['remove_product'])){
											$action_pro_id = $_POST['remove_product'];
											//echo $action_pro_id;
											//echo $pro_id_for_img;
											$del_query = $cd_obj->query("DELETE FROM e_com.e_com_addcart WHERE session_id = '$session_id' and product_id = '$action_pro_id'");
											if($del_query == true){
												if($cd_obj->affected_rows > 0){
													echo "<meta http-equiv='refresh' content='0;url='>";
												}
											}
										}
										
										if(isset($_POST['update'])){
									        $update_quenttity = $_POST['quantity'];
									       echo $update_quenttity."<br>";
									       $action_pro_id_for_update = $_POST['update'];
									       //echo $action_pro_id_for_update."<br>";
									        $query_por_table_for_pro_price = $cd_obj->query("SELECT * FROM e_com.e_com_addcart WHERE product_id = '$action_pro_id_for_update'");
									       $all_proData_by_acton_id = $query_por_table_for_pro_price->fetch_object();
									        $single_pro_price = $all_proData_by_acton_id->product_price;
									        //echo $single_pro_price;
									        $update_total_price = 1;
									        $update_total_price = $single_pro_price*$update_quenttity;
									        //echo $update_total_price."<br>";
									     
									        $up_query = $cd_obj->query("UPDATE e_com.e_com_addcart SET product_quentity='$update_quenttity' WHERE session_id = '$session_id' and product_id='$action_pro_id_for_update'");
									        if($up_query == true){
									        	if($cd_obj->affected_rows > 0){
									        		$total_price_up_query = $cd_obj->query("UPDATE e_com.e_com_addcart SET product_total_price='$update_total_price' WHERE session_id = '$session_id' and product_id='$action_pro_id_for_update'");
									        		if($cd_obj->affected_rows > 0){
									        			
									        					echo "<meta http-equiv='refresh' content='0;url='>";
									        		}
									        		//echo "okk";

									        			
									        	}else{
									        		//echo "error";
									        	}
									        }else{
									        	echo "qury else";
									        }
									    }

									?>

			<style type="text/css">
				
			</style>
			<div class="memo_sec">
				<div class="memo_sec_main">
					<div class="price_detils_header">
						<h3>Price Details</h3>
					</div>
					<div class="show_details">
						<div class="show_details_main">
							<?php
							$total_ammount = 0;
								$add_cart_tabele = $cd_obj->query("SELECT * FROM e_com.e_com_addcart WHERE session_id = '$session_id'");
								while($all_dataBy_session_id = $add_cart_tabele->fetch_object()){
									$total_ammount = $total_ammount+$all_dataBy_session_id->product_total_price;
							?>
							<div class="price_details_content">
								<span id="pro_name"><?=$all_dataBy_session_id->product_name;?></span><span id="show_quan">x <?=$all_dataBy_session_id->product_quentity;?></span>
							<h5>$<?=$all_dataBy_session_id->product_total_price;?></h5>
							</div>

							<?php
								}
								if($num_rows > 0) {
								$del_charge = 45;
								}else{
									$del_charge = 0;
								}
								$total_ammount_with_delivery_charge = $total_ammount+$del_charge;
							?>
							

							<div class="show_tolal_ammount">
								<section>
									<h4>Total Ammout</h4>
									<h5>$<?=$total_ammount;?></h5>
								</section>
								<section>
									<span style="float: left; font-size: 16px;">Delivary Charge</span>
									<span style="float: right;">+ &nbsp;&nbsp;$<?=$del_charge;?></span>
								</section>
							</div>
							<div class="show_tolal_ammount_01">
								<section>
									<span style="float: left; font-size: 18px; color: #FF9900;">Ammount Payable</span>
									<span style="float: right; color: #FF9900;">$<?=$total_ammount_with_delivery_charge;?></span>
								</section>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
<script src="js/vendor/jquery.js"></script>
	 <script type="text/javascript">

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

<!-- <div class="single_cart_content">
							<div class="single_cart_content_mian">
								<div class="single_cart_content_left">
									<div class="section_1">
										<h3>kiam shaver245</h3>
									</div>
									<div class="section_2">
										<span class="sec_2_txt">Brand : </span><br>
										<span class="sec_2_txt">Seller : </span><br>
										<h4>Price : $19330</h4>
									</div>
									<div class="section_3">
									
										<h5>Update Quentity </h5>
										<div class="quentity_input">
											    <button class="button hollow circle" data-quantity="minus" data-field="quantity">
											      <i class="fa fa-minus" aria-hidden="true"></i>
											    </button>
											      <input class="input-group-field" type="text" name="quantity" value="1">
											     
											    <button class="button hollow circle" data-quantity="plus" data-field="quantity">
											      <i class="fa fa-plus" aria-hidden="true"></i>
											    </button>

									</div>
								</div>
								
							</div>
							<div class="single_cart_content_right">
									aa
								</div>
						</div>
					</div> -->