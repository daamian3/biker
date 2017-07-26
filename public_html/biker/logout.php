<?
	session_start();
	session_destroy();

	require "db_functions.php";

	header($index);
	exit();
?>
