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
	else*/ if(isset($_GET['delete']))
	{
		
		$delete = "delete from transaksi where transaksi_id = '".$_GET['transaksi_id']."'";
		$conn->query($delete);
		$exe = $conn->execute();
		if($exe)
		{
			$message = "Sucess Delete Transaksi";
			$error = false;				
		}
		else
		{
			$message = "Gagal Delete Transaksi";
			$error = true;
			
		}
		
		$data['message'] = $message;
		$data['error'] = $error;

	}
	else if(isset($_GET['edit']))
	{
		
		$sql = "select * from transaksi where transaksi_id = '".$_GET['transaksi_id']."'";
		$conn->query($sql);
		$data = $conn->resultone();
		
	}
	else if(isset($_GET['simpan']))
	{
		
		if($_GET['status']=='edit')
		{
			$update = "UPDATE transaksi SET 
										tgl_trx = '".$_GET['tgl_trx']."', 
										toko_id = '".$_GET['toko_id']."', 
										inv_trx = '".$_GET['inv_trx']."', 
										nama = '".$_GET['nama']."', 
										alamat = '".$_GET['alamat']."', 
										no_hp = '".$_GET['no_hp']."', 
										no_resi  = '".$_GET['no_resi']."'
						WHERE transaksi_id = '".$_GET['transaksi_id']."'";
			$conn->query($update);
			$exe = $conn->execute();
			if($exe)
			{
				$message = "Sucess Update Transaksi";
				$error = false;				
			}
			else
			{
				$message = "Gagal Update Transaksi";
				$error = true;
				
			}
		}
		else
		{
			
			$prefix = 'TRX'; 
			$sql = "select max(transaksi_id) as maxno from transaksi where transaksi_id like '".$prefix."%'";
			$conn->query($sql);
			$getmax = $conn->resultone();			
			
			if($getmax) 
			{
				if($getmax['maxno']){ $maxid = intval(substr($getmax['maxno'],-3))+1;}else{$maxid = 1;}				
				$transaksi_id = $prefix.str_pad($maxid, 3,"0",STR_PAD_LEFT);
			}
			
			
			$insert = "INSERT INTO transaksi ( transaksi_id, tgl_trx, toko_id, inv_trx, nama, alamat, no_hp, no_resi ,username) VALUES ( '".$transaksi_id."', '".$_GET['tgl_trx']."', '".$_GET['toko_id']."', '".$_GET['inv_trx']."', '".$_GET['nama']."', '".$_GET['alamat']."', '".$_GET['no_hp']."', '".$_GET['no_resi']."', '".$_SESSION['system']['username']."' )";
			$conn->query($insert);
			$exe = $conn->execute();
			if($exe)
			{
				$message = "Sucess Insert Transaksi";
				$error = false;				
			}
			else
			{
				$message = "Gagal Insert Transaksi";
				$error = true;
				
			}			
		}
		
		$data['message'] = $message;
		$data['error'] = $error;
		$data['transaksi_id'] = $transaksi_id;
	}
	else if(isset($_GET['simpan_list']))
 	{
	 	if($_GET['status_list']=='edit')
		{
			
		}
		else
		{
			for($i=0;$i<=count($_POST['product']);$i++)
			{
				
				$insert = "INSERT INTO transaksi_detail ( transaksi_id, transaksi_detail_id, product, supplier, harga_supplier, harga_jual, qty, refund) VALUES 
														( '".$transaksi_id."', '".$_GET['tgl_trx']."', '".$_GET['toko_id']."', '".$_GET['inv_trx']."', '".$_GET['nama']."', '".$_GET['alamat']."', '".$_GET['no_hp']."', '".$_GET['no_resi']."', '".$_SESSION['system']['username']."' )";
				$conn->query($insert);
				$exe = $conn->execute();
				if($exe)
				{
					$message = "Sucess Insert Transaksi";
					$error = false;				
				}
				else
				{
					$message = "Gagal Insert Transaksi";
					$error = true;
					
				}
			}
		}
	 
 	}
	
echo json_encode($data);
?>