<?php

include("../../adodb/adodb.inc.php");
include("../../coneccion/conn.php");
//para correr las fechas que se pasaron del dia 28 en captacionwhere id_cap>'14618'

$mer="select * from n_mercado";
$rs_mer= $db->Execute($mer)or $mensaje=$db->ErrorMsg() ;
$cant_mer=$rs_mer->RecordCount(); 

$dpa="select * from n_dpa where incluido ='1' order by cod_dpa";
$rs_dpa= $db->Execute($dpa)or $mensaje=$db->ErrorMsg();
$cant_dpa=$rs_dpa->RecordCount(); 

					
$tip="select distinct id_tipologia_nueva from n_tipologia";
$rs_tip= $db->Execute($tip)or $mensaje=$db->ErrorMsg();
$cant_tip=$rs_tip->RecordCount(); 

//print $cant_mer."<br>";
//print $cant_dpa."<br>";
//print $cant_tip."<br>";
	$rs_mer->MoveFirst();
	for($m=0;$m<$cant_mer;$m++)
	 {	$me=substr($rs_mer->Fields("mercado"),0,1);
	 	$id_m=$rs_mer->Fields("id_mercado");
		//print $m;
	   
	   $rs_dpa->MoveFirst(); 
	  for($d=0;$d<$cant_dpa;$d++)
		 {	$cod_dpa=$rs_dpa->Fields("cod_dpa");		
			$dpa_nueva=$rs_dpa->Fields("cod_dpa_nueva");	
			
			$rs_tip->MoveFirst();
			for($t=0;$t<$cant_tip;$t++)
			 {	
			 $id_tip=$rs_tip->Fields("id_tipologia");		
			 $tip_nueva=$rs_tip->Fields("id_tipologia_nueva");
    		$ff=$ff+1;
	
			$estab="select * from n_estab,n_dpa,n_tipologia,n_mercado where n_mercado.id_mercado=n_estab.id_mercado and n_estab.cod_dpa=n_dpa.cod_dpa and n_estab.id_tipologia=n_tipologia.id_tipologia and incluido ='1' and n_mercado.id_mercado='$id_m' and n_estab.cod_dpa='$cod_dpa' and n_tipologia.id_tipologia_nueva='$tip_nueva'";//print $estab."<br><br>";
			$rs_estab= $db->Execute($estab)or $mensaje=$db->ErrorMsg() ;
		 if($rs_estab->fields[0]!='')
		{	
			$cant_estab=$rs_estab->RecordCount(); 
			
			for($i=0;$i<$cant_estab;$i++)
			{//print $id_var_estab;
			
			$cont=$i+1;
			if($cont<=9)
			$cont="0".$cont;
			$cod=$dpa_nueva.$id_m.$tip_nueva.$cont;
			print $cod."<br>";
			$id_estab=$rs_estab->Fields("id_estab");
			$sql = "UPDATE n_estab SET  cod_estab ='".$cod."' WHERE id_estab = '".$id_estab."'";
	//print $sql;
	$db->Execute($sql) or $mensaje=$db->ErrorMsg() ;
			$rs_estab->MoveNext(); 
			}
		   }	
		
		 $rs_tip->MoveNext(); 
		}
			
	$rs_dpa->MoveNext(); 
	}	
	
$rs_mer->MoveNext(); 
	}	
		
print " ya ".$ff;
?>

