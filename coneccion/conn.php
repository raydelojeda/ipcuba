<?php
     session_start();	
	$l="postgres";
	$p="1234567";
	$db = NewADOConnection('pgsql');
 	$db->Connect("localhost",$l,$p,"ipc") or die($db->ErrorMsg());
/*
   session_start();
	
	
	$l="postgres";
	$p="pgsql8.4";
	$db = NewADOConnection('pgsql');
 	$db->Connect("192.168.150.20",$l,$p,"ipc") or die($db->ErrorMsg());
		
	/*$l="postgres";
	$p="adminwork";
	$db = NewADOConnection('pgsql');
 	$db->Connect("192.168.150.20",$l,$p,"ipc") or die($db->ErrorMsg());*/
?>
