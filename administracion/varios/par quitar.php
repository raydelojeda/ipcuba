<?php 

include("../adodb/adodb.inc.php");
include("../coneccion/conn.php");
$fecha="select fecha_captar,id_var_estab from n_var_estab where fecha_captar='2008/01/27'";
	     $rs= $db->Execute($fecha)or $mensaje=$db->ErrorMsg() ;
	     $cant_estab=$rs->RecordCount();
		 for($a=0;$a<$cant_estab;$a++)
		 {
	    $fe=$rs->Fields("fecha_captar");
		$id=$rs->Fields("id_var_estab");
		//print "<br>".$fe."-".$id;
		
		 $fecha="2008/12/27";
		$update="Update n_var_estab set fecha_captar='".$fecha."' where id_var_estab='".$id."' and fecha_captar='".$fe."'";
		  $rs_u= $db->Execute($update)or $mensaje=$db->ErrorMsg() ;
	print $update;
		  $rs->MoveNext();
		 }
?>


