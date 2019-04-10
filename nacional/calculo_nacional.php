<?php 
$x="../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."php/session/session_editor.php");

$suma_precio=0;
$frec=0;
$cant=0;
$media_precios=0;
$precio_frec=0;

//---------------------------------------------------
$query_usuario = " where usuario='".$_SESSION["user"]."'"; 
$sql_usuario = "select id_usuario from usuario".$query_usuario;		
$rs_usuario = $db->Execute($sql_usuario)or $mensaje=$db->ErrorMsg() ;
$id_usuario=$rs_usuario->Fields("id_usuario");
//---------------------------------------------------

//---------------------------------------------------					 
$sql_fecha_base = "select max(fecha) from b_producto";		
$rs_fecha_base = $db->Execute($sql_fecha_base)or $mensaje=$db->ErrorMsg() ;
$fecha_base = $rs_fecha_base->Fields('max');//print $x;
//---------------------------------------------------

if ($_POST["var_aux_mod"]!="")
{	
	$fecha_cont=$_POST["var_aux_mod"];  
	$ano=substr($fecha_cont,0,4);
	$mes=substr($fecha_cont,4,2);
	$dia=substr($fecha_cont,6,2);
	$fecha=$ano."-".$mes."-".$dia;//fecha que envia la pag listar
	if($mes==1)
	{$mes_ant=12;$ano=$ano-1;}
	else
	{$mes_ant=$mes-1;}
	$fecha_ant=$ano."-".$mes_ant."-".$dia;//fecha del mes anterior a la enviada por la pag listar
	//print $fecha_ant;
	
	

//-------------------FOR DE LOS MERCADOS------------------------------------------------------------
$sql_mercado = "select * from n_mercado";		
$rs_mercado = $db->Execute($sql_mercado)or $mensaje=$db->ErrorMsg() ;
$cant_mercado=$rs_mercado->RecordCount();

$rs_mercado->MoveFirst();
for($mer=1;$mer<=$cant_mercado;$mer++)
{
	$id_mercado=$rs_mercado->Fields('id_mercado');
		//--------------------------------------------------------------------------------------------------					 
				
	$sql_producto = "select id_producto from b_producto where id_mercado=$id_mercado AND fecha='".$fecha_base."'";		
	$rs_producto = $db->Execute($sql_producto)or $mensaje=$db->ErrorMsg() ;
	$cant_producto=$rs_producto->RecordCount();

	$rs_producto->MoveFirst();
	for($pro=1;$pro<=$cant_producto;$pro++)
	{
	$id_producto=$rs_producto->Fields('id_producto');	
	
	$sql_provincial = "select * from dato_provincial where id_mercado=$id_mercado AND id_producto=$id_producto and fecha>'".$fecha_ant."' and fecha<='".$fecha."'";		
	$rs_provincial = $db->Execute($sql_provincial)or $mensaje=$db->ErrorMsg() ;//print $sql_provincial;die();
	$id_prov=$rs_provincial->Fields('id_prov');//print $sql_provincial."<br>";
		if($id_prov!='')
		{//print $rs_provincial."<br>";
			$cant_provincial=$rs_provincial->RecordCount();		
			$rs_provincial->MoveFirst();
				for($prov=1;$prov<=$cant_provincial;$prov++)
				{ 
					$media_precios=$rs_provincial->Fields('media_precios');//print $media_precios."<br>";
					$fecha=$rs_provincial->Fields('fecha');
					$frec=$rs_provincial->Fields('frecuencia');
					//print $precio_frec;
					//$precio_frec=bcmul($media_precios, $frec,14);
					//$precio_frec=$media_precios*$frec;
					//print $frec."*".$media_precios."=".$precio_frec."<br>";					
					$suma_precio=bcadd($suma_precio, $media_precios,14);
					//$suma_precio=$suma_precio+$precio_frec;
					//print $suma_precio."+".$media_precios."<br>";
					//$cant=$cant+1;
					$suma_frec=$suma_frec+$frec;//print $suma_precio."---".$cant."<br>";
					$rs_provincial->MoveNext();
				}
					//*******************************************************************************								
					$sql_nac = "SELECT id_nac FROM dato_nacional WHERE fecha='".$fecha."' AND id_mercado='".$id_mercado."' AND id_producto='".$id_producto."'";		
					$rs_nac = $db->Execute($sql_nac) or die($db->ErrorMsg());
					$id_nac=$rs_nac->Fields('id_nac');
						
						if($id_nac=='' && $suma_precio!='0')								 				
						{//print $sql_prov;					
							//$media_precio=$suma_precio/$suma_frec;
							$media_precio=bcdiv($suma_precio, $cant_provincial,14);
							//print $media_precio."=".$suma_precio."/".$suma_frec."<br>";								
							
							$sql_ins_nac="INSERT INTO dato_nacional (fecha,media_precios,id_producto,id_mercado,frecuencia,id_usuario,calc) VALUES ('".$fecha."','".$media_precio."','".$id_producto."','".$id_mercado."','".$suma_frec."','".$id_usuario."','1')";
							$db->Execute($sql_ins_nac) or die($db->ErrorMsg());//print $sql_ins_nac;
						}
						elseif($id_nac!='' && $suma_precio!='0')
						{
							//$media_precio=$suma_precio/$suma_frec;
							$media_precio=bcdiv($suma_precio, $cant_provincial,14);
							$sql_upd_nac = "UPDATE dato_nacional SET  media_precios ='".$media_precio."', frecuencia ='".$suma_frec."' WHERE id_nac = '".$id_nac."'";
							$db->Execute($sql_upd_nac) or die($db->ErrorMsg());
						}
						elseif($id_nac!='' && $suma_precio=='0')
						{}
					//*******************************************************************************
			
		}$suma_precio=0;$suma_frec=0;$cant=0;$id_nac='';
		$rs_producto->MoveNext();
	//--------------------------------------------------------------------------------------------------
	}	
$rs_mercado->MoveNext();
}
//-------------------FIN DEL FOR DE LOS MERCADOS----------------------------------------------------


}
header("Location:listado.php");
?>