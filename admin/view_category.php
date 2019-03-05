<?php
if(!isset($_SESSION)){
	session_start();
}
if(!isset($_SESSION['admin_id'])){
	header('location: home.php');
}
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Category view</title>
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
	.cat_show_main{
		width: 100%;
	}
	.cat_show_th{
		height: 50px;
		width: 100%;
		margin-top: 10px;
		float: left;
		border-top: 1px #605CA8 solid;
		border-bottom: 2px #605CA8 solid;
	}
	.cat_show_th ul{
		list-style: none;
	}
	.cat_show_th ul li{
		/*margin-top: 10px;*/
		float: left;
		width: 20%;
		color: #605CA8;
		font-weight: bold;
		line-height: 30px;
		margin:9px 0px;

	}
	.cat_show_td{
		width: 100%;
		height: 45px;
		float: left;
		border-bottom: 1px #605CA8 solid;

	}
	.cat_show_td:hover{
		background-color: #D2D2D2;
	}
	.cat_show_td ul{
		list-style: none;
	}
	.cat_show_td ul li{
		float: left;
		color: #605CA8;
		line-height: 30px;
		width: 20%;
		padding: 7px 0px 0px 3px;
	}
	.cat_show_td ul li img{
		height: 35px;
		width: 60%;
	}
	#edit_button, #delete_button{
		padding:0px 8px;
		margin-right: 20px;
	}
	#edit_opt{
		background-color: #1188CB;
		padding: 3px 8px;
		text-decoration: none;
		color: #ffffff;
		border-radius: 3px;
		margin-right: 10px;
	}
	#edit_opt:hover{
		background-color: #0069D9;
	}
</style>
<body>
	<div class="header">
		<section>
			<h4>E-com Admin panel || View Category</h4>
		</section>
	</div>
	<div class="cat_show_main">
		<div class="cat_show_th">
			<ul>
				<li>Item Name</li>
				<li>Category Name</li>
				<li>Category ID</li>
				<li>Catagery Image</li>
				<li>Option</li>
			</ul>
		</div>
			
		<?php
			$cat_table = $conn->query("SELECT * FROM `e_com`.`category`");
			if($cat_table){
				if($cat_table->num_rows > 0){
					while($cat_table_all_data = $cat_table->fetch_object()){
						?>
						<div class="cat_show_td">
							<ul>
								<li><?php print $cat_table_all_data->item_name?></li>
								<li><?php print $cat_table_all_data->category_name?></li>
								<li><?php print $cat_table_all_data->category_id?></li>
								<li><img src="data:image;base64,<?php print $cat_table_all_data->cat_img ?>"></li>
								<li>
									<form method="post">
										<?php
											$url_cat = array('value' => base64_encode('edit_category'));
										?>
										<a href="home_page.php?<?= http_build_query($url_cat)?>?&&action_cat_id=<?= base64_encode($cat_table_all_data->category_id)?>" id="edit_opt">Edit</a>
										<button id="delete_button" name="cat_delete" class="btn btn-danger" value="<?= $cat_table_all_data->category_id?>">Delete</button>
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
		
		if(isset($_POST['cat_edit'])){
			//$cat_id = filter_input(INPUT_POST, 'cat_edit');
			//echo $cat_id;
		}
		if(isset($_POST['cat_delete'])){
			$cat_id_for_btn_action = filter_input(INPUT_POST, 'cat_delete');

			//echo $cat_id_for_btn_action;

			$cat_del_query = $conn->query("DELETE FROM `e_com`.`category` WHERE category_id='$cat_id_for_btn_action'");
			if($cat_del_query){
				if($conn->affected_rows > 0){
					echo "<script>alert('Category Deleted Successfully')</script>";
					echo("<meta http-equiv='refresh' content='0;url='>");
				}else{
					echo "<script>alert('Category Is not Deleted...Please try again.!!!')</script>";
				}

			}else{
				echo "Error Query";
			}
		}
		?>
	</div>
</body>
</html>