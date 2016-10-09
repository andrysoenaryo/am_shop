<?php require '../../inc/config.php'; 


	$conn = $one->conn;
	$message = "";
	$error = false;
	$data = array();


	if(isset($_GET['grid_table']))
	{

		$sql = "select * from icon";
		$conn->query($sql);
		$row = $conn->resultset();
		//$conn->debugDumpParams();
		foreach($row as $key => $value)
		{
			if($_SESSION['menu'][$_GET['id_menu']]['ubah']=='Y'){ $disable_ubah = '';}else{ $disable_ubah = 'disabled';}
			if($_SESSION['menu'][$_GET['id_menu']]['hapus']=='Y'){ $disable_hapus = '';}else{ $disable_hapus = 'disabled';}
			
			$data[$key]['no'] 			= $key+1;
			$data[$key]['id_icon'] 		= $value['id_icon'];
			$data[$key]['nm_icon'] 		= $value['nama_icon'];
			$data[$key]['class_icon'] 	= $value['class'];
			$data[$key]['image'] 		= "<i class='".$value['class']."'></i>";
			$data[$key]['action'] 		= "<button ".$disable_ubah." class = \"btn btn-sm btn-success\" onClick=\"action('edit','edit','".$value['id_icon']."');\"> Edit </button> 
										   <button ".$disable_hapus." class = \"btn btn-sm btn-danger\" onClick=\"action('delete','delete','".$value['id_icon']."');\"> Delete </button>
										   ";
		}
	
	}
	else if(isset($_GET['delete']))
	{
		
		$delete = "delete from icon where id_icon = '".$_GET['id_icon']."'";
		$conn->query($delete);
		$exe = $conn->execute();
		if($exe)
		{
			$message = "Sucess Delete Icon";
			$error = false;				
		}
		else
		{
			$message = "Gagal Delete Icon";
			$error = true;
			
		}
		
		$data['message'] = $message;
		$data['error'] = $error;

	}
	else if(isset($_GET['edit']))
	{
		
		$sql = "select * from icon where id_icon = '".$_GET['id_icon']."'";
		$conn->query($sql);
		$data = $conn->resultone();
		
	}
	else if(isset($_GET['simpan']))
	{
		
		if($_GET['status']=='edit')
		{
			$update = "UPDATE icon SET 
						nama_icon = '".$_GET['nm_icon']."', 
						class = '".$_GET['class_icon']."'
						WHERE id_icon = '".$_GET['id_icon']."'";
			$conn->query($update);
			$exe = $conn->execute();
			if($exe)
			{
				$message = "Sucess Update Icon";
				$error = false;				
			}
			else
			{
				$message = "Gagal Update Icon";
				$error = true;
				
			}
		}
		else
		{
			
			$insert = "INSERT INTO icon ( nama_icon, class ) VALUES ( '".$_GET['nm_icon']."', '".$_GET['class_icon']."' )";
			$conn->query($insert);
			$exe = $conn->execute();
			if($exe)
			{
				$message = "Sucess Insert Icon";
				$error = false;				
			}
			else
			{
				$message = "Gagal Insert Icon";
				$error = true;
				
			}			
		}
		
		$data['message'] = $message;
		$data['error'] = $error;
	}
	
	
echo json_encode($data);
?>