<?php
$x="../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");
include($x."php/session/session_autor.php");

$cod_estabs = array();

if($_GET['id_tipologia']=='29')
{
$cant_primer_estab=8;
$cant_resto_estab=9;
}
else
{
$cant_primer_estab=8;
$cant_resto_estab=10;
}
//$cant_primer_estab=8;
//$cant_resto_estab=9;

$array=array("D-1","L-1","Ma-1","Mi-1","J-1","V-1","S-1","D-2","L-2","Ma-2","Mi-2","J-2","V-2","S-2","D-3","L-3","Ma-3","Mi-3","J-3","V-3","S-3","D-1","L-4","Ma-4","Mi-4","J-4","V-4","S-4",);
$sql_usuario = "select id_usuario,rol, prov_mun,usuario.cod_dpa from usuario,n_dpa where usuario='".$_SESSION["user"]."' and usuario.cod_dpa=n_dpa.cod_dpa";		
$rs_usuario = $db->Execute($sql_usuario)or $mensaje=$db->ErrorMsg() ;
     
$id_usuario=$rs_usuario->Fields("id_usuario");
$cod_dpa=$rs_usuario->Fields("cod_dpa");
$prov_mun=$rs_usuario->Fields("prov_mun");
$rol=$rs_usuario->Fields("rol");
$cod_dpa2=substr($rs_usuario->fields["cod_dpa"],0,2);
//-------------------------------------------------------------------------------------------------
//
//---------------------------------------------------					 
$sql_fecha = "select max(fecha) from b_variedad";		
$rs_fecha = $db->Execute($sql_fecha)or $mensaje=$db->ErrorMsg() ;
$fecha_base = $rs_fecha->Fields('max');//print $x;
//---------------------------------------------------
$fecha_base=substr($rs_fecha->fields["max"],0,8);
//print $fecha_base;
	$sql_estab = "select distinct cod_estab,n_estab.id_estab,estab,n_dpa.cod_dpa_nueva,n_estab.id_mercado,dir,n_estab.id_tipologia,tipologia,mercado,prov_mun_nuevo,fecha_captar";
	
//if($_GET['semanal']==1)
//{$sql_estab=$sql_estab.",fecha_captar";}

	
$sql_estab=$sql_estab." from n_estab,n_dpa,n_var_estab,n_tipologia,n_mercado,b_variedad, n_variedad

where n_var_estab.id_estab=n_estab.id_estab and
n_var_estab.idb_variedad=b_variedad.idb_variedad and
n_variedad.id_variedad=b_variedad.id_variedad and
n_estab.cod_dpa=n_dpa.cod_dpa and n_estab.id_tipologia=n_tipologia.id_tipologia and
b_variedad.id_mercado=n_mercado.id_mercado and n_variedad.ide_articulo!='1' and n_var_estab.desuso='0' 
and n_estab.id_mercado=n_mercado.id_mercado and n_estab.id_mercado=b_variedad.id_mercado 
";
//print $sql_estab;and n_tipologia.id_tipologia!='29' 
//and n_estab.cod_estab='25014107' and n_tipologia.id_tipologia!='29'
//$_GET['dia']="08"; >

//if($_GET['semanal']==1)
//$sql_estab=$sql_estab."and n_tipologia.id_tipologia!='29'";
if($_GET['chx_agro']!="" and $_GET['chx_agro']!="0")
{$sql_estab=$sql_estab." and n_tipologia.id_tipologia!='29'";}


if($_GET['id_tipologia']!="" and $_GET['id_tipologia']!="0")
{$sql_estab=$sql_estab." and n_tipologia.id_tipologia='".$_GET['id_tipologia']."'";}

if($_GET['id_estab']!="" && $_GET['id_estab']!="0")
{$sql_estab=$sql_estab." and n_estab.id_estab='".$_GET['id_estab']."'";}

if($_GET['dia']!="")
{$sql_estab=$sql_estab." and fecha_captar='".$fecha_base.$_GET['dia']."'";}

if($_GET['dia1']!="")
{$sql_estab=$sql_estab." and fecha_captar>='".$fecha_base.$_GET['dia1']."'";}

if($_GET['dia2']!="")
{$sql_estab=$sql_estab." and fecha_captar<='".$fecha_base.$_GET['dia2']."'";}

if($rol=="autor")
{$sql_estab=$sql_estab." and n_estab.cod_dpa='".$cod_dpa."'";}

if($_GET['cod_dpa']!="")
{$sql_estab=$sql_estab." and n_estab.cod_dpa='".$_GET['cod_dpa']."'";
$cod_dpa=$_GET['cod_dpa'];}

if($rol=="aut_p")
{$sql_estab=$sql_estab." and n_estab.cod_dpa like '".$cod_dpa2."%'";
$cod_dpa=$_GET['cod_dpa'];}

//if($_GET['semanal']==1)
//{$sql_estab=$sql_estab." order by fecha_captar";}

$sql_estab=$sql_estab." order by fecha_captar";
	//print 	$sql_estab;
	$rs_estab = $db->Execute($sql_estab)or $mensaje=$db->ErrorMsg() ;
	$cant_estab=$rs_estab->RecordCount();
	
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>IPC</title>
<link href="../../css/azul.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style2 {font-size: 9px}
-->
</style>
</head>


<?php
$rs_estab->MoveFirst();

for($estab=0;$estab<$cant_estab;$estab++)
{
$fist_estab=1;//variable para indicar que es la primera página


	$cod_estab=$rs_estab->fields["cod_estab"];
	//print $rs_estab->RecordCount();
	//if($cod_estab_aux=$cod_estab)
	//$rs_estab->MoveNext();
	//$cod_estab_aux=$cod_estab;
	$nodo = in_array($cod_estab, $cod_estabs); //print $nodo." - ";
	if($nodo=="")
	{$count=count($cod_estabs);
	$cod_estabs[$count]=$cod_estab;
	
	
	$id_mercado=$rs_estab->fields["id_mercado"];
	
	$sql_var = "select distinct cod_var,ecod_var,n_variedad.id_articulo,n_variedad.ide_articulo,
	variedad,n_variedad.id_variedad,cantidad,valor1,valor2,valor3,valor4,valor5,valor6,
cod_articulo,articulo,
n_variedad.carac1,n_variedad.carac2,n_variedad.carac3,n_variedad.carac4,n_variedad.carac5,n_variedad.carac6,

ecod_articulo,earticulo,
	
n_var_estab.id_unidad,unidad,n_estab.id_mercado,

n_var_estab.id_estab,n_estab.cod_dpa,estab,mercado 

from n_variedad,b_variedad,n_var_estab,n_estab,n_dpa,n_articulo,n_unidad,n_mercado, e_articulo
where
n_variedad.id_variedad=b_variedad.id_variedad
and n_estab.cod_dpa=n_dpa.cod_dpa and
n_var_estab.idb_variedad=b_variedad.idb_variedad and

n_articulo.id_articulo=n_variedad.id_articulo and 
e_articulo.ide_articulo=n_variedad.ide_articulo and


b_variedad.id_mercado=n_mercado.id_mercado and 
n_estab.id_mercado=n_mercado.id_mercado and 
n_estab.id_mercado=b_variedad.id_mercado and
n_var_estab.id_unidad=n_unidad.id_unidad and
n_var_estab.id_estab=n_estab.id_estab and cod_estab='".$cod_estab."' 
and n_estab.id_mercado='".$id_mercado."' and n_variedad.ide_articulo!='1' and n_var_estab.desuso='0'
order by estab, ecod_var, cod_var";//print 	$sql_var;
	$rs_var = $db->Execute($sql_var)or $mensaje=$db->ErrorMsg() ;
	$cant_var=$rs_var->RecordCount();
	
	
//-----------------------------------------------------------------------
//-----------------------------------------------------------------------	//-----------------------------------------------------------------------		

$ano=$_GET['sel_ano'];
$cuatrimestre=$_GET['rbt_cuatri'];
if($cuatrimestre=="1")
{
$a=$ano-1;
$m="12";
$strmes1="Ene.";
$strmes2="Feb.";
$strmes3="Mar.";
$strmes4="Abr.";
}
elseif($cuatrimestre=="2")
{
$a=$ano;
$m="04";
$strmes1="May.";
$strmes2="Jun.";
$strmes3="Jul.";
$strmes4="Ago.";
}
else
{
$a=$ano;
$m="08";
$strmes1="Sep.";
$strmes2="Oct.";
$strmes3="Nov.";
$strmes4="Dic.";
}


//--------------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DEL MES ACTUAL--------------------------------
$fecha_cierre_sem4_3=substr($fecha_base,0,8)."04";

$mes3=$m;
$ano3=$a;

if($mes3=="12")
{$mes_next3="01";$ano_next3=$ano3+1;}
else {$mes_next3=$mes3+1;$ano_next3=$ano3;}

if(strlen($mes_ant3)==1)
$mes_ant3=0 .$mes_ant3; 

$fecha_01_fin3=$ano_next3."/".$mes_next3."/"."01";//esta fecha es para quedarme dentro del mes actual
$fecha_01_ini3=$ano3."/".$mes3."/"."01";//esta fecha es para quedarme dentro del mes actual

$sql_cal = "select * from calendario where fecha_captar='".$fecha_cierre_sem4_3."' 
and fecha_cal>='$fecha_01_ini3' and fecha_cal<'$fecha_01_fin3' order by fecha_captar";//print $sql_cal;die();	
$rs_cal = $db->Execute($sql_cal) or die($db->ErrorMsg());
$fecha_cal_inicio_sem1_actual=$rs_cal->fields["fecha_cal"];//print $fecha_cal_inicio_sem1_actual;
//--------------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DEL MES ACTUAL--------------------------------

//--------------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DEL MES NEXT--------------------------------
$fecha_cierre_sem4_4=substr($fecha_base,0,8)."04";


$mes4=$m;
$ano4=$a;

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
$fecha_cal_inicio_sem1_next=$rs_cal->fields["fecha_cal"];//print $fecha_cal_inicio_sem1_next;die();
//--------------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DEL MES NEXT--------------------------------

$fecha_ini_ant=$fecha_cal_inicio_sem1_actual;
$fecha_fin_ant=$fecha_cal_inicio_sem1_next;
//print $fecha_ini_ant.$fecha_fin_ant;
	
//-----------------------------------------------------------------------
//-----------------------------------------------------------------------	//-----------------------------------------------------------------------			
	
	
?>
<body ><form  action="" method="post" name="frm">
  <table width="993" height="228" border="0" align="center" cellpadding="0" cellspacing="0">
   
  <tr>
    <td height="25">
	<table width="993" height="25" border="0" cellpadding="0" cellspacing="0" class="cuadro4">
      
      <tr height="20">
        <td height="23" colspan="6" class="cuadro12"><table width="100%" height="22" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="175" height="23">&nbsp;&nbsp;&nbsp;&nbsp;<img src="../../imagenes/3.jpg" width="122" height="38" /></td>
            <td width="164"><div align="center">
<p><b>Sistema de Informaci&oacute;n de Estadística Nacional (SIEN)</b></p>
            </div></td>
            <td width="401"><div align="center">
              <p><b>ENCUESTA DE PRECIOS PARA EL<br />
                &Iacute;NDICE DE PRECIOS AL CONSUMIDOR</b></p>
            </div></td>
            <td width="110"><p><strong>Cuatrimestre: <?php print $cuatrimestre;?>
              A&ntilde;o: <?php print $ano;?></strong></p></td>
            <td width="135"><div align="center">
              <p><b>Modelo No. 9010-00</b></p>
            </div></td>
          </tr>
        </table></td>
        </tr>
      <tr height="20">
        <td width="252" >&nbsp;</td>
        <td width="293" height="11" >&nbsp;</td>
        <td width="177" >&nbsp;</td>
        <td width="108" >&nbsp;</td>
        <td width="65">&nbsp;</td>
        <td width="98" >&nbsp;</td>
        </tr>
      <tr height="13">
        <td class="cuadro2"><div align="center"><b><?php print "&nbsp;";echo $cod_estab.". ".$rs_estab->fields["estab"];?></b></div></td>
        <td class="cuadro2"><div align="center"><b><?php print "&nbsp;";echo $rs_estab->fields["dir"]."&nbsp;";?></b></div></td>
        <td class="cuadro2" ><div align="center"><b><?php print "&nbsp;";echo $rs_estab->fields["cod_dpa_nueva"].". ".$rs_estab->fields["prov_mun_nuevo"];?></b></div></td>
        <td class="cuadro2" ><div align="center"><b><?php echo $rs_estab->fields["mercado"];?></b></div></td>
        <td class="cuadro3" colspan="2"><div align="center"><b><?php echo $rs_estab->fields["tipologia"];?></b></div></td>
        </tr>
      
      <tr height="25">
        <td valign="top" align="center">Establecimiento</td>
        <td valign="top" align="center">Direcci&oacute;n</td>        
        <td valign="top" align="center">DPA</td>
        <td valign="top" align="center">Mercado</td>
        <td valign="top"  colspan="2"align="center">Tipología</td>
        </tr>
    </table></td>
  </tr>
  <tr>
      <td height="109" valign="top">
<table width="993" height="116" cellpadding="0" cellspacing="0" bordercolor="#000000" class="cuadro4" >
      
        <?php 
		$contador=0;
		
       for($v=0;$v<$cant_var;$v++)
	         {
			
			$fin=$fin+1;
			if($fin==1)
			{
				
			 ?>
        <tr height="9">
        <td colspan="4"rowspan="2" class="cuadro6"><div align="left">&nbsp;P&aacute;gina: <?php print $contador=$contador+1;?> de <?php if($cant_var<=$cant_primer_estab)print "1";else {$pag=($cant_var-$cant_primer_estab)/$cant_resto_estab;$int=is_int($pag);if($int){$pag=$pag+1;}else{$pag=$pag+2;};print floor($pag);}?> </div><div align="center">  
        &nbsp;Cant. de variedades en formulario:<?php print $cant_var;?></div></td>
        <td class="cuadro6" rowspan="2" width="37" ><div align="center">D-S</div></td>
        <td class="cuadro6"colspan="2" ><div align="center"><?php print "Anterior";?></div></td>
        <td class="cuadro6"colspan="2" ><div align="center"><?php print $strmes1;?></div></td>
        <td class="cuadro6"colspan="2" ><div align="center"><?php print $strmes2;?></div></td>
        <td class="cuadro6"colspan="2" ><div align="center"><?php print $strmes3;?></div></td>
        <td class="cuadro6"colspan="2" ><div align="center"><?php print $strmes4;?></div></td>
        <td class="cuadro6"colspan="2" ><div align="center">Cambio</div></td>
        <td width="230" rowspan="2" class="cuadro5" ><div align="center">&nbsp;Consideraciones&nbsp;</div></td>
        </tr>
      <tr height="9">
        <td class="cuadro1"><div align="center">Precio</div></td>
        <td class="cuadro1"><div align="center" class="style2">Ob</div></td>
        <td class="cuadro1"><div align="center">Precio</div></td>
        <td class="cuadro1"><div align="center" class="style2">Ob</div></td>
        <td class="cuadro1"><div align="center">Precio</div></td>
        <td class="cuadro1"><div align="center" class="style2">Ob</div></td>
        <td class="cuadro1"><div align="center">Precio</div></td>
        <td class="cuadro1"><div align="center" class="style2">Ob</div></td>
        <td class="cuadro1"><div align="center">Precio</div></td>
        <td class="cuadro1"><div align="center" class="style2">Ob</div></td>        
        <td class="cuadro1"><div align="center">Cant.</div></td>
        <td class="cuadro1"><div align="center" class="style2">U/M</div></td>
        </tr>
             
              <?php 
			}
			
			
			
			
		    $id_articulo=$rs_var->fields["id_articulo"];
			//print "art"." ".$id_articulo." ";
		
	        $ide_articulo=$rs_var->fields["ide_articulo"];  
			$cantidad=$rs_var->fields["cantidad"];
			//print "arte"." ".$ide_articulo." ";
			$carac1=$rs_var->fields["carac1"];//print "ddd".$carac1;
			$carac2=$rs_var->Fields("carac2");
		    $carac3=$rs_var->fields["carac3"];
			$carac4=$rs_var->fields["carac4"];
			$carac5=$rs_var->fields["carac5"];
			$carac6=$rs_var->fields["carac6"];
			    if($ide_articulo!="1")
			  {
			$articulo=$rs_var->fields["earticulo"];			
			
			
			$ecod_articulo=$rs_var->fields["ecod_articulo"];
			  }
				
			  elseif($id_articulo!="1")
				{   
			$articulo=$rs_var->fields["articulo"];			
			
			$cod_articulo=$rs_var->fields["cod_articulo"];
			  }
			 
			  
			$id_variedad=$rs_var->fields["id_variedad"];
			$variedad=$rs_var->fields["variedad"];
			$ecod_var=$rs_var->fields["ecod_var"];
			$valor1=$rs_var->fields["valor1"];
			$valor2=$rs_var->Fields("valor2");
		    $valor3=$rs_var->fields["valor3"];
			$valor4=$rs_var->fields["valor4"];
			$valor5=$rs_var->fields["valor5"];
			$valor6=$rs_var->fields["valor6"];
			$valor7=$rs_var->fields["valor7"];
			$valor8=$rs_var->fields["valor8"];
			$valor9=$rs_var->fields["valor9"];
			$valor10=$rs_var->fields["valor10"];
			$unidad=$rs_var->fields["unidad"];
	        $mercado=$rs_var->fields["mercado"];
			
			$sql_fecha = "select id_var_estab, fecha_captar, n_estab.id_estab,cod_estab,b_variedad.id_variedad, n_var_estab.idb_variedad, id_tipologia, contacto
from n_var_estab,n_estab,b_variedad,n_variedad where n_var_estab.id_estab=n_estab.id_estab and n_var_estab.idb_variedad=b_variedad.idb_variedad and b_variedad.id_variedad=n_variedad.id_variedad 
and cod_estab='".$cod_estab."' and b_variedad.id_variedad='".$id_variedad."' and n_var_estab.desuso='0' order by fecha_captar";	//print 	$sql_fecha."<br><br>";
			$rs_fecha = $db->Execute($sql_fecha)or $mensaje=$db->ErrorMsg() ;
			$cant_fecha=$rs_fecha->RecordCount();
			
			
			$sep=0;	
			
			
			
			
			
	
       ?>
      <tr height="9">
      <?php if($separacion!=substr($ecod_articulo,0,2))
			{print "<td colspan=\"16\">&nbsp;</td></tr><tr>";$sep=1;}?>
        <td height="9"  colspan="4" <?php if($separacion!=substr($ecod_articulo,0,2))
			{?>class="cuadro1-1" <?php }else{?>class="cuadro1" <?php } echo "rowspan=\"".$cant_fecha ."\"";?>  >
		
        
		<table width="462" border="0" cellspacing="0" cellpadding="0">
		  <tr>
		    <td colspan="4" class="cuadro4">        
			<?php  
			$separacion=substr($ecod_articulo,0,2);
			
			//echo "<b>&nbsp; Artículo:&nbsp;".$ecod_articulo." ".$articulo."</b><br>";Variedad:&nbsp;
			echo  "<b>&nbsp; "."<b> ".$ecod_var." ".$variedad."&nbsp;"." "."&nbsp;"."&nbsp;"."</b></b>"."Cantidad: ";if($cantidad)print "$cantidad"." $unidad";if(!$cantidad)print "_____ ".$unidad;
			
			
			 ?>			</td>
		    </tr>
			</table>
			
			<table width="462" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><table width="232" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td  <?php print "width=\"". 7*strlen($carac1)."\"" ?>class="cuadro10"><?php if($carac1){print  "&nbsp;".$carac1.":";}?></td>
                    <td <?php if($valor1){print "class=\"cuadro10\"";}else {print "class=\"cuadro11\"";}?>><?php if($valor1){print $valor1;}if(!$valor1 && $carac1){print  "&nbsp;";}?></td>
                    <td width="10" ><?php if(!$valor1 && $carac1){print  "&nbsp;";}?></td>
                  </tr>
                </table>
				<?php if($carac3){?>
				<table width="232" border="0" cellspacing="0" cellpadding="0">
                  <tr>
<td  <?php print "width=\"". 7*strlen($carac3)."\"" ?>class="cuadro10"><?php if($carac3){print  "&nbsp;".$carac3.":";}?></td>                     <td <?php if($valor3){print "class=\"cuadro10\"";}else {print "class=\"cuadro11\"";}?>><?php if($valor3){print $valor3;}if(!$valor3 && $carac3){print  "&nbsp;";}?></td>
					<td width="10" ><?php if(!$valor3 && $carac3){print  "&nbsp;";}?></td>
                  </tr>
                </table>
				<?php }if($carac5){?>
				<table width="232" border="0" cellspacing="0" cellpadding="0">
                  <tr>
<td  <?php print "width=\"". 7*strlen($carac5)."\"" ?>class="cuadro10"><?php if($carac5){print  "&nbsp;".$carac5.":";}?></td>                     <td <?php if($valor5){print "class=\"cuadro10\"";}else {print "class=\"cuadro11\"";}?>><?php if($valor5){print $valor5;}?></td>
					<td width="10" ><?php if(!$valor5 && $carac5){print  "&nbsp;";}?></td>
                  </tr>
                </table>
				<?php }?>
				</td>
                <td>
				<?php if($carac1){?>
				<table width="232" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td  <?php if(!$carac2){print "width=\"10\"";} else{print "width=\"". 7*strlen($carac2)."\"";}?>class="cuadro10"><?php if($carac2){print  "&nbsp;".$carac2.":";}elseif($carac1){print "&nbsp;";}?></td>
                    <td <?php if($valor2){print "class=\"cuadro10\"";}elseif($carac2){print "class=\"cuadro11\"";}?>><?php print $valor2;
					if($carac1){print "&nbsp;";}?></td>
                    <td width="10" ><?php if(!$valor2 && $carac2){print  "&nbsp;";}?></td>
                  </tr>
                </table>
				
				<?php }if($carac3){?>
				
                <table width="232" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td  <?php if(!$carac4){print "width=\"10\"";} else{print "width=\"". 7*strlen($carac4)."\"";}?>class="cuadro10"><?php if($carac4){print  "&nbsp;".$carac4.":";}elseif($carac3){print "&nbsp;";}?></td>
                    <td <?php if($valor4){print "class=\"cuadro10\"";}elseif($carac4){print "class=\"cuadro11\"";}?>><?php print $valor4;
					if($carac3){print "&nbsp;";}?></td>
                    <td width="10" ><?php if(!$valor4 && $carac4){print  "&nbsp;";}?></td>
                  </tr>
                </table>
				
				<?php }if($carac5){?>
				
				<table width="232" border="0" cellspacing="0" cellpadding="0">
                   <tr>
                    <td  <?php if(!$carac6){print "width=\"10\"";} else{print "width=\"". 7*strlen($carac6)."\"";}?>class="cuadro10"><?php if($carac6){print  "&nbsp;".$carac6.":";}elseif($carac5){print "&nbsp;";}?></td>
                    <td <?php if($valor6){print "class=\"cuadro10\"";}elseif($carac6){print "class=\"cuadro11\"";}?>><?php print $valor6;
					if($carac5){print "&nbsp;";}?></td>
                    <td width="10" ><?php if(!$valor6 && $carac6){print  "&nbsp;";}?></td>
                  </tr>
                </table>
				<?php }?>
				<br>
                
				</td>
              </tr>
		</table>		</td>
       
            <?php 
			$rs_fecha->MoveFirst();//print $cant_fecha;
			for($fecha=1;$fecha<=$cant_fecha;$fecha++)
			{
			$contacto=$rs_fecha->fields["contacto"];
			$id_tipologia=$rs_fecha->fields["id_tipologia"];
			$fecha_captar=$rs_fecha->fields["fecha_captar"];
			$id_var_estab=$rs_fecha->fields["id_var_estab"];
			
			$sql_cap = "select precio, obs, cont_imp
			from n_var_estab,captacion, n_obs
			where n_var_estab.id_var_estab=captacion.id_var_estab 
			and n_obs.id_obs=captacion.id_obs 
			and n_var_estab.id_var_estab='$id_var_estab' 
			and fecha>='$fecha_ini_ant' and fecha<'$fecha_fin_ant'";	
			$rs_cap = $db->Execute($sql_cap)or $mensaje=$db->ErrorMsg() ;
			if($rs_cap)
			{
			 $pre_ant=$rs_cap->fields["precio"];//print $pre_ant;
			 $obs_ant=substr($rs_cap->fields["obs"],0,2);
			 $cont_imp_ant=$rs_cap->fields["cont_imp"];
			 if($cont_imp_ant==1)$obs_ant="IM";
			 
			 if($pre_ant==0 || $pre_ant=="")
			 $pre_ant="&nbsp;";
			 if($obs_ant=="")
			 $obs_ant="&nbsp;";
			}
			else
			{//print $sql_cap;
			 $pre_ant="&nbsp;";
			 $obs_ant="&nbsp;";
			}
			
			
			
			
			
       		if($fecha>1) print "<tr height=\"13\">";    ?>
            <td <?php if($sep==1)
			{?>class="cuadro1-1" <?php }else{?>class="cuadro1" <?php }?> valign="middle" ><div align="center">
              <?php $dia=substr($fecha_captar,8,2);print $array[$dia-1];//print "&nbsp;";?>
            </div></td>
            <td <?php if($sep==1)
			{?>class="cuadro1-1" <?php }else{?>class="cuadro1" <?php }?>width="36" >
            <div align="center"><?php if($pre_ant!="&nbsp;")print number_format($pre_ant, 2, ',', ' ');else print $pre_ant;$pre_ant="&nbsp;";?></div></td>
            <td <?php if($sep==1)
			{?>class="cuadro1-1" <?php }else{?>class="cuadro1" <?php }?>width="18" ><div align="center"><?php print $obs_ant;$obs_ant="&nbsp;";?></div>            </td>
            <td <?php if($sep==1)
			{?>class="cuadro1-1" <?php }else{?>class="cuadro1" <?php }?>width="36" >&nbsp;</td>
            <td <?php if($sep==1)
			{?>class="cuadro1-1" <?php }else{?>class="cuadro1" <?php }?>width="18" >&nbsp;</td>
            <td <?php if($sep==1)
			{?>class="cuadro1-1" <?php }else{?>class="cuadro1" <?php }?>width="36" >&nbsp;</td>
            <td <?php if($sep==1)
			{?>class="cuadro1-1" <?php }else{?>class="cuadro1" <?php }?>width="18" >&nbsp;</td>
            <td <?php if($sep==1)
			{?>class="cuadro1-1" <?php }else{?>class="cuadro1" <?php }?>width="36" >&nbsp;</td>
            <td <?php if($sep==1)
			{?>class="cuadro1-1" <?php }else{?>class="cuadro1" <?php }?>width="18" >&nbsp;</td>
            <td <?php if($sep==1)
			{?>class="cuadro1-1" <?php }else{?>class="cuadro1" <?php }?>width="36" >&nbsp;</td>
            <td <?php if($sep==1)
			{?>class="cuadro1-1" <?php }else{?>class="cuadro1" <?php }?>width="18" >&nbsp;</td>
            <td <?php if($sep==1)
			{?>class="cuadro1-1" <?php }else{?>class="cuadro1" <?php }?>width="36" >&nbsp;</td>
            <td <?php if($sep==1)
			{?>class="cuadro1-1" <?php }else{?>class="cuadro1" <?php }?>width="18" >&nbsp;</td>
            <td <?php if($sep==1)
			{$sep=0;?>class="cuadro3-3" <?php }else{?>class="cuadro3" <?php }?>>&nbsp;</td>
          </tr> 
	   
       
       
	    <?php 
		$rs_fecha->MoveNext();}
		if($fist_estab==1)
		{$num=$cant_primer_estab;}else {$num=$cant_resto_estab;}
		
		$total=$cant_var-1;//print $fin."  ".$num."  ".$v."-";print $total."  ";
		
			if($fin==$num && $v!=$total){$fist_estab=0;
			
if($id_tipologia!='29')
{
    ?>       
             <tr height="9">
			  <td colspan="7" rowspan="2" class="cuadro15">&nbsp;Comentarios:</td>
		      <td colspan="8" align="center" class="cuadro15">Suma de control por p&aacute;gina:</td>
		      <td colspan="3" rowspan="2" class="cuadro16">&nbsp;Comentarios:</td>
	      </tr>
			<tr>
			  <td height="32" colspan="2" class="cuadro15">&nbsp;</td>
			  <td colspan="2" class="cuadro15">&nbsp;</td>
			  <td colspan="2" class="cuadro15">&nbsp;</td>
			  <td colspan="2" class="cuadro15">&nbsp;</td>
		  </tr>
    <?php } else {?>  
     <tr height="9">
			  <td colspan="7" rowspan="5" class="cuadro15">&nbsp;Comentarios:</td>
		      <td colspan="8" align="center" class="cuadro15">Suma de control por p&aacute;gina:</td>
		      <td colspan="3" rowspan="5" class="cuadro16">&nbsp;Comentarios:</td>
	      </tr>
			<tr>
			  <td height="15" colspan="2" class="cuadro15">&nbsp;</td>
			  <td colspan="2" class="cuadro15">&nbsp;</td>
			  <td colspan="2" class="cuadro15">&nbsp;</td>
			  <td colspan="2" class="cuadro15">&nbsp;</td>
		  </tr>
			<tr>
			  <td colspan="2" class="cuadro15">&nbsp;</td>
			  <td colspan="2" class="cuadro15">&nbsp;</td>
			  <td colspan="2" class="cuadro15">&nbsp;</td>
			  <td colspan="2" class="cuadro15">&nbsp;</td>
          </tr>
			<tr>
			  <td colspan="2" class="cuadro15">&nbsp;</td>
			  <td colspan="2" class="cuadro15">&nbsp;</td>
			  <td colspan="2" class="cuadro15">&nbsp;</td>
			  <td colspan="2" class="cuadro15">&nbsp;</td>
          </tr>
			<tr>
			  <td colspan="2" class="cuadro15">&nbsp;</td>
			  <td colspan="2" class="cuadro15">&nbsp;</td>
			  <td colspan="2" class="cuadro15">&nbsp;</td>
			  <td colspan="2" class="cuadro15">&nbsp;</td>
          </tr>  
    <?php }        
		print"</table>"; $fin=0; print "<br class=\"pag\">"; print "<table  border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"cuadro4\">";
			
             } elseif($v==$total) $fin=0;//hay que ponerlo en cero xq cuando salta al ser $v==$total no se incializa $fin
		
		
		$rs_var->MoveNext();}
		
		
		if($id_tipologia!='29')
{
		?>
            
            <tr height="9">
			  <td rowspan="2" class="cuadro15">&nbsp;Incidencia de <?php print $strmes1;?>:</td>
		      <td rowspan="2" class="cuadro15">&nbsp;Incidencia de <?php print $strmes2;?>:</td>
		      <td rowspan="2" class="cuadro15">&nbsp;Incidencia de <?php print $strmes3;?>:</td>
		      <td rowspan="2" class="cuadro15">&nbsp;Incidencia de <?php print $strmes4;?>:</td>
		      <td rowspan="2" class="cuadro15">&nbsp;</td>
		      <td colspan="2" rowspan="2" class="cuadro15">&nbsp;</td>
		      <td colspan="8" align="center" class="cuadro15">Suma de control mensual total:</td>
		      <td colspan="3" rowspan="2" class="cuadro16">&nbsp;Persona de contacto, cargo y tel&eacute;f.: <?php print $contacto;?></td>
	      </tr>
			<tr>
			  <td height="32" colspan="2" class="cuadro15">&nbsp;</td>
			  <td colspan="2" class="cuadro15">&nbsp;</td>
			  <td colspan="2" class="cuadro15">&nbsp;</td>
			  <td colspan="2" class="cuadro15">&nbsp;</td>
		  </tr>
           <?php } else {?>  
    <tr height="9">
			  <td class="cuadro15">&nbsp;Incidencia de <?php print $strmes1;?>:</td>
		      <td class="cuadro15">&nbsp;Incidencia de <?php print $strmes2;?>:</td>
		      <td class="cuadro15">&nbsp;Incidencia de <?php print $strmes3;?>:</td>
		      <td class="cuadro15">&nbsp;Incidencia de <?php print $strmes4;?>:</td>
		      <td rowspan="5" class="cuadro15">&nbsp;</td>
		      <td colspan="2" rowspan="5" class="cuadro15">&nbsp;</td>
		      <td colspan="8" align="center" class="cuadro15">Suma de control mensual total:</td>
		      <td colspan="3" rowspan="5" class="cuadro16">&nbsp;Persona de contacto, cargo y tel&eacute;f.: <?php print $contacto;?></td>
	      </tr>
			<tr>
			  <td height="15" class="cuadro15">&nbsp;</td>
			  <td class="cuadro15">&nbsp;</td>
			  <td class="cuadro15">&nbsp;</td>
			  <td class="cuadro15">&nbsp;</td>
			  <td colspan="2" class="cuadro15">&nbsp;</td>
			  <td colspan="2" class="cuadro15">&nbsp;</td>
			  <td colspan="2" class="cuadro15">&nbsp;</td>
			  <td colspan="2" class="cuadro15">&nbsp;</td>
		  </tr>
			<tr>
			  <td class="cuadro15">&nbsp;</td>
			  <td class="cuadro15">&nbsp;</td>
			  <td class="cuadro15">&nbsp;</td>
			  <td class="cuadro15">&nbsp;</td>
			  <td colspan="2" class="cuadro15">&nbsp;</td>
			  <td colspan="2" class="cuadro15">&nbsp;</td>
			  <td colspan="2" class="cuadro15">&nbsp;</td>
			  <td colspan="2" class="cuadro15">&nbsp;</td>
          </tr>
			<tr>
			  <td class="cuadro15">&nbsp;</td>
			  <td class="cuadro15">&nbsp;</td>
			  <td class="cuadro15">&nbsp;</td>
			  <td class="cuadro15">&nbsp;</td>
			  <td colspan="2" class="cuadro15">&nbsp;</td>
			  <td colspan="2" class="cuadro15">&nbsp;</td>
			  <td colspan="2" class="cuadro15">&nbsp;</td>
			  <td colspan="2" class="cuadro15">&nbsp;</td>
          </tr>
			<tr>
			  <td class="cuadro15">&nbsp;</td>
			  <td class="cuadro15">&nbsp;</td>
			  <td class="cuadro15">&nbsp;</td>
			  <td class="cuadro15">&nbsp;</td>
			  <td colspan="2" class="cuadro15">&nbsp;</td>
			  <td colspan="2" class="cuadro15">&nbsp;</td>
			  <td colspan="2" class="cuadro15">&nbsp;</td>
			  <td colspan="2" class="cuadro15">&nbsp;</td>
          </tr>
    <?php }?>        
          
    </table>

<table width="100%"  cellpadding="0" cellspacing="0"> 
                <tr height="9" >
                <td class="cuadro3" height="20" colspan="16"><?php 
		$sql_inc = "select * from n_inc order by inc";		
		$rs_inc = $db->Execute($sql_inc)or $mensaje=$db->ErrorMsg() ;
		$rs_inc->MoveFirst();
		$cant_inc=$rs_inc->RecordCount();
		print "<b>Incidencias:&nbsp;</b>";
		for($inc=1;$inc<=$cant_inc;$inc++)
		{
		print $rs_inc->fields["inc"]."&nbsp;&nbsp;";
		$rs_inc->MoveNext();
		}
		print "<br>";
		$sql_obs = "select * from n_obs order by obs";		
		$rs_obs = $db->Execute($sql_obs)or $mensaje=$db->ErrorMsg() ;
		$rs_obs->MoveFirst();//print $cant_var;
		$cant_obs=$rs_obs->RecordCount();
		print "<b>Observaciones:&nbsp;</b>";
		for($obs=1;$obs<=$cant_obs;$obs++)
		{
		if($rs_obs->fields["id_obs"]!=1)
		print $rs_obs->fields["obs"]."&nbsp;&nbsp;";
		$rs_obs->MoveNext();
		}
		?></td>
          </tr>
        </table>
    </td>
  </tr>
</table>
<?php	
$total_estab=$cant_estab-1;
if($estab!=$total_estab)
{
?>
<br class="pag">
<?php		
}
?>
</form>

</body>
<?php
 
 
}//lave de la matriz para no repetir establecimientos
 
$rs_estab->MoveNext();}//---------for de los establecimientos----------
?>

</html>
