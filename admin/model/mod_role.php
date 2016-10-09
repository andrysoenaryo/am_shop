<?php require '../../inc/config.php'; 
/*if (!isset($_SESSION)) {
    session_start();
}*/

	$conn = $one->conn;
	$message = "";
	$error = false;
	$data = array();


	if(isset($_GET['grid_table']))
	{

		$sql = "select * from role where id_role <> 1";
		$conn->query($sql);
		$row = $conn->resultset();
		//$conn->debugDumpParams();
		foreach($row as $key => $value)
		{
			
			if($_SESSION['menu'][$_GET['id_menu']]['ubah']=='Y'){ $disable_ubah = '';}else{ $disable_ubah = 'disabled';}
			if($_SESSION['menu'][$_GET['id_menu']]['hapus']=='Y'){ $disable_hapus = '';}else{ $disable_hapus = 'disabled';}
 	
			
			$data[$key]['no'] 			= $key+1;
			$data[$key]['id'] 			= $value['id_role'];
			$data[$key]['role'] 		= $value['role'];
			$data[$key]['action'] 		= "<button ".$disable_ubah." class = \"btn btn-sm btn-success\" onClick=\"action('edit','btn-edit','".$value['id_role']."');\"> Edit </button> 
										   <button ".$disable_hapus." class = \"btn btn-sm btn-danger\" onClick=\"action('delete','delete','".$value['id_role']."');\"> Delete </button>
										   ";
		}
	
	}
	else if(isset($_GET['delete']))
	{
		
		$delete = "delete from role where id_role = '".$_GET['id_role']."'";
		$conn->query($delete);
		$exe = $conn->execute();
		if($exe)
		{
			$message = "Sucess Delete Role";
			$error = false;				
		}
		else
		{
			$message = "Gagal Delete Role";
			$error = true;
			
		}
		
		$data['message'] = $message;
		$data['error'] = $error;

	}
	else if(isset($_GET['edit']))
	{
		
		$sql = "select * from role where id_role = '".$_GET['id_role']."'";
		$conn->query($sql);
		$data = $conn->resultone();
		
	}
	else if(isset($_GET['simpan']))
	{
		
		if($_GET['status']=='edit')
		{
			$update = "UPDATE role SET role = '".$_GET['nm_role']."' WHERE id_role = '".$_GET['id_role']."'";
			$conn->query($update);
			$exe = $conn->execute();
			if($exe)
			{
				$message = "Sucess Update Role";
				$error = false;				
			}
			else
			{
				$message = "Gagal Update Role";
				$error = true;
				
			}
		}
		else
		{
			
			$insert = "INSERT INTO role ( role ) VALUES ( '".$_GET['nm_role']."' )";
			$conn->query($insert);
			$exe = $conn->execute();
			if($exe)
			{
				$message = "Sucess Insert Role";
				$error = false;				
			}
			else
			{
				$message = "Gagal Insert Role";
				$error = true;
				
			}			
		}
		
		$data['message'] = $message;
		$data['error'] = $error;
	}
	
echo json_encode($data);
?>