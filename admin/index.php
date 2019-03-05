<?php
if(!isset($_SESSION)){
	session_start();
}
//$admin_id = $_SESSION['admin_id'];
//print $admin_email= $_COOKIE['log_email'];
//print $admin_pass = $_COOKIE['log_pass'];
// if(isset($_COOKIE["log_time"])){
// 	$cookie_value = $_COOKIE["log_time"];
// 	//$cookie_value = $admin_id;
// 	header('location: home_page.php');
// }else{
// 	header("location: home.php");
// }

/**
 * 
 */
class cooklog extends mysqli
{
	
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
	public function cookieAction(){
		if(isset($_COOKIE['log_email'])){
			$admin_email = $_COOKIE['log_email'];
			$admin_pass = $_COOKIE['log_pass'];
			$find_query = "SELECT * FROM `e_com`.`e_com_admin_panel` WHERE Admin_email='$admin_email'";
			$query_result = $this->query($find_query);
			$admin_all_data = $query_result->fetch_assoc();
			//echo $admin_all_data['Admin_password'];
			$admin_id = $admin_all_data['Admin_id'];
			if($admin_email==$admin_all_data['Admin_email'] && $admin_pass==$admin_all_data['Admin_password']){
				$_SESSION['admin_id'] = $admin_id;
				header("location: home_page.php");
			}
		}else{

			$AS_up_query = $this->query("UPDATE `e_com`.`e_com_admin_panel` SET Admin_active_status = '0' WHERE Admin_id = '$admin_id'");
			echo("<meta http-equiv='refresh' content='0;url='>");
			header("location: home.php");
		}
	}
}

$coObj = new cooklog();
$coObj->connection('localhost','root');
$coObj->DB_select('e_com');
$coObj->cookieAction();
?>