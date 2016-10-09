<?php		
if (!isset($_SESSION)) {
    session_start();
}

//print_r($_SESSION);

	

if(isset($_SESSION['system']['loggedin'])!='ok')
{
	include_once "base_pages_login.php";
	
}
else if($_SESSION['system']['lock']=='ok')
{
	include_once "base_pages_lock.php";
}
else 
{
	include_once "pages.php";
}
	

?>
