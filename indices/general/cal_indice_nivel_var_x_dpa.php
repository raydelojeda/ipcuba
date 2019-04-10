<?php 
$x="../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."php/session/session_admin.php");
include($x."php/clases/medias.php");
include($x."administracion/config/fechas.php");

$fecha=$fecha_cal_inicio_sem1_next;


$nombre_archivo = "ejecutado.txt";
$gestor = fopen($nombre_archivo, "r");
$contenido = fread($gestor, filesize($nombre_archivo));
fclose($gestor);

if($contenido=="1")
header("Location:../../administracion/config/admin.php?msg=Debe ejecutar el Cálculo de índices a nivel de artículo en cada municipio usando media geométrica.");

if($contenido=="2")
header("Location:../../administracion/config/admin.php?msg=Debe ejecutar el Cálculo de índices a nivel de artículo nacional usando media aritmética simple.");

if($contenido=="3")
header("Location:../../administracion/config/admin.php?msg=Debe ejecutar el Cálculo de índices a niveles superiores nacional usando media aritmética ponderada.");

if($contenido=="4")
header("Location:../../administracion/config/admin.php?msg=Debe ejecutar el Cálculo del lndice general nacional usando media aritmética ponderada.");

//die();
$relativos = array();	
$count="";

		
$sql_sel_dpa = "select * from n_dpa where incluido='1' order by cod_dpa";// and cod_dpa_nueva='2609' 
$rs_sel_dpa = $db->Execute($sql_sel_dpa) or die($db->ErrorMsg());

$cant_dpa=$rs_sel_dpa->RecordCount();
$rs_sel_dpa->MoveFirst();
for($dpa=1;$dpa<=$cant_dpa;$dpa++)
{

$cod_dpa=$rs_sel_dpa->Fields('cod_dpa');
	
$sql_sel_variedad = "select distinct n_variedad.id_variedad
from n_estab, n_var_estab, b_variedad, n_variedad, captacion as cap_ant, captacion 
WHERE cap_ant.fecha>='$fecha_cal_inicio_sem1_pasada' 
and cap_ant.fecha<'$fecha_cal_inicio_sem1_actual' 
and captacion.fecha>='$fecha_cal_inicio_sem1_actual' 
and captacion.fecha<'$fecha_cal_inicio_sem1_next' 

and captacion.id_var_estab=cap_ant.id_var_estab and captacion.id_var_estab=n_var_estab.id_var_estab 
and captacion.precio!=0 and cap_ant.precio!=0
and b_variedad.idb_variedad=n_var_estab.idb_variedad and n_variedad.id_variedad=b_variedad.id_variedad 
and n_var_estab.id_estab=n_estab.id_estab and n_estab.cod_dpa='".$cod_dpa."' 

and (n_estab.desuso='0' or fecha_sus>='$fecha_cal_inicio_sem1_next') 
and (n_var_estab.desuso='0' or fecha_desuso>='$fecha_cal_inicio_sem1_next') and n_variedad.ide_articulo!='1' and captacion.va_a_calculo='1'
and fecha_captar >='".$fecha_base."' order by n_variedad.id_variedad";//print $sql_sel_variedad;die(); and ecod_var='02.1.1.1.01.06' 
$rs_sel_variedad = $db->Execute($sql_sel_variedad) or die($db->ErrorMsg());

$cant_variedad=$rs_sel_variedad->RecordCount();
$rs_sel_variedad->MoveFirst();
for($var=1;$var<=$cant_variedad;$var++)
{ 
	$id_variedad=$rs_sel_variedad->Fields('id_variedad');
	
	$sql_sel_bvariedad = "select distinct b_variedad.idb_variedad 
	from n_estab, n_var_estab, b_variedad, captacion as cap_ant, captacion 
	WHERE cap_ant.fecha>='$fecha_cal_inicio_sem1_pasada' 
	and cap_ant.fecha<'$fecha_cal_inicio_sem1_actual' 
	and captacion.fecha>='$fecha_cal_inicio_sem1_actual' 
	and captacion.fecha<'$fecha_cal_inicio_sem1_next'  
	
	and captacion.id_var_estab=cap_ant.id_var_estab and captacion.id_var_estab=n_var_estab.id_var_estab 
	and captacion.precio!=0 and cap_ant.precio!=0 and captacion.va_a_calculo='1'
	and b_variedad.idb_variedad=n_var_estab.idb_variedad
	and n_var_estab.id_estab=n_estab.id_estab and n_estab.cod_dpa='".$cod_dpa."' 
	
	and (n_estab.desuso='0' or fecha_sus>='$fecha_cal_inicio_sem1_next') 
and (n_var_estab.desuso='0' or fecha_desuso>='$fecha_cal_inicio_sem1_next') and fecha_captar >='".$fecha_base."' and id_variedad='".$id_variedad."'"; //print $sql_sel_bvariedad;die();
	$rs_sel_bvariedad = $db->Execute($sql_sel_bvariedad) or die($db->ErrorMsg());
	
	$cant_bvariedad=$rs_sel_bvariedad->RecordCount();
	$rs_sel_bvariedad->MoveFirst();	
	for($bvar=1;$bvar<=$cant_bvariedad;$bvar++)
	{ 
		
		$idb_variedad=$rs_sel_bvariedad->Fields('idb_variedad');
		//cap_ant.fecha as f_ant,captacion.fecha as f_act, cap_ant.precio as p_ant,	captacion.precio as p_act,, captacion.id_var_estab, fecha_captar, id_estab_sustituido,fecha_sus, unidad,tipologia, cod_estab,dir,n_estab.cod_dpa,n_estab.id_estab, estab, mercado, n_mercado.id_mercado, cantidad
		//n_mercado, n_unidad, n_tipologia
		//and n_var_estab.id_unidad=n_unidad.id_unidad AND n_tipologia.id_tipologia=n_estab.id_tipologia and n_mercado.id_mercado=n_estab.id_mercado 
		$sql_captacion = "SELECT captacion.precio/cap_ant.precio as relat
		
		FROM captacion as cap_ant, captacion, n_var_estab, 
		n_estab 
		
		WHERE cap_ant.fecha>='$fecha_cal_inicio_sem1_pasada' 
		and cap_ant.fecha<'$fecha_cal_inicio_sem1_actual' 
		and captacion.fecha>='$fecha_cal_inicio_sem1_actual' 
		and captacion.fecha<'$fecha_cal_inicio_sem1_next' 			
		and captacion.id_var_estab=cap_ant.id_var_estab 			
		and captacion.va_a_calculo='1'
		
		and n_estab.cod_dpa='".$cod_dpa."'
		
		and (n_estab.desuso='0' or fecha_sus>='$fecha_cal_inicio_sem1_next') 
		and (n_var_estab.desuso='0' or fecha_desuso>='$fecha_cal_inicio_sem1_next') 
		and captacion.id_var_estab=n_var_estab.id_var_estab 		
		and n_var_estab.id_estab=n_estab.id_estab 		
		
		and captacion.precio!=0 and cap_ant.precio!=0
		and fecha_captar >='".$fecha_base."' and idb_variedad='".$idb_variedad."'";//print $sql_captacion."<br>";die();
		$rs_captacion = $db->Execute($sql_captacion)or die($db->ErrorMsg());
		$cant_cap=$rs_captacion->RecordCount();
		
		for($cap=1;$cap<=$cant_cap;$cap++)
		{ 			
			$relat=$rs_captacion->Fields('relat');
			if($relat!="" && $relat!=0)
			{								
				$count=count($relativos);
				$relativos[$count]=$relat;		  
			//print $relativos[$count]."  ".$count."<br>";
			}
					
		$rs_captacion->MoveNext();   
		}			
	$rs_sel_bvariedad->MoveNext();   
	}
	
	if($relativos[0])
	{
		$obj = new medias;
		$indice=$obj->geo($relativos);
	 //print "indice=".$indice."<br>";//die();
		
		foreach ($relativos as $g => $valorg) {unset($relativos[$g]);}		
		//$d=$d+1;
		//print $d;		
		$sql_sel_ivar = "SELECT id_var_dpa FROM i_var_dpa 
		WHERE cod_dpa='".$cod_dpa."' and id_variedad='".$id_variedad."' and fecha='$fecha'";
		//print $sql_sel_ivar."<br>";//die();								
		$rs_sel_ivar = $db->Execute($sql_sel_ivar) or die($db->ErrorMsg());
		
		$id_var_dpa=$rs_sel_ivar->Fields('id_var_dpa');	
		
		if($id_var_dpa!='')
		{
			$sql_upd_ivar = "UPDATE i_var_dpa SET fecha='".$fecha."', indice ='".$indice."' WHERE id_var_dpa='".$id_var_dpa."'";//print $sql_upd_ivar.$var."<br>";
			$rs_upd_ivar = $db->Execute($sql_upd_ivar) or die($db->ErrorMsg()); //
		}
		else
		{
			$sql_ins_ivar = "INSERT INTO i_var_dpa (fecha,indice,id_variedad,cod_dpa) 
			VALUES('".$fecha."','".$indice."','".$id_variedad."','".$cod_dpa."')";//print $sql_ins_ivar."   ".$var."<br>";	
			$rs_ins_ivar = $db->Execute($sql_ins_ivar) or die($db->ErrorMsg());
		}
	}
	
   $rs_sel_variedad->MoveNext();   
}//llave del for de n_variedad


  
  
  $rs_sel_dpa->MoveNext();   
}//llave del for de n_dpa


if($rs_ins_ivar || $rs_upd_ivar)
{
unlink("ejecutado.txt");
$gestor = @fopen("ejecutado.txt", "a");
	if ($gestor) 
	{
	   
	   if (fwrite($gestor, "1") === FALSE) 
		{
			echo "No se puede escribir al archivo.";
			exit;
		}
		fclose($gestor);
	}
}

 
$mes=$mes1;
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
if($mes=="12")$fecha_text= "Diciembre";
//header("Location:../../administracion/config/admin.php?msg=Se ejecutó satisfactoriamente el cálculo de índices a nivel de variedad en cada municipio usando media geométrica para el mes de ".$fecha_text.".");

?>

<html>
<body>
<form id="frm" name="frm" method="post" action="../../administracion/config/admin.php">
  <input type="text" name="msg" id="msg" value="<?php print "Se ejecutó satisfactoriamente el cálculo de índices a nivel de variedad en cada municipio usando media geométrica para el mes de ".$fecha_text.".";?>" />
</form>
 <script language="JavaScript" type="text/javascript">
	 document.frm.action="../../administracion/config/admin.php";
	 document.frm.submit();
</script>
</body>
</html>