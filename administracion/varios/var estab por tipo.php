<?php 
$cant=0;
$x="../";
 
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");

$var="3";

$fecha=array("2008/12/10","2008/12/17","2008/12/24","2008/12/24");
$v="67";
$tabla="select *from tabla where (id_tipologia='".$v."' or id_tipologia3='".$v."' or id_tipologia4='".$v."') and hecho='0'";
//print "<br>".$tabla;
$rs_tabla = $db->Execute($tabla)or die($db->ErrorMsg()) ;
$cant_tabla=$rs_tabla->RecordCount();
print "Cantidad de Filas: ".$cant_tabla;

 for($i=0;$i<$cant_tabla;$i++)
  {
    $id_tipologia=$rs_tabla->Fields("id_tipologia");
	$id_tipologia2=$rs_tabla->Fields("id_tipologia2");
	$id_tipologia3=$rs_tabla->Fields("id_tipologia3");
	$id_tipologia4=$rs_tabla->Fields("id_tipologia4");
	$id_variedad=$rs_tabla->Fields("id_variedad");
	
	

	        
			if($id_tipologia!="")
			{
			print "<br>Entre al 1";
			
    $estab="select * from n_estab where id_tipologia='".$id_tipologia."' and cod_dpa='0401' and id_mercado='4' ";
	print "<br>".$estab;
    $rs_estab = $db->Execute($estab)or die($db->ErrorMsg()) ;
	
    $cant_estab=$rs_estab->RecordCount();
	
	 if($cant_estab=="0"){$id_tipologia="0";}
	     if($cant_estab>$var)
	     $cant_estab=$var;
	                          for($e=0;$e<$cant_estab;$e++)
								{
								$id_estab=$rs_estab->Fields("id_estab");
							    $id_mercado=$rs_estab->Fields("id_mercado");							
							    $variedad="select * from b_variedad where id_variedad='".$id_variedad."' and id_mercado='". $id_mercado."'";
	                            $rs_variedad = $db->Execute($variedad)or die($db->ErrorMsg()) ;
                                $cant_variedad=$rs_variedad->RecordCount();
							       for($a=0;$a<$cant_variedad;$a++)
								     {
									
									   $idb_variedad=$rs_variedad->Fields("idb_variedad");
									
									 $query_rs= "INSERT INTO n_var_estab (id_estab,idb_variedad,fecha_captar,id_unidad)  
		VALUES ('".$id_estab."','".$idb_variedad."','".$fecha[$e]."','3')";print $query_rs."<br>";	  
	 	$r=$db->Execute($query_rs) or die($db->ErrorMsg());
		                    if($r!=" ")
							{
							$cant=$cant+1;
							}
									  $rs_variedad->MoveNext();
									 }
									  $rs_estab->MoveNext();	
								}
	                   
	        }
			if($id_tipologia=="0")
					  {
					     if($id_tipologia2!="")
						 {
						 	print "<br>Entre al 2";
						   $estab="select * from n_estab where id_tipologia='".$id_tipologia2."' and cod_dpa='0401' and id_mercado='4' ";
	print "<br>".$estab; 
    $rs_estab = $db->Execute($estab)or die($db->ErrorMsg()) ;
    $cant_estab=$rs_estab->RecordCount();
	 if($cant_estab>$var)
	     $cant_estab=$var;
	                             for($e=0;$e<$cant_estab;$e++)
								{
								$id_estab=$rs_estab->Fields("id_estab");
							    $id_mercado=$rs_estab->Fields("id_mercado");
						
							    $variedad="select * from b_variedad where id_variedad='".$id_variedad."' and id_mercado='". $id_mercado."'";
	                            $rs_variedad = $db->Execute($variedad)or die($db->ErrorMsg()) ;
                                $cant_variedad=$rs_variedad->RecordCount();
								print "<br>".$variedad;
							       for($a=0;$a<$cant_variedad;$a++)
								     {
								
									   $idb_variedad=$rs_variedad->Fields("idb_variedad");
									  
									 $query_rs= "INSERT INTO n_var_estab (id_estab,idb_variedad,fecha_captar,id_unidad)  
		VALUES ('".$id_estab."','".$idb_variedad."','".$fecha[$e]."','3')";print $query_rs."<br>";	  
	 	$r=$db->Execute($query_rs) or die($db->ErrorMsg());
		 if($r!=" ")
							{
							$cant=$cant+1;
							}
									  $rs_variedad->MoveNext();
									 }
									  $rs_estab->MoveNext();	
								}
						 }
						 else
						 {$id_tipologia2="0";}
					  }
			
			     
				 
				 
				 if($id_tipologia3!="")
				 {
				 	print "<br>Entre al 3";
				 $estab3="select * from n_estab where id_tipologia='".$id_tipologia3."' and cod_dpa='0401' and id_mercado='1' ";
	print "<br>".$estab3; 
    $rs_estab3 = $db->Execute($estab3)or die($db->ErrorMsg()) ;
    $cant_estab3=$rs_estab3->RecordCount();
	 if($cant_estab3>$var)
	     $cant_estab3=$var;
	                for($e3=0;$e3<$cant_estab3;$e3++)
								{
								$id_estab=$rs_estab3->Fields("id_estab");
							    $id_mercado=$rs_estab3->Fields("id_mercado");
							
							    $variedad="select * from b_variedad where id_variedad='".$id_variedad."' and id_mercado='". $id_mercado."'";
	                            $rs_variedad = $db->Execute($variedad)or die($db->ErrorMsg()) ;
                                $cant_variedad=$rs_variedad->RecordCount();
								print  "<br>".$variedad;
							       for($a=0;$a<$cant_variedad;$a++)
								     {
						
									   $idb_variedad=$rs_variedad->Fields("idb_variedad");
									 
									 $query_rs= "INSERT INTO n_var_estab (id_estab,idb_variedad,fecha_captar,id_unidad)  
		VALUES ('".$id_estab."','".$idb_variedad."','".$fecha[$e3]."','3')";print $query_rs."<br>";	  
	 	$r=$db->Execute($query_rs) or die($db->ErrorMsg());
		 if($r!=" ")
							{
							$cant=$cant+1;
							}
									  $rs_variedad->MoveNext();
									 }
									  $rs_estab3->MoveNext();	
								}
				 }
				 else{$id_tipologia3="0";}
				 
				 
		 if($id_tipologia4!="")
				 {
				 	print "<br>Entre al 4";
				 $estab4="select * from n_estab where id_tipologia='".$id_tipologia4."' and cod_dpa='0401' and id_mercado='2' ";
                 print "<br>".$estab4;
    $rs_estab4 = $db->Execute($estab4)or die($db->ErrorMsg()) ;
    $cant_estab4=$rs_estab4->RecordCount();
	 if($cant_estab4>$var)
	     $cant_estab4=$var;
	                              for($e4=0;$e4<$cant_estab4;$e4++)
								{
								$id_estab=$rs_estab4->Fields("id_estab");
							    $id_mercado=$rs_estab4->Fields("id_mercado");
								
							    $variedad="select * from b_variedad where id_variedad='".$id_variedad."' and id_mercado='". $id_mercado."'";
	                            $rs_variedad = $db->Execute($variedad)or die($db->ErrorMsg()) ;
                                $cant_variedad=$rs_variedad->RecordCount();
								//print  "<br>".$variedad;
							       for($a=0;$a<$cant_variedad;$a++)
								     {
								
									   $idb_variedad=$rs_variedad->Fields("idb_variedad");
									  
									 $query_rs= "INSERT INTO n_var_estab (id_estab,idb_variedad,fecha_captar,id_unidad)  
		VALUES ('".$id_estab."','".$idb_variedad."','".$fecha[$e4]."','3')";print $query_rs."<br>";	  
	 	$r=$db->Execute($query_rs) or die($db->ErrorMsg());
		 if($r!=" ")
							{
							$cant=$cant+1;
							}
									  $rs_variedad->MoveNext();
									 }
									  $rs_estab4->MoveNext();	
								}
				 }
				 else{$id_tipologia4="0";}
		
	  $rs_tabla->MoveNext();
  }
  print "<br>Cantidad de inserciones: ".$cant;
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
