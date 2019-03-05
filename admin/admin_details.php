<?php
if(!isset($_SESSION)){
	session_start();
}
if(!isset($_SESSION['admin_id'])){
	header('location: home.php');
}
include ("db_connect.php");
$admin_action_id_for_details = base64_decode(filter_input(INPUT_GET, 'admin_action_id_for_details'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
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
	.head_sec{
		height: 37px;
		width: 100%;
		background-color: #605CA8;
		margin:16px 0px 0px 0px;
		color: #ffffff;
	}
	.head_sec h4{
		padding:4px 0px 0px 5px;
	}
	.admin_details_main{
		width: 100%;
	}
	.admin_details_td{
		width: 60%;
		 margin-top: 20px;
		 border: 1px #605CA8 dashed;
		 color: #605CA8;
		 padding: 10px;
	}
	.admin_details_td ul{
		list-style: none;
	}
	.admin_details_td ul li{
		padding: 5px;
	}
	.admin_details_opt{
		
		margin-top: 30px;

	}
	#back_opt{
		text-decoration: none;
		color: #ffffff;
		background-color: #0080FF;
		font-size: 15px;
		padding: 5px 10px;
		border-radius: 3px;
	}
	#back_opt:hover{
		background-color: #0D3AF2;
	}
</style>
<body>
	<div class="head_sec">
		<h4>E-com Admin Panel || Admin Details || Admin ID : <?= $admin_action_id_for_details ?></h4>
	</div>
	<?php
		$admin_table = $conn->query("SELECT * FROM e_com.e_com_admin_panel WHERE Admin_id='$admin_action_id_for_details'");
		if($admin_table){
			if($conn->affected_rows > 0){
				$admin_data = $admin_table->fetch_object();
			}
		}
	?>
	<div class="admin_details_main">
		<div class="admin_details_td">
			<ul>
				<li><b>Admin ID : </b><?=$admin_data->Admin_id?></li>
				<li><b>Admin Name : </b><?=$admin_data->Admin_name?></li>
				<li><b>Admin Email : </b><?=$admin_data->Admin_email?></li>
				<li><b>Admin Address : </b><?=$admin_data->Admin_address?></li>
				<li><b>Admin Type : </b><?=$admin_data->Admin_type?></li>
				<?php
					if($admin_data->Admin_active_status == '1'){
						?>
						<li><b>Active Status : </b><span style="color: green;">Active Now</span></li>
						<?php
					}else{
						?>
						<li><b>Active Status : </b><span style="color:#FF0000 ;">Not Acitve</span></li>
						<?php
					}
				?>
				
			</ul>
		</div>
		<div class="admin_details_opt">
			 <?php
	   			$url_admin_view = array('value' => base64_encode('view_admin')); ?>
			<a href="home_page.php?<?= http_build_query($url_admin_view) ?>" id="back_opt"> < Back to View</a>
		</div>
	</div>
</body>
</html>