<?php   
$x="../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
$sql="select *from n_var_estab,n_estab where n_var_estab.id_estab=n_estab.id_estab and n_estab.estab='Sierra Maestra'";
//print $sql;
$rs = $db->Execute($sql)or $mensaje=$db->ErrorMsg() ;
$cant_auxiliar=$rs->RecordCount(); 

print $cant_auxiliar;
for($i=0;$i<$cant_auxiliar;$i++)
	{
	$id_var_estab=$rs->Fields("id_var_estab");
	$update="Update n_var_estab set fecha_captar='2008/12/10' where id_var_estab='".$id_var_estab."'";
	print $update; 
	$rs2 = $db->Execute($update)or $mensaje=$db->ErrorMsg() ;
	$rs->MoveNext();
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
