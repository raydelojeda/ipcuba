<?php 
$x="../../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."php/session/session_autor.php");
include($x."adodb/adodb-navigator.php");

$query_usuario = " where usuario='".$_SESSION["user"]."' and n_dpa.cod_dpa=usuario.cod_dpa"; 
$sql_usuario = "select rol, id_usuario, usuario.cod_dpa,prov_mun from usuario,n_dpa".$query_usuario;	
$rs_usuario = $db->Execute($sql_usuario)or $mensaje=$db->ErrorMsg() ;
$cod_dpa2=substr($rs_usuario->Fields("cod_dpa"),0,2)."%";
$cod_dpa=$rs_usuario->Fields("cod_dpa");
$rol=$rs_usuario->Fields("rol");

if (isset($_GET["order"])) $order = $_GET["order"]; //else $order=orden;
if (isset($_GET["type"])) $ordtype = $_GET["type"]; //else $ordtype=asc;
if ($_GET["txt_filtro"]!="") $txt_filtro = $_GET['txt_filtro'];
if (isset($_POST["txt_filtro"])) $txt_filtro = $_POST['txt_filtro'];
if ($_GET["ver"]!="") $ver = $_GET['ver'];
if (isset($_POST["sel_#"])) $ver = $_POST['sel_#'];
if ($_GET["sel_filtro"]!="") $sel_filtro = $_GET['sel_filtro'];
if (isset($_POST["sel_filtro"])) $sel_filtro = $_POST['sel_filtro'];
$query = "select n_dpa.cod_dpa,prov_mun,prov_mun_nuevo, cod_dpa_nueva, count(distinct n_estab.id_estab) from n_estab, n_var_estab, n_dpa,b_variedad,n_variedad
where n_var_estab.idb_variedad=b_variedad.idb_variedad and b_variedad.id_variedad=n_variedad.id_variedad 
and n_var_estab.id_estab=n_estab.id_estab and n_estab.cod_dpa=n_dpa.cod_dpa and incluido='1' and n_variedad.ide_articulo!='1'";
//print $query;
//if($rol=="aut_p")
//$query=$query." and n_estab.cod_dpa like '".$cod_dpa2."'";

//if($rol=="autor")
//$query=$query." and n_estab.cod_dpa='".$cod_dpa."'";

$query=$query."group by n_dpa.cod_dpa,prov_mun,prov_mun_nuevo, cod_dpa_nueva order by n_dpa.cod_dpa";

if($sel_filtro=="no")$txt_filtro='';
if (isset($txt_filtro) && $txt_filtro!='' && isset($sel_filtro) && $sel_filtro!='' && $sel_filtro!="no") {
   $query .= " and $sel_filtro ~* '$txt_filtro'";//print $query;
  }
  if ($ordtype == "asc") { $ordtypestr = "desc"; } else { $ordtypestr = "asc"; }

if (isset($order) && $order!='') $query .= " order by $order";
if (isset($ordtype) && $ordtype!='') $query .= " " .str_replace("'", "''", $ordtype);

if($ver=="")
$ver=50;
//print $query;
$pager_nav = new CData_PagerNav($db, $query, $ver,"frm",$order,$ordtype);
$rs = $pager_nav->curr_rs;//print $rs;
//print $rs;
$prov_mun_nuevo=$rs->fields["prov_mun_nuevo"];
?>

<html>
<head>
<title>IPC</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../../css/azul.css" rel="stylesheet" type="text/css">
<link href="../../../css/theme.css" rel="stylesheet" type="text/css">
<link href="../../../css/estilos.css" rel="stylesheet" type="text/css">
</head>

<script language="JavaScript" src="../../../javascript/JSCookMenu_mini.js" type="text/javascript"></script>
<script language="JavaScript" src="../../../javascript/theme.js" type="text/javascript"></script>
<script language="javascript"   src="../../../javascript/overlib_mini.js"></script>
<script language="javascript"    src="../../../javascript/barra/floater_xlibAbajo.js"></script>
<script language="javascript"    src="../../../javascript/barra/basic.js"></script>
<script language="javascript"    src="../../../javascript/barra/scripts1.js"></script>
<script language="JavaScript" src="../../../javascript/funciones.js" type="text/javascript">

var cabecera=window.screenTop

if (navigator.appName == 'Microsoft Internet Explorer')
{
   window.moveTo(-6,-cabecera)
   window.resizeTo(screen.width+9,screen.height+cabecera+25)
}
</script>
<body  onLoad="loadBar()"><form method="post" name="frm" id="frm" action="">
<div id="contenido1">
<table width="750"  border="1"  align="center" cellpadding="0" cellspacing="0" bordercolor="#5A697E">
  <tr> 
    <td> <table width="750" border="0"  align="center" cellpadding="0" cellspacing="0" >
          <tr> 
            <td><img src="../../../imagenes/banner.jpg" width="750" height="35"></td>
          </tr>
          <tr> 
            <table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
              <tr> 
                <td class="menubackgr" style="padding-left:5px;"> <div id="myMenuID"></div>
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
                <td class="menubackgr"  valign="middle" align="right" > <a href="../../../php/logout.php" style="color: #333333; font-weight: bold"> 
                  Salir:&nbsp; <?php print $_SESSION["user"];?></a> </td>
              </tr>
            </table>
          </tr>
          <tr> 
            <td align="center" valign="middle" bgcolor="#FFFFFF"> <div align="center"> 
                <table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
                  <tr> 
                    <td class="menudottedline" align="right"> <table width="100%" border="0" class="menubar" id="toolbar"  >
                        <tr  > 
                          <td width="6%" valign="middle"  class="us"><img src="../../../imagenes/admin/frontpage.png" width="48" height="48" border="0"><strong><font color="#000000" size="1"> 
                            </font></strong></td>
                          <td width="70%" valign="middle"  class="us"><strong><font color="#5A697E" size="4">Establecimientos asignados por municipio</font></strong></td>
                          
                          <td width="5%"> <div align="center"> <a  class="toolbar" href="../../estab/imp_estab.php?no=<?php $b=$pager_nav->index_rs; echo $b; ?>%20"   target="_blank"> 
                              <img   src="../../../imagenes/admin/print.png" alt="Imprimir" width="32" height="32" border="0"> 
                              <br>
                          Imprimir</a> </div></td>
                          <td width="10%"> <div align="center"><a class="toolbar" href="#" onClick="window.open('../../help/l_estab.htm', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                              <img src="../../../imagenes/admin/help_f2.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" /><br>
                          Ayuda</a></div></td>
                        </tr>
                        
                    </table></td>
                  </tr>
                </table>
                <br>
                <table width="88%" height="104" border="0" cellpadding="0" cellspacing="0" class="tabla" id="toolbar1">
                  
                  <tr align="center" valign="center"  > 
                    <td class="intro" width="6%" height="20">No</td>
                    <td class="intro" width="22%"><a href="l_estab_m.php?order=<?php echo "n_dpa.cod_dpa" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>">Cód. DPA</a></td>
                    <td class="intro" width="41%" ><a href="l_estab_m.php?order=<?php echo "cod_estab" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>">Municipio</a></td>
                    <td class="intro" width="31%"><a href="l_estab_m.php?order=<?php echo "estab" ?>&type=<?php echo $ordtypestr ?>&txt_filtro=<?php echo $txt_filtro?>&sel_filtro=<?php echo $sel_filtro?>&ver=<?php echo $ver?>">Cantidad de establecimientos</a></td>
                  </tr>
                  <?php
  $cadenacheckboxp = "";
  if($rs->fields[0]!='')
{

	 	$rs->MoveFirst();
	
	  	while (!$rs->EOF)
	  	{

  ?>
                  <tr <?php if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";   ?> > 
                    <td class="raya" height="21" align="center"> 
                      <?php $a=$pager_nav->index_rs++; echo $a; ?>                    </td>
                    <td class="raya"align="center"><?php echo $rs->fields["cod_dpa_nueva"];?></td>
                    <td class="raya" align="center"><a class="toolbar1" ><?php echo $rs->fields["prov_mun_nuevo"];?></a></td>
                    <td class="raya" align="center"><a class="toolbar1" ><?php if(substr($rs->fields["cod_dpa"],0,2)=="03")$ch=$ch+$rs->fields["count"]; $cuba=$cuba+$rs->fields["count"];echo $rs->fields["count"];?></a></td>
                  </tr>
                  
                  <?php 

    


	  	$rs->MoveNext();
	  	}
  	}
  	
  		
  ?>
  
  				  <tr <?php if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";   ?> >
  				    <td class="raya" height="21" align="center">&nbsp;</td>
  				    <td class="raya"align="center">&nbsp;</td>
  				    <td align="center" class="raya">&nbsp;</td>
  				    <td class="raya" align="center">&nbsp;</td>
			      </tr>
  				  <tr <?php if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";   ?> >
                    <td class="raya" height="21" align="center">&nbsp;</td>
                    <td class="raya"align="center">&nbsp;</td>
                    <td align="center" class="raya"><strong>0300. C. Habana</strong></td>
                    <td class="raya" align="center"><b><?php print $ch;?></b></td>
                  </tr>
                  <tr <?php if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";   ?> >
                    <td class="raya" height="21" align="center">&nbsp;</td>
                    <td class="raya"align="center">&nbsp;</td>
                    <td align="center" class="raya"><strong>Total Cuba</strong></td>
                    <td class="raya" align="center"><b><?php print $cuba;?></b></td>
                  </tr>
                </table>
              </div>
             
              <br></td>
          </tr>
        </table></td>
  </tr>
  </table>
   <table width="754" height="21"  border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#5A697E">
  <tr> 
    <td width="30" height="21"  align="center" valign="middle"> <div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><img src="../../../imagenes/down.jpg" width="30" height="26"></font></div></td>
    <td width="695"  align="center" valign="middle" bgcolor="#4B4B4B">
      <div align="center"><font color="#FFFFFF" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>ONEI - Grupo de IPC 2010</strong></font></div></td>
    <td width="30"  align="center" valign="middle"><div align="center"><img src="../../../imagenes/up.jpg" width="30" height="26"></div></td>
  </tr>
</table>
</form>
</body>
</html>
