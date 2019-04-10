<?php 

$x="../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");

//---------------------------------------------------
$query_usuario = " where usuario='".$_SESSION["user"]."' and n_dpa.cod_dpa=usuario.cod_dpa"; 
$sql_usuario = "select rol, id_usuario, usuario.cod_dpa,prov_mun, nombre, apellidos,usuario,telef,email from usuario,n_dpa".$query_usuario;	
//print 	$sql_usuario;
$rs_usuario = $db->Execute($sql_usuario)or $mensaje=$db->ErrorMsg() ;

$id_usuario_aprueba=$rs_usuario->Fields("id_usuario");
//print $cod_dpa;
//---------------------------------------------------

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
			SET va_a_calculo='1', id_usuario_aprueba='$id_usuario_aprueba' WHERE $campo='".$Id."'";
	  
	  $rs_delete = $db->Execute($query_rs_delete) or die($db->ErrorMsg()."Consulte a su Administrador. Dé click en el botón <- Atrás del navegador.");//print $query_rs_delete;	die();
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
