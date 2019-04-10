<?php
$x="../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."php/session/session_autor.php");


//---------------------------------------------------
$query_usuario = " where usuario='".$_SESSION["user"]."' and n_dpa.cod_dpa=usuario.cod_dpa"; 
$sql_usuario = "select rol, id_usuario, usuario.cod_dpa,prov_mun from usuario,n_dpa".$query_usuario;	
//print 	$sql_usuario;
$rs_usuario = $db->Execute($sql_usuario)or $mensaje=$db->ErrorMsg() ;

$cod_dpa2=substr($rs_usuario->Fields("cod_dpa"),0,2);
$cod_dpa=$rs_usuario->Fields("cod_dpa");
$prov_mun=$rs_usuario->Fields("prov_mun");
$rol=$rs_usuario->Fields("rol");
$id_usuario=$rs_usuario->Fields("id_usuario");
//print $cod_dpa;
//---------------------------------------------------


$array_text=array("Domingos de la 1ra","Lunes de la 1ra","Martes de la 1ra","Miércoles de la 1ra","Jueves de la 1ra","Viernes de la 1ra","Sábado de la 1ra",
			 	  "Domingos de la 2da","Lunes de la 2da","Martes de la 2da","Miércoles de la 2da","Jueves de la 2da","Viernes de la 2da","Sábado de la 2da",
		    	  "Domingos de la 3ra","Lunes de la 3ra","Martes de la 3ra","Miércoles de la 3ra","Jueves de la 3ra","Viernes de la 3ra","Sábado de la 3ra",
			 	  "Domingos de la 4ta","Lunes de la 4ta","Martes de la 4ta","Miércoles de la 4ta","Jueves de la 4ta","Viernes de la 4ta","Sábado de la 4ta");
	//---------------------------------------------------					 
	$sql_fecha = "select max(fecha) from b_variedad";		
	$rs_fecha = $db->Execute($sql_fecha)or $mensaje=$db->ErrorMsg() ;
	if($rs_fecha)
	$fecha_base = $rs_fecha->Fields('max');
	//print $fecha_base;	
	//---------------------------------------------------
	
$hoy=date("Y/m/d");
 
//---------------------------------------------------					 
$sql_cal = "select max(fecha_captar) from calendario where fecha_cal>='".substr($hoy,0,8)."01' and fecha_cal<='".$hoy."'";		
$rs_cal = $db->Execute($sql_cal)or $mensaje=$db->ErrorMsg();//print $sql_cal;
$fecha_captar = $rs_cal->Fields('max');
//print $sql_cal;
//---------------------------------------------------
	
	 $mes=date("m");	
	 $ano=date("Y");
	 $dia=date("d");
	 $fecha_act=$ano."/".$mes."/".$dia;
	 $fecha_ant=$ano."/".$mes."/"."01";
	 if($mes=="01")
	{
		$fecha_ant_ini=date("Y")-1 ."/";
		$fecha_ant_ini.="12/";
		$fecha_ant_ini.="01";
		$fecha_ant_fin=date("Y")-1 ."/";
		$fecha_ant_fin.="12/";
		$fecha_ant_fin.="28";
	}
	else 
	{
		$fecha_ant_ini=date("Y")."/";
		$fecha_ant_ini.=date("m")-1 ."/";
		$fecha_ant_ini.="01";		
		$fecha_ant_fin=date("Y")."/";
		$fecha_ant_fin.=date("m")-1 ."/";
		$fecha_ant_fin.="28";		
	}
	

	
	$fecha_base_dia_actual=substr($fecha_base,0,8).date("d");
	//print $fecha_base_dia_actual;
	$array=array("D-1","L-1","M-1","M-1","J-1","V-1","S-1",
				 "D-2","L-2","M-2","M-2","J-2","V-2","S-2",
				 "D-3","L-3","M-3","M-3","J-3","V-3","S-3",
				 "D-4","L-4","M-4","M-4","J-4","V-4","S-4",);

	
$mensaje="";

if(isset($_POST['txt_precio_observado']))
{
	$magic_quotes = get_magic_quotes_gpc();
	
	if($rol=="admin" && $_POST['txt_fecha']!="")
	{$hoy=$_POST['txt_fecha'];}
   
    $sel_mercado = $db->qstr($_POST['sel_mercado'], $magic_quotes);
	$sel_tipologia = $db->qstr($_POST['sel_tipologia'], $magic_quotes);
	$sel_estab = $db->qstr($_POST['sel_estab'], $magic_quotes);
	$sel_var_estab = $_POST['sel_var_estab'];
	$txt_precio_observado= $_POST['txt_precio_observado'];
	$sel_precio = $db->qstr($_POST['sel_precio'], $magic_quotes);
	$txt_numero_unidades= $_POST['txt_numero_unidades'];
	$radio_perm = $_POST['radio_perm'];
	$txt_prec_reg = $_POST['txt_prec_reg'];
	$txt_cant_reg = $_POST['txt_cant_reg'];
	$txt_porc_desc = $_POST['txt_porc_desc'];
	$txt_porc_grat = $_POST['txt_porc_grat'];
	$txt_val_desc = $_POST['txt_val_desc'];
	$txt_cant_act = $_POST['txt_cant_act'];
	$sel_obs = $_POST['sel_obs'];
	$sel_inc = $_POST['sel_inc'];
	$precio= $_POST['txt_precio_observado'];
	
//------hecho por katia--------- y trasformado por Raydel	
	
if($txt_precio_observado!="" && $sel_inc==1 && ($sel_obs=='4' || $sel_obs=='6') && $sel_var_estab!=0)
{//print "dtg".$sel_var_estab;
	 	if($_POST['sel_precio']=="1" && $_POST['txt_numero_unidades']!="" && $_POST['radio_perm']=="2")
		{
			$sql_sel_cant="select cantidad from n_var_estab where id_var_estab= ".$sel_var_estab." and fecha_captar>='".$fecha_base."'";
			$rs_sql_sel_cant=$db->Execute($sql_sel_cant) or die($db->ErrorMsg());
			$cantidad=$rs_sql_sel_cant->Fields("cantidad");			
		 
			$div=bcdiv($txt_precio_observado,$txt_numero_unidades,14); 
			$precio=bcmul($div,$cantidad,14);
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
//----------------------------------------------------------------------------------------------		
		else if($_POST['sel_precio']=="1" && $_POST['txt_numero_unidades']!="" &&  $_POST['radio_perm']=="1")
		{
			$sql_sel_cant="select  cantidad,id_unidad from n_var_estab where id_var_estab= ".$sel_var_estab." and fecha_captar>='".$fecha_base."'";			
			$rs_sql_sel_cant=$db->Execute($sql_sel_cant) or die($db->ErrorMsg());
			$cantidad=$rs_sql_sel_cant->Fields("cantidad");
			$id_unidad=$rs_sql_sel_cant->Fields("id_unidad");	
			
			$sql_sel_precio="select precio, id_cap from captacion, n_var_estab where captacion.id_var_estab=n_var_estab.id_var_estab and captacion.id_var_estab= ".$sel_var_estab." and fecha<='".$fecha_ant_fin."' and fecha>='".$fecha_ant_ini."'";//print $sql_sel_precio;			
			$rs_sql_sel_precio=$db->Execute($sql_sel_precio) or die($db->ErrorMsg());
			$pre=$rs_sql_sel_precio->Fields("precio");
			$id_cap=$rs_sql_sel_precio->Fields("id_cap");				
					
			$sql_ins_cap_s_m ="INSERT INTO cap_s_m (id_cap,id_usuario,precio_s_m,fecha_m,cant_s_m,id_unidad_s_m) 
			VALUES ('".$id_cap."','".$id_usuario."','".$pre."','".$hoy."','".$cantidad."','".$id_unidad."')";
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
			$div=bcdiv($pre,$cantidad,14);
			$pre_ant=bcmul($div,$txt_numero_unidades,14); 
				 
			$sql_upd_cap="UPDATE captacion SET precio ='".$pre_ant."' 
			WHERE id_var_estab=".$sel_var_estab."and fecha<='".$fecha_ant_fin."' and fecha>='".$fecha_ant_ini."'";
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
		else if($_POST['sel_precio']=="1")
		{
			if($_POST['txt_numero_unidades']=="")
			$mensaje="Debe llenar la cantidad.";
			
			if($_POST['radio_perm']!="2" && $_POST['radio_perm']!="1")
			$mensaje="Debe marcar si la presentacion permanecerá";						
		}
		
 //----------------------------------------------------------------------------------
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
		
		else if($_POST['sel_precio']=="2")
		{
		   if($_POST['txt_prec_reg']=="")
		     $mensaje="Debe llenar precio del regalo.";
		}
	   //--------------------------------------------------------------------------------------------
	    else if ($_POST['sel_precio']=="3" && $_POST['txt_cant_reg']!="")
	    {
			$sql_sel_cant="select cantidad from n_var_estab where id_var_estab= ".$sel_var_estab." and fecha_captar>='".$fecha_base."'";
			$rs_sql_sel_cant=$db->Execute($sql_sel_cant) or die($db->ErrorMsg());
			$cantidad=$rs_sql_sel_cant->Fields("cantidad");
			
			$sum=bcadd($cantidad,$txt_cant_reg,14);
			$divid=bcdiv($txt_precio_observado,$sum,14);
			$precio=bcmul($divid,$cantidad,14);		
			
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
		
		else if($_POST['sel_precio']=="3")
		{
		    if($_POST['txt_cant_reg']=="")
		    $mensaje="Debe llenar la cantidad del regalo.";
		}
//---------------------------------------------------------------------------------------------
	    else if ($_POST['sel_precio']=="4" && $_POST['txt_porc_grat']!="")
	    {
			$sql_sel_cant="select cantidad from n_var_estab where id_var_estab= ".$sel_variedad." and fecha_captar>='".$fecha_base."'"; 		
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
		
		else if($_POST['sel_precio']=="4")
		{
		    if($_POST['txt_porc_grat']=="")
		    $mensaje="Debe llenar el porciento del regalo.";
		}
//----------------------------------------------------------------------------------------------	 
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
			
		else if($_POST['sel_precio']=="5")
		{
		    if($_POST['txt_val_desc']=="")
		    $mensaje="Debe llenar el valor de descuento.";
		}
//----------------------------------------------------------------------------------------------
		
	    elseif ($_POST['sel_precio']=="6" && $_POST['txt_porc_desc']!="")
	    {		
			$porc=bcdiv($txt_porc_desc,100,14);
			$resta=bcsub(1,$porc,14);
			$precio=bcmul($resta,$txt_precio_observado,14); 
			
			$sql_ins_cap="INSERT INTO captacion (id_usuario,id_var_estab,id_obs,fecha,precio,id_inc) 
			VALUES ('".$id_usuario."','".$sel_var_estab."','".$sel_obs.",'".$hoy."','".$precio."','".$sel_inc."')";//print $sql_ins_cap;
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
		
		elseif($_POST['sel_precio']=="6")
		{
		    if($_POST['txt_porc_desc']=="")
		    $mensaje="Debe llenar el porciento de descuento.";
		}	
//------------------------------------------------------------------------------------------	
			 		   
}
else if($sel_inc!="1" && $sel_var_estab!="")
{ 
	$sql_ins_cap="INSERT INTO captacion (id_usuario,id_var_estab,id_obs,fecha,precio,id_inc) 
	VALUES ('".$id_usuario."','".$sel_var_estab."','1','".$hoy."','0','".$sel_inc."')";print $sql_ins_cap;
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
elseif($sel_inc=='1' && ($sel_obs=='2' || $sel_obs=='3' || $sel_obs=='5') && $sel_var_estab!="")
{ 
	$sql_ins_cap="INSERT INTO captacion (id_usuario,id_var_estab,id_obs,fecha,precio,id_inc) 
	VALUES ('".$id_usuario."','".$sel_var_estab."','".$sel_obs."','".$hoy."','0','".$sel_inc."')";print $sql_ins_cap;
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

else
{$mensaje="Existen campos vacíos.";}

		
//------hecho por katia--------- y trasformado por Raydel		
	
	
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

*/
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
               <form action="" method="post" name="frm" id="frm" onSubmit="MM_validateForm('sel_mercado','','Escoger','sel_tipologia','','Escoger','sel_estab','','Escoger','sel_var_estab','','Escoger','txt_precio_observado','','RisNum');return document.MM_returnValue">
              <table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
                <tr> 
                  <td class="menudottedline" align="right"> <table width="100%" border="0" class="menubar"  id="toolbar">
                      <tr > 
                        <td width="4%" valign="middle"  class="us"><img src="../../imagenes/admin/news.png" width="48" height="48" border="0" /></td>
                        <td width="71%" valign="middle"  class="us"><strong><font color="#5A697E" size="2">Captación
                              de precios centralizadas nacionalmente                          
                          <?php if($rol!="admin" && $rol!='edito')echo "de ".$prov_mun;?>
                          </font></strong>                        </td>
                        <td width="9%"> 
                          <div align="center"> <a  class="toolbar" href="javascript:document.frm.submit();"> 
                            <input type="image"   name="btn_save" id="btn_save"   src="../../imagenes/admin/save_f2.png" alt="Guardar" width="32" height="32" border="0" />
                            <br />
                            <label>Guardar</label>
                            </a> </div></td>
                        <td width="9%"> 
                          <div align="center"> <a class="toolbar" href="<?php if($_GET['locat']!="")
{
print $_GET['locat'];
}?>"> 
                            <img src="../../imagenes/admin/cancel_f2.png" alt="Cerrar" name="imageField2" width="32" height="32" border="0" id="imageField2" /> 
                            <br />
                          Cancelar</a> </div></td>
                        <td width="7%"> 
                          <div align="center"><a class="toolbar" href="#" onClick="window.open('../help/n_municipal_datos.htm', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                            <img src="../../imagenes/admin/help_f2.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" id="help" /><br />
                          Ayuda</a></div></td>
                      </tr>
                      
                  </table></td>
                </tr>
              </table>
              <br>
            
              <table  class="tabla" width="98%" align="center">
                <tr> 
                  <td height="2" colspan="3">&nbsp;</td>
                </tr>
               
				   
                    
			 
               
				     <td height="19" align="right">Mercado:</td>
                  <td colspan="2"><div align="left">
                      <select name="sel_mercado" title="Mercado" id="sel_mercado" onChange="document.frm.submit();" >
                        <option value="0">-----------------------</option>
                        <?php  
					  	
                    	 $query_mercado = "select distinct n_mercado.id_mercado, mercado
						 from n_mercado, n_var_estab,b_variedad, n_estab
						 WHERE n_mercado.id_mercado=b_variedad.id_mercado 
						 and n_var_estab.idb_variedad=b_variedad.idb_variedad 
						 and n_estab.id_estab=n_var_estab.id_estab and central='1'
						 AND fecha='".$fecha_base."' 
						 and fecha_captar<='".$fecha_captar."'";
						 //print	$query_mercado;
						 if($rol=="autor")
						 $query_mercado=$query_mercado." and n_estab.cod_dpa='".$cod_dpa."'";
						 if($rol=="aut_p")
						 $query_mercado=$query_mercado." and n_estab.cod_dpa like'".$cod_dpa2."%'";
						 
						 $query_mercado=$query_mercado." order by mercado";
						  print	$query_mercado;
						 $rs_mercado=$db->Execute($query_mercado) or $mensaje=$db->ErrorMsg() ;
					  print $query_mercado;
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
							
					?>
                   </select>
                    (*) </div></td>
                </tr>
                <tr>
                  <td height="8" align="right">Tipolog&iacute;a:</td>
                  <td colspan="2"><select name="sel_tipologia" title="Tipología" id="sel_tipologia" onChange="document.frm.submit();">
                    <option value="0">-----------------------</option>
                    <?php 
						
						if($_POST['sel_mercado']!=0 && $_POST['sel_mercado']!="")
						{
                    	 $query_tipologia = "select distinct tipologia, n_tipologia.id_tipologia
						 from n_tipologia, n_estab, n_var_estab,b_variedad
						 WHERE n_tipologia.id_tipologia=n_estab.id_tipologia  
						 and n_var_estab.idb_variedad=b_variedad.idb_variedad 
						 and n_estab.id_estab=n_var_estab.id_estab AND fecha='".$fecha_base."'
						 and n_estab.id_mercado='".$_POST['sel_mercado']."' and central='1'
     					 and fecha_captar<='".$fecha_captar."'";					 
						 
						 if($rol=="autor")
						 $query_tipologia=$query_tipologia." and n_estab.cod_dpa='".$cod_dpa."'";
						 if($rol=="aut_p")
						 $query_tipologia=$query_tipologia." and n_estab.cod_dpa like '".$cod_dpa2."%'";
						 
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
                 <?php  if($rol=="admin" || $rol=="edito"){?>
                
                <tr align="center">
                  <td height="14"><div align="right">Provincia:</div></td>
                  <td height="14" colspan="2"><div align="left">
                      <select name="provincia" id="provincia" title="Provincias" onChange="javascript: fil_comboBox( document.frm.municipio,this.options[this.selectedIndex].value)">
                        <option value="0" selected="selected">[Provincias]</option>
                        <option <?php if($_POST['provincia']==1)print "selected";?> value="1">0100. Pinar del R&iacute;o</option>
                        <option <?php if($_POST['provincia']==2)print "selected";?> value="2">0200. La Habana</option>
                        <option <?php if($_POST['provincia']==3)print "selected";?> value="3">0300. Ciudad Habana</option>
                        <option <?php if($_POST['provincia']==4)print "selected";?> value="4">0400. Matanzas</option>
                        <option <?php if($_POST['provincia']==5)print "selected";?> value="5">0500. Villa Clara</option>
                        <option <?php if($_POST['provincia']==6)print "selected";?> value="6">0600. Cienfuegos</option>
                        <option <?php if($_POST['provincia']==7)print "selected";?> value="7">0700. Sancti Sp&iacute;ritus</option>
                        <option <?php if($_POST['provincia']==8)print "selected";?> value="8">0800. Ciego de Avila</option>
                        <option <?php if($_POST['provincia']==9)print "selected";?> value="9">0900. Camag&uuml;ey</option>
                        <option <?php if($_POST['provincia']==10)print "selected";?> value="10">1000. Las Tunas</option>
                        <option <?php if($_POST['provincia']==11)print "selected";?> value="11">1100. Holgu&iacute;n</option>
                        <option <?php if($_POST['provincia']==12)print "selected";?> value="12">1200. Granma</option>
                        <option <?php if($_POST['provincia']==13)print "selected";?> value="13">1300. Santiago de Cuba</option>
                        <option <?php if($_POST['provincia']==14)print "selected";?> value="14">1400. Guant&aacute;namo</option>
                        <option <?php if($_POST['provincia']==15)print "selected";?> value="15">1500. Isla de la juventud</option>
                      </select>
                  </div></td>
                </tr>
               
                <?php }
				if($rol=="admin" || $rol=="edito" || $rol=="aut_p"){?>
			
                <tr align="center">
                  <td height="14"><div align="right">Municipio: </div></td>
                  <td height="14" colspan="2"><div align="left">
                    <select name="municipio" id="municipio" onChange="javascript:document.frm.submit();">
                        <option value="0">[Municipios]</option>
                      </select>
                  </div></td>
                </tr>
                <?php 
			   if(($rol=="admin" || $rol=="edito") && $_POST['provincia']!=""){?>
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
                        <option value="0">-----------------------</option> 
                        <?php 
									if($_POST['sel_tipologia']!=0 && $_POST['sel_mercado']!=0)
								    {
									$id=$_POST['sel_estab'];	
                     				$id_tipologia =$_POST['sel_tipologia'];
									$id_mercado =$_POST['sel_mercado'];
									//
									$query_estab = "select distinct cod_estab, estab, n_estab.id_estab
									from n_estab, n_tipologia, n_mercado, n_var_estab, n_dpa, b_variedad
									where n_dpa.cod_dpa=n_estab.cod_dpa and
									n_var_estab.id_estab=n_estab.id_estab and
									n_estab.id_mercado=n_mercado.id_mercado and 
									n_estab.id_tipologia=n_tipologia.id_tipologia and 
									n_estab.id_tipologia='$id_tipologia'  
									and n_var_estab.idb_variedad=b_variedad.idb_variedad 
									and n_estab.id_mercado='$id_mercado'
									and incluido='1' and central='1'
									and fecha_captar<='".$fecha_captar."'";
									
									 if($rol=="autor")
									 $query_estab=$query_estab." and n_estab.cod_dpa='".$cod_dpa."'";
									
									 if($rol=="aut_p" && $_POST['municipio']=="")
									 {
									 $query_estab=$query_estab." and n_estab.cod_dpa like '".$cod_dpa2."%'";
									 }
									 elseif($_POST['municipio']!="" && $_POST['municipio']!="----")
									 {
									 $query_estab=$query_estab." and n_estab.cod_dpa='".$_POST['municipio']."'";
									 }
									
												 
									$query_estab=$query_estab." order by estab"; print $query_estab;									
									$rs_estab=$db->Execute($query_estab) or $mensaje=$db->ErrorMsg() ;
									$cant_estab=$rs_estab->RecordCount();
										for ($i = 0; $i < $cant_estab;$i++)
										{
											$rs_fields0=$rs_estab->Fields('estab');
											$rs_fields1=$rs_estab->Fields('cod_estab');
											$rs_fields_id=$rs_estab->Fields('id_estab');
												
											echo"<option value=";echo $rs_fields_id;if($rs_fields_id==$id){echo " selected ";$aux=$rs_fields_id;} echo "> "; if($rs_fields1){echo $rs_fields1; print ". ";}echo $rs_fields0; echo "</option>";
											
											
											$rs_estab->MoveNext();
										}
									}
								    ?>
                     </select>
                      (*) </div></td>
                </tr>
                <tr> 
                  <td width="29%" height="21" align="right">Variedad:</td>
                  <td colspan="2"><div align="left">
                    <select name="sel_var_estab" title="Variedad" id="sel_var_estab" onChange="document.frm.submit();" >
                      <option value="0">-----------------------</option>
                      <?php 
						
						if($_POST['sel_estab']!="" && $_POST['sel_estab']!=0 && $_POST['sel_mercado']!="" && $_POST['sel_tipologia']!="")
						{
					 	
						 $id_estab=$_POST['sel_estab'];
						// print $id_estab;
						 $query_variedad = "select fecha_captar, variedad,cod_var,n_var_estab.idb_variedad,id_var_estab
					 	 from b_variedad,n_variedad,n_var_estab,n_estab, n_dpa
						 where n_dpa.cod_dpa=n_estab.cod_dpa and
						 b_variedad.id_variedad=n_variedad.id_variedad and
						 b_variedad.idb_variedad=n_var_estab.idb_variedad and
						 n_var_estab.id_estab=n_estab.id_estab and 
						 n_estab.id_estab='".$id_estab."' 
						 and incluido='1' and central='1'
						 AND fecha='".$fecha_base."'
						 and fecha_captar<='".$fecha_captar."' 
						 order by n_variedad.cod_var, fecha_captar ";
						 $rs_variedad=$db->Execute($query_variedad) or die($db->ErrorMsg()) ;
						 
						 
					     print	$query_variedad;
						 $cant_rs=$rs_variedad->RecordCount();
						// print $cant_rs;
 							for ($i = 0; $i < $cant_rs;$i++)
							{
								$rs_fields0=$rs_variedad->Fields("variedad");
								$rs_fields1=$rs_variedad->Fields("cod_var");
								$rs_fields_id=$rs_variedad->Fields("id_var_estab");
								$fecha_captar=$rs_variedad->Fields("fecha_captar");
								
								$dia=substr($fecha_captar,8,2);
								
								$sql_cap = "select id_var_estab	from captacion where id_var_estab='".$rs_fields_id."' and fecha>'".$fecha_ant."' and fecha<='".$fecha_act."'";
								$rs_cap=$db->Execute($sql_cap) or die($db->ErrorMsg());
								$cant_cap=$rs_cap->RecordCount();
								//print $cant_cap;
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
									if($rs_fields1){echo $array[$dia-1]."&nbsp;&nbsp;&nbsp;".$rs_fields1; print ". ";}echo $rs_fields0; echo "</option>";}
									}
								$rs_variedad->MoveNext();
									
								}
						}?></select>  
                                           
                       <?php 
					  //print $idb_variedad;
						
							//<option value="2">Unidades adicionales</option><option value="8">Cambio de cantidad</option>
						?>
                    (*) </div></td>
                </tr>
                <div  style="display:none">
                <tr id="hide_price">
                  <td height="20"  align="right">Tipo de precio: </td>
                  <td colspan="2"><select name="sel_precio" id="sel_precio" title="Precio"  
				  onChange="javascript: mostrar_fila()">
                      <option value="0" selected>Precio disponible</option>
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
                  <td width="25%" align="left"><div align="left">
                      <input  name="txt_precio_observado"  type="text"   id="txt_precio_observado" title="Precio"    size="10" />
                    (*) </div></td>
                  <td width="46%" align="left"><a onMouseOver="return overlib('<img src=../../imagenes/error.JPG border=0 />',BELOW, RIGHT);" onMouseOut="return nd();"><img src="../../imagenes/mensaje_advertencia.png" width="18"  height="18" id="warning" ></a></td>
                </tr>
                <tr id="unidades" style="display:none" > 
                  <td height="19"  align="right" >Cantidad de la presentaci&oacute;n actual: </td>
                  <td colspan="2" nowrap><input   name="txt_numero_unidades"  type="text"   id="txt_numero_unidades" title="Numero_unidades"   size="10" />
(*)</td>
                </tr>
                <tr id="presentacion" style="display:none">
                  <td height="22"  align="right">Presentaci&oacute;n actual permanente: </td>
                  <td colspan="2"> Si
                    <input name="radio_perm" type="radio" value="1" >
                    No 
                    <input name="radio_perm" type="radio" value="2" ></td>
                </tr>
                <tr id="var_reg" style="display:none">
                  <td height="19"  align="right">Precio de la variedad de regalo: </td>
                  <td colspan="2"><input   name="txt_prec_reg"  type="text"   id="txt_prec_reg" title="Precio_regalo"   size="10" /></td>
                </tr>
                
                <tr id="tam_reg" style="display:none">
                  <td height="19"  align="right">Cantidad del regalo: </td>
                  <td colspan="2"><input   name="txt_cant_reg"  type="text"   id="txt_cant_reg" title="Cantidad_regalo"   size="10" /></td>
                </tr>
                <tr id="porc_grat" style="display:none">
                  <td height="19"  align="right">Porcentaje de regalo: </td>
                  <td colspan="2"><input   name="txt_porc_grat"  type="text"   id="txt_porc_grat" title="Porcentaje_gratis"   size="10" /></td>
                </tr>
                <tr id="val_desc" style="display:none">
                  <td height="19"  align="right">Valor de descuento: </td>
                  <td colspan="2"><input   name="txt_val_desc"  type="text"   id="txt_val_desc" title="Valor_descuento"   size="10" /></td>
                </tr>
                <tr id="porc_desc" style="display:none">
                  <td height="19"  align="right">Porcentaje de descuento: </td>
                  <td colspan="2"><input   name="txt_porc_desc"  type="text"   id="txt_porc_desc" title="Porcentaje_descuento"   size="10" /></td>
                </tr>
              
                <tr> 
                  <td height="19"  align="right">Precio m&iacute;nimo:</td>
                  <td colspan="2"> <div align="left">
                    <input name="txt_min"   disabled="disabled" id="txt_min" title="Precio M&iacute;nimo" value="<?php echo $precio_min;?>" size="10" />
                  </div></td>
                </tr>
                <tr align="center">
                  <td height="19" align="right">Precio m&aacute;ximo:</td>
                  <td colspan="2" align="left"><input name="txt_max"   disabled="disabled" id="txt_max" title="Precio M&aacute;ximo" value="<?php echo $precio_max;?>" size="10" /></td>
                </tr>
                
                
                <?php  if($rol=="admin" || $rol=='edito') {?>
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
                        <option value="2">E1: Cierre temporal del establecimiento</option>
                        <option value="3">E2: Cierre definitivo del establecimiento</option>
                        <option value="4">E3: Establecimiento no Visitado</option>
                         
                        <?php /*                     
						$tabla=n_inc;
						$campo0=inc;
						$campo_id=id_inc;
						$id=$rs->fields["id_inc"];
						include($x."php/selected.php");*/
						?>
                     </select></td>
                </tr>
                <?php if($rol=='admin'){?><?php }//<option value="1">--No disponible--</option>?>
                <tr align="center" id="observ"> 
                  <td height="14"><div align="right">Observación:</div></td>
                  <td height="14" colspan="2"><div align="left">
                    <select name="sel_obs" title="Observación" id="sel_obs" onChange="validar_obs('hide_price','precio_obs')">
                     	
                        <option value="6">VR: Variación real</option>
                        <option value="4">O: En oferta</option>
                        <option value="2">FE: Falta estacional</option>
                        <option value="3">FD: Falta definitiva</option>                        
                        <option value="5">FO: Falta ocasional</option>
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
                    </div>
                  </td>
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
                <tr> 
                  <td height="14" colspan="3" align="right">&nbsp; </td>
                </tr>
              </table>
              
			  <br>
		    </form >
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
