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
		height: 44px;
		width: 100%;
		float: left;
		background-color: #605CA8;
		margin-top: 16px;
		padding: 5px;
	}
	.header_left{
		height: 100%;
		color: #FFFFFF;
		width: 50%;
		float: left;
	}
	.header_right{
		height: 100%;
		width: 50%;
		float: left;
	}
	.header_right input[type="text"]{
		width: 70%;
		height: 80%;
		float: left;
	}
	.header_right input[type="button"]{
		width: 28%;
		float: left;
		margin-left: 2%;
		padding: 4px;
	}
	.sale_det_sec_container{
		width: 100%;
		float: left;
		margin-top: 20px;
		padding: 10px;
	}
	.sale_det_sec_container ul{
		list-style: none;
	}
	.sale_det_sec_container ul li{
		float: left;
		width: 20%;
		height: 80px;
		margin-left: 2%;
		padding: 5px;
		background-color: #605CA8;
		color: #FFFFFF;
		
		margin-top: 15px;
	}
	.sale_det_sec_container ul li a{
		text-decoration: none;
	}
	.sec_block{
		color: #FFFFFF;
		font-size: 20px;
	}
</style>
<body>
	<div class="header_sec">
		<div class="header_left">
			<section>
				<h4>E-com || Sales Details</h4>
			</section>
		</div>
		<div class="header_right">
			<form method="post">
				<input type="text" name="search_sale_det" class="form-control" placeholder="Search any things for Sale Details...">
				<input type="button" name="search_btn" class="btn btn-outline-primary" value="Seach">
			</form>
		</div>
	</div>
	<div class="sale_det_sec_container">
		<div class="sale_det_sec_main">
			<ul>
				<?php
					$url_rendom_sale = array('value' => base64_encode('rendom_sale'));
					$url_today_sale = array('value' => base64_encode('today_sale'));
				?>
				<li><a href="home_page.php?<?= http_build_query($url_today_sale)?>"><span class="sec_block">To Day Sale</span></a><br><?php echo date('d-m-y')?></li>
				<li><a href=""><span class="sec_block">Last week sale</span></a></li>
				<li><a href=""><span class="sec_block">Last month sale</span></a></li>
				<li><a href=""><span class="sec_block">Last Year Sale</span></a></li>
				<li><a href="home_page.php?<?= http_build_query($url_rendom_sale)?>"><span class="sec_block">Rendom Sale</span></a></li>
			</ul>
		</div>
	</div>
</body>
</html>