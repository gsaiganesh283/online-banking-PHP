<?php
function check_login()
{
if(strlen($_SESSION['account_id'])==0)
	{
		$host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra="pages_user_index.php";
		$_SESSION["account_id"]="";
		header("Location: http://$host$uri/$extra");
	}
}
