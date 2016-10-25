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

		$sql = "select a.* , b.nama_toko
				from transaksi_2 a
				left join toko b on a.toko_id = b.toko_id
				where a.username = '".$_SESSION['system']['username']."' or 'superuser' = '".$_SESSION['system']['username']."'";
		$conn->query($sql);
		$row = $conn->resultset();
		//$conn->debugDumpParams();
		foreach($row as $key => $value)
		{
			
			if($_SESSION['menu'][$_GET['id_menu']]['ubah']=='Y' && in_array($value['status_trx'],array('process'))){ $disable_ubah = '';}else{ $disable_ubah = 'disabled';}
			if($_SESSION['menu'][$_GET['id_menu']]['hapus']=='Y' && in_array($value['status_trx'],array('process'))){ $disable_hapus = '';}else{ $disable_hapus = 'disabled';}
 	
			
			$data[$key]['no'] 			= $key+1;
			$data[$key]['transaksi_id'] = $value['transaksi_id'];
			$data[$key]['tgl_trx'] 		= $value['tgl_trx'];
			$data[$key]['inv_trx'] 		= $value['inv_trx'];
			$data[$key]['nama'] 		= $value['nama'];
			$data[$key]['alamat'] 		= $value['alamat'];
			$data[$key]['no_hp'] 		= $value['no_hp'];
			$data[$key]['no_resi'] 		= $value['no_resi'];
			$data[$key]['status_trx'] 	= ($value['status_trx']=='success' ? "<span class=\"label label-success\">Success</span>":
										  ($value['status_trx']=='refund' ? "<span class=\"label label-warning\">Refund</span>":
										  ($value['status_trx']=='cancel' ? "<span class=\"label label-danger\">Cancel</span>":
										  "<span class=\"label label-info\">On Process</span>")));
			$data[$key]['action'] 		= "<button ".$disable_ubah." class = \"btn btn-sm btn-success\" onClick=\"action('edit','btn-edit','".$value['transaksi_id']."');\"> Edit </button> 
										   <button ".$disable_hapus." class = \"btn btn-sm btn-danger\" onClick=\"action('delete','delete','".$value['transaksi_id']."');\"> Delete </button>
										   ";
		}
	
	}
	else if(isset($_GET['delete']))
	{
		
		$delete = "delete from transaksi_2 where transaksi_id = '".$_GET['transaksi_id']."'";
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
		
		$sql = "select * from transaksi_2 where transaksi_id = '".$_GET['transaksi_id']."'";
		$conn->query($sql);
		$data = $conn->resultone();
		
	}
	else if(isset($_GET['simpan']))
	{
		
		if($_GET['status']=='edit')
		{
			$update = "UPDATE transaksi_2 SET 
										tgl_trx = '".$_GET['tgl_trx']."', 
										toko_id = '".$_GET['toko_id']."', 
										inv_trx = '".$_GET['inv_trx']."', 
										nama = '".$_GET['nama']."', 
										alamat = '".$_GET['alamat']."', 
										no_hp = '".$_GET['no_hp']."', 
										no_resi  = '".$_GET['no_resi']."', 
										status_trx  = '".$_GET['status_trx']."', 
										product  = '".$_GET['product']."', 
										supplier  = '".$_GET['supplier']."', 
										harga_supplier  = '".$_GET['harga_supplier']."', 
										harga_jual  = '".$_GET['harga_jual']."', 
										qty  = '".$_GET['qty']."', 
										harga_refund  = '".$_GET['harga_refund']."'
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
			$sql = "select max(transaksi_id) as maxno from transaksi_2 where transaksi_id like '".$prefix."%'";
			$conn->query($sql);
			$getmax = $conn->resultone();			
			
			if($getmax) 
			{
				if($getmax['maxno']){ $maxid = intval(substr($getmax['maxno'],-3))+1;}else{$maxid = 1;}				
				$transaksi_id = $prefix.str_pad($maxid, 3,"0",STR_PAD_LEFT);
			}
			
			
			$insert = "INSERT INTO transaksi_2 ( transaksi_id, tgl_trx, toko_id, inv_trx, nama, alamat, no_hp, no_resi, status_trx ,username, product, supplier, harga_supplier, harga_jual, qty, harga_refund)"; 
			$insert .= "VALUES ( '".$transaksi_id."', '".$_GET['tgl_trx']."', '".$_GET['toko_id']."', '".$_GET['inv_trx']."', '".$_GET['nama']."', '".$_GET['alamat']."', '".$_GET['no_hp']."', '".$_GET['no_resi']."', '".$_GET['status_trx']."', '".$_SESSION['system']['username']."', '".$_GET['product']."', '".$_GET['supplier']."', '".$_GET['harga_supplier']."', '".$_GET['harga_jual']."', '".$_GET['qty']."', '".$_GET['harga_refund']."' )";
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
	}
	else if(isset($_GET['toko']))
	{
		$sql = "select * from toko where isactive = 'Y' and (username = '".$_SESSION['system']['username']."' or 'superuser' = '".$_SESSION['system']['username']."')";
		$conn->query($sql);
		$row = $conn->resultset();
		$count = $conn->rowCount();
		
		//$data['total_count'] = $count;
		foreach($row as $key => $value)
		{
			/*$data['items']['id'] = $value['toko_id'];
			$data['items']['name'] = $value['nama_toko'];
			$data['items']['full_name'] = $value['nama_toko'];*/
			$data[$key]['id'] = $value['toko_id'];
			$data[$key]['name'] = $value['nama_toko'];/**/
		}

	}
	
echo json_encode($data);
?>