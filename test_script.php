<?php

$_POST['count_play'] = isset($_POST['count_play']) ? $_POST['count_play'] : 0;
$temp_arr = array();
$init_dadu = array();
$pemain = array();
$player = array('A','B','C','D');
$isi_dadu = range(1, 6);//range(2, 7);
$init_dadu = array(6);
$hasil = "";
//print_r($_POST);
if(isset($_POST['play']))
{
	$_POST['count_play']++;
	
	//echo $isi_dadu[array_rand($isi_dadu)];die;
	//$temp_arr = array();
	$i = 0;
	foreach($player as $i => $pemain)
	{	
		$array_play[$i] = array();
		$data = 'Player '.$player[$i]. ' = ';
		for($a=0;$a<$init_dadu[0];$a++)
		{
			$array_play[$i][] = $isi_dadu[array_rand($isi_dadu)];
		}
		
		$temp_arr[$_POST['count_play']][] = $data.implode(",",$array_play[$i]);
		if(end($array_play)==1)
		{ 
			array_push($array_play[$i+1],1); 
		}
			 $hasil .= $data.implode(",",$array_play[$i]).'<br>';
			 //array_push($temp_arr[$_POST['count_play']],$temp_arr[$_POST['count_play']]);
	}
	
}



//.= $isi_dadu[array_rand($isi_dadu)].'<br>'
?>


<form role="form" action="<?php echo $_SERVER['PHP_SELF'];?>" class="form-horizontal" method="POST">
	<input type="submit" name="play" value="Play"/>
    <input type="submit" name="check" value="check"/>
    <input type="text" name="count_play" value="<?php echo $_POST['count_play'];?>">
</form>
<?php
echo $hasil;
echo "<pre>";
print_r($temp_arr);
?>