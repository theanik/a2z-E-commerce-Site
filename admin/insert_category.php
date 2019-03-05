<?php
if(!isset($_SESSION)){
	session_start();
}
if(!isset($_SESSION['admin_id'])){
	header('location: home.php');
}
?>
<?php
	class categore_itemManage extends mysqli{

		public function connection(string $hostName, string $userName){
	        $this->connect($hostName, $userName);
	        if($this->connect_errno){
	            echo('Error to connect '.$this->connect_error);
	        }
	    }
		public function db_select(string $db_name){
			if(!$this->select_db($db_name)){
				echo "Database Not found..!".$this->errno;
			}
		}
		//add data in category table
		public $ItemName = false;
		public $CategoryName = false;
		public $Category_image = false;



		public function addNewCat(){
			if(($this->ItemName && $this->CategoryName && $this->Category_image) == true){
			$add_query = "INSERT INTO `e_com`.`category` (`item_name`, `category_name`, `cat_img`) VALUES ('$this->ItemName','$this->CategoryName','$this->Category_image')";
			$add_query_result =$this->query($add_query);
				if($add_query_result){
					if($this->affected_rows > 0){

						echo "<script>alert('Category add successfully')</script>";
					}else{
						echo "<script>alert('Category Not Add...please try again.')</script>";
					}
				}else{
					echo "Error Query";
				}
			}else{
				echo "Error";
			}
			
		}
	}



$obj_cat_item = new categore_itemManage();
$obj_cat_item->connection('localhost','root');
$obj_cat_item->db_select('e_com');
//$obj_cat_item->addNewCat();
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
	
	.form_sec button{
		padding: 8px 16px;
		background-color: #605CA8;
		border:none;
		border-radius: 4%;
		margin-top: 10px;
		text-align: center;
		color: #ffffff;
	}
	.form_sec button:hover{
		background-color: green;
	}
	.form_sec button:active{
		background-color: #605CA8;
	}
</style>
<body>
	<div class="header_sec">
		<section>
			<h4>E-com || Add New Category</h4>
		</section>
	</div>

	<div class="container-fluid">
		<div class="row">
			<div class="body_sec">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-3">
							
						</div>
						<div class="col-md-6">
							<div class="form_sec">

<?php
$item_name = filter_input(INPUT_POST, 'item_name');
$cat_name = filter_input(INPUT_POST, 'cat_name');
$cat_id = filter_input(INPUT_POST, 'cat_id');
if(isset($_POST['submit_cat'])){
	$obj_cat_item->ItemName = $item_name;
	$obj_cat_item->CategoryName = $cat_name;

	$img = $_FILES['cat_img']['tmp_name'];
	$img = addslashes($img);
	$cat_img = file_get_contents($img);
	$cat_img = base64_encode($cat_img);
	$obj_cat_item->Category_image = $cat_img;
	$obj_cat_item->addNewCat();
}

?>
								<form method="post" enctype="multipart/form-data">
									<label id="label_s" style="font-size: 20px;color: #605CA8;">Item Name:</label>
									<!-- <input type="text" name="item_name" placeholder="Item Name" required="" class="form-control"> -->
									<select name="item_name" class="form-control">
										<option hidden="">Select Item</option>
										<?php
											$item_table_select_query =$obj_cat_item->query("SELECT * FROM `e_com`.`item`");
											if($item_table_select_query){
												if($item_table_select_query->num_rows > 0){
													while($col = $item_table_select_query->fetch_object()){
														?>
														<option><?php print $col->item_name?></option>
													<?php
												}
											}
										}
										?>
									</select>
									<label id="label_s" style="font-size: 20px;color: #605CA8;">Category Name</label>
									<input type="text" name="cat_name" placeholder="Item Name" required="" class="form-control">
									<label id="label_s" style="font-size: 20px;color: #605CA8;">Category Image</label>
									<input type="file" name="cat_img" class="form-control" placeholder="Category Image">
									<button class="" name="submit_cat">Submit</button>
								</form>
							</div>
						</div>
						<div class="col-md-3">
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="test">
		
		
	</div>
</body>
</html>