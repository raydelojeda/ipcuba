<?php
$x="../../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."php/session/session_autor_p.php");

//---------------------------------------------------					 
$sql_fecha = "select max(fecha) from b_variedad";		
$rs_fecha = $db->Execute($sql_fecha)or $mensaje=$db->ErrorMsg() ;
$fecha_base = $rs_fecha->Fields('max');//print $x;
//---------------------------------------------------

$query_usuario = " where usuario='".$_SESSION["user"]."' and n_dpa.cod_dpa=usuario.cod_dpa"; 
$sql_usuario = "select rol, id_usuario, usuario.cod_dpa,prov_mun from usuario,n_dpa".$query_usuario;	
$rs_usuario = $db->Execute($sql_usuario)or $mensaje=$db->ErrorMsg() ;
$cod_dpa=substr($rs_usuario->Fields("cod_dpa"),0,2)."%";
$rol=$rs_usuario->Fields("rol");
$mensaje="";
if(isset($_POST['txt_estab']))
{
	$magic_quotes = get_magic_quotes_gpc();
	
	$txt_estab = $db->qstr($_POST['txt_estab'], $magic_quotes);
	$txt_cod_estab = $db->qstr($_POST['txt_cod_estab'], $magic_quotes);
	$txt_dir = $db->qstr($_POST['txt_dir'], $magic_quotes);
	$sel_cod_dpa= $db->qstr($_POST['sel_cod_dpa'], $magic_quotes);
	$sel_tipologia= $db->qstr($_POST['sel_tipologia'], $magic_quotes);
	$sel_mercado= $db->qstr($_POST['sel_mercado'], $magic_quotes);
	$sel_org= $db->qstr($_POST['sel_org'], $magic_quotes);	
	$txt_contacto= $db->qstr($_POST['txt_contacto'], $magic_quotes);	
	$sel_estab_sus= $_POST['sel_estab_sus'];
	$fecha_sus=date("Y/m/d");
		
	if( $_POST['txt_estab']!='' && $_POST['txt_cod_estab']!='' && $_POST['txt_dir']!='' && $_POST['sel_cod_dpa']!='' && $_POST['sel_tipologia']!='' && $_POST['sel_mercado']!='') 
	{
		//---------------------------------------------------
		$tabla="n_estab";
		$campo="cod_estab";
		$valor=$txt_cod_estab;		
		include($x."php/insertar.php");
		//---------------------------------------------------
		
		if(!$rs->fields[0])
		{		
	$sql="INSERT INTO n_estab (cod_estab,estab,dir,cod_dpa,id_tipologia,id_mercado,desuso,id_estab_sustituido,fecha_sus, org_sup, contacto) 
	VALUES ($txt_cod_estab ,$txt_estab,$txt_dir,$sel_cod_dpa,$sel_tipologia,$sel_mercado,'0',$sel_estab_sus,'$fecha_sus',$sel_org, $txt_contacto)";//print $sql;
	$rs=$db->Execute($sql) or $mensaje=$db->ErrorMsg();
	//==============================================
	 if($rs)
		{
		$gestor = @fopen($camino, "a");
			if ($gestor) 
			{
			   
			   if (fwrite($gestor, $sql.";\r\n") === FALSE) 
				{
					echo "No se puede escribir al archivo.";
					exit;
				}
				fclose($gestor);
			}
		}
	//==============================================

	if($sel_estab_sus!=0)
	{	
		//-----------------------------------------------------------
		$sql_sel_estab = "select id_estab from n_estab where cod_estab=$txt_cod_estab";	
		$rs_sel_estab = $db->Execute($sql_sel_estab) or $mensaje=$db->ErrorMsg();
		$id_estab_nuevo = $rs_sel_estab->Fields("id_estab");
		
		$sql_upd="UPDATE n_estab set desuso='1', fecha_sus='".date("Y/m/d")."',id_estab_sustituido='$id_estab_nuevo' where id_estab='$sel_estab_sus'";//print $sql_upd;
		$rs_upd=$db->Execute($sql_upd) or die($db->ErrorMsg());//poniendo en desuso el estab
		
		//==============================================
		 if($rs_upd)
			{
			$gestor = @fopen($camino, "a");
				if ($gestor) 
				{
				   
				   if (fwrite($gestor, $sql_upd.";\r\n") === FALSE) 
					{
						echo "No se puede escribir al archivo.";
						exit;
					}
					fclose($gestor);
				}
			}
		//==============================================
		
		$sql_sel = "select * from n_var_estab, b_variedad, n_variedad
		where n_variedad.id_variedad=b_variedad.id_variedad 
		and b_variedad.idb_variedad=n_var_estab.idb_variedad
		and desuso='0' and id_estab='$sel_estab_sus'";//print $sql_sel;	
		$rs_sel = $db->Execute($sql_sel) or $mensaje=$db->ErrorMsg() ;
		$cant_estab=$rs_sel->RecordCount(); 
		
		for($w=0;$w<$cant_estab;$w++)
		{
		$id_var_estab=$rs_sel->Fields("id_var_estab");
		$id_variedad=$rs_sel->Fields("id_variedad");
		$fecha_captar=$rs_sel->Fields("fecha_captar");
		$id_unidad=$rs_sel->Fields("id_unidad");
		
		$sql_upd_var_estab="UPDATE n_var_estab set fecha_desuso='".date("Y/m/d")."', desuso='1' where id_var_estab='$id_var_estab'";
		$rs_upd_var_estab=$db->Execute($sql_upd_var_estab) or die($db->ErrorMsg());//poniendo en desuso las variedades del estab
		
		//==============================================
		 if($rs_upd_var_estab)
			{
			$gestor = @fopen($camino, "a");
				if ($gestor) 
				{
				   
				   if (fwrite($gestor, $sql_upd_var_estab.";\r\n") === FALSE) 
					{
						echo "No se puede escribir al archivo.";
						exit;
					}
					fclose($gestor);
				}
			}
		//==============================================
		//-------------------------------------------------------------
		
		$sql_b = "select b_variedad.idb_variedad from b_variedad, n_variedad
		where n_variedad.id_variedad=b_variedad.id_variedad 
		and b_variedad.id_variedad='$id_variedad' and id_mercado=$sel_mercado";//print $sql_b;die();
		$rs_b = $db->Execute($sql_b) or die($db->ErrorMsg());
		$idb_variedad=$rs_b->Fields("idb_variedad");
			if($idb_variedad=='')
			{
				$insert_b="INSERT INTO b_variedad (id_mercado,id_variedad,fecha,indice,central) 
				 VALUES ($sel_mercado,'$id_variedad','$fecha_base','1','0')";//print "<br>".$insert_b;//die();
				 $rs_insert_b=$db->Execute($insert_b) or die($db->ErrorMsg());
				 
				 //==============================================
				 if($rs_insert_b)
					{
					$gestor = @fopen($camino, "a");
						if ($gestor) 
						{
						   
						   if (fwrite($gestor, $insert_b.";\r\n") === FALSE) 
							{
								echo "No se puede escribir al archivo.";
								exit;
							}
							fclose($gestor);
						}
					}
				//==============================================
				 
				 	$sql_b = "select b_variedad.idb_variedad from b_variedad, n_variedad
					where n_variedad.id_variedad=b_variedad.id_variedad 
					and b_variedad.id_variedad='$id_variedad' and id_mercado=$sel_mercado";//print $sql_b;die();
					$rs_b = $db->Execute($sql_b) or die($db->ErrorMsg());
					$idb_variedad=$rs_b->Fields("idb_variedad");
			}
		
		$sql_inser_n_var_estab= "INSERT INTO n_var_estab (id_estab,idb_variedad,fecha_captar,id_unidad,fecha_creacion)  
		VALUES ('".$id_estab_nuevo."','".$idb_variedad."','".$fecha_captar."','".$id_unidad."','".date("Y-m-d")."')";//print "<br>".$query_rs."<br>";	  
	 	$rs_inser_n_var_estab=$db->Execute($sql_inser_n_var_estab) or die($db->ErrorMsg());
		
				//==============================================
				 if($rs_inser_n_var_estab)
					{
					$gestor = @fopen($camino, "a");
						if ($gestor) 
						{
						   
						   if (fwrite($gestor, $sql_inser_n_var_estab.";\r\n") === FALSE) 
							{
								echo "No se puede escribir al archivo.";
								exit;
							}
							fclose($gestor);
						}
					}
				//==============================================
		
		$rs_sel->MoveNext();
		}
	}
	
	$mensaje="El establecimiento ha sido insertado satisfactoriamente.";
			
		 	
		}	 
		else
		$mensaje="Ya existe un establecimiento con ese código en la BD.";
		
	
	}
	else				
		$mensaje="Existen campos vacíos.";
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
            <form  method="post" id="frm"  action="" name="frm" onSubmit="MM_validateForm('txt_dir','','R','txt_estab','','R');return document.MM_returnValue">
<table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
                <tr> 
                  <td class="menudottedline" align="right"> <table width="100%" border="0" class="menubar"  id="toolbar">
                      <tr > 
                        <td width="7%" valign="middle"  class="us"><img src="../../../imagenes/admin/frontpage.png" width="48" height="48" border="0"><strong><font color="#000000" size="1"> 
                          </font></strong></td>
                        <td valign="middle"  class="us"><strong><font color="#5A697E" size="4">Control 
                          de establecimiento : <font size="2">Insertar</font></font></strong> 
                        <div align="center"></div></td>
                        <td width="1%"> <div align="center"> <a  class="toolbar" href="javascript:document.frm.submit();"> 
                            <input type="image"   name="btn_save" id="btn_save"   src="../../../imagenes/admin/save_f2.png" alt="Guardar" width="32" height="32" border="0">
                            <br>
                            <label>Guardar</label></a> </div></td>
                        <td width="7%"> <div align="center"> <a class="toolbar" href="l_estab.php"> 
                            <img name="imageField2" src="../../../imagenes/admin/cancel_f2.png" alt="Cerrar" width="32" height="32" border="0"> 
                            <br>
                            Cancelar</a> </div></td>
                        <td width="6%"> <div align="center"><a class="toolbar" href="#" onClick="window.open('../../help/estab.php', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                            <img src="../../../imagenes/admin/help_f2.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" /><br>
                            Ayuda</a></div></td>
                      </tr>
                      
                  </table></td>
                </tr>
              </table>
              <p>&nbsp;</p> 
              <table width="97%" height="351" align="center"  class="tabla">
                <tr> 
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr> 
                  <td width="37%" height="19" align="right">Mercado:</td>
                  <td width="63%"> <div align="left"> 
                      <select name="sel_mercado" title="Mercado" id="sel_mercado" onChange="javascript:document.frm.submit();">
                        <option value="0">-----------------------</option>
                        <?php 
                     				$tabla=n_mercado;
									$campo1=id_mercado;
									$campo0=mercado;
									$campo_id=id_mercado;
									$id=$_POST['sel_mercado'];
									include($x."php/selected.php");
								    ?>
                      </select>
                  </font></strong></div></td>
                </tr>
                <tr> 
                  <td height="19" align="right">Tipolog&iacute;a:</td>
                  <td><div align="left">
                      <select name="sel_tipologia" title="Tipología" id="sel_tipologia" onChange="javascript:document.frm.submit();">
                        <option value="0">-----------------------</option>
                      			  <?php 
                     				$tabla=n_tipologia;
									$campo1=id_tipologia_nueva;
									$campo0=tipologia;
									$campo_id=id_tipologia;
									$id=$_POST['sel_tipologia'];
									include($x."php/selected.php");
								    ?>
                      </select>
                  </font></strong></div></td>
                </tr>
                <tr> 
                  <td height="19" align="right">Código DPA</td>
                  <td> <div align="left"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
                      <select name="sel_cod_dpa" title="Código DPA" id="sel_cod_dpa" onChange="javascript:document.frm.submit();">
                        <option value="0">-----------------------</option>
                        <?php 
                     				$tabla="n_dpa where incluido='1'";
									$campo0=prov_mun;
									$campo1=cod_dpa_nueva;
									$campo_id=cod_dpa;
									$id=$_POST['sel_cod_dpa'];
									if($rol!="admin" && $rol!="super")										
									include($x."php/selected2.php");
									else
									include($x."php/selected.php");
								    ?>
                      </select>
                      </font></strong></div></td>
                </tr>
                
                <?php 
				/*print $_POST['sel_cod_dpa'];
					print $_POST['sel_mercado'];
					print $_POST['sel_tipologia']."dfe";*/
				if($_POST['sel_tipologia']!="0" && $_POST['sel_tipologia']!='' && $_POST['sel_mercado']!="0" && $_POST['sel_mercado']!='' && $_POST['sel_cod_dpa']!="0" && $_POST['sel_cod_dpa']!='')
				{
					$cod_dpa=$_POST['sel_cod_dpa'];
					$id_m=$_POST['sel_mercado'];
					$id_tip=$_POST['sel_tipologia'];
					
					$dpa="select * from n_dpa where incluido ='1' and cod_dpa='$cod_dpa'";
					$rs_dpa= $db->Execute($dpa)or $mensaje=$db->ErrorMsg();
					$dpa_nueva=$rs_dpa->Fields("cod_dpa_nueva");
					
					$tip="select * from n_tipologia where id_tipologia='$id_tip'";
					$rs_tip= $db->Execute($tip)or $mensaje=$db->ErrorMsg();
					$tip_nueva=$rs_tip->Fields("id_tipologia_nueva"); 
					
					$tip="select max(cod_estab) from n_estab,n_dpa,n_tipologia,n_mercado 
					where n_mercado.id_mercado=n_estab.id_mercado and n_estab.cod_dpa=n_dpa.cod_dpa and  n_estab.id_tipologia=n_tipologia.id_tipologia and incluido ='1' and n_mercado.id_mercado='$id_m' and n_estab.cod_dpa='$cod_dpa' and n_tipologia.id_tipologia_nueva='$tip_nueva'";
					//print $tip;
					$rs_tip= $db->Execute($tip)or $mensaje=$db->ErrorMsg() ;//print $rs_tip."<br>";
					$cant_tip=substr($rs_tip->Fields("max"),6,3);//print $cant_tip."<br>";
					$cont=$cant_tip+1;//print $cont;
					if($cont<=9)
					$cont="0".$cont;
					$cod=$dpa_nueva.$id_m.$tip_nueva.$cont;
				}
				 ?>
                
                
                <tr> 
                  <td height="22" align="right">C&oacute;digo del Establecimiento:</td>
                  <td><div style="font-weight:bold" align="left"><?php print $cod;?>
                    <input name="txt_cod_estab" value="<?php print $cod;?>" class="combo" title="Código establecimiento"  type="hidden" id="txt_cod_estab" >
                 </div></td>
                </tr>
                <tr> 
                  <td height="22" align="right">Direcci&oacute;n:</td>
                  <td><div align="left">
                    <input name="txt_dir" type="text" class="combo" id="txt_dir" title="Dirección" value="<?php print $_POST['txt_dir'];?>" size="70" maxlength="70"   >
                 </div></td>
                </tr>
                <tr> 
                  <td height="22" align="right">Establecimiento:</td>
                  <td><div align="left">
                      <input name="txt_estab" type="text" class="combo"   id="txt_estab" title="Establecimiento" size="70" maxlength="70">
                      </div></td>
                </tr>
                <tr>
                  <td height="19" align="right">Organismo superior:</td>
                  <td align="left"><strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">
                    <select name="sel_org" title="Organismo al que pertenece" id="sel_org" >
                      <option value="0">-----------------------</option>
                      <option value="CIMEX">CIMEX</option>
                      <option value="TRD">TRD</option>
                      <option value="Havaguanex">Havaguanex</option>
                      <option value="Caracol">Caracol</option>
                      <option value="MINAGRI">MINAGRI</option>
                      <option value="Palmares">Palmares</option>
                      <option value="P. Popular">P. Popular</option>
                      <option value="TRIMAGEN">TRIMAGEN</option>
                      <option value="Islazul">Islazul</option>
                      <option value="EPESE">EPESE</option>
                      <option value="Copextel">Copextel</option>
                      <option value="Artex">Artex</option>
                      <option value="Otros">Otros</option>
                    </select>
                  </font></strong></td>
                </tr>
                <tr>
                  <td height="22" align="right">Persona de contacto:</td>
                  <td><input name="txt_contacto" value="<?php print $_POST['txt_contacto'];?>" class="combo" title="Persona de contacto" type="text"   id="txt_contacto"></td>
                </tr>
                <tr>
                  <td height="22" align="right">Establecimiento a sustituir y poner en desuso:</td>
                  <td><select name="sel_estab_sus" title="Establecimiento a sustituir" id="sel_estab_sus">
                    <option value="0">------------------</option>
                    <?php 
						$tabla="n_estab, n_dpa where n_dpa.cod_dpa=n_estab.cod_dpa and n_estab.cod_dpa='$cod_dpa'
						and desuso='0' and incluido ='1'";
						$campo0=estab;
						$campo1=cod_estab;
						$campo_id=id_estab;
						$id=$_POST['sel_estab_sus'];
						include($x."php/selected.php");
						?>
                  </select></td>
                </tr>
                <tr>
                  <td height="22" align="right">&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr align="center">
                  <td height="49" colspan="2">Al insertar un nuevo establecimiento y sustituir otro poni&eacute;ndolo en desuso lo que sucede es todas las variedades que posee en altas el estblecimiento que vamos a sustituir se le dan baja y autom&aacute;ticamente el nuevo establecimiento recibe de altas todas estas variedades seg&uacute;n su mercado.</td>
                </tr>
                <tr align="center"> 
                  <td height="20" colspan="2">C&oacute;digo del Establecimiento=C&oacute;digo DPA+Mercado+Tipolog&iacute;a+Consecutivo</td>
                </tr>
                <tr align="center"> 
                  <td colspan="2"><?php echo $mensaje;?> <div id="id_msg" style="display:block"></div>
                    <script language="JavaScript" type="text/javascript">
				  setTimeout("des()",4000);
				  function des(){document.getElementById('id_msg').style.display="none";}
				  </script> &nbsp;</td>
                </tr>
                <tr> 
                  <td height="14" colspan="2" align="right">&nbsp; </td>
                </tr>
              </table>
              <p align="center">&nbsp;</p>
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
