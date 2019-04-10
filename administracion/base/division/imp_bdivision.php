<?php 
$x="../../../";
$campo_order="n_division.cod_division";

include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."adodb/adodb-navigator.php");
include($x."php/session/session_super.php");
if (isset($_GET["order"])) $order = $_GET["order"]; //else $order=orden;
if (isset($_GET["type"])) $ordtype = $_GET["type"]; //else $ordtype=asc;
if ($_GET["txt_filtro"]!="") $txt_filtro = $_GET['txt_filtro'];
if (isset($_POST["txt_filtro"])) $txt_filtro = $_POST['txt_filtro'];
if ($_GET["ver"]!="") $ver = $_GET['ver'];
if (isset($_POST["sel_#"])) $ver = $_POST['sel_#'];



//------------------------------FECHA MAXIMA DE LA BASE---------------------					 
$sql_fecha = "select max(fecha) from b_variedad";		
$rs_fecha = $db->Execute($sql_fecha)or die($db->ErrorMsg()) ;
$fecha_max = $rs_fecha->Fields('max');//print $x;
//------------------------------FECHA MAXIMA DE LA BASE---------------------



$query = "select * from n_division, b_division, n_mercado where b_division.id_division=n_division.id_division and b_division.id_mercado_nuevo=n_mercado.id_mercado_nuevo and fecha='".$fecha_max."'";

if($sel_filtro=="no")$txt_filtro='';
if (isset($txt_filtro) && $txt_filtro!='' && isset($sel_filtro) && $sel_filtro!='' && $sel_filtro!="no") {
   $query .= " and  $sel_filtro ~* '$txt_filtro'";
  }
if ($ordtype == "asc") { $ordtypestr = "desc"; } else { $ordtypestr = "asc"; }


if (isset($order) && $order!='') $query .= " order by $order"; elseif($campo_order) $query .= " order by $campo_order";
if (isset($ordtype) && $ordtype!='') $query .= " " .str_replace("'", "''", $ordtype);

if($ver=="")
$ver=50;

$pager_nav = new CData_PagerNav($db, $query, $ver,"frm",$order,$ordtype);
//print $query;
$rs = $pager_nav->curr_rs;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
<title>IPC</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../../css/azul.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="../../javascript/funciones.js" type="text/javascript">
var cabecera=window.screenTop

if (navigator.appName == 'Microsoft Internet Explorer')
{
   window.moveTo(-6,-cabecera)
   window.resizeTo(screen.width+9,screen.height+cabecera+25)
}
</script>
</head>


<body onload="window.print()">
<p>&nbsp;</p>

<table width="700"  class="imp_tabla"  align="center" cellpadding="0" cellspacing="0" >
<tr> 
    <td width="750"> 
<table width="700" border="0"  align="center" cellpadding="0" cellspacing="0" >
<tr> 
          
        </tr>
        <tr> 
          <td align="center" valign="middle" bgcolor="#FFFFFF"> <form method="post" name="frm" id="frm" >
              <div align="center"> 
                <table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
                  <tr> 
                    <td class="menudottedline" align="right"> <table width="100%" border="0" >
                        <tr > 
                          <td valign="middle"  class="imprimir"><strong>Artículos 
                            de la base</strong></td>
                        </tr>
                      </table></td>
                  </tr>
                </table>
                
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="imprimir">
                  <tr align="center" valign="middle"> 
                    <td colspan="10"  > 
                      <?php
		
  		if ($rs->RecordCount() > 0)
  		{
  	?><div align="right">
                      <a class="imprimir" href="#"> 
                      <?php
  					
  						$pager_nav->Render_Navegator();		?>
                      </a> 
                      <?php
				  		echo "&nbsp;&nbsp;<b>Página: </b>".$pager_nav->curr_page." de ". $pager_nav->count_page."&nbsp;";
 		  			  		?>
                    </td>
                  </tr>
                  <tr> 
                    <td colspan="10">&nbsp;</td>
                  </tr>
                  <?php   	
  						}  	
  						?>
                  <tr align="center" valign="center"  > 
                    <td class="imp_celda" width="4%" height="21">No</td>
                    <td class="imp_celda"width="16%" >Código Artículo</td>
                    <td width="22%" class="imp_celda"> 
                      <div align="left">Artículo</div></td>
                    <td width="16%" class="imp_celda">Mercado</td>
                    <td width="11%" class="imp_celda">Valor</td>
                    <td width="17%" class="imp_celda">Fecha</td>
                    <td width="14%" class="imp_celda">Peso</td>
                  </tr>
                  <?php
 	if ($rs->RecordCount() > 0)
  	{
		if($i!="")
		{	
			$rs->MoveFirst();
			for($j=1;$j<$i;$j++)
			{
				$rs->MoveNext();
			}	 
	
	$pager_nav->index_rs=$i;
	    }
	  	while (!$rs->EOF)
	  	{

  ?>
                  <tr> 
                    <td class="imp_celda"height="22" align="center"> 
                      <?php $a=$pager_nav->index_rs++; echo $a; ?>
                      <div align="center"></div>
                      <div align="center"></div></td>
                    <td class="imp_celda" align="center"><?php echo $rs->fields["cod_division"];?></td>
                    <td class="imp_celda"> <div align="left"><?php echo $rs->fields["division"];?></div></td>
                    <td class="imp_celda"><?php echo $rs->fields["mercado_nuevo"];?></td>
                    <td class="imp_celda"><?php echo $rs->fields["valor"];?></td>
                    <td class="imp_celda"><?php echo $rs->fields["fecha"];?></td>
                    <td class="imp_celda"><?php echo substr($rs->fields["peso"],0,6);?>&nbsp;</td>
                  </tr>
                  <?php 

	  	$rs->MoveNext();
	  	}
  	}
  	
  		
  ?>
                </table>
                
                
              </div>
              
            </form></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td> <table width="700" height="21"  border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#5A697E">
<tr> 
          <td class="imp_celda" height="21"  align="center" valign="middle"> <div align="center"> 
              <font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>ONE. 
              Dpto Estadísticas Sociales&reg; 2008</strong></font></div></td>
        </tr>
      </table></td>
  </tr>
</table>
<!-- ******** BEGIN ALLWEBMENUS CODE FOR LE_submenu_title_cursor ******** -->
<!--<img name='awmMenuPathImg-LE_submenu_title_cursor' id='awmMenuPathImg-LE_submenu_title_cursor' src='../javascript/LE_submenu_title_cursor/awmmenupath.gif' alt=''>
<script type='text/javascript'>var MenuLinkedBy='AllWebMenus [2]', awmBN='450'; awmAltUrl='';</script>
<script  src='../javascript/LE_submenu_title_cursor/LE_submenu_title_cursor.js' language='JavaScript1.2' type='text/javascript'></script>
<script type='text/javascript'>awmBuildMenu();</script>
<!-- ******** END ALLWEBMENUS CODE FOR LE_submenu_title_cursor ******** -->
</body>
</html>
