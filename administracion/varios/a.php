<?php 
include("../adodb/adodb.inc.php");
include("../coneccion/conn.php");



$n="select *from n_estab order by id_estab";
$rs = $db->Execute($n)or $mensaje=$db->ErrorMsg() ;
$cant=$rs->RecordCount(); 
//print $cant;
for($i=0;$i<$cant;$i++)
{
$id=$rs->Fields("id_estab");
//print "<br>".$id;
$e="select * from n_var_estab where id_estab='".$id."'";
   print "<br>".$e;
   $rs2 = $db->Execute($e)or $mensaje=$db->ErrorMsg() ;
   $cant2=$rs2->RecordCount(); 
   print "<br>".$cant2;
 if($cant2=='0')
	 {
	 print "<br>Entre al 1";
	 $update="update n_estab set nuevo='1' where id_estab='".$id."'";
	 $rs_u = $db->Execute($update)or $mensaje=$db->ErrorMsg() ;
	 print "<br>".$update;
	 }
	 elseif($cant2>'0')
	 {
	  print "<br>Entre al 2";
	 $update="update n_estab set nuevo='0' where id_estab='".$id."'";
	 $rs_u = $db->Execute($update)or $mensaje=$db->ErrorMsg() ;
	  print "<br>".$update;
	 }
  
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
