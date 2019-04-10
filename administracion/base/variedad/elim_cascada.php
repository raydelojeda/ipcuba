<?php 

$x="../../../";
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
    $var = split(",",$_POST['var_aux_mod']);//print $_POST['var_aux_mod'];die();
	$tabla=$_POST['tabla'];
	$campo=$_POST['campo'];
	$location=$_POST['location3'];
	
	//print $campo;
	if(count($var) != 0)
  {
  	for ($i = 0; $i < count($var); next($var), $i++) 
	{
	    $Id = current($var);  // print $Id;
		
		$sql_var_estab="select id_var_estab from n_var_estab where $campo='".$Id."'";//print $sql_var_estab."<br>";
		$rs_var_estab= $db->Execute($sql_var_estab)or $mensaje=$db->ErrorMsg();
		$cant_var_estab=$rs_var_estab->RecordCount(); 
			
		for($f=0;$f<$cant_var_estab;$f++)
		{	$id_var_estab=$rs_var_estab->Fields("id_var_estab");
			
			$sql_cap="delete from captacion where id_var_estab='$id_var_estab'";//print $sql_cap."<br>";
			$db->Execute($sql_cap)or die($db->ErrorMsg()) ;
			
		$rs_var_estab->MoveNext(); 
		}
		
		$sql_del_var_estab="delete from n_var_estab where $campo='".$Id."'";//print $sql_del_var_estab."<br>";
		$db->Execute($sql_del_var_estab)or die($db->ErrorMsg());
		
		$sql_del_d_var_dpa="delete from d_var_dpa where $campo='".$Id."'";//print $sql_del_d_var_dpa."<br>";
		$db->Execute($sql_del_d_var_dpa)or die($db->ErrorMsg());
					
		$query_rs_delete= "DELETE FROM $tabla WHERE $campo='".$Id."'";//print $query_rs_delete."<br>";die();
	  
	  $rs_delete = $db->Execute($query_rs_delete) or die($db->ErrorMsg()."Consulte a su Administrador. Dé click en el botón <- Atrás del navegador.");//print $query_rs_delete;	die();
	 
	 /* if($rs_delete)
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
		}*/
	 	  
	} 
		
  } //fin si hay seleccionadas
  }
  print $location;
 //header("Location:".$location);
 
  ?>
