<?php 

$x="../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."php/session/session_autor.php");
include($x."adodb/adodb-navigator.php");

if ($_GET["regis_cant"]!="" && $_POST['sel_#']=="")
{	
	$_POST['sel_#'] = $_GET["regis_cant"];//para volver al listado con la misma cantidad de filas
	$_GET["regis_cant"]="";
}

//print $_POST['txt_ir'];

if($_POST['txt_ir'])
{//print "sds";
header("Location:n_captaciones.php?curr_page=".$_POST['txt_ir']."&sel_mes=".$sel_mes."&sel_ano=".$sel_ano."&porc=".$porc);
}
if (isset($_GET["otra"])) $otra = $_GET["otra"];
if ($_GET["sel_estab"]!="") $sel_estab = $_GET['sel_estab'];
if (isset($_POST["sel_estab"])) $sel_estab = $_POST['sel_estab'];
if ($_GET["sel_mes"]!="") $sel_mes = $_GET['sel_mes'];
if (isset($_POST["sel_mes"])) $sel_mes = $_POST['sel_mes'];
if($sel_mes=="")$sel_mes =date("m");
if ($_GET["sel_ano"]!="") $sel_ano = $_GET['sel_ano'];
if (isset($_POST["sel_ano"])) $sel_ano = $_POST['sel_ano']; 
if ($_GET["central"]!="") $central = $_GET['central'];
if (isset($_POST["central"])) $central = $_POST['central']; 
if($sel_ano=="")$sel_ano =date("Y");


$sel_fecha_ini=$sel_ano.'-'.$sel_mes.'-01';
$sel_fecha_fin=$sel_ano.'-'.$sel_mes.'-28';
$sel_estab=substr($sel_estab,10,20);

//print $sel_estab;

$array_text=array("Domingo de la 1ra semana","Lunes de la 1ra semana","Martes de la 1ra semana","Miércoles de la 1ra semana","Jueves de la 1ra semana","Viernes de la 1ra semana","Sábado de la 1ra semana","Domingo de la 2da semana","Lunes de la 2da semana","Martes de la 2da semana","Miércoles de la 2da semana","Jueves de la 2da semana","Viernes de la 2da semana","Sábado de la 2da semana","Domingo de la 3ra semana","Lunes de la 3ra semana","Martes de la 3ra semana","Miércoles de la 3ra semana","Jueves de la 3ra semana","Viernes de la 3ra semana","Sábado de la 3ra semana","Domingo de la 4ta semana","Lunes de la 4ta semana ","Martes de la 4ta semana","Miércoles de la 4ta semana","Jueves de la 4ta semana","Viernes de la 4ta semana","Sábado de la 4ta semana",);
$array=array("D-1","L-1","Ma-1","Mi-1","J-1","V-1","S-1","D-2","L-2","Ma-2","Mi-2","J-2","V-2","S-2","D-3","L-3","Ma-3","Mi-3","J-3","V-3","S-3","D-4","L-4","Ma-4","Mi-4","J-4","V-4","S-4",);
//---------------------------------------------------					 
$sql_fecha = "select max(fecha) from b_variedad";		
$rs_var_estab_fecha = $db->Execute($sql_fecha)or $mensaje=$db->ErrorMsg();
$fecha_base = $rs_var_estab_fecha->Fields('max');
//---------------------------------------------------

//--------------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DEL MES PASADO--------------------------------
$fecha_cierre_sem4_1=substr($fecha_base,0,8)."04";

$mes1=$sel_mes;
$ano1=$sel_ano;
if($mes1=="01")
{$mes_ant1="12";$ano_ant1=$ano1-1;}
else
{$mes_ant1=$mes1-1;$ano_ant1=$ano1;}

if(strlen($mes_ant1)==1)
$mes_ant1=0 .$mes_ant1;

$fecha_01_fin1=$ano1."/".$mes1."/"."01";//esta fecha es para quedarme dentro del mes actual
$fecha_01_ini1=$ano_ant1."/".$mes_ant1."/"."01";//esta fecha es para quedarme dentro del mes actual
//print $fecha_01_ini1;
$sql_cal = "select * from calendario where fecha_captar='".$fecha_cierre_sem4_1."' 
and fecha_cal>='$fecha_01_ini1' and fecha_cal<'$fecha_01_fin1' order by fecha_captar";		
$rs_cal = $db->Execute($sql_cal) or die($db->ErrorMsg());//print $sql_cal;die();
$fecha_cal_inicio_sem1_pasada=$rs_cal->fields["fecha_cal"];
//--------------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DEL MES PASADO--------------------------------


//--------------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DEL MES ACTUAL--------------------------------
$fecha_cierre_sem4_3=substr($fecha_base,0,8)."04";

$mes3=$sel_mes;
$ano3=$sel_ano;

if($mes3=="12")
{$mes_next3="01";$ano_next3=$ano3+1;}
else {$mes_next3=$mes3+1;$ano_next3=$ano3;}

if(strlen($mes_ant3)==1)
$mes_ant3=0 .$mes_ant3; 

$fecha_01_fin3=$ano_next3."/".$mes_next3."/"."01";//esta fecha es para quedarme dentro del mes actual
$fecha_01_ini3=$ano3."/".$mes3."/"."01";//esta fecha es para quedarme dentro del mes actual

$sql_cal = "select * from calendario where fecha_captar='".$fecha_cierre_sem4_3."' 
and fecha_cal>='$fecha_01_ini3' and fecha_cal<'$fecha_01_fin3' order by fecha_captar";//print $sql_cal;die();	
$rs_cal = $db->Execute($sql_cal) or die($db->ErrorMsg());
$fecha_cal_inicio_sem1_actual=$rs_cal->fields["fecha_cal"];
//--------------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DEL MES ACTUAL--------------------------------
$hoy=date("Y-m-d");
//print $hoy;
if($hoy<$fecha_cal_inicio_sem1_actual)
{
	//--------------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DEL MES ACTUAL--------------------------------
	$fecha_cierre_sem4_3=substr($fecha_base,0,8)."04";
	
	if($sel_mes==01){$sel_mes=12;$sel_ano=$sel_ano-1;}else $sel_mes=$sel_mes-1;
	
	$mes3=$sel_mes;
	$ano3=$sel_ano;
	
	if($mes3=="12")
	{$mes_next3="01";$ano_next3=$ano3+1;}
	else {$mes_next3=$mes3+1;$ano_next3=$ano3;}
	
	if(strlen($mes_ant3)==1)
	$mes_ant3=0 .$mes_ant3; 
	
	$fecha_01_fin3=$ano_next3."/".$mes_next3."/"."01";//esta fecha es para quedarme dentro del mes actual
	$fecha_01_ini3=$ano3."/".$mes3."/"."01";//esta fecha es para quedarme dentro del mes actual
	
	$sql_cal = "select * from calendario where fecha_captar='".$fecha_cierre_sem4_3."' 
	and fecha_cal>='$fecha_01_ini3' and fecha_cal<'$fecha_01_fin3' order by fecha_captar";//print $sql_cal;die();	
	$rs_cal = $db->Execute($sql_cal) or die($db->ErrorMsg());
	$fecha_cal_inicio_sem1_actual=$rs_cal->fields["fecha_cal"];
	//--------------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DEL MES ACTUAL--------------------------------
}

//--------------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DEL MES NEXT--------------------------------
$fecha_cierre_sem4_4=substr($fecha_base,0,8)."04";


$mes4=$sel_mes;
$ano4=$sel_ano;

if($mes4=="12")
{$mes_next4="02";$ano_next4=$ano4+1;$mes4="01";$ano4=$ano4+1;}
elseif($mes4=="11")
{$mes_next4="01";$ano_next4=$ano4+1;$mes4=$mes4+1;}
else {$mes_next4=$mes4+2;$ano_next4=$ano4;$mes4=$mes4+1;}

if(strlen($mes_ant4)==1)
$mes_ant4=0 .$mes_ant4;

$fecha_01_fin4=$ano_next4."/".$mes_next4."/"."01";//esta fecha es para quedarme dentro del mes actual
$fecha_01_ini4=$ano4."/".$mes4."/"."01";//esta fecha es para quedarme dentro del mes actual

$sql_cal = "select * from calendario where fecha_captar='".$fecha_cierre_sem4_4."' 
and fecha_cal>='$fecha_01_ini4' and fecha_cal<'$fecha_01_fin4' order by fecha_captar";		
$rs_cal = $db->Execute($sql_cal) or die($db->ErrorMsg());//print $sql_cal;die();
$fecha_cal_inicio_sem1_next=$rs_cal->fields["fecha_cal"];
//--------------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DEL MES NEXT--------------------------------

//----------------------------------------------------------------------------
$sql_usuario = " where usuario='".$_SESSION["user"]."' and n_dpa.cod_dpa=usuario.cod_dpa"; 
$sql_usuario = "select rol,id_usuario, usuario.cod_dpa,prov_mun from usuario,n_dpa".$sql_usuario;	
//print 	$sql_usuario;
$rs_var_estab_usuario = $db->Execute($sql_usuario)or $mensaje=$db->ErrorMsg() ;
$id_usuario=$rs_var_estab_usuario->Fields("id_usuario");
$cod_dpa=$rs_var_estab_usuario->Fields("cod_dpa");
$prov_mun=$rs_var_estab_usuario->Fields("prov_mun");
$rol=$rs_var_estab_usuario->Fields("rol");
$cod_dpa2=substr($rs_var_estab_usuario->Fields("cod_dpa"),0,2);
//print $cod_dpa2;
$mensaje="";
//----------------------------------------------------------------------------
$fecha_base_dia_actual=substr($fecha_base,0,8).date("d");

$hoy=date("Y-m-d");
//---------------------------------------------------	
if(date("m")!=$sel_mes)
{	$fecha_cierre_sem4_8=substr($fecha_base,0,8)."27";
	$sql_cal = "select fecha_cal from calendario where fecha_captar>='$fecha_cierre_sem4_8' and fecha_cal>='$fecha_01_ini3' and fecha_cal<'$fecha_01_fin3'";		
	$rs_cal = $db->Execute($sql_cal)or $mensaje=$db->ErrorMsg();//print $sql_cal;die();
	$fecha_cal = $rs_cal->Fields('fecha_cal');
	$v4=$fecha_cal;
}
//---------------------------------------------------


//---------------------------------------------------	
			 
$sql_cal = "select max(fecha_captar) from calendario ";
if($rol=='admin' || $rol=='super' || $rol=='edito')
    $sql_cal = $sql_cal. " where fecha_cal>='".$sel_fecha_ini."'and fecha_cal<='".$sel_fecha_fin."'";
else 
	$sql_cal = $sql_cal. "where fecha_cal>='".$fecha_01_ini3."'and fecha_cal<='".$hoy."'";	
$rs_cal = $db->Execute($sql_cal)or $mensaje=$db->ErrorMsg();//print $sql_cal;
$fecha_captar = $rs_cal->Fields('max');
//print $sql_cal;
//print $sel_fecha_ini;
//print $sel_fecha_fin;
//print $fecha_captar;
//---------------------------------------------------
 
//print $fecha_cal_inicio_sem1_pasada."  ".$fecha_cal_inicio_sem1_actual;

if($central=="")
$central=0;


$mes=$sel_mes;
if($mes=="01")$fecha_text= "Enero";
if($mes=="02")$fecha_text= "Febrero";
if($mes=="03")$fecha_text= "Marzo";
if($mes=="04")$fecha_text= "Abril";
if($mes=="05")$fecha_text= "Mayo";
if($mes=="06")$fecha_text= "Junio";
if($mes=="07")$fecha_text= "Julio";
if($mes=="08")$fecha_text= "Agosto";
if($mes=="09")$fecha_text= "Septiembre";
if($mes=="10")$fecha_text= "Octubre";
if($mes=="11")$fecha_text= "Noviembre";
if($mes=="12")$fecha_text= "Diciembre";



$mensaje="";


	$magic_quotes = get_magic_quotes_gpc();
	
	if($rol=="admin" || $rol=="super" && $_POST['txt_fecha']!="")
	{$hoy=$_POST['txt_fecha'];}
   
    $sel_mercado = $db->qstr($_POST['sel_mercado'], $magic_quotes);
	$sel_tipologia = $db->qstr($_POST['sel_tipologia'], $magic_quotes);
	$sel_var_estab = $_POST['sel_var_estab'];
	$txt_precio_observado= $_POST['txt_precio_observado'];
	$sel_precio = $db->qstr($_POST['sel_precio'], $magic_quotes);
	$txt_numero_unidades= $_POST['txt_numero_unidades'];
	$sel_unidad = $_POST['sel_unidad'];
	$radio_perm = $_POST['radio_perm'];
	$txt_prec_reg = $_POST['txt_prec_reg'];
	$txt_cant_reg = $_POST['txt_cant_reg'];
	$txt_porc_desc = $_POST['txt_porc_desc'];
	$txt_porc_grat = $_POST['txt_porc_grat'];
	$txt_val_desc = $_POST['txt_val_desc'];
	$sel_obs = $_POST['sel_obs'];
	$sel_inc = $_POST['sel_inc'];
	$municipio=$_POST['municipio'];
	
	//print $txt_precio_observado;
	
//print  $sel_estab;
//----------------------Cambio de Cantidad, Unidades o unidades de medidas -------------------------------------	
	
if($txt_precio_observado!="" && $sel_inc=='1' && ($sel_obs=='4' || $sel_obs=='6') && $sel_var_estab!="")
{//print "dtg".$sel_var_estab;
	 	if($_POST['sel_precio']=="1" && $_POST['txt_numero_unidades']!="" && $_POST['sel_unidad']!="" && $_POST['radio_perm']=="2")
		{
			$sql_sel_cant="select cantidad, id_unidad from n_var_estab where id_var_estab= '".$sel_var_estab."' and fecha_captar>='".$fecha_base."'"; //print $sql_sel_cant;
			$rs_sql_sel_cant=$db->Execute($sql_sel_cant) or die($db->ErrorMsg());
			$cantidad=$rs_sql_sel_cant->Fields("cantidad");			
		    $um=$rs_sql_sel_cant->Fields("id_unidad");
			//print $cantidad;
			//print $um;
			//print $sel_unidad;
			if($um!= $sel_unidad  && $um!='1' && $sel_unidad!='4' && $sel_unidad!='1' && $um!='4')
			{
			 
			$sql_sel_corr="select factor from n_correlacionador where id_unidad_p='".$sel_unidad."' and id_unidad_g='".$um."'"; //print $sql_sel_corr;
			$rs_sql_sel_corr=$db->Execute($sql_sel_corr) or die($db->ErrorMsg());
			$factor=$rs_sql_sel_corr->Fields("factor");
			
			$cantidad= bcmul($factor,$txt_numero_unidades,14);	
			//print $factor;
			//print $cantidad ;	
			}  
			
			$div=bcdiv($txt_precio_observado,$txt_numero_unidades,14); 
			$precio=bcmul($div,$cantidad,14);//print $precio;

			$sql_ins_cap="INSERT INTO captacion (id_usuario,id_var_estab,id_obs,fecha,precio,id_inc) 
			VALUES ('".$id_usuario."','".$sel_var_estab."','".$sel_obs."','".$hoy."','".$precio."','".$sel_inc."')";
			//print $sql_ins_cap;
			$rs_sql_ins_cap=$db->Execute($sql_ins_cap) or $mensaje.=$db->ErrorMsg() ; 	
			$mensaje="Guardado satisfactoriamente.";
			
			if($rs_sql_ins_cap)
			{
			$gestor = @fopen($camino, "a");
				if ($gestor) 
				{
				   if (fwrite($gestor, $sql_ins_cap.";\r\n") === FALSE) 
					{
						echo "No se puede escribir al archivo.";
						exit;
					}
					fclose($gestor);
				}
			}		
		}
//----------------------Cambio de Cantidad, Unidades o unidades de medidas-----------------------------	
		else if($_POST['sel_precio']=="1" && $_POST['txt_numero_unidades']!="" &&  $_POST['radio_perm']=="1" && $_POST['sel_unidad']!="")
		{
			$sql_sel_cant="select  cantidad,id_unidad from n_var_estab where id_var_estab= ".$sel_var_estab." and fecha_captar>='".$fecha_base."'";//print $sql_sel_cant;			
			$rs_sql_sel_cant=$db->Execute($sql_sel_cant) or die($db->ErrorMsg());
			$cantidad=$rs_sql_sel_cant->Fields("cantidad");
			$um=$rs_sql_sel_cant->Fields("id_unidad");	
			
			//print "cantidad:".$cantidad;
			//print "um:".$um;
			$sql_sel_precio="select precio, id_cap from captacion, n_var_estab where captacion.id_var_estab=n_var_estab.id_var_estab and captacion.id_var_estab= '".$sel_var_estab."' and fecha<='".$fecha_01_fin1."' and fecha>='".$fecha_01_ini1."'";//print $sql_sel_precio;			
			$rs_sql_sel_precio=$db->Execute($sql_sel_precio) or die($db->ErrorMsg());
			$valor=$rs_sql_sel_precio->Fields("precio");
			$id_cap=$rs_sql_sel_precio->Fields("id_cap");
			//print "precio:".$valor;
			//print "id_cap:".$id_cap;
			if($valor!='')	
			{		
			$sql_ins_cap_s_m ="INSERT INTO cap_s_m (id_cap,id_usuario,precio_s_m,fecha_m,cant_s_m,id_unidad_s_m) 
			VALUES ('".$id_cap."','".$id_usuario."','".$valor."','".$hoy."','".$cantidad."','".$um."')"; //print $sql_ins_cap_s_m;
			$rs_sql_ins_cap_s_m=$db->Execute($sql_ins_cap_s_m) or die($db->ErrorMsg()) ;
				 
				if($rs_sql_ins_cap_s_m)
				{
					$gestor = @fopen($camino, "a");
					if ($gestor) 
					{
					   
					   if (fwrite($gestor, $sql_ins_cap_s_m.";\r\n") === FALSE) 
						{
							echo "No se puede escribir al archivo.";
							exit;
						}
						fclose($gestor);
					}
	
				}	
				
			
			if($um!= $sel_unidad  && $um!='1' && $sel_unidad!='4' && $sel_unidad!='1' && $um!='4')
			{
			 
			$sql_sel_corr="select factor from n_correlacionador where id_unidad_p='".$sel_unidad."' and id_unidad_g='".$um."'"; //print $sql_sel_corr;
			$rs_sql_sel_corr=$db->Execute($sql_sel_corr) or die($db->ErrorMsg());
			$factor=$rs_sql_sel_corr->Fields("factor");
			
			$cantidad= bcmul ($factor,$txt_numero_unidades,14);	
			print $factor;
			//print $cantidad ;
			$sql_upd_um="Update n_var_estab SET id_unidad ='".$sel_unidad."' WHERE id_var_estab='".$sel_var_estab."'";
			//print $sql_upd_um;
			$rs_upd_um= $db->Execute($sql_upd_um) or die($db->ErrorMsg());	
			$mensaje="Guardado satisfactoriamente.";
			
			if($sql_upd_um)
			{
			$gestor = @fopen($camino, "a");
				if ($gestor) 
				{
				   
				   if (fwrite($gestor, $sql_upd_um.";\r\n") === FALSE) 
					{
						echo "No se puede escribir al archivo.";
						exit;
					}
					fclose($gestor);
				}
			}
			$sql_upd_cant="Update n_var_estab SET cantidad= '".$txt_numero_unidades."' WHERE id_var_estab='".$sel_var_estab."'";
			//print $sql_upd_cant;
			$rs_upd_cant= $db->Execute($sql_upd_cant) or die($db->ErrorMsg());	
			$mensaje="Guardado satisfactoriamente.";
			
			if($rs_upd_cant)
			{
			$gestor = @fopen($camino, "a");
				if ($gestor) 
				{
				   
				   if (fwrite($gestor, $sql_upd_cant.";\r\n") === FALSE) 
					{
						echo "No se puede escribir al archivo.";
						exit;
					}
					fclose($gestor);
				}
			}
			$sql_upd_uni="Update n_var_estab SET id_unidad= '".$sel_unidad."' WHERE id_var_estab='".$sel_var_estab."'";
			//print $sql_upd_cant;
			$rs_upd_uni= $db->Execute($sql_upd_uni) or die($db->ErrorMsg());	
			$mensaje="Guardado satisfactoriamente.";
			
			if($rs_upd_uni)
			{
			$gestor = @fopen($camino, "a");
				if ($gestor) 
				{
				   
				   if (fwrite($gestor, $sql_upd_uni.";\r\n") === FALSE) 
					{
						echo "No se puede escribir al archivo.";
						exit;
					}
					fclose($gestor);
				}
			}
			}  
			//print $valor;
			//print $cantidad;
			//print $txt_numero_unidades;
			if($valor!='0'&& $cantidad!='0')
			{
			$div=bcdiv($valor,$cantidad,14);
			$pre_ant=bcmul($div,$txt_numero_unidades,14); 
			
			
			$sql_upd_cant_n_var_estab="Update n_var_estab SET cantidad= '".$txt_numero_unidades."' WHERE id_var_estab='".$sel_var_estab."'";
			//print $sql_upd_cant_n_var_estab;
			$rs_upd_cant_n_var_estab= $db->Execute($sql_upd_cant_n_var_estab) or die($db->ErrorMsg());
			
			$mensaje="Guardado satisfactoriamente.";
			
			if($sql_upd_cant_n_var_estab)
			{
			$gestor = @fopen($camino, "a");
				if ($gestor) 
				{
				   
				   if (fwrite($gestor, $sql_upd_cant_n_var_estab.";\r\n") === FALSE) 
					{
						echo "No se puede escribir al archivo.";
						exit;
					}
					fclose($gestor);
				}
			}
			
			$sql_upd_uni_n_var_estab="Update n_var_estab SET id_unidad= '".$sel_unidad."' WHERE id_var_estab='".$sel_var_estab."'";
			//print $sql_upd_cant_n_var_estab;
			$rs_upd_uni_n_var_estab= $db->Execute($sql_upd_uni_n_var_estab) or die($db->ErrorMsg());
			
			$mensaje="Guardado satisfactoriamente.";
			
			if($sql_upd_uni_n_var_estab)
			{
			$gestor = @fopen($camino, "a");
				if ($gestor) 
				{
				   
				   if (fwrite($gestor, $sql_upd_uni_n_var_estab.";\r\n") === FALSE) 
					{
						echo "No se puede escribir al archivo.";
						exit;
					}
					fclose($gestor);
				}
			}	 
			$sql_upd_cap="UPDATE captacion SET precio ='".$pre_ant."' 
			WHERE id_var_estab=".$sel_var_estab."and fecha<='".$fecha_01_fin1."' and fecha>='".$fecha_01_ini1."'";
			//print $sql_upd_cap;
			$rs_sql_upd_cap= $db->Execute($sql_upd_cap) or die($db->ErrorMsg());
			
				if($rs_sql_upd_cap)
				{
					$gestor = @fopen($camino, "a");
					if ($gestor) 
					{
					   
					   if (fwrite($gestor, $sql_upd_cap.";\r\n") === FALSE) 
						{
							echo "No se puede escribir al archivo.";
							exit;
						}
						fclose($gestor);
					}
				}	
			$sql_ins_cap="INSERT INTO captacion (id_usuario,id_var_estab,id_obs,fecha,precio,id_inc) 
			VALUES ('".$id_usuario."','".$sel_var_estab."','".$sel_obs."','".$hoy."','".$txt_precio_observado."','".$sel_inc."')";//print $sql_ins_cap;
			$rs_sql_ins_cap=$db->Execute($sql_ins_cap) or $mensaje.=$db->ErrorMsg() ; 	
			$mensaje="Guardado satisfactoriamente.";
			
			if($rs_sql_ins_cap)
			{
			$gestor = @fopen($camino, "a");
				if ($gestor) 
				{
				   
				   if (fwrite($gestor, $sql_ins_cap.";\r\n") === FALSE) 
					{
						echo "No se puede escribir al archivo.";
						exit;
					}
					fclose($gestor);
				}
			}
		
		}
		}
		else
		$mensaje="No hay captaciones anteriores de este municipio o el precio anterior es 0"; 			 
	}
//----------------------Cambio de Cantidad, Unidades o unidades de medidas-------------------------------------	

		else if($_POST['sel_precio']=="1")
		{
		
		if($_POST['txt_numero_unidades']=="" && $_POST['sel_unidad']=="" && $_POST['radio_perm']!="2" && $_POST['radio_perm']!="1"&& $_POST['sel_unidad']=="")
			$mensaje="Existen campos vacios.";
			
					
			elseif($_POST['txt_numero_unidades']=="")
			$mensaje="Debe llenar la cantidad.";
			
			elseif($_POST['sel_unidad']=="")
			$mensaje="Debe llenar la unidad de medida.";
			
			if($_POST['radio_perm']!="2" && $_POST['radio_perm']!="1")
			$mensaje="Debe marcar si la presentacion permanecerá";						
		}
		
 //----------------------Variedad de regalo-------------------------------------
	    else if ($_POST['sel_precio']=="2" && $_POST['txt_prec_reg']!="")
	    {
			$mitad=bcdiv($txt_prec_reg,2,14);
			$precio=bcsub($txt_precio_observado,$mitad,14);
			
			$sql_ins_cap="INSERT INTO captacion (id_usuario,id_var_estab,id_obs,fecha,precio,id_inc) 
			VALUES ('".$id_usuario."','".$sel_var_estab."','".$sel_obs."','".$hoy."','".$precio."','".$sel_inc."')";//print $sql_ins_cap;
			$rs_sql_ins_cap=$db->Execute($sql_ins_cap) or $mensaje.=$db->ErrorMsg() ; 	
			$mensaje="Guardado satisfactoriamente.";
			
			if($rs_sql_ins_cap)
			{
			$gestor = @fopen($camino, "a");
				if ($gestor) 
				{
				   
				   if (fwrite($gestor, $sql_ins_cap.";\r\n") === FALSE) 
					{
						echo "No se puede escribir al archivo.";
						exit;
					}
					fclose($gestor);
				}
			}
	    }
//----------------------Variedad de regalo-------------------------------------
		
		else if($_POST['sel_precio']=="2")
		{
		   if($_POST['txt_prec_reg']=="")
		     $mensaje="Debe llenar precio del regalo.";
		}
	   //----------------------Cambio de cantidad como regalo---------------------------------
	    else if ($_POST['sel_precio']=="3" && $_POST['txt_cant_reg']!="")
	    {
			$sql_sel_cant="select cantidad from n_var_estab where id_var_estab= ".$sel_var_estab." and fecha_captar>='".$fecha_base."'";
			$rs_sql_sel_cant=$db->Execute($sql_sel_cant) or die($db->ErrorMsg());
			$cantidad=$rs_sql_sel_cant->Fields("cantidad");
			
			$sum=bcadd($cantidad,$txt_cant_reg,14);
			$divid=bcdiv($txt_precio_observado,$sum,14);
			$precio=bcmul($divid,$cantidad,14);		
			
			$sql_ins_cap="INSERT INTO captacion (id_usuario,id_var_estab,id_obs,fecha,precio,id_inc) 
			VALUES ('".$id_usuario."','".$sel_var_estab."','".$sel_obs."','".$hoy."','".$precio."','".$sel_inc."')";print $sql_ins_cap;
			$rs_sql_ins_cap=$db->Execute($sql_ins_cap) or $mensaje.=$db->ErrorMsg() ; 	
			$mensaje="Guardado satisfactoriamente.";
			
			if($rs_sql_ins_cap)
			{
			$gestor = @fopen($camino, "a");
				if ($gestor) 
				{
				   
				   if (fwrite($gestor, $sql_ins_cap.";\r\n") === FALSE) 
					{
						echo "No se puede escribir al archivo.";
						exit;
					}
					fclose($gestor);
				}
			}
	    }
//----------------------Cambio de cantidad como regalo---------------------------------
		
		else if($_POST['sel_precio']=="3")
		{
		    if($_POST['txt_cant_reg']=="")
		    $mensaje="Debe llenar la cantidad del regalo.";
		}
//----------------------Porcentaje como regalo---------------------------------
	    else if ($_POST['sel_precio']=="4" && $_POST['txt_porc_grat']!="")
	    {
			$sql_sel_cant="select cantidad from n_var_estab where id_var_estab= ".$sel_var_estab." and fecha_captar>='".$fecha_base."'"; //print $sql_sel_cant;		
			$rs_sql_sel_cant=$db->Execute($sql_sel_cant) or die($db->ErrorMsg());
			$cantidad=$rs_sql_sel_cant->Fields("cantidad");
			
			$porc=bcdiv($txt_porc_grat,100,14);
			$sum=bcadd(1,$porc,14);
			$precio=bcdiv($txt_precio_observado,$sum,14);	
			
			$sql_ins_cap="INSERT INTO captacion (id_usuario,id_var_estab,id_obs,fecha,precio,id_inc) 
			VALUES ('".$id_usuario."','".$sel_var_estab."','".$sel_obs."','".$hoy."','".$precio."','".$sel_inc."')";//print $sql_ins_cap;
			$rs_sql_ins_cap=$db->Execute($sql_ins_cap) or $mensaje.=$db->ErrorMsg() ; 	
			$mensaje="Guardado satisfactoriamente.";
			
			if($rs_sql_ins_cap)
			{
			$gestor = @fopen($camino, "a");
				if ($gestor) 
				{
				   
				   if (fwrite($gestor, $sql_ins_cap.";\r\n") === FALSE) 
					{
						echo "No se puede escribir al archivo.";
						exit;
					}
					fclose($gestor);
				}
			}	
	    }
//----------------------Porcentaje como regalo---------------------------------	
		else if($_POST['sel_precio']=="4")
		{
		    if($_POST['txt_porc_grat']=="")
		    $mensaje="Debe llenar el porciento del regalo.";
		}
//----------------------Valor absoluto de descuento----------------------------------	 
	    else if ($_POST['sel_precio']=="5" && $_POST['txt_val_desc']!="")
		{
			$precio=bcsub($txt_precio_observado,$txt_val_desc,14); 
			$sql_ins_cap="INSERT INTO captacion (id_usuario,id_var_estab,id_obs,fecha,precio,id_inc) 
			VALUES ('".$id_usuario."','".$sel_var_estab."','".$sel_obs."','".$hoy."','".$precio."','".$sel_inc."')";//print $sql_ins_cap;
			$rs_sql_ins_cap=$db->Execute($sql_ins_cap) or $mensaje.=$db->ErrorMsg() ; 	
			$mensaje="Guardado satisfactoriamente.";
			
			if($rs_sql_ins_cap)
			{
			$gestor = @fopen($camino, "a");
				if ($gestor) 
				{
				   
				   if (fwrite($gestor, $sql_ins_cap.";\r\n") === FALSE) 
					{
						echo "No se puede escribir al archivo.";
						exit;
					}
					fclose($gestor);
				}
			}
		}
//----------------------Valor absoluto de descuento----------------------------------		
		else if($_POST['sel_precio']=="5")
		{
		    if($_POST['txt_val_desc']=="")
		    $mensaje="Debe llenar el valor de descuento.";
		}
//----------------------Porcentaje de descuento----------------------------------	-
		
	    elseif ($_POST['sel_precio']=="6" && $_POST['txt_porc_desc']!="")
	    {		
			$porc=bcdiv($txt_porc_desc,100,14);
			$resta=bcsub(1,$porc,14);
			$precio=bcmul($resta,$txt_precio_observado,14); 
			
			$sql_ins_cap="INSERT INTO captacion (id_usuario,id_var_estab,id_obs,fecha,precio,id_inc) 
			VALUES ('".$id_usuario."','".$sel_var_estab."','".$sel_obs."','".$hoy."','".$precio."','".$sel_inc."')";//print $sql_ins_cap;
			$rs_sql_ins_cap=$db->Execute($sql_ins_cap) or $mensaje.=$db->ErrorMsg() ; 	
			$mensaje="Guardado satisfactoriamente.";
			
			if($rs_sql_ins_cap)
			{
			$gestor = @fopen($camino, "a");
				if ($gestor) 
				{
				   
				   if (fwrite($gestor, $sql_ins_cap.";\r\n") === FALSE) 
					{
						echo "No se puede escribir al archivo.";
						exit;
					}
					fclose($gestor);
				}
			}
		}
//----------------------Porcentaje de descuento----------------------------------------------	
		elseif($_POST['sel_precio']=="6")
		{
		    if($_POST['txt_porc_desc']=="")
		    $mensaje="Debe llenar el porciento de descuento.";
		}
//----------------------Precio Disponible----------------------------------------------------		
		elseif($_POST['sel_precio']=="0")
		{
		$sql_ins_cap="INSERT INTO captacion (id_usuario,id_var_estab,id_obs,fecha,precio,id_inc) 
	VALUES ('".$id_usuario."','".$sel_var_estab."','".$sel_obs."','".$hoy."','".$precio."','".$sel_inc."')";
	//print $sql_ins_cap;
	$rs_sql_ins_cap=$db->Execute($sql_ins_cap) or $mensaje.=$db->ErrorMsg() ; 	
	//$mensaje="Guardado satisfactoriamente.";
	
	if($rs_sql_ins_cap)
	{
	$gestor = @fopen($camino, "a");
		if ($gestor) 
		{
		   
		   if (fwrite($gestor, $sql_ins_cap.";\r\n") === FALSE) 
			{
				echo "No se puede escribir al archivo.";
				exit;
			}
			fclose($gestor);
		}
	}
	}	
//------------------------------------------------------------------------------------------	
			 		   
}
else if($sel_inc=!"1" && $sel_var_estab!=0)
{

	$sql_ins_cap="INSERT INTO captacion (id_usuario,id_var_estab,id_obs,fecha,precio,id_inc) 
	VALUES ('".$id_usuario."','".$sel_var_estab."','1','".$hoy."','".$precio."','".$sel_inc."')";//print $sql_ins_cap;
	$rs_sql_ins_cap=$db->Execute($sql_ins_cap) or $mensaje.=$db->ErrorMsg() ; 	
	//$mensaje="Guardado satisfactoriamente.";
	
	if($rs_sql_ins_cap)
	{
	$gestor = @fopen($camino, "a");
		if ($gestor) 
		{
		   if (fwrite($gestor, $sql_ins_cap.";\r\n") === FALSE) 
			{
				echo "No se puede escribir al archivo.";
				exit;
			}
			fclose($gestor);
		}
	}
}
elseif($sel_inc=='1' && ($sel_obs=='2' || $sel_obs=='3' || $sel_obs=='5') && $sel_var_estab!='0')
{ 
	$sql_ins_cap="INSERT INTO captacion (id_usuario,id_var_estab,id_obs,fecha,precio,id_inc) 
	VALUES ('".$id_usuario."','".$sel_var_estab."','".$sel_obs."','".$hoy."','".$precio."','".$sel_inc."')";print $sql_ins_cap;
	$rs_sql_ins_cap=$db->Execute($sql_ins_cap) or $mensaje.=$db->ErrorMsg() ; 	
	$mensaje="Guardado satisfactoriamente.";
	
	if($rs_sql_ins_cap)
	{
	$gestor = @fopen($camino, "a");
		if ($gestor) 
		{
		   
		   if (fwrite($gestor, $sql_ins_cap.";\r\n") === FALSE) 
			{
				echo "No se puede escribir al archivo.";
				exit;
			}
			fclose($gestor);
		}
	}




		
//------hecho por katia--------- 	
	
	
/*	if($_POST['sel_var_estab']!='' && $_POST['sel_mercado']!='' && $_POST['txt_precio_observado']!='' && $_POST['sel_estab']!='' && $_POST['sel_obs']!='' && $_POST['sel_inc']!='' && $_POST['sel_precio']!='' && $_POST['sel_tipologia']!='')
	{
	 $sql_ins_cap="INSERT INTO captacion (id_usuario,id_var_estab,id_obs,fecha,precio,id_inc) 
	 VALUES ('".$id_usuario."',".$sel_var_estab.",".$sel_obs.",'".$hoy."','".$precio."',".$sel_inc.")";//print $sql_ins_cap;
	 $rs_sql_ins_cap=$db->Execute($sql_ins_cap) or $mensaje.=$db->ErrorMsg() ; 	
	 $mensaje="Guardado satisfactoriamente."
	
	if($rs_sql_ins_cap)
	{
	$gestor = @fopen($camino, "a");
		if ($gestor) 
		{
		   
		   if (fwrite($gestor, $sql_ins_cap.";\r\n") === FALSE) 
			{
				echo "No se puede escribir al archivo.";
				exit;
			}
			fclose($gestor);
		}
	}
  	    
	 		//if($mensaje=="")
			// $mensaje="El dato ha sido insertado satisfactoriamente.";
					 	
	}
	else				
		$mensaje="Existen campos vacíos.";




print $sel_estab; 
print $sel_mercado;
print $sel_tipologia;
print $_POST['municipio'];*/
}		
?>

<html><!-- InstanceBegin template="/Templates/Template.dwt.php" codeOutsideHTMLIsLocked="false" --> 
<head>  

<!--  
*** Plataforma en Software Libre PHP, PostGreSQL
*** Realizado por Ing. Raydel Ojeda Figueroa 
   --> 
<!-- InstanceBeginEditable name="doctitle" --> 
<title>IPC</title>
<!-- InstanceEndEditable --> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- InstanceBeginEditable name="head" --> <!-- InstanceEndEditable --> 

<?php if($_SESSION["estilo"]=="g"){?>
<link href="../../css/gris.css" rel="stylesheet" type="text/css"> 
<?php }elseif($_SESSION["estilo"]=="v"){?>
<link href="../../css/verde.css" rel="stylesheet" type="text/css"> 
<?php } else {?>
<link href="../../css/azul.css" rel="stylesheet" type="text/css"> 
<?php }?>
<link rel="stylesheet" href="../../css/theme.css" type="text/css" />
<link rel="shortcut icon" href="../../imagenes/flecha.ico"/> 
<link rel="stylesheet" type="text/css" href="../../css/resources/css/ext-all.css" />
</head> 

<script type="text/javascript" src="../../javascript/yui/yui-utilities.js"></script>  
<script type="text/javascript" src="../../javascript/yui/ext-yui-adapter.js"></script>
<script language="javascript" src="../../javascript/yui/ext-all.js"></script>

<script language="JavaScript" src="../../javascript/JSCookMenu_mini.js" type="text/javascript"></script> 
<script language="JavaScript" src="../../javascript/theme.js" type="text/javascript"></script>
<script language="javascript" src="../../javascript/cal2.js"></script>
<script language="javascript" src="../../javascript/cal_conf2.js"></script>
<script language="javascript" src="../../javascript/overlib_mini.js"></script>

<script src="../../javascript/funciones.js" type="text/javascript">
</script> 
<body> 
<table width="750"  border="1"  align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td>

<table width="750" border="0"  align="center" cellpadding="0" cellspacing="0" >
<tr> 
          <td><img src="../../imagenes/banner.jpg" width="750" height="35"></td>
  </tr>
  <tr>
   
   
   <table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
<tr>
	<td style="padding-left:5px;">
	
				<div id="myMenuID"></div>
		<?php 

if ($_SESSION["rol"] == 'autor')//autor municipal 
{
?>
<script language="javascript"  src="../../javascript/menu_autor_m.js">	
		</script>
<?php
}
elseif($_SESSION["rol"] == 'aut_p')
{
?>
		<script language="javascript"  src="../../javascript/menu_autor_p.js">	
		</script>
<?php
}
elseif($_SESSION["rol"] == 'edito')
{
?>
	<script language="javascript"  src="../../javascript/menu_editor.js">	
		</script>
<?php
}
elseif($_SESSION["rol"] == 'admin')
{
?>
	<script language="javascript"  src="../../javascript/menu_admin.js">	
		</script>
        
<?php
}
elseif($_SESSION["rol"] == 'super')
{
?>
	<script language="javascript"  src="../../javascript/menu_super.js">	
		</script>
        
<?php
}
elseif($_SESSION["rol"] == 'jefes')
{
?>
	<script language="javascript"  src="../../javascript/menu_jefes.js">	
		</script>


<?php
} else
{
?>
<script language="javascript"  src="../../javascript/menu_invitado.js">	
		</script>
<?php
} 
?>
	</td>
	
	<td  class="intro_sup" valign="middle" align="right" >
		<a class="intro_sup" onMouseOver="return overlib('<?php if($_SESSION["rol"]=="admin")print "Administrador";
																elseif($_SESSION["rol"]=="super")print "Súper Administrador";
																elseif($_SESSION["rol"]=="edito")print "Editor-ONE";
																elseif($_SESSION["rol"]=="autor")print "Autor Municipal";
																elseif($_SESSION["rol"]=="aut_p")print "Autor Provincial";										
																elseif($_SESSION["rol"]=="jefes")print "Directivo";
																elseif($_SESSION["rol"]=="invit")print "Invitado";
		?>', ABOVE, RIGHT);" onMouseOut="return nd();"href="../../php/logout.php" style="color: #333333; font-weight: bold"><?php print $_SESSION["user"];?>&nbsp;<img style="vertical-align:bottom"  border="0"src="../../imagenes/extrasmall/exit.gif">
			&nbsp; </a>
	</td>
</tr>
</table>
   
   
   
  </tr>
  <tr>
          <td align="center" valign="middle" bgcolor="#ffffff"><!-- InstanceBeginEditable name="Body" -->  
               <form method="post" name="frm" id="frm" >
              <div align="center"> 
              <table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
<tr> 
                    <td class="menudottedline" align="right">
                <table width="100%" border="0" class="menubar"  id="toolbar"> 
                        <tr > 
                         <td width="4%" valign="middle"  class="us"> <img src="../../imagenes/admin/news.png" width="48" height="48" border="0" /><strong><font color="#000000" size="1" >
                          </font></strong></td>
                        <td width="71%" valign="middle"  class="us"><strong><font color="#5A697E" size="2">Captación de precios no centralizadas                          
                          <?php if($rol!="admin" && $rol!="super" && $rol!='edito')echo "de ".$prov_mun;?>
                          </font></strong>
                        </td>
                        <td width="9%"> 
                          <div align="center"> <a class="toolbar" > 
                            <input type="image"  name="btn_save" id="btn_save"   src="../../imagenes/admin/save_f2.png" alt="Guardar" width="32" height="32" border="0"/>
                            <br />
                            <label>Guardar</label>
                            </a> </div></td>
                        <td width="9%"> 
                          <div align="center"> <a class="toolbar" href="<?php if($_GET['locat']!="")
{
print $_GET['locat'];
}else print "l_datos_p.php";?>">  
                            <img src="../../imagenes/admin/cancel_f2.png" alt="Cerrar" name="imageField2" width="32" height="32" border="0" id="imageField2" /> 
                            <br />
                          Cancelar</a> </div></td>
                        <td width="7%"> 
                          <div align="center"><a class="toolbar" href="#" onClick="window.open('help/n_captaciones.htm', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                            <img src="../../imagenes/admin/help_f2.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" id="help" /><br />
                          Ayuda</a></div></td>
                        </tr>
                        
                    </table> 
                  </td></tr></table>
                <br>
  <table width="562" height="60"  align="center" cellpadding="0" cellspacing="0"  class="tabla" id="toolbar1">              
              <tr align="center" valign="middle"> 
                    <td width="560" height="50" colspan="21"  >
                    
                      <table width="92%"  align="center" height="27" border="0" cellpadding="0" cellspacing="0" class="filtro" > 

  
                       
                       <tr>
                       
                       <td height="18" colspan="4"  align="right" valign="middle"  > <?php if($rol=='admin' || $rol=='super' || $rol=='edito'){?></td>
                          <td height="23" colspan="2"  align="right" valign="middle"  ><div align="left">&nbsp;<?php if($fecha_captar){?>Autorizado a captar:
    <b><?php $today=substr($fecha_captar,8,9);echo $array[$today-1]." (".$array2[$today-1].")";?></b><?php }?></div></td>
                          <td width="26" height="27"><div align="right">Mes:</div></td>
                          <td colspan="2"><select name="sel_mes" id="sel_mes" onChange="javascript:document.frm.submit();">
                              <option value="0">-----Seleccionar-----</option>
                              <option <?php if($sel_mes=="01")print "selected";?> value="01">Enero</option>
                              <option <?php if($sel_mes=="02")print "selected";?> value="02">Febrero</option>
                              <option <?php if($sel_mes=="03")print "selected";?> value="03">Marzo</option>
                              <option <?php if($sel_mes=="04")print "selected";?> value="04">Abril</option>
                              <option <?php if($sel_mes=="05")print "selected";?> value="05">Mayo</option>
                              <option <?php if($sel_mes=="06")print "selected";?> value="06">Junio</option>
                              <option <?php if($sel_mes=="07")print "selected";?> value="07">Julio</option>
                              <option <?php if($sel_mes=="08")print "selected";?> value="08">Agosto</option>
                              <option <?php if($sel_mes=="09")print "selected";?> value="09">Septiembre</option>
                              <option <?php if($sel_mes=="10")print "selected";?> value="10">Octubre</option>
                              <option <?php if($sel_mes=="11")print "selected";?> value="11">Noviembre</option>
                              <option <?php if($sel_mes=="12")print "selected";?> value="12">Diciembre</option>
                            </select>                         </td>
                          <td width="27"  align="center"><div align="right">A&ntilde;o:</div></td>
                          <td width="68"  align="center"> 
                              <select name="sel_ano" id="sel_ano" onChange="javascript:document.frm.submit();">
                                <option value="0">------</option>
                                <?php 
						  $anno=date("Y");
						  for($i=4;$i>=0;$i--){?>
                                <option <?php if($sel_ano==$anno-$i)print "selected";?>><?php print $anno-$i;?></option>
                                <?php }?>
                              </select>
                          </td>
                          <?php }?>
                       </tr>
		
          </table>
                   <table  class="filtro" width="100%" align="center">
               
               <?php if($fecha_captar){?>
             
                <tr>
                  <td height="19" align="right">&nbsp;</td>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr> 
                 <td height="19" align="right">Mercado:</td>
                  <td colspan="2"><div align="left">
                      <select name="sel_mercado" title="Mercado" id="sel_mercado" onChange="document.frm.submit();" >
                        <option value="0">-----Seleccionar-----</option>
                        <?php  
					  	
                    	 $query_mercado = "select distinct n_mercado.id_mercado, mercado
						 from n_mercado, n_var_estab,b_variedad, n_estab, n_variedad
						 WHERE n_mercado.id_mercado=b_variedad.id_mercado 
						 and n_var_estab.idb_variedad=b_variedad.idb_variedad 
						 and n_estab.id_estab=n_var_estab.id_estab 
						 and b_variedad.id_variedad=n_variedad.id_variedad
						 and central='0'
						 AND fecha='".$fecha_base."' 
						 and fecha_captar<='".$fecha_captar."'";
						 //print	$query_mercado;
						 if($rol=="autor")
						 $query_mercado=$query_mercado." and n_estab.cod_dpa='".$cod_dpa."'";
						 if($rol=="aut_p")
						 $query_mercado=$query_mercado." and n_estab.cod_dpa like'".$cod_dpa2."%'";
						 
						 $query_mercado=$query_mercado." order by mercado";
						  //print	$query_mercado;
						 $rs_mercado=$db->Execute($query_mercado) or $mensaje=$db->ErrorMsg() ;
					  //print $query_mercado;
					  //else $_POST['sel_mercado']=""; 
					  if($rs_mercado->Fields("mercado")!="") 
						{
							$cant_rs=$rs_mercado->RecordCount();
 							for ($i = 0; $i < $cant_rs;$i++)
							{
							$rs_fields0=$rs_mercado->Fields("mercado");
							$rs_fields1="";
							$rs_fields_id=$rs_mercado->Fields("id_mercado");
							$id=$_POST['sel_mercado'];//print $rs_fields_id;	
							
							echo"<option value=";echo $rs_fields_id;if($rs_fields_id==$id){echo " selected ";} echo "> "; if($rs_fields1){echo $rs_fields1; print ". ";}echo $rs_fields0; echo "</option>";
							
        					$rs_mercado->MoveNext();
							}						
					   }                 
							
					?></select>
                   
                    (*) </div></td>
                </tr>
                <tr>
                  <td height="8" align="right">Tipolog&iacute;a:</td>
                  <td colspan="2"><select name="sel_tipologia" title="Tipología" id="sel_tipologia" onChange="document.frm.submit();">
                    <option value="0">-----Seleccionar-----</option>
                    <?php 
						
						if($_POST['sel_mercado']!=0 && $_POST['sel_mercado']!="")
						{
                    	 $query_tipologia = "select distinct tipologia, n_tipologia.id_tipologia
						 from n_tipologia, n_estab, n_var_estab,b_variedad, n_variedad
						 WHERE n_tipologia.id_tipologia=n_estab.id_tipologia  
						 and n_var_estab.idb_variedad=b_variedad.idb_variedad 
						 and n_estab.id_estab=n_var_estab.id_estab AND fecha='".$fecha_base."'
						 and n_estab.id_mercado='".$_POST['sel_mercado']."' 
						 and b_variedad.id_variedad=n_variedad.id_variedad
						 and central='0'
     					 and fecha_captar<='".$fecha_captar."'";					 
						 
						 if($rol=="autor")
						 $query_tipologia=$query_tipologia." and n_estab.cod_dpa='".$cod_dpa."'";
						 if($rol=="aut_p")
						 $query_tipologia=$query_tipologia." and n_estab.cod_dpa like'".$cod_dpa2."%'";
						 
						 $query_tipologia=$query_tipologia." order by tipologia";				 						//print $query_tipologia;
						 $rs_tipologia=$db->Execute($query_tipologia) or die($db->ErrorMsg()) ;
					     
						 $cant_rs_tipologia=$rs_tipologia->RecordCount();
 							for ($t = 0; $t < $cant_rs_tipologia;$t++)
							{
							$rs_fields0=$rs_tipologia->Fields("tipologia");
							$rs_fields1="";
							$rs_fields_id=$rs_tipologia->Fields("id_tipologia");
							$id_tipologia=$_POST['sel_tipologia'];	
							
							echo"<option value=";echo $rs_fields_id;if($rs_fields_id==$id_tipologia){echo " selected ";} echo "> "; if($rs_fields1){echo $rs_fields1; print ". ";}echo $rs_fields0; echo "</option>";
							
							$rs_tipologia->MoveNext();
							}	 
						} 			
					 ?>
                  </select>
(*) </td>
                </tr>
                 <?php  if($rol=="admin" || $rol=="super" || $rol=="edito"){?>
                
                <tr align="center">
                  <td height="14"><div align="right">Provincia:</div></td>
                  <td height="14" colspan="2"><div align="left">
                      <select name="provincia" id="provincia" title="Provincias" onChange="javascript: fil_comboBox(document.frm.municipio,this.options[this.selectedIndex].value)">
                        <option value="0" selected="selected">-----Seleccionar-----</option>
                        <option <?php if($_POST['provincia']==1)print "selected";?> value="1">2108. Pinar del R&iacute;o</option>
                        <option <?php if($_POST['provincia']==2)print "selected";?> value="2">2200. Artemisa</option>
                        <option <?php if($_POST['provincia']==3)print "selected";?> value="3">2300. 
La Habana</option>
                        <option <?php if($_POST['provincia']==4)print "selected";?> value="4">2400. 
Mayabeque</option>
                        <option <?php if($_POST['provincia']==5)print "selected";?> value="5">2500. Matanzas</option>
                        <option <?php if($_POST['provincia']==6)print "selected";?> value="6">2600. Villa Clara</option>
                        <option <?php if($_POST['provincia']==7)print "selected";?> value="7">2700. Cienfuegos</option>
                        <option <?php if($_POST['provincia']==8)print "selected";?> value="8">2800. Sancti Sp&iacute;ritus</option>
                        <option <?php if($_POST['provincia']==9)print "selected";?> value="9">2900. Ciego de Avila</option>
                        <option <?php if($_POST['provincia']==10)print "selected";?> value="10">3000. Camag&uuml;ey</option>
                        <option <?php if($_POST['provincia']==11)print "selected";?> value="11">3100. Las Tunas</option>
                        <option <?php if($_POST['provincia']==12)print "selected";?> value="12">3200. Holgu&iacute;n</option>
                        <option <?php if($_POST['provincia']==13)print "selected";?> value="13">3300. Granma</option>
                        <option <?php if($_POST['provincia']==14)print "selected";?> value="14">3400. Santiago de Cuba</option>
                        <option <?php if($_POST['provincia']==15)print "selected";?> value="15">3500. Guant&aacute;namo</option>
                        <option <?php if($_POST['provincia']==16)print "selected";?> value="16">4000. Isla de la juventud</option>
                      </select>
                  </div></td>
                </tr>
               
                <?php }
				if($rol=="admin" || $rol=="super"|| $rol=="edito" || $rol=="aut_p"){?>
			
                <tr align="center">
                  <td height="14"><div align="right">Municipio: </div></td>
                  <td height="14" colspan="2"><div align="left">
                    <select name="municipio" id="municipio" onChange="javascript:document.frm.submit();">
                        <option value="0">-----Seleccionar-----</option>
                        </select>
                        
                      
                  </div></td>
                </tr>
                <?php 
			   if(($rol=="admin" || $rol=="super"|| $rol=="edito") && $_POST['provincia']!=""){?>
                 <script language="javascript">fil_comboBox(document.frm.municipio,<?php print $_POST['provincia'];?>,'<?php print $_POST['municipio'];?>')</script>                
               <?php 
			   }
			   if($rol=="aut_p"){?>
                <script language="javascript">fil_comboBox(document.frm.municipio,'<?php if($cod_dpa2=="01" ||$cod_dpa2=="02" ||$cod_dpa2=="03" ||$cod_dpa2=="04" ||$cod_dpa2=="05" ||$cod_dpa2=="06" ||$cod_dpa2=="07" || $cod_dpa2=="08" || $cod_dpa2=="09")print substr($cod_dpa2,1,2); else print $cod_dpa2;?>','<?php print $_POST['municipio'];?>')</script>
                 <?php }}
				// print $_POST['provincia'];
				 ?>
                <tr> 
                  <td height="20" align="right">Establecimiento:</td>
                  <td colspan="2"> <div align="left"> 
                      <select name="sel_estab" title="Establecimiento" id="sel_estab" onChange="document.frm.submit();" >
                        <option value="0">-----Seleccionar-----</option>
                        <?php 
							
				if($_POST['sel_mercado']!=0 && $_POST['sel_mercado']!="" && $_POST['sel_tipologia']!=0 && $_POST['sel_tipologia']!="")
				{
						
						$campo0=estab;
						$campo1=" n_var_estab.fecha_captar,estab";
						//$campo_id="cod_estab";
						$id=$_POST['sel_estab'];
						if($campo1!='')
						$query_sel = "SELECT distinct n_estab.cod_estab,n_var_estab.fecha_captar,estab
FROM n_var_estab 
LEFT OUTER JOIN captacion ON fecha>='$fecha_cal_inicio_sem1_actual' and fecha<='$hoy' and fecha<'$fecha_cal_inicio_sem1_next' and n_var_estab.id_var_estab = captacion.id_var_estab and n_var_estab.desuso='0'
LEFT JOIN b_variedad ON b_variedad.idb_variedad=n_var_estab.idb_variedad and b_variedad.fecha='".$fecha_base."' and n_var_estab.fecha_captar<='".$fecha_captar."' and n_var_estab.desuso='0'
LEFT JOIN n_estab ON n_estab.id_estab=n_var_estab.id_estab and n_var_estab.fecha_captar<='".$fecha_captar."' and n_var_estab.desuso='0' and n_estab.id_tipologia='".$id_tipologia."'

LEFT JOIN n_dpa ON n_dpa.cod_dpa=n_estab.cod_dpa and n_var_estab.fecha_captar<='".$fecha_captar."' and n_dpa.incluido='1' and n_var_estab.desuso='0' 
LEFT JOIN n_variedad ON n_variedad.id_variedad=b_variedad.id_variedad and n_var_estab.fecha_captar<='".$fecha_captar."' and n_dpa.incluido='1' and n_variedad.ide_articulo!='1' and n_var_estab.desuso='0' and central='$central'
LEFT JOIN n_tipologia ON n_tipologia.id_tipologia=n_estab.id_tipologia and n_var_estab.fecha_captar<='".$fecha_captar."' and n_dpa.incluido='1' and n_variedad.ide_articulo!='1' and n_var_estab.desuso='0' and central='$central'
LEFT JOIN e_articulo ON e_articulo.ide_articulo=n_variedad.ide_articulo and n_var_estab.fecha_captar<='".$fecha_captar."' and n_dpa.incluido='1' and n_variedad.ide_articulo!='1' and n_var_estab.desuso='0' and central='$central'
LEFT JOIN n_unidad ON n_unidad.id_unidad=n_var_estab.id_unidad and n_var_estab.fecha_captar<='".$fecha_captar."' and n_dpa.incluido='1' and n_variedad.ide_articulo!='1' and n_var_estab.desuso='0' and central='$central'
LEFT JOIN n_mercado ON b_variedad.id_mercado=n_mercado.id_mercado and n_var_estab.fecha_captar<='".$fecha_captar."' and n_dpa.incluido='1' and n_variedad.ide_articulo!='1' and n_var_estab.desuso='0' and central='$central'
WHERE captacion.id_var_estab IS NULL and n_var_estab.fecha_captar<='".$fecha_captar."' and n_dpa.incluido='1' and n_variedad.ide_articulo!='1' and n_var_estab.desuso='0' and central='$central'";


if($rol=="autor")
$query_sel=$query_sel." and n_estab.cod_dpa='".$cod_dpa."'";
									
if($rol=="aut_p" && $_POST['municipio']=="")
$query_sel=$query_sel." and n_estab.cod_dpa like'".$cod_dpa2."%'";

elseif($_POST['municipio']!="" && $_POST['municipio']!="-----Seleccionar-----")

$query_sel=$query_sel." and n_dpa.cod_dpa_nueva='".$_POST['municipio']."'";
 

$query_sel .= "order by $campo1";
						//print $query_sel;
						$rs_selected=$db->Execute($query_sel) or $mensaje=$db->ErrorMsg() ;
						$cant_rs=$rs_selected->RecordCount();
						
						
							for ($i = 0; $i < $cant_rs;$i++)
							{	$fecha_captar=$rs_selected->Fields("fecha_captar");
								$dia=substr($fecha_captar,8,2);
								//print $dia;
								$rs_fields0=$rs_selected->Fields($campo0);
								$rs_fields1=$rs_selected->Fields('cod_estab');
								$rs_fields_id=$rs_selected->Fields('fecha_captar').$rs_selected->Fields('cod_estab');										 
								echo"<option value=";echo $rs_fields_id;if($rs_fields_id==$id){echo " selected ";$aux=$rs_fields_id;} echo "> "; if($rs_fields1){echo $array[$dia-1]."&nbsp;&nbsp;&nbsp;". $rs_fields1; print ". ";}echo $rs_fields0; echo "</option>";
								$rs_selected->MoveNext();
							}
				
				
				}
		//print $query_sel;							 
								    ?> </select> 
                                    
                     
                      (*) </div></td>
                </tr>
                <tr> 
                  <td width="41%" height="21" align="right">Variedad:</td>
                  <td colspan="2"><div align="left">
                    <select name="sel_var_estab" title="Variedad" id="sel_var_estab" onChange="document.frm.submit();" >
                      <option value="0">-----Seleccionar-----</option>  
                      <?php 
						
						if($_POST['sel_mercado']!=0 && $_POST['sel_mercado']!="" && $_POST['sel_tipologia']!=0 && $_POST['sel_tipologia']!="" && $_POST['sel_estab']!=0 && $_POST['sel_estab']!="")
						{
					 	
						 $id_estab=$_POST['sel_estab'];
						 $query_variedad = "SELECT cod_var,variedad,n_var_estab.id_var_estab
FROM n_var_estab 
LEFT OUTER JOIN captacion ON fecha>='$fecha_cal_inicio_sem1_actual' and fecha<='$hoy' and fecha<'$fecha_cal_inicio_sem1_next' and n_var_estab.id_var_estab = captacion.id_var_estab and n_var_estab.desuso='0'
LEFT JOIN b_variedad ON b_variedad.idb_variedad=n_var_estab.idb_variedad and b_variedad.fecha='".$fecha_base."' and n_var_estab.fecha_captar<='".$fecha_captar."' and n_var_estab.desuso='0'
LEFT JOIN n_estab ON n_estab.id_estab=n_var_estab.id_estab and n_var_estab.fecha_captar<='".$fecha_captar."' and n_var_estab.desuso='0'
LEFT JOIN n_dpa ON n_dpa.cod_dpa=n_estab.cod_dpa and n_var_estab.fecha_captar<='".$fecha_captar."' and n_dpa.incluido='1' and n_var_estab.desuso='0'
LEFT JOIN n_variedad ON n_variedad.id_variedad=b_variedad.id_variedad and n_var_estab.fecha_captar<='".$fecha_captar."' and n_dpa.incluido='1' and n_variedad.ide_articulo!='1' and n_var_estab.desuso='0' and central='$central'
LEFT JOIN n_tipologia ON n_tipologia.id_tipologia=n_estab.id_tipologia and n_var_estab.fecha_captar<='".$fecha_captar."' and n_dpa.incluido='1' and n_variedad.ide_articulo!='1' and n_var_estab.desuso='0' and central='$central'
LEFT JOIN e_articulo ON e_articulo.ide_articulo=n_variedad.ide_articulo and n_var_estab.fecha_captar<='".$fecha_captar."' and n_dpa.incluido='1' and n_variedad.ide_articulo!='1' and n_var_estab.desuso='0' and central='$central'
LEFT JOIN n_unidad ON n_unidad.id_unidad=n_var_estab.id_unidad and n_var_estab.fecha_captar<='".$fecha_captar."' and n_dpa.incluido='1' and n_variedad.ide_articulo!='1' and n_var_estab.desuso='0' and central='$central'
LEFT JOIN n_mercado ON b_variedad.id_mercado=n_mercado.id_mercado and n_var_estab.fecha_captar<='".$fecha_captar."' and n_dpa.incluido='1' and n_variedad.ide_articulo!='1' and n_var_estab.desuso='0' and central='$central'
WHERE captacion.id_var_estab IS NULL and n_var_estab.fecha_captar<='".$fecha_captar."' and n_dpa.incluido='1' and n_variedad.ide_articulo!='1' and n_var_estab.desuso='0' and central='$central'";

if($rol=="autor")
$query_variedad=$query_variedad." and n_estab.cod_dpa='".$cod_dpa."'";
									
if($rol=="aut_p" && $_POST['municipio']=="")
$query_variedad=$query_variedad." and n_estab.cod_dpa like'".$cod_dpa2."%'";

elseif($_POST['municipio']!="" && $_POST['municipio']!="----")

$query_variedad=$query_variedad." and n_dpa.cod_dpa_nueva='".$_POST['municipio']."'";

if($sel_estab!=0 && $fecha_captar!=0) 
$query_variedad .= "and n_estab.cod_estab='".$sel_estab."'"; 

						
						   //print $query_variedad;
						 $rs_variedad=$db->Execute($query_variedad) or die($db->ErrorMsg()) ;
						 
						 
					     
						 $cant_rs=$rs_variedad->RecordCount();
						// print $cant_rs;
 							for ($i = 0; $i < $cant_rs;$i++)
							{
								$rs_fields0=$rs_variedad->Fields("variedad");
								$rs_fields1=$rs_variedad->Fields("cod_var");
								$rs_fields_id=$rs_variedad->Fields("id_var_estab");
								$fecha_captar=$rs_variedad->Fields("fecha_captar");
								
								$dia=substr($fecha_captar,8,2);
								
								$sql_cap = "select id_var_estab	from captacion where id_var_estab='".$rs_fields_id."' and fecha>'".$fecha_01_fin3."' and fecha<='".$fecha_01_ini3."'";
								print $sql_cap;
								$rs_cap=$db->Execute($sql_cap) or die($db->ErrorMsg());
								$cant_cap=$rs_cap->RecordCount();
								
								$rs_cap->MoveFirst();
								$id_var_estab_cap=$rs_cap->fields["id_var_estab"];
								if($id_var_estab_cap=="")
								{	
									$id_var_estab=$_POST['sel_var_estab'];
									if($rs_fields1_ant!=$rs_fields1)
									{
									$rs_fields1_ant=$rs_fields1;
									$fecha_captar_ant=$fecha_captar;										                             
									echo"<option value=";echo $rs_fields_id;if($rs_fields_id==$id_var_estab){echo " selected ";$idb_variedad=$rs_variedad->Fields("idb_variedad");}else $_POST['sel_var_estab']=$id_var_estab; echo "> ";
									echo $rs_fields1; print ". ";echo $rs_fields0; echo "</option>";}
									}
								$rs_variedad->MoveNext();
									
							  }
							
						}
						?></select>
                                           
                       
                    (*) </div> </td>
                </tr>
               
                <tr id="hide_price">
                  <td height="20"  align="right">Tipo de precio: </td>
                  <td colspan="2"><select name="sel_precio" id="sel_precio" title="Precio"  
				  onChange="javascript: mostrar_fila()">
                      <option value="0" selected>-----Seleccionar-----</option>
                      <option value="1">Cambio de cantidad o unidades</option>
                      <option value="2">Variedad de regalo</option>
                      <option value="3">Cambio de cantidad como regalo</option>
                      <option value="4">Porcentaje como regalo</option>
                      <option value="5">Valor absoluto de descuento</option>
                      <option value="6">Porcentaje de descuento</option>
                    </select>
					
					
                    (*)</td>
                </tr>
                <tr id="precio_obs" align="center">
                  <td height="19" align="right">Precio observado:</td>
                  <td width="36%" align="left"><div align="left">
                      <input  name="txt_precio_observado"  type="text"   id="txt_precio_observado" title="Precio"  size="10" />
                    (*) </div></td>
                  <td width="23%" align="left"><a onMouseOver="return overlib('<img src=../../imagenes/error.JPG border=0 />',BELOW, RIGHT);" onMouseOut="return nd();"><img src="../../imagenes/mensaje_advertencia.png" width="18"  height="18" id="warning" ></a></td>
                </tr>
                
                <tr id="unidades" align="center" style="display:none">
                  <td height="19" align="right">Cantidad de la presentación actual:</td>
                  <td width="36%" align="left"><div align="left">
                      <input   name="txt_numero_unidades"  type="text"   id="txt_numero_unidades" title="Numero_unidades"   size="10" />
(*) </div></td>
                  <td width="23%" align="left">&nbsp;</td>
                </tr>
                
                <tr id="um" style="display:none">
                  <td height="22"  align="right">Unidad de medidas actual: </td>
                  <td><div align="left">
                  <select name="sel_unidad" title="Unidad de Medida" id="sel_unidad" >
                       <option value="22">-----------------------</option>   
                       <?php 
					   $sel_corr_uni="select distinct n_unidad.id_unidad, unidad from n_correlacionador, n_unidad, n_var_estab where n_correlacionador.id_unidad_g=n_unidad.id_unidad or n_correlacionador.id_unidad_p=n_unidad.id_unidad and n_var_estab.id_unidad= n_unidad.id_unidad ";
					   //print $sel_corr_uni;
					   $rs_corr_uni=$db->Execute($sel_corr_uni) or die($db->ErrorMsg());
					   $cant_corr_uni=$rs_corr_uni->RecordCount();
					   $rs_corr_uni->MoveFirst();
					   for ($i = 0; $i < $cant_corr_uni;$i++)
							{
							    $rs_fields0=$rs_corr_uni->Fields("id_unidad");
								$rs_fields1=$rs_corr_uni->Fields("unidad");									
								echo"<option value=\"".$rs_fields0."\">".$rs_fields1."</option>";
								$rs_corr_uni->MoveNext();
							}                   
						?></select>
					  
                      
                 (*) </div></td>
                  <td align="right">&nbsp;</td>
                </tr>
                <tr id="presentacion" style="display:none">
                  <td height="22"  align="right">Presentaci&oacute;n actual permanente: </td>
                  <td> Si
                    <input name="radio_perm" type="radio" value="1" >
                    No 
                    <input name="radio_perm" type="radio" value="2" ></td>
                  <td>&nbsp;</td>
                </tr>
                <tr id="var_reg" style="display:none">
                  <td height="19"  align="right">Precio de la variedad de regalo: </td>
                  <td><input   name="txt_prec_reg"  type="text"   id="txt_prec_reg" title="Precio_regalo"   size="10" /></td>
                  <td>&nbsp;</td>
                </tr>
                
                <tr id="tam_reg" style="display:none">
                  <td height="19"  align="right">Cantidad del regalo: </td>
                  <td><input   name="txt_cant_reg"  type="text"   id="txt_cant_reg" title="Cantidad_regalo"   size="10" /></td>
                  <td>&nbsp;</td>
                </tr>
                <tr id="porc_grat" style="display:none">
                  <td height="19"  align="right">Porcentaje de regalo: </td>
                  <td><input   name="txt_porc_grat"  type="text"   id="txt_porc_grat" title="Porcentaje_gratis"   size="10" /></td>
                  <td>&nbsp;</td>
                </tr>
                <tr id="val_desc" style="display:none">
                  <td height="19"  align="right">Valor de descuento: </td>
                  <td><input   name="txt_val_desc"  type="text"   id="txt_val_desc" title="Valor_descuento"   size="10" /></td>
                  <td>&nbsp;</td>
                </tr>
                <tr id="porc_desc" style="display:none">
                  <td height="19"  align="right">Porcentaje de descuento: </td>
                  <td><input   name="txt_porc_desc"  type="text"   id="txt_porc_desc" title="Porcentaje_descuento"   size="10" /></td>
                  <td>&nbsp;</td>
                </tr>
                
                
               <?php  if($rol=="admin" || $rol=="super"|| $rol=='edito') {?>
                <tr align="center">
                  <td height="19" align="right">Fecha digitaci&oacute;n:</td>
                  <td colspan="2" align="left"><input  name="txt_fecha" type="text" title="Fecha"   id="txt_fecha"  onClick="javascript:showCal('Calendar1')" onKeyPress="window.event.keyCode=0;javascript:showCal('Calendar1')"    size="10" maxlength="10"></td>
                </tr>
                <?php  }
				if($fecha_captar_ant){
				?>
                <tr align="center"> 
                  <td height="20" align="right">Fecha a captar:</td>
                  <td colspan="2" align="left"> 
                    <div align="left">
                      <?php  $dia_text=substr($fecha_captar_ant,8,2);if($fecha_captar_ant){print "El ".$array_text[$dia_text-1]." semana.";}?>
                    &nbsp; </div></td>
                </tr>
                <?php  }?>
                <tr> 
                  <td height="19" align="right"><div align="right">Incidencia:</div></td>
                  <td colspan="2"><select name="sel_inc" title="Incidencia" id="sel_inc"  onChange="validar_obs('hide_price','precio_obs')">
                     	<option value="1">E0: Establecimiento visitado</option>
                  
                        <?php /*                     
						$tabla=n_inc;
						$campo0=inc;
						$campo_id=id_inc;
						$id=$rs->fields["id_inc"];
						include($x."php/selected.php");*/
						?>
                     </select></td>
                </tr>
                <?php if($rol=='admin'|| $rol=="super"){?><?php }//<option value="1">--No disponible--</option>?>
                <tr align="center" id="observ"> 
                  <td height="14"><div align="right">Observación:</div></td>
                  <td height="14" colspan="2"><div align="left">
                    <select name="sel_obs" title="Observación" id="sel_obs" onChange="validar_obs('hide_price','precio_obs')">
                     	
                        <option value="6">UM: Cambio de cantidad o unidades</option>
                        <option value="4">O: En oferta</option>
                       
                      <?php /*
					  if(sel_inc!="1")
					  {
					     $query = "select * from n_obs order by id_obs";
						$rs=$db->Execute($query) or $mensaje=$db->ErrorMsg() ;
						$cant_rs=$rs->RecordCount();
							for ($i = 0; $i < $cant_rs;$i++)
							{
								$rs_fields0=$rs->Fields("obs");
								$rs_fields2=substr($rs_fields0,0,50);
								$rs_fields0=$rs->Fields("obs");
								$rs_fields3=substr($rs_fields0,3,50);
								print $rs_fields3;
								$rs_fields1="";
								$rs_fields_id=$rs->Fields("id_obs");										 
								echo"<option title=\"";echo $rs_fields3; echo"\" value=";echo $rs_fields_id; echo "> "; if($rs_fields1){echo $rs_fields1; print ". ";}echo $rs_fields2; echo "</option>";
								$rs->MoveNext();
							}                   
						}
						*/?>
                    </select>
                    </div>                  </td>
                </tr>
                
                <tr align="center"> 
                  <td height="21" colspan="3">(*) Campo requerido</td>
                </tr>
                <tr>
                  <td height="14" colspan="3"><div align="center"id="id_msg" style="display:block">
                   <?php echo $mensaje;?>
                        <script language="JavaScript" type="text/javascript">
				  setTimeout("des()",44000);
				  function des(){document.getElementById('id_msg').style.display="none";}
				        </script>
                   
                  </div></td>
                </tr>
                <?php } else
                {
                ?>
                <tr align="center" valign="center"  > 
                <td class="raya" colspan="10"  height="20"><?php print "No hay captaciones a realizar hasta la fecha para este municipio.";?></td></tr>
                <?php
                }
                ?>
                
               </table> 
                
                 </td> 
                </tr>
              </table>
            <br>
            </div>
            </form>
            <!-- InstanceEndEditable --></td>
  </tr>
  
	</table>
	
	 </td></tr></table>
	
<table width="754" height="21"  border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#5A697E">
  <tr> 
    <td width="30" height="21"  align="center" valign="middle"> <div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><img src="../../imagenes/down.jpg" width="30" height="26"></font></div></td>
    <td width="695"  align="center" valign="middle" bgcolor="#4B4B4B">
      <div align="center"><font color="#FFFFFF" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>ONEI - 
    IPC 2009-2012</strong></font></div></td>
    <td width="30"  align="center" valign="middle"><div align="center"><img src="../../imagenes/up.jpg" width="30" height="26"></div></td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
