<?php

if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
$session_id = session_id();
$session_user_email = $_SESSION['user_email'];
?>
<?php
	class ShoppinCart extends mysqli{
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
	    public $SessionId = false;
	    public $CustomarName = false;
	    public $CustomarEmail = false;
	    public $PhoneNumber = false;
	    public $Location = false;
	    public $Address = false;
	    public $OrderCode = false;
	    public $ProdctName = false;
	    public $ProductId = false;
	    public $ProductBrand = false;
	    public $ItemName = false;
	    public $Category = false;
	    public $ProductPrice = false;
	    public $SaleProductQuantity = false;
	    public $TotalProductPrice = false;
	    public $ProductDetails = false;
	    public $Date = false;
	    public function AddShoppintCart(){
	    	if(($this->CustomarName && $this->CustomarEmail && $this->PhoneNumber && $this->Location && $this->Address && $this->OrderCode && $this->SessionId && $this->ProductId)==true){

	    	$insert_ShoppintCart = $this->query("INSERT INTO e_com.shopping_cart (session_id,customar_name, customar_email,customar_phone,location,address,order_code,product_name,product_id,product_brand,item_name,category,product_price,sale_pro_quantity,total_pro_price,product_detalis,date)VALUES('$this->SessionId','$this->CustomarName','$this->CustomarEmail','$this->PhoneNumber','$this->Location','$this->Address','$this->OrderCode','$this->ProdctName','$this->ProductId','$this->ProductBrand','$this->ItemName','$this->Category','$this->ProductPrice','$this->SaleProductQuantity','$this->TotalProductPrice','$this->ProductDetails','$this->Date')");


	    			if($insert_ShoppintCart == true){
	    				if($this->affected_rows > 0){
	    					//echo "<script>alert('thank you for shopping')</script>";
	    					echo ("<script>location.href='thank_you.php'</script>");
	    				
	    					session_unset();
	    					session_regenerate_id();
	    					session_destroy();
	    					session_unset($session_id);
	    				}else{

	    					echo "not add";
	    				}
	    			}else{
	    				echo "error query";
	    			}
	    	}else{
	    		echo "<script>swal('Please Fill Up all Fied','submit the recommed data','warning')</script>";
	    	}
	    }

	    public $TotalShoppingAmmount = false;
	    public $CustomarInfo = false;
	    public function AddSaleDetails(){
	    	if(($this->CustomarName && $this->CustomarEmail && $this->CustomarInfo && $this->Address && $this->OrderCode && $this->SessionId)==true){
	    		$sale_detalis_add_query = $this->query("INSERT INTO e_com.sale_details (session_id,customar_name,customar_email,customar_info,order_code,total_sale_ammount,date) VALUES ('$this->SessionId','$this->CustomarName','$this->CustomarEmail','$this->CustomarInfo','$this->OrderCode','$this->TotalShoppingAmmount','$this->Date')");
	    		
	    		if($sale_detalis_add_query == true){
	    			if($this->affected_rows > 0){
	    				
	    			}
	    		}
	    	}else{
	    		//echo "fiil up";
	    	}
	    }

}


$sc_obj = new ShoppinCart();
$sc_obj->connection('localhost','root');
$sc_obj->DB_select('e_com');

?>

<?php
	$order_code =  rand();
	//var_dump($order_code);
	
	$select_user_table_by_email = $sc_obj->query("SELECT * FROM e_com.user_data WHERE user_email='$session_user_email'");
	$all_data_by_session_email = $select_user_table_by_email->fetch_object();


	$selec_add_cart_by_session_id = $sc_obj->query("SELECT * FROM e_com.e_com_addcart WHERE session_id = '$session_id'");
	//$all_data_from_addCart_by_sessionId = $selec_add_cart_by_session_id->fetch_object();

	//echo $all_data_from_addCart_by_sessionId;

	

	if(isset($_POST['final_check_out'])){

		// $sql = "SELECT count(session_id) AS total FROM `e_com`.`e_com_addcart` WHERE `session_id`='$session_id'";
		// //$add_cart_select = "SELECT * FROM `e_com`.`e_com_addcart` WHERE `session_id`='$session_id'";
		// $add_cat_table = $home_obj->query($sql);
		// $add_cart_all_data = $add_cat_table->fetch_object();
		// $num_rows = $add_cart_all_data->total;



		$customar_name = filter_input(INPUT_POST, 'user_name');
		//echo $customar_name;
		$session_user_email = $_SESSION['user_email'];
		$customar_phone = filter_input(INPUT_POST, 'user_phone');
		//echo $customar_phone;
		$region = filter_input(INPUT_POST, 'region');
		//echo $region;
		$city = filter_input(INPUT_POST, 'city');
		//echo $city;
		$area = filter_input(INPUT_POST, 'area');
		//echo $area;
		$location = $region."-".$city."-".$area;
		//echo $location;
		$address = filter_input(INPUT_POST, 'user_address');

		//echo $address;

		 	
 
 		while($all_data_from_addCart_by_sessionId = $selec_add_cart_by_session_id->fetch_object()){
		$product_name = $all_data_from_addCart_by_sessionId->product_name;
		$product_id = $all_data_from_addCart_by_sessionId->product_id;
		//echo $product_id;
		$product_brand = $all_data_from_addCart_by_sessionId->product_brand;
		$item_name = $all_data_from_addCart_by_sessionId->item_name;
		$category_name = $all_data_from_addCart_by_sessionId->category_name;
		$product_price = $all_data_from_addCart_by_sessionId->product_price;
		$product_quentity = $all_data_from_addCart_by_sessionId->product_quentity;
		$product_total_price = $all_data_from_addCart_by_sessionId->product_total_price;
		$product_detalis = $all_data_from_addCart_by_sessionId->product_details;
		$sale_date = $all_data_from_addCart_by_sessionId->sale_date;

		//echo $product_name."<br>";
		// echo $location;
		$sc_obj->SessionId = $session_id;
		$sc_obj->CustomarName = $customar_name;
		$sc_obj->CustomarEmail = $session_user_email;
		$sc_obj->PhoneNumber = $customar_phone;
		$sc_obj->Location = $location;
		$sc_obj->Address = $address;
		$sc_obj->OrderCode = $order_code;
		$sc_obj->ProdctName = $product_name;
		$sc_obj->ProductId = $product_id;
		$sc_obj->ProductBrand = $product_brand;
		$sc_obj->ItemName = $item_name;
		$sc_obj->Category = $category_name;
		$sc_obj->ProductPrice = $product_price;
		$sc_obj->SaleProductQuantity = $product_quentity;
		$sc_obj->TotalProductPrice = $product_total_price;
		$sc_obj->ProductDetails =$product_detalis;
		$sc_obj->Date = $sale_date;
		$sc_obj->AddShoppintCart();


		// echo "click";

		$buy_product_quentity = $all_data_from_addCart_by_sessionId->product_quentity."<br>";
		$buy_product_id = $all_data_from_addCart_by_sessionId->product_id."<br>";

		$pro_table = $sc_obj->query("SELECT * FROM e_com.product WHERE product_id = '$buy_product_id'");
		$all_data_pro_table_buy_id = $pro_table->fetch_object();

		$product_quantity_from_product_table = $all_data_pro_table_buy_id->product_quentity;
		$update_product_quantity = $product_quantity_from_product_table-$buy_product_quentity;
		// echo $product_quantity_from_product_table."<br>";
		// echo $update_product_quantity;
		$update_quantityToProduct_table = $sc_obj->query("UPDATE e_com.product SET product_quentity='$update_product_quantity' WHERE product_id = '$buy_product_id'");
}


	$query_shopping_cart = $sc_obj->query("SELECT * FROM e_com.shopping_cart WHERE session_id = '$session_id' and customar_email = '$session_user_email' and order_code = '$order_code'");
	$total_shopping_ammount = 45;
	while ($al_data_for_this_shopping_from_shopping_cart = $query_shopping_cart->fetch_object()) {
		
		
		$total_shopping_ammount = $total_shopping_ammount + $al_data_for_this_shopping_from_shopping_cart->total_pro_price;
		//echo $al_data_for_this_shopping_from_shopping_cart->total_pro_price;
	}
	$cuntomar_contact_info = "Phone : ".$customar_phone." Address : ".$address."--".$location;
	$sc_obj->CustomarInfo = $cuntomar_contact_info;
	$sc_obj->TotalShoppingAmmount = $total_shopping_ammount;
	$sc_obj->AddSaleDetails();


///update product table
	
		
	






	}




?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="css/shopping_cart.css">
</head>
<style type="text/css">
	
</style>
<body>
	<form method="post">
	<div class="shopping_cart_container">
		<div class="shopping_cart_main">
			<div class="delivery_info_sec">
				<div class="delivery_info_sec_main">
					<div class="info_header">
						<span>Delivery Imformation</span>
					</div>
					<div class="del_info_from_container">
						<div class="del_info_from_main">
							<div class="form_left_sec">
								<fieldset>
						<ul>
							<li><label>Full Name</label><span class="error_elert"><?php //print $nameError;?></span></li>
							<li><input type="text" name="user_name" placeholder="Enter Full Name" value="<?=$all_data_by_session_email->user_name;?>"></li>
						</ul>
					</fieldset>
					<fieldset>
						<ul>
							<li><label>Email</label><span class="error_elert"><?php //print $emailError;?></span></li>
							<li><input type="text" name="user_email"  placeholder="Enter Email" value="<?=$all_data_by_session_email->user_email;?>" readonly="" style="color: rgba(0,0,0,0.5);"></li>
						</ul>
					</fieldset>
					<fieldset>
						<ul>
							<li><label>Phone</label><span class="error_elert"><?php //print $phoneError;?></span></li>
							<li><input type="text" name="user_phone" placeholder="Enter your phonenumber" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" value="<?=$all_data_by_session_email->user_phone_number;?>"></li>
						</ul>
					</fieldset>
					<fieldset>
						<ul>
							<li><label>Password</label><span class="error_elert"><?php //print $passError;?></span></li>
							<li><input type="Password" name="user_password" placeholder="Enter your password" value=""></li>
						</ul>
					</fieldset>
					
							</div>


							<div class="form_right_sec">
								<?php //echo $order_code; ?>
								<fieldset>
									<ul>
										<li><label>Region</label><span class="error_elert"><?php //print $passError;?></span></li>
										<li><select name="region" id="">
											<option value="" hidden="">Please Choose Your Region</option>
											<option value="Chittagong">Chittagong</option>
											<option>Barisal</option>
											<option>Dhaka</option>
											<option>Rangpur</option>
											<option>MaymenSing</option>
											<option>Klulna</option>
											<option>Sylhet</option>
											<option>Rajshahi</option>
										</select></li>
									</ul>
								</fieldset>
								<fieldset>
									<ul>
										<li><label>City</label><span class="error_elert"><?php //print $passError;?></span></li>
										<li><select name="city" id="">
											<option value="" hidden="">Please Choose Your City</option>
											<option>Chittagong</option>
											<option>Barisal</option>
											<option>Dhaka</option>
											<option>Rangpur</option>
											<option>MaymenSing</option>
											<option>Klulna</option>
											<option>Sylhet</option>
											<option>Rajshahi</option>
										</select></li>
									</ul>
								</fieldset>
								<fieldset>
									<ul>
										<li><label>Area</label><span class="error_elert"><?php //print $passError;?></span></li>
										<li><select name="area" id="">
											<option value="" hidden="">Please Choose Your Area</option>
											<option>Chittagong</option>
											<option>Barisal</option>
											<option>Dhaka</option>
											<option>Rangpur</option>
											<option>MaymenSing</option>
											<option>Klulna</option>
											<option>Sylhet</option>
											<option>Rajshahi</option>
										</select></li>
									</ul>
								</fieldset>
								<fieldset>
									<ul>
										<li><label>Address</label></li>
										<li><textarea name="user_address" id="" rows="3" placeholder="Enter you Present Address"></textarea></li>
									</ul>
								</fieldset>
								<div class="submit_btn_sec">
									<input type="submit" name="submit" value="Submit"/>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>



			<div class="order_summary_container">
					<div class="order_sumary_main">
						<div class="oder_summary_header">
							<span>Order Summary</span>
						</div>
						<div class="summary_content">
							<fieldset>
							<span>Subtotal(3 Item)</span>
							<h5>$134</h5>
							</fieldset>
							<fieldset>
							<span>Shiffing Fee</span>
							<h5>$134</h5>
							</fieldset>
							<fieldset>
							<input type="text" name="order_code" placeholder="Enter Order Code">
							<input type="submit" name="submit_order_code" value="APPALY">
							</fieldset>
							<fieldset>
								<span style="font-size: 20px;">Total</span>
								<span style="color: #F99000; float: right; font-size: 18px;">$134</span>

							</fieldset>
							<fieldset>
								<span style="font-size: 12px; float: right;">VAT included, where applicable</span>
							</fieldset>
							<fieldset>
								<ul>
										<li><label>Pyment Method</label><span class="error_elert"><?php //print $passError;?></span></li>
										<li><select name="" id="">
											<option value="" hidden="">Please Choose Your Pyment Method</option>
											<option value="">bKash</option>
											<option value="">Cash on delivery</option>
											<option value="">a2z Account</option>
										</select></li>
									</ul>
							</fieldset>
							<fieldset>
								<input type="submit" name="final_check_out" value="Final Check Out || Place Order" id="final_check_out">
							</fieldset>
						</div>
					</div>
				</div>
		</div>
	</div>
	</form>

</body>
</html>