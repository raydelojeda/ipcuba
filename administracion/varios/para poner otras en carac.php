<?php   
$x="../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
$sql="select * from n_variedad";
//print $sql;
$rs = $db->Execute($sql)or die($db->ErrorMsg());
$cant_auxiliar=$rs->RecordCount(); 


for($i=0;$i<=$cant_auxiliar;$i++)
	{	
	$ide=$rs->Fields("id_variedad");
	$ecarac1=$rs->Fields("carac1");
	$ecarac2=$rs->Fields("carac2");
	$ecarac3=$rs->Fields("carac3");
	$ecarac4=$rs->Fields("carac4");
	$ecarac5=$rs->Fields("carac5");
	$ecarac6=$rs->Fields("carac6");
	
	if($ecarac1=="" && $ecarac2=="")
	{
	$up1="Update n_variedad set 
	carac1='Características'
	where id_variedad='".$ide."'";//print $up1;
	$db->Execute($up1)or die($db->ErrorMsg());
	}
	elseif($ecarac2=="" && $ecarac3=="" && $ecarac1!="Características" && $ecarac1!="Característica" && $ecarac1!="")
	{
	$up1="Update n_variedad set 
	carac2='Otras'
	where id_variedad='".$ide."'";//print $up1;
	$db->Execute($up1)or die($db->ErrorMsg());
	}
	elseif($ecarac3=="" && $ecarac4=="" && $ecarac2!="Otras" && $ecarac2!="Otra" && $ecarac2!="")
	{
	$up1="Update n_variedad set 
	carac3='Otras'
	where id_variedad='".$ide."'";//print $up1;
	$db->Execute($up1)or die($db->ErrorMsg());
	}
	elseif($ecarac4=="" && $ecarac5=="" && $ecarac3!="Otras" && $ecarac3!="Otra" && $ecarac3!="")
	{
	$up1="Update n_variedad set 
	carac4='Otras'
	where id_variedad='".$ide."'";//print $up1;
	$db->Execute($up1)or die($db->ErrorMsg());
	}
	elseif($ecarac5=="" && $ecarac6=="" && $ecarac4!="Otras" && $ecarac4!="Otra" && $ecarac4!="")
	{
	$up1="Update n_variedad set 
	carac5='Otras' 
	where id_variedad='".$ide."'";//print $up1;
	$db->Execute($up1)or die($db->ErrorMsg());
	}
	elseif($ecarac6=="" && $ecarac5!="Otras" && $ecarac5!="Otra" && $ecarac5!="")
	{
	$up1="Update n_variedad set 
	carac6='Otras'
	where id_variedad='".$ide."'";//print $up1;
	$db->Execute($up1)or die($db->ErrorMsg());
	}
	
	
	$rs->MoveNext();
	}

?>


