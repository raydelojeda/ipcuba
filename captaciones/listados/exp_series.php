<?php 
$locat="l_datos_m.php";
$x="../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."php/session/session_autor.php");
include($x."php/generar_excel_apis.php");

$query = "select distinct n_variedad.id_variedad, ecod_var, variedad, cod_var
from captacion, n_var_estab, b_variedad,n_variedad
where captacion.id_var_estab=n_var_estab.id_var_estab and 
b_variedad.idb_variedad=n_var_estab.idb_variedad and 
n_variedad.id_variedad=b_variedad.id_variedad order by ecod_var, cod_var";
$rs=$db->execute($query);



header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel");
header ("Content-Disposition: attachment; filename=PlanExcel_ApisCuba.xls" );
header ("Content-Description: PHP/INTERBASE Generated Data" );
xlsBOF(); // begin Excel stream

xlsWriteLabel(0,0,"Código Variedad"); 
xlsWriteLabel(0,1,"Variedad");

if($rs->RecordCount() > 0)
  { $i=1;
	$rs->MoveFirst();	
	while (!$rs->EOF)
	{
	 $sql = "select captacion.precio
	 from captacion, n_var_estab, b_variedad,n_variedad, n_dpa, n_estab
	 where captacion.id_var_estab=n_var_estab.id_var_estab and 
	 b_variedad.idb_variedad=n_var_estab.idb_variedad and 
	 n_var_estab.id_estab=n_estab.id_estab and 
	 n_estab.cod_dpa=n_dpa.cod_dpa and
	 n_variedad.id_variedad=b_variedad.id_variedad and
	 n_variedad.id_variedad='".$rs->fields['id_variedad']."'";
	 
	 if($_GET['fecha']!=0)
	$sql .= " and captacion.fecha>='".$_GET['fecha']."'"; 
	//print $query;
	 $rs1=$db->execute($sql);
	 
	 if($rs1->RecordCount() > 0)
	  { $f=2;
		$rs1->MoveFirst();	
		while (!$rs1->EOF)
		{
			 $precio=$rs1->fields['precio'];
			 if($precio!=0)
			 {
				 xlsWriteNumber($i,$f,$precio);
				 $f++;
			 }
		 $rs1->MoveNext();
		}
	  }
	 
	 xlsWriteLabel($i,0,$rs->fields['ecod_var']);
	 xlsWriteLabel($i,1,$rs->fields['variedad']);
	 $rs->MoveNext();$i++;
	}
  }

xlsEOF(); // close the stream 

?>