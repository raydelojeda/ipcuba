<?php   
$x="../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
$auxiliar="select *from auxiliar2 where tarima='5' ";
//print $auxiliar; 
$rs_auxiliar = $db->Execute($auxiliar)or $mensaje=$db->ErrorMsg() ;
$cant_auxiliar=$rs_auxiliar->RecordCount();  
//print $cant_auxiliar;
 
    for($i=0;$i<$cant_auxiliar;$i++)
	{
	$variedad=$rs_auxiliar->Fields("variedad")."%";
	$b_variedad="select variedad,b_variedad.id_variedad,idb_variedad from b_variedad,n_variedad where b_variedad.id_mercado='3'and n_variedad.id_variedad=b_variedad.id_variedad and variedad like '".$variedad."'";
	//print $b_variedad;
	     $rs_bvariedad= $db->Execute($b_variedad)or $mensaje=$db->ErrorMsg() ;
	     $cant_bvariedad=$rs_bvariedad->RecordCount();
		// print  $cant_bvariedad;
	 
	   $idb_variedad=$rs_bvariedad->Fields("idb_variedad");
	   $estab="select cod_estab,id_estab from n_estab where id_mercado='3' and estab like '%T5'";
	   //print $estab;
	   $rs_estab= $db->Execute($estab)or $mensaje=$db->ErrorMsg() ;
	   $cant_estab=$rs_estab->RecordCount();
	   //print "<br>". $cant_estab;
		 for($a=0;$a<$cant_estab;$a++)
		 {
		 $id_estab=$rs_estab->Fields("id_estab");
		 $insert="insert into n_var_estab (idb_variedad,id_estab,fecha_captar,id_unidad) values ('".$idb_variedad."','".$id_estab."','2008-12-27','3')";
		 print $insert;
		 $rs= $db->Execute($insert)or $mensaje=$db->ErrorMsg() ;
		 
		 $rs_estab->MoveNext();
		 } 
	    
	
	$rs_auxiliar->MoveNext();
	}
  







?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
