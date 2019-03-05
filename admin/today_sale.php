<?php
	class Con extends mysqli{
		public function db_con($host,$user){
			$this->connect($host,$user);
			if($this->connect_errno){
				echo "Connect to error...".$this->connect_errno;
			}
		}
		public function db_select($db_name){
			if(!$this->select_db($db_name)){
				echo "Database not found".$this->errno;
			}
		}
	}

	$con = new Con();
	$con->db_con('localhost','root');
	$con->db_select('e_com');

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
		height: 40px;
		width: 100%;
		background-color: #605CA8;
		float: left;
		color: #ffffff;
		margin-top: 16px;
	}
	.header_sec h4{
		padding: 6px;
	}
	.show_sale_container{
		width: 100%;
		float: left;
	}
	.show_sale_th{
		height: 50px;
		width: 100%;
		margin-top: 10px;
		float: left;
		border-top: 1px #605CA8 solid;
		border-bottom: 2px #605CA8 solid;
	}
	.show_sale_th ul{
		list-style: none;
	}
	.show_sale_th ul li{
		/*margin-top: 10px;*/
		float: left;
		width: 20%;
		color: #605CA8;
		font-weight: bold;
		line-height: 30px;
		margin:9px 0px;
		text-align: center;
	}
	.show_sale_td{
		width: 100%;
		height: 45px;
		float: left;
		border-bottom: 1px #605CA8 solid;

	}
	.show_sale_td:hover{
		background-color: rgba(0,0,0,0.04);
	}
	.show_sale_td ul{
		list-style: none;
	}
	.show_sale_td ul li{
		float: left;
		color: #605CA8;
		line-height: 30px;
		width: 20%;
		padding: 7px 0px 0px 3px;
		overflow: hidden;
		text-align: center;
		border-right: 0.5px dashed #605CA8;
		border-left: 0.5px dashed #605CA8;
	}
</style>
<body>
	<div class="header_sec">
		<section>
			<h4>E-com || To Day Sale</h4>
		</section>
	</div>
	<div class="show_sale_container">
		<div class="show_sale_th">
			<ul>
				<li>Session ID</li>
				<li>Odder ID</li>
				<li>C-Email</li>
				<li>Ammount</li>
				<li>Date</li>
			</ul>
		</div>

		
			
				<?php
				//$date = "20"."date('d-m-y')";
					$sale_table = $con->query("SELECT * FROM e_com.sale_details WHERE date='$date'");
					if($sale_table){
						if($sale_table->num_rows > 0){
							while($sale_table_all = $sale_table->fetch_object()){
								?>
								<div class="show_sale_td">
									<ul>
										<li><?=$sale_table_all->session_id ?></li>
										<li><?=$sale_table_all->order_code ?></li>
										<li><?=$sale_table_all->customar_email ?></li>
										<li><?=$sale_table_all->total_sale_ammount ?></li>
										<li><?=$sale_table_all->date ?></li>
									</ul>
								</div>
								<?php
							}
						}
					}
				?>
	</div>
</body>
</html>