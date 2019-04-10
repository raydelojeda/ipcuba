<?php 
$x="../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."php/session/session_admin.php");
include($x."php/clases/medias.php");

$obj = new medias;
$relativos = array();	

$nombre_archivo = "ejecutado.txt";
$gestor = fopen($nombre_archivo, "r");
$contenido = fread($gestor, filesize($nombre_archivo));
fclose($gestor);

if($contenido=="0")
header("Location:../../administracion/config/admin.php?msg=Debe ejecutar el Cálculo de índices a nivel de variedad en cada municipio usando media geométrica.");

if($contenido=="1")
header("Location:../../administracion/config/admin.php?msg=Debe ejecutar el Cálculo de índices a nivel de artículo en cada municipio usando media geométrica.");

if($contenido=="3")
header("Location:../../administracion/config/admin.php?msg=Debe ejecutar el Cálculo de índices a niveles superiores nacional usando media aritmética ponderada.");

if($contenido=="4")
header("Location:../../administracion/config/admin.php?msg=Debe ejecutar el Cálculo del lndice general nacional usando media aritmética ponderada.");
//print $contenido;
//die();

//---------------------------------------------------
$sql_fecha_base = "select max(fecha) from b_variedad";
$rs_fecha_base = $db->Execute($sql_fecha_base) or die($db->ErrorMsg());
$fecha_base = $rs_fecha_base->Fields('max');
//---------------------------------------------------


//---------------------------------------------------
$sql_fecha_d_var_dpa = "select distinct fecha from d_var_dpa order by fecha desc";
$rs_fecha_d_var_dpa = $db->Execute($sql_fecha_d_var_dpa) or die($db->ErrorMsg());
$fecha_d_var_dpa = $rs_fecha_d_var_dpa->Fields('fecha');
$rs_fecha_d_var_dpa->MoveNext();
$fecha_d_var_dpa_ant = $rs_fecha_d_var_dpa->Fields('fecha');//print $fecha_d_var_dpa."  ".$fecha_d_var_dpa_ant;die();
//---------------------------------------------------

$sql_moneda = "select distinct id_mercado_nuevo from n_mercado";		
$rs_moneda = $db->Execute($sql_moneda)or die($db->ErrorMsg()) ;
$cant_moneda=$rs_moneda->RecordCount();

$rs_moneda->MoveFirst();
for($mon=1;$mon<=$cant_moneda;$mon++)
{
	$id_mercado_nuevo=$rs_moneda->Fields('id_mercado_nuevo');

	$sql_sel_n_art = "select distinct idb_articulo, e_articulo.ide_articulo from e_articulo,b_articulo
	where e_articulo.ide_articulo=b_articulo.ide_articulo and fecha='$fecha_base'
	and e_articulo.ide_articulo!='1' and b_articulo.id_mercado_nuevo='$id_mercado_nuevo'";//print $sql_sel_n_art;die();//where fecha='$fecha_i_var_dpa'
	$rs_sel_n_art = $db->Execute($sql_sel_n_art) or die($db->ErrorMsg());
	
	$cant_n_art=$rs_sel_n_art->RecordCount();
	$rs_sel_n_art->MoveFirst();
	for($n_art=1;$n_art<=$cant_n_art;$n_art++)
	{ 
		$idb_articulo=$rs_sel_n_art->Fields('idb_articulo');
		$ide_articulo=$rs_sel_n_art->Fields('ide_articulo');	
	
		$sql_sel_art = "select indice, fecha, idb_articulo from d_art_dpa 
		where idb_articulo='$idb_articulo' and fecha='$fecha_d_var_dpa' ";//print $sql_sel_art;die();//where fecha='$fecha_i_var_dpa'GROUP BY fecha,idb_articulo
		$rs_sel_art = $db->Execute($sql_sel_art) or die($db->ErrorMsg());
		
		$cant_art=$rs_sel_art->RecordCount();
		$rs_sel_art->MoveFirst();
		for($art=1;$art<=$cant_art;$art++)
		{	
			$indice_art=$rs_sel_art->Fields('indice');
			
			$count_i_a=count($matriz_art);//print "count".$count."<br>";
			$matriz_art[$count_i_a]=$indice_art;		
			
		$rs_sel_art->MoveNext();   
		}//llave del for 
			
			if($matriz_art[0]!="")
				{
					$indice_art_geo=$obj->geo($matriz_art);						
					foreach ($matriz_art as $f => $valorf) {unset($matriz_art[$f]);}				
					$count_i_a=0;
				}
		
		
				
			if($fecha_d_var_dpa_ant!="")
			{	
				$sql_sel_dart_ant = "SELECT indice FROM d_articulo 
				WHERE idb_articulo='".$idb_articulo."' and fecha='$fecha_d_var_dpa_ant'";//print $sql_sel_dart_ant."<br>";//die();								
				$rs_sel_dart_ant = $db->Execute($sql_sel_dart_ant) or die($db->ErrorMsg());
				
				$indice_ant=$rs_sel_dart_ant->Fields('indice');//print $indice_ant;
			}
			
			if($indice_ant!="")
			{//$indice_art=1;
			$indice_art_geo=$indice_art_geo*$indice_ant;}
		
		//----------------------------------------------------------------------------
		//----------------------------------------------------------------------------					
		
			$sql_sel_dart = "SELECT idd_articulo FROM d_articulo 
			WHERE idb_articulo='".$idb_articulo."' and fecha='$fecha_d_var_dpa'";//print $sql_sel_iart."<br>";//die();								
			$rs_sel_dart = $db->Execute($sql_sel_dart) or die($db->ErrorMsg());
			
			$idd_articulo=$rs_sel_dart->Fields('idd_articulo');
			
			if($idd_articulo!='')
			{
				$sql_upd_dart = "UPDATE d_articulo SET fecha='".$fecha_d_var_dpa."', indice ='".$indice_art_geo."' 
				WHERE idd_articulo='".$idd_articulo."'";//print $sql_upd_dart."<br>";
				$rs_upd_dart = $db->Execute($sql_upd_dart) or die($db->ErrorMsg()); 
			}
			else
			{
				$sql_ins_dart = "INSERT INTO d_articulo (fecha,indice,idb_articulo) 
				VALUES('".$fecha_d_var_dpa."','".$indice_art_geo."','".$idb_articulo."')";//print $sql_ins_dart."<br>";	
				$rs_ins_dart = $db->Execute($sql_ins_dart) or die($db->ErrorMsg());
			}
		
		//----------------------------------------------------------------------------
		//----------------------------------------------------------------------------
		
	$rs_sel_n_art->MoveNext();   
	}//llave del for 
	
$rs_moneda->MoveNext();
}

if($rs_ins_dart || $rs_upd_dart)
{
unlink("ejecutado.txt");
$gestor = @fopen("ejecutado.txt", "a");
	if ($gestor) 
	{
	   
	   if (fwrite($gestor, "3") === FALSE) 
		{
			echo "No se puede escribir al archivo.";
			exit;
		}
		fclose($gestor);
	}
}
/*
//--------------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DEL MES PASADO--------------------------------
$fecha_cierre_sem4_1=substr($fecha_base,0,8)."04";

$mes1=date("m");
$ano1=date("Y");
if($mes1=="01")
{$mes_ant1="12";$ano_ant1=$ano1-1;}
else
{$mes_ant1=$mes1-1;$ano_ant1=$ano1;}

if(strlen($mes_ant1)==1)
$mes_ant1=0 .$mes_ant1;

$fecha_01_fin1=$ano1."/".$mes1."/"."01";//esta fecha es para quedarme dentro del mes actual
$fecha_01_ini1=$ano_ant1."/".$mes_ant1."/"."01";//esta fecha es para quedarme dentro del mes actual

$sql_cal = "select * from calendario where fecha_captar='".$fecha_cierre_sem4_1."' 
and fecha_cal>='$fecha_01_ini1' and fecha_cal<'$fecha_01_fin1' order by fecha_captar";		
$rs_cal = $db->Execute($sql_cal) or die($db->ErrorMsg());//print $sql_cal;die();
$fecha_cal_inicio_sem1_pasada=$rs_cal->fields["fecha_cal"];
//--------------------------------PARA OBETENER LA FECHA DEL INICIO DE SEMANA 1 DEL MES PASADO--------------------------------

$mes=substr($fecha_cal_inicio_sem1_pasada,5,2);
if($mes=="01")$fecha_text= "Enero";
if($mes=="02")$fecha_text= "Febrero";
if($mes=="03")$fecha_text= "Marzo";
if($mes=="04")$fecha_text= "Abril";
if($mes=="05")$fecha_text= "Mayo";
if($mes=="06")$fecha_text= "Junio";
if($mes=="07")$fecha_text= "Julio";
if($mes=="08")$fecha_text= "Agosto";
if($mes=="09")$fecha_text= "Septiembre";
if($mes=="10")$fecha_text= "Octubre";
if($mes=="11")$fecha_text= "Noviembre";
if($mes=="12")$fecha_text= "Diciembre";*/
header("Location:../../administracion/config/admin.php?msg=Se ejecutó satisfactoriamente el cálculo de índices a nivel de artículo a nivel nacional usando media aritmética para la fecha: ".$fecha_d_var_dpa.".");
?>
