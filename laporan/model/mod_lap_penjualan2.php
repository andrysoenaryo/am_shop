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
		$where = "";
		if($_GET['tgl_from'] && $_GET['tgl_to']!='xxx') { $where .= " AND a.tgl_trx between '".$_GET['tgl_from']."' and '".$_GET['tgl_to']."'";}
		if($_GET['tgl_from'] && $_GET['tgl_to']=='xxx') { $where .= " AND a.tgl_trx = '".$_GET['tgl_from']."'";}
		if($_GET['status_trx']!='xxx') { $where .= " AND a.status_trx = '".$_GET['status_trx']."'";}
		
		$sql = "select a.tgl_trx, a.inv_trx, a.nama, a.alamat, a.no_hp, a.no_resi, a.status_trx , 
						a.product, a.supplier, a.harga_supplier,a.harga_jual,a.qty,a.harga_refund,
						((a.harga_jual*a.qty)-a.harga_refund) as total_harga
				from transaksi_2 a
				where 1=1 AND (a.username = '".$_SESSION['system']['username']."' or 'superuser' = '".$_SESSION['system']['username']."') $where ";
		$conn->query($sql);
		$row = $conn->resultset();
		//$conn->debugDumpParams();
		foreach($row as $key => $value)
		{
			
			if($_SESSION['menu'][$_GET['id_menu']]['ubah']=='Y' && in_array($value['status_trx'],array('process'))){ $disable_ubah = '';}else{ $disable_ubah = 'disabled';}
			if($_SESSION['menu'][$_GET['id_menu']]['hapus']=='Y' && in_array($value['status_trx'],array('process'))){ $disable_hapus = '';}else{ $disable_hapus = 'disabled';}
 	
			
			$data[$key]['no'] 				= $key+1;
			$data[$key]['tgl_trx'] 			= $value['tgl_trx'];
			$data[$key]['inv_trx'] 			= $value['inv_trx'];
			$data[$key]['nama'] 			= $value['nama'];
			$data[$key]['alamat'] 			= $value['alamat'];
			$data[$key]['no_hp'] 			= $value['no_hp'];
			$data[$key]['no_resi'] 			= $value['no_resi'];
			$data[$key]['status_trx'] 		= $value['status_trx'];
			$data[$key]['product'] 			= $value['product'];
			$data[$key]['supplier'] 		= $value['supplier'];
			$data[$key]['harga_supplier'] 	= $value['harga_supplier'];
			$data[$key]['harga_jual'] 		= $value['harga_jual'];
			$data[$key]['qty'] 				= $value['qty'];
			$data[$key]['harga_refund'] 	= $value['harga_refund'];
			$data[$key]['total_harga'] 		= $value['total_harga'];
		}
	
	}
	
	
echo json_encode($data);
?>