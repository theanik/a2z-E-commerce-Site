<?php
if(!isset($_SESSION)){
	session_start();
}
if(!isset($_SESSION['admin_id'])){
	header('location: home.php');
}


?>
<?php

class ViewItem extends mysqli{
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

$viobj = new ViewItem();
$viobj->cunnection('localhost','root');
$viobj->dbselect('e_com');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Item view</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" media="all">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" media="all">
	<link rel="stylesheet" type="text/javascript" href="js/bootstrap.js">
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
	.item_show_main{
		width: 100%;
	}
	.item_show_th{
		width: 100%;
		height: 50px;
		margin-top: 10px;
		float:left;
		border-top: 1px #605CA8 solid;
		border-bottom: 2px #605CA8 solid;

	}
	.item_show_th ul{
		list-style: none;
	}
	.item_show_th ul li{
		float: left;
		color: #605CA8;
		width: 20%;
		margin: 10px 0px;
		/*height: 30px;*/
		line-height: 30px;
		font-weight: bold;
	}
	.item_show_td{
		width: 100%;
		height: 45px;
		float: left;
		border-bottom: 1px #605CA8 solid;

	}
	.item_show_td:hover{
		background-color: #D2D2D2;
	}
	.item_show_td ul{
		list-style: none;
	}
	.item_show_td ul li{
		float: left;
		color: #605CA8;
		line-height: 30px;
		width: 20%;
		padding: 7px 0px 0px 0px;
	}
	.item_show_td ul li button{
		margin-right: 15px;
	}
	#edit_button{
		padding: 0px 12px 0px 12px;
	}
	#delete_button{
		padding: 0px 12px 0px 12px;
	}
	.item_img{
		height: 40px;
		width: 130px;
		padding: 0px;
		margin: 0px;
		margin-top: -5px;
	}
	.item_img img{
		height: 100%;
		width: 100%;

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
			<h4>E-com Admin panel || View Item</h4>
		</section>
	</div>
	<div class="item_show_main">
		<div class="item_show_th">
			<ul>
				<li>Item ID</li>
				<li>Item Name</li>
				<li>Brand Name</li>
				<li>Brand logo</li>
				<li>Option</li>
			</ul>
		</div>
		<?php
		$item_table = $viobj->query("SELECT * FROM `e_com`.`item`");
		if($item_table){
			if($item_table->num_rows > 0){
				while($item_table_all_data = $item_table->fetch_object()){
					// $item_id = $item_table_all_data->item_id;
					?>
						<div class="item_show_td">
							<ul>
								<li style="width: 20%;"><?=$item_table_all_data->item_id ?></li>
								<li style="width: 20%;"><?=$item_table_all_data->item_name ?></li>
								<li style="width: 20%;"><?=$item_table_all_data->brand_name ?></li>
								<li style="width: 20%;">
									<div class="item_img">
										<img src="data:image;base64,<?php print $item_table_all_data->brand_logo ?>">
									</div>
								</li>
								<li style="width: 20%; float: right;">
									<form method="post" action="">
										<?php
											$url_edit_item = array('value' => base64_encode('edit_item'));
										?>
										<a href="home_page.php?<?= http_build_query($url_edit_item)?>?&&action_item_id=<?= base64_encode($item_table_all_data->item_id)?>" id="edit_opt">Edit</a>
										<button id="delete_button" name="delete_item" class="btn btn-danger" value="<?=$item_table_all_data->item_id ?>">Delete</button>
									</form>
								</li>
							</ul>
						</div>
					<?php
				}
			}
		}else{
			echo "Query Error";
		}

		?>
		<!-- button process -->
		<?php
		//button action
		if(isset($_POST['edit_item'])){
			$item_id_for_edit = filter_input(INPUT_POST, 'edit_item');
			header('location: home_page.php');

		}
		if(isset($_POST['delete_item'])){
			$item_id_for_del = filter_input(INPUT_POST, 'delete_item');
			//echo $item_id_for_del;
			$del_query = $viobj->query("DELETE FROM `e_com`.`item` WHERE item_id='$item_id_for_del'");
			if($del_query){
				if($viobj->affected_rows > 0){
					echo "<meta http-equiv='refresh' content='0;url='>";
					echo "<script>alert('Item Deleted Successfully')</script>";

				}else{
					echo "<meta http-equiv='refresh' content='0;url='>";
					echo "<script>alert('Item Is not Deleted...Please try again.!!!')</script>";
				}
			}
		}

		?>
	</div>
</body>
</html><!-- Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni, assumenda, architecto eligendi voluptatem aspernatur voluptas nesciunt vero optio modi cumque necessitatibus. Esse harum culpa tenetur ratione voluptate possimus porro, aliquid minima beatae totam, consectetur molestias amet impedit omnis voluptatem nostrum. Debitis blanditiis provident error, iusto consequatur a dolores, facilis dolor sed, dicta mollitia harum nihil vel ducimus beatae. Ut nulla animi laudantium atque ex, perspiciatis, totam perferendis vero alias dolor! Soluta quam dicta, corporis cupiditate ducimus adipisci labore alias quisquam recusandae ab esse vitae id ex illo corrupti iste architecto omnis voluptas cumque harum provident nulla. Vitae, officia, doloremque! Quos! -->