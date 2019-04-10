<?php 
$x="../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."php/session/session_editor.php");
include($x."adodb/adodb-navigator.php");
if (isset($_GET["order"])) $order = $_GET["order"]; //else $order=orden;
if (isset($_GET["type"])) $ordtype = $_GET["type"]; //else $ordtype=asc;
if ($_GET["txt_filtro"]!="") $txt_filtro = $_GET['txt_filtro'];
if (isset($_POST["txt_filtro"])) $txt_filtro = $_POST['txt_filtro'];
if ($_GET["ver"]!="") $ver = $_GET['ver'];
if (isset($_POST["sel_#"])) $ver = $_POST['sel_#'];
if ($_GET["sel_filtro"]!="") $sel_filtro = $_GET['sel_filtro'];
if (isset($_POST["sel_filtro"])) $sel_filtro = $_POST['sel_filtro'];




//---------------------------------------------------					 
$sql_fecha = "select max(fecha) from b_producto";		
$rs_fecha = $db->Execute($sql_fecha)or $mensaje=$db->ErrorMsg() ;
$fecha_base = $rs_fecha->Fields('max');//print $x;
//---------------------------------------------------


$query = "select distinct fecha
from dato_provincial
where (calc='1' or calc='2'or calc='3') AND fecha>='".$fecha_base."' order by fecha asc";



if($ver=="")
$ver=50;
//print $query;
$pager_nav = new CData_PagerNav($db, $query, $ver,"frm",$order,$ordtype);
$rs = $pager_nav->curr_rs;
//print $rs;

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
           <form method="post" name="frm" id="frm" >
              <div align="center"> 
                <table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
<tr> 
                    <td height="66" align="right" class="menudottedline"> 
<table width="100%" border="0" class="menubar"  id="toolbar">
                        <tr > 
                          <td width="9%" valign="middle"  class="us"><img src="../imagenes/admin/categories.png" width="48" height="48" border="0"><strong><font color="#000000" size="1"> 
                            </font></strong></td>
                          <td width="80%" valign="middle"  class="us"><strong><font color="#5A697E" size="4">Fechas 
                            de para c&aacute;lculos nacionales</font></strong></td>
                          <td width="4%"> 
                            <div align="center"> <a class="toolbar" href="#"> 
                              <input name="borrar" type="image" onClick="calculo_nac('../nacional/calculo_nacional.php');" src="../imagenes/admin/checkin.png" alt="Borrar" width="32" height="32" border="0">
                              Calcular</a> </div></td>
                          <td width="7%"> 
                            <div align="center"><a class="toolbar" href="#" onClick="window.open('../../help/usuarios.htm', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                              <img src="../imagenes/admin/help_f2.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" /><br>
                              Ayuda</a></div></td>
                        </tr>
                      </table></td>
                  </tr>
                </table>
                <p>&nbsp;</p>
                <table width="47%"  align="center" cellpadding="0" cellspacing="0"  class="tabla" id="toolbar1">
                 
                    <tr align="center" valign="middle"> 
                      <td height="39" colspan="16"  > <div align="right"> 
                          <p><a href="#"> 
                            <?php
  					
  							$pager_nav->Render_Navegator();		?>
                            </a> 
                            <?php
				  		echo "&nbsp;&nbsp;<b>Página: </b>".$pager_nav->curr_page." de ". $pager_nav->count_page."&nbsp;";
 		  			  		?>
                            &nbsp;&nbsp;Ver # 
                            <select name="select" class="inputbox"  onChange="document.frm.submit();">
                              <option value="5" <?php if($_POST['sel_#']==5){?>selected="selected" <?php } ?>>5</option>
                              <option value="10" <?php if($_POST['sel_#']==10){?>selected="selected" <?php } ?>>10</option>
                              <option value="15" <?php if($_POST['sel_#']==15){?>selected="selected" <?php } ?>>15</option>
                              <option value="20" <?php if($_POST['sel_#']==20){?>selected="selected" <?php } ?>>20</option>
                              <option value="25" <?php if($_POST['sel_#']==25){?>selected="selected" <?php } ?>>25</option>
                              <option value="30" <?php if($_POST['sel_#']==30){?>selected="selected" <?php } ?>>30</option>
                              <option value="50" <?php if($_POST['sel_#']==50){?>selected="selected" <?php } ?>>50</option>
                              <option value="100" <?php if($_POST['sel_#']==100){?>selected="selected" <?php } ?>>100</option>
                            </select>
                          </p>
                        </div></td>
                    </tr>
                    <tr align="center" valign="center"  > 
                      <td width="10%" height="20" class="intro" >No</td>
                      <td width="76%" class="intro" ><a href="l_recalculo_provincial.php?order=<?php echo "fecha" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>">Fecha 
                        </a></td>
                      <td class="intro" >&nbsp;</td>
                      
                    </tr>
                    <?php
  $cadenacheckboxp = "";
  	if ($rs->RecordCount() > 0)
  	{

	 	$rs->MoveFirst();
	  	while (!$rs->EOF)
	  	{
		
					$fecha=$rs->fields["fecha"];
					$mes_actual=substr($fecha,5,2);
					//$mes_actual=$mes_actual-1;//print $mes_actual;
					
					$ano_actual=substr($fecha,0,4);
										
					switch ($mes_actual) {   
						 case 2:  $mes="Enero"."-".$ano_actual;   break;
						 case 3:  $mes="Febrero"."-".$ano_actual; break;
						 case 4:  $mes="Marzo"."-".$ano_actual;   break;
						 case 5:  $mes="Abril"."-".$ano_actual;   break;
						 case 6:  $mes="Mayo"."-".$ano_actual;    break;
						 case 7:  $mes="Junio"."-".$ano_actual;   break;
						 case 8:  $mes="Julio"."-".$ano_actual;   break;
						 case 9:  $mes="Agosto"."-".$ano_actual;  break;
						 case 10:  $mes="Septiembre"."-".$ano_actual;  break;
						 case 11: $mes="Octubre"."-".$ano_actual; break;
						 case 12: $mes="Noviembre"."-".$ano_actual;   break;
						 case 1: $ano_actual=$ano_actual-1; $mes="Diciembre"."-".$ano_actual;   break;
					 }
					 $ano_chec=substr($fecha,0,4);//print  $ano_chec; // esto es para quitar las plecas -
					 $mes_chec=substr($fecha,5,2);//print  $mes_chec;
					 $dia_chec=substr($fecha,8,2);
					 $chec=$ano_chec.$mes_chec.$dia_chec;

  ?>
                    <tr <?php if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";   ?>> 
                      <td height="26"  align="center" class="raya"> 
                        <?php $a=$pager_nav->index_rs++; echo $a; ?>
                      </td>
                      <td width="76%"align="center"  class="raya"><a class="toolbar1" onMouseOver="return overlib('<?php echo "Fecha del cálculo: ".$rs->fields["fecha"];?>', ABOVE, RIGHT);" onMouseOut="return nd();"><?php echo $mes;?></a></td>
                      
                      <td width="14%"align="center"  class="raya"> 
                        <input name="chec<?php print $chec; ?>" type="checkbox" title="chec<?php print $chec; ?>"  value="checkbox"></td>
                    </tr>
                    <?php 
					 if($cadenacheckboxp == "")
						 {
							$cadenacheckboxp = $chec;
						 }
						 else
						 {
							$cadenacheckboxp .= ",".$chec;
						 }
					
					
	  	$rs->MoveNext();
	  	}
  	}
  	
 		
  ?>
                </table>
                <p>&nbsp;</p>
               <p>
                  <input type="hidden" name="var_checkbox" value="<?php echo $cadenacheckboxp;?>">
                  <input type="hidden" name="var_aux_mod" value="">
                  
                </p>
              </div>
              </form>
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
