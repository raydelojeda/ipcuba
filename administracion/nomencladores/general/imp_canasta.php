<?php 
$x="../../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."adodb/adodb-navigator.php");
$query = "select * from n_capitulo,n_division,n_grupo,n_subgrupo,n_articulo,n_producto WHERE (n_capitulo.id_capitulo = n_division.id_capitulo) AND  (n_division.id_division=n_grupo.id_division) AND  (n_grupo.id_grupo=n_subgrupo.id_grupo)  AND  (n_subgrupo.id_subgrupo=n_articulo.id_subgrupo)  AND  (n_articulo.id_articulo = n_producto.id_articulo)";
if($ver=="")
$ver=50;
$pager_nav = new CData_PagerNav($db, $query, $ver,"frm",$order,$ordtype);
$rs = $pager_nav->curr_rs;
//print $rs;
include("../../../php/session/session_super.php");
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
<script language="JavaScript" src="../../../javascript/JSCookMenu_mini.js" type="text/javascript"></script>
<script language="JavaScript" src="../../../javascript/theme.js" type="text/javascript"></script>
<script language="javascript" src="../../../javascript/cal2.js"></script>
<script language="javascript" src="../../../javascript/cal_conf2.js"></script>
<script language="JavaScript" src="../../../javascript/funciones.js" type="text/javascript">
var cabecera=window.screenTop
 
if (navigator.appName == 'Microsoft Internet Explorer')
{
   window.moveTo(-6,-cabecera)
   window.resizeTo(screen.width+9,screen.height+cabecera+25)
}
</script>
<body  onLoad="window.print();" >
<form method="post" name="frm" id="frm" >
<table width="700"  class="imp_tabla"  align="center" cellpadding="0" cellspacing="0" >
  <tr> 
    <td width="750"> <table width="700" border="0"  align="center" cellpadding="0" cellspacing="0" >
        <tr> </tr>
        <tr> 
          <td align="center" valign="middle" bgcolor="#FFFFFF"> <div align="center"> 
              <table width="100%"  cellpadding="0" cellspacing="0" border="0">
                <tr> 
                  <td  align="right"> <table width="100%" border="0" >
                      <tr > 
                          <td height="16" valign="middle"  class="imprimir"><strong>Nomenclador 
                            Canasta</strong></td>
                      </tr>
                    </table>
                    <table width="100%" height="146"  align="center" cellpadding="0" cellspacing="0"  class="imp_celda" >
                      <thead>
                        <tr align="center" valign="middle"> 
                          <td height="39" colspan="15"  > 
                            <?php
		
  		if ($rs->RecordCount() > 0)
  		{
  	?>
                            <div align="right"><a href="#"> 
                              <?php
  					
  							$pager_nav->Render_Navegator();		?>
                              </a> 
                              <?php
				  		echo "&nbsp;&nbsp;<b>Página: </b>".$pager_nav->curr_page." de ". $pager_nav->count_page."&nbsp;";
 		  			  		?>
                              &nbsp;&nbsp;&nbsp;</div></td>
                        </tr>
                        <?php   	
  						}  	
  						?>
                        <tr align="center" valign="center"  > 
                          <td width="0%" class="imp_celda">&nbsp;</td>
                          <td  width="15%"  height="20" class="imp_celda">Capítulo</td>
                          <td  class="imp_celda" >&nbsp;</td>
                          <td width="13%"  class="imp_celda" >División</td>
                          <td class="imp_celda">&nbsp;</td>
                          <td class="imp_celda">Grupo </td>
                          <td class="imp_celda">&nbsp;</td>
                          <td class="imp_celda">Subgrupo</td>
                          <td class="imp_celda" width="3%">&nbsp;</td>
                          <td class="imp_celda" width="24%">Artículo</td>
                          <td class="imp_celda" width="1%">&nbsp;</td>
                          <td class="imp_celda" width="18%">Producto</td>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
  $cadenacheckboxp = "";
  	if ($rs->RecordCount() > 0)
  	{

	 	$rs->MoveFirst();
	
	  	while (!$rs->EOF)
	  	{

  ?>
                        <tr   > 
                          <td class="imp_celda">&nbsp;</td>
                          <td class="imp_celda" width="15%" height="40" ><?php echo $rs->fields["cod_capitulo"].". ";echo $rs->fields["capitulo"];?></td>
                          <td class="imp_celda" width="0%" >&nbsp;</td>
                          <td class="imp_celda" width="13%"><?php echo $rs->fields["cod_division"].". ";echo $rs->fields["division"];?></td>
                          <td class="imp_celda" width="0%" >&nbsp;</td>
                          <td class="imp_celda" width="13%" ><?php echo $rs->fields["cod_grupo"].". ";echo $rs->fields["grupo"];?></td>
                          <td class="imp_celda" width="0%" >&nbsp;</td>
                          <td class="imp_celda" width="13%" ><?php echo $rs->fields["cod_subgrupo"].". ";echo $rs->fields["subgrupo"];?></td>
                          <td class="imp_celda" width="3%" >&nbsp;</td>
                          <td class="imp_celda" width="24%" ><?php echo $rs->fields["cod_articulo"].". ";echo $rs->fields["articulo"];?></td>
                          <td class="imp_celda" width="1%" >&nbsp;</td>
                          <td class="imp_celda" width="18%" ><?php echo $rs->fields["cod_prod"].". ";echo $rs->fields["producto"];?></td>
                        </tr>
                        <?php $rs->MoveNext();
						if(!$rs->EOF)
					{
						?>
                        <tr > 
                          <td class="imp_celda">&nbsp;</td>
                          <td class="imp_celda" height="40"  width="15%"><?php echo $rs->fields["cod_capitulo"].". ";echo $rs->fields["capitulo"];?></td>
                          <td class="imp_celda" width="0%" >&nbsp;</td>
                          <td class="imp_celda" width="13%"><?php echo $rs->fields["cod_division"].". ";echo $rs->fields["division"];?></td>
                          <td class="imp_celda" width="0%" >&nbsp;</td>
                          <td class="imp_celda" width="13%" ><?php echo $rs->fields["cod_grupo"].". ";echo $rs->fields["grupo"];?></td>
                          <td class="imp_celda" width="0%" >&nbsp;</td>
                          <td class="imp_celda" width="13%" ><?php echo $rs->fields["cod_subgrupo"].". ";echo $rs->fields["subgrupo"];?></td>
                          <td class="imp_celda" width="3%" >&nbsp;</td>
                          <td class="imp_celda" width="24%" ><?php echo $rs->fields["cod_articulo"].". ";echo $rs->fields["articulo"];?></td>
                          <td class="imp_celda" width="1%" >&nbsp;</td>
                          <td class="imp_celda" width="18%" ><?php echo $rs->fields["cod_producto"].". ";echo $rs->fields["producto"];?> 
                          </td>
                        </tr>
                        <?php 
					}
   	  	$rs->MoveNext();
	  	}
  	}
  	
 		
  ?>
                      </tbody>
                    </table>
                    
                 </td>
                </tr>
              </table>
            </div></td>
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

</FORM>
</body>
</html>
