<?php 
$x="../../";
session_start();
require_once($x."adodb/adodb.inc.php");
require_once($x."coneccion/conn.php");
include($x."php/session/session_admin.php");


//We've included ../Includes/FusionCharts.php and ../Includes/DBConn.php, which contains
//functions to help us easily embed the charts and connect to a database.
include("../Includes/FusionCharts.php");


//------------------------------FECHA MAXIMA DE LA BASE---------------------					 
$sql_fecha = "select max(fecha) from b_variedad";		
$rs_fecha = $db->Execute($sql_fecha)or die($db->ErrorMsg()) ;
$fecha_max = $rs_fecha->Fields('max');//print $x;
//------------------------------FECHA MAXIMA DE LA BASE---------------------

//---------------------------------------------------
if ($_GET["dia1"]!="") $dia1 = $_GET['dia1'];
if ($_GET["dia2"]!="") $dia2 = $_GET['dia2'];


$sql = "select i_general.indice as ind_gen, i_general.fecha as fecha_gen from i_general WHERE i_general.fecha>='$dia1' and i_general.fecha<='$dia2' order by fecha";//print $sql;
$rs_gen = $db->Execute($sql)or die($db->ErrorMsg());

$cant_gen=$rs_gen->RecordCount();


$sql_cup = "select d_general.indice as ind_gen_cup, d_general.fecha as fecha_gen_cup from d_general
WHERE d_general.id_mercado_nuevo='1' and d_general.fecha>='$dia1' and d_general.fecha<='$dia2' order by fecha";//print $sql;
$rs_gen_cup = $db->Execute($sql_cup)or die($db->ErrorMsg());

$cant_gen_cup=$rs_gen_cup->RecordCount();


$sql_cuc = "select d_general.indice as ind_gen_cuc, d_general.fecha as fecha_gen_cuc from d_general
WHERE d_general.id_mercado_nuevo='2' and d_general.fecha>='$dia1' and d_general.fecha<='$dia2' order by fecha";//print $sql;
$rs_gen_cuc = $db->Execute($sql_cuc)or die($db->ErrorMsg());

$cant_gen_cuc=$rs_gen_cuc->RecordCount();
//print $cant_gen."    ".$cant_gen_cup."    ".$cant_gen_cuc;


$sql1 = "select min(i_general.indice),max(i_general.indice) from i_general 
WHERE i_general.fecha>='$dia1' and i_general.fecha<='$dia2'";//print $sql1;
$rs_gen1 = $db->Execute($sql1)or die($db->ErrorMsg());

$sql2 = "select min(d_general.indice),max(d_general.indice) from d_general
WHERE d_general.fecha>='$dia1' and d_general.fecha<='$dia2'";//print $sql2;
$rs_gen2 = $db->Execute($sql2)or die($db->ErrorMsg());	


$min1=$rs_gen1->Fields("min")*100;
$min2=$rs_gen2->Fields("min")*100;
if($min1>$min2)$min=$min2;else $min=$min1;

$max1=$rs_gen1->Fields("max")*100;
$max2=$rs_gen2->Fields("max")*100;
if($max<$max2)$max=$max2;else $max=$max1;


$min=$min-0.2;
$max=$max+0.2;
?>
<SCRIPT LANGUAGE="Javascript" SRC="../FusionCharts/FusionCharts.js"></SCRIPT>

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
																elseif($_SESSION["rol"]=="super")print "S�per Administrador";
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
                    <td height="56" align="right" class="menudottedline"><table width="99%" border="0" class="menubar"  id="toolbar">
                      <tr >
                        <td width="7%" height="50" valign="middle"  class="us"><img src="../../imagenes/admin/impressions.png" alt="" width="48" height="48" border="0"><strong><font color="#000000" size="1"> </font></strong></td>
                        <td width="93%" valign="middle"  class="us"><strong><font color="#5A697E" size="4">Serie del &Iacute;ndice de Precios al Consumidor.</font></strong></td>
                      </tr>
                    </table></td>
                  </tr>
                </table>
                <?php
//$variedad=$rs_cap->Fields("variedad");



$strXML = "<graph caption='�ndice de Precios al Consumidor' subcaption='' hovercapbg='FFECAA' hovercapborder='F47E00' formatNumberScale='0' decimalPrecision='2' showvalues='1' numdivlines='3' numVdivlines='0' yaxisminvalue='".$min."' yaxismaxvalue='".$max."'  rotateNames='1'>";

$strXML.= "<categories >";
for ($i = 0; $i < $cant_gen;$i++)
{
	$fecha_gen=$rs_gen->Fields("fecha_gen");
	
	$mes=substr($fecha_gen,5,2);
	$ano=substr($fecha_gen,2,2);
	
	
	if($mes=="02"){$fecha_text= "Ene/".$ano;$fecha_text2.= ", Enero";}
	if($mes=="03"){$fecha_text= "Feb/".$ano;$fecha_text2.= ", Febrero";}
	if($mes=="04"){$fecha_text= "Mar/".$ano;$fecha_text2.= ", Marzo";}
	if($mes=="05"){$fecha_text= "Abr/".$ano;$fecha_text2.= ", Abril";}
	if($mes=="06"){$fecha_text= "May/".$ano;$fecha_text2.= ", Mayo";}
	if($mes=="07"){$fecha_text= "Jun/".$ano;$fecha_text2.= ", Junio";}
	if($mes=="08"){$fecha_text= "Jul/".$ano;$fecha_text2.= ", Julio";}
	if($mes=="09"){$fecha_text= "Ago/".$ano;$fecha_text2.= ", Agosto";}
	if($mes=="10"){$fecha_text= "Sep/".$ano;$fecha_text2.= ", Septiembre";}
	if($mes=="11"){$fecha_text= "Oct/".$ano;$fecha_text2.= ", Octubre";}
	if($mes=="12"){$fecha_text= "Nov/".$ano;$fecha_text2.= ", Noviembre";}
	if($mes=="01"){$fecha_text= "Dic/".$ano=$ano-1;$fecha_text2.= ", Diciembre";}
	
	$strXML.= "<category name='".$fecha_text."' />";
$rs_gen->MoveNext();
}
$strXML.= "</categories>";


$strXML.= "<dataset seriesName='IPC' color='000000' anchorBorderColor='1D8BD1' anchorBgColor='1D8BD1'>";
$rs_gen->MoveFirst();
for ($g = 0; $g < $cant_gen;$g++)
{
	$ind_gen=number_format($rs_gen->fields["ind_gen"]*100, 2, '.', '');//print $ind_gen;
	$strXML.= "<set value='".$ind_gen."' />";
$rs_gen->MoveNext();
}
$strXML.= "</dataset>";


$strXML.= "<dataset seriesName='IPC en CUP' color='ff0000' anchorBorderColor='1D8BD1' anchorBgColor='1D8BD1'>";

for ($p = 0; $p < $cant_gen_cup;$p++)
{
	$ind_gen_cup=number_format($rs_gen_cup->fields["ind_gen_cup"]*100, 2, '.', '');//print $ind_gen_cup;
	$strXML.= "<set value='".$ind_gen_cup."' />";
$rs_gen_cup->MoveNext();
}

$strXML.= "</dataset>";


$strXML.= "<dataset seriesName='IPC en CUC' color='1D8BD1' anchorBorderColor='1D8BD1' anchorBgColor='1D8BD1'>";

for ($c = 0; $c < $cant_gen_cuc;$c++)
{
	$ind_gen_cuc=number_format($rs_gen_cuc->fields["ind_gen_cuc"]*100, 2, '.', '');//print $ind_gen_cuc;
	$strXML.= "<set value='".$ind_gen_cuc."' />";
$rs_gen_cuc->MoveNext();
}

$strXML.= "</dataset>";

$strXML.= "</graph>";




	echo renderChart("../Charts/FCF_MSLine.swf", "", $strXML, "FactorySum", 750, 400, false, false);
	
	
	?>
	
             
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
