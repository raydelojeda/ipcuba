<?php 

include("../adodb/adodb.inc.php");
include("../coneccion/conn.php");

$auxiliar="select id_variedad,precio,cod_dpa from auxiliar";
$rs_auxiliar = $db->Execute($auxiliar)or $mensaje=$db->ErrorMsg() ;
$cant_auxiliar=$rs_auxiliar->RecordCount(); 
//print $cant_auxiliar;
      for($i=0;$i<$cant_auxiliar;$i++)
	  {
	    $id_variedad=$rs_auxiliar->Fields("id_variedad");
		$cod_dpa=$rs_auxiliar->Fields("cod_dpa");
		$precio=$rs_auxiliar->Fields("precio");
	    $seleccion="select distinct n_var_estab.id_estab, id_var_estab,n_estab.cod_dpa from b_variedad,n_var_estab,n_estab where n_var_estab.idb_variedad=b_variedad.idb_variedad and b_variedad.id_variedad='".$id_variedad."' and n_estab.id_estab=n_var_estab.id_estab and cod_dpa='".$cod_dpa."' and fecha_captar='2008/12/06' and central='0' and n_estab.id_mercado='2' and b_variedad.id_mercado='2'";
		//print  "<br>".$seleccion;  
			
		$rs_seleccion = $db->Execute($seleccion)or $mensaje=$db->ErrorMsg() ;
$cant=$rs_seleccion->RecordCount(); 
print "<br>".$cant;
         if($cant!=0)
		 {
       
           $usuario="select *from usuario where cod_dpa='".$cod_dpa."'";
		//print  $seleccion;  
		
		$rs_usuario = $db->Execute($usuario)or $mensaje=$db->ErrorMsg() ;
		
		$usuario=$rs_usuario->Fields("id_usuario");
             if(!rs_usuario)
			 {
			 $usuario='2';
			 }
                   
			      $id_var_estab=$rs_seleccion->Fields("id_var_estab");
				 // print "<br>". $id_var_estab;
				  $captacion="select *From captacion where id_var_estab='".$id_var_estab."' and fecha='2009/01/13'";
				 // print "<br>".$captacion;
				  $rs = $db->Execute($captacion)or $mensaje=$db->ErrorMsg() ;
				 
				  print  "<br>".$id_var_estab;
				  $f="2009/01/13";
				     if($rs->Fields("id_var_estab")=="")
					 {
		          $insert="insert into captacion (precio,fecha,id_obs,id_usuario,id_var_estab,id_inc) values ('".$precio."','".$f."','5','".$usuario."','".$id_var_estab."','1')";
				  print "<br>".$insert;
				$rs_i = $db->Execute($insert)or $mensaje=$db->ErrorMsg() ;
				   }
				   }
				
		$rs_auxiliar->MoveNext();
	  }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
