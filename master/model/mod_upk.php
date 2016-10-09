<?php require '../../inc/config.php'; 

	$conn = $one->conn;
	$message = "";
	$error = false;
	$data = array();

	if(isset($_GET['grid_table']))
	{

		$sql = "select * from master_upk order by propinsi, kabupaten";
		$conn->query($sql);
		$row = $conn->resultset();
		//$conn->debugDumpParams();
		foreach($row as $key => $value)
		{
			if($_SESSION['menu'][$_GET['id_menu']]['ubah']=='Y'){ $disable_ubah = '';}else{ $disable_ubah = 'disabled';}
			if($_SESSION['menu'][$_GET['id_menu']]['hapus']=='Y'){ $disable_hapus = '';}else{ $disable_hapus = 'disabled';}
			
			$data[$key]['no'] 			= $key+1;
			$data[$key]['upk'] 			= $value['upk'];
			$data[$key]['nama'] 		= $value['nama'];
			$data[$key]['alamat'] 		= $value['alamat'];
			//$data[$key]['active'] 		= $value['status']==0 ? "<span class=\"label label-success\">Active</span>" : "<span class=\"label label-danger\">Not Active</span>";
			$data[$key]['action'] 		= "<button ".$disable_ubah." class = \"btn btn-sm btn-success\" onClick=\"action('edit','tab-form','".$value['upk']."');\"> Edit </button> 
										   <button ".$disable_hapus." class = \"btn btn-sm btn-danger\" onClick=\"action('delete','delete','".$value['upk']."');\"> Delete </button>";
		}
		
	
	}
	else if(isset($_GET['delete']))
	{
		
		$delete = "delete from master_upk where upk = '".$_GET['id']."'";
		$conn->query($delete);
		$exe = $conn->execute();
		if($exe)
		{
			$message = "Sucess Delete Upk";
			$error = false;				
		}
		else
		{
			$message = "Gagal Delete Upk";
			$error = true;
			
		}
		
		$data['message'] = $message;
		$data['error'] = $error;

	}
	else if(isset($_GET['edit']))
	{
		
		$sql = "select * from master_upk where upk = '".$_GET['id']."'";
		$conn->query($sql);
		$data = $conn->resultone();
		
	}
	else if(isset($_GET['simpan']))
	{		
		
		if($_GET['status']=='edit')
		{
			$update = "UPDATE master_upk SET 
						title = '".$_GET['title']."',
						url = '".$_GET['url']."',
						parent_id = '".$_GET['parent_id']."',
						class_images = '".$_GET['class_icon']."',
						status = '".$_GET['active']."' 
					   WHERE upk = '".$_GET['id']."'";
			$conn->query($update);
			$exe = $conn->execute();
			if($exe)
			{
				$message = "Sucess Update Upk";
				$error = false;				
			}
			else
			{
				$message = "Gagal Update Upk";
				$error = true;
				
			}
		}
		else
		{
			
			$insert = "INSERT INTO Menu ( title, url, parent_id, class_images, status ) 
						VALUES ( '".$_GET['title']."', '".$_GET['url']."', '".$_GET['parent_id']."', '".$_GET['class_icon']."', '".$_GET['active']."' )";
			$conn->query($insert);
			$exe = $conn->execute();
			if($exe)
			{
				$message = "Sucess Insert Menu";
				$error = false;				
			}
			else
			{
				$message = "Gagal Insert Menu";
				$error = true;
				
			}			
		}
		
		$data['message'] = $message;
		$data['error'] = $error;
	}
	else if($_GET['select']=='class_icon')
	{

		$sql = "select * from icon";
		$conn->query($sql);
		$row = $conn->resultset();
		//$conn->debugDumpParams();
		foreach($row as $key => $value)
		{
	
			$data[$key]['id'] 		= $value['id_icon'];
			$data[$key]['nama'] 	= $value['nama_icon'];
			$data[$key]['class'] 	= $value['class'];
			$data[$key]['image'] 	= "<span class='".$value['class']."'>ss</span>";
		}
	
	}
	else if($_GET['select']=='parent_menu')
	{

		$sql = "select * from menu where status = 0";
		$conn->query($sql);
		$row = $conn->resultset();
		//$conn->debugDumpParams();
		foreach($row as $key => $value)
		{
	
			$data[$key]['id'] 		= $value['id'];
			$data[$key]['title'] 	= $value['title'];
		}
	}
	
echo json_encode($data);
?>