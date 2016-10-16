<?php 

	$conn = $one->conn;

	
	$filter="";
	$join="";
	$addselect="";
	
	if(isset($_SESSION['system']['id_role']))
	{
		if(!in_array($_SESSION['system']['id_role'],array(1,2)))
		{
			$filter .= " and b.id_role = '".$_SESSION['system']['id_role']."'";
			$join .= " Inner join menu_role b on a.id = b.id_menu";
			$addselect .= " , b.ubah, b.hapus, b.tambah, b.tampil ";
		}
	}
	
	
	function menu($conn, $join, $filter, $addselect)
	{				

		$menu = "SELECT a.title, a.url, a.class_images, a.id ".$addselect."
					FROM menu a ".$join." 
					WHERE a.status NOT IN ('1') and a.parent_id = 0 ".$filter." 
					ORDER BY a.parent_id,a.menu_order";
		$conn->query($menu);
		$row = $conn->resultset();
		$data = array();
		foreach($row as $key => $value)
		{
			$data[$key]['id'] = $value['id']; 
			$data[$key]['name'] = '<span class="sidebar-mini-hide">'.$value['title'].'</span>';
			$value['url'] ? $data[$key]['url'] = $value['url'].'?id_menu='.$value['id'] : $data[$key]['url'] = "";
			$value['class_images'] ? $data[$key]['icon'] = $value['class_images'] : $data[$key]['icon'] = "glyphicon glyphicon-menu-hamburger";
			
			if(isset($_SESSION['system']['id_role']))
			{			
				if(!in_array($_SESSION['system']['id_role'],array(1,2)))
				{
					$value['ubah'] ? $data[$key]['ubah'] = $value['ubah'] : $data[$key]['ubah'] = "";
					$value['hapus'] ? $data[$key]['hapus'] = $value['hapus'] : $data[$key]['hapus'] = "";
					$value['tambah'] ? $data[$key]['tambah'] = $value['tambah'] : $data[$key]['tambah'] = "";
					$value['tampil'] ? $data[$key]['tampil'] = $value['tampil'] : $data[$key]['tampil'] = "";
				}
				else
				{
					$data[$key]['ubah'] = "Y";
					$data[$key]['hapus'] = "Y";
					$data[$key]['tambah'] = "Y";
					$data[$key]['tampil'] = "Y";
				}
			}
			
			if(sub($conn, $value['id'],$join,$filter,$addselect))
			{				
				$data[$key]['sub'] = sub($conn, $value['id'],$join,$filter,$addselect);
			}
								
		}
		//echo "<pre>";
		//return $data;
		return $data;
	}
	
	
	function sub($conn, $parent_id,$join,$filter,$addselect)
	{
		
		$menu_sub="SELECT a.title, a.url, a.class_images, a.id ".$addselect."
					FROM `menu` a ".$join."  
					WHERE a.status NOT IN ('1') and a.parent_id = ".$parent_id." ".$filter." 
					ORDER BY a.parent_id,a.menu_order";
		$conn->query($menu_sub);
		$row_sub = $conn->resultset();
		$sub_menu = array();
		foreach($row_sub as $key_sub => $value_sub)
		{
			$sub_menu[$key_sub]['id'] = $value_sub['id'];
			$sub_menu[$key_sub]['name'] = $value_sub['title'];
			$value_sub['url'] ? $sub_menu[$key_sub]['url'] = $value_sub['url'].'?id_menu='.$value_sub['id'] : $sub_menu[$key_sub]['url'] = "";
			$value_sub['class_images'] ? $sub_menu[$key_sub]['icon'] = $value_sub['class_images'] : $sub_menu[$key_sub]['icon'] = "glyphicon glyphicon-menu-hamburger";
			
			if(isset($_SESSION['system']['id_role']))
			{
				if(!in_array($_SESSION['system']['id_role'],array(1,2)))
				{
					$value_sub['ubah'] ? $sub_menu[$key_sub]['ubah'] = $value_sub['ubah'] : $sub_menu[$key_sub]['ubah'] = "";
					$value_sub['hapus'] ? $sub_menu[$key_sub]['hapus'] = $value_sub['hapus'] : $sub_menu[$key_sub]['hapus'] = "";
					$value_sub['tambah'] ? $sub_menu[$key_sub]['tambah'] = $value_sub['tambah'] : $sub_menu[$key_sub]['tambah'] = "";
					$value_sub['tampil'] ? $sub_menu[$key_sub]['tampil'] = $value_sub['tampil'] : $sub_menu[$key_sub]['tampil'] = "";
				}
				else
				{
					$sub_menu[$key_sub]['ubah'] = "Y";
					$sub_menu[$key_sub]['hapus'] = "Y";
					$sub_menu[$key_sub]['tambah'] = "Y";
					$sub_menu[$key_sub]['tampil'] = "Y";
				}
			}
			
			
			if(sub($conn,$value_sub['id'],$join,$filter,$addselect))
			{				
				$sub_menu[$key_sub]['sub'] = sub($conn,$value_sub['id'],$join,$filter,$addselect);
			}

		}
		return $sub_menu;
	}
		
	
	/*function menu ($conn, $join, $filter)
	{
		$menu = "SELECT a.* FROM menu a ".$join." WHERE a.status NOT IN ('1') and a.parent_id = 0 ".$filter." ORDER BY a.parent_id,a.menu_order";
		$result = $conn->getAll($menu);
		$data = array();
		$no=0;
		while ($row = mysql_fetch_object($result)) 
		{
			$data[$no]['name'] = '<span class="sidebar-mini-hide">'.$row->title.'</span>';
			$row->url ? $data[$no]['url'] = $row->url: "";
			$row->class_images ? $data[$no]['icon'] = $row->class_images : $data[$no]['icon'] = "glyphicon glyphicon-menu-hamburger";
		
			if(sub($conn, $row->id,$join,$filter))
			{			
				$data[$no]['sub'] = sub($conn, $row->id,$join,$filter);
			}
			$no++;
			//print_r($data);
		}
		return $data;
	}
	
	
	function sub($conn, $parent_id,$join,$filter)
	{
		$menu_sub="SELECT a.* FROM `menu` a ".$join."  WHERE a.status NOT IN ('1') and a.parent_id = ".$parent_id." ".$filter." ORDER BY a.parent_id,a.menu_order";

		$result_sub = $conn->mysql_query($menu_sub);
		$sub_menu = array();
		$no_sub=0; 
		while ($row_sub = mysql_fetch_object($result_sub)) 
		{
			$sub_menu[$no_sub]['name'] = $row_sub->title;
			$row_sub->url ? $sub_menu[$no_sub]['url'] = $row_sub->url : "";
			$row_sub->class_images ? $sub_menu[$no_sub]['icon'] = $row_sub->class_images : $sub_menu[$no_sub]['icon'] = "glyphicon glyphicon-menu-hamburger";
			
			if(sub($conn, $row_sub->id))
			{				
				$sub_menu[$no_sub]['sub'] = sub($conn, $row_sub->id);
			}
			$no_sub++;
		}
		
		return $sub_menu;
		
	}*/
	

	$menu_nav = menu($conn, $join, $filter, $addselect);
	//print_r($data);
	return $menu_nav;
		
?>