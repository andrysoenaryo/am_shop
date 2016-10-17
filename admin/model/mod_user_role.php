<?php require '../../inc/config.php'; 

	$conn = $one->conn;
	$message = "";
	$error = false;
	$data = array();

	if(isset($_GET['grid_table']))
	{

		$sql = "select a.username, c.role, a.id_role
				from user_role a
				inner join user_account b on a.username = b.username
				inner join role c on a.id_role = c.id_role
				where a.username <> 'superuser'
				order by b.username, c.id_role asc";
		$conn->query($sql);
		$row = $conn->resultset();
		//$conn->debugDumpParams();
		$arrID = array();
		foreach($row as $key => $value)
		{
			
			if($_SESSION['menu'][$_GET['id_menu']]['ubah']=='Y'){ $disable_ubah = '';}else{ $disable_ubah = 'disabled';}
			if($_SESSION['menu'][$_GET['id_menu']]['hapus']=='Y'){ $disable_hapus = '';}else{ $disable_hapus = 'disabled';}
			
			$data[$key]['no'] 		= $key+1;
			$data[$key]['username'] = $value['username'];
			$data[$key]['role'] 	= $value['role'];
			$data[$key]['action'] 	= "<button ".$disable_ubah." class = \"btn btn-sm btn-success\" onClick=\"action('edit','edit','".$value['id_role']."','".$value['username']."');\"> Edit </button> 
									   <button ".$disable_hapus." class = \"btn btn-sm btn-danger\" onClick=\"action('delete','delete','".$value['id_role']."','".$value['username']."');\"> Delete </button>";
		}
		
	
	}
	else if(isset($_GET['delete']))
	{
		
		$delete = "delete from user_role where id_role = '".$_GET['id_role']."' and username = '".$_GET['username']."'";
		$conn->query($delete);
		$exe = $conn->execute();
		if($exe)
		{
			$message = "Sucess Delete User Role";
			$error = false;				
		}
		else
		{
			$message = "Gagal Delete User Role";
			$error = true;
			
		}
		
		$data['message'] = $message;
		$data['error'] = $error;

	}
	else if(isset($_GET['edit']))
	{
		
		$sql = "select * from user_role where id_role = '".$_GET['id_role']."' and username = '".$_GET['username']."'";
		$conn->query($sql);
		$data = $conn->resultone();
		
	}
	else if(isset($_GET['simpan']))
	{		
		
		if($_GET['status']=='edit')
		{
			$update = "UPDATE user_role SET 
						username = '".$_GET['username']."',
						id_role = '".$_GET['id_role']."'
					   WHERE id_role = '".$_GET['id_role']."' AND  username = '".$_GET['username']."' ";
			$conn->query($update);
			$exe = $conn->execute();
			if($exe)
			{
				$message = "Sucess Update User Role";
				$error = false;				
			}
			else
			{
				$message = "Gagal Update User Role";
				$error = true;
				
			}
		}
		else
		{
			
			$insert = "INSERT INTO user_role ( username, id_role ) 
						VALUES ( '".$_GET['username']."', '".$_GET['id_role']."')";
			$conn->query($insert);
			$exe = $conn->execute();
			if($exe)
			{
				$message = "Sucess Insert User Role";
				$error = false;				
			}
			else
			{
				$message = "Gagal Insert User Role";
				$error = true;
				
			}			
		}
		
		$data['message'] = $message;
		$data['error'] = $error;
	}
	else if($_GET['select']=='username')
	{

		$sql = "select * from user_account where username <> 'superuser'";
		$conn->query($sql);
		$row = $conn->resultset();
		//$conn->debugDumpParams();
		foreach($row as $key => $value)
		{
	
			$data[$key]['username'] 	= $value['username'];
			$data[$key]['nama_lengkap'] = $value['nama_lengkap'];
		}
	
	}
	else if($_GET['select']=='role')
	{

		$sql = "select * from role where id_role <> 1";
		$conn->query($sql);
		$row = $conn->resultset();
		//$conn->debugDumpParams();
		foreach($row as $key => $value)
		{
	
			$data[$key]['id_role'] 	= $value['id_role'];
			$data[$key]['role'] 	= $value['role'];
		}
	}
	
echo json_encode($data);
?>