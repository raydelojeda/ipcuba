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

if($contenido=="2")
header("Location:../../administracion/config/admin.php?msg=Debe ejecutar el Cálculo de índices a nivel de artículo nacional usando media aritmética simple.");

if($contenido=="3")
header("Location:../../administracion/config/admin.php?msg=Debe ejecutar el Cálculo de índices a niveles superiores nacional usando media aritmética ponderada.");

if($contenido=="4")
header("Location:../../administracion/config/admin.php?msg=Debe ejecutar el Cálculo del lndice general nacional usando media aritmética ponderada.");

/*if($contenido!="1")
print $contenido;
die();*/

//---------------------------------------------------
$sql_fecha_base = "select max(fecha) from b_variedad";
$rs_fecha_base = $db->Execute($sql_fecha_base) or die($db->ErrorMsg());
$fecha_base = $rs_fecha_base->Fields('max');
//---------------------------------------------------


//---------------------------------------------------
$sql_fecha_d_var_dpa = "select max(fecha) from d_var_dpa";
$rs_fecha_d_var_dpa = $db->Execute($sql_fecha_d_var_dpa) or die($db->ErrorMsg());
$fecha_d_var_dpa = $rs_fecha_d_var_dpa->Fields('max');
//---------------------------------------------------


$sql_sel_dpa = "select * from n_dpa where incluido='1' order by cod_dpa"; 
$rs_sel_dpa = $db->Execute($sql_sel_dpa) or die($db->ErrorMsg());

$cant_dpa=$rs_sel_dpa->RecordCount();
$rs_sel_dpa->MoveFirst();
for($dpa=1;$dpa<=$cant_dpa;$dpa++)
{
	$cod_dpa=$rs_sel_dpa->Fields('cod_dpa');

	$sql_sel_articulo = "select distinct ide_articulo from d_var_dpa, n_variedad, b_variedad
	where n_variedad.id_variedad=b_variedad.id_variedad and b_variedad.idb_variedad=d_var_dpa.idb_variedad 
	and cod_dpa='".$cod_dpa."' and d_var_dpa.fecha='".$fecha_d_var_dpa."'
	and ide_articulo!='1' order by ide_articulo";//print $sql_sel_articulo."<br><br>";//die();  and ecod_var='01.1.1.1.01.02'
	$rs_sel_articulo = $db->Execute($sql_sel_articulo) or die($db->ErrorMsg());
	
	$cant_articulo=$rs_sel_articulo->RecordCount();
	$rs_sel_articulo->MoveFirst();
	
	for($e_art=1;$e_art<=$cant_articulo;$e_art++)
	{
		$ide_articulo=$rs_sel_articulo->Fields('ide_articulo');

		$sql_moneda = "select distinct id_mercado_nuevo from n_mercado";		
		$rs_moneda = $db->Execute($sql_moneda)or die($db->ErrorMsg()) ;
		$cant_moneda=$rs_moneda->RecordCount();
		
		$rs_moneda->MoveFirst();
		for($mon=1;$mon<=$cant_moneda;$mon++)
		{
			$id_mercado_nuevo=$rs_moneda->Fields('id_mercado_nuevo');
		
			$sql_mercado = "select id_mercado from n_mercado where id_mercado_nuevo='$id_mercado_nuevo'";		
			$rs_mercado = $db->Execute($sql_mercado)or die($db->ErrorMsg()) ;
			$cant_mercado=$rs_mercado->RecordCount();
			
			$rs_mercado->MoveFirst();
			for($mer=1;$mer<=$cant_mercado;$mer++)
			{		
				$id_mercado=$rs_mercado->Fields('id_mercado');
		
				$sql_sel_d_var_dpa = "select d_var_dpa.indice, variedad from d_var_dpa, n_variedad, b_variedad 
				where b_variedad.idb_variedad=d_var_dpa.idb_variedad and cod_dpa='".$cod_dpa."' 
				and d_var_dpa.fecha='".$fecha_d_var_dpa."' and n_variedad.id_variedad=b_variedad.id_variedad 
				and ide_articulo='$ide_articulo' and b_variedad.id_mercado='$id_mercado'";//print $sql_sel_d_var_dpa."<br>";//die();
				$rs_sel_d_var_dpa = $db->Execute($sql_sel_d_var_dpa) or die($db->ErrorMsg());
				
				$cant_d_var_dpa=$rs_sel_d_var_dpa->RecordCount();
				$rs_sel_d_var_dpa->MoveFirst();
				for($d_var_dpa=1;$d_var_dpa<=$cant_d_var_dpa;$d_var_dpa++)
				{ 
					$indice_var=$rs_sel_d_var_dpa->Fields('indice');
					$variedad=$rs_sel_d_var_dpa->Fields('variedad');
					if($indice_var!="" && $indice_var!=0)
					{	
						/*print "i:  ".$d_var_dpa."<br>";	
						print "dpa:  ".$cod_dpa."<br>";		
						print "var:  ".$variedad."<br>";					
						print "ind:  ".$indice_var."<br><br>";*/
						$count_geo=count($geo_art_dpa);
						$geo_art_dpa[$count_geo]=$indice_var;
					}
					
				$rs_sel_d_var_dpa->MoveNext();   		
				}									
					
			$rs_mercado->MoveNext();
			}	
			
		if($geo_art_dpa[0]!="")
			{
				$indice_art_geo=$obj->geo($geo_art_dpa);//print "IND_GEO:  ".$indice_art_geo."<br><br>";						
				foreach ($geo_art_dpa as $f => $valorf) {unset($geo_art_dpa[$f]);}
				$count_geo=0;
			}
			
		$sql_b_articulo = "SELECT idb_articulo FROM b_articulo, n_mercado 
		WHERE n_mercado.id_mercado_nuevo=b_articulo.id_mercado_nuevo and n_mercado.id_mercado_nuevo='$id_mercado_nuevo' and ide_articulo='$ide_articulo'";//print $sql_b_articulo."<br>";
		$rs_b_articulo = $db->Execute($sql_b_articulo) or die($db->ErrorMsg());			
		$idb_articulo=$rs_b_articulo->Fields('idb_articulo');
	
		if($idb_articulo && $indice_art_geo)
		{
			//------------------------------------------------------------------------------------------
			//------------------------------------------------------------------------------------------
			
			$sql_sel_dart = "SELECT idd_art_dpa FROM d_art_dpa 
			WHERE d_art_dpa.idb_articulo='$idb_articulo' and cod_dpa='".$cod_dpa."' 
			and d_art_dpa.fecha='$fecha_d_var_dpa'";//print $sql_sel_dart."<br>";die();								
			$rs_sel_dart = $db->Execute($sql_sel_dart) or die($db->ErrorMsg().$sql_b_articulo.$indice_art_geo.$sql_sel_d_var_dpa);
			
			$idd_art_dpa=$rs_sel_dart->Fields('idd_art_dpa');
		   
			if($idd_art_dpa!='')
			{
				$sql_upd_dart = "UPDATE d_art_dpa SET fecha='".$fecha_d_var_dpa."', indice ='".$indice_art_geo."' 
				WHERE idd_art_dpa='".$idd_art_dpa."'";//print $sql_upd_dart."<br>";
				$rs_upd_dart =$db->Execute($sql_upd_dart) or die($db->ErrorMsg()); 
			}
			else
			{
				$sql_ins_dart = "INSERT INTO d_art_dpa (fecha,indice,idb_articulo,cod_dpa) 
				VALUES('".$fecha_d_var_dpa."','".$indice_art_geo."','".$idb_articulo."','".$cod_dpa."')";//print $sql_ins_dart."<br>";	
				$rs_ins_dart = $db->Execute($sql_ins_dart) or die($db->ErrorMsg());
			}
			$indice_art_geo="";
			
			//------------------------------------------------------------------------------------------
			//------------------------------------------------------------------------------------------
		}
			
		$rs_moneda->MoveNext();
		}
	$rs_sel_articulo->MoveNext();  
	}
$rs_sel_dpa->MoveNext();   
}


if($rs_ins_dart || $rs_upd_dart)
{
unlink("ejecutado.txt");
$gestor = @fopen("ejecutado.txt", "a");
	if ($gestor) 
	{
	   
	   if (fwrite($gestor, "2") === FALSE) 
		{
			echo "No se puede escribir al archivo.";
			exit;
		}
		fclose($gestor);
	}
}


//header("Location:../../administracion/config/admin.php?msg=Se ejecutó satisfactoriamente el cálculo de índices a nivel de artículo por mercado en cada municipio usando media geométrica para la fecha: ".$fecha_d_var_dpa.".");?>



<html>
<body>
<form id="frm" name="frm" method="post" action="../../administracion/config/admin.php">
  <input type="text" name="msg" id="msg" value="<?php print "Se ejecutó satisfactoriamente el cálculo de índices a nivel de artículo por mercado en cada municipio usando media geométrica para la fecha: ".$fecha_d_var_dpa.".";?>" />
</form>
 <script language="JavaScript" type="text/javascript">
	 document.frm.action="../../administracion/config/admin.php";
	 document.frm.submit();
</script>
</body>
</html>



