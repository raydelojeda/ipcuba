<?php
$x="../../../";
$tabla="n_var_estab";
$campo="id_var_estab";
$location="l_var_estab.php";
include($x."php/modificar.php");
include($x."php/session/session_admin.php");
$array2=array("D-1","L-1","Ma-1","Mi-1","J-1","V-1","S-1","D-2","L-2","Ma-2","Mi-2","J-2","V-2","S-2","D-3","L-3","Ma-3","Mi-3","J-3","V-3","S-3","D-4","L-4","Ma-4","Mi-4","J-4","V-4","S-4",);

if ($_GET["curr_page"]!="")
{	
	$curr_page = $_GET["curr_page"]; 
	$ver = $_GET["regis_cant"]; //print $curr_page." ".$regis_cant;	
}

if (isset($_GET["order"])) $order = $_GET["order"]; else $order=estab;
if (isset($_GET["type"])) $ordtype = $_GET["type"]; else $ordtype=asc;

if ($_GET["txt_filtro"]!="") $txt_filtro = $_GET['txt_filtro'];
if (isset($_POST["txt_filtro"])) $txt_filtro = $_POST['txt_filtro'];



if ($_GET["sel_filtro"]!="") $sel_filtro = $_GET['sel_filtro'];
if (isset($_POST["sel_filtro"])) $sel_filtro = $_POST['sel_filtro'];

if ($_GET["sel_cod_dpa"]!="") $sel_cod_dpa = $_GET['sel_cod_dpa'];
if (isset($_POST["sel_cod_dpa"])) $sel_cod_dpa = $_POST['sel_cod_dpa'];


if ($_GET["cerrar"]!="")
{$cerrar=$_GET["cerrar"];}

	//print $rs->fields["id"];
	$mensaje = "";
if ($_GET["var_aux_mod"]!="")
{	
	$query = " where id_var_estab = '".$_GET["var_aux_mod"]."'
	and b_variedad.id_mercado=n_mercado.id_mercado and 
	b_variedad.id_variedad=n_variedad.id_variedad and 
	n_estab.id_estab=n_var_estab.id_estab and 
	b_variedad.idb_variedad=n_var_estab.idb_variedad 
	and n_unidad.id_unidad=n_var_estab.id_unidad"; 
}
if ($_POST["var_aux_mod"]!="")
{	
	$query = " where id_var_estab = '".$_POST["var_aux_mod"]."' 
	and b_variedad.id_mercado=n_mercado.id_mercado and 
	b_variedad.id_variedad=n_variedad.id_variedad and 
	n_estab.id_estab=n_var_estab.id_estab and 
	b_variedad.idb_variedad=n_var_estab.idb_variedad"; 
}

$sql = "select id_var_estab,b_variedad.idb_variedad,cod_dpa,id_tipologia,n_mercado.id_mercado, fecha, n_estab.id_estab,cod_var, variedad,b_variedad.id_variedad, fecha_captar, cod_estab, estab,n_var_estab.id_unidad, cantidad,
carac1,carac2,carac3,carac4,carac5,carac6,
valor1,valor2,valor3,valor4,valor5,valor6

from n_var_estab,b_variedad,n_mercado, n_variedad, n_estab,n_unidad".$query;
//print $sql;
$rs = $db->Execute($sql);
$idb_variedad=$rs->fields["idb_variedad"];
$id_mercado=$rs->fields["id_mercado"];
$id_tipologia=$rs->fields["id_tipologia"];
$idb_variedad=$rs->fields["idb_variedad"];
$fecha_base = $rs->Fields('fecha');

$fecha_captar=$rs->fields["fecha_captar"];
$id_estab=$rs->fields["id_estab"];
//print $fecha_captar;
if(isset($_POST['txt_fecha']))
{
	$magic_quotes = get_magic_quotes_gpc();
	
	$txt_fecha = $_POST['txt_fecha'];
	$txt_fecha=substr($fecha_base,0,8).$txt_fecha;
	$sel_unidad = $db->qstr($_POST['sel_unidad'], $magic_quotes);
	$txt_cantidad = $db->qstr($_POST['txt_cantidad'], $magic_quotes);
	$idb_variedad = $db->qstr($_POST['sel_variedad'], $magic_quotes);
	$txt_valor1 = $db->qstr($_POST['txt_valor1'], $magic_quotes);
	$txt_valor2 = $db->qstr($_POST['txt_valor2'], $magic_quotes);
	$txt_valor3 = $db->qstr($_POST['txt_valor3'], $magic_quotes);
	$txt_valor4 = $db->qstr($_POST['txt_valor4'], $magic_quotes);
	$txt_valor5 = $db->qstr($_POST['txt_valor5'], $magic_quotes);
	$txt_valor6 = $db->qstr($_POST['txt_valor6'], $magic_quotes);
	
	
	if($txt_valor1=="")
	{$txt_valor1 = $db->qstr($rs->fields["valor1"], $magic_quotes);}//print $txt_valor1;
	
	if($txt_valor2=="")
	$txt_valor2 = $db->qstr($rs->fields["valor2"], $magic_quotes);
	
	if($txt_valor3=="")
	$txt_valor3 = $db->qstr($rs->fields["valor3"], $magic_quotes);
	
	if($txt_valor4=="")
	$txt_valor4 = $db->qstr($rs->fields["valor4"], $magic_quotes);
	
	if($txt_valor5=="")
	$txt_valor5 = $db->qstr($rs->fields["valor5"], $magic_quotes);
	
	if($txt_valor6=="")
	$txt_valor6 = $db->qstr($rs->fields["valor6"], $magic_quotes);
	
	$bool_uno = $_POST['chec_bool'];
	$bool_dos = $_POST['chec_bool_dos'];
	
	//print $bool_uno." - ".$bool_dos;
	 
	if($bool_uno=='1')
	{ 
		/*$sqls = "select idb_variedad from b_variedad where id_variedad='".$_POST["var_id"]."'";//print $sqls;
		$rss = $db->Execute($sqls) or die($db->ErrorMsg());
		$cant=$rss->RecordCount();
		 for($v=0;$v<$cant;$v++)
		 {$id=$rss->fields["idb_variedad"];*/
		
			$sql1 = "UPDATE n_var_estab 
			SET id_unidad=$sel_unidad, cantidad=$txt_cantidad, idb_variedad=$idb_variedad, valor1=$valor1, valor2=$valor2, valor3=$valor3, valor4=$valor4, valor5=$valor5, valor6=$valor6 
			WHERE idb_variedad = ".$idb_variedad;
			//print $sql1;
			$rs1 = $db->Execute($sql1) or $mensaje=$db->ErrorMsg() ;
	if($rs1)
			{
			$gestor = @fopen($camino, "a");
				if ($gestor) 
				{
				   
				   if (fwrite($gestor, $sql1.";\r\n") === FALSE) 
					{
						echo "No se puede escribir al archivo.";
						exit;
					}
					fclose($gestor);
				}
			}	
										
			
			//$rss->MoveNext();
		// }
	}
		
	elseif($bool_dos=='1')
	{ 
		/*$sqls = "select idb_variedad from b_variedad where id_variedad='".$_POST["var_id"]."'";//print $sqls;
		$rss = $db->Execute($sqls) or die($db->ErrorMsg());
		$cant=$rss->RecordCount();
		 for($v=0;$v<$cant;$v++)
		 {$id=$rss->fields["idb_variedad"];*/
		
			$sql2 = "UPDATE n_var_estab 
			SET fecha_captar='$txt_fecha' 
			WHERE id_estab = '".$id_estab."'";
			//print $sql2;
			$rs1 = $db->Execute($sql2) or $mensaje=$db->ErrorMsg() ;
	if($rs2)
			{
			$gestor = @fopen($camino, "a");
				if ($gestor) 
				{
				   
				   if (fwrite($gestor, $sql2.";\r\n") === FALSE) 
					{
						echo "No se puede escribir al archivo.";
						exit;
					}
					fclose($gestor);
				}
			}	
										
			
			//$rss->MoveNext();
		// }
	}	
	else
	{
$sql4 = "UPDATE n_var_estab 
SET fecha_captar='$txt_fecha', id_unidad=$sel_unidad, cantidad=$txt_cantidad, idb_variedad=$idb_variedad, valor1=$txt_valor1, valor2=$txt_valor2, valor3=$txt_valor3, valor4=$txt_valor4, valor5=$txt_valor5, valor6=$txt_valor6
WHERE id_var_estab = '".$_POST["var_id"]."'";
//print $sql4." 4 ";
$rs4 = $db->Execute($sql4) or $mensaje=$db->ErrorMsg() ;
if($rs4)
		{
		$gestor = @fopen($camino, "a");
			if ($gestor) 
			{
			   
			   if (fwrite($gestor, $sql4.";\r\n") === FALSE) 
				{
					echo "No se puede escribir al archivo.";
					exit;
				}
				fclose($gestor);
			}
		}	
	}	    
		
		
		
$sql3 = "UPDATE n_var_estab SET cantidad=$txt_cantidad,id_unidad=$sel_unidad,
valor1=$txt_valor1, valor2=$txt_valor2, valor3=$txt_valor3, 
valor4=$txt_valor4, valor5=$txt_valor5, valor6=$txt_valor6
WHERE id_estab = '".$id_estab."' and idb_variedad = ".$idb_variedad;
//print $sql;
$rs3 = $db->Execute($sql3) or $mensaje=$db->ErrorMsg() ;	
		
		
		
								if($rs3)
									{
									$gestor = @fopen($camino, "a");
										if ($gestor) 
										{
										   
										   if (fwrite($gestor, $sql3.";\r\n") === FALSE) 
											{
												echo "No se puede escribir al archivo.";
												exit;
											}
											fclose($gestor);
										}
									}	
	//print $rs;
	if($rs1 || $rs2 || $rs3 || $rs4)
	{
	if($cerrar==1)
		{
		?>
		<script language="JavaScript">
		window.close();//alert("sdfdsf");
		</script>
		<?php
		}
		else	
		header("Location: l_var_estab.php?curr_page=".$curr_page."&regis_cant=".$regis_cant."");
	$mensaje= "Se modificó satisfactoriamente en la BD.";
	}
	else
	$mensaje= "ERROR. No se pudo modificar en la BD.";
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
<link href="../../../css/gris.css" rel="stylesheet" type="text/css"> 
<?php }elseif($_SESSION["estilo"]=="v"){?>
<link href="../../../css/verde.css" rel="stylesheet" type="text/css"> 
<?php } else {?>
<link href="../../../css/azul.css" rel="stylesheet" type="text/css"> 
<?php }?>
<link rel="stylesheet" href="../../../css/theme.css" type="text/css" />
<link rel="shortcut icon" href="../../../imagenes/flecha.ico"/> 
<link rel="stylesheet" type="text/css" href="../../../css/resources/css/ext-all.css" />
</head> 

<script type="text/javascript" src="../../../javascript/yui/yui-utilities.js"></script>  
<script type="text/javascript" src="../../../javascript/yui/ext-yui-adapter.js"></script>
<script language="javascript" src="../../../javascript/yui/ext-all.js"></script>

<script language="JavaScript" src="../../../javascript/JSCookMenu_mini.js" type="text/javascript"></script> 
<script language="JavaScript" src="../../../javascript/theme.js" type="text/javascript"></script>
<script language="javascript" src="../../../javascript/cal2.js"></script>
<script language="javascript" src="../../../javascript/cal_conf2.js"></script>
<script language="javascript" src="../../../javascript/overlib_mini.js"></script>

<script src="../../../javascript/funciones.js" type="text/javascript">
</script> 
<body> 
<table width="750"  border="1"  align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td>

<table width="750" border="0"  align="center" cellpadding="0" cellspacing="0" >
<tr> 
          <td><img src="../../../imagenes/banner.jpg" width="750" height="35"></td>
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
<script language="javascript"  src="../../../javascript/menu_autor_m.js">	
		</script>
<?php
}
elseif($_SESSION["rol"] == 'aut_p')
{
?>
		<script language="javascript"  src="../../../javascript/menu_autor_p.js">	
		</script>
<?php
}
elseif($_SESSION["rol"] == 'edito')
{
?>
	<script language="javascript"  src="../../../javascript/menu_editor.js">	
		</script>
<?php
}
elseif($_SESSION["rol"] == 'admin')
{
?>
	<script language="javascript"  src="../../../javascript/menu_admin.js">	
		</script>
        
<?php
}
elseif($_SESSION["rol"] == 'super')
{
?>
	<script language="javascript"  src="../../../javascript/menu_super.js">	
		</script>
        
<?php
}
elseif($_SESSION["rol"] == 'jefes')
{
?>
	<script language="javascript"  src="../../../javascript/menu_jefes.js">	
		</script>


<?php
} else
{
?>
<script language="javascript"  src="../../../javascript/menu_invitado.js">	
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
		?>', ABOVE, RIGHT);" onMouseOut="return nd();"href="../../../php/logout.php" style="color: #333333; font-weight: bold"><?php print $_SESSION["user"];?>&nbsp;<img style="vertical-align:bottom"  border="0"src="../../../imagenes/extrasmall/exit.gif">
			&nbsp; </a>
	</td>
</tr>
</table>
   
   
   
  </tr>
  <tr>
          <td align="center" valign="middle" bgcolor="#ffffff"><!-- InstanceBeginEditable name="Body" --> 
            <form name="frm"  id="frm" method="post" action="" onSubmit="MM_validateForm('txt_cantidad','','RisNum');return document.MM_returnValue">
<table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
<tr>
	
	<td class="menudottedline" align="right">
			
			<table width="100%" border="0" class="menubar"  id="toolbar">
              <tr > 
                <td width="7%" valign="middle"  class="us"><img src="../../../imagenes/admin/module.png" width="48" height="48" border="0"><strong><font color="#000000" size="1"> 
                  </font></strong></td>
                        <td valign="middle"  class="us"><strong><font color="#5A697E" size="4">Control 
                          de variedad-establecimiento: <font size="2">Modificar</font></font></strong> 
                          <div align="center"></div></td>
                <td width="1%"> <div align="center"> <a  class="toolbar" href="javascript:document.frm.submit();"> 
                    <input type="image"   name="btn_save" id="btn_save"   src="../../../imagenes/admin/save_f2.png" alt="Guardar" width="32" height="32" border="0">
                    <br>
                    <label>Guardar</label></a> </div></td>
                <td width="7%"> <div align="center"> <a class="toolbar" href="l_var_estab.php?curr_page=<?php print $curr_page;?>&regis_cant=<?php print $ver;?>&order=<?php print $order; ?>&type=<?php print $ordtype;?>&txt_filtro=<?php print $txt_filtro;?>&sel_filtro=<?php print $sel_filtro;?>&sel_cod_dpa=<?php print $sel_cod_dpa;?>"> 
                    <img name="imageField2" src="../../../imagenes/admin/cancel_f2.png" alt="Cerrar" width="32" height="32" border="0">
                    <br>
                    Cancelar</a> </div></td>
                <td width="6%"> <div align="center"><a class="toolbar" href="#" onClick="window.open('../../help/m_var_estab.htm', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                    <img src="../../../imagenes/admin/help_f2.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" /><br>
                    Ayuda</a></div></td>
              </tr>
            </table>
			</td></tr></table>
            
              <br>     
              <table width="91%" height="155" align="center"  class="tabla">
                <tr> 
                  <td height="22" colspan="3">&nbsp; </td>
                </tr>
                <?php $dpa=substr($rs->Fields("cod_dpa"),0,2);?>
                <tr>
                  <td width="28%" height="20" align="right">C&oacute;digo DPA:</td>
                  <td width="71%" colspan="2"><select  disabled name="provincia" id="provincia" title="C&oacute;digo DPA" onChange="document.frm.submit();">
                   
                    <option value="01" <?php if($dpa=="01") print "selected"; ?>>01. Pinar del R&iacute;o</option>
                    <option value="02"<?php if($dpa=="02") print "selected"; ?>>02. La Habana</option>
                    <option value="03"<?php if($dpa=="03") print "selected"; ?>>03. Ciudad Habana</option>
                    <option value="04"<?php if($dpa=="04") print "selected"; ?>>04. Matanzas</option>
                    <option value="05"<?php if($dpa=="05") print "selected"; ?>>05. Villa Clara</option>
                    <option value="06"<?php if($dpa=="06") print "selected"; ?>>06. Cienfuegos</option>
                    <option value="07"<?php if($dpa=="07") print "selected"; ?>>07. Sancti Sp&iacute;ritus</option>
                    <option value="08"<?php if($dpa=="08") print "selected"; ?>>08. Ciego de Avila</option>
                    <option value="09"<?php if($dpa=="09") print "selected"; ?>>09. Camag&uuml;ey</option>
                    <option value="10"<?php if($dpa=="10") print "selected"; ?>>10. Las Tunas</option>
                    <option value="11"<?php if($dpa=="11") print "selected"; ?>>11. Holgu&iacute;n</option>
                    <option value="12"<?php if($dpa=="12") print "selected"; ?>>12. Granma</option>
                    <option value="13"<?php if($dpa=="13") print "selected"; ?>>13. Santiago de Cuba</option>
                    <option value="14"<?php if($dpa=="14") print "selected"; ?>>14. Guant&aacute;namo</option>
                    <option value="15"<?php if($dpa=="15") print "selected"; ?>>15. Isla de la Juventud</option>
                  </select></td>
                </tr>
                <tr>
                  <td height="20" align="right">Mercado:</td>
                  <td colspan="2"><select disabled name="sel_mercado" title="Mercado" id="sel_mercado" onChange="document.frm.submit();">
                    
                    <?php 
                     											
									$id=$_POST['sel_mercado'];
									if($_POST['sel_tipologia']!="0" && $_POST['sel_tipologia']!="")
									{
									$query_mercado = "select distinct mercado, n_mercado.id_mercado 
									from n_estab, n_mercado, b_variedad, n_tipologia 
									where n_mercado.id_mercado=n_estab.id_mercado and 
									n_mercado.id_mercado=b_variedad.id_mercado and n_estab.id_tipologia='".$_POST['sel_tipologia']."'";
									}
									else
									{
									$query_mercado = "select distinct mercado, n_mercado.id_mercado 
									from n_estab, n_mercado, b_variedad 
									where n_mercado.id_mercado=n_estab.id_mercado and n_mercado.id_mercado=b_variedad.id_mercado";
									}
									
									$rs_mercado=$db->Execute($query_mercado) or $mensaje=$db->ErrorMsg() ;
									$cant_rs=$rs_mercado->RecordCount();
										for ($i = 0; $i < $cant_rs;$i++)
										{
											$rs_fields0=$rs_mercado->Fields('mercado');
											$rs_fields_id=$rs_mercado->Fields('id_mercado');
											$id=$id_mercado;								 											
											
											echo"<option value=";echo $rs_fields_id;if($rs_fields_id==$id){echo " selected ";$aux=$rs_fields_id;} echo "> "; if($rs_fields1){echo $rs_fields1; print ". ";}echo $rs_fields0; echo "</option>";
											$rs_mercado->MoveNext();
										}
								    ?>
                  </select></td>
                </tr>
                <tr>
                  <td height="20" align="right">Tipolog&iacute;a:</td>
                  <td colspan="2"><select disabled name="sel_tipologia" id="sel_tipologia" onChange="document.frm.submit();"> 
                    
                    <?php 
						//print $_POST['sel_mercado'];
						if($_POST['sel_mercado']!="0" && $_POST['sel_mercado']!="" && $_POST['provincia']!="0" && $_POST['provincia']!="")
						{
                    	 $query_tipologia = "select distinct tipologia, n_tipologia.id_tipologia from n_tipologia, n_estab, n_dpa WHERE n_dpa.cod_dpa=n_estab.cod_dpa and n_tipologia.id_tipologia=n_estab.id_tipologia and n_estab.id_mercado='".$_POST['sel_mercado']."' and n_dpa.cod_dpa like '".$_POST['provincia']."%' order by tipologia";		
						  $rs_tipologia=$db->Execute($query_tipologia) or die($db->ErrorMsg()) ;
					     // print	$query_sel;
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
						
						
						
						
						
						else
						{
						$query_tipologia = "select distinct tipologia, n_tipologia.id_tipologia from n_tipologia, n_estab, n_dpa WHERE n_dpa.cod_dpa=n_estab.cod_dpa and n_tipologia.id_tipologia=n_estab.id_tipologia and n_estab.id_mercado='$id_mercado'and n_dpa.cod_dpa like '".$dpa."%' order by tipologia";
						 
						 $rs_tipologia=$db->Execute($query_tipologia) or die($db->ErrorMsg()) ;
					      print	$query_tipologia;
						 $cant_rs_tipologia=$rs_tipologia->RecordCount();
 							for ($t = 0; $t < $cant_rs_tipologia;$t++)
							{
							$rs_fields0=$rs_tipologia->Fields("tipologia");
							$rs_fields1="";
							$rs_fields_id=$rs_tipologia->Fields("id_tipologia");
							$id=$id_tipologia;
							print $rs_fields_id." - ".$id;
							echo"<option value=";echo $rs_fields_id;if($rs_fields_id==$id){echo " selected ";} echo "> "; if($rs_fields1){echo $rs_fields1; print ". ";}echo $rs_fields0; echo "</option>";
        					$rs_tipologia->MoveNext();
							}
						}	
						
											
					 ?>
                  </select></td>
                </tr>
                <tr>
                  <td height="20"   align="right">Variedad:</td>
                  <td colspan="2"><select name="sel_variedad" title="Variedad" id="sel_variedad">
                  
                  <?php 
						//print $_POST['sel_mercado'];
						if($_POST['sel_mercado']!="0" && $_POST['sel_mercado']!="")
						{
                    	 $query_variedad = "select b_variedad.idb_variedad, ecod_var, variedad from n_variedad, b_variedad WHERE n_variedad.id_variedad=b_variedad.id_variedad and b_variedad.id_mercado='".$_POST['sel_mercado']."' order by n_variedad.ecod_var";
						 $rs_variedad=$db->Execute($query_variedad) or die($db->ErrorMsg()) ;
					      print	$query_variedad;
						 $cant_rs=$rs_variedad->RecordCount();
 							for ($i = 0; $i < $cant_rs;$i++)
							{
							$rs_fields0=$rs_variedad->Fields("variedad");
							$rs_fields1=$rs_variedad->Fields("ecod_var");
							$rs_fields_id=$rs_variedad->Fields("idb_variedad");
							$id=$idb_variedad;										                            
							echo"<option value=";echo $rs_fields_id;if($rs_fields_id==$id){echo " selected ";} echo "> "; if($rs_fields1){echo $rs_fields1; print ". wrf";}echo $rs_fields0; echo "</option>";
        					$rs_variedad->MoveNext();
							}
						}	
						
						else
						{
                    	 $query_variedad = "select b_variedad.idb_variedad, ecod_var, variedad from n_variedad, b_variedad WHERE n_variedad.id_variedad=b_variedad.id_variedad and b_variedad.id_mercado='$id_mercado' order by n_variedad.ecod_var";
						 $rs_variedad=$db->Execute($query_variedad) or die($db->ErrorMsg()) ;
					     // print	$query_variedad;
						 $cant_rs=$rs_variedad->RecordCount();
 							for ($i = 0; $i < $cant_rs;$i++)
							{
							$rs_fields0=$rs_variedad->Fields("variedad");
							$rs_fields1=$rs_variedad->Fields("ecod_var");
							$rs_fields_id=$rs_variedad->Fields("idb_variedad");
							$id=$idb_variedad;										                            print $rs_fields_id." - ".$id;
							echo"<option value=";echo $rs_fields_id;if($rs_fields_id==$id){echo " selected ";}else $_POST['sel_cod_var']=""; echo "> "; if($rs_fields1){echo $rs_fields1; print ". ";}echo $rs_fields0; echo "</option>";
        					$rs_variedad->MoveNext();
							}
						}				
					 ?> </select>                                       </td>
                </tr>
                
                <tr> 
                  <td height="19"> <div align="right">Establecimiento:</div></td>
                  <td colspan="2"><div align="left">
                    <input name="sel_estab" type="text"  disabled id="sel_estab" title="C&oacute;digo Establecimiento"
                        value="<?php print $rs->Fields("cod_estab").". ".$rs->Fields("estab");//print $query_sel;?>" size="35"></div></td>
                </tr>
                
                
                
                <tr>
                  <td height="19" align="right">D&iacute;a a captar:</td>
                  <td align="left"><div align="left">
                    <select name="txt_fecha">  
                  <?php for ($k=0;$k<28;$k++){?>
                  <option value="<?php print $k+1;?>" <?php if($k==substr($rs->fields["fecha_captar"],8,2)-1)print "selected";?>><?php echo $array2[$k];?></option>
                  <?php }?> 
                  </select> 
                    &nbsp;</div></td>
                  <td align="left">D&iacute;a generalizado:
                    <input  name="chec_bool_dos" type="checkbox"  value="1"></td>
                </tr>
                
                <tr>
                  <td height="19" align="right">Unidad de medida:</td>
                  <td colspan="2" align="left"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">
                    <select name="sel_unidad" title="Unidad de Medida" id="sel_unidad" >
                      
                      <?php 
                     				$tabla=n_unidad;
									$campo0=unidad;
									$campo1="";									
									$campo_id=id_unidad;
									$id=$rs->fields["id_unidad"];
									include($x."php/selected.php");
								    ?>
                    </select>
                  </font></strong></td>
                  <td align="left">&nbsp;</td>
                </tr>
                <tr>
                  <td height="19" align="right">Cantidad:</td>
                  <td colspan="2" align="left"><input name="txt_cantidad" type="text"   id="txt_cantidad" title="Cantidad"value="<?php print $rs->Fields("cantidad");//print $query_sel;?>" ></td>
                  <td align="left">&nbsp;</td>
                </tr>
                <?php if($rs->Fields("carac1")){?>
                <tr>
                  <td height="19" align="right"><?php print $rs->Fields("carac1").":";?></td>
                  <td colspan="2" align="left"><input name="txt_valor1" type="text"   id="txt_valor1" title="Característica"value="<?php print $rs->Fields("valor1");?>" size="50" maxlength="50" ></td>
                  <td align="left">&nbsp;</td>
                </tr>
                <?php }if($rs->Fields("carac2")){?>
                <tr>
                  <td height="19" align="right"><?php print $rs->Fields("carac2").":";?></td>
                  <td colspan="2" align="left"><input name="txt_valor2" type="text"   id="txt_valor2" title="Caracter&iacute;stica"value="<?php print $rs->Fields("valor2");?>" size="50" maxlength="50" ></td>
                  <td align="left">&nbsp;</td>
                </tr>
                <?php }if($rs->Fields("carac3")){?>
                <tr>
                  <td height="19" align="right"><?php print $rs->Fields("carac3").":";?></td>
                  <td colspan="2" align="left"><input name="txt_valor3" type="text"   id="txt_valor3" title="Caracter&iacute;stica"value="<?php print $rs->Fields("valor3");?>" size="50" maxlength="50" ></td>
                  <td align="left">&nbsp;</td>
                </tr>
                <?php }if($rs->Fields("carac4")){?>
                <tr>
                  <td height="19" align="right"><?php print $rs->Fields("carac4").":";?></td>
                  <td colspan="2" align="left"><input name="txt_valor4" type="text"   id="txt_valor4" title="Caracter&iacute;stica"value="<?php print $rs->Fields("valor4");?>" size="50" maxlength="50" ></td>
                  <td align="left">&nbsp;</td>
                </tr>
                <?php }if($rs->Fields("carac5")){?>
                <tr>
                  <td height="19" align="right"><?php print $rs->Fields("carac5").":";?></td>
                  <td colspan="2" align="left"><input name="txt_valor5" type="text"   id="txt_valor5" title="Caracter&iacute;stica"value="<?php print $rs->Fields("valor5");?>" size="50" maxlength="50" ></td>
                  <td align="left">&nbsp;</td>
                </tr>
                <?php }if($rs->Fields("carac6")){?>
                <tr>
                  <td height="19" align="right"><?php print $rs->Fields("carac6").":";?></td>
                  <td colspan="2" align="left"><input name="txt_valor6" type="text"   id="txt_valor6" title="Caracter&iacute;stica"value="<?php print $rs->Fields("valor6");?>" size="50" maxlength="50" ></td>
                  <td align="left">&nbsp;</td>
                </tr>
                <?php }?>
                <tr>
                  <td height="19" align="right">Cantidad y U/M generalizada:</td>
                  <td colspan="2" align="left"><input  name="chec_bool" type="checkbox"  value="1"></td>
                  <td align="left">&nbsp;</td>
                </tr>
                <tr> 
                  <td height="6" align="right">&nbsp;</td>
                  <td colspan="2" align="left">&nbsp;</td>
                  <td width="1%" align="left"><div align="left"> </div></td>
                </tr>
              </table>
              <p>&nbsp;</p>
              <p> 
                <input  type="hidden" name="var_id" value="<?php echo $rs->Fields("id_var_estab");?>">
                <?php if ($mensaje) print $mensaje; ?>
              </p>
            </form>
            <!-- InstanceEndEditable --></td>
  </tr>
  
	</table>
	
	 </td></tr></table>
	
<table width="754" height="21"  border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#5A697E">
  <tr> 
    <td width="30" height="21"  align="center" valign="middle"> <div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><img src="../../../imagenes/down.jpg" width="30" height="26"></font></div></td>
    <td width="695"  align="center" valign="middle" bgcolor="#4B4B4B">
      <div align="center"><font color="#FFFFFF" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>ONEI - 
    IPC 2009-2012</strong></font></div></td>
    <td width="30"  align="center" valign="middle"><div align="center"><img src="../../../imagenes/up.jpg" width="30" height="26"></div></td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
