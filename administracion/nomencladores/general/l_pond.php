<?php 
$x="../../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."adodb/adodb-navigator.php");
include($x."php/session/session_invitado.php");
$f=0;

if ($_GET["ver"]!="") $ver = $_GET['ver'];
if (isset($_POST["sel_#"])) $ver = $_POST['sel_#'];


$query = "select n_division.id_division, cod_division,division
,n_grupo.id_grupo,cod_grupo,grupo
,n_clase.id_clase,cod_clase,clase
,e_subclase.ide_subclase,cod_subclase,subclase
,e_articulo.ide_articulo,ecod_articulo,earticulo
,ecod_var,variedad,bien_serv,central,estacionalidad
from 

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
$ver=1000;
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
                          <td width="7%" valign="middle"  class="us"><img src="../../../imagenes/large/windows_list.gif" width="48" height="48" border="0"><strong><font color="#000000" size="1"> 
                            </font></strong></td>
                          <td width="69%" valign="middle"  class="us"><strong><font color="#5A697E" size="4">Ponderaciones en CUP, CUC y ambas Base Dic. 2010</font></strong></td>
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
                    <td height="37" colspan="20"  > <div align="right"><a href="#">&nbsp;&nbsp;
                        
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
                    <td  height="22" class="intro">&nbsp;</td>
                    <td   class="intro">&nbsp;</td>
                    <td colspan="3"   class="intro">&nbsp;</td>
                    <td colspan="3"   class="intro">&nbsp;</td>
                  </tr>
                  <tr align="center" valign="center"  >
                    <td  height="22" width="1%" class="intro">
                    <div align="left">N</div></td>
                    <td   class="intro">Agregados </td>
                    <td   class="intro"><div align="center">CUP</div></td>
                    <td   class="intro"><div align="center">CUC</div></td>
                    <td   class="intro"><div align="center">GENERAL</div></td>
                    <td   class="intro"><div align="center">CUP</div></td>
                    <td   class="intro"><div align="center">CUC</div></td>
                    <td   class="intro"><div align="center">GENERAL</div></td>
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
		
		$id_division=$rs->fields["id_division"];
		$id_grupo=$rs->fields["id_grupo"];
		$id_clase=$rs->fields["id_clase"];
		$ide_subclase=$rs->fields["ide_subclase"];
		$ide_articulo=$rs->fields["ide_articulo"];
		
		
		
   ?>
                  <?php if($cod_division_0!=$rs->fields["cod_division"]) {
				  //------------------DIVISION-----------------

					$sql_div_1 = "select r_peso from b_division 
					where id_division='$id_division' and id_mercado_nuevo='1'";
					$rs_div_1 = $db->Execute($sql_div_1) or die($db->ErrorMsg());
					$div_r_peso_1=number_format($rs_div_1->fields["r_peso"], 3, ',', ' ');
					
					$sql_div_2 = "select r_peso from b_division 
					where id_division='$id_division' and id_mercado_nuevo='2'";
					$rs_div_2 = $db->Execute($sql_div_2) or die($db->ErrorMsg());
					$div_r_peso_2=number_format($rs_div_2->fields["r_peso"], 3, ',', ' ');
					
					$sql_div_3 = "select r_peso from g_division 
					where id_division='$id_division'";
					$rs_div_3 = $db->Execute($sql_div_3) or die($db->ErrorMsg());
					$div_r_peso_3=number_format($rs_div_3->fields["r_peso"], 3, ',', ' ');
				  ?>
                  <tr <?php  $a=$pager_nav->index_rs++;if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";   ?> >
                    <td  class="raya">1</td>
                    <td  class="raya" height="29" > <a onMouseOver="return overlib('División', ABOVE, RIGHT);" onMouseOut="return nd();"> 
                      <?php $cod_division_0=$rs->fields["cod_division"]; echo $rs->fields["cod_division"].". ";echo $rs->fields["division"];?>
                      </a> </td>
                    <td  class="raya" ><div align="center"></div></td>
                    <td  class="raya" ><div align="center"></div></td>
                    <td  class="raya" ><div align="center"></div></td>
                    <td  class="raya" ><div align="center"><?php print $div_r_peso_1;?></div></td>
                    <td  class="raya" ><div align="center"><?php print $div_r_peso_2;?></div></td>
                    <td  class="raya" ><div align="center"><?php print $div_r_peso_3;?></div></td>
                  </tr>
                  <?php } if($cod_grupo_0!=$rs->fields["cod_grupo"]) {
				  //------------------GRUPO-----------------

				$sql_gru_1 = "select r_peso from b_grupo 
				where id_grupo='$id_grupo' and id_mercado_nuevo='1'";
				$rs_gru_1 = $db->Execute($sql_gru_1) or die($db->ErrorMsg());
				$gru_r_peso_1=number_format($rs_gru_1->fields["r_peso"], 3, ',', ' ');
				
				$sql_gru_2 = "select r_peso from b_grupo 
				where id_grupo='$id_grupo' and id_mercado_nuevo='2'";
				$rs_gru_2 = $db->Execute($sql_gru_2) or die($db->ErrorMsg());
				$gru_r_peso_2=number_format($rs_gru_2->fields["r_peso"], 3, ',', ' ');
				
				$sql_gru_3 = "select r_peso from g_grupo 
				where id_grupo='$id_grupo'";
				$rs_gru_3 = $db->Execute($sql_gru_3) or die($db->ErrorMsg());
				$gru_r_peso_3=number_format($rs_gru_3->fields["r_peso"], 3, ',', ' ');
				  ?>
                  <tr <?php  $a=$pager_nav->index_rs++;if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";   ?> >
                    <td  class="raya">2</td>
                    <td  class="raya" height="29" >&nbsp;&nbsp; <a onMouseOver="return overlib('Grupo', ABOVE, RIGHT);" onMouseOut="return nd();"> 
                      <?php $cod_grupo_0=$rs->fields["cod_grupo"]; echo $rs->fields["cod_grupo"].". ";echo $rs->fields["grupo"];?>
                      </a> </td>
                    <td  class="raya" ><div align="center"></div></td>
                    <td  class="raya" ><div align="center"></div></td>
                    <td  class="raya" ><div align="center"></div></td>
                    <td  class="raya" ><div align="center"><?php print $gru_r_peso_1;?></div></td>
                    <td  class="raya" ><div align="center"><?php print $gru_r_peso_2;?></div></td>
                    <td  class="raya" ><div align="center"><?php print $gru_r_peso_3;?></div></td>
                  </tr>
                  <?php } if($cod_clase_0!=$rs->fields["cod_clase"]) {
				  //------------------CLASE-----------------

				$sql_cla_1 = "select r_peso from b_clase 
				where id_clase='$id_clase' and id_mercado_nuevo='1'";
				$rs_cla_1 = $db->Execute($sql_cla_1) or die($db->ErrorMsg());
				$cla_r_peso_1=number_format($rs_cla_1->fields["r_peso"], 3, ',', ' ');
				
				$sql_cla_2 = "select r_peso from b_clase 
				where id_clase='$id_clase' and id_mercado_nuevo='2'";
				$rs_cla_2 = $db->Execute($sql_cla_2) or die($db->ErrorMsg());
				$cla_r_peso_2=number_format($rs_cla_2->fields["r_peso"], 3, ',', ' ');
				
				$sql_cla_3 = "select r_peso from g_clase 
				where id_clase='$id_clase'";
				$rs_cla_3 = $db->Execute($sql_cla_3) or die($db->ErrorMsg());
				$cla_r_peso_3=number_format($rs_cla_3->fields["r_peso"], 3, ',', ' ');
				  ?>
                  <tr <?php  $a=$pager_nav->index_rs++;if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";   ?> >
                    <td  class="raya">3</td>
                    <td  class="raya" height="29" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                      <a onMouseOver="return overlib('Clase', ABOVE, RIGHT);" onMouseOut="return nd();"> 
                      <?php $cod_clase_0=$rs->fields["cod_clase"]; echo $rs->fields["cod_clase"].". ";echo $rs->fields["clase"];?>
                      </a> </td>
                    <td  class="raya" ><div align="center"></div></td>
                    <td  class="raya" ><div align="center"></div></td>
                    <td  class="raya" ><div align="center"></div></td>
                    <td  class="raya" ><div align="center"><?php print $cla_r_peso_1;?></div></td>
                    <td  class="raya" ><div align="center"><?php print $cla_r_peso_2;?></div></td>
                    <td  class="raya" ><div align="center"><?php print $cla_r_peso_3;?></div></td>
                  </tr>
                  <?php } if($cod_subclase_0!=$rs->fields["cod_subclase"]) {
				  //------------------SUBCLASE-----------------
		
					$sql_sub_1 = "select r_peso from b_subclase 
					where ide_subclase='$ide_subclase' and id_mercado_nuevo='1'";
					$rs_sub_1 = $db->Execute($sql_sub_1) or die($db->ErrorMsg());
					$sub_r_peso_1=number_format($rs_sub_1->fields["r_peso"], 3, ',', ' ');
					
					$sql_sub_2 = "select r_peso from b_subclase 
					where ide_subclase='$ide_subclase' and id_mercado_nuevo='2'";
					$rs_sub_2 = $db->Execute($sql_sub_2) or die($db->ErrorMsg());
					$sub_r_peso_2=number_format($rs_sub_2->fields["r_peso"], 3, ',', ' ');
					
					$sql_sub_3 = "select r_peso from g_subclase 
					where ide_subclase='$ide_subclase'";
					$rs_sub_3 = $db->Execute($sql_sub_3) or die($db->ErrorMsg());
					$sub_r_peso_3=number_format($rs_sub_3->fields["r_peso"], 3, ',', ' ');
				  ?>
                  <tr <?php  $a=$pager_nav->index_rs++;if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";   ?> >
                    <td  class="raya">4</td>
                   <?php if($cod_subclase_01!=generico){?> <td  class="raya" height="29" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                      <a onMouseOver="return overlib('Subclase', ABOVE, RIGHT);" onMouseOut="return nd();"> 
                      <?php $cod_subclase_0=$rs->fields["cod_subclase"]; echo $rs->fields["cod_subclase"].". ";echo $rs->fields["subclase"];?>
                      </a> </td>
                   <td  class="raya" ><div align="center"></div></td>
                   <td  class="raya" ><div align="center"></div></td>
                   <td  class="raya" ><div align="center"></div></td>
                   <td  class="raya" ><div align="center"><?php print $sub_r_peso_1;?></div></td>
                   <td  class="raya" ><div align="center"><?php print $sub_r_peso_2;?></div></td>
                   <td  class="raya" ><div align="center"><?php print $sub_r_peso_3;?></div></td>
                   <?php }?>
                  </tr>
                  <?php } if($ecod_articulo_0!=$rs->fields["ecod_articulo"]) {
				    
					
					$sql_art_1 = "select r_peso,g_peso from b_articulo 
					where ide_articulo='$ide_articulo' and id_mercado_nuevo='1'";//print $sql_sel_art;die();//where fecha='$fecha_i_var_dpa'
					$rs_art_1 = $db->Execute($sql_art_1) or die($db->ErrorMsg());
					$art_r_peso_1=number_format($rs_art_1->fields["r_peso"], 3, ',', ' ');
					$art_g_peso_1=number_format($rs_art_1->fields["g_peso"], 3, ',', ' ');
					
					$sql_art_2 = "select r_peso,g_peso from b_articulo 
					where ide_articulo='$ide_articulo' and id_mercado_nuevo='2'";//print $sql_sel_art;die();//where fecha='$fecha_i_var_dpa'
					$rs_art_2 = $db->Execute($sql_art_2) or die($db->ErrorMsg());
					$art_r_peso_2=number_format($rs_art_2->fields["r_peso"], 3, ',', ' ');
					$art_g_peso_2=number_format($rs_art_2->fields["g_peso"], 3, ',', ' ');
					
					$sql_art_3 = "select r_peso,g_peso from g_articulo 
					where ide_articulo='$ide_articulo'";//print $sql_sel_art;die();//where fecha='$fecha_i_var_dpa'
					$rs_art_3 = $db->Execute($sql_art_3) or die($db->ErrorMsg());
					$art_r_peso_3=number_format($rs_art_3->fields["r_peso"], 3, ',', ' ');
					$art_g_peso_3=number_format($rs_art_3->fields["g_peso"], 3, ',', ' ');
				  ?>
                  <tr <?php  $a=$pager_nav->index_rs++;if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";   ?> >
                    <td  class="raya">5</td>
                    <td  class="raya" height="29" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a onMouseOver="return overlib('Artículo', ABOVE, RIGHT);" onMouseOut="return nd();">
                      <?php $ecod_articulo_0=$rs->fields["ecod_articulo"];echo $rs->fields["ecod_articulo"].". ";echo $rs->fields["earticulo"];?>
                    </a></td>
                    <td  class="raya" ><div align="center"><?php print $art_g_peso_1;?></div></td>
                    <td  class="raya" ><div align="center"><?php print $art_g_peso_2;?></div></td>
                    <td  class="raya" ><div align="center"><?php print $art_g_peso_3;?></div></td>
                    <td  class="raya" ><div align="center"><?php print $art_r_peso_1;?></div></td>
                    <td  class="raya" ><div align="center"><?php print $art_r_peso_2;?></div></td>
                    <td  class="raya" ><div align="center"><?php print $art_r_peso_3;?></div></td>
                  </tr>
                  <?php } 
				  /*$s="select * from n_variedad where ide_articulo='".$rs->fields["ide_articulo"]."'";//print $s;
				   $r=$db->Execute($s) or $mensaje=$db->ErrorMsg() ;
				  $r->MoveFirst();
	
					while (!$r->EOF)
					{
							*/  
				  ?>
                  <tr <?php  $a=$pager_nav->index_rs++;if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";   ?> >
                    <td  class="raya">6</td>
                    <td  class="raya" width="55%" height="29" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                      <a onMouseOver="return overlib('<?php echo "<b>Código Variedad: </b>".$r->fields["cod_var"];
					  if($rs->fields["cod_var"]) {echo "<br><b> UM: </b>".$rs->fields["unidad"];}
					  if($rs->fields["ecarac1"]) {echo "<br><b> ".$rs->fields["ecarac1"].": </b>".$r->fields["valor1"];}
					  if($rs->fields["ecarac2"]) {echo "<br><b> ".$rs->fields["ecarac2"].": </b>".$r->fields["valor2"];}
					  if($rs->fields["ecarac3"]) {echo "<br><b> ".$rs->fields["ecarac3"].": </b>".$r->fields["valor3"];}
					  if($rs->fields["ecarac4"]) {echo "<br><b> ".$rs->fields["ecarac4"].": </b>".$r->fields["valor4"];}
					  if($rs->fields["ecarac5"]) {echo "<br><b> ".$rs->fields["ecarac5"].": </b>".$r->fields["valor5"];}
					  if($rs->fields["ecarac6"]) {echo "<br><b> ".$rs->fields["ecarac6"].": </b>".$r->fields["valor6"];}
					  if($rs->fields["ecarac7"]) {echo "<br><b> ".$rs->fields["ecarac7"].": </b>".$r->fields["valor7"];}
					  if($rs->fields["ecarac8"]) {echo "<br><b> ".$rs->fields["ecarac8"].": </b>".$r->fields["valor8"];}
					  if($rs->fields["ecarac9"]) {echo "<br><b> ".$rs->fields["ecarac9"].": </b>".$r->fields["valor9"];}
					  if($rs->fields["ecarac10"]) {echo"<br><b> ".$rs->fields["ecarac10"].": </b>".$r->fields["valor10"];}?>', ABOVE, RIGHT);" onMouseOut="return nd();"> 
                      <?php echo $rs->fields["ecod_var"]." ";echo $rs->fields["variedad"];?>                      </a> </td>
                      
                    <td  class="raya" width="7%"align="left" ><div align="center"></div></td>
                    <td  class="raya" width="7%"align="left" ><div align="center"></div></td>
                    <td  class="raya" width="8%"align="left" ><div align="center"></div></td>
                    <td  class="raya" width="7%"align="left" ><div align="center"><a onMouseOver="return overlib('<?php if($rs->fields["estacionalidad"]==1)print "Variedad estacional";?>', ABOVE, RIGHT);" onMouseOut="return nd();">
                      <?php if($rs->fields["estacionalidad"]==1){?>
                      <img src="../../../imagenes/extrasmall/file_temporary.gif">
                      <?php }?>   
                    </a></div></td>
                    <td  class="raya" width="7%"align="left" ><div align="center"><a onMouseOver="return overlib('<?php if($rs->fields["central"]==1)print "Centralizado nacionalmente";elseif($rs->fields["central"]==2) print "Centralizado provincialmente";else print "No centralizado";?>', ABOVE, RIGHT);" onMouseOut="return nd();">
                      <?php if($rs->fields["central"]==1){?>
                      <img src="../../../imagenes/menu/hmenu-lock_nac.png">
                      <?php } elseif($rs->fields["central"]==2){?>
                      <img src="../../../imagenes/menu/hmenu-lock.png">
                      <?php }else{?>
                      <img src="../../../imagenes/menu/hmenu-unlock.png">
					  <?php }?>   
                    </a></div></td>
                    <td  class="raya" width="8%"align="left" ><div align="center"><a onMouseOver="return overlib('<?php if($rs->fields["bien_serv"]==1)print "Bien";else print "Servicio";?>', ABOVE, RIGHT);" onMouseOut="return nd();">
                      <?php if($rs->fields["bien_serv"]==1){?>
                      <img src="../../../imagenes/extrasmall/package.gif">
                      <?php } else{?>
                      <img src="../../../imagenes/extrasmall/edit_user.gif">
                      <?php }?>   
                    </a></div></td>
                  </tr>
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
