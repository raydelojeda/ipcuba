<?php 
$x="../../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."php/session/session_autor.php");
include($x."adodb/adodb-navigator.php");
include($x."php/generar_excel_apis.php");



$sem=$_GET["sem"];
if($sem=="01")$semana="1ra";
if($sem=="02")$semana="2da";
if($sem=="03")$semana="3ra";
if($sem=="04")$semana="4ta";

$mes=$_GET["mes"];
if($mes=="01")$tmes=Enero;
if($mes=="02")$tmes=Febrero;
if($mes=="03")$tmes=Marzo;
if($mes=="04")$tmes=Abril;
if($mes=="05")$tmes=Mayo;
if($mes=="06")$tmes=Junio;
if($mes=="07")$tmes=Julio;
if($mes=="08")$tmes=Agosto;
if($mes=="09")$tmes=Septiembre;
if($mes=="10")$tmes=Octubre;
if($mes=="11")$tmes=Noviembre;
if($mes=="12")$tmes=Diciembre;

$ano=$_GET["ano"];


header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel");
header ("Content-Disposition: attachment; filename=Cumplimiento(".$semana." ".$mes." ".$ano.")_".date("d-m-Y").".xls" );
header ("Content-Description: PHP/INTERBASE Generated Data" );
xlsBOF(); // begin Excel stream

$sem=$_GET["sem"];
if($sem=="01")$semana=Primera;
if($sem=="02")$semana=Segunda;
if($sem=="03")$semana=Tercera;
if($sem=="04")$semana=Cuarta;


xlsWriteLabel(0,0,"Incidencias y cumplimientos por municipio.");
if($semana)
xlsWriteLabel(1,0,"Semana:");
xlsWriteLabel(1,1,$semana);
xlsWriteLabel(1,3,"Mes:");
xlsWriteLabel(1,4,$tmes);
xlsWriteLabel(1,6,"Año:");
xlsWriteNumber(1,7,$ano);
xlsWriteLabel(1,8,"Fecha:");
xlsWriteLabel(1,9,date("d-m-Y"));
$f=3;

xlsWriteLabel($f,0,"Municipio"); 
xlsWriteLabel($f,1,"Precios que se distribuyeron en el mes");
xlsWriteLabel($f,2,"Incorporados en el sistema en fecha"); 
xlsWriteLabel($f,3,"Incorporados en el sistema fuera de fecha");
xlsWriteLabel($f,4,"Precios no observados en fecha y fuera de fecha"); 
/*xlsWriteLabel($f,5,"Precios no observados en fecha");
xlsWriteLabel($f,6,"Precios no observados fuera de fecha");*/
xlsWriteLabel($f,5,"Porcentaje de no observados en fecha y fuera de fecha");
xlsWriteLabel($f,6,"Precios no observados por no realizar la visita");
xlsWriteLabel($f,7,"Faltas ocasionales, definitivas o temporales"); 
xlsWriteLabel($f,8,"Porcentaje de observados respecto al total en fecha(%)");
xlsWriteLabel($f,9,"Porcentaje de observados respecto al total en fecha y fuera de fecha(%)"); 
xlsWriteLabel($f,10,"Cumplimiento en fecha(%)"); 
xlsWriteLabel($f,11,"Cumplimiento en fecha y fuera de fecha(%)");



$query_usuario = " where usuario='".$_SESSION["user"]."' and n_dpa.cod_dpa=usuario.cod_dpa"; 
$sql_usuario = "select rol, id_usuario, usuario.cod_dpa,prov_mun from usuario,n_dpa".$query_usuario;	
$rs_usuario = $db->Execute($sql_usuario)or $mensaje=$db->ErrorMsg() ;
$cod_dpa2=substr($rs_usuario->Fields("cod_dpa"),0,2)."%";
$cod_dpa=$rs_usuario->Fields("cod_dpa");
$rol=$rs_usuario->Fields("rol");

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




    $sem=$_GET["sem"];
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
$mes=$_GET["mes"];	
$ano=$_GET["ano"];

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

$mes=$_GET["mes"];	
$ano=$_GET["ano"];
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

$mes=$_GET["mes"];	
$ano=$_GET["ano"];

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

  $sem=$_GET["sem"];
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
$mes=$_GET["mes"];	
$ano=$_GET["ano"];

if($mes=="12")
{$mes_next="01";$ano_next=$ano+1;}
else
{$mes_next=$mes+1;$ano_next=$ano;}

$fecha_01_ini=$ano."/".$mes."/"."01";//esta fecha es para quedarme dentro del mes actual
$fecha_01_next=$ano_next."/".$mes_next."/"."01";//esta fecha es para quedarme dentro del mes actual
			 
$sql_cal = "select * from calendario where fecha_captar='".$fecha_base_ini."' and fecha_cal>='$fecha_01_ini' and fecha_cal<'$fecha_01_next' order by fecha_captar";		
$rs_cal = $db->Execute($sql_cal)or $mensaje=$db->ErrorMsg();//print $sql_cal;
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

$rs_cal->MoveFirst();
$fecha_cal_ini=$rs_cal->fields["fecha_cal"];

if($sem=="04" || $sem=="0")
$fecha_cierre_sem=$fecha_cal_cierre_sem4;
///-----------------------------------------------------



$query = "select distinct n_dpa.cod_dpa, prov_mun,cod_dpa_nueva,prov_mun_nuevo, count(id_var_estab) from n_var_estab, n_estab,n_dpa, b_variedad, n_variedad
where n_var_estab.idb_variedad=b_variedad.idb_variedad and b_variedad.id_variedad=n_variedad.id_variedad 
and n_estab.cod_dpa=n_dpa.cod_dpa and n_var_estab.id_estab=n_estab.id_estab 
and incluido='1' and n_variedad.ide_articulo!='1' and fecha_creacion<='".$fecha_cierre_sem."' and (fecha_desuso>'".$fecha_cierre_sem."' or n_var_estab.desuso='0')
";

$query.= "and n_var_estab.fecha_captar>='".$fecha_base_ini."' and n_var_estab.fecha_captar<='".$fecha_base_fin."' "; 
$query.= " group by n_dpa.cod_dpa, prov_mun, cod_dpa_nueva,prov_mun_nuevo order by n_dpa.cod_dpa";

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


  $cadenacheckboxp = "";
  if($rs->fields[0]!='')
{

	 	$rs->MoveFirst();
	$ch1=0;
	$mejor=1;
	$peor=100;
	
	/*$mes=$_POST["sel_mes"];	
	$ano=$_POST["sel_ano"];	
	$mes_fin=$mes;
	$ano_fin=$ano;*/
	
	
	
	  	while (!$rs->EOF)
	  	{
		$f++;

 if($mes!=0 and $ano!=0)
                  {
				  if($sem=="04" || $sem=="0")
				  $fecha_cierre_sem=$fecha_cal_cierre_sem4;
				   
                   $sql1 = "select count(captacion.id_var_estab) 
				  from captacion,n_var_estab, n_estab,n_dpa, b_variedad, n_variedad
				  where n_var_estab.idb_variedad=b_variedad.idb_variedad 
				  and b_variedad.id_variedad=n_variedad.id_variedad 
				  and n_estab.cod_dpa=n_dpa.cod_dpa 
				  and n_var_estab.id_estab=n_estab.id_estab 
				  and incluido='1' and n_variedad.ide_articulo!='1' and central='0' 
				  and n_var_estab.id_var_estab=captacion.id_var_estab 
				  and n_var_estab.fecha_captar>='".$fecha_base_ini."' and n_var_estab.fecha_captar<='".$fecha_base_fin."' 
				  and captacion.fecha>='".$fecha_cal_ini."' and captacion.fecha<'".$fecha_cierre_sem."' 
				  and fecha_creacion<='".$fecha_cierre_sem."' and (fecha_desuso>'".$fecha_cierre_sem."' or n_var_estab.desuso='0')
				  and n_dpa.cod_dpa='".$rs->fields["cod_dpa"]."'
				  group by n_dpa.cod_dpa order by n_dpa.cod_dpa";
				  //and fecha_creacion<='".$fecha_cal_ini."' and (fecha_desuso>'".$fecha_cierre_sem."' or n_var_estab.desuso='0')
				  //print $sql1."<br><br>";
				  $rs1 = $db->Execute($sql1)or die($db->ErrorMsg());
				  
				  $sql2 = "select count(captacion.id_var_estab) 
				  from captacion,n_var_estab, n_estab,n_dpa, b_variedad, n_variedad
				  where n_var_estab.idb_variedad=b_variedad.idb_variedad 
				  and b_variedad.id_variedad=n_variedad.id_variedad 
				  and n_estab.cod_dpa=n_dpa.cod_dpa 
				  and n_var_estab.id_estab=n_estab.id_estab 
				  and incluido='1' and n_variedad.ide_articulo!='1' and central='0' 
				  and n_var_estab.id_var_estab=captacion.id_var_estab 
				  and n_var_estab.fecha_captar>='".$fecha_base_ini."' and n_var_estab.fecha_captar<='".$fecha_base_fin."' 
				  and captacion.fecha>='".$fecha_cal_ini."' and captacion.fecha<'".$fecha_cierre_sem."'
				  and fecha_creacion<='".$fecha_cierre_sem."' and (fecha_desuso>'".$fecha_cierre_sem."' or n_var_estab.desuso='0')
				  and n_dpa.cod_dpa='".$rs->fields["cod_dpa"]."' 
				  and captacion.precio='0'
			 	  group by n_dpa.cod_dpa order by n_dpa.cod_dpa";
				  //print $sql2;
				  $rs2 = $db->Execute($sql2)or die($db->ErrorMsg());//no observados en fecha
				  
				 
				  $sql22 = "select count(captacion.id_var_estab) 
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
				  and n_dpa.cod_dpa='".$rs->fields["cod_dpa"]."' 
				  and captacion.precio='0'
			 	  group by n_dpa.cod_dpa order by n_dpa.cod_dpa";
				  //print $sql22."<br>";
				  $rs22 = $db->Execute($sql22)or die($db->ErrorMsg());//no observados en fecha y fuera de fecha
				  //and fecha_creacion<='".$fecha_cal_inicio_sem1."' and (fecha_desuso>'".$fecha_cal_cierre_sem4."' or n_var_estab.desuso='0')
				  
				  $sql4 = "select count(captacion.id_var_estab) 
				  from captacion,n_var_estab, n_estab,n_dpa, b_variedad, n_variedad
				  where n_var_estab.idb_variedad=b_variedad.idb_variedad 
				  and b_variedad.id_variedad=n_variedad.id_variedad 
				  and n_estab.cod_dpa=n_dpa.cod_dpa 
				  and n_var_estab.id_estab=n_estab.id_estab 
				  and incluido='1' and n_variedad.ide_articulo!='1' and central='0' 
				  and n_var_estab.id_var_estab=captacion.id_var_estab 
				  and n_var_estab.fecha_captar>='".$fecha_base_ini."' and n_var_estab.fecha_captar<='".$fecha_base_fin."' 
				  and captacion.fecha>='".$fecha_cal_cierre_sem4."' and captacion.fecha<'".$fecha_cal_cierre_sem4."' 
				  and n_dpa.cod_dpa='".$rs->fields["cod_dpa"]."' 
				  and captacion.precio='0' and id_inc='4'
			 	  group by n_dpa.cod_dpa order by n_dpa.cod_dpa";
				  //print $sql4;
				  $rs4 = $db->Execute($sql4)or die($db->ErrorMsg());
				  
				  $sql5 = "select count(captacion.id_var_estab) 
				  from captacion,n_var_estab, n_estab,n_dpa, b_variedad, n_variedad
				  where n_var_estab.idb_variedad=b_variedad.idb_variedad 
				  and b_variedad.id_variedad=n_variedad.id_variedad 
				  and n_estab.cod_dpa=n_dpa.cod_dpa 
				  and n_var_estab.id_estab=n_estab.id_estab 
				  and incluido='1' and n_variedad.ide_articulo!='1' and central='0' 
				  and n_var_estab.id_var_estab=captacion.id_var_estab 
				  and n_var_estab.fecha_captar>='".$fecha_base_ini."' and n_var_estab.fecha_captar<='".$fecha_base_fin."' 
				  and captacion.fecha>='".$fecha_cal_inicio_sem1."' and captacion.fecha<'".$fecha_cal_cierre_sem4."'  
				  and n_dpa.cod_dpa='".$rs->fields["cod_dpa"]."' 
				  and captacion.precio='0' and (id_obs='5' or id_obs='3' or id_obs='2') and id_inc='1'
				  and fecha_creacion<='".$fecha_cierre_sem."' and (fecha_desuso>'".$fecha_cal_cierre_sem4."' or n_var_estab.desuso='0')
			 	  group by n_dpa.cod_dpa order by n_dpa.cod_dpa";
				  //print $sql5;
				  $rs5 = $db->Execute($sql5)or die($db->ErrorMsg());
				  
				  if($sem!="04")
				  {
				  $sql6 = "select count(captacion.id_var_estab) 
				  from captacion,n_var_estab, n_estab,n_dpa, b_variedad, n_variedad
				  where n_var_estab.idb_variedad=b_variedad.idb_variedad 
				  and b_variedad.id_variedad=n_variedad.id_variedad 
				  and n_estab.cod_dpa=n_dpa.cod_dpa 
				  and n_var_estab.id_estab=n_estab.id_estab 
				  and incluido='1' and n_variedad.ide_articulo!='1' and central='0' 
				  and n_var_estab.id_var_estab=captacion.id_var_estab 
				  and n_var_estab.fecha_captar>='".$fecha_base_ini."' and n_var_estab.fecha_captar<='".$fecha_base_fin."' 
				  and captacion.fecha>='".$fecha_cierre_sem."' and captacion.fecha<'".$fecha_01_next."' 
				  and fecha_creacion<='".$fecha_cierre_sem."' and (fecha_desuso>'".$fecha_01_next."' or n_var_estab.desuso='0')
				  and n_dpa.cod_dpa='".$rs->fields["cod_dpa"]."'
			 	  group by n_dpa.cod_dpa order by n_dpa.cod_dpa";
				  //print $sql6."<br><br>";
				  //and fecha_creacion<='".$fecha_cal_ini."' and (fecha_desuso>'".$fecha_01_next."' or n_var_estab.desuso='0')
				  $rs6 = $db->Execute($sql6)or die($db->ErrorMsg());
				  
				
				  }
                  }

$count22=$rs22->fields["count"];
$count2=$rs2->fields["count"];
$count6=$rs6->fields["count"];
if($sem=="04")
{$count22=$count2;$count6="";}


 if($rs1->fields["count"]!=0)
 $porc=$count22/($rs1->fields["count"]+$count6);//porcentajeno observados en fecha y fuera de fecha
 
$prov_mun=$rs->fields["prov_mun_nuevo"];
$cod_dpa=$rs->fields["cod_dpa_nueva"];

$dpa=$cod_dpa.". ".$prov_mun; 
xlsWriteLabel($f,0,$dpa); 




if(substr($rs->fields["cod_dpa"],0,2)=="03")$ch=$ch+$rs->fields["count"];$cuba=$cuba+$rs->fields["count"];
xlsWriteNumber($f,1,$rs->fields["count"]);




if($rs1->fields["count"]>$rs->fields["count"]) $digitadas=$rs->fields["count"];else $digitadas=$rs1->fields["count"];if(substr($rs->fields["cod_dpa"],0,2)=="03")$ch1=$ch1+$digitadas;$cuba1=$cuba1+$digitadas;
xlsWriteNumber($f,2,$digitadas); 





$fuera_fecha=$count6;if(substr($rs->fields["cod_dpa"],0,2)=="03")$ch6=$ch6+$fuera_fecha; $cuba6=$cuba6+$fuera_fecha;
xlsWriteNumber($f,3,$fuera_fecha);




if(substr($rs->fields["cod_dpa"],0,2)=="03")$ch22=$ch22+$count22; $cuba22=$cuba22+$count22;if($sem!="04")$dos=$count22; else $dos=$count2;
xlsWriteNumber($f,4,$dos); 




if(substr($rs->fields["cod_dpa"],0,2)=="03")$ch2=$ch2+$count2; $cuba2=$cuba2+$count2;
//xlsWriteNumber($f,5,$count2);




if($sem!="04" && $sem!="0"){$pnff=$count22-$count2;if(substr($rs->fields["cod_dpa"],0,2)=="03")$ch_pnff=$ch_pnff+$pnff; $cuba_pnff=$cuba_pnff+$pnff;}
//xlsWriteNumber($f,6,$pnff);$pnff=="";





xlsWriteNumber($f,5,round($porc*100,1));$porc="";





if(substr($rs->fields["cod_dpa"],0,2)=="03")$ch4=$ch4+$rs4->fields["count"];$cuba4=$cuba4+$rs4->fields["count"];
xlsWriteNumber($f,6,$rs4->fields["count"]);




if(substr($rs->fields["cod_dpa"],0,2)=="03")$ch5=$ch5+$rs5->fields["count"]; $cuba5=$cuba5+$rs5->fields["count"];
xlsWriteNumber($f,7,$rs5->fields["count"]); 



	 $porc_en_fec_y_no=round(($digitadas+$fuera_fecha-$count22)/$rs->fields["count"]*100,1);
	 //print $porc_en_fec_y_no."  = ".$digitadas." + ".$fuera_fecha." - ".$count22." / ".$rs->fields["count"]; 
	 $porc3=round($digitadas/$rs->fields["count"]*100,1);//cumplimiento en fecha
	 $porc6=round(($digitadas+$fuera_fecha)/$rs->fields["count"]*100,1);//cumplimiento en fecha y fuera de fecha
	 
	 
	 
if($digitadas!=0)$porc2=round(($digitadas-$rs2->fields["count"])/$rs->fields["count"]*100,1);
xlsWriteNumber($f,8,$porc2);





xlsWriteNumber($f,9,$porc_en_fec_y_no); 



xlsWriteNumber($f,10,$porc3);

xlsWriteNumber($f,11,$porc6);$porc6="";

 
		$prom=($porc2+$porc3)/2;if($mejor<$prom){$mejor=$prom;$mejor_dpa=$dpa;}
    	$prom=($porc2+$porc3)/2;if($peor>$prom){$peor=$prom;$peor_dpa=$dpa;}
		$porc2=0;
		
		

	  	$rs->MoveNext();
	  	}
  	}

  		
if($ch1!=0 || $ch6!=0)$porc_ch=$ch22/($ch1+$ch6); if($porc_ch!="")//print $porc_ch."  ".$ch22."  ".$ch1;//porcentaje de no observados en ch

if($ch!="0")$porc2_ch=round(($ch1-$ch2)/$ch*100,1);//porcentaje de observados respecto al total en fecha
	
if($ch!="0")$porc_ch_en_f_y_fuera=round(($ch1+$ch6-$ch22)/$ch*100,1);//porcentaje de observados respecto al total en fecha y fuera de fecha
//print $porc_ch_en_f_y_fuera." = ".$ch1." + ".$ch6." - ".$ch22." / ".$ch;
	
if($cuba1!=0 || $cuba6!=0)$porc_cuba=$cuba22/($cuba1+$cuba6);//porcentaje de no observados en cuba 

if($cuba!="0" && $cuba!="")$porc2_cuba=round(($cuba1-$cuba2)/$cuba*100,1);//porcentaje de observados respecto al total en fecha
if($cuba!="0")$porc_cuba_en_f_y_fuera=round(($cuba1+$cuba6-$cuba22)/$cuba*100,1);//porcentaje de observados respecto al total en fecubaa y fuera de fecubaa
		
		
if($ch!="0" && $ch!="")$porc3_ch=round($ch1/$ch*100,1);//cumplimiento en fecha
if($ch!="0" && $ch!="")$porc6_ch=round(($ch1+$ch6)/$ch*100,1);//cumplimiento en fecha y fuera de fecha
//print $porc6_ch." = ".$ch1." + ".$ch6." / ".$ch;

if($cuba!="0" && $cuba!="")$porc3_cuba=round($cuba1/$cuba*100,1);//cumplimiento en fecha
if($cuba!="0" && $cuba!="")$porc6_cuba=round(($cuba1+$cuba6)/$cuba*100,1);//cumplimiento en fecha y fuera de fecha
  
  
  $f=$f+2;
  
xlsWriteLabel($f,0,"2300. La Habana"); 
xlsWriteNumber($f,1,$ch);
xlsWriteNumber($f,2,$ch1); 
xlsWriteNumber($f,3,$ch6);
xlsWriteNumber($f,4,$ch22); 
/*xlsWriteNumber($f,5,$ch2);

if($sem=="04" || $sem=="0"){$ch_pnff="";}
xlsWriteNumber($f,6,$ch_pnff);*/

xlsWriteNumber($f,5,round($porc_ch*100,1));
xlsWriteNumber($f,6,$ch4);
xlsWriteNumber($f,7,$ch5); 
xlsWriteNumber($f,8,$porc2_ch);
xlsWriteNumber($f,9,$porc_ch_en_f_y_fuera); 
xlsWriteNumber($f,10,$porc3_ch); 
xlsWriteNumber($f,11,$porc6_ch);
  

  $f=$f+1;

xlsWriteLabel($f,0,"Total Cuba"); 
xlsWriteNumber($f,1,$cuba);
xlsWriteNumber($f,2,$cuba1); 
xlsWriteNumber($f,3,$cuba6);
xlsWriteNumber($f,4,$cuba22); 
/*xlsWriteNumber($f,5,$cuba2);

if($sem=="04" || $sem=="0"){$cuba_pnff="";}
xlsWriteNumber($f,6,$cuba_pnff);*/

xlsWriteNumber($f,5,round($porc_cuba*100,1));
xlsWriteNumber($f,6,$cuba4);
xlsWriteNumber($f,7,$cuba5); 
xlsWriteNumber($f,8,$porc2_cuba);
xlsWriteNumber($f,9,$porc_cuba_en_f_y_fuera); 
xlsWriteNumber($f,10,$porc3_cuba); 
xlsWriteNumber($f,11,$porc6_cuba);  
  
$f=$f+2;
  
  
xlsWriteLabel($f,0,"Mejor DPA:"); 
xlsWriteLabel($f,1,$mejor_dpa);  

$f=$f+1;

xlsWriteLabel($f,0,"Peor DPA:"); 
xlsWriteLabel($f,1,$peor_dpa); 
xlsEOF();  
   
  
?>
  
  
