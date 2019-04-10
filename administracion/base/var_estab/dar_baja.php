<?php 

$x="../../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");



 if(!empty($_POST)){ // con esto evito el intento de acceder directamente a esta pagina escribiendo su URL en el browser
    $var = split(",",$_POST['var_aux_mod']);
	$tabla=$_POST['tabla'];
	$campo=$_POST['campo'];
	$location=$_POST['location2'];
	//print $campo;
	if(count($var) != 0)
  {
  	for ($i = 0; $i < count($var); next($var), $i++) 
	{
	    $Id = current($var);   
   		
				
	$query_rs_delete= "UPDATE $tabla 
			SET fecha_desuso='".date("Y/m/d")."', desuso='1' WHERE $campo='".$Id."'";
	  
	  $rs_delete = $db->Execute($query_rs_delete) or die($db->ErrorMsg()."Consulte a su Administrador. Dé click en el botón <- Atrás del navegador.");//print $a;
	  //print $query_rs_delete;	die();
	  if($rs_delete)
		{
		$gestor = @fopen($camino, "a");
			if ($gestor) 
			{
			   
			   if (fwrite($gestor, $query_rs_delete.";\r\n") === FALSE) 
				{
					echo "No se puede escribir al archivo.";
					exit;
				}
				fclose($gestor);
			}
		}
	 	  
	} 
		
  } //fin si hay seleccionadas
  }
  //print $location;
 header("Location:".$location);
 
  ?>
