<?php
if(!isset($_SESSION)){
	session_start();
}
if(!isset($_SESSION['admin_id'])){
	header('location: home.php');
}
include("db_connect.php");
$action_cat_id = base64_decode(filter_input(INPUT_GET, 'action_cat_id'));
$admin_id = $_SESSION['admin_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin View</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" media="all">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" media="all">
	<link rel="stylesheet" type="text/javascript" href="js/bootstrap.js">
</head>
<style type="text/css">
	*{
		margin:0px;
		padding: 0px;
		box-sizing: border-box;
	}
	body{
		font-family: sans-serif;
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
		padding: 5px 0px 0px 4px;
	}
	.admin_show_main{
		width: 100%;
	}
	.admin_show_th{
		width: 100%;
		height: 50px;
		margin-top: 10px;
		float:left;
		border-top: 1px #605CA8 solid;
		border-bottom: 2px #605CA8 solid;
	}
	.admin_show_th ul{
		list-style: none;
	}
	.admin_show_th ul li{
		float: left;
		color: #605CA8;
		/*width: 20%;*/
		margin: 10px 0px;
		/*height: 30px;*/
		line-height: 30px;
		font-weight: bold;
		border-right: 0.2px #605CA8 dashed;
		padding: 0px 0px 0px 10px;
	}
	.show_for_PA{
		width: 100%;
		height: 45px;
		float: left;
		border-bottom: 1px #605CA8 solid;

	}
	.show_for_PA:hover{
		background-color: #D2D2D2;
	}
	.show_for_PA ul{
		list-style: none;
	}
	.show_for_PA ul li{
		margin-top: 7px;
		float: left;
		color: #605CA8;
		line-height: 30px;
		/*width: 20%;*/
		/*padding: 7px 0px 0px 0px;*/
		border-right: 0.2px #605CA8 dashed;
		padding: 0px 0px 0px 10px;
	}
	/*-------------*/
	.show_for_SA{
		width: 100%;
		height: 45px;
		float: left;
		border-bottom: 1px #605CA8 solid;

	}
	.show_for_SA:hover{
		background-color: #D2D2D2;
	}
	.show_for_SA ul{
		list-style: none;
	}
	.show_for_SA ul li{
		margin-top: 7px;
		float: left;
		color: #605CA8;
		line-height: 30px;
		/*width: 20%;*/
		/*padding: 7px 0px 0px 0px;*/
		border-right: 0.2px #605CA8 dashed;
		padding: 0px 0px 0px 10px;
	}
	#details_opt{
		background-color: #1188CB;
		padding: 4px 5px;
		text-decoration: none;
		color: #ffffff;
		border-radius: 3px;
		margin-right: 20px;
		text-align: center;
	}
	#details_opt:hover{
		background-color: #0069D9;
	}
	#remove_btn{
		padding: 0px 5px;
	}
	#details_pa{
		background-color: #1188CB;
		text-decoration: none;
		color: #ffffff;
		border-radius: 3px;
		text-align: center;
		padding: 4px 54px;
	}
	#details_pa:hover{
		background-color: #0069D9;
	}
	.as_show{
		height: 10px;
		width: 10px;
		background-color: #49E207;
		border-radius: 50%;
		margin: 11px 0px 0px 60px;
	}
</style>
<body>
	<div class="header">
		<section>
			<h4>E-com Admin panel || View All Admin</h4>
		</section>
	</div>
	<div class="admin_show_main">
		<div class="admin_show_th">
			<ul>
				<li style="border-left: 0.2px #605CA8 dashed; width: 15%;">Admin ID</li>
				<li style="width: 20%;">Admin Name</li>
				<li style="width: 30%;">Admin Email</li>
				<li style="width: 15%;">Active Status</li>
				<li style="width: 20%;">Option</li>
			</ul>
		</div>
		<?php
			$admin_table = $conn->query("SELECT * FROM `e_com`.`e_com_admin_panel`");
			if($admin_table){
				if($conn->affected_rows > 0){
					while($admin_all_data = $admin_table->fetch_object()){
						if($admin_all_data->Admin_type == 'Primary Admin'){

						?>
						<div class="show_for_PA">
							<ul>
								<li style="border-left: 0.2px #605CA8 dashed; width: 15%;"><?=$admin_all_data->Admin_id?></li>
								<li style="width: 20%;"><?=$admin_all_data->Admin_name?></li>
								<li style="width: 30%;"><?=$admin_all_data->Admin_email?></li>
								<li style="width: 15%;">
									<?php
										if($admin_all_data->Admin_active_status == '1'){
											?>
												<div class="as_show"></div>
											<?php
										}
									?>
									
								</li>
								<?php
									$url_admin_details = array('value' => base64_encode('admin_details'));
								?>
								<li style="width: 20%;"><a href="home_page.php?<?= http_build_query($url_admin_details)?>?&&admin_action_id_for_details=<?= base64_encode($admin_all_data->Admin_id)?>" id="details_pa">Details</a></li>
							</ul>
						</div>
							<?php
						}else{
							?>
						<div class="show_for_SA">
							<ul>
								<li style="border-left: 0.2px #605CA8 dashed; width: 15%;"><?=$admin_all_data->Admin_id?></li>
								<li style="width: 20%;"><?=$admin_all_data->Admin_name?></li>
								<li style="width: 30%;"><?=$admin_all_data->Admin_email?></li>
								<li style="width: 15%;">
									<?php
										if($admin_all_data->Admin_active_status == '1'){
											?>
												<div class="as_show"></div>
											<?php
										}
									?>
								</li>
								<li style="width: 20%;">
									<form action="" method="post">
										<a href="home_page.php?<?= http_build_query($url_admin_details)?>?&&admin_action_id_for_details=<?= base64_encode($admin_all_data->Admin_id)?>" id="details_opt">Details</a>
										<?php
											if(isset($_POST['remove_admin'])){
												$remove_admin_id = filter_input(INPUT_POST, 'remove_admin');
												$del_query = $conn->query("DELETE FROM e_com.e_com_admin_panel WHERE Admin_id = '$remove_admin_id'");
												if($del_query){
													if(!$conn->affected_rows > 0){
														// echo "<script>alert('Admin Romove')</script>";
														echo "<meta http-equiv='refresh' content='0;url='>";
													}else{
														//echo "<script>alert('Something want wrong!!!please try again...')</script>";
														echo "<script>alert('Admin Romove')</script>";
														echo "<meta http-equiv='refresh' content='0;url='>";
													}
												}
											}
										?>
										<button name="remove_admin" id="remove_btn" class="btn btn-danger" value="<?=$admin_all_data->Admin_id?>">Romove</button>
									</form>
								</li>
							</ul>
						</div>
						<?php
						}
					}
				}
			}
		?>
		
		
	</div>
</body>
</html>