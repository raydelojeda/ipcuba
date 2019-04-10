<?php 
$x="";
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
$rs_estab->MoveFirst();$cant_estab=$rs_estab->RecordCount();

	print $id_variedad."<br>";
	for($f=1;$f<=$cant_estab;$f++)
	{	$r=$f*$i;
	
		$id_estab=$rs_estab->fields["id_estab"];
		$fecha="2008-12-24";
		$sql = "select * from n_var_estab where id_estab = '$id_estab' and id_variedad = '$id_variedad' and fecha_captar='$fecha'";
		$rs = $db->Execute($sql)or die($db->ErrorMsg()) ;
//print $sql."   ".$r."<br>";
	

		if($rs_var->fields["id_var_estab"]=="")
		{			
		$query_rs= "INSERT INTO n_var_estab (id_estab,id_variedad,fecha_captar)  
		VALUES ('".$id_estab."','".$id_variedad."','".$fecha."')";print $query_rs.$r."<br>";	  
	 	$db->Execute($query_rs) or die($db->ErrorMsg());//print $query_rs;
		}
	
	//---------------------------------------------------		
		$espec = "select * from n_espec where id_variedad = '$id_variedad'";
		$rs_espec = $db->Execute($espec)or die($db->ErrorMsg());
		
		if($rs_espec->fields[0])
		{
		$cant=$rs_espec->RecordCount();
		$rs_espec->MoveFirst();
		
			for($c=0;$c<$cant;$c++) 
			{
				$id_espec=$rs_espec->fields["id_espec"];
				//---------------------------------------------------
				$sql = "select * from n_espec_estab where id_estab = '$id_estab' and id_espec = '$id_espec' and fecha_captar='$fecha'";
				$rs_espec_estab = $db->Execute($sql)or die($db->ErrorMsg()) ;
				//---------------------------------------------------
					if(!$rs_espec_estab->fields["id_espec_estab"])
					{		
					$query_rs_delete= "INSERT INTO n_espec_estab (id_estab,id_espec,fecha_captar)  
					VALUES ('".$id_estab."','".$id_espec."','".$fecha."')";//print $query_rs_delete.$i;	  
					$rs_delete = $db->Execute($query_rs_delete) ;//or die($db->ErrorMsg());	 	  
					$id_espec="";//print $query_rs_delete;						
					}
			$rs_espec->MoveNext();
			}  
		}
	$rs_estab->MoveNext();
	}
$rs_var->MoveNext();
}

?>

 