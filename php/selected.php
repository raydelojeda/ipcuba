<?php 
if($campo1!='')
$query_sel = "select * from $tabla order by $campo1";
else
$query_sel = "select * from $tabla order by $campo0";//print $query_sel;
$rs_selected=$db->Execute($query_sel) or $mensaje=$db->ErrorMsg() ;
$cant_rs=$rs_selected->RecordCount();
 	for ($i = 0; $i < $cant_rs;$i++)
	{
		$rs_fields0=$rs_selected->Fields($campo0);
		$rs_fields1=$rs_selected->Fields($campo1);
		$rs_fields_id=$rs_selected->Fields($campo_id);										 
		echo"<option value=";echo $rs_fields_id;if($rs_fields_id==$id){echo " selected ";$aux=$rs_fields_id;} echo "> "; if($rs_fields1){echo $rs_fields1; print ". ";}echo $rs_fields0; echo "</option>";
        $rs_selected->MoveNext();
	}
?>