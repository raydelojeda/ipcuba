<?php 
if($campo1!='')
$query = "select * from $tabla order by $campo1";
else
$query = "select * from $tabla";//print $query;
$rs=$db->Execute($query) or $mensaje=$db->ErrorMsg() ;
$cant_rs=$rs->RecordCount();
 	for ($i = 0; $i < $cant_rs;$i++)
	{
		$rs_fields0=$rs->Fields($campo0);
		$rs_fields1=$rs->Fields($campo1);
		$rs_fields_id=$rs->Fields($value);										 
		echo"<option value=";echo $rs_fields_id; echo "> "; if($rs_fields1){echo $rs_fields1; print ". ";}echo $rs_fields0; echo "</option>";
        $rs->MoveNext();
	}
?>