<?php 
$x="../../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."php/session/session_invitado.php");
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
$sql_fecha = "select max(fecha) from b_variedad";		
$rs_fecha = $db->Execute($sql_fecha)or $mensaje=$db->ErrorMsg() ;
$fecha_base = $rs_fecha->Fields('max');//print $x;
//---------------------------------------------------

$query = "select * from b_variedad, n_variedad, n_mercado, n_unidad WHERE  n_mercado.id_mercado = b_variedad.id_mercado and  n_variedad.id_variedad = b_variedad.id_producto AND n_unidad.id_unidad = b_variedad.id_unidad AND fecha='".$fecha_base."'";
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

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<!--  
*** Plataforma en Software Libre
*** Realizado por Ing. Raydel Ojeda Figueroa
   -->
<title>IPC</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../../css/azul.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../../../css/theme.css" type="text/css" />
</head>

<script language="JavaScript" src="../../../javascript/funciones.js" type="text/javascript"></script>
<body onload="window.print()" >
<form method="post" name="frm" id="frm" >
  <div align="center"> <br>
    <table width="700"  class="imp_tabla"  align="center" cellpadding="0" cellspacing="0" >
      <tr> 
<td width="750"> <table width="700" border="0"  align="center" cellpadding="0" cellspacing="0" >
            <tr> </tr>
            <tr> 
<td align="center" valign="middle" bgcolor="#FFFFFF"> <div align="center"> 
<table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
                    <tr> 
<td class="menudottedline" align="right"> <table width="100%" border="0" >
                          <tr > 
                            <td valign="middle"  class="imprimir"><div align="center"><strong>Variedades
                                de la base</strong></div></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table>
                  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="imprimir">
                    <tr align="center" valign="middle"> 
                      <td colspan="13"  > 
                        <?php
		
  		if ($rs->RecordCount() > 0)
  		{
  	?>
                        <div align="right"><a class="imprimir" href="#"> 
                          <?php
  					
  						$pager_nav->Render_Navegator();		?>
                          </a> 
                          <?php
				  		echo "&nbsp;&nbsp;<b>Página: </b>".$pager_nav->curr_page." de ". $pager_nav->count_page."&nbsp;";
 		  			  		?>
                        </div></td>
                    </tr>
                    <tr> 
                      <td colspan="9">&nbsp;</td>
                    </tr>
                    <?php   	
  						}  	
  						?>
                    <tr align="center" valign="center"  > 
                      <td class="imp_celda" width="2%" height="21">No</td>
                      <td class="imp_celda" width="11%" >Mercado</td>
                      <td class="imp_celda" width="43%">Variedad</td>
                      <td class="imp_celda" width="5%" >Precio</td>
                      <td class="imp_celda" width="5%">Peso</td>
                      <td class="imp_celda" width="8%">Precio Min</td>
                      <td class="imp_celda" width="8%">Precio M&aacute;x</td>
                      <td class="imp_celda" width="10%">Fecha</td>
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
                      <td class="imp_celda" height="22" align="left"> 
                        <?php $a=$pager_nav->index_rs++; echo $a; ?>
                      </td>
                      <td class="imp_celda" align="center"><?php echo $rs->fields["mercado"];?></td>
                      <td class="imp_celda" align="left"><?php echo $rs->fields["cod_var"].". ".$rs->fields["variedad"];?></td>
                      <td class="imp_celda" align="center"><?php echo $rs->fields["precio"];?></td>
                      <td  class="imp_celda"align="center"><?php echo substr($rs->fields["peso"],0,6);?>&nbsp;</td>
                      <td  class="imp_celda"align="center"><?php echo $rs->fields[" "];?></td>
                      <td  class="imp_celda"align="center"><?php echo $rs->fields["p_max"];?></td>
                      <td  class="imp_celda"align="center"><?php echo $rs->fields["fecha"];?></td>
                    </tr>
                    <?php 

  
	  	$rs->MoveNext();
	  	}
  	}
  	
  		
  ?>
                  </table>
                </div></td>
            </tr>
          </table></td>
      </tr>
      <tr> 
<td> <table width="700" height="21"  border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#5A697E">
            <tr> 
              <td class="imp_celda" height="21"  align="center" valign="middle"> 
<div align="center"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>ONE. 
                  Dpto Estadísticas Sociales&reg; 2008</strong></font></div></td>
            </tr>
          </table></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    
  </div>
</form>
<div align="center"></div>
<!-- ******** BEGIN ALLWEBMENUS CODE FOR LE_submenu_title_cursor ******** -->
<!--<img name='awmMenuPathImg-LE_submenu_title_cursor' id='awmMenuPathImg-LE_submenu_title_cursor' src='../javascript/LE_submenu_title_cursor/awmmenupath.gif' alt=''>
<script type='text/javascript'>var MenuLinkedBy='AllWebMenus [2]', awmBN='450'; awmAltUrl='';</script>
<script  src='../javascript/LE_submenu_title_cursor/LE_submenu_title_cursor.js' language='JavaScript1.2' type='text/javascript'></script>
<script type='text/javascript'>awmBuildMenu();</script>
<!-- ******** END ALLWEBMENUS CODE FOR LE_submenu_title_cursor ******** -->
</body>
</html>
