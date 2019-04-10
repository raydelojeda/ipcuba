<?php 
$cant=0;
$x="../";
 
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
$sql_dpa="select * from n_dpa where incluido='1'";
$rs_dpa = $db->Execute($sql_dpa)or die($db->ErrorMsg()) ;
$cant_dpa=$rs_dpa->RecordCount();

for($d=0;$d<$cant_dpa;$d++)
{
$cod_dpa=$rs_dpa->Fields("cod_dpa");
$update="update tabla set hecho='0'";
$rs_u = $db->Execute($update)or die($db->ErrorMsg()) ;


$tabla2="select distinct tipologia from tabla2 ";
$rs_tabla2 = $db->Execute($tabla2)or die($db->ErrorMsg()) ;
$cant_tabla2=$rs_tabla2->RecordCount();

for($t=0;$t<$cant_tabla2;$t++)
{
$tipo=$rs_tabla2->Fields("tipologia");
  
$tabla3="select  * from tabla2 where tipologia='".$tipo."'";
$rs_tabla3 = $db->Execute($tabla3)or die($db->ErrorMsg()) ;
$cant_tabla3=$rs_tabla3->RecordCount();

//$cod_dpa="0401";
$v=$tipo;
$var=$cant_tabla3;
$fecha=array();
for($t2=0;$t2<$cant_tabla3;$t2++)
{
$fecha[$t2]="2008/12/".$rs_tabla3->Fields("dia");
$rs_tabla3->MoveNext();
}
$tabla="select * from tabla where (id_tipologia='".$v."' or id_tipologia3='".$v."' or id_tipologia4='".$v."') and hecho='0'";
$rs_tabla = $db->Execute($tabla)or die($db->ErrorMsg()) ;
$cant_tabla=$rs_tabla->RecordCount();
print "<br>"."Cantidad de Filas: ".$cant_tabla."<br>";

 for($i=0;$i<$cant_tabla;$i++)
  {
    $id_tipologia=$rs_tabla->Fields("id_tipologia");
	$id_tipologia2=$rs_tabla->Fields("id_tipologia2");
	$id_tipologia3=$rs_tabla->Fields("id_tipologia3");
	$id_tipologia4=$rs_tabla->Fields("id_tipologia4");
	$id_variedad=$rs_tabla->Fields("id_variedad");
	$id=$rs_tabla->Fields("id_tabla");
	$update="update tabla set hecho='1' where id_tabla='".$id."'";
	$rs_u = $db->Execute($update)or die($db->ErrorMsg()) ;

	        
			if($id_tipologia!="")
			{
			print "<br>Entre al 1";
			
			$estab="select * from n_estab where id_tipologia='".$id_tipologia."' and cod_dpa='$cod_dpa' and id_mercado='4' and nuevo='1'";
			$rs_estab = $db->Execute($estab)or die($db->ErrorMsg()) ;	
			$cant_estab=$rs_estab->RecordCount();
			/*if($cant_estab!=0)
			{
			$id_estab1=$rs_estab->Fields("id_estab");
			$sql1="UPDATE n_estab SET  var_estab ='1' where id_estab='$id_estab1'";
			$db->Execute($sql1)or die($db->ErrorMsg());				
			}*/
			
			$tip_dpa_mer=$id_tipologia.$cod_dpa. 4;
			
			//print "cant  ".$cant_estab;
			if($cant_estab==0)
			{
				if($var_aux!=$tip_dpa_mer)
				{$var_aux=$tip_dpa_mer;
				
				$sql_tipologia="select tipologia from n_tipologia where id_tipologia='".$id_tipologia."'";
				$rs_tipologia = $db->Execute($sql_tipologia)or die($db->ErrorMsg());	
				$tipologia=$rs_tipologia->Fields("tipologia");
				$gestor = @fopen("c:\Municipio - ".$cod_dpa.".txt", "a");
					if ($gestor) 
					{		   
					   if (fwrite($gestor, "El \"".$cod_dpa."\" no envió la tipología (\"".$id_tipologia."\") \"".$tipologia."\" en el mercado Divisa;\r\n") === FALSE) 
						{
							die("No se puede escribir al archivo.");
							exit;
						}
						fclose($gestor);
					}
				}
			}
				
			$tabla3="select distinct (dia) from tabla2,n_tipologia,n_estab where tabla2.tipologia='".$id_tipologia."'
			and cod_dpa='$cod_dpa' and tabla2.tipologia=n_tipologia.id_tipologia and n_tipologia.id_tipologia=n_estab.id_tipologia and id_mercado='4'";
			$rs_tabla3 = $db->Execute($tabla3)or die($db->ErrorMsg()) ;
			$cant_tabla3=$rs_tabla3->RecordCount();
			$var=$cant_tabla3;
			$fecha=array();
			for($t2=0;$t2<$cant_tabla3;$t2++)
			{$fecha[$t2]="2008/12/".$rs_tabla3->Fields("dia");$rs_tabla3->MoveNext();}
				
		    if($cant_estab=="0"){$id_tipologia="0";}
			if($cant_estab>$var)$cant_estab=$var;
	                          
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
						{$cant=$cant+1;}
					  
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
				$estab="select * from n_estab where id_tipologia='".$id_tipologia2."' and cod_dpa='$cod_dpa' and id_mercado='4' and nuevo='1'";
				$rs_estab2 = $db->Execute($estab)or die($db->ErrorMsg()) ;
				$cant_estab2=$rs_estab2->RecordCount();
				
				
				/*if($cant_estab2!=0)
				{
				$id_estab2=$rs_estab2->Fields("id_estab");
				$sql2="UPDATE n_estab SET  var_estab ='1' where id_estab='$id_estab2'";
				$db->Execute($sql2)or die($db->ErrorMsg());				
				}*/
				
				
				$tip_dpa_mer2=$id_tipologia2.$cod_dpa. 4;
				
				//print "cant  ".$cant_estab;
				if($cant_estab2==0)
				{
					if($var_aux2!=$tip_dpa_mer2)
					{$var_aux2=$tip_dpa_mer2;
					
					$sql_tipologia="select tipologia from n_tipologia where id_tipologia='".$id_tipologia2."'";
					$rs_tipologia = $db->Execute($sql_tipologia)or die($db->ErrorMsg());	
					$tipologia=$rs_tipologia->Fields("tipologia");
					$gestor = @fopen("c:\Municipio - ".$cod_dpa.".txt", "a");
						if ($gestor) 
						{		   
							if (fwrite($gestor, "El \"".$cod_dpa."\" no envió la tipología (\"".$id_tipologia2."\") \"".$tipologia."\" en el mercado Divisa;\r\n") === FALSE)  
							{
								die("No se puede escribir al archivo.");
								exit;
							}
							fclose($gestor);
						}
					}
				}


				$tabla3="select distinct (dia) from tabla2,n_tipologia,n_estab where tabla2.tipologia='".$id_tipologia2."'
				and cod_dpa='$cod_dpa' and tabla2.tipologia=n_tipologia.id_tipologia and n_tipologia.id_tipologia=n_estab.id_tipologia and id_mercado='4'";
				$rs_tabla3 = $db->Execute($tabla3)or die($db->ErrorMsg()) ;
				$cant_tabla3=$rs_tabla3->RecordCount();
				$var=$cant_tabla3;
				$fecha=array();
				for($t2=0;$t2<$cant_tabla3;$t2++)
				{$fecha[$t2]="2008/12/".$rs_tabla3->Fields("dia");$rs_tabla3->MoveNext();}
				if($cant_estab2>$var)$cant_estab2=$var;
				
					for($e=0;$e<$cant_estab2;$e++)
					{
					$id_estab=$rs_estab2->Fields("id_estab");
					$id_mercado=$rs_estab2->Fields("id_mercado");
			
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
						 {$cant=$cant+1;}
				    $rs_variedad->MoveNext();
				   }
			    $rs_estab2->MoveNext();	
			   }
			 }
			 else
			 {$id_tipologia2="0";}
		  }
			
			     

	
	if($id_tipologia3!="")
	{
	print "<br>Entre al 3";
	$estab3="select * from n_estab where id_tipologia='".$id_tipologia3."' and cod_dpa='$cod_dpa' and id_mercado='1' and nuevo='1'";
	$rs_estab3 = $db->Execute($estab3)or die($db->ErrorMsg()) ;
	$cant_estab3=$rs_estab3->RecordCount();
	
	
	/*if($cant_estab3!=0)
	{
	$id_estab3=$rs_estab3->Fields("id_estab");
	$sql3="UPDATE n_estab SET  var_estab ='1' where id_estab='$id_estab3'";
	$db->Execute($sql3)or die($db->ErrorMsg());				
	}*/
	
	
	$tip_dpa_mer3=$id_tipologia3.$cod_dpa. 4;
	
	//print "cant  ".$cant_estab;
	if($cant_estab3==0)
	{
		if($var_aux3!=$tip_dpa_mer3)
		{$var_aux3=$tip_dpa_mer3;
		
		$sql_tipologia="select tipologia from n_tipologia where id_tipologia='".$id_tipologia3."'";
		$rs_tipologia = $db->Execute($sql_tipologia)or die($db->ErrorMsg());	
		$tipologia=$rs_tipologia->Fields("tipologia");
		$gestor = @fopen("c:\Municipio - ".$cod_dpa.".txt", "a");
		if ($gestor) 
		{		   
		    if (fwrite($gestor, "El \"".$cod_dpa."\" no envió la tipología (\"".$id_tipologia3."\") \"".$tipologia."\" en el mercado Formal;\r\n") === FALSE) 
			{
				die("No se puede escribir al archivo.");
				exit;
			}
			fclose($gestor);
		}
	}
	}
			$tabla3="select distinct (dia) from tabla2,n_tipologia,n_estab where tabla2.tipologia='".$id_tipologia3."'
			and cod_dpa='$cod_dpa' and tabla2.tipologia=n_tipologia.id_tipologia and n_tipologia.id_tipologia=n_estab.id_tipologia and id_mercado='1'";
			$rs_tabla3 = $db->Execute($tabla3)or die($db->ErrorMsg()) ;
			//print $tabla3;
			$cant_tabla3=$rs_tabla3->RecordCount();
			$var=$cant_tabla3;
			$fecha=array();
			for($t2=0;$t2<$cant_tabla3;$t2++)
			{$fecha[$t2]="2008/12/".$rs_tabla3->Fields("dia");$rs_tabla3->MoveNext();}
				if($cant_estab3>$var)$cant_estab3=$var;
				
				for($e3=0;$e3<$cant_estab3;$e3++)
				{
				$id_estab=$rs_estab3->Fields("id_estab");
				$id_mercado=$rs_estab3->Fields("id_mercado");					
				$variedad="select * from b_variedad where id_variedad='".$id_variedad."' and id_mercado='". $id_mercado."'";
				$rs_variedad = $db->Execute($variedad)or die($db->ErrorMsg()) ;
				$cant_variedad=$rs_variedad->RecordCount();
					
					for($a=0;$a<$cant_variedad;$a++)
					{
					
					$idb_variedad=$rs_variedad->Fields("idb_variedad");					
					$query_rs= "INSERT INTO n_var_estab (id_estab,idb_variedad,fecha_captar,id_unidad)  
					VALUES ('".$id_estab."','".$idb_variedad."','".$fecha[$e3]."','3')";print $query_rs."<br>";	  
					$r=$db->Execute($query_rs) or die($db->ErrorMsg());
					if($r!=" ")
					{$cant=$cant+1;}
					 $rs_variedad->MoveNext();
				    }
				 $rs_estab3->MoveNext();	
				}
			 }
			else{$id_tipologia3="0";}
				 
				 
		 if($id_tipologia4!="")
		 {
		 print "<br>Entre al 4";
		 $estab4="select * from n_estab where id_tipologia='".$id_tipologia4."' and cod_dpa='$cod_dpa' and id_mercado='2' and nuevo='1'";
		 $rs_estab4 = $db->Execute($estab4)or die($db->ErrorMsg()) ;
		 $cant_estab4=$rs_estab4->RecordCount();
		 
		 
		 
		/* if($cant_estab4!=0)
			{
			$id_estab4=$rs_estab4->Fields("id_estab");
			$sql4="UPDATE n_estab SET  var_estab ='1' where id_estab='$id_estab4'";
			$db->Execute($sql4)or die($db->ErrorMsg());				
			}*/
		 
		 
		
		$tip_dpa_mer4=$id_tipologia4.$cod_dpa. 4;
		
		//print "cant  ".$cant_estab;
		if($cant_estab4==0)
		{
			if($var_aux4!=$tip_dpa_mer4)
			{$var_aux4=$tip_dpa_mer4;
			
			$sql_tipologia="select tipologia from n_tipologia where id_tipologia='".$id_tipologia4."'";
			$rs_tipologia = $db->Execute($sql_tipologia)or die($db->ErrorMsg());	
			$tipologia=$rs_tipologia->Fields("tipologia");
			$gestor = @fopen("c:\Municipio - ".$cod_dpa.".txt", "a");
				if ($gestor) 
				{		   
				   if (fwrite($gestor, "El \"".$cod_dpa."\" no envió la tipología (\"".$id_tipologia4."\") \"".$tipologia."\" en el mercado Informal;\r\n") === FALSE) 
					{
						die("No se puede escribir al archivo.");
						exit;
					}
					fclose($gestor);
				}
			}
		 }
	
	
$tabla3="select distinct (dia) from tabla2,n_tipologia,n_estab where tabla2.tipologia='".$id_tipologia4."'
and cod_dpa='$cod_dpa' and tabla2.tipologia=n_tipologia.id_tipologia and n_tipologia.id_tipologia=n_estab.id_tipologia and id_mercado='2'";
$rs_tabla3 = $db->Execute($tabla3)or die($db->ErrorMsg()) ;
$cant_tabla3=$rs_tabla3->RecordCount();
$var=$cant_tabla3;
 $fecha=array();
  for($t2=0;$t2<$cant_tabla3;$t2++)
  {$fecha[$t2]="2008/12/".$rs_tabla3->Fields("dia");$rs_tabla3->MoveNext();}
	
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
								     {$idb_variedad=$rs_variedad->Fields("idb_variedad");
									  $query_rs= "INSERT INTO n_var_estab (id_estab,idb_variedad,fecha_captar,id_unidad)  
									  VALUES ('".$id_estab."','".$idb_variedad."','".$fecha[$e4]."','3')";print $query_rs."<br>";	  									  $r=$db->Execute($query_rs) or die($db->ErrorMsg());
									  if($r!=" ")
									  {$cant=$cant+1;}
									  $rs_variedad->MoveNext();
									 }
								 $rs_estab4->MoveNext();	
								}
				 }
				 else{$id_tipologia4="0";}
		
	  $rs_tabla->MoveNext();
    }

   $rs_tabla2->MoveNext();
  }
  
 $rs_dpa->MoveNext();
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
