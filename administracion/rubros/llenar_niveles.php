<?php 
$x="../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."php/session/session_super.php");
include("delete_all.php");

//llena los niveles de las tablas g_ que son del nuevo IPC para luego ingresar sus ponderaciones

//------------------------------FECHA MAXIMA DE LA BASE---------------------					 
$sql_fecha = "select max(fecha) from b_variedad";		
$rs_fecha = $db->Execute($sql_fecha)or die($db->ErrorMsg()) ;
$fecha_max = $rs_fecha->Fields('max');//print $x;
//------------------------------FECHA MAXIMA DE LA BASE---------------------




//-------------------FOR DE LOS NOMENCLADORES DESDE division HASTA variedad------------------------
//--------------------------------------------------------------------------------------------------					 
$sql_division = "select id_division from n_division";		
$rs_division = $db->Execute($sql_division)or die($db->ErrorMsg()) ;
$cant_division=$rs_division->RecordCount();

$rs_division->MoveFirst();
for($div=1;$div<=$cant_division;$div++)
{
$id_division=$rs_division->Fields('id_division');

	//--------------------------------------------------------------------------------------------------					 
	$sql_grupo = "select id_grupo, grupo from n_grupo where id_division=$id_division";		
	$rs_grupo = $db->Execute($sql_grupo)or die($db->ErrorMsg()) ;//print $sql_grupo;
	$cant_grupo=$rs_grupo->RecordCount();
	
	$rs_grupo->MoveFirst();
	for($gru=1;$gru<=$cant_grupo;$gru++)
	{   
	$id_grupo=$rs_grupo->Fields('id_grupo');
		
		//--------------------------------------------------------------------------------------------------					 
		$sql_clase = "select id_clase, clase from n_clase where id_grupo=$id_grupo";		
		$rs_clase = $db->Execute($sql_clase)or die($db->ErrorMsg()) ;//print $sql_grupo;
		$cant_clase=$rs_clase->RecordCount();
	
		$rs_clase->MoveFirst();
		for($cla=1;$cla<=$cant_clase;$cla++)
		{
		$id_clase=$rs_clase->Fields('id_clase');
		
			//--------------------------------------------------------------------------------------------------					 
			$sql_subclase = "select e_articulo.ide_subclase, subclase from e_subclase, e_articulo, n_variedad 
			where e_subclase.id_clase='$id_clase' and e_subclase.ide_subclase!='1' and e_subclase.ide_subclase=e_articulo.ide_subclase 
			and e_articulo.ide_articulo=n_variedad.ide_articulo and e_articulo.ide_articulo!='1'";		
			$rs_subclase = $db->Execute($sql_subclase)or die($db->ErrorMsg());//print $sql_subclase;
			$cant_subclase=$rs_subclase->RecordCount();
	
			$rs_subclase->MoveFirst();
			for($sub=1;$sub<=$cant_subclase;$sub++)
			{	
			$ide_subclase=$rs_subclase->Fields('ide_subclase');
			if($ide_subclase)
			{
				//--------------------------------------------------------------------------------------------------					 
				$sql_articulo = "select  e_articulo.ide_articulo from e_articulo, n_variedad 
				where e_articulo.ide_articulo=n_variedad.ide_articulo and ide_subclase='$ide_subclase' and e_articulo.ide_articulo!='1'";	//print $sql_articulo."<br>";	
				$rs_articulo = $db->Execute($sql_articulo)or die($db->ErrorMsg()) ;
				$cant_articulo=$rs_articulo->RecordCount();
	
				$rs_articulo->MoveFirst();
				for($art=0;$art<$cant_articulo;$art++)
				{
				$ide_articulo=$rs_articulo->Fields('ide_articulo');
			

					//*******************************************************************************								
								$sql_g_art = "SELECT idg_articulo FROM g_articulo WHERE g_articulo.ide_articulo='".$ide_articulo."' and g_articulo.fecha='".$fecha_max."'";		
								$rs_g_art = $db->Execute($sql_g_art) or die($db->ErrorMsg());//print $rs_g_art;
								$id_art=$rs_g_art->Fields('idg_articulo');
								if($id_art=='')								 				
								{								
								$sql_ins_art="INSERT INTO g_articulo (fecha,ide_articulo) VALUES ('".$fecha_max."','".$ide_articulo."')";
								$db->Execute($sql_ins_art) or die($db->ErrorMsg());//print $sql;
								$aux_art=1;
								}
								//******************************************************************************* 
								
											
					$rs_articulo->MoveNext();
				}
				//--------------------------------------------------------------------------------------------------
								//*******************************************************************************								
								$sql_g_sub = "SELECT idg_subclase FROM g_subclase WHERE g_subclase.ide_subclase='".$ide_subclase."' AND  g_subclase.fecha='".$fecha_max."'";		
								$rs_g_sub = $db->Execute($sql_g_sub) or die($db->ErrorMsg());//print $rs_g_art;
								$id_sub=$rs_g_sub->Fields('idg_subclase');
								if($id_sub=='' && $aux_art!=0)								 				
								{								
								$sql_ins_sub="INSERT INTO g_subclase (fecha,ide_subclase) VALUES ('".$fecha_max."','".$ide_subclase."')";
								$db->Execute($sql_ins_sub) or die($db->ErrorMsg());//print $sql;
								$aux_sub=1;
								}
								//******************************************************************************* 
								$aux_art=0;
				}//el if
												
				$rs_subclase->MoveNext();
			}
			//--------------------------------------------------------------------------------------------------
		
								//*******************************************************************************								
								$sql_g_cla = "SELECT idg_clase FROM g_clase WHERE g_clase.id_clase='".$id_clase."' AND g_clase.fecha='".$fecha_max."'";		
								$rs_g_cla = $db->Execute($sql_g_cla) or die($db->ErrorMsg());//print $rs_g_gru;
								$id_cla=$rs_g_cla->Fields('idg_clase');
								if($id_cla=='' && $aux_sub!=0)								 				
								{							
								$sql_ins_cla="INSERT INTO g_clase (fecha,id_clase) VALUES ('".$fecha_max."','".$id_clase."')";
								$db->Execute($sql_ins_cla) or die($db->ErrorMsg());//print $sql;
								$aux_cla=1;
								}
								//*******************************************************************************
								$aux_sub=0;
								
			$rs_clase->MoveNext();
		}
		//--------------------------------------------------------------------------------------------------
		
								//*******************************************************************************								
								$sql_g_gru = "SELECT idg_grupo FROM g_grupo WHERE g_grupo.id_grupo='".$id_grupo."' AND g_grupo.fecha='".$fecha_max."'";		
								$rs_g_gru = $db->Execute($sql_g_gru) or die($db->ErrorMsg());//print $rs_g_gru;
								$id_gru=$rs_g_gru->Fields('idg_grupo');
								if($id_gru=='' && $aux_cla!=0)								 				
								{							
								$sql_ins_gru="INSERT INTO g_grupo (fecha,id_grupo) VALUES ('".$fecha_max."','".$id_grupo."')";
								$db->Execute($sql_ins_gru) or die($db->ErrorMsg());//print $sql;
								$aux_gru=1;
								}
								//*******************************************************************************
								$aux_cla=0;
							
		$rs_grupo->MoveNext();
	}
	//--------------------------------------------------------------------------------------------------
	
								//*******************************************************************************								
								$sql_g_div = "SELECT idg_division FROM g_division WHERE g_division.id_division='".$id_division."' AND  g_division.fecha='".$fecha_max."'";		
								$rs_g_div = $db->Execute($sql_g_div) or die($db->ErrorMsg());//print $rs_g_gru;
								$id_div=$rs_g_div->Fields('idg_division');
								if($id_div=='' && $aux_gru!=0)								 				
								{							
								$sql_ins_div="INSERT INTO g_division (fecha,id_division) VALUES ('".$fecha_max."','".$id_division."')";
								$db->Execute($sql_ins_div) or die($db->ErrorMsg());//print $sql;
								
								}//*******************************************************************************
								$aux_gru=0;
$rs_division->MoveNext();
}
//--------------------------------------------------------------------------------------------------
//----------------FIN DEL FOR DE LOS NOMENCLADORES DESDE division HASTA variedad-------------------




//------------------------------COMPROBACION DE VALORES---------------------					 
/*$sql_pvalor = "select sum(valor) from g_variedad where fecha='".$fecha_max."'";		
$rs_pvalor = $db->Execute($sql_pvalor)or die($db->ErrorMsg()) ;
$pvalor = $rs_pvalor->Fields('sum');//print $pvalor;

$sql_cvalor = "select sum(valor) from g_division where fecha='".$fecha_max."'";		
$rs_cvalor = $db->Execute($sql_cvalor)or die($db->ErrorMsg()) ;
$cvalor = $rs_cvalor->Fields('sum');//print $cvalor;
if($pvalor!=$cvalor)
{include("../Copy of base/delete_all.php");}*/
//------------------------------COMPROBACION DE VALORES---------------------

header("Location:../config/admin.php?msg=Se insertaron los rubros correctamente, se puede proceder a insertar sus ponderaciones.");
?>