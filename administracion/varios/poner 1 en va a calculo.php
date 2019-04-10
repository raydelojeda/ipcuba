<?php 

include("../../adodb/adodb.inc.php");
include("../../coneccion/conn.php");

$auxiliar="select * from captacion where va_a_calculo='1'";
$rs_auxiliar = $db->Execute($auxiliar)or $mensaje=$db->ErrorMsg() ;
$cant_auxiliar=$rs_auxiliar->RecordCount(); 
//print $cant_auxiliar;
      for($i=0;$i<$cant_auxiliar;$i++)
	  {
	    $id_usuario_aprueba=$rs_auxiliar->Fields("id_usuario_aprueba");
		$id_cap=$rs_auxiliar->Fields("id_cap");
		if($id_usuario_aprueba==0 || $id_usuario_aprueba=="")
		
		{
			$update="Update captacion set va_a_calculo='1', id_usuario_aprueba='776' where id_cap='".$id_cap."'";
			print $i.$update."<br>"; 
			$rs2 = $db->Execute($update)or $mensaje=$db->ErrorMsg();			
		}
				
		$rs_auxiliar->MoveNext();
	  }
?>
