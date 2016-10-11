<?php require '../../inc/config.php'; 
/*if (!isset($_SESSION)) {
    session_start();
}*/

	$conn = $one->conn;
	$message = "";
	$error = false;
	$data = array();


	/*if(isset($_GET['grid_table']))
	{

		$sql = "select * from toko where username = '".$_SESSION['system']['username']."' or 'superuser' = '".$_SESSION['system']['username']."'";
		$conn->query($sql);
		$row = $conn->resultset();
		//$conn->debugDumpParams();
		foreach($row as $key => $value)
		{
			
			if($_SESSION['menu'][$_GET['id_menu']]['ubah']=='Y'){ $disable_ubah = '';}else{ $disable_ubah = 'disabled';}
			if($_SESSION['menu'][$_GET['id_menu']]['hapus']=='Y'){ $disable_hapus = '';}else{ $disable_hapus = 'disabled';}
 	
			
			$data[$key]['no'] 			= $key+1;
			$data[$key]['toko_id'] 		= $value['toko_id'];
			$data[$key]['nama_toko'] 	= $value['nama_toko'];
			$data[$key]['isactive'] 	= $value['isactive']=='Y' ? "<span class=\"label label-success\">Active</span>" : "<span class=\"label label-danger\">Not Active</span>";
			$data[$key]['action'] 		= "<button ".$disable_ubah." class = \"btn btn-sm btn-success\" onClick=\"action('edit','btn-edit','".$value['toko_id']."');\"> Edit </button> 
										   <button ".$disable_hapus." class = \"btn btn-sm btn-danger\" onClick=\"action('delete','delete','".$value['toko_id']."');\"> Delete </button>
										   ";
		}
	
	}
	else if(isset($_GET['delete']))
	{
		
		$delete = "delete from toko where toko_id = '".$_GET['toko_id']."'";
		$conn->query($delete);
		$exe = $conn->execute();
		if($exe)
		{
			$message = "Sucess Delete Toko";
			$error = false;				
		}
		else
		{
			$message = "Gagal Delete Toko";
			$error = true;
			
		}
		
		$data['message'] = $message;
		$data['error'] = $error;

	}
	else if(isset($_GET['edit']))
	{
		
		$sql = "select * from toko where toko_id = '".$_GET['toko_id']."'";
		$conn->query($sql);
		$data = $conn->resultone();
		
	}
	else if(isset($_GET['simpan']))
	{
		
		if($_GET['status']=='edit')
		{
			$update = "UPDATE toko SET nama_toko = '".$_GET['nama_toko']."', 
										isactive = '".$_GET['isactive']."' 
						WHERE toko_id = '".$_GET['toko_id']."'";
			$conn->query($update);
			$exe = $conn->execute();
			if($exe)
			{
				$message = "Sucess Update Toko";
				$error = false;				
			}
			else
			{
				$message = "Gagal Update Toko";
				$error = true;
				
			}
		}
		else
		{
			
			$prefix = 'TKO'; 
			$sql = "select max(toko_id) as maxno from toko where toko_id like '".$prefix."%'";
			$conn->query($sql);
			$getmax = $conn->resultone();			
			
			if($getmax) 
			{
				if($getmax['maxno']){ $maxid = intval(substr($getmax['maxno'],-3))+1;}else{$maxid = 1;}				
				$toko_id = $prefix.str_pad($maxid, 3,"0",STR_PAD_LEFT);
			}
			
			
			$insert = "INSERT INTO toko ( toko_id, nama_toko ,username) VALUES ( '".$toko_id."', '".$_GET['nama_toko']."', '".$_SESSION['system']['username']."' )";
			$conn->query($insert);
			$exe = $conn->execute();
			if($exe)
			{
				$message = "Sucess Insert Toko";
				$error = false;				
			}
			else
			{
				$message = "Gagal Insert Toko";
				$error = true;
				
			}			
		}
		
		$data['message'] = $message;
		$data['error'] = $error;
	}*/
	
	//$data = $_POST;
	
	$data['product'] = array();
	$data['product'] = $_POST['product'];
	
echo json_encode($data);
?>