<?php 

require_once("../../../adodb/adodb.inc.php");
require_once("../../../coneccion/conn.php");



 if(!empty($_POST)){ // con esto evito el intento de acceder directamente a esta pagina escribiendo su URL en el browser
 //---------------------------------------------------					 
$sql_fecha = "select max(fecha) from b_variedad";		
$rs_var_estab_fecha = $db->Execute($sql_fecha)or $mensaje=$db->ErrorMsg();
$fecha_base = $rs_var_estab_fecha->Fields('max');
//---------------------------------------------------

    $var = split(",",$_POST['var_aux_mod']);
	
	$id_estab=$_POST['sel_cod_estab'];
	//print count($var);
	if(count($var) != 0)
  {
  	for ($i = 0; $i < count($var); next($var), $i++) 
	{
	    $Id = current($var);   
		$fecha=$_POST['txt_fecha'];
		$id_unidad="22";//es id_unidad 22 ya que se refiere a la raya ------
		$fecha=substr($fecha_base,0,8).$fecha;
   		//---------------------------------------------------
		$sql = "select * from n_var_estab where id_estab = '$id_estab' and idb_variedad = '$Id' and fecha_captar='$fecha'";
		//print $sql;
		$rs_var = $db->Execute($sql)or die($db->ErrorMsg()) ;
		//---------------------------------------------------
		
		if(!$rs_var->fields[0])
		{			
		$query_rs= "INSERT INTO n_var_estab (id_estab,idb_variedad,fecha_captar,id_unidad,fecha_creacion)  
		VALUES ('".$id_estab."','".$Id."','".$fecha."','".$id_unidad."','".date("Y-m-d")."')";//print $query_rs.$i."<br>";	  
	 	$rs_m=$db->Execute($query_rs) or die($db->ErrorMsg());
		
							if($rs_m)
							{
							$gestor = @fopen($camino, "a");
								if ($gestor) 
								{
								   
								   if (fwrite($gestor, $query_rs.";\r\n") === FALSE) 
									{
										echo "No se puede escribir al archivo.";
										exit;
									}
									fclose($gestor);
								}
							}
		
		}    
	 	
	} 
	
		
  } //fin si hay seleccionadas
  }
  
header("Location:n_estab_var.php?sel_mercado=".$_POST['sel_mercado']."&sel_tipologia=".$_POST['sel_tipologia']."&sel_cod_dpa=".$_POST['sel_cod_dpa']);
 
  ?>
