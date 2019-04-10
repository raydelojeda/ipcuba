<?php 
$x="../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."adodb/adodb-navigator.php");
include($x."php/session/session_invitado.php");
$f=0;

if ($_GET["ver"]!="") $ver = $_GET['ver'];
if (isset($_POST["sel_#"])) $ver = $_POST['sel_#'];


//---------------------------------------------------					 
$sql_fecha = "select max(fecha) from b_variedad";		
$rs_fecha = $db->Execute($sql_fecha)or $mensaje=$db->ErrorMsg() ;
$fecha_base = $rs_fecha->Fields('max');//print $x;
//---------------------------------------------------


if($_POST["sel_mes"]!=0 and $_POST["sel_ano"]!=0)
{

    $sem=$_POST["sel_sem"];
	$ano_mes=substr($fecha_base,0,7);	
	if($sem=="01")
	{$dia_base_ini="04";$dia_base_fin="07";$miercoles_dia_cierre="11";}
	if($sem=="02")
	{$dia_base_ini="08";$dia_base_fin="14";$miercoles_dia_cierre="18";}
	if($sem=="03")
	{$dia_base_ini="15";$dia_base_fin="21";$miercoles_dia_cierre="25";}
	if($sem=="04")
	{$dia_base_ini="22";$dia_base_fin="27";$miercoles_dia_cierre="04";}
	if($sem=="0")
	{$dia_base_ini="04";$dia_base_fin="27";$miercoles_dia_cierre="04";}
	
						
	$fecha_base_fin=$ano_mes."-".$dia_base_fin;
	$fecha_base_ini=$ano_mes."-".$dia_base_ini;
	//$miercoles_cierre=$ano_mes."-".$miercoles_dia_cierre;
//print $fecha_base_ini."  ".$fecha_base_fin;

//------------------INICIO DE SEMANA---------------------------------	
$mes=$_POST["sel_mes"];	
$ano=$_POST["sel_ano"];

if($mes=="12")
{$mes_next="01";$ano_next=$ano+1;}
else
{$mes_next=$mes+1;$ano_next=$ano;}

$fecha_01_ini=$ano."/".$mes."/"."01";//esta fecha es para quedarme dentro del mes actual
$fecha_01_next=$ano_next."/".$mes_next."/"."01";//esta fecha es para quedarme dentro del mes actual
			 
$sql_cal = "select * from calendario where fecha_captar='".$fecha_base_ini."' and fecha_cal>='$fecha_01_ini' and fecha_cal<'$fecha_01_next' order by fecha_captar";		
$rs_cal = $db->Execute($sql_cal)or $mensaje=$db->ErrorMsg();//print $sql_cal;
//------------------INICIO DE SEMANA---------------------------------	





//--------------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 O DEL MES--------------------------------
$fecha_cierre_sem4=substr($fecha_base,0,8)."04";

$mes=$_POST["sel_mes"];	
$ano=$_POST["sel_ano"];
if($mes=="12")
{$mes_next="01";$ano_next=$ano+1;}
else
{$mes_next=$mes+1;$ano_next=$ano;}

if(strlen($mes_next)==1)
$mes_next=0 .$mes_next;

$fecha_01_ini=$ano."/".$mes."/"."01";//esta fecha es para quedarme dentro del mes actual
$fecha_01_next=$ano_next."/".$mes_next."/"."01";//esta fecha es para quedarme dentro del mes actual

$sql_cal = "select * from calendario where fecha_captar='".$fecha_cierre_sem4."' 
and fecha_cal>='$fecha_01_ini' and fecha_cal<'$fecha_01_next' order by fecha_captar";		
$rs_cal = $db->Execute($sql_cal)or $mensaje=$db->ErrorMsg();//print $sql_cal;
$fecha_cal_inicio_sem1=$rs_cal->fields["fecha_cal"];//print $fecha_cal_inicio_sem1;
//--------------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 O DEL MES--------------------------------


//--------------------------------PARA OBETENER LA FECHA DEL CIERRE DE SEMANA 4 O DEL MES--------------------------------
$fecha_cierre_sem4=substr($fecha_base,0,8)."04";	

$mes=$_POST["sel_mes"];	
$ano=$_POST["sel_ano"];

if($mes=="11")
{$mes_next1=$mes+1;$mes_next2="01";$ano_next=$ano+1;}
elseif($mes=="12")
{$mes_next1="01";$mes_next2="02";$ano_next=$ano+1;$ano=$ano+1;}
else
{$mes_next2=$mes+2;$ano_next=$ano;$mes_next1=$mes+1;}

//print $fecha_cal_inicio_sem1."   ".$fecha_act;
if($fecha_cal_inicio_sem1_aux>$fecha_act)
{
if($mes=="12")
{$mes_next1="12";$mes_next2="01";$ano_next=$ano+1;}
else
{$mes_next2=$mes+1;$ano_next=$ano;$mes_next1=$mes;}
}



if(strlen($mes_next1)==1)
$mes_next1=0 .$mes_next1;

if(strlen($mes_next2)==1)
$mes_next2=0 .$mes_next2;

$fecha_01_ini=$ano."-".$mes_next1."-"."01";//esta fecha es para quedarme dentro del mes actual
$fecha_01_next=$ano_next."-".$mes_next2."-"."01";//esta fecha es para quedarme dentro del mes actual
//print $fecha_01_ini."  ".$fecha_01_next."<br>";	
$sql_cal = "select * from calendario where fecha_captar='".$fecha_cierre_sem4."' and fecha_cal>='$fecha_01_ini' and fecha_cal<'$fecha_01_next' order by fecha_captar";		
$rs_cal = $db->Execute($sql_cal)or $mensaje=$db->ErrorMsg();//print $sql_cal;
$fecha_cal_cierre_sem4=$rs_cal->fields["fecha_cal"];//print $fecha_cal_cierre_sem4;
//--------------------------------PARA OBETENER LA FECHA DEL CIERRE DE SEMANA 4 O DEL MES--------------------------------


//--------------------------------------------------------------------------------------------------------------

  $sem=$_POST["sel_sem"];
	$ano_mes=substr($fecha_base,0,7);	
	if($sem=="01")
	{$dia_base_ini="04";$dia_base_fin="07";$miercoles_dia_cierre="11";}
	if($sem=="02")
	{$dia_base_ini="08";$dia_base_fin="14";$miercoles_dia_cierre="18";}
	if($sem=="03")
	{$dia_base_ini="15";$dia_base_fin="21";$miercoles_dia_cierre="25";}
	if($sem=="04")
	{$dia_base_ini="22";$dia_base_fin="27";$miercoles_dia_cierre="04";}
	if($sem=="0")
	{$dia_base_ini="04";$dia_base_fin="27";$miercoles_dia_cierre="04";}
	
						
	$fecha_base_fin=$ano_mes."-".$dia_base_fin;
	$fecha_base_ini=$ano_mes."-".$dia_base_ini;
	//$miercoles_cierre=$ano_mes."-".$miercoles_dia_cierre;
//print $fecha_base_ini."  ".$fecha_base_fin;

//---------------------------------------------------	
$mes=$_POST["sel_mes"];	
$ano=$_POST["sel_ano"];

if($mes=="12")
{$mes_next="01";$ano_next=$ano+1;}
else
{$mes_next=$mes+1;$ano_next=$ano;}

$fecha_01_ini=$ano."/".$mes."/"."01";//esta fecha es para quedarme dentro del mes actual
$fecha_01_next=$ano_next."/".$mes_next."/"."01";//esta fecha es para quedarme dentro del mes actual
			 
$sql_cal = "select * from calendario where fecha_captar='".$fecha_base_ini."' and fecha_cal>='$fecha_01_ini' and fecha_cal<'$fecha_01_next' order by fecha_captar";		
$rs_cal = $db->Execute($sql_cal)or $mensaje=$db->ErrorMsg();//print $sql_cal;
$rs_cal->MoveFirst();
$fecha_cal_ini=$rs_cal->fields["fecha_cal"];
//---------------------------------------------------

///-----------------------------------------------------
$rs_cal->MoveFirst();
$dia_captar=substr($rs_cal->fields["fecha_captar"],8,9);
$dia_cal=substr($rs_cal->fields["fecha_cal"],8,9);

if(($dia_captar-$dia_cal)>0)
{$dif=$dia_captar-$dia_cal;  $dia_cal_cierre=$miercoles_dia_cierre-$dif;}
else
{$dif=$dia_cal-$dia_captar;   $dia_cal_cierre=$miercoles_dia_cierre+$dif;}
//print  $dia_cal_cierre."   ".$miercoles_dia_cierre."   ".$dif."<br>";
$fecha_cierre_sem=substr($rs_cal->fields["fecha_cal"],0,8).$dia_cal_cierre;

if($sem=="04" || $sem=="0")
$fecha_cierre_sem=$fecha_cal_cierre_sem4;
///-----------------------------------------------------
}


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
                          <td width="7%" valign="middle"  class="us"><img src="../../imagenes/large/edit_add.gif" width="48" height="48" border="0"><strong><font color="#000000" size="1"> 
                            </font></strong></td>
                          <td width="85%" valign="middle"  class="us"><strong><font color="#5A697E" size="4">Captaciones imputadas por variedad</font></strong></td>
                          <td width="8%"> 
                            <div align="center"><a class="toolbar" href="#" onClick="window.open('../../help/l_canasta.htm', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                              <img src="../../imagenes/admin/help_f2.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" /><br>
                              Ayuda</a></div></td>
                        </tr>
                        
                    </table></td>
                  </tr>
                </table>
                <br>
                <table width="99%" class="tabla" >
                  <tr align="center" valign="middle"> 
                    <td height="23" colspan="20"  > <div align="right">
                      <table width="696" height="32" border="0" cellpadding="0" cellspacing="0" class="filtro" >
                        <tr>
                          <td width="79"><div align="right">Semana:</div></td>
                          <td width="130"><select name="sel_sem" id="sel_mes2" onChange="javascript:document.frm.submit();">
                              <option value="0">---------------</option>
                              <option <?php if($_POST["sel_sem"]=="01")print "selected";?> value="01">Primera</option>
                              <option <?php if($_POST["sel_sem"]=="02")print "selected";?> value="02">Segunda</option>
                              <option <?php if($_POST["sel_sem"]=="03")print "selected";?> value="03">Tercera</option>
                              <option <?php if($_POST["sel_sem"]=="04")print "selected";?> value="04">Cuarta</option>
                          </select></td>
                          <td width="78" height="20"><div align="right">Mes:</div></td>
                          <td width="136"><select name="sel_mes" id="sel_mes" onChange="javascript:document.frm.submit();">
                              <option value="0">---------------</option>
                              <option <?php if($_POST["sel_mes"]=="01")print "selected";?> value="01">Enero</option>
                              <option <?php if($_POST["sel_mes"]=="02")print "selected";?> value="02">Febrero</option>
                              <option <?php if($_POST["sel_mes"]=="03")print "selected";?> value="03">Marzo</option>
                              <option <?php if($_POST["sel_mes"]=="04")print "selected";?> value="04">Abril</option>
                              <option <?php if($_POST["sel_mes"]=="05")print "selected";?> value="05">Mayo</option>
                              <option <?php if($_POST["sel_mes"]=="06")print "selected";?> value="06">Junio</option>
                              <option <?php if($_POST["sel_mes"]=="07")print "selected";?> value="07">Julio</option>
                              <option <?php if($_POST["sel_mes"]=="08")print "selected";?> value="08">Agosto</option>
                              <option <?php if($_POST["sel_mes"]=="09")print "selected";?> value="09">Septiembre</option>
                              <option <?php if($_POST["sel_mes"]=="10")print "selected";?> value="10">Octubre</option>
                              <option <?php if($_POST["sel_mes"]=="11")print "selected";?> value="11">Noviembre</option>
                              <option <?php if($_POST["sel_mes"]=="12")print "selected";?> value="12">Diciembre</option>
                            </select>                          </td>
                          <td width="91"  align="center"><div align="right">A&ntilde;o:</div></td>
                          <td width="162"  align="center"><div align="left">
                              <select name="sel_ano" id="sel_ano" onChange="javascript:document.frm.submit();">
                                <option value="0">------</option>
                                <?php 
						  $anno=date("Y");
						  for($i=4;$i>=0;$i--){?>
                                <option <?php if($_POST["sel_ano"]==$anno-$i)print "selected";?>><?php print $anno-$i;?></option>
                                <?php }?>
                              </select>
                          </div></td>
                        </tr>
                      </table>
                      <a href="#">&nbsp;&nbsp;
                        
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
                    <td width="1%" class="intro">&nbsp;</td>
                    <td  height="22" width="4%" class="intro">
                    <div align="left">Nivel</div></td>
                    <td   class="intro">Agregados </td>
                    <td   class="intro">Precios distribuidos</td>
                    <td   class="intro">Captaciones con precio</td>
                    <td   class="intro">Captaciones imputadas</td>
                    <td   class="intro">Porcentaje de imputaci&oacute;n </td>
                    <td   class="intro">Captaciones con precio o</td>
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
		
		 if($mes!=0 and $ano!=0)
                  {
				  if($sem=="04" || $sem=="0")
				  $fecha_cierre_sem=$fecha_cal_cierre_sem4;
				  $ecod_var=$rs->fields["ecod_var"];
				   
                  $sql4 = "select count(captacion.id_var_estab) 
				  from captacion,n_var_estab, n_estab,n_dpa, b_variedad, n_variedad
				  where n_var_estab.idb_variedad=b_variedad.idb_variedad 
				  and b_variedad.id_variedad=n_variedad.id_variedad 
				  and n_estab.cod_dpa=n_dpa.cod_dpa 
				  and n_var_estab.id_estab=n_estab.id_estab 
				  and incluido='1' and n_variedad.ide_articulo!='1' and central='0' 
				  and n_var_estab.id_var_estab=captacion.id_var_estab and cont_imp>='1' and cont_imp<='9'
				  and n_var_estab.fecha_captar>='".$fecha_base_ini."' and n_var_estab.fecha_captar<='".$fecha_base_fin."' 
				  and captacion.fecha>='".$fecha_cal_inicio_sem1."' and captacion.fecha<'".$fecha_cal_cierre_sem4."' 
				  and fecha_creacion<='".$fecha_cierre_sem."' and (fecha_desuso>'".$fecha_cal_cierre_sem4."' or n_var_estab.desuso='0')	
				  and ecod_var='$ecod_var'";
				 // print $sql4;
				  $rs4 = $db->Execute($sql4)or die($db->ErrorMsg());
				  $imp_var=$rs4->fields["count"];
				  
				  
				  
				   $sql5 = "select count(captacion.id_var_estab) 
				  from captacion,n_var_estab, n_estab,n_dpa, b_variedad, n_variedad
				  where n_var_estab.idb_variedad=b_variedad.idb_variedad 
				  and b_variedad.id_variedad=n_variedad.id_variedad 
				  and n_estab.cod_dpa=n_dpa.cod_dpa 
				  and n_var_estab.id_estab=n_estab.id_estab 
				  and incluido='1' and n_variedad.ide_articulo!='1' and central='0' 
				  and n_var_estab.id_var_estab=captacion.id_var_estab and precio='0'
				  and n_var_estab.fecha_captar>='".$fecha_base_ini."' and n_var_estab.fecha_captar<='".$fecha_base_fin."' 
				  and captacion.fecha>='".$fecha_cal_inicio_sem1."' and captacion.fecha<'".$fecha_cal_cierre_sem4."' 
				  and fecha_creacion<='".$fecha_cierre_sem."' and (fecha_desuso>'".$fecha_cal_cierre_sem4."' or n_var_estab.desuso='0')	
				  and ecod_var='$ecod_var'";
				 // print $sql4;
				  $rs5 = $db->Execute($sql5)or die($db->ErrorMsg());
				  $precio=$rs5->fields["count"];
				  
				  
				   $sql6 = "select count(n_var_estab.id_var_estab) 
				  from captacion,n_var_estab, n_estab,n_dpa, b_variedad, n_variedad
				  where n_var_estab.idb_variedad=b_variedad.idb_variedad 
				  and b_variedad.id_variedad=n_variedad.id_variedad 
				  and n_estab.cod_dpa=n_dpa.cod_dpa 
				  and n_var_estab.id_estab=n_estab.id_estab 
				  and incluido='1' and n_variedad.ide_articulo!='1' and central='0' 
				  and n_var_estab.id_var_estab=captacion.id_var_estab
				  and n_var_estab.fecha_captar>='".$fecha_base_ini."' and n_var_estab.fecha_captar<='".$fecha_base_fin."' 
				  and captacion.fecha>='".$fecha_cal_inicio_sem1."' and captacion.fecha<'".$fecha_cal_cierre_sem4."' 
				  and fecha_creacion<='".$fecha_cierre_sem."' and (fecha_desuso>'".$fecha_cal_cierre_sem4."' or n_var_estab.desuso='0')	
				  and ecod_var='$ecod_var'";
				 // print $sql4;
				  $rs6 = $db->Execute($sql6)or die($db->ErrorMsg());
				  $dist=$rs6->fields["count"];
				  
				  
				  $sql7 = "select count(captacion.id_var_estab) 
				  from captacion,n_var_estab, n_estab,n_dpa, b_variedad, n_variedad
				  where n_var_estab.idb_variedad=b_variedad.idb_variedad 
				  and b_variedad.id_variedad=n_variedad.id_variedad 
				  and n_estab.cod_dpa=n_dpa.cod_dpa 
				  and n_var_estab.id_estab=n_estab.id_estab and precio!='0' 
				  and incluido='1' and n_variedad.ide_articulo!='1' and central='0' 
				  and n_var_estab.id_var_estab=captacion.id_var_estab
				  and n_var_estab.fecha_captar>='".$fecha_base_ini."' and n_var_estab.fecha_captar<='".$fecha_base_fin."' 
				  and captacion.fecha>='".$fecha_cal_inicio_sem1."' and captacion.fecha<'".$fecha_cal_cierre_sem4."' 
				  and fecha_creacion<='".$fecha_cierre_sem."' and (fecha_desuso>'".$fecha_cal_cierre_sem4."' or n_var_estab.desuso='0')	
				  and ecod_var='$ecod_var'";
				  //print $sql7;
				  $rs7 = $db->Execute($sql7)or die($db->ErrorMsg());
				  $observ=$rs7->fields["count"];
			      }
		
		
		
		
   ?>
                  <?php if($cod_division_0!=$rs->fields["cod_division"]) {?>
                  <tr <?php  $a=$pager_nav->index_rs++;if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";   ?> >
                    <td  class="raya">&nbsp;</td>
                    <td  class="raya">1</td>
                    <td  class="raya" height="29" > <a onMouseOver="return overlib('División', ABOVE, RIGHT);" onMouseOut="return nd();"> 
                      <?php $cod_division_0=$rs->fields["cod_division"]; echo $rs->fields["cod_division"].". ";echo $rs->fields["division"];?>
                      </a> </td>
                    <td  class="raya" >&nbsp;</td>
                    <td  class="raya" >&nbsp;</td>
                    <td  class="raya" >&nbsp;</td>
                    <td  class="raya" >&nbsp;</td>
                    <td  class="raya" >&nbsp;</td>
                  </tr>
                  <?php } if($cod_grupo_0!=$rs->fields["cod_grupo"]) {?>
                  <tr <?php  $a=$pager_nav->index_rs++;if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";   ?> >
                    <td  class="raya">&nbsp;</td>
                    <td  class="raya">2</td>
                    <td  class="raya" height="29" >&nbsp;&nbsp; <a onMouseOver="return overlib('Grupo', ABOVE, RIGHT);" onMouseOut="return nd();"> 
                      <?php $cod_grupo_0=$rs->fields["cod_grupo"]; echo $rs->fields["cod_grupo"].". ";echo $rs->fields["grupo"];?>
                      </a> </td>
                    <td  class="raya" >&nbsp;</td>
                    <td  class="raya" >&nbsp;</td>
                    <td  class="raya" >&nbsp;</td>
                    <td  class="raya" >&nbsp;</td>
                    <td  class="raya" >&nbsp;</td>
                  </tr>
                  <?php } if($cod_clase_0!=$rs->fields["cod_clase"]) {?>
                  <tr <?php  $a=$pager_nav->index_rs++;if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";   ?> >
                    <td  class="raya">&nbsp;</td>
                    <td  class="raya">3</td>
                    <td  class="raya" height="29" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                      <a onMouseOver="return overlib('Clase', ABOVE, RIGHT);" onMouseOut="return nd();"> 
                      <?php $cod_clase_0=$rs->fields["cod_clase"]; echo $rs->fields["cod_clase"].". ";echo $rs->fields["clase"];?>
                      </a> </td>
                    <td  class="raya" >&nbsp;</td>
                    <td  class="raya" >&nbsp;</td>
                    <td  class="raya" >&nbsp;</td>
                    <td  class="raya" >&nbsp;</td>
                    <td  class="raya" >&nbsp;</td>
                  </tr>
                  <?php } if($cod_subclase_0!=$rs->fields["cod_subclase"]) {?>
                  <tr <?php  $a=$pager_nav->index_rs++;if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";   ?> >
                    <td  class="raya">&nbsp;</td>
                    <td  class="raya">4</td>
                   <?php if($cod_subclase_01!=generico){?> <td  class="raya" height="29" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                      <a onMouseOver="return overlib('Subclase', ABOVE, RIGHT);" onMouseOut="return nd();"> 
                      <?php $cod_subclase_0=$rs->fields["cod_subclase"]; echo $rs->fields["cod_subclase"].". ";echo $rs->fields["subclase"];?>
                      </a> </td>
                   <td  class="raya" >&nbsp;</td>
                   <td  class="raya" >&nbsp;</td>
                   <td  class="raya" >&nbsp;</td>
                   <td  class="raya" >&nbsp;</td>
                   <td  class="raya" >&nbsp;</td>
                   <?php }?>
                  </tr>
                  <?php } 
				  
				 
				  if($ecod_articulo_0!=$rs->fields["ecod_articulo"]) {?>
                  <tr <?php  $a=$pager_nav->index_rs++;if($a % 2) print "class=\"row1\""; else print "class=\"row0\"";   ?> >
                    <td  class="raya">&nbsp;</td>
                    <td  class="raya">5</td>
                    <td  class="raya" height="29" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a onMouseOver="return overlib('Artículo', ABOVE, RIGHT);" onMouseOut="return nd();">
                      <?php $ecod_articulo_0=$rs->fields["ecod_articulo"];echo $rs->fields["ecod_articulo"].". ";echo $rs->fields["earticulo"];?>
                    </a></td>
                    <td  class="raya" >&nbsp;</td>
                    <td  class="raya" >&nbsp;</td>
                    <td  class="raya" >&nbsp;</td>
                    <td  class="raya" >&nbsp;</td>
                    <td  class="raya" >&nbsp;</td>
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
                    <td  class="raya">&nbsp;</td>
                    <td  class="raya">6</td>
                    <td  class="raya" width="48%" height="29" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                      <a onMouseOver="return overlib('<?php echo "<b>Código Variedad: </b>".$r->fields["cod_var"];
					  if($rs->fields["cod_var"]) {echo "<br><b> UM: </b>".$rs->fields["unidad"];}
					  if($rs->fields["ecarac1"]) {echo "<br><b> ".$rs->fields["ecarac1"].": </b>".$r->fields["valor1"];}
					  if($rs->fields["ecarac2"]) {echo "<br><b> ".$rs->fields["ecarac2"].": </b>".$r->fields["valor2"];}
					  if($rs->fields["ecarac3"]) {echo "<br><b> ".$rs->fields["ecarac3"].": </b>".$r->fields["valor3"];}
					  if($rs->fields["ecarac4"]) {echo "<br><b> ".$rs->fields["ecarac4"].": </b>".$r->fields["valor4"];}
					  if($rs->fields["ecarac5"]) {echo "<br><b> ".$rs->fields["ecarac5"].": </b>".$r->fields["valor5"];}
					  if($rs->fields["ecarac6"]) {echo "<br><b> ".$rs->fields["ecarac6"].": </b>".$r->fields["valor6"];}
					 ?>', ABOVE, RIGHT);" onMouseOut="return nd();"> 
                      <?php echo $rs->fields["ecod_var"]." ";echo $rs->fields["variedad"];?>                      </a> </td>
                      
                    <td  class="raya" width="12%"align="center" ><?php echo $dist;?></td>
                    <td  class="raya" width="12%"align="center" ><?php echo $observ;?></td>
                    <td  class="raya" width="12%"align="center" ><?php echo $imp_var;if($observ!=0)$porc=$imp_var/$observ*100;?></td>
                    <td  <?php if($porc>=50){?> class="raya_roja"<?php }else {?>class="raya"<?php }?> width="11%"align="center" ><?php echo number_format($porc, 2, ',', ' ') ;$porc="";?></td>
                    <td  class="raya" width="11%"align="center" ><?php echo $precio;?></td>
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
    <td width="30" height="21"  align="center" valign="middle"> <div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><img src="../../imagenes/down.jpg" width="30" height="26"></font></div></td>
    <td width="695"  align="center" valign="middle" bgcolor="#4B4B4B">
      <div align="center"><font color="#FFFFFF" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>ONEI - 
    IPC 2009-2012</strong></font></div></td>
    <td width="30"  align="center" valign="middle"><div align="center"><img src="../../imagenes/up.jpg" width="30" height="26"></div></td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
