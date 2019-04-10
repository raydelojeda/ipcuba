<?php
     session_start();	
	$l="";
	$p="";
	$db = NewADOConnection('pgsql');
 	$db->Connect("localhost",$l,$p,"ipc") or die($db->ErrorMsg());
?>
