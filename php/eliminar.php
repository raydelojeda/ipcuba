<?php 

require_once("../adodb/adodb.inc.php");
require_once("../coneccion/conn.php");



 if(!empty($_POST)){ // con esto evito el intento de acceder directamente a esta pagina escribiendo su URL en el browser
    $var = split(",",$_POST['var_aux_mod']);
	$tabla=$_POST['tabla'];
	$campo=$_POST['campo'];
	$location=$_POST['location'];
	//print $campo;
	if(count($var) != 0)
  {
  	for ($i = 0; $i < count($var); next($var), $i++) 
	{
	    $Id = current($var);   
   		
				
	$query_rs_delete= "DELETE FROM $tabla WHERE $campo='".$Id."'";
	  
	  $rs_delete = $db->Execute($query_rs_delete) or die($db->ErrorMsg()."Este mensaje no es un error como tal, lo que sucede es que existen datos que dependen de lo que se quiere eliminar. Por tanto se debe proceder a eliminar las entradas dependientes. Dé click en el botón <- Atrás del navegador.");//print $a;print $query_rs_delete;	
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
