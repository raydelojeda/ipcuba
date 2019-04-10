<?php 
$x="../../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."adodb/adodb-navigator.php");
include($x."php/session/session_invitado.php");
$f=0;

if ($_GET["ver"]!="") $ver = $_GET['ver'];
if (isset($_POST["sel_#"])) $ver = $_POST['sel_#'];


$query = "select * from 

n_division,
n_grupo,
n_clase,
e_subclase,
e_articulo
,n_variedad
WHERE 
(n_division.id_division = n_grupo.id_division) 
AND  (n_grupo.id_grupo=n_clase.id_grupo) 
AND  (n_clase.id_clase=e_subclase.id_clase)  
AND  (e_subclase.ide_subclase=e_articulo.ide_subclase)  
and (e_articulo.ide_articulo = n_variedad.ide_articulo)
and  e_subclase.subclase!='generico'

ORDER BY cod_division,cod_grupo,cod_clase,cod_subclase,ecod_articulo,ecod_var";
//print $query;,n_variedad AND  (e_articulo.ide_articulo = n_variedad.ide_articulo),cod_var 








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
<!-- InstanceBeginEditable name="head" --> <!-- InstanceEndEditable --> 

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
                          <td width="7%" valign="middle"  class="us"><img src="../../../imagenes/admin/dbrestore.png" width="48" height="48" border="0"><strong><font color="#000000" size="1"> 
                            </font></strong></td>
                          <td width="69%" valign="middle"  class="us"><strong><font color="#5A697E" size="4">Nomenclador
                                 Canasta ENIGH</font></strong></td>
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
                    <td height="23" colspan="17"  > <div align="right"><a href="#">&nbsp;&nbsp;
                        
						<?php
  					
  							$pager_nav->Render_Navegator();		?>
                        </a> 
                        <?php
				  		echo "&nbsp;&nbsp;<b>Página: </b>".$pager_nav->curr_page." de ". $pager_nav->count_page."&nbsp;";
 		  			  		$var=$_POST['sel_#'];		
							?>
                        &nbsp;&nbsp;Ver # Variedades 
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
                    <td width="9%" class="intro"># </td>
                    <td width="1%" class="intro">&nbsp;</td>
                    <td  height="22" width="4%" class="intro">
                    <div align="left">Nivel</div></td>
                    <td width="74%"   class="intro">Agregados </td>
                    <td width="12%"   class="intro">&nbsp;</td>
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
                    <td  class="raya"><?php  $d=$d+1;echo $d; ?></td>
                    <td  class="raya">&nbsp;</td>
                    <td  class="raya">1</td>
                    <td  class="raya" height="29" > <a onMouseOver="return overlib('División', ABOVE, RIGHT);" onMouseOut="return nd();"> 
                      <?php $cod_division_0=$rs->fields["cod_division"]; echo $rs->fields["cod_division"].". ";echo $rs->fields["division"];?>
                      </a> </td>
                    <td  class="raya" ><?php print $rs->fields["id_division"];?></td>
                  </tr>
                  <?php } if($cod_grupo_0!=$rs->fields["cod_grupo"]) {?>
                  <tr <?php  $a=$pager_nav->index_rs++;if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";   ?> >
                    <td  class="raya">&nbsp;&nbsp;&nbsp;&nbsp;<?php  $g=$g+1;echo $g; ?></td>
                    <td  class="raya">&nbsp;</td>
                    <td  class="raya">2</td>
                    <td  class="raya" height="29" >&nbsp;&nbsp; <a onMouseOver="return overlib('Grupo', ABOVE, RIGHT);" onMouseOut="return nd();"> 
                      <?php $cod_grupo_0=$rs->fields["cod_grupo"]; echo $rs->fields["cod_grupo"].". ";echo $rs->fields["grupo"];?>
                      </a> </td>
                    <td  class="raya" ><?php print $rs->fields["id_grupo"];?></td>
                  </tr>
                  <?php } if($cod_clase_0!=$rs->fields["cod_clase"]) {?>
                  <tr <?php  $a=$pager_nav->index_rs++;if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";   ?> >
                    <td  class="raya">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php  $c=$c+1;echo $c; ?></td>
                    <td  class="raya">&nbsp;</td>
                    <td  class="raya">3</td>
                    <td  class="raya" height="29" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                      <a onMouseOver="return overlib('Clase', ABOVE, RIGHT);" onMouseOut="return nd();"> 
                      <?php $cod_clase_0=$rs->fields["cod_clase"]; echo $rs->fields["cod_clase"].". ";echo $rs->fields["clase"];?>
                      </a> </td>
                    <td  class="raya" ><?php print $rs->fields["id_clase"];?></td>
                  </tr>
                  <?php } if($cod_subclase_0!=$rs->fields["cod_subclase"]) {?>
                  <tr <?php  $a=$pager_nav->index_rs++;if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";   ?> >
                    <td  class="raya">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php  $s=$s+1;echo $s; ?></td>
                    <td  class="raya">&nbsp;</td>
                    <td  class="raya">4</td>
                   <?php if($cod_subclase_01!=generico){?> <td  class="raya" height="29" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                      <a onMouseOver="return overlib('Subclase', ABOVE, RIGHT);" onMouseOut="return nd();"> 
                      <?php $cod_subclase_0=$rs->fields["cod_subclase"]; echo $rs->fields["cod_subclase"].". ";echo $rs->fields["subclase"];?>
                      </a> </td>
                   <td  class="raya" ><?php print $rs->fields["ide_subclase"];?></td>
                   <?php }?>
                  </tr>
                  <?php } if($ecod_articulo_0!=$rs->fields["ecod_articulo"]) {?>
                  <tr <?php  $a=$pager_nav->index_rs++;if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";   ?> >
                    <td  class="raya">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php  $v=$v+1;echo $v; ?></td>
                    <td  class="raya">&nbsp;</td>
                    <td  class="raya">5</td>
                    <td  class="raya" height="29" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a onMouseOver="return overlib('Artículo', ABOVE, RIGHT);" onMouseOut="return nd();">
                      <?php $ecod_articulo_0=$rs->fields["ecod_articulo"];echo $rs->fields["ecod_articulo"].". ";echo $rs->fields["earticulo"];?>
                    </a></td>
                    <td  class="raya" ><?php print $rs->fields["ide_articulo"];?></td>
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
