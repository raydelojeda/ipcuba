<?php
$x="../../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."php/session/session_admin.php");
$mensaje="";
	
$array2=array("D-1","L-1","Ma-1","Mi-1","J-1","V-1","S-1","D-2","L-2","Ma-2","Mi-2","J-2","V-2","S-2","D-3","L-3","Ma-3","Mi-3","J-3","V-3","S-3","D-4","L-4","Ma-4","Mi-4","J-4","V-4","S-4",);
if ($_GET["sel_mercado"]!="") $sel_mercado = $_GET['sel_mercado'];
if (isset($_POST["sel_mercado"])) $sel_mercado = $_POST['sel_mercado'];

if ($_GET["sel_cod_dpa"]!="") $sel_cod_dpa = $_GET['sel_cod_dpa'];
if (isset($_POST["sel_cod_dpa"])) $sel_cod_dpa = $_POST['sel_cod_dpa'];

if ($_GET["sel_tipologia"]!="") $sel_tipologia = $_GET['sel_tipologia'];
if (isset($_POST["sel_tipologia"])) $sel_tipologia = $_POST['sel_tipologia'];
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
            <form  method="post" id="frm"  action="" name="frm" onSubmit="">
<table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
                <tr> 
                  <td class="menudottedline" align="right"> <table width="100%" border="0" class="menubar"  id="toolbar">
                      <tr > 
                        <td width="7%" valign="middle"  class="us"><img src="../../../imagenes/admin/templatemanager.png" width="48" height="48" border="0"><strong><font color="#000000" size="1"> 
                          </font></strong></td>
                        <td valign="middle"  class="us"><strong><font color="#5A697E" size="4">Control 
                          del establecimiento-variedad: <font size="2">Insertar</font></font></strong> 
                          <div align="center"></div></td>
                        <td width="1%"> <div align="center"> <a  class="toolbar" > 
                            <input type="image" onClick="estab_var('estab_var.php');"   name="btn_save" id="btn_save"   src="../../../imagenes/admin/save_f2.png" alt="Guardar" width="32" height="32" border="0">
                            <br>
                            <label>Guardar</label></a> </div></td>
                        <td width="7%"> <div align="center"> <a class="toolbar" href="l_var_estab.php"> 
                            <img name="imageField2" src="../../../imagenes/admin/cancel_f2.png" alt="Cerrar" width="32" height="32" border="0"> 
                            <br>
                            Cancelar</a> </div></td>
                        <td width="6%"> <div align="center"><a class="toolbar" href="#" onClick="window.open('../../help/var_estab.php', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                            <img src="../../../imagenes/admin/help_f2.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" /><br>
                            Ayuda</a></div></td>
                      </tr>
                      
                  </table></td>
                </tr>
              </table>
              <br>
              <table width="98%"  align="center"  class="tabla">
                <tr> 
                  <td colspan="5">&nbsp;</td>
                </tr>
                <tr>
                  <td height="19" width="38%" align="right">C&oacute;digo DPA:</td>
                  <td colspan="4"><div align="left">
                    <select name="sel_cod_dpa" title="C&oacute;digo DPA" id="sel_cod_dpa" onChange="document.frm.submit();" >
                      <option value="0">---------CUBA---------</option>
                      <?php 
						$tabla="n_dpa where incluido='". 1 ."'";
						$campo0=prov_mun_nuevo;
						$campo1=cod_dpa_nueva;
						$campo_id=cod_dpa;
						$id=$sel_cod_dpa;
						include($x."php/selected.php");
						?>
                    </select>
                  </div></td>
                </tr>
                <tr>
                  <td height="19" align="right">Mercado:</td>
                  <td colspan="4"><div align="left">
                    <select name="sel_mercado" title="Mercado" id="sel_mercado" onChange="document.frm.submit();">
                      <option value="0">-----------------------</option>
                       <?php 
                     											
									$id=$sel_mercado;
									if($sel_tipologia!="0" && $sel_tipologia!="")
									{
									$query_mercado = "select distinct mercado, n_mercado.id_mercado 
									from n_estab, n_mercado, b_variedad, n_tipologia 
									where n_mercado.id_mercado=n_estab.id_mercado and 
									n_mercado.id_mercado=b_variedad.id_mercado and n_estab.id_tipologia='".$sel_tipologia."'";
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
											$rs_fields1="";										 
											echo"<option value=";echo $rs_fields_id;if($rs_fields_id==$id){echo " selected ";$aux=$rs_fields_id;} echo "> "; if($rs_fields1){echo $rs_fields1; print ". ";}echo $rs_fields0; echo "</option>";
											$rs_mercado->MoveNext();
										}
								    ?>
                    </select>
                  </div></td>
                </tr>
                <tr> 
                  <td height="19" align="right">Tipolog&iacute;a:</td>
                  <td colspan="4"><div align="left">
                    <select name="sel_tipologia" id="sel_tipologia" onChange="document.frm.submit();">
                      <option value="0">-----------------------</option>
                      <?php 
						//print $sel_mercado;
						if($sel_mercado!="0" && $sel_mercado!="")
						{
                    	 $query_tipologia = "select distinct tipologia, n_tipologia.id_tipologia from n_tipologia, n_estab, n_dpa WHERE n_dpa.cod_dpa=n_estab.cod_dpa and incluido='1' and n_tipologia.id_tipologia=n_estab.id_tipologia and n_estab.id_mercado='".$sel_mercado."'";
						 if($sel_cod_dpa!="0")
						 {$query_tipologia.=" and n_dpa.cod_dpa like '".$sel_cod_dpa."%'";}
						 $query_tipologia.=" order by tipologia";		
						  $rs_tipologia=$db->Execute($query_tipologia) or die($db->ErrorMsg()) ;
					      
						 $cant_rs_tipologia=$rs_tipologia->RecordCount();
 							for ($t = 0; $t < $cant_rs_tipologia;$t++)
							{
							$rs_fields0=$rs_tipologia->Fields("tipologia");
							$rs_fields1="";
							$rs_fields_id=$rs_tipologia->Fields("id_tipologia");
							$id_tipologia=$sel_tipologia;										                            
							echo"<option value=";echo $rs_fields_id;if($rs_fields_id==$id_tipologia){echo " selected ";} echo "> "; if($rs_fields1){echo $rs_fields1; print ". ";}echo $rs_fields0; echo "</option>";
        					$rs_tipologia->MoveNext();
							}	 
						} 
						
						
						elseif($sel_cod_dpa!="0" && $sel_cod_dpa!="")
						{
						$query_tipologia = "select distinct tipologia, n_tipologia.id_tipologia from n_tipologia, n_estab, n_dpa WHERE n_dpa.cod_dpa=n_estab.cod_dpa and incluido='1' and n_tipologia.id_tipologia=n_estab.id_tipologia and n_dpa.cod_dpa like '".$sel_cod_dpa."%' order by tipologia";
						 
						 $rs_tipologia=$db->Execute($query_tipologia) or die($db->ErrorMsg()) ;
					     // print	$query_sel;
						 $cant_rs_tipologia=$rs_tipologia->RecordCount();
 							for ($t = 0; $t < $cant_rs_tipologia;$t++)
							{
							$rs_fields0=$rs_tipologia->Fields("tipologia");
							$rs_fields1="";
							$rs_fields_id=$rs_tipologia->Fields("id_tipologia");
							$id_tipologia=$sel_tipologia;										                            
							echo"<option value=";echo $rs_fields_id;if($rs_fields_id==$id_tipologia){echo " selected ";} echo "> "; if($rs_fields1){echo $rs_fields1; print ". ";}echo $rs_fields0; echo "</option>";
        					$rs_tipologia->MoveNext();
							}
						}	
						
						//print	$query_tipologia;					
					 ?>
                    </select>
                  </div></td>
                </tr>
                <tr >
                  <td height="20"   align="right">Establecimiento:</td>
                  <td colspan="4"><select name="sel_cod_estab" title="Establecimiento" id="sel_cod_estab" onChange="document.frm.submit();">
                    <option value="0">-----------------------</option>
                    <?php 
						//print $sel_mercado;
						
                    	  if($sel_tipologia!=0 && $sel_mercado!=0)
				  {	 $cod_dpa =$sel_cod_dpa;
					 $id_tipologia =$sel_tipologia;
					 $id_mercado =$sel_mercado;							 
					 $query_estab = "select * from n_estab, n_tipologia, n_mercado, n_dpa
					 where n_dpa.cod_dpa=n_estab.cod_dpa and incluido='1' and
					 n_estab.id_mercado=n_mercado.id_mercado and 
					 n_estab.id_tipologia=n_tipologia.id_tipologia ";
					 if($sel_cod_dpa!=0)
					 {$query_estab.=" and n_estab.cod_dpa = '$sel_cod_dpa' ";}
					 $query_estab.="and n_estab.id_tipologia='$id_tipologia' and n_estab.id_mercado='$id_mercado'
					 order by cod_estab";//print  $query;
					 
					 $rs_estab=$db->Execute($query_estab) or die($db->ErrorMsg()) ;
					 // print	$query_sel;
					 $cant_rs=$rs_estab->RecordCount();
					 $cod=$_POST['sel_cod_estab'];
						for ($i = 0; $i < $cant_rs;$i++)
						{
						$rs_fields0=$rs_estab->Fields("estab");
						$rs_fields1=$rs_estab->Fields("cod_estab");
						$rs_fields_id=$rs_estab->Fields("id_estab");print $rs_fields_id;
						$id_cod_estab=$cod;										                             /*if($_POST['sel_cod_var']!="")
						$id_espec=$_POST['sel_espec'];*/
						echo"<option value=";echo $rs_fields_id;if($rs_fields_id==$id_cod_estab){echo " selected ";}else $_POST['sel_cod_estab']=""; echo "> "; if($rs_fields1){echo $rs_fields1; print ". ";}echo $rs_fields0; echo "</option>";
						$rs_estab->MoveNext();
						}
					}					
					 ?></select>
                  </td>
                </tr>
                <tr >
                   <td height="20"   align="right"><div align="right">D&iacute;a 
                   a captar:</div></td>
			   <?php
                 //print $cod;
				 if($cod!=0)
				 {
				 $id_estab=$cod;
				 $sql_fecha_captar = "select fecha_captar from n_var_estab, n_estab
				 where n_var_estab.id_estab=n_estab.id_estab 
				 and n_estab.id_estab='".$id_estab."'";//print  $sql_fecha_captar;
				 $rsx=$db->Execute($sql_fecha_captar) or die($db->ErrorMsg()) ;//print $rs_fecha_captar;
				 $dia_captar=substr($rsx->Fields("fecha_captar"),8,2);
				 //print $dia_captar;$rr=$rsx->Fields('fecha_captar');print $rr."sd";
				 }
				?>
                   <td colspan="4"><select name="txt_fecha">
                     <?php 
					 
					 for ($k=0;$k<28;$k++){?>
                     <option  <?php if($k==0 ||$k==7 ||$k==14 ||$k==21 ||$k==1 ||$k==2 ||$k==27){?> style="background-color:#CC6666" disabled <?php }?> value="<?php print $k+1;?>" <?php if($k==$dia_captar-1)print "selected";?>><?php echo $array2[$k];?></option>
                     <?php }?>
                   </select></td>
                </tr>
                 <?php 
				 
				 /**/
				 
				 
				 
				 if($sel_mercado!=0 && $sel_tipologia!=0)
				 {								 
				 $query = "select b_variedad.idb_variedad, ecod_var, variedad,n_variedad.id_variedad from n_variedad, b_variedad WHERE n_variedad.id_variedad=b_variedad.id_variedad and b_variedad.id_mercado='".$sel_mercado."' and n_variedad.ide_articulo!='1' order by n_variedad.ecod_var, cod_var, variedad";//print  $query;and variedad like '%urbano%''
				 
				 
				
				 
				 //print $query;and variedad like '%corto%'and ecod_var like '07%'
				 
				 $rs=$db->Execute($query) or $mensaje=$db->ErrorMsg() ;
				 $cant_rs=$rs->RecordCount();
					for ($i=0;$i<$cant_rs;$i++)
					{
					$id_variedad=$rs->Fields('id_variedad');
					$rs_fields0=$rs->Fields('variedad');
					$rs_fields1=$rs->Fields('ecod_var');
					
					
					
					/*$sql_var = "select distinct n_variedad.id_variedad, variedad from n_variedad, b_variedad,n_var_estab, n_estab, n_tipologia 
WHERE n_variedad.id_variedad=b_variedad.id_variedad 
and n_var_estab.id_estab=n_estab.id_estab
and n_var_estab.idb_variedad=b_variedad.idb_variedad
and n_estab.id_tipologia=n_tipologia.id_tipologia and n_variedad.ide_articulo!='1'
and n_tipologia.id_tipologia='29' and n_estab.id_estab='102' and n_variedad.id_variedad='$id_variedad'";//print $sql_var;
					$rs_var=$db->Execute($sql_var) or $mensaje=$db->ErrorMsg() ;
				 	$cant_rs_var=$rs_var->RecordCount();*/
					
					
				  ?>
                 
                 
                <tr > 
                  <td height="22" colspan="2"   align="right"><div align="right"><?php echo $rs_fields1; print ". ";echo $rs_fields0;?></div></td>
                  <td width="11%"><input <?php //if($cant_rs_var==1)print "checked";?> title="checkbox_<?php echo $rs->fields["id_variedad"];?>" name="checkbox_<?php echo $rs->fields["idb_variedad"];?>" type="checkbox"  value="checkbox"></td>
                  <td width="14%">&nbsp;</td>
                  <td width="15%">&nbsp;</td>
                </tr>
                <?php  
				if($cadenacheckboxp == "")
				 {
		      	    $cadenacheckboxp = $rs->fields["idb_variedad"];
		       	 }
				 else
				 {
		            $cadenacheckboxp .= ",".$rs->fields["idb_variedad"];
		         }//print $cadenacheckboxp;
				
				$rs->MoveNext();	}
				
			}//fin del if de la variedades
				
				?>
                
                	<input type="hidden" name="var_checkbox" value="<?php echo $cadenacheckboxp;?>">
                    <input type="hidden" name="var_aux_mod" value="">
                                      
                    <input type="hidden" name="fecha" value="<?php echo $fecha_captar;?>">
                <tr align="center"> 
                  <td height="14" colspan="5">&nbsp;</td>
                </tr>
                <tr align="center"> 
                  <td height="24" colspan="5"> <div id="id_msg" style="display:block"><?php echo $mensaje;?></div>
                    <script language="JavaScript" type="text/javascript">
				  setTimeout("des()",4000);
				  function des(){document.getElementById('id_msg').style.display="none";}
				  </script> &nbsp;</td>
                </tr>
                <tr> 
                  <td height="14" colspan="5" align="right">&nbsp; </td>
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
