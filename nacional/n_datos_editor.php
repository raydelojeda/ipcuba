<?php
$x="../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."php/session/session_editor.php");

		//---------------------------------------------------					 
	$sql_fecha = "select max(fecha) from b_variedad";		
	$rs_fecha = $db->Execute($sql_fecha)or $mensaje=$db->ErrorMsg() ;
	if($rs_fecha)
	$fecha_base = $rs_fecha->Fields('max');
	
	//---------------------------------------------------
	//---------------------------------------------------
	$query_usuario = " where usuario='".$_SESSION["user"]."'"; 
	$sql_usuario = "select id_usuario, cod_dpa from usuario".$query_usuario;		
	$rs_usuario = $db->Execute($sql_usuario)or $mensaje=$db->ErrorMsg() ;
	$id_usuario=$rs_usuario->Fields("id_usuario");
	$cod_dpa=$rs_usuario->Fields("cod_dpa");
	$cod_dpa2=substr($rs_usuario->Fields("cod_dpa"),0,2);
	//---------------------------------------------------

$mensaje="";
if(isset($_POST['txt_precio']))
{
	$magic_quotes = get_magic_quotes_gpc();
	
	

	
	$fecha_dig=date("Y/m/d"); //print $fecha;//fecha de digitalizacion
	
	$sel_obs = $db->qstr($_POST['sel_obs'], $magic_quotes);
	$sel_mercado = $db->qstr($_POST['sel_mercado'], $magic_quotes);
	$txt_precio= $db->qstr($_POST['txt_precio'], $magic_quotes);
		
	$sel_estab = $db->qstr($_POST['sel_estab'], $magic_quotes);
	$sel_variedad = $db->qstr($_POST['sel_cod_var'], $magic_quotes);
	$sel_obs = $db->qstr($_POST['sel_obs'], $magic_quotes);
	$rbt_central= $_POST['rbt_central'];
	
	if( $_POST['sel_cod_var']!='' && $_POST['sel_mercado']!='' && $_POST['txt_precio']!='') 
	{
	if($rbt_central==1)
	{
	//---------------------para las fechas------------------------
	//---------------------para las fechas------------------------
	//---------------------para las fechas------------------------
	
	$ano=substr($fecha_dig,0,4);//print $ano_ant;
	$mes_act=substr($fecha_dig,5,2);	
	
	if($mes_act==01)
		{$mes_ant=12;$ano=$ano-1;}
		else
		{$mes_ant=$mes_act-1;}
		
	$fecha_ant=$ano."-".$mes_ant."-01";		
	$fecha_fin=$ano."-".$mes_act."-01";			
	
	//---------------------para las fechas------------------------
	//---------------------para las fechas------------------------
	//---------------------para las fechas------------------------
	
		$query_imputado = "select imputado from captacion 
		where id_var_estab='".$_POST['sel_estab']."' and fecha>='".$fecha_ant."' and fecha<'".$fecha_fin."'";
		$rs_imputado=$db->Execute($query_imputado) or $mensaje=$db->ErrorMsg() ;
		//print $query_imputado;
		$imputado=$rs_imputado->fields["imputado"];
		
		$imputado=$imputado+1;
		
	   	
	}
			
			 $sql="INSERT INTO captacion (id_usuario,id_var_estab,id_obs,fecha,imputado,precio) 
			 VALUES ($id_usuario,$sel_estab,$sel_obs,'".$fecha_dig."','".$imputado."',$txt_precio)";//print $sql;

	
			 $rs=$db->Execute($sql) or $mensaje=$db->ErrorMsg() ;//print "Ya existe la persona en la Base de Datos."
  	    
	 		if($mensaje=="")
			 $mensaje="El dato ha sido insertado satisfactoriamente.";
					 	
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
<link href="../css/gris.css" rel="stylesheet" type="text/css"> 
<?php }elseif($_SESSION["estilo"]=="v"){?>
<link href="../css/verde.css" rel="stylesheet" type="text/css"> 
<?php } else {?>
<link href="../css/azul.css" rel="stylesheet" type="text/css"> 
<?php }?>
<link rel="stylesheet" href="../css/theme.css" type="text/css" />
<link rel="shortcut icon" href="../imagenes/flecha.ico"/> 
<link rel="stylesheet" type="text/css" href="../css/resources/css/ext-all.css" />
</head> 

<script type="text/javascript" src="../javascript/yui/yui-utilities.js"></script>  
<script type="text/javascript" src="../javascript/yui/ext-yui-adapter.js"></script>
<script language="javascript" src="../javascript/yui/ext-all.js"></script>

<script language="JavaScript" src="../javascript/JSCookMenu_mini.js" type="text/javascript"></script> 
<script language="JavaScript" src="../javascript/theme.js" type="text/javascript"></script>
<script language="javascript" src="../javascript/cal2.js"></script>
<script language="javascript" src="../javascript/cal_conf2.js"></script>
<script language="javascript" src="../javascript/overlib_mini.js"></script>

<script src="../javascript/funciones.js" type="text/javascript">
</script> 
<body> 
<table width="750"  border="1"  align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td>

<table width="750" border="0"  align="center" cellpadding="0" cellspacing="0" >
<tr> 
          <td><img src="../imagenes/banner.jpg" width="750" height="35"></td>
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
<script language="javascript"  src="../javascript/menu_autor_m.js">	
		</script>
<?php
}
elseif($_SESSION["rol"] == 'aut_p')
{
?>
		<script language="javascript"  src="../javascript/menu_autor_p.js">	
		</script>
<?php
}
elseif($_SESSION["rol"] == 'edito')
{
?>
	<script language="javascript"  src="../javascript/menu_editor.js">	
		</script>
<?php
}
elseif($_SESSION["rol"] == 'admin')
{
?>
	<script language="javascript"  src="../javascript/menu_admin.js">	
		</script>
        
<?php
}
elseif($_SESSION["rol"] == 'super')
{
?>
	<script language="javascript"  src="../javascript/menu_super.js">	
		</script>
        
<?php
}
elseif($_SESSION["rol"] == 'jefes')
{
?>
	<script language="javascript"  src="../javascript/menu_jefes.js">	
		</script>


<?php
} else
{
?>
<script language="javascript"  src="../javascript/menu_invitado.js">	
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
		?>', ABOVE, RIGHT);" onMouseOut="return nd();"href="../php/logout.php" style="color: #333333; font-weight: bold"><?php print $_SESSION["user"];?>&nbsp;<img style="vertical-align:bottom"  border="0"src="../imagenes/extrasmall/exit.gif">
			&nbsp; </a>
	</td>
</tr>
</table>
   
   
   
  </tr>
  <tr>
          <td align="center" valign="middle" bgcolor="#ffffff"><!-- InstanceBeginEditable name="Body" --> 
            <form action="" method="post" name="frm" onSubmit="MM_validateForm('txt_min','','RisNum','txt_max','','RisNum','txt_fecha','','R');return document.MM_returnValue">
              <table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
                <tr> 
                  <td class="menudottedline" align="right"> <table width="100%" border="0" class="menubar"  id="toolbar">
                      <tr > 
                        <td width="4%" valign="middle"  class="us"><img src="../imagenes/admin/news.png" width="48" height="48" border="0"><strong><font color="#000000" size="1"> 
                          </font></strong></td>
                        <td width="71%" valign="middle"  class="us"><strong><font color="#5A697E" size="3">Captación 
                          de precios centralizados a nivel nacional-editor</font></strong> 
                          <div align="center"></div></td>
                        <td width="9%"> <div align="center"> <a  class="toolbar" href="javascript:document.frm.submit();"> 
                            <input type="image"   name="btn_save" id="btn_save"   src="../imagenes/admin/save_f2.png" alt="Guardar" width="32" height="32" border="0">
                            <br>
                            <label>Guardar</label>
                            </a> </div></td>
                        <td width="9%"> <div align="center"> <a class="toolbar" href="l_datos_editor.php"> 
                            <img name="imageField2" src="../imagenes/admin/cancel_f2.png" alt="Cerrar" width="32" height="32" border="0"> 
                            <br>
                            Cancelar</a> </div></td>
                        <td width="7%"> <div align="center"><a class="toolbar" href="#" onClick="window.open('../help/n_provincial_datos_editor.htm', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                            <img src="../imagenes/admin/help_f2.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" /><br>
                            Ayuda</a></div></td>
                      </tr>
                      
                  </table></td>
                </tr>
              </table>
              <p>&nbsp;</p>
              <table width="81%" height="326" align="center"  class="tabla">
                <tr>
                  <td height="22" align="right">&nbsp;</td>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr> 
                  <td height="22" align="right">Mercado:</td>
                  <td colspan="2"><div align="left"> 
                      <select name="sel_mercado" title="Mercado" id="sel_mercado" onChange="document.frm.submit();" >
                        <option value="0">-----------------------</option>
                        <?php 
                     				$x="../";
									
									$id=$_POST['sel_mercado'];
									                
													 
									$query_mercado = "select distinct mercado, n_mercado.id_mercado from b_variedad, n_mercado,n_var_estab where n_mercado.id_mercado=b_variedad.id_mercado and n_var_estab.idb_variedad=b_variedad.idb_variedad AND fecha='".$fecha_base."'";
									$rs_mercado=$db->Execute($query_mercado) or $mensaje=$db->ErrorMsg() ;
									$cant_rs=$rs_mercado->RecordCount();
										for ($i = 0; $i < $cant_rs;$i++)
										{
											$rs_fields0=$rs_mercado->Fields('mercado');
											$rs_fields_id=$rs_mercado->Fields('id_mercado');										 
											echo"<option value=";echo $rs_fields_id;if($rs_fields_id==$id){echo " selected ";$aux=$rs_fields_id;} echo "> "; if($rs_fields1){echo $rs_fields1; print ". ";}echo $rs_fields0; echo "</option>";
											$rs_mercado->MoveNext();
										}
										
									
																													
								    ?>
                      </select>
                      (*) </div></td>
                </tr>
                <tr> 
                  <td width="49%" height="23" align="right">Variedad:</td>
                  <td > <div align="left">
                    <select name="sel_cod_var" id="sel_cod_var" title="C&oacute;digo variedad" onChange="document.frm.submit();" >
                      <option value="0">-----------------------</option>
                      <?php 
						//print $_POST['sel_mercado'];
						if($_POST['sel_mercado']!="0" && $_POST['sel_mercado']!="")
						{
						
                         $query_variedad = "select b_variedad.idb_variedad, cod_var, variedad from n_variedad, b_variedad,n_var_estab WHERE n_variedad.id_variedad=b_variedad.id_variedad 
						 and b_variedad.id_mercado='".$_POST['sel_mercado']."' and b_variedad.central!=2 and b_variedad.central!=0 and n_var_estab.idb_variedad=b_variedad.idb_variedad AND fecha='".$fecha_base."' order by n_variedad.cod_var";
						 $rs_variedad=$db->Execute($query_variedad) or die($db->ErrorMsg()) ;
					      print	$query_variedad;
						 $cant_rs=$rs_variedad->RecordCount();
 							for ($i = 0; $i < $cant_rs;$i++)
							{
							$rs_fields0=$rs_variedad->Fields("variedad");
							$rs_fields1=$rs_variedad->Fields("cod_var");
							$rs_fields_id=$rs_variedad->Fields("idb_variedad");
							$id_mer=$_POST['sel_cod_var'];//print $rs_fields_id;										 
							echo"<option value=";echo $rs_fields_id;if($rs_fields_id==$id_mer){echo " selected ";}else $_POST['sel_cod_var']=""; echo "> "; if($rs_fields1){echo $rs_fields1; print ". ";}echo $rs_fields0; echo "</option>";
        					$rs_variedad->MoveNext();
							}
							}
						
					
								    ?>
                    </select>
                    (*) </div></td>
                </tr>
                <tr> 
                  <td height="19" align="right">Establecimiento:</td>
                  <td colspan="2"><div align="left">
                    <select name="sel_estab" title="Establecimiento" id="sel_estab" onChange="document.frm.submit();" >
                      <option value="0">-----------------------</option>
                      <?php  
					  	if($_POST['sel_cod_var']!="0" && $_POST['sel_cod_var']!="")
						{
						
                    	 $query_sel = "select n_var_estab.idb_variedad, cod_estab, estab,id_var_estab from n_estab, n_var_estab,b_variedad WHERE n_estab.id_estab=n_var_estab.id_estab 
						 and n_var_estab.idb_variedad='".$_POST['sel_cod_var']."'and n_var_estab.idb_variedad=b_variedad.idb_variedad AND fecha='".$fecha_base."' order by n_estab.cod_estab";
						 $rs_estab=$db->Execute($query_sel) or $mensaje=$db->ErrorMsg() ;
					     print	$query_sel;
						 $cant_rs=$rs_estab->RecordCount();
 							for ($i = 0; $i < $cant_rs;$i++)
							{
							$rs_fields0=$rs_estab->Fields("estab");
							$rs_fields1=$rs_estab->Fields("cod_estab");
							$rs_fields_id=$rs_estab->Fields("id_var_estab");
							$id=$_POST['sel_estab'];//print $rs_fields_id;										 
							echo"<option value=";echo $rs_fields_id;if($rs_fields_id==$id){echo " selected ";} else $_POST['sel_estab']="";echo "> "; if($rs_fields1){echo $rs_fields1; print ". ";}echo $rs_fields0; echo "</option>";
        					$rs_estab->MoveNext();
							}
						    }
						else $_POST['sel_estab']="";
					                    
							
					?>
                    </select> 
                    <?php 
					  //print $query_sel;
						if($_POST['sel_estab']!="0" && $_POST['sel_estab']!="")
							{
							$sql_precio="select   , p_max, fecha_captar from b_variedad,n_var_estab where b_variedad.idb_variedad='".$_POST["sel_cod_var"]."' and n_var_estab.idb_variedad=b_variedad.idb_variedad";
						    $rs_precio=$db->Execute($sql_precio) or die($db->ErrorMsg());//print  $rs_precio;
							$precio_min=$rs_precio->fields[" "];
							$precio_max=$rs_precio->fields["p_max"];
							
							}
							
						?>
                    (*) </div></td>
                </tr>
                <tr> 
                  <td height="24"  align="right">Precio m&iacute;nimo:</td>
                  <td width="27%"> <div align="left">
                    <input name="txt_min"   disabled id="txt_min" title="Precio M&iacute;nimo" value="<?php echo $precio_min;?>" size="10"> 
                  </div></td>
                  <td width="24%">&nbsp;</td>
                </tr>
                <tr align="center"> 
                  <td height="19" align="right">Precio:</td>
                  <td colspan="2" align="left"><div align="left">
                      <input  name="txt_precio"  type="text"  id="txt_precio" title="Precio"   size="10">
                    (*) </div></td>
                </tr>
                <tr align="center"> 
                  <td align="right">Precio m&aacute;ximo:</td>
                  <th colspan="2" align="left"><div align="left">
                    <input name="txt_max"   disabled id="txt_max" title="Precio M&aacute;ximo" value="<?php echo $precio_max;?>" size="10"> 
                    &nbsp;</div></th>
                </tr>
                <tr align="center"> 
                  <td align="right">Imputado:</td>
                  <th colspan="2" align="left"><div align="left">&nbsp;&nbsp;&nbsp;&nbsp; 
                      S&iacute; 
                      <input  name="rbt_central" type="radio" value="1">
                      &nbsp;&nbsp;&nbsp;&nbsp; No 
                      <input  name="rbt_central" type="radio" value="0" checked="true">
                      (*) </div></th>
                </tr>
                <tr align="center"> 
                  <td height="26" align="right">Fecha a&nbsp; captar:</td>
                  <td colspan="2" align="left"> 
                    <div align="left">
                      <?php  echo $rs_precio->fields["fecha_captar"]; ?>
                    &nbsp; </div></td>
                </tr>
                <tr> 
                  <td height="19" align="right">Observaciones:</td>
                  <td colspan="2"><div align="left">
                    <select name="sel_obs" id="sel_obs" title="Observaci&oacute;n" >
                      <option value="0" selected>----------------------------</option>
                      <?php 
                     	
									$tabla=n_obs;
									$campo0=obs;
									
									$value=id_obs;
									include("../php/select.php");
								    ?>
                    </select>
                  </div></td>
                </tr>
                <tr align="center"> 
                  <td height="14" colspan="3">&nbsp;</td>
                </tr>
                <tr align="center"> 
                  <td height="14" colspan="3">(*) Campo requerido</td>
                </tr>
                <tr align="center"> 
                  <td height="39" colspan="3">
<div id="id_msg" style="display:block"><?php echo $mensaje;?></div>
                    <script language="JavaScript" type="text/javascript">
				  setTimeout("des()",4000);
				  function des(){document.getElementById('id_msg').style.display="none";}
				  </script> &nbsp;</td>
                </tr>
                <tr> 
                  <td height="14" colspan="3" align="right">&nbsp;</td>
                </tr>
              </table>
              <input  type="hidden" name=" " value="<?php echo $rs_precio->fields[" "];?>">
              <input  type="hidden" name="p_max" value="<?php echo $rs_precio->fields["p_max"];?>">
              <p>&nbsp; </p>
            </form >
            <!-- InstanceEndEditable --></td>
  </tr>
  
	</table>
	
	 </td></tr></table>
	
<table width="754" height="21"  border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#5A697E">
  <tr> 
    <td width="30" height="21"  align="center" valign="middle"> <div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><img src="../imagenes/down.jpg" width="30" height="26"></font></div></td>
    <td width="695"  align="center" valign="middle" bgcolor="#4B4B4B">
      <div align="center"><font color="#FFFFFF" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>ONEI - 
    IPC 2009-2012</strong></font></div></td>
    <td width="30"  align="center" valign="middle"><div align="center"><img src="../imagenes/up.jpg" width="30" height="26"></div></td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
