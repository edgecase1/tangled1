<?php

if(isset($_GET['form']))
{
	$key = $_GET['form'];
	echo $_POST[$key];
} else {
	echo file_get_contents('php://input');
}
