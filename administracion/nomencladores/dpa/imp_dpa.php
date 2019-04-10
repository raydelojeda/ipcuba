<?php 
$x="../../../";
$tabla=n_dpa;
include("../../../php/listar.php");
include("../../../php/session/session_super.php");
/*--------------------------------------------------------------------------------------------
if (isset($_GET["no"]))
{
	$i = $_GET["no"]; 
	
	
}
else
{
	print "<br> <marquee><center>Usted está; accediendo a esta pá;gina de forma incorrecta.</marquee><br>";
	//die();
}
*///--------------------------------------------------------------------------------------------
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
<title>IPC</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../css/azul.css" rel="stylesheet" type="text/css">
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
                          <td valign="middle"  class="imprimir"><strong>Administración 
                            DPA </strong></td>
                        </tr>
                      </table></td>
                  </tr>
                </table>
                
                <table width="82%" border="0" cellpadding="0" cellspacing="0" class="imprimir">
                  <tr align="center" valign="middle"> 
                    <td colspan="6"  > 
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
                    <td colspan="6">&nbsp;</td>
                  </tr>
                  <?php   	
  						}  	
  						?>
                  <tr align="center" valign="center"  > 
                    <td class="imp_celda" width="11%" height="21">No</td>
                    <td class="imp_celda"width="31%" >Código DPA</td>
                    <td class="imp_celda"><div align="left">Provincia-Municipio 
                      </div></td>
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
                    <td class="imp_celda" align="center"><?php echo $rs->fields["cod_dpa"];?></td>
                    <td class="imp_celda"> <div align="left"><?php echo $rs->fields["prov_mun"];?></div></td>
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
