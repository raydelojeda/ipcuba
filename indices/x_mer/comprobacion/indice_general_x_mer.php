<?php 
$x="../../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."adodb/adodb-navigator.php");
include($x."php/session/session_admin.php");
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
$fecha_base = $rs_fecha->Fields('max');//print $x;
//---------------------------------------------------
if($sel_mes && $sel_ano && $sel_moneda)
{
//--------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DE IGUAL MES DEL A�O ANTERIOR--------------------------
$fecha_cierre_sem4_6=substr($fecha_base,0,8)."04";


$mes6=$sel_mes;
$ano6=$sel_ano-1;

if($mes6=="12")
{$mes_next6="02";$ano_next6=$ano6+1;$mes6="01";$ano6=$ano6+1;}
elseif($mes6=="11")
{$mes_next6="01";$ano_next6=$ano6+1;$mes6=$mes6+1;}
else {$mes_next6=$mes6+2;$ano_next6=$ano6;$mes6=$mes6+1;}

if(strlen($mes_ant6)==1)
$mes_ant6=0 .$mes_ant6;

$fecha_01_fin6=$ano_next6."/".$mes_next6."/"."01";//esta fecha es para quedarme dentro del mes actual
$fecha_01_ini6=$ano6."/".$mes6."/"."01";//esta fecha es para quedarme dentro del mes actual

$sql_cal = "select * from calendario where fecha_captar='".$fecha_cierre_sem4_6."' 
and fecha_cal>='$fecha_01_ini6' and fecha_cal<'$fecha_01_fin6' order by fecha_captar";		
$rs_cal = $db->Execute($sql_cal) or die($db->ErrorMsg());//print $sql_cal;die();
$fecha_cal_inicio_sem1_inter=$rs_cal->fields["fecha_cal"];
//--------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DE IGUAL MES DEL A�O ANTERIOR--------------------------

//-----------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DEL MES DE DICIEMBRE DEL A�O ANTERIOR-----------------------
$fecha_cierre_sem4_5=substr($fecha_base,0,8)."04";

$mes5=01;
$ano5=$sel_ano;

if($mes5=="12")
{$mes_next5="01";$ano_next5=$ano5+1;}
else {$mes_next5=$mes5+1;$ano_next5=$ano5;}

if(strlen($mes_ant5)==1)
$mes_ant5=0 .$mes_ant5;

$fecha_01_fin5=$ano_next5."/".$mes_next5."/"."01";//esta fecha es para quedarme dentro del mes actual
$fecha_01_ini5=$ano5."/".$mes5."/"."01";//esta fecha es para quedarme dentro del mes actual

$sql_cal = "select * from calendario where fecha_captar='".$fecha_cierre_sem4_5."' 
and fecha_cal>='$fecha_01_ini5' and fecha_cal<'$fecha_01_fin5' order by fecha_captar";		
$rs_cal = $db->Execute($sql_cal) or die($db->ErrorMsg());//print $sql_cal;die();
$fecha_cal_inicio_sem1_dic_ant=$rs_cal->fields["fecha_cal"];
//-----------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DEL MES DE DICIEMBRE DEL A�O ANTERIOR-----------------------

//--------------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DEL MES ACTUAL--------------------------------
$fecha_cierre_sem4_3=substr($fecha_base,0,8)."04";

$mes3=$sel_mes;
$ano3=$sel_ano;

if($mes3=="12")
{$mes_next3="01";$ano_next3=$ano3+1;}
else {$mes_next3=$mes3+1;$ano_next3=$ano3;}

if(strlen($mes_ant3)==1)
$mes_ant3=0 .$mes_ant3;

$fecha_01_fin3=$ano_next3."/".$mes_next3."/"."01";//esta fecha es para quedarme dentro del mes actual
$fecha_01_ini3=$ano3."/".$mes3."/"."01";//esta fecha es para quedarme dentro del mes actual

$sql_cal = "select * from calendario where fecha_captar='".$fecha_cierre_sem4_3."' 
and fecha_cal>='$fecha_01_ini3' and fecha_cal<'$fecha_01_fin3' order by fecha_captar";		
$rs_cal = $db->Execute($sql_cal) or die($db->ErrorMsg());//print $sql_cal;die();
$fecha_cal_inicio_sem1_actual=$rs_cal->fields["fecha_cal"];
//--------------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DEL MES ACTUAL--------------------------------

//--------------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DEL MES NEXT--------------------------------
$fecha_cierre_sem4_4=substr($fecha_base,0,8)."04";


$mes4=$sel_mes;
$ano4=$sel_ano;

if($mes4=="12")
{$mes_next4="02";$ano_next4=$ano4+1;$mes4="01";$ano4=$ano4+1;}
elseif($mes4=="11")
{$mes_next4="01";$ano_next4=$ano4+1;$mes4=$mes4+1;}
else {$mes_next4=$mes4+2;$ano_next4=$ano4;$mes4=$mes4+1;}

if(strlen($mes_ant4)==1)
$mes_ant4=0 .$mes_ant4;

$fecha_01_fin4=$ano_next4."/".$mes_next4."/"."01";//esta fecha es para quedarme dentro del mes actual
$fecha_01_ini4=$ano4."/".$mes4."/"."01";//esta fecha es para quedarme dentro del mes actual

$sql_cal = "select * from calendario where fecha_captar='".$fecha_cierre_sem4_4."' 
and fecha_cal>='$fecha_01_ini4' and fecha_cal<'$fecha_01_fin4' order by fecha_captar";		
$rs_cal = $db->Execute($sql_cal) or die($db->ErrorMsg());//print $sql_cal;die();
$fecha_cal_inicio_sem1_next=$rs_cal->fields["fecha_cal"];
//--------------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DEL MES NEXT--------------------------------
//print $fecha_cal_inicio_sem1_inter."<br>".$fecha_cal_inicio_sem1_dic_ant."<br>".$fecha_cal_inicio_sem1_actual."<br>".$fecha_cal_inicio_sem1_next;die();

/*$fecha_cal_inicio_sem1_inter    fecha interanual que corresponde al mes t+1
$fecha_cal_inicio_sem1_dic_ant    fecha diciembre del a�o anterior que corresponde al mes t+1
$fecha_cal_inicio_sem1_actual     fecha del mes antepasado seg�n el escogido que corresponde al mes t+1
$fecha_cal_inicio_sem1_next	      fecha del mes pasado seg�n el escogido que corresponde al mes t+1*/

/*$fecha_cal_inicio_sem1_inter='2011-02-02';


$fecha_cal_inicio_sem1_next='2011-02-02';
if($fecha_cal_inicio_sem1_next=='2011-02-02')
$fecha_cal_inicio_sem1_actual='2011-02-02';*/


$sql_f1 = "select indice 
from d_general
WHERE d_general.fecha='$fecha_cal_inicio_sem1_next' and d_general.id_mercado_nuevo='$sel_moneda'";//print $sql;
$rs_gen_f1 = $db->Execute($sql_f1)or die($db->ErrorMsg());
if($rs_gen_f1->fields["indice"])
$f_act=1;





//die();
$query = "select ecod_articulo, cod_division, division, cod_grupo, grupo, cod_clase, clase, cod_subclase, subclase, earticulo

,d_articulo.indice as ind_art
,d_subclase.indice as ind_sub
,d_clase.indice as ind_cla
,d_grupo.indice as ind_gru
,d_division.indice as ind_div
,b_articulo.g_peso as a_peso

from 
n_division,b_division,d_division 

,n_grupo,b_grupo,d_grupo
,n_clase,b_clase,d_clase
,e_subclase,b_subclase,d_subclase
,e_articulo,b_articulo,d_articulo


WHERE 
b_division.id_mercado_nuevo='$sel_moneda' and b_grupo.id_mercado_nuevo='$sel_moneda' and b_clase.id_mercado_nuevo='$sel_moneda' and b_subclase.id_mercado_nuevo='$sel_moneda' and b_articulo.id_mercado_nuevo='$sel_moneda' and 

n_division.id_division = n_grupo.id_division and n_division.id_division = b_division.id_division and d_division.idb_division=b_division.idb_division 

AND n_grupo.id_grupo=n_clase.id_grupo AND n_grupo.id_grupo=b_grupo.id_grupo AND d_grupo.idb_grupo=b_grupo.idb_grupo 

AND n_clase.id_clase=e_subclase.id_clase AND n_clase.id_clase=b_clase.id_clase AND d_clase.idb_clase=b_clase.idb_clase 

AND e_subclase.ide_subclase=e_articulo.ide_subclase AND e_subclase.ide_subclase=b_subclase.ide_subclase AND d_subclase.idb_subclase=b_subclase.idb_subclase 

and e_articulo.ide_articulo = b_articulo.ide_articulo and d_articulo.idb_articulo=b_articulo.idb_articulo  

and e_subclase.subclase!='generico' and e_articulo.ide_articulo!='1'

and d_articulo.fecha='$fecha_cal_inicio_sem1_next' and d_subclase.fecha='$fecha_cal_inicio_sem1_next' and d_clase.fecha='$fecha_cal_inicio_sem1_next' and d_grupo.fecha='$fecha_cal_inicio_sem1_next' and d_division.fecha='$fecha_cal_inicio_sem1_next'

ORDER BY cod_division,cod_grupo,cod_clase,cod_subclase,ecod_articulo";
////,n_variedad AND  (e_articulo.ide_articulo = n_variedad.ide_articulo),cod_var 

//print $query;//die();
if($ver=="")
$ver=50;
$pager_nav = new CData_PagerNav($db, $query, $ver,"frm",$order,$ordtype);
$rs = $pager_nav->curr_rs;


$sql = "select d_general.indice as ind_gen";

$sql=$sql." from d_general";

$sql=$sql." WHERE d_general.fecha='$fecha_cal_inicio_sem1_next'";

$sql=$sql." and d_general.id_mercado_nuevo='$sel_moneda'";

//print $sql;
$rs_gen = $db->Execute($sql)or die($db->ErrorMsg());

$ind_gen=number_format($rs_gen->fields["ind_gen"]*100, 30, ',', '');


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
																elseif($_SESSION["rol"]=="super")print "S�per Administrador";
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
                          <td width="7%" valign="middle"  class="us"><img src="../../../imagenes/large/windowlist.gif" width="48" height="48" border="0"></td>
                          <td width="69%" valign="middle"  class="us"><font color="#5A697E" size="2">&Iacute;ndices por moneda para la comprobaci&oacute;n, Base Dic. 2010</font></td>
                          <td width="8%"> <div align="center"> <a  class="toolbar" href="exp_l_canastae.php"   target="_blank"> 
                              <img   src="../../../imagenes/xls_16.png" alt="Imprimir" width="32" height="32" border="0"> 
                              <br>
                          Exportar </div></td>
                          <td width="8%"> 
                            <div align="center"> <a  class="toolbar" href="imp_canasta.php?no=<?php $b=$pager_nav->index_rs; echo $b; ?>" target="_blank" > 
                              <img   src="../../../imagenes/admin/print.png" alt="Imprimir" width="32" height="32" border="0"> 
                              <br>
                          Imprimir </div></td>
                          <td width="8%"> 
                            <div align="center"><a class="toolbar" href="#" onClick="window.open('../../../help/l_canasta.htm', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                              <img src="../../../imagenes/admin/help_f2.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" /><br>
                          Ayuda</div></td>
                        </tr>
                        
                    </table></td>
                  </tr>
                </table>
                <br>
                <table width="99%" class="tabla" >
                  <tr align="center" valign="middle">
                    <td height="55" colspan="16"  ><table width="635" height="50" border="0" cellpadding="0" cellspacing="0" class="filtro" >
                      <tr>
                      <td width="108" height="50"><div align="right">Moneda:</div></td>
                        <td width="150"><select name="sel_moneda" title="Mercado" id="sel_moneda" onChange="document.frm.submit();" >
                          <option value="0">-------</option>
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
                        <td width="46"><div align="right">Mes:</div></td>
                        <td width="184"><select name="sel_mes" id="sel_mes" onChange="javascript:document.frm.submit();">
                          <option value="0">---------------</option>
                          <option <?php if($sel_mes=="01")print "selected";?> value="01">Enero</option>
                          <option <?php if($sel_mes=="02")print "selected";?> value="02">Febrero</option>
                          <option <?php if($sel_mes=="03")print "selected";?> value="03">Marzo</option>
                          <option <?php if($sel_mes=="04")print "selected";?> value="04">Abril</option>
                          <option <?php if($sel_mes=="05")print "selected";?> value="05">Mayo</option>
                          <option <?php if($sel_mes=="06")print "selected";?> value="06">Junio</option>
                          <option <?php if($sel_mes=="07")print "selected";?> value="07">Julio</option>
                          <option <?php if($sel_mes=="08")print "selected";?> value="08">Agosto</option>
                          <option <?php if($sel_mes=="09")print "selected";?> value="09">Septiembre</option>
                          <option <?php if($sel_mes=="10")print "selected";?> value="10">Octubre</option>
                          <option <?php if($sel_mes=="11")print "selected";?> value="11">Noviembre</option>
                          <option <?php if($sel_mes=="12")print "selected";?> value="12">Diciembre</option>
                        </select></td>
                        <td width="47"  align="center"><div align="right">A&ntilde;o:</div></td>
                        <td width="100"  align="center"><div align="left">
                            <select name="sel_ano" id="sel_ano" onChange="javascript:document.frm.submit();">
                              <option value="0">------</option>
                              <?php 
						  $anno=date("Y");
						  for($i=4;$i>=0;$i--){
							  if($anno-$i>=2011)
							  {
							  
							  ?>
                              <option <?php if($sel_ano==$anno-$i)print "selected";?>><?php print $anno-$i;?></option>
                              <?php }}?>
                            </select>
                        </div></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr align="center" valign="middle"> 
                    <td height="23" colspan="16"  > <div align="right"><a href="#">&nbsp;&nbsp;
                        
						<?php
  					if($sel_mes && $sel_ano && $sel_moneda)
					{
  							$pager_nav->Render_Navegator();	}	?>
                         
                        <?php
				  		if($sel_mes && $sel_ano)
						{echo "&nbsp;&nbsp;<b>P�gina: </b>".$pager_nav->curr_page." de ". $pager_nav->count_page."&nbsp;";
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
                    <td width="2%" height="44" class="intro">
                      N</td>
                    <td width="46%"   class="intro">Agregados </td>
                    <td width="50%"   class="intro"><div align="right">&Iacute;ndice</div></td>
                    <td width="2%"   class="intro">&nbsp;</td>
                  </tr>
                  <tr align="center" valign="center"  >
                    <td class="intro">&nbsp;</td>
                    <td   class="intro"><div align="left">&Iacute;NDICE GENERAL</div></td>
                    <td   class="intro"><div align="right"><?php print $ind_gen; ?></div>                    </td>
                    <td  class="intro" >&nbsp;</td>
                  </tr>
                  <?php
if($rs->fields[0]!='')
{	
$nivel=0;
  $cadenacheckboxp = "";
  	if ($rs->RecordCount() > 0)
  	{

	 	$rs->MoveFirst();
	
	  	while (!$rs->EOF)
	  	{
		


//print $rs->fields["ind_div"]."   ".$rs->fields["ind_div_ant"];

$ind_div=number_format(($rs->fields["ind_div"])*100, 30, ',', '');
$ind_gru=number_format(($rs->fields["ind_gru"])*100, 30, ',', '');
$ind_cla=number_format(($rs->fields["ind_cla"])*100, 30, ',', '');
$ind_sub=number_format(($rs->fields["ind_sub"])*100, 30, ',', '');
$ind_art=number_format(($rs->fields["ind_art"])*100, 30, ',', '');




		
$nivel=$nivel+1;
   ?>
                  <?php if($cod_division_0!=$rs->fields["cod_division"]) {?>
                                    
                  <tr  id="tt<?php print $nivel;?>"<?php  $a=$pager_nav->index_rs++;if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";   ?> >
                    <td  class="raya"><div align="center">1</div></td>
                    <td  class="raya" height="29" >  
                      <?php $cod_division_0=$rs->fields["cod_division"]; echo $rs->fields["cod_division"].". ";echo $rs->fields["division"];?>                      </td>
                    <td  class="raya" ><div align="right"><?php print $ind_div; ?></div></td>
                    <td  class="raya" >&nbsp;</td>
                  </tr>
                  
                  <?php } if($cod_grupo_0!=$rs->fields["cod_grupo"]) {?>
                  <a  name="2">                  
                  <tr id="nivel_2<?php print $nivel;?>"<?php  $a=$pager_nav->index_rs++;if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";   ?> >
                    <td  class="raya"><div align="center">2</div></td>
                    <td  class="raya" height="29" >&nbsp;&nbsp;  
                      <?php $cod_grupo_0=$rs->fields["cod_grupo"]; echo $rs->fields["cod_grupo"].". ";echo $rs->fields["grupo"];?>                      </td>
                    <td  class="raya" ><div align="right"><?php print $ind_gru; ?></div></td>
                    <td  class="raya" >&nbsp;</td>
                  </tr>
                  <a  name="2">
                  <?php } if($cod_clase_0!=$rs->fields["cod_clase"]) {?>
                  <a name="3">                  
                  <tr id="nivel_3<?php print $nivel;?>"<?php  $a=$pager_nav->index_rs++;if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";   ?> >
                    <td  class="raya"><div align="center">3</div></td>
                    <td  class="raya" height="29" >&nbsp;&nbsp;&nbsp;&nbsp;
                       
                      <?php $cod_clase_0=$rs->fields["cod_clase"]; echo $rs->fields["cod_clase"].". ";echo $rs->fields["clase"];?>                      </td>
                    <td  class="raya" ><div align="right"><?php print $ind_cla; ?></div></td>
                    <td  class="raya" >&nbsp;</td>
                  </tr>
                  <a name="3">
                  <?php } if($cod_subclase_0!=$rs->fields["cod_subclase"]) {?>
                  <a name="4">                  
                  <tr id="nivel_4<?php print $nivel;?>"<?php  $a=$pager_nav->index_rs++;if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";   ?> >
                    <td  class="raya"><div align="center">4</div></td>
                   <?php if($cod_subclase_01!=generico){?> <td  class="raya" height="29" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                       
                      <?php $cod_subclase_0=$rs->fields["cod_subclase"]; echo $rs->fields["cod_subclase"].". ";echo $rs->fields["subclase"];?>
                      </td>
                   <td  class="raya" ><div align="right"><?php print $ind_sub; ?></div></td>
                   <td  class="raya" >&nbsp;</td>
                   <?php }?>
                  </tr>
                  <a name="4">
                  <?php } if($ecod_articulo_0!=$rs->fields["ecod_articulo"]) {?>
                  <a name="5">                  
                  <tr id="nivel_5<?php print $nivel;?>"<?php  $a=$pager_nav->index_rs++;if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";   ?> >
                    <td  class="raya"><div align="center">5</div></td>
                    <td  class="raya" height="29" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <?php $ecod_articulo_0=$rs->fields["ecod_articulo"];echo $rs->fields["ecod_articulo"].". ";echo $rs->fields["earticulo"];?>                    </td>
                    <td  class="raya" ><div align="right"><?php print $ind_art; ?></div></td>
                    <td  class="raya" ><div align="right"></div></td>
                  </tr>
                  <a name="5">
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
    <td width="30" height="21"  align="center" valign="middle"> <div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><img src="../../../imagenes/down.jpg" width="30" height="26"></font></div></td>
    <td width="695"  align="center" valign="middle" bgcolor="#4B4B4B">
      <div align="center"><font color="#FFFFFF" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>ONEI - 
    IPC 2009-2012</strong></font></div></td>
    <td width="30"  align="center" valign="middle"><div align="center"><img src="../../../imagenes/up.jpg" width="30" height="26"></div></td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
