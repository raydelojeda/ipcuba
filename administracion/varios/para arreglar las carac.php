<?php   
$x="../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
$sql="select * from n_articulo";
//print $sql;
$rs = $db->Execute($sql)or die($db->ErrorMsg());
$cant_auxiliar=$rs->RecordCount(); 


for($i=0;$i<=$cant_auxiliar;$i++)
	{	
	$ide=$rs->Fields("id_articulo");
	$ecarac1=$rs->Fields("carac1");
	$ecarac2=$rs->Fields("carac2");
	$ecarac3=$rs->Fields("carac3");
	$ecarac4=$rs->Fields("carac4");
	$ecarac5=$rs->Fields("carac5");
	$ecarac6=$rs->Fields("carac6");
	$ecarac7=$rs->Fields("carac7");
	$ecarac8=$rs->Fields("carac8");
	$ecarac9=$rs->Fields("carac9");
	$ecarac10=$rs->Fields("carac10");
	if($ecarac1=="Cantidad" or $ecarac1=="Cantidad ")
	{
	$up1="Update n_articulo set 
	carac1='$ecarac2', carac2='$ecarac3',
	carac3='$ecarac4', carac4='$ecarac5',
	carac5='$ecarac6', carac6='$ecarac7',
	carac7='$ecarac8', carac8='$ecarac9',
	carac9='$ecarac10'
	where id_articulo='".$ide."'";
	//$db->Execute($up1)or die($db->ErrorMsg());
	
	$s="select * from n_variedad where id_articulo='".$ide."'";
	$r = $db->Execute($s)or die($db->ErrorMsg());
	$c=$r->RecordCount(); 
	
	
		for($g=0;$g<$c;$g++)
		{	$ide1=$r->Fields("id_articulo");
			$valor1=$r->Fields("valor1");$valor2=$r->Fields("valor2");
			$valor3=$r->Fields("valor3");$valor4=$r->Fields("valor4");
			$valor5=$r->Fields("valor5");$valor6=$r->Fields("valor6");
			$valor7=$r->Fields("valor7");$valor8=$r->Fields("valor8");
			$valor9=$r->Fields("valor9");$valor10=$r->Fields("valor10");
			$up2="Update n_variedad set 
			valor1='$valor2',valor2='$valor3',
			valor3='$valor4', valor4='$valor5',
			valor5='$valor6', valor6='$valor7',
			valor7='$valor8', valor8='$valor9',
			valor9='$valor10', valor10=''
			where id_articulo='".$ide1."'";print $up2;
			//$db->Execute($up2)or die($db->ErrorMsg());
			$r->MoveNext();
		}
	}
	elseif($ecarac2=="Cantidad" or $ecarac2=="Cantidad ")
	{
	$up1="Update n_articulo set 
	carac2='$ecarac3',
	carac3='$ecarac4', carac4='$ecarac5',
	carac5='$ecarac6', carac6='$ecarac7',
	carac7='$ecarac8', carac8='$ecarac9',
	carac9='$ecarac10', carac10=''
	where id_articulo='".$ide."'";
	$db->Execute($up1)or die($db->ErrorMsg());
	
	$s="select * from n_variedad where id_articulo='".$ide."'";
	//$r = $db->Execute($s)or die($db->ErrorMsg());
	$c=$r->RecordCount(); 
	
	
		for($g=0;$g<$c;$g++)
		{	$ide1=$r->Fields("id_articulo");
			$valor1=$r->Fields("valor1");$valor2=$r->Fields("valor2");
			$valor3=$r->Fields("valor3");$valor4=$r->Fields("valor4");
			$valor5=$r->Fields("valor5");$valor6=$r->Fields("valor6");
			$valor7=$r->Fields("valor7");$valor8=$r->Fields("valor8");
			$valor9=$r->Fields("valor9");$valor10=$r->Fields("valor10");
			$up2="Update n_variedad set 
			valor2='$valor3',
			valor3='$valor4', valor4='$valor5',
			valor5='$valor6', valor6='$valor7',
			valor7='$valor8', valor8='$valor9',
			valor9='$valor10', valor10=''
			where id_articulo='".$ide1."'";print $up2;
			//$db->Execute($up2)or die($db->ErrorMsg());
			$r->MoveNext();
		}
	
	}
	
	elseif($ecarac3=="Cantidad" or $ecarac3=="Cantidad ")
	{
	$up1="Update n_articulo set 
	
	carac3='$ecarac4', carac4='$ecarac5',
	carac5='$ecarac6', carac6='$ecarac7',
	carac7='$ecarac8', carac8='$ecarac9',
	carac9='$ecarac10', carac10=''
	where id_articulo='".$ide."'";
	$db->Execute($up1)or die($db->ErrorMsg());
	
	$s="select * from n_variedad where id_articulo='".$ide."'";
	//$r = $db->Execute($s)or die($db->ErrorMsg());
	$c=$r->RecordCount(); 
	
	
		for($g=0;$g<$c;$g++)
		{	$ide1=$r->Fields("id_articulo");
			$valor1=$r->Fields("valor1");$valor2=$r->Fields("valor2");
			$valor3=$r->Fields("valor3");$valor4=$r->Fields("valor4");
			$valor5=$r->Fields("valor5");$valor6=$r->Fields("valor6");
			$valor7=$r->Fields("valor7");$valor8=$r->Fields("valor8");
			$valor9=$r->Fields("valor9");$valor10=$r->Fields("valor10");
			$up2="Update n_variedad set 
			
			valor3='$valor4', valor4='$valor5',
			valor5='$valor6', valor6='$valor7',
			valor7='$valor8', valor8='$valor9',
			valor9='$valor10', valor10=''
			where id_articulo='".$ide1."'";print $up2;
			//$db->Execute($up2)or die($db->ErrorMsg());
			$r->MoveNext();
		}
	
	}
	
	elseif($ecarac4=="Cantidad" or $ecarac4=="Cantidad ")
	{
	$up1="Update n_articulo set 
	carac4='$ecarac5',
	carac5='$ecarac6', carac6='$ecarac7',
	carac7='$ecarac8', carac8='$ecarac9',
	carac9='$ecarac10', carac10=''
	where id_articulo='".$ide."'";
	//$db->Execute($up1)or die($db->ErrorMsg());
	
	$s="select * from n_variedad where id_articulo='".$ide."'";
	//$r = $db->Execute($s)or die($db->ErrorMsg());
	$c=$r->RecordCount(); 
	
	
		for($g=0;$g<$c;$g++)
		{	$ide1=$r->Fields("id_articulo");
			$valor1=$r->Fields("valor1");$valor2=$r->Fields("valor2");
			$valor3=$r->Fields("valor3");$valor4=$r->Fields("valor4");
			$valor5=$r->Fields("valor5");$valor6=$r->Fields("valor6");
			$valor7=$r->Fields("valor7");$valor8=$r->Fields("valor8");
			$valor9=$r->Fields("valor9");$valor10=$r->Fields("valor10");
			$up2="Update n_variedad set 
			valor4='$valor5',
			valor5='$valor6', valor6='$valor7',
			valor7='$valor8', valor8='$valor9',
			valor9='$valor10', valor10=''
			where id_articulo='".$ide1."'";print $up2;
			//$db->Execute($up2)or die($db->ErrorMsg());
			$r->MoveNext();
		}
	
	}
	
	
	$rs->MoveNext();
	}

?>


