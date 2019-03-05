<?php
if(!isset($_SESSION)){
	session_start();
}
if(!isset($_SESSION['admin_id'])){
	header('location: home.php');
}


	class slideMan extends mysqli{
		public function db_con(string $host_name,string $user){
			$this->connect($host_name, $user);
			if($this->connect_errno){
				echo "Error to conenct".$this->connect_errno;
			}
		}
		public function db_select($db_name){
			if(!$this->select_db($db_name)){
				echo "Database can not found".$this->errno;
			}
		}
	}

	$slideManObj = new slideMan();
	$slideManObj->db_con('localhost','root');
	$slideManObj->db_select('e_com');


	if(isset($_POST['update1'])){
		$img1 = $_FILES['img1']['tmp_name'];
		if($img1 == null){
			echo "<script>alert('Please choose an Image')</script>";
		}else{
		
			$img1 = addslashes($img1);
			$up_img1 = file_get_contents($img1);
			$up_img1 = base64_encode($up_img1);

			$img1_up_query = $slideManObj->query("UPDATE `e_com`.`slider_img` SET img='$up_img1' WHERE img_sl = 'img_1'");
			if($img1_up_query == true){
				if($slideManObj->affected_rows > 0){
					echo "<script>alert('Image update successfully')</script>";
				}else{
					echo "nott affected_rows";
				}
			}else{
				echo "query erro";
			}
		}
	}
	if(isset($_POST['update2'])){
		$img2 = $_FILES['img2']['tmp_name'];
		if($img2 == null){
			echo "<script>alert('Please choose an Image')</script>";
		}else{
		
			$img2 = addslashes($img2);
			$up_img2 = file_get_contents($img2);
			$up_img2 = base64_encode($up_img2);

			$img2_up_query = $slideManObj->query("UPDATE `e_com`.`slider_img` SET img='$up_img2' WHERE img_sl = 'img_2'");
			if($img2_up_query == true){
				if($slideManObj->affected_rows > 0){
					echo "<script>alert('Image update successfully')</script>";
				}else{
					echo "nott affected_rows";
				}
			}else{
				echo "query erro";
			}
		}
	}
	if(isset($_POST['update3'])){
		$img3 = $_FILES['img3']['tmp_name'];
		if($img3 == null){
			echo "<script>alert('Please choose an Image')</script>";
		}else{
		
			$img3 = addslashes($img3);
			$up_img3 = file_get_contents($img3);
			$up_img3 = base64_encode($up_img3);

			$img3_up_query = $slideManObj->query("UPDATE `e_com`.`slider_img` SET img='$up_img3' WHERE img_sl = 'img_3'");
			if($img3_up_query == true){
				if($slideManObj->affected_rows > 0){
					echo "<script>alert('Image update successfully')</script>";
				}else{
					echo "nott affected_rows";
				}
			}else{
				echo "query erro";
			}
		}
	}
	if(isset($_POST['update4'])){
		$img4 = $_FILES['img4']['tmp_name'];
		if($img4 == null){
			echo "<script>alert('Please choose an Image')</script>";
		}else{
		
			$img4 = addslashes($img4);
			$up_img4 = file_get_contents($img4);
			$up_img4 = base64_encode($up_img4);

			$img4_up_query = $slideManObj->query("UPDATE `e_com`.`slider_img` SET img='$up_img4' WHERE img_sl = 'img_4'");
			if($img4_up_query == true){
				if($slideManObj->affected_rows > 0){
					echo "<script>alert('Image update successfully')</script>";
				}else{
					echo "nott affected_rows";
				}
			}else{
				echo "query erro";
			}
		}
	}
	if(isset($_POST['update5'])){
		$img5 = $_FILES['img5']['tmp_name'];
		if($img5 == null){
			echo "<script>alert('Please choose an Image')</script>";
		}else{
		
			$img5 = addslashes($img5);
			$up_img5 = file_get_contents($img5);
			$up_img5 = base64_encode($up_img5);

			$img5_up_query = $slideManObj->query("UPDATE `e_com`.`slider_img` SET img='$up_img5' WHERE img_sl = 'img_5'");
			if($img5_up_query == true){
				if($slideManObj->affected_rows > 0){
					echo "<script>alert('Image update successfully')</script>";
				}else{
					echo "nott affected_rows";
				}
			}else{
				echo "query erro";
			}
		}
	}
	if(isset($_POST['update6'])){
		$img6 = $_FILES['img6']['tmp_name'];
		if($img6 == null){
			echo "<script>alert('Please choose an Image')</script>";
		}else{
		
			$img6 = addslashes($img6);
			$up_img6 = file_get_contents($img6);
			$up_img6= base64_encode($up_img6);

			$img6_up_query = $slideManObj->query("UPDATE `e_com`.`slider_img` SET img='$up_img6' WHERE img_sl = 'img_6'");
			if($img6_up_query == true){
				if($slideManObj->affected_rows > 0){
					echo "<script>alert('Image update successfully')</script>";
				}else{
					echo "nott affected_rows";
				}
			}else{
				echo "query erro";
			}
		}
	}

	

	// $img2 = $_FILES['img2']['tmp_name'];
	// $img2 = addslashes($img2);
	// $up_img2 = file_get_contents($img2);
	// $up_img2 = base64_encode($up_img2);

	// $img3 = $_FILES['img3']['tmp_name'];
	// $img3 = addslashes($img3);
	// $up_img3 = file_get_contents($img3);
	// $up_img3 = base64_encode($up_img3);

	// $img4 = $_FILES['img4']['tmp_name'];
	// $img4 = addslashes($img4);
	// $up_img4 = file_get_contents($img4);
	// $up_img4 = base64_encode($up_img4);

	// $img5 = $_FILES['img5']['tmp_name'];
	// $img5 = addslashes($img5);
	// $up_img5 = file_get_contents($img5);
	// $up_img5 = base64_encode($up_img5);

	// $img6 = $_FILES['img6']['tmp_name'];
	// $img6 = addslashes($img6);
	// $up_img6 = file_get_contents($img6);
	// $up_img6 = base64_encode($up_img6);


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<style type="text/css">
	*{
		margin: 0;
		padding: 0;
		box-sizing: border-box;
	}
	.header_sec{
		background-color: #605CA8;
		height: 37px;
		width: 100%;
		margin-top: 16px;
	}
	.header_sec h4{
		color: #ffffff;
		padding: 2px 0 0 4px;
	}
	.uplode_sec_container{
		width: 100%;
		/*padding: 5px;*/
		height: auto;
		margin: auto;
		float: left;
	}
	.uplode_img_th{
		width: 100%;
		float: left;
		margin-top: 20px;
	}
	.uplode_img_th ul{
		list-style: none;
	}
	.uplode_img_th ul li{
		float: left;
		border: 1px solid #605CA8;;
		padding: 6px;
		font-size: 18px;
		color:#605CA8;;
	}
	.uplode_img{
		width: 100%;
		float: left;
		margin-top: 5px;
		height: 100px;
	}
	.uplode_img ul{
		list-style: none;
		height: 100%;
	}
	.uplode_img ul li {
		float: left;
		border: 0.5px solid #605CA8;
		height: 100%;
		padding: 5px;
		/*font-size: 20px;*/
		color: #605CA8;
	}
	.img_show_sec{
		width: 60%;
		float: left;
		background-color: #ccc;
		height: 100%;
	}
	.uplode_img ul li input[type="file"]{
		float: left;
		width: 38%;
		margin-left: 2%;
	}
	.img_show_sec img{
		width: 100%;
		height: 100%;
	}
</style>
<body>
	<div class="header_sec">
		<section>
			<h4>E-com || Slider Image Management</h4>
		</section>
	</div>
	<div class="uplode_sec_container">
		<div class="uplode_img_th">
			<ul>
				<li style="width: 25%;">SL </li>
				<li style="width: 50%;">Image</li>
				<li style="width: 25%;">Action</li>
			</ul>
		</div>

		<?php
			//show current image
		$showImg1 = $slideManObj->query("SELECT * FROM `e_com`.`slider_img` WHERE img_sl = 'img_1'");
		$showImg2=  $slideManObj->query("SELECT * FROM `e_com`.`slider_img` WHERE img_sl = 'img_2'");
		$showImg3 = $slideManObj->query("SELECT * FROM `e_com`.`slider_img` WHERE img_sl = 'img_3'");
		$showImg4 = $slideManObj->query("SELECT * FROM `e_com`.`slider_img` WHERE img_sl = 'img_4'");
		$showImg5 = $slideManObj->query("SELECT * FROM `e_com`.`slider_img` WHERE img_sl = 'img_5'");
		$showImg6 = $slideManObj->query("SELECT * FROM `e_com`.`slider_img` WHERE img_sl = 'img_6'");
		$img1_all_data = $showImg1->fetch_object();
		$img2_all_data = $showImg2->fetch_object();
		$img3_all_data = $showImg3->fetch_object();
		$img4_all_data = $showImg4->fetch_object();
		$img5_all_data = $showImg5->fetch_object();
		$img6_all_data = $showImg6->fetch_object();
		//echo $slide_table_all->img;

		?>
		<form method="post" enctype="multipart/form-data">
		<div class="uplode_img">
			<ul>
				<li style="width: 25%;">Image 1</li>
				<li style="width: 50%;"><div class="img_show_sec"><img src="data:image;base64,<?php print $img1_all_data->img?>" alt=""></div><input type="file" name="img1"></li>
				<li style="width: 25%;"><input type="submit" name="update1" value="Update" class="btn btn-outline-primary"></li>
			</ul>
		</div>
		<div class="uplode_img">
			<ul>
				<li style="width: 25%;">Image 2</li>
				<li style="width: 50%;"><div class="img_show_sec"><img src="data:image;base64,<?= $img2_all_data->img?>" alt=""></div><input type="file" name="img2"></li>
				<li style="width: 25%;"><input type="submit" name="update2" value="Update" class="btn btn-outline-primary"></li>
			</ul>
		</div>
		<div class="uplode_img">
			<ul>
				<li style="width: 25%;">Image 3</li>
				<li style="width: 50%;"><div class="img_show_sec"><img src="data:image;base64,<?= $img3_all_data->img?>" alt=""></div><input type="file" name="img3"></li>
				<li style="width: 25%;"><input type="submit" name="update3" value="Update" class="btn btn-outline-primary"></li>
			</ul>
		</div>
		<div class="uplode_img">
			<ul>
				<li style="width: 25%;">Image 4</li>
				<li style="width: 50%;"><div class="img_show_sec"><img src="data:image;base64,<?= $img4_all_data->img?>" alt=""></div><input type="file" name="img4"></li>
				<li style="width: 25%;"><input type="submit" name="update4" value="Update" class="btn btn-outline-primary"></li>
			</ul>
		</div>
		<div class="uplode_img">
			<ul>
				<li style="width: 25%;">Image 5</li>
				<li style="width: 50%;"><div class="img_show_sec"><img src="data:image;base64,<?= $img5_all_data->img?>" alt=""></div><input type="file" name="img5"></li>
				<li style="width: 25%;"><input type="submit" name="update5" value="Update" class="btn btn-outline-primary"></li>
			</ul>
		</div>
		<div class="uplode_img">
			<ul>
				<li style="width: 25%;">Image 6</li>
				<li style="width: 50%;"><div class="img_show_sec"><img src="data:image;base64,<?= $img6_all_data->img?>" alt=""></div><input type="file" name="img6"></li>
				<li style="width: 25%;"><input type="submit" name="update6" value="Update" class="btn btn-outline-primary"></li>
			</ul>
		</div>
		</form>
	</div>
</body>
</html>