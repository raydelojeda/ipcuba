<?php 
$x="../../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."php/session/session_invitado.php");
include($x."adodb/adodb-navigator.php");

	if ($_GET["regis_cant"]!="" && $_POST['sel_#']=="")
{	
	$_POST['sel_#'] = $_GET["regis_cant"];//para volver al listado con la misma cantidad de filas
	$_GET["regis_cant"]="";
}

if (isset($_GET["order"])) $order = $_GET["order"]; //else $order=orden;
if (isset($_GET["type"])) $ordtype = $_GET["type"]; //else $ordtype=asc;

if ($_GET["txt_filtro"]!="") $txt_filtro = $_GET['txt_filtro'];
if (isset($_POST["txt_filtro"])) $txt_filtro = $_POST['txt_filtro'];
if ($_GET["ver"]!="") $ver = $_GET['ver'];
if (isset($_POST["sel_#"])) $ver = $_POST['sel_#'];
if ($_GET["sel_filtro"]!="") $sel_filtro = $_GET['sel_filtro'];
if ($_POST["sel_filtro"]!="") $sel_filtro = $_POST['sel_filtro'];


//---------------------------------------------------					 
$sql_fecha = "select max(fecha) from b_variedad";		
$rs_fecha = $db->Execute($sql_fecha)or $mensaje=$db->ErrorMsg() ;
$fecha_base = $rs_fecha->Fields('max');//print $x;
//---------------------------------------------------

$query = "select distinct ecod_var, variedad, carac1,carac2,carac3,carac4,carac5,carac6,valor1,valor2,valor3,valor4,valor5,valor6
from n_var_estab,b_variedad,n_variedad,n_mercado,n_estab, n_dpa,n_unidad, n_articulo,e_articulo,n_tipologia
where 
n_articulo.id_articulo=n_variedad.id_articulo and
n_var_estab.idb_variedad=b_variedad.idb_variedad and b_variedad.id_variedad=n_variedad.id_variedad 
and b_variedad.id_mercado=n_mercado.id_mercado and n_var_estab.id_estab=n_estab.id_estab
and n_estab.cod_dpa=n_dpa.cod_dpa
and n_unidad.id_unidad=n_var_estab.id_unidad
and n_variedad.ide_articulo=e_articulo.ide_articulo
and n_estab.id_tipologia=n_tipologia.id_tipologia and n_dpa.incluido='1' and n_variedad.ide_articulo!='1' and n_var_estab.desuso='0' and central='0' order by ecod_var";


if($sel_filtro=="no")$txt_filtro='';
if (isset($txt_filtro) && $txt_filtro!='' && isset($sel_filtro) && $sel_filtro!='' && $sel_filtro!="no") {
   $query .= " and $sel_filtro ~* '$txt_filtro'";
  }
  if ($ordtype == "asc") { $ordtypestr = "desc"; } else { $ordtypestr = "asc"; }

if (isset($order) && $order!='') $query .= " order by $order";
if (isset($ordtype) && $ordtype!='') $query .= " " .str_replace("'", "''", $ordtype);
//print $query;
if($ver=="")
$ver=50;
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
<!-- InstanceBeginEditable name="head" --> 
<style type="text/css">
<!--
.style1 {font-size: 14px}
-->
</style>
<style type="text/css">
<!--
.style2 {color: #FFFF99}
-->
</style>
<!-- InstanceEndEditable --> 

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
              <div align="center"> 
                <table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
<tr> 
                    <td class="menudottedline" align="right"> <table width="100%" border="0" class="menubar"  id="toolbar">
                        <tr > 
                          <td width="6%" valign="middle"  class="us"><img src="../../../imagenes/large/lists.gif" width="48" height="48" border="0"><strong><font color="#000000" size="1"> 
                            </font></strong></td>
                          <td width="87%" valign="middle"  class="us"><strong><font color="#5A697E" size="4">Cat&aacute;logo 
                            de variedades-especificaciones</font></strong></td>
                          <td width="0%"> 
                            <div align="center"> <a  class="toolbar" href="imp_variedad.php?no=<?php $b=$pager_nav->index_rs; echo $b; ?>%20" target="_blank" > 
                              <img   src="../../../imagenes/admin/print.png" alt="Imprimir" width="32" height="32" border="0"> 
                              <br>
                              Imprimir</a> </div></td>
                          <td width="7%"> 
                            <div align="center"><a class="toolbar" href="#" onClick="window.open('../../../help/l_variedad.htm', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                              <img src="../../../imagenes/admin/help_f2.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" /><br>
                              Ayuda</a></div></td>
                        </tr>
                        
                    </table></td>
                  </tr>
                </table>
                <br>
                
                <table width="99%" align="center" cellpadding="0" cellspacing="0"  class="tabla" id="toolbar1">
                  <tr align="center" valign="middle"> 
<td height="38" colspan="11"  >

 <table width="713" height="20" border="0" cellpadding="0" cellspacing="0" class="filtro" >
   <tr>
     <td  height="20"><div align="right">Filtro:
         <input  name="txt_filtro" type="text" class="combo" value="<?php echo $txt_filtro ?>" size="15">
         <select  onChange="document.frm.submit();" class="combo" name="sel_filtro">
           <option value="<?php echo "no" ?>">-Seleccionar-</option>
           <option value="<?php echo "cod_var" ?>"<?php if ($sel_filtro == "cod_var") { echo "selected"; } ?>><?php echo htmlspecialchars("Código Variedad") ?></option>
           <option value="<?php echo "variedad" ?>"<?php if ($sel_filtro == "variedad") { echo "selected"; } ?>><?php echo htmlspecialchars("Variedad") ?></option>
         </select>
     </div></td>
     <td   align="right"><a href="#">
       <?php
  					
  							$pager_nav->Render_Navegator();		?>
       </a>
         <?php
				  		echo "&nbsp;&nbsp;<b>P&aacute;gina: </b>".$pager_nav->curr_page." de ". $pager_nav->count_page."&nbsp;";
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
         <option value="100" <?php if($ver==100){?>selected="selected" <?php } ?>>100</option>
         <option value="1000" <?php if($ver==1000){?>selected="selected" <?php } ?>>1000</option>
       </select></td>
   </tr>
 </table> </td>
                  </tr>
                  
                  <tr align="center" valign="center"  > 
					<td width="3%" height="20" class="intro">No</td>
                    <td width="10%"  class="intro" >&nbsp;</td>
                    <td width="12%"  class="intro" >&nbsp;</td>
                    <td width="75%"  class="intro" >&nbsp;</td>
                  </tr>
                  <?php
if($rs->fields[0]!='')
{	
  $cadenacheckboxp = "";
  	if ($rs->RecordCount() > 0)
  	{

	 	$rs->MoveFirst();
		$v=1;
	  	while (!$rs->EOF)
	  	{
				$a=$pager_nav->index_rs++;
				$valor1=$rs->fields["valor1"];
				$valor2=$rs->Fields("valor2");
				$valor3=$rs->fields["valor3"];
				$valor4=$rs->fields["valor4"];
				$valor5=$rs->fields["valor5"];
				$valor6=$rs->fields["valor6"];
				
				
				$carac1=$rs->fields["carac1"];
				$carac2=$rs->Fields("carac2");
				$carac3=$rs->fields["carac3"];
				$carac4=$rs->fields["carac4"];
				$carac5=$rs->fields["carac5"];
				$carac6=$rs->fields["carac6"];
				
				
				
				
  ?>
                  <tr <?php if($a % 2) {print "class=\"row1\"";$estilo="class=\"row1\"";} else {print "class=\"row0\"";$estilo="class=\"row0\"";}   ?> >
                    <td rowspan="2" class="raya" align="center"><span class="style1"><?php  echo $a;$a=$a+1; ?></span></td>
                    
                    <td width="10%" rowspan="2" align="center" class="raya"><?php 
		if (file_exists('../variedad/fotos_catalogo/'. $rs->fields["cod_var"] .'.jpg'))	  {?>
 <a onMouseOver="return overlib('<?php 
 print "<img src=../variedad/fotos_catalogo/". $rs->fields["cod_var"] .".jpg border=0 width=185 height=185 >";
					  
					  ?>', ABOVE, RIGHT);" onMouseOut="return nd();"><?php print "<img src=../variedad/fotos_catalogo/". $rs->fields["cod_var"] .".jpg border=0 width=45 height=45 >";
 }else print "&nbsp;";?></a></td>
 
 
                    <td height="18" align="center" ><div align="left"><font color="#FFFFCC"><b><?php echo $rs->fields["ecod_var"];?></b></font></div></td>
                    <td align="center" ><div align="left"><font color="#FFFFCC"><b><?php echo $rs->fields["variedad"];?></b></font></div></td>
                   
                  </tr>
                  <tr  > 
                    <td height="17" colspan="2" align="center" class="raya"><div align="left">
                    
                    
                    
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="filtro">
              
              
          <tr <?php print $estilo;?> height="10">
            <td width="19%" height="10"align="center"><div align="right"><?php if($carac1){print $carac1.": ";}?></div></td>
            <td width="17%" height="10" align="center" ><div align="left"><?php if($valor1){print $valor1;}?></div></td>
            <td width="18%" height="10"align="center"><div align="right"><?php if($carac2){print $carac2.": ";}?></div></td>
            <td width="15%" height="10" align="center" ><div align="left"><?php if($valor2){print $valor2;}?></div></td>
         	<td width="16%" height="10"align="center"><div align="right"><?php if($carac3){print $carac3.": ";}?></div></td>
            <td width="15%" height="10" align="center" ><div align="left"><?php if($valor3){print $valor3;}?></div></td>
          </tr>
          
          <tr <?php print $estilo;?> height="10">
            <td width="19%" height="10"align="center"><div align="right"><?php if($carac4){print $carac4.": ";}?></div></td>
            <td width="17%" height="10" align="center" ><div align="left"><?php if($valor4){print $valor4;}?></div></td>
          	<td width="18%" height="10"align="center"><div align="right"><?php if($carac5){print $carac5.": ";}?></div></td>
            <td width="15%" height="10" align="center" ><div align="left"><?php if($valor5){print $valor5;}?></div></td>
            <td width="16%" height="10"align="center"><div align="right"><?php if($carac6){print $carac6.": ";}?></div></td>
            <td width="15%" height="10" align="center" ><div align="left"><?php if($valor6){print $valor6;}?></div></td>
          </tr>
            
          
		</table>
                    
                    
                    
                    
                    </div></td>
                  </tr>
                  
                  <?php 
					
				
	  	$rs->MoveNext();
	  	}
  	}
  	
 }		
  ?>
                </table>
                
                <br>
               <p>
                  <input type="hidden" name="var_checkbox" value="<?php echo $cadenacheckboxp;?>">
                  <input type="hidden" name="var_aux_mod" value="">
                  <input type="hidden" name="tabla" value="<?php echo "n_variedad";?>">
                  <input type="hidden" name="campo" value="<?php echo "id_variedad";?>">
                  <input type="hidden" name="location" value="<?php echo "../administracion/nomencladores/variedad/l_variedad.php";?>">
                </p>
              </div>
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
