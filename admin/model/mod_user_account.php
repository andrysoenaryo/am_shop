<?php require '../../inc/config.php'; 

	$conn = $one->conn;
	$message = "";
	$error = false;
	$data = array();

	if(isset($_GET['grid_table']))
	{

		$sql = "select username,nama_lengkap,password from user_account where username <> 'superuser'";
		$conn->query($sql);
		$row = $conn->resultset();
		//$conn->debugDumpParams();
		foreach($row as $key => $value)
		{
			if($_SESSION['menu'][$_GET['id_menu']]['ubah']=='Y'){ $disable_ubah = '';}else{ $disable_ubah = 'disabled';}
			if($_SESSION['menu'][$_GET['id_menu']]['hapus']=='Y'){ $disable_hapus = '';}else{ $disable_hapus = 'disabled';}
			
			$data[$key]['no'] 			= $key+1;
			$data[$key]['username'] 	= $value['username'];
			$data[$key]['nama_lengkap'] = $value['nama_lengkap'];
			$data[$key]['password'] 	= $value['password'];
			$data[$key]['action'] 		= "<button ".$disable_ubah." class = \"btn btn-sm btn-success\" onClick=\"action('edit','tab-form','".$value['username']."');\"> Edit </button> 
										   <button ".$disable_hapus." class = \"btn btn-sm btn-danger\" onClick=\"action('delete','delete','".$value['username']."');\"> Delete </button>";
		}
		
		
	
	}
	else if(isset($_GET['delete']))
	{
		
		$delete = "delete from user_account where username = '".$_GET['username']."'";
		$conn->query($delete);
		$exe = $conn->execute();
		if($exe)
		{
			$message = "Sucess Delete User Account";
			$error = false;				
		}
		else
		{
			$message = "Gagal Delete User Account";
			$error = true;
			
		}
		
		$data['message'] = $message;
		$data['error'] = $error;

	}
	else if(isset($_GET['edit']))
	{
		
		$sql = "select * from user_account where username = '".$_GET['username']."'";
		$conn->query($sql);
		$data = $conn->resultone();
		
	}
	else if(isset($_GET['simpan']))
	{		
		
		if($_GET['status']=='edit')
		{
			$update = "UPDATE user_account SET 
						nama_lengkap = '".$_GET['nm_lengkap']."',
						password = '".md5($_GET['password'])."' 
					   WHERE username = '".$_GET['username']."'";
			$conn->query($update);
			$exe = $conn->execute();
			if($exe)
			{
				$message = "Sucess Update User Account";
				$error = false;				
			}
			else
			{
				$message = "Gagal Update User Account";
				$error = true;
				
			}
		}
		else
		{
			
			$insert = "INSERT INTO user_account ( username, nama_lengkap, password ) 
						VALUES ( '".$_GET['username']."', '".$_GET['nm_lengkap']."', '".md5($_GET['password'])."' )";
			$conn->query($insert);
			$exe = $conn->execute();
			if($exe)
			{
				$message = "Sucess Insert User Account";
				$error = false;				
			}
			else
			{
				$message = "Gagal Insert User Account";
				$error = true;
				
			}			
		}
		
		$data['message'] = $message;
		$data['error'] = $error;
	}
	
	
echo json_encode($data);
?>