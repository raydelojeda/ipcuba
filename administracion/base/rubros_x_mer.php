<?php 
$x="../../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."adodb/adodb-navigator.php");
include($x."php/session/session_super.php");
$f=0;

if ($_GET["ver"]!="") $ver = $_GET['ver'];
if (isset($_POST["sel_#"])) $ver = $_POST['sel_#'];
if ($_GET["sel_ano"]!="") $sel_ano = $_GET['sel_ano'];
if (isset($_POST["sel_ano"])) $sel_ano = $_POST['sel_ano'];
if ($_GET["sel_mes"]!="") $sel_mes = $_GET['sel_mes'];
if (isset($_POST["sel_mes"])) $sel_mes = $_POST['sel_mes'];
if ($_GET["sel_moneda"]!="") $sel_moneda = $_GET['sel_moneda'];
if (isset($_POST["sel_moneda"])) $sel_moneda = $_POST['sel_moneda'];


//---------------------------------------------------					 
$sql_fecha = "select max(fecha) from b_variedad";		
$rs_fecha = $db->Execute($sql_fecha)or $mensaje=$db->ErrorMsg() ;
$fecha_max = $rs_fecha->Fields('max');//print $x;
//---------------------------------------------------
if($sel_moneda)
{


//die();
$query = "select ecod_articulo, cod_division, division, cod_grupo, grupo, cod_clase, clase, cod_subclase, subclase, earticulo,
b_division.r_peso as d_peso, b_grupo.r_peso as b_peso, b_clase.r_peso as c_peso, b_subclase.r_peso as s_peso, b_articulo.r_peso as a_peso

from 
n_division,b_division,
n_grupo,b_grupo,
n_clase,b_clase,
e_subclase,b_subclase,
e_articulo,b_articulo
WHERE 
b_division.id_mercado_nuevo='$sel_moneda' and b_grupo.id_mercado_nuevo='$sel_moneda' and b_clase.id_mercado_nuevo='$sel_moneda' and b_subclase.id_mercado_nuevo='$sel_moneda' and b_articulo.id_mercado_nuevo='$sel_moneda' and 
n_division.id_division = n_grupo.id_division and n_division.id_division = b_division.id_division 
AND n_grupo.id_grupo=n_clase.id_grupo AND n_grupo.id_grupo=b_grupo.id_grupo 
AND n_clase.id_clase=e_subclase.id_clase AND n_clase.id_clase=b_clase.id_clase 
AND e_subclase.ide_subclase=e_articulo.ide_subclase AND e_subclase.ide_subclase=b_subclase.ide_subclase 
and e_articulo.ide_articulo = b_articulo.ide_articulo 
and e_subclase.subclase!='generico' and e_articulo.ide_articulo!='1'
ORDER BY cod_division,cod_grupo,cod_clase,cod_subclase,ecod_articulo";
//print $query;//,n_variedad AND  (e_articulo.ide_articulo = n_variedad.ide_articulo),cod_var 


if($ver=="")
$ver=50;
$pager_nav = new CData_PagerNav($db, $query, $ver,"frm",$order,$ordtype);
$rs = $pager_nav->curr_rs;
print $query;
}//del if

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
																elseif($_SESSION["rol"]=="super")print "Súper Administrador";
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
                    <td class="menudottedline" align="right"> <table width="100%" border="0" class="menubar"  id="toolbar">
                        <tr > 
                          <td width="7%" valign="middle"  class="us"><img src="../../../imagenes/large/windowlist.gif" width="48" height="48" border="0"></td>
                          <td width="69%" valign="middle"  class="us"><font color="#5A697E" size="2">&Iacute;ndices, variaciones, incidencias y ponderaciones Base Dic. 2010</font></td>
                          <td width="8%"> <div align="center"> <a  class="toolbar" href="exp_l_canastae.php"   target="_blank"> 
                              <img   src="../../../imagenes/xls_16.png" alt="Imprimir" width="32" height="32" border="0"> 
                              <br>
                          Exportar</a> </div></td>
                          <td width="8%"> 
                            <div align="center"> <a  class="toolbar" href="imp_canasta.php?no=<?php $b=$pager_nav->index_rs; echo $b; ?>" target="_blank" > 
                              <img   src="../../../imagenes/admin/print.png" alt="Imprimir" width="32" height="32" border="0"> 
                              <br>
                              Imprimir</a> </div></td>
                          <td width="8%"> 
                            <div align="center"><a class="toolbar" href="#" onClick="window.open('../../../help/l_canasta.htm', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                              <img src="../../../imagenes/admin/help_f2.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" /><br>
                              Ayuda</a></div></td>
                        </tr>
                        
                    </table></td>
                  </tr>
                </table>
                <br>
                <table width="99%" class="tabla" >
                  <tr align="center" valign="middle">
                    <td height="23" colspan="15"  ><table width="254" height="32" border="0" cellpadding="0" cellspacing="0" class="filtro" >
                      <tr>
                        <td width="65" height="20"><div align="right">Mercado:</div></td>
                        <td width="189"><select name="sel_moneda" title="Mercado" id="sel_moneda" onChange="document.frm.submit();" >
                          <option value="0">-----------------------</option>
                          <?php 
                     				$id=$_POST['sel_moneda'];
									
									$query_sel = "select distinct mercado_nuevo, n_mercado.id_mercado_nuevo from n_mercado";
									$rs_selected=$db->Execute($query_sel) or $mensaje=$db->ErrorMsg() ;
									$cant_rs=$rs_selected->RecordCount();
										for ($i = 0; $i < $cant_rs;$i++)
										{
											$rs_fields0=$rs_selected->Fields('mercado_nuevo');
											$rs_fields_id=$rs_selected->Fields('id_mercado_nuevo');										 
											echo"<option value=";echo $rs_fields_id;if($rs_fields_id==$id){echo " selected ";$aux=$rs_fields_id;} echo "> "; if($rs_fields1){echo $rs_fields1; print ". ";}echo $rs_fields0; echo "</option>";
											$rs_selected->MoveNext();
										}
								    ?>
                        </select></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr align="center" valign="middle"> 
                    <td height="23" colspan="15"  > <div align="right"><a href="#">&nbsp;&nbsp;
                        
						<?php
  					if($sel_moneda)
					{
  							$pager_nav->Render_Navegator();	}	?>
                        </a> 
                        <?php
				  		if($sel_mes && $sel_ano)
						{echo "&nbsp;&nbsp;<b>Página: </b>".$pager_nav->curr_page." de ". $pager_nav->count_page."&nbsp;";
 		  			  		$var=$_POST['sel_#'];		
							}?>
                        &nbsp;&nbsp;Ver # Art&iacute;culos 
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
                        </select>
                    &nbsp;</div></td>
                  </tr>
                  <tr align="center" valign="center"  >
                    <td width="11%" height="44" class="intro">
                      <div align="left">Nivel</div></td>
                    <td width="73%"   class="intro">Agregados </td>
                    <td width="16%"   class="intro">Peso</td>
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
                  <?php if($cod_division_0!=$rs->fields["cod_division"]) {?>
                  <tr <?php  $a=$pager_nav->index_rs++;if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";   ?> >
                    <td  class="raya"><div align="center">1</div></td>
                    <td  class="raya" height="29" > <a onMouseOver="return overlib('División', ABOVE, RIGHT);" onMouseOut="return nd();"> 
                      <?php $cod_division_0=$rs->fields["cod_division"]; echo $rs->fields["cod_division"].". ";echo $rs->fields["division"];?>
                      </a> </td>
                    <td  class="raya" ><div align="center"><?php print $d_peso; ?></div></td>
                  </tr>
                  <?php } if($cod_grupo_0!=$rs->fields["cod_grupo"]) {?>
                  <tr <?php  $a=$pager_nav->index_rs++;if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";   ?> >
                    <td  class="raya"><div align="center">2</div></td>
                    <td  class="raya" height="29" >&nbsp;&nbsp; <a onMouseOver="return overlib('Grupo', ABOVE, RIGHT);" onMouseOut="return nd();"> 
                      <?php $cod_grupo_0=$rs->fields["cod_grupo"]; echo $rs->fields["cod_grupo"].". ";echo $rs->fields["grupo"];?>
                      </a> </td>
                    <td  class="raya" ><div align="center"><?php print $b_peso; ?></div></td>
                  </tr>
                  <?php } if($cod_clase_0!=$rs->fields["cod_clase"]) {?>
                  <tr <?php  $a=$pager_nav->index_rs++;if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";   ?> >
                    <td  class="raya"><div align="center">3</div></td>
                    <td  class="raya" height="29" >&nbsp;&nbsp;&nbsp;&nbsp;
                      <a onMouseOver="return overlib('Clase', ABOVE, RIGHT);" onMouseOut="return nd();"> 
                      <?php $cod_clase_0=$rs->fields["cod_clase"]; echo $rs->fields["cod_clase"].". ";echo $rs->fields["clase"];?>
                      </a> </td>
                    <td  class="raya" ><div align="center"><?php print $c_peso; ?></div></td>
                  </tr>
                  <?php } if($cod_subclase_0!=$rs->fields["cod_subclase"]) {?>
                  <tr <?php  $a=$pager_nav->index_rs++;if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";   ?> >
                    <td  class="raya"><div align="center">4</div></td>
                   <?php if($cod_subclase_01!=generico){?> <td  class="raya" height="29" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <a onMouseOver="return overlib('Subclase', ABOVE, RIGHT);" onMouseOut="return nd();"> 
                      <?php $cod_subclase_0=$rs->fields["cod_subclase"]; echo $rs->fields["cod_subclase"].". ";echo $rs->fields["subclase"];?>
                      </a> </td>
                   <td  class="raya" ><div align="center"><?php print $s_peso; ?></div></td>
                   <?php }?>
                  </tr>
                  <?php } if($ecod_articulo_0!=$rs->fields["ecod_articulo"]) {?>
                  <tr <?php  $a=$pager_nav->index_rs++;if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";   ?> >
                    <td  class="raya"><div align="center">5</div></td>
                    <td  class="raya" height="29" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a onMouseOver="return overlib('Artículo', ABOVE, RIGHT);" onMouseOut="return nd();">
                      <?php $ecod_articulo_0=$rs->fields["ecod_articulo"];echo $rs->fields["ecod_articulo"].". ";echo $rs->fields["earticulo"];?>
                    </a></td>
                    <td  class="raya" ><div align="center"><?php print $a_peso; ?></div></td>
                  </tr>
                  <?php } 
				  /*$s="select * from n_variedad where ide_articulo='".$rs->fields["ide_articulo"]."'";//print $s;
				   $r=$db->Execute($s) or $mensaje=$db->ErrorMsg() ;
				  $r->MoveFirst();
	
					while (!$r->EOF)
					{
							*/  
				  ?>
                  
                  <?php 
				//  $r->MoveNext();
			//}
   	  	$rs->MoveNext();
	  	}
  	}
 } ?>
                </table>
              
                <p>&nbsp;</p>
              </div>
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
