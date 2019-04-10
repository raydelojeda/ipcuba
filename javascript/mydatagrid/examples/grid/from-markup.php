<?php 
$x="../../../";
$tabla=n_dpa;
include("../../../php/listar.php");
//include("../../../php/session/session_admin.php");
print $_POST['sel_cam'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>From Markup Grid Example</title>
<link rel="stylesheet" type="text/css" href="../../resources/css/ext-all.css" />
<link rel="stylesheet" href="../../../administracion/templates/joomla_admin_spanish/css/theme.css" type="text/css" />
<script language="JavaScript" src="../../../javascript/JSCookMenu_mini.js" type="text/javascript"></script>
<script language="JavaScript" src="../../../administracion/includes/js/ThemeOffice/theme.js" type="text/javascript"></script>
<script language="JavaScript" src="../../../includes/js/joomla.javascript.js" type="text/javascript"></script>
<script language="JavaScript" src="../../../javascript/funciones.js" type="text/javascript"></script>
<!-- GC --> <!-- LIBS -->     
<script type="text/javascript" src="../../adapter/yui/yui-utilities.js"></script>     
<script type="text/javascript" src="../../adapter/yui/ext-yui-adapter.js"></script>     
<!-- ENDLIBS -->
<script type="text/javascript" src="../../ext-all.js"></script>
<script type="text/javascript" src="from-markup.js"></script>
<!-- Common Styles for the examples -->
<style type="text/css">
#toolbar1 { border:1px solid #bbb;border-collapse:collapse; }
#toolbar1 td,#toolbar1 th { border:1px solid #ccc;border-collapse:collapse;padding:5px; }
#imag { cursor:pointer; }
</style>
<link href="../../../css/azul.css" rel="stylesheet" type="text/css">
</head>
<body >
<script type="text/javascript" src="../examples.js"></script>
<!-- EXAMPLES --></br>
<form method="post" name="frm" id="frm" >
  <div align="center"> 
    <table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
      <tr> 
        <td class="menudottedline" align="right"> <table width="100%" border="0" class="menubar"  id="toolbar">
            <tr > 
              <td width="6%" rowspan="2" valign="middle"  class="us"><img src="../../imagenes/admin/categories.png" width="48" height="48" border="0"><strong><font color="#000000" size="1"> 
                </font></strong></td>
              <td height="38" valign="bottom"  class="us"><strong><font color="#5A697E" size="4">Administración 
                DPA </font></strong></td>
              <td width="0%" rowspan="2"> <div align="center"><a class="toolbar" href="n_dpa.php"><img src="../../imagenes/admin/new_f2.png" alt="Nuevo" name="new" width="32" height="32" border="0" id="new"><br>
                  Nuevo</a></div></td>
              <td width="6%" rowspan="2"> <div align="center"> <a  onClick="modif('m_dpa.php');" class="toolbar" href="#"> 
                  <img   src="../../imagenes/admin/edit_f2.png" alt="Editar" width="32" height="32" border="0"> 
                  <br>
                  Editar</a> </div></td>
              <td width="6%" rowspan="2"> <div align="center"> <a class="toolbar" href="#"> 
                  <input name="borrar" type="image" onClick="<?php

/*session_start();
if (!($_SESSION["login"] == 'Admin') && !($_SESSION["login"] == 'Especialista'))
{
header("Location: Autenticacion.php");
}else {*/?>elim('../../php/eliminar.php');
<?php //} ?>" src="../../imagenes/admin/delete_f2.png" alt="Borrar" width="32" height="32" border="0">
                  <br>
                  Borrar</a> </div></td>
              <td width="9%" rowspan="2"> <div align="center"> <a  class="toolbar" href="imp_dpa.php?no=<?php $b=$pager_nav->index_rs; echo $b; ?> " target="_blank" > 
                  <img   src="../../imagenes/admin/print.png" alt="Imprimir" width="32" height="32" border="0"> 
                  <br>
                  Imprimir</a> </div></td>
              <td width="12%" rowspan="2"> <div align="center"><a class="toolbar" href="#" onclick="window.open('../../help/usuarios.htm', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                  <img src="../../imagenes/admin/help_f2.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" /><br>
                  Ayuda</a></div></td>
            </tr>
            <tr > 
              <td  width="61%" height="21" valign="middle">&nbsp;</td>
            </tr>
          </table></td>
      </tr>
    </table>
    <p><br>
    </p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <table width="469"  border="0"cellpadding="0" cellspacing="0"   >
      <tr> 
        <td width="461" height="201"  align="center"> <p>&nbsp;</p>
          <table width="82%" border="0" cellpadding="0" cellspacing="0"  >
            <tr align="center" valign="middle"> 
              <td height="25" colspan="7"  > 
                <?php
		
  		if ($rs->RecordCount() > 0)
  		{
  	?>
                <a href="#"> 
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
  </select> &nbsp;</td>
            </tr>
            <tr> 
              <td height="28" colspan="7">&nbsp; </td>
            </tr>
            <tr> 
              <td colspan="7">&nbsp;</td>
            </tr>
            <?php   	
  						}  	
  						?>
          </table>
          <table id="toolbar1">
            <thead>
              <tr align="center" valign="center"  > 
                <th >No</th>
                <th >Código DPA</th>
                <th > Provincia-Municipio</th>
                <th >&nbsp; </th>
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
              <tr> 
                <td height="22" align="center"> 
                  <?php $a=$pager_nav->index_rs++; echo $a; ?>
                </td>
                <td  align="center"><a href="m_dpa.php?var_aux_mod=<?php echo $rs->fields["cod_dpa"];?>"><?php echo $rs->fields["cod_dpa"];?></a></td>
                <td align="center"><?php echo $rs->fields["prov_mun"];?></td>
                <td align="center" valign="middle"> <input name="checkbox_<?php echo $rs->fields["cod_dpa"];?>" type="checkbox"  value="checkbox"> 
                </td>
              </tr>
              <?php 

     if($cadenacheckboxp == "")
				 {
		      	    $cadenacheckboxp = $rs->fields["cod_dpa"];
		       	 }
				 else
				 {
		            $cadenacheckboxp .= ",".$rs->fields["cod_dpa"];
		         }
				//print $cadenacheckboxp;


	  	$rs->MoveNext();
	  	}
  	}
  	
  		
  ?>
              <tr> 
                <td height="22"  colspan="4" align="center">&nbsp;</td>
              </tr>
            </tbody>
          </table>
          <p>&nbsp;</p></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <p> 
      <input type="hidden" name="var_checkbox" value="<?php echo $cadenacheckboxp;?>">
      <input type="hidden" name="var_aux_mod" value="">
      <input type="hidden" name="tabla" value="<?php echo "n_dpa";?>">
      <input type="hidden" name="campo" value="<?php echo "cod_dpa";?>">
      <input type="hidden" name="location" value="<?php echo "../administracion/nomencladores/l_dpa.php";?>">
    </p>
  </div>
</form>
</body>
</html>