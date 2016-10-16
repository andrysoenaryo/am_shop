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
				from transaksi a
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
										no_resi  = '".$_GET['no_resi']."', 
										status_trx  = '".$_GET['status_trx']."'
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
			
			
			$insert = "INSERT INTO transaksi ( transaksi_id, tgl_trx, toko_id, inv_trx, nama, alamat, no_hp, no_resi, status_trx ,username) VALUES ( '".$transaksi_id."', '".$_GET['tgl_trx']."', '".$_GET['toko_id']."', '".$_GET['inv_trx']."', '".$_GET['nama']."', '".$_GET['alamat']."', '".$_GET['no_hp']."', '".$_GET['no_resi']."', '".$_GET['status_trx']."', '".$_SESSION['system']['username']."' )";
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
	else if(isset($_POST['simpan_list']))
 	{
		if($_POST['status_list']=='delete')
		{
			$delete = "delete from transaksi_detail where transaksi_detail_id = '".$_POST['transaksi_detail_id']."'";
			$conn->query($delete);
			$exe = $conn->execute();
			if($exe)
			{
				$message = "Sucess Delete Transaksi Detail";
				$error = false;				
			}
			else
			{
				$message = "Gagal Delete Transaksi Detail";
				$error = true;
				
			}
			
		}
		else
		{
			$delete = "delete from transaksi_detail where transaksi_id = '".$_POST['transaksi_id']."'";
			$conn->query($delete);
			$exe_delete = $conn->execute();
			if($exe_delete )
			{
				for($i=0;$i<count($_POST['product']);$i++)
				{
				
					$insert = "INSERT INTO transaksi_detail ( transaksi_id, product, supplier, harga_supplier, harga_jual, qty, harga_refund) VALUES 
															( '".$_POST['transaksi_id']."', '".$_POST['product'][$i]."', '".$_POST['supplier'][$i]."', '".$_POST['hrg_supplier'][$i]."', '".$_POST['hrg_jual'][$i]."', '".$_POST['qty'][$i]."', '".$_POST['refund'][$i]."' )";
					$conn->query($insert);
					$exe = $conn->execute();
					if($exe)
					{
						$message = "Sucess Insert / Edit Transaksi Detail";
						$error = false;				
					}
					else
					{
						$message = "Gagal Insert / Edit Transaksi Detail";
						$error = true;
						
					}
				}
			}
			else
			{
				$message = "Gagal Insert / Edit Transaksi Detail";
				$error = true;
			}
		}
		
		$data['message'] = $message;
		$data['error'] = $error;
	 
 	}
	else if(isset($_POST['grid_table_list']))
	{
		
		$sql = "SELECT * FROM TRANSAKSI_DETAIL WHERE TRANSAKSI_ID = '".$_POST['transaksi_id']."'";
		$conn->query($sql);
		$row = $conn->resultset();
		//$conn->debugDumpParams();
		$no = 0;
		foreach($row as $key => $value)
		{
			$no++;
			$transaksi_detail_id				= $value['transaksi_detail_id'];
			$data['transaksi_detail_id'][$key] 	= $value['transaksi_detail_id'];
			$data['product'][$key] 				= $value['product'];
			$data['supplier'][$key] 			= $value['supplier'];
			$data['harga_supplier'][$key] 		= $value['harga_supplier'];
			$data['harga_jual'][$key] 			= $value['harga_jual'];
			$data['qty'][$key] 					= $value['qty'];
			$data['harga_refund'][$key] 		= $value['harga_refund'];
			
			$data['form'][$key] = '<tr class="list_exist">
								<td class="text-center">'.$no.'</td>
								<td class="text-left"><div class="form-material form-material-info "><input class="form-control input-sm" type="text" id="product['.($no-1).']" name="product[]" value="'.$value['product'].'" ></div></td>
								<td class="text-left"><div class="form-material form-material-info "><input class="form-control input-sm" type="text" id="supplier['.($no-1).']" name="supplier[]" value="'.$value['supplier'].'" ></div></td>
								<td class="text-right"><div class="form-material form-material-info "><input class="form-control input-sm" type="text" id="hrg_supplier['.($no-1).']" name="hrg_supplier[]" value="'.$value['harga_supplier'].'" ></div></td>
								<td class="text-right"><div class="form-material form-material-info "><input class="form-control input-sm" type="text" id="hrg_jual['.($no-1).']" name="hrg_jual[]" value="'.$value['harga_jual'].'" ></div></td>
								<td class="text-right"><div class="form-material form-material-info "><input class="form-control input-sm" type="text" id="qty['.($no-1).']" name="qty[]" value="'.$value['qty'].'" ></div></td>
								<td class="text-right"><div class="form-material form-material-info "><input class="form-control input-sm" type="text" id="refund['.($no-1).']" name="refund[]" value="'.$value['harga_refund'].'" ></div></td>
								<td class="hidden-xs">
									<div class="btn-group" align="center">
										<button class="btn btn-sm btn-danger" type="button" data-toggle="tooltip" title="Remove Client" onClick="action_list(\'delete\',\'delete\','.$transaksi_detail_id.');"><i class="fa fa-trash-o"></i></button>
									</div>
								</td>
							</tr>';

		}
		
	}
	
echo json_encode($data);
?>