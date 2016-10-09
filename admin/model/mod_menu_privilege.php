<?php require '../../inc/config.php'; 

	$conn = $one->conn;
	$message = "";
	$error = false;
	$data = array();

	if(isset($_GET['grid_table']))
	{

		$sql = "select a.id_role, a.id_menu, b.role , c.title as menu , a.tambah, a.ubah, a.hapus, a.tampil 
				from menu_role a
				inner join role b on a.id_role = b.id_role
				inner join menu c on a.id_menu = c.id
				where b.id_role <> 1
				order by b.id_role, c.id asc";
		$conn->query($sql);
		$row = $conn->resultset();
		//$conn->debugDumpParams();
		$arrID = array();
		foreach($row as $key => $value)
		{
			if($_SESSION['menu'][$_GET['id_menu']]['ubah']=='Y'){ $disable_ubah = '';}else{ $disable_ubah = 'disabled';}
			if($_SESSION['menu'][$_GET['id_menu']]['hapus']=='Y'){ $disable_hapus = '';}else{ $disable_hapus = 'disabled';}
			
			$data[$key]['no'] 		= $key+1;
			$data[$key]['role'] 	= $value['role'];
			$data[$key]['menu'] 	= $value['menu'];
			$data[$key]['tampil'] 	= $value['tampil']=='Y' ? "<span class=\"label label-success\">Yes</span>" : "<span class=\"label label-danger\">No</span>";
			$data[$key]['tambah'] 	= $value['tambah']=='Y' ? "<span class=\"label label-success\">Yes</span>" : "<span class=\"label label-danger\">No</span>";
			$data[$key]['ubah'] 	= $value['ubah']=='Y' ? "<span class=\"label label-success\">Yes</span>" : "<span class=\"label label-danger\">No</span>";
			$data[$key]['hapus'] 	= $value['hapus']=='Y' ? "<span class=\"label label-success\">Yes</span>" : "<span class=\"label label-danger\">No</span>";			
			$data[$key]['action'] 	= "<button ".$disable_ubah." class = \"btn btn-sm btn-success\" onClick=\"action('edit','edit','".$value['id_role']."','".$value['id_menu']."');\"> Edit </button> 
									   <button ".$disable_hapus." class = \"btn btn-sm btn-danger\" onClick=\"action('delete','delete','".$value['id_role']."','".$value['id_menu']."');\"> Delete </button>";
		}
		
	
	}
	else if(isset($_GET['delete']))
	{
		
		$delete = "delete from menu_role where id_role = '".$_GET['id_role']."' and id_menu = '".$_GET['id_menu']."'";
		$conn->query($delete);
		$exe = $conn->execute();
		if($exe)
		{
			$message = "Sucess Delete Menu Privilege";
			$error = false;				
		}
		else
		{
			$message = "Gagal Delete Menu Privilege";
			$error = true;
			
		}
		
		$data['message'] = $message;
		$data['error'] = $error;

	}
	else if(isset($_GET['edit']))
	{
		
		$sql = "select * from menu_role where id_role = '".$_GET['id_role']."' and id_menu = '".$_GET['id_menu']."'";
		$conn->query($sql);
		$data = $conn->resultone();
		
	}
	else if(isset($_GET['simpan']))
	{		
		
		if($_GET['status']=='edit')
		{
			$update = "UPDATE menu_role SET 
						tambah = '".$_GET['tambah']."',
						ubah = '".$_GET['ubah']."',
						hapus = '".$_GET['hapus']."',
						tampil = '".$_GET['tampil']."'
					   WHERE id_role = '".$_GET['id_role']."' AND  id_menu = '".$_GET['id_menu']."' ";
			$conn->query($update);
			$exe = $conn->execute();
			if($exe)
			{
				$message = "Sucess Update Menu Privilege";
				$error = false;				
			}
			else
			{
				$message = "Gagal Update Menu Privilege";
				$error = true;
				
			}
		}
		else
		{
			
			$insert = "INSERT INTO menu_role ( id_role, id_menu, tambah, ubah, hapus, tampil ) 
						VALUES ( '".$_GET['id_role']."', '".$_GET['id_menu']."', '".$_GET['tambah']."', '".$_GET['ubah']."', '".$_GET['hapus']."', '".$_GET['tampil']."' )";
			$conn->query($insert);
			$exe = $conn->execute();
			if($exe)
			{
				$message = "Sucess Insert Menu Privilege";
				$error = false;				
			}
			else
			{
				$message = "Gagal Insert Menu Privilege";
				$error = true;
				
			}			
		}
		
		$data['message'] = $message;
		$data['error'] = $error;
	}
	else if($_GET['select']=='role')
	{

		$sql = "select * from role";
		$conn->query($sql);
		$row = $conn->resultset();
		//$conn->debugDumpParams();
		foreach($row as $key => $value)
		{
	
			$data[$key]['id_role'] 	= $value['id_role'];
			$data[$key]['role'] 	= $value['role'];
		}
	
	}
	else if($_GET['select']=='menu')
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