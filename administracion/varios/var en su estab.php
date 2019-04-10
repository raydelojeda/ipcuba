<?php 
$x="../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");

//para meter las especificaciones segun su variedad

$sql_var = "select * from b_variedad where id_mercado = '3'";
$rs_var= $db->Execute($sql_var)or die($db->ErrorMsg());
$rs_var->MoveFirst();
$cant_var=$rs_var->RecordCount();


$sql_estab = "select * from n_estab where id_tipologia = '29'";
$rs_estab= $db->Execute($sql_estab);


for($i=1;$i<=$cant_var;$i++)
{
$id_variedad=$rs_var->fields["id_variedad"];
$idb_variedad=$rs_var->fields["idb_variedad"];
$rs_estab->MoveFirst();
$cant_estab=$rs_estab->RecordCount();
//print $cant_estab;
	//print $id_variedad."<br>";
	for($f=1;$f<=$cant_estab;$f++)
	{	$r=$f*$i;
	  
		$id_estab=$rs_estab->fields["id_estab"];
		 $fecha="2008-12-07";
		  
		  
		$sql = "select n_var_estab.id_var_estab,n_estab.id_estab,b_variedad.id_variedad,b_variedad.id_mercado,id_tipologia from n_var_estab,b_variedad,n_estab where b_variedad.id_mercado='3' and n_estab.id_tipologia='29' and n_estab.id_estab = '$id_estab' and b_variedad.id_variedad = '$id_variedad' and b_variedad.idb_variedad='".$idb_variedad."' and fecha_captar='$fecha'";
		//print $sql;
		$rs = $db->Execute($sql)or die($db->ErrorMsg()) ;
//print $sql."   ".$r."<br>";
		if($rs_var->fields["id_var_estab"]=="")
		{			
		$query_rs= "INSERT INTO n_var_estab (id_estab,idb_variedad,fecha_captar,id_unidad)  
		VALUES ('".$id_estab."','".$idb_variedad."','".$fecha."','3')";print $query_rs.$r."<br>";	  
	 	$db->Execute($query_rs) or die($db->ErrorMsg());//print $query_rs;
		}
	
		$rs_estab->MoveNext();
		}
		$rs_var->MoveNext();
}

?>

 