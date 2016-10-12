<?php

$init_dadu = array();
$player = array('A','B','C','D');
$isi_dadu = range(1, 6);//range(2, 7);

//echo $isi_dadu[array_rand($isi_dadu)];die;

for($i= 0; $i<count($player);$i++)
{	
	$array_play = array();
	$data = 'Player '.$player[$i]. ' = ';
	for($a=0;$a<6;$a++)
	{
		$array_play[] = $isi_dadu[array_rand($isi_dadu)];
	}
	echo $data.implode(",",$array_play).'<br>';
}


//.= $isi_dadu[array_rand($isi_dadu)].'<br>'
?>