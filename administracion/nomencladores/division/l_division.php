<?php 
$x="../../../";
$tabla=n_division;
$campo_order=cod_division;
include($x."php/listar.php");
include($x."php/session/session_super.php");

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
           <form method="post" name="frm" id="frm" >
              
                <table width="100%" class="menubar"  border="0">
<tr> 
                    <td class="menudottedline" align="right"> <table width="100%" border="0" class="menubar"  id="toolbar">
                        <tr > 
                          <td width="6%" valign="middle"  class="us"><img src="../../../imagenes/admin/categories.png" width="48" height="48" border="0"><strong><font color="#000000" size="1"> 
</font></strong></td>
                          
                        <td width="61%" valign="middle"  class="us"><strong><font color="#5A697E" size="4">Administración 
                          de división</font></strong></td>
                          <td width="0%"> <div align="center"><a class="toolbar" href="n_division.php"><img src="../../../imagenes/admin/new_f2.png" alt="Nuevo" name="new" width="32" height="32" border="0" id="new"><br>
                              Nuevo</a></div></td>
                          <td width="6%"> <div align="center"> <a  onClick="modif('m_division.php');" class="toolbar" href="#"> 
                              <img   src="../../../imagenes/admin/edit_f2.png" alt="Editar" width="32" height="32" border="0"> 
                              <br>
                              Editar</a> </div></td>
                          <td width="6%"> <div align="center"> <a class="toolbar" href="#"> 
                              <input name="borrar" type="image" onClick="elim('../../../php/eliminar.php');" src="../../../imagenes/admin/delete_f2.png" alt="Borrar" width="32" height="32" border="0">
                              <br>
                              Borrar</a> </div></td>
                          <td width="9%"> <div align="center"> <a  class="toolbar" href="../capitulo/imp_capitulo.php?no=<?php $b=$pager_nav->index_rs; echo $b; ?>%20" target="_blank" > 
                              <img   src="../../../imagenes/admin/print.png" alt="Imprimir" width="32" height="32" border="0"> 
                              <br>
                              Imprimir</a> </div></td>
                          <td width="12%"> <div align="center"><a class="toolbar" href="#" onClick="window.open('../../../help/l_capítulo.htm', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                              <img src="../../../imagenes/admin/help_f2.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" /><br>
                              Ayuda</a></div></td>
                        </tr>
                        
                  </table></td>
                  </tr>
                </table>
                
              <p>&nbsp;</p>
              <table width="93%" height="93" align="center" cellpadding="0" cellspacing="0"    class="tabla" >
                <tr > 
                  <td height="27" colspan="8"  > <div align="right"><a href="#"> 
                      <?php
  					
  							$pager_nav->Render_Navegator();		?>
                      </a> 
                      <?php
				  		echo "&nbsp;&nbsp;<b>Página: </b>".$pager_nav->curr_page." de ". $pager_nav->count_page."&nbsp;";
 		  			  		$var=$_POST['sel_#'];		
							?>
                      &nbsp;&nbsp;Ver # 
                      <select name="sel_#" class="inputbox"  onChange="document.frm.submit();">
                        <option value="5" <?php if($ver==5){?>selected="selected" <?php } ?>>5</option>
                        <option value="10" <?php if($ver==10){?>selected="selected" <?php } ?>>10</option>
                        <option value="15" <?php if($ver==15){?>selected="selected" <?php } ?>>15</option>
                        <option value="20" <?php if($ver==20){?>selected="selected" <?php } ?>>20</option>
                        <option value="25" <?php if($ver==25){?>selected="selected" <?php } ?>>25</option>
                        <option value="30" <?php if($ver==30){?>selected="selected" <?php } ?>>30</option>
                        <option value="50" <?php if($ver==50){?>selected="selected" <?php } ?>>50</option>
                        <option value="100" <?php if($ver==100){?>selected="selected" <?php } ?>>100</option><option value="1000" <?php if($ver==1000){?>selected="selected" <?php } ?>>1000</option>
  </select>
                      &nbsp;</div></td>
                </tr>
                <tr> 
                  <td height="18">&nbsp; </td>
                  <td>&nbsp; </td>
                  <td width="57%"  align="center"  >Filtro: 
                    <input  name="txt_filtro" type="text" class="combo" value="<?php echo $txt_filtro ?>" size="15">
                    <select  onChange="document.frm.submit();" class="combo" name="sel_filtro">
                      <option value="<?php echo "no" ?>">-Seleccionar-</option>
                      <option value="<?php echo "cod_division" ?>"<?php if ($sel_filtro == "cod_division") { echo "selected"; } ?>><?php echo htmlspecialchars("Código División") ?></option>
                      <option value="<?php echo "division" ?>"<?php if ($sel_filtro == "division") { echo "selected"; } ?>><?php echo htmlspecialchars("División") ?></option>
                    </select> </td>
                  <td colspan="2"  align="right"  >&nbsp; </td>
                </tr>
                <tr> 
                  <td height="4">&nbsp;</td>
                  <td  >&nbsp;</td>
                  <td colspan="2"   >&nbsp;</td>
                  <td   >&nbsp;</td>
                </tr>
                <tr   > 
                  <td class="intro" width="7%" height="17"> 
<div align="center">No</div></td>
                  <td width="14%" class="intro" > 
                    <div align="center"><a href="../division/l_division.php?order=<?php echo "cod_division" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>">Código 
                      División </a></div></td>
                  <td colspan="2" class="intro"> <div align="center"><a href="../division/l_division.php?order=<?php echo "division" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>">División</a></div></td>
                  <td class="intro" width="4%">&nbsp; </td>
                </tr>
                <?php
if($rs->fields[0]!='')
{	
  $cadenacheckboxp = "";
  	if ($rs->RecordCount() > 0)
  	{

	 	$rs->MoveFirst();
	
	  	while (!$rs->EOF)
	  	{

  ?>
                <tr <?php if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";   ?> > 
                  <td class="raya" height="22"  align="center"> 
                    <?php $a=$pager_nav->index_rs++; echo $a; ?>
                  </td>
                  <td class="raya"align="center" ><a href="../division/m_division.php?var_aux_mod=<?php echo $rs->fields["id_division"];?>"><?php echo $rs->fields["cod_division"];?></a></td>
                  <td class="raya"colspan="2" align="center"> <a href="../division/m_division.php?var_aux_mod=<?php echo $rs->fields["id_division"];?>"><?php echo $rs->fields["division"];?> 
                    </a></td>
                  <td class="raya"> <input name="checkbox_<?php echo $rs->fields["id_division"];?>" type="checkbox"  value="checkbox"></td>
                </tr>
                <?php 

     if($cadenacheckboxp == "")
				 {
		      	    $cadenacheckboxp = $rs->fields["id_division"];
		       	 }
				 else
				 {
		            $cadenacheckboxp .= ",".$rs->fields["id_division"];
		         }
				//print $cadenacheckboxp;


	  	$rs->MoveNext();
	  	}
  	}
  	
 }		
  ?>
              </table>
              <p>&nbsp;</p>
              <p> 
                <input type="hidden" name="var_checkbox" value="<?php echo $cadenacheckboxp;?>">
                <input type="hidden" name="var_aux_mod" value="">
                <input type="hidden" name="tabla" value="<?php echo "n_division";?>">
                <input type="hidden" name="campo" value="<?php echo "id_division";?>">
                <input type="hidden" name="location" value="<?php echo "../administracion/nomencladores/division/l_division.php";?>">
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
