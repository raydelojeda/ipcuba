<?php

include("../adodb/adodb.inc.php");
include("../coneccion/conn.php");

$var_estab="select  id_variedad ,id_var_estab,n_var_estab.id_estab,n_var_estab.idb_variedad,cod_dpa from n_var_estab,n_estab,b_variedad where n_var_estab.id_estab=n_estab.id_estab and n_estab.id_mercado='3' and n_var_estab.idb_variedad=b_variedad.idb_variedad  and b_variedad.id_mercado='3' and central='0' and fecha_captar='2008/01/07'";
$rs_var_estab= $db->Execute($var_estab)or $mensaje=$db->ErrorMsg() ;
$cant_var_estab=$rs_var_estab->RecordCount(); 
//print $cant_var_estab;
    for($i=0;$i<$cant_var_estab;$i++)
	 {
	    $id_var_estab=$rs_var_estab->Fields("id_var_estab");
		$id_variedad=$rs_var_estab->Fields("id_variedad");
		$cod_dpa=$rs_var_estab->Fields("cod_dpa");
	//-----------------------
	$usuario="Select *from usuario where cod_dpa='".$cod_dpa."'";
	$rs= $db->Execute($usuario)or $mensaje=$db->ErrorMsg() ;
	$id_usuario=$rs->Fields("id_usuario");
	//---------------------	
		

		  $auxiliar="Select *from auxiliar where id_variedad='".$id_variedad."' and cod_dpa='".$cod_dpa."' and semana='1'" ;
		  //print $auxiliar;
		  $rs_auxiliar= $db->Execute($auxiliar)or $mensaje=$db->ErrorMsg() ;
          $cant=$rs_auxiliar->RecordCount();
		      for($a=1;$a<=$cant;$a++)
			  {
			  $f="2008/12/$a";
			  //print "<br>".$f;
			  $precio=$rs_auxiliar->Fields("precio");
			  
			  $insert="insert into captacion (precio,fecha,id_obs,id_usuario,id_var_estab,id_inc) values ('".$precio."','".$f."','8','".$id_usuario."','".$id_var_estab."','8')";
				 // print "<br>".$insert;
				$rs_i = $db->Execute($insert)or $mensaje=$db->ErrorMsg() ;
			  $rs_auxiliar->MoveNext(); 
			  }
		  
		  $rs_var_estab->MoveNext(); 
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
