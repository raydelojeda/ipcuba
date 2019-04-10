 <?php
$x="../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."php/session/session_autor_p.php");


if(isset($_POST['txt_consulta']))
{
	$magic_quotes = get_magic_quotes_gpc();
	
	$dpa=$_POST['sel_cod_dpa'];
	
	//print $dpa;
	$txt_consulta= stripslashes($_POST['txt_consulta']);
	$var=substr_count($txt_consulta,";");
	  for($i=1;$i<=$var;$i++)
	  {
		 //print "<br>".$i;
	  $pos=strpos($txt_consulta,";");
	  $txt_consulta2=substr($txt_consulta,0,$pos);
	  $txt_consulta=substr($txt_consulta,$pos+3); 
	  
	  
	  //insert captacion-------------------------------------------------------------------------------------------------
	  $insert = substr($txt_consulta2,0,21);
	  //print $insert."<br>";
	  if($insert=='INSERT INTO captacion')
	  {
	  $primera=stristr($txt_consulta2,"values");
	  $segunda=stristr($primera,"(");
	  $tercera=stristr($primera,",");
	  $cuarta=substr($tercera,1);
//print $cuarta;
	  $pos_usuario=strpos($segunda,",");
	  $pos_id_var_estab=strpos($cuarta,",");
	  //print $pos_id_var_estab;
	  
	  $id_var_estab=substr($cuarta,0,$pos_id_var_estab);
	  //print "id_var_estab:".$id_var_estab."<br>";
	  
	  $usuario=substr($segunda,1,$pos_usuario-1);
	  //print $usuario;
	  //print "id_var_estab:".$id_var_estab."<br>";
	  $sql_sel_dpa_usuario = "select cod_dpa,usuario,rol from usuario where id_usuario=$usuario";
	  //print $sql_sel_dpa_usuario;
      $rs_sel_dpa_usuario = $db->Execute($sql_sel_dpa_usuario) or $mensaje=$mensaje."  -".$db->ErrorMsg()."-"."<br>";
	  //print $rs_sel_dpa_usuario;
	  $dpa_usuario=$rs_sel_dpa_usuario->Fields("cod_dpa");		
	  //print $dpa_usuario;
	  $user = $rs_sel_dpa_usuario->Fields("usuario");
	  //print $user;
	  $rol = $rs_sel_dpa_usuario->Fields("rol");
	  
	  $sql_sel_id_var_estab = "select id_estab from n_var_estab where id_var_estab=$id_var_estab";
	  //print $sql_sel_id_var_estab;
      $rs_sel_id_var_estab = $db->Execute($sql_sel_id_var_estab) or $mensaje=$mensaje."  -".$db->ErrorMsg()."-"."<br>";
      $id_estab = $rs_sel_id_var_estab->Fields("id_estab");
	  //print "id_estab:".$id_estab."<br>";
	  if($id_estab!='')
	  {
	  $sql_id_estab = "select cod_dpa from n_estab where id_estab='".$id_estab."'";
	  //print $sql_id_estab;
      $rs_id_estab = $db->Execute($sql_id_estab) or $mensaje=$mensaje."  -".$db->ErrorMsg()."-"."<br>";
      $cod_dpa_estab = $rs_id_estab->Fields("cod_dpa");
	  }
	  /*print "rol:".$rol."<br>";
	  print "dpa_usuario:".$dpa_usuario."<br>";
	  print "dpa_escogido_combo:".$dpa."<br>";
	  //print "cod_dpa_estab:".$cod_dpa_estab."<br>";*/
	  //print "dpa:".$dpa;
	 // print "dpa_usuario:".$dpa_usuario;
	 if($insert=='INSERT INTO captacion' && $dpa=='1')
	  {
		
		  //print "cod_dpa_estab:".$cod_dpa_estab;
		  if(($rol=='autor' && $cod_dpa_estab!=$dpa_usuario)||($rol=='autor' && $dpa_usuario!='0300' && $dpa_usuario!='0301' && $dpa_usuario!='0302' && $dpa_usuario!='0303' && $dpa_usuario!='0304' && $dpa_usuario!='0309' && $dpa_usuario!='0207' && $dpa_usuario!='0219')||($rol=='autor' && $cod_dpa_estab!='0301' && $cod_dpa_estab!='0302' && $cod_dpa_estab!='0303' && $cod_dpa_estab!='0304' && $cod_dpa_estab!='0309' && $cod_dpa_estab!='0207' && $cod_dpa_estab!='0219')||($rol=='aut_p' && $dpa_usuario!='0300'))
	     {
			 
			//print "no_C_habana"."<br>";
	    $mensaje= $mensaje."El usuario:"." ".$user." "." no puede realizar captaciones de este municipio."."<br>";
		
		$gestor = @fopen($camino2, "a");
								if ($gestor) 
								{
								   
								   if (fwrite($gestor, $txt_consulta2.";\r\n") === FALSE) 
									{
										echo "No se puede escribir al archivo.";
										exit;
									}
									fclose($gestor);
								}
							
	    }
	  
	 
	     else
	    {
	    /*$consulta="insert perfecto";
		print $consulta."si_C_habana"."<br>";*/
		 $consulta = $db->Execute($txt_consulta2) or $mensaje=$mensaje."  -".$db->ErrorMsg()."-"."<br>";
	    }
	  }
	  
	  if($insert=='INSERT INTO captacion' && $dpa=='0300')
	  {
		
		  //print "cod_dpa_estab:".$cod_dpa_estab;
		  if(($rol=='autor' && $cod_dpa_estab!=$dpa_usuario)||($rol=='autor' && $dpa_usuario!='0300' && $dpa_usuario!='0301' && $dpa_usuario!='0302' && $dpa_usuario!='0303' && $dpa_usuario!='0304' && $dpa_usuario!='0309' )||($rol=='autor' && $cod_dpa_estab!='0301' && $cod_dpa_estab!='0302' && $cod_dpa_estab!='0303' && $cod_dpa_estab!='0304' && $cod_dpa_estab!='0309' )||($rol=='aut_p' && $dpa_usuario!='0300'))
	     {
			 
			//print "no_C_habana"."<br>";
	    $mensaje= $mensaje."El usuario:"." ".$user." "." no puede realizar captaciones de este municipio."."<br>";
		
		$gestor = @fopen($camino2, "a");
								if ($gestor) 
								{
								   
								   if (fwrite($gestor, $txt_consulta2.";\r\n") === FALSE) 
									{
										echo "No se puede escribir al archivo.";
										exit;
									}
									fclose($gestor);
								}
							
	    }
	  
	 
	     else
	    {
	    /*$consulta="insert perfecto";
		print $consulta."si_C_habana"."<br>";*/
		 $consulta = $db->Execute($txt_consulta2) or $mensaje=$mensaje."  -".$db->ErrorMsg()."-"."<br>";
	    }
	  }
	  
	  if($insert=='INSERT INTO captacion' && $dpa=='0200')
	  {
		//print "dpa_usuario:".$dpa_usuario;
		  //print "cod_dpa_estab:".$cod_dpa_estab;
		  if(($rol=='autor' && $cod_dpa_estab!=$dpa_usuario) || ( $rol=='autor' && $dpa_usuario!='0207' && $dpa_usuario!='0219' )||($rol=='autor' && $cod_dpa_estab!='0207' && $cod_dpa_estab!='0219'))
	     {
			// print "no_habana"."<br>";
	    $mensaje= $mensaje."El usuario:"." ".$user." "." no puede realizar captaciones de este municipio."."<br>";
		
		$gestor = @fopen($camino2, "a");
								if ($gestor) 
								{
								   
								   if (fwrite($gestor, $txt_consulta2.";\r\n") === FALSE) 
									{
										echo "No se puede escribir al archivo.";
										exit;
									}
									fclose($gestor);
								}
							
	    }
	  
	 
	     else
	    {
			/*$consulta="insert perfecto";
		print $consulta."si_habana"."<br>";*/
		 $consulta = $db->Execute($txt_consulta2) or $mensaje=$mensaje."  -".$db->ErrorMsg()."-"."<br>";
	    }
	  }
	  /*else if(($rol=='autor') && ($dpa_usuario!=$dpa || $cod_dpa_estab!=$dpa || $cod_dpa_estab!=$dpa_usuario))
	  {
		  print "otros_mun_no"."<br>";
	    $mensaje= $mensaje."El usuario:"." ".$user." "." no puede realizar captaciones de este municipio."."<br>";
		
		$gestor = @fopen($camino2, "a");
								if ($gestor) 
								{
								   
								   if (fwrite($gestor, $txt_consulta2.";\r\n") === FALSE) 
									{
										echo "No se puede escribir al archivo.";
										exit;
									}
									fclose($gestor);
								}
							
	  }
	  
	 
	  else
	    {
	    $consulta="insert perfecto";
	     print $consulta."otros_mun_si"."<br>";
		 //$consulta = $db->Execute($txt_consulta2) or $mensaje=$mensaje."  -".$db->ErrorMsg()."-"."<br>";
	  }*/
	  }
	  	//Update captacion------------------------------------------------------------------------------------------------------- 
	  $update = substr($txt_consulta2,0,28);
	  //print "insert:".$insert."<br>";
	 //print "update:".$update."<br>";
	 //print "consulta2:".$txt_consulta2."<br>";
	  if($update=='UPDATE captacion SET  precio')
	  { 
	  $primera=stristr($txt_consulta2,"id_usuario");
	  //print "primera:".$primera;
	  $segunda=stristr($primera,"=");
	  
	  //print "segunda:".$segunda;
	  $tercera=stristr($primera,"id_cap");
	  //print $tercera;
	  $cuarta=stristr($tercera,"=");
	  //print $cuarta;
	  $pos_usuario=strpos($segunda,",");
	  
	  $usuario=substr($segunda,1,$pos_usuario-1);
	  $id_cap=substr($cuarta,1);
	  //print $usuario;
	  //print $id_cap;
	  $sql_sel_dpa_usuario = "select cod_dpa,usuario, rol from usuario where id_usuario=$usuario";
	  //print $sql_sel_dpa_usuario;
      $rs_sel_dpa_usuario = $db->Execute($sql_sel_dpa_usuario) or $mensaje=$mensaje."  -".$db->ErrorMsg()."-"."<br>";
      $dpa_usuario = $rs_sel_dpa_usuario->Fields("cod_dpa");
	  $user = $rs_sel_dpa_usuario->Fields("usuario");
	  $rol = $rs_sel_dpa_usuario->Fields("rol");
	  
	  
	  $sql_sel_id_cap = "select id_var_estab from captacion where id_cap=$id_cap";
	  //print $sql_sel_id_cap;
      $rs_sel_id_cap = $db->Execute($sql_sel_id_cap) or $mensaje=$mensaje."  -".$db->ErrorMsg()."-"."<br>";
      $id_var_estab = $rs_sel_id_cap->Fields("id_var_estab");
	  
	  if($id_var_estab!='')
	  {
	  $sql_sel_id_var_estab = "select id_estab from n_var_estab where id_var_estab=$id_var_estab";
	  //print $sql_sel_id_var_estab;
      $rs_sel_id_var_estab = $db->Execute($sql_sel_id_var_estab) or $mensaje=$mensaje."  -".$db->ErrorMsg()."-"."<br>";
      $id_estab = $rs_sel_id_var_estab->Fields("id_estab");
	  //print $id_estab;
	  $sql_id_estab = "select cod_dpa from n_estab where id_estab='".$id_estab."'";
	  //print $sql_id_estab;
      $rs_id_estab = $db->Execute($sql_id_estab) or $mensaje=$mensaje."  -".$db->ErrorMsg()."-"."<br>";
      $cod_dpa_estab = $rs_id_estab->Fields("cod_dpa");
	  
	  }
	  
	   //print "dpa_usuario:".$dpa_usuario;
	   //print "cod_dpa_estab:".$cod_dpa_estab."<br>";
	   if($update=='UPDATE captacion SET  precio' && $dpa=='1')
	  {
		  
		   //print $rol."<br>";
			 //print dpa_estab.$cod_dpa_estab."<br>";
			 //print usuario.$dpa_usuario."<br>";
			 
		  if(($rol=='autor' && $cod_dpa_estab!=$dpa_usuario)||($rol=='autor' && $dpa_usuario!='0300' && $dpa_usuario!='0301' && $dpa_usuario!='0302' && $dpa_usuario!='0303' && $dpa_usuario!='0304' && $dpa_usuario!='0309' && $dpa_usuario!='0207' && $dpa_usuario!='0219')||($rol=='autor' && $cod_dpa_estab!='0301' && $cod_dpa_estab!='0302' && $cod_dpa_estab!='0303' && $cod_dpa_estab!='0304' && $cod_dpa_estab!='0309' && $cod_dpa_estab!='0207' && $cod_dpa_estab!='0219' )||($rol=='aut_p' && $dpa_usuario!='0300'))
	     {
			
			
			
	    $mensaje= $mensaje."El usuario:"." ".$user." "." no puede modificar captaciones de este municipio."."<br>";
		
		$gestor = @fopen($camino2, "a");
								if ($gestor) 
								{
								   
								   if (fwrite($gestor, $txt_consulta2.";\r\n") === FALSE) 
									{
										echo "No se puede escribir al archivo.";
										exit;
									}
									fclose($gestor);
								}
							
	    }
	  
	 
	     else
	    {
	    /*$consulta="update perfecto";
		print $consulta."C_habana_si"."<br>";*/
		 $consulta = $db->Execute($txt_consulta2) or $mensaje=$mensaje."  -".$db->ErrorMsg()."-"."<br>";
	    }
	  }
	   if($update=='UPDATE captacion SET  precio' && $dpa=='0300')
	  {
		  
		   //print $rol."<br>";
			 //print dpa_estab.$cod_dpa_estab."<br>";
			 //print usuario.$dpa_usuario."<br>";
			 
		  if(($rol=='autor' && $cod_dpa_estab!=$dpa_usuario)||($rol=='autor' && $dpa_usuario!='0300' && $dpa_usuario!='0301' && $dpa_usuario!='0302' && $dpa_usuario!='0303' && $dpa_usuario!='0304' && $dpa_usuario!='0309' )||($rol=='autor' && $cod_dpa_estab!='0301' && $cod_dpa_estab!='0302' && $cod_dpa_estab!='0303' && $cod_dpa_estab!='0304' && $cod_dpa_estab!='0309' )||($rol=='aut_p' && $dpa_usuario!='0300'))
	     {
			
			
			
	    $mensaje= $mensaje."El usuario:"." ".$user." "." no puede modificar captaciones de este municipio."."<br>";
		
		$gestor = @fopen($camino2, "a");
								if ($gestor) 
								{
								   
								   if (fwrite($gestor, $txt_consulta2.";\r\n") === FALSE) 
									{
										echo "No se puede escribir al archivo.";
										exit;
									}
									fclose($gestor);
								}
							
	    }
	  
	 
	     else
	    {
	    /*$consulta="update perfecto";
		print $consulta."C_habana_si"."<br>";*/
		 $consulta = $db->Execute($txt_consulta2) or $mensaje=$mensaje."  -".$db->ErrorMsg()."-"."<br>";
	    }
	  }
	   if($update=='UPDATE captacion SET  precio' && $dpa=='0200')
	   {
		//print "dpa_usuario:".$dpa_usuario;
		  //print "cod_dpa_estab:".$cod_dpa_estab;
		  if(($rol=='autor' && $cod_dpa_estab!=$dpa_usuario) || ( $rol=='autor' && $dpa_usuario!='0207' && $dpa_usuario!='0219' )||($rol=='autor' && $cod_dpa_estab!='0207' && $cod_dpa_estab!='0219'))
	     {
			 //print "no_habana_up"."<br>";
	    $mensaje= $mensaje."El usuario:"." ".$user." "." no puede realizar captaciones de este municipio."."<br>";
		
		$gestor = @fopen($camino2, "a");
								if ($gestor) 
								{
								   
								   if (fwrite($gestor, $txt_consulta2.";\r\n") === FALSE) 
									{
										echo "No se puede escribir al archivo.";
										exit;
									}
									fclose($gestor);
								}
							
	    }
	  
	 
	     else
	    {
	    /*$consulta="update perfecto";
		print $consulta."si_habana_up"."<br>";*/
		 $consulta = $db->Execute($txt_consulta2) or $mensaje=$mensaje."  -".$db->ErrorMsg()."-"."<br>";
	    }
	  }
	  
	  /*else if(($rol=='autor') && ($dpa_usuario!=$dpa || $cod_dpa_estab!=$dpa_usuario))
	  {
		  print "up_si_otros_mun"."<br>";
	    $mensaje=$mensaje. "El usuario:"." ".$user." "." no puede modificar captaciones de este municipio."."<br>";
		$gestor = @fopen($camino2, "a");
								if ($gestor) 
								{
								   
								   if (fwrite($gestor, $txt_consulta2.";\r\n") === FALSE) 
									{
										echo "No se puede escribir al archivo.";
										exit;
									}
									fclose($gestor);
								}
								
	  }
	  else
	  {
	    $consulta="update perfecto";
	     print $consulta."up_no_otros_mun"."<br>";
		 //$consulta = $db->Execute($txt_consulta2) or $mensaje=$mensaje."  -".$db->ErrorMsg()."-"."<br>";
		 
	  }*/
	  }
	  
	 
	  else if($update=="UPDATE captacion SET  id_usu")
	  {
		 //print "entra";
	  $primera=stristr($txt_consulta2,"id_var_estab");
	  //print "primera:".$primera;
	  $segunda=stristr($primera,"=");
	  $tercera=stristr($txt_consulta2,"=");
	  
	  $pos_usuario=strpos($tercera,",");
	  //print "segunda:".$segunda;
	  $pos_id_var_estab=strpos($segunda,"a");
	  
	  $usuario=substr($tercera,1,$pos_usuario-1);
	  $id_var_estabb=substr($segunda,1,$pos_id_var_estab-1);
	  //print $id_var_estabb;
	 //print $usuario;
	 
	  $sql_sel_dpa_usuario = "select cod_dpa,usuario, rol from usuario where id_usuario=$usuario";
	  //print $sql_sel_dpa_usuario;
      $rs_sel_dpa_usuario = $db->Execute($sql_sel_dpa_usuario) or $mensaje=$mensaje."  -".$db->ErrorMsg()."-"."<br>";
      $dpa_usuario = $rs_sel_dpa_usuario->Fields("cod_dpa");
	  $user = $rs_sel_dpa_usuario->Fields("usuario");
	  $rol = $rs_sel_dpa_usuario->Fields("rol");
	  
	  
	  if($id_var_estabb!='')
	  {
	  $sql_sel_id_var_estab = "select id_estab from n_var_estab where id_var_estab=$id_var_estabb";
	  //print $sql_sel_id_var_estab;
      $rs_sel_id_var_estab = $db->Execute($sql_sel_id_var_estab) or $mensaje=$mensaje."  -".$db->ErrorMsg()."-"."<br>";
      $id_estab = $rs_sel_id_var_estab->Fields("id_estab");
	  //print $id_estab;
	  $sql_id_estab = "select cod_dpa from n_estab where id_estab='".$id_estab."'";
	  //print $sql_id_estab;
      $rs_id_estab = $db->Execute($sql_id_estab) or $mensaje=$mensaje."  -".$db->ErrorMsg()."-"."<br>";
      $cod_dpa_estab = $rs_id_estab->Fields("cod_dpa");
	  }
	  
	   if($update=="UPDATE captacion SET  id_usu" && $dpa=='1')
	  {
		  //print "C_hab_usu_up_no"."<br>";
		  if(($rol=='autor' && $cod_dpa_estab!=$dpa_usuario)||($rol=='autor' && $dpa_usuario!='0300' && $dpa_usuario!='0301' && $dpa_usuario!='0302' && $dpa_usuario!='0303' && $dpa_usuario!='0304' && $dpa_usuario!='0309' && $dpa_usuario!='0207' && $dpa_usuario!='0219')||($rol=='autor' && $cod_dpa_estab!='0301' && $cod_dpa_estab!='0302' && $cod_dpa_estab!='0303' && $cod_dpa_estab!='0304' && $cod_dpa_estab!='0309' && $cod_dpa_estab!='0207' && $cod_dpa_estab!='0219' )||($rol=='aut_p' && $dpa_usuario!='0300'))
	     {
	    $mensaje= $mensaje."El usuario:"." ".$user." "." no puede modificar captaciones de este municipio."."<br>";
		
		$gestor = @fopen($camino2, "a");
								if ($gestor) 
								{
								   
								   if (fwrite($gestor, $txt_consulta2.";\r\n") === FALSE) 
									{
										echo "No se puede escribir al archivo.";
										exit;
									}
									fclose($gestor);
								}
							
	    }
	  
	 
	     else
	    {
	    /*$consulta="insert perfecto";
	     print $consulta."C_hab_usu_up_si"."<br>";*/
		 $consulta = $db->Execute($txt_consulta2) or $mensaje=$mensaje."  -".$db->ErrorMsg()."-"."<br>";
	    }
	  }
	   if($update=="UPDATE captacion SET  id_usu" && $dpa=="0300")
	  {
		  //print "C_hab_usu_up_no"."<br>";
		  if(($rol=='autor' && $cod_dpa_estab!=$dpa_usuario)||($rol=='autor' && $dpa_usuario!='0300' && $dpa_usuario!='0301' && $dpa_usuario!='0302' && $dpa_usuario!='0303' && $dpa_usuario!='0304' && $dpa_usuario!='0309' )||($rol=='autor' && $cod_dpa_estab!='0301' && $cod_dpa_estab!='0302' && $cod_dpa_estab!='0303' && $cod_dpa_estab!='0304' && $cod_dpa_estab!='0309' )||($rol=='aut_p' && $dpa_usuario!='0300'))
	     {
	    $mensaje= $mensaje."El usuario:"." ".$user." "." no puede modificar captaciones de este municipio."."<br>";
		
		$gestor = @fopen($camino2, "a");
								if ($gestor) 
								{
								   
								   if (fwrite($gestor, $txt_consulta2.";\r\n") === FALSE) 
									{
										echo "No se puede escribir al archivo.";
										exit;
									}
									fclose($gestor);
								}
							
	    }
	  
	 
	     else
	    {
	    /*$consulta="insert perfecto";
	     print $consulta."C_hab_usu_up_si"."<br>";*/
		 $consulta = $db->Execute($txt_consulta2) or $mensaje=$mensaje."  -".$db->ErrorMsg()."-"."<br>";
	    }
	  }
	  if($update=="UPDATE captacion SET  id_usu" && $dpa=="0200")
	  {
		//print "dpa_usuario:".$dpa_usuario;
		  //print "cod_dpa_estab:".$cod_dpa_estab;
		  if(($rol=='autor' && $cod_dpa_estab!=$dpa_usuario) || ( $rol=='autor' && $dpa_usuario!='0207' && $dpa_usuario!='0219' )||($rol=='autor' && $cod_dpa_estab!='0207' && $cod_dpa_estab!='0219'))
	     {
		//print "no_habana_up_usu"."<br>";	 
	    $mensaje= $mensaje."El usuario:"." ".$user." "." no puede realizar captaciones de este municipio."."<br>";
		
		$gestor = @fopen($camino2, "a");
								if ($gestor) 
								{
								   
								   if (fwrite($gestor, $txt_consulta2.";\r\n") === FALSE) 
									{
										echo "No se puede escribir al archivo.";
										exit;
									}
									fclose($gestor);
								}
							
	    }
	  
	 
	     else
	    {
	  
		/*$consulta="insert perfecto";
		print $consulta."si_habana_up_us"."<br>";*/
		 $consulta = $db->Execute($txt_consulta2) or $mensaje=$mensaje."  -".$db->ErrorMsg()."-"."<br>";
	    }
	  }
	  
	  /*else if(($rol=='autor') && ($dpa_usuario!=$dpa || $cod_dpa_estab!=$dpa_usuario))
	  {
		  print "up_usu_si_otros_mun"."<br>";
	    $mensaje=$mensaje. "El usuario:"." ".$user." "." no puede modificar captaciones de este municipio."."<br>";
		$gestor = @fopen($camino2, "a");
								if ($gestor) 
								{
								   
								   if (fwrite($gestor, $txt_consulta2.";\r\n") === FALSE) 
									{
										echo "No se puede escribir al archivo.";
										exit;
									}
									fclose($gestor);
								}
	  }
	  else
	  {
	    $consulta="update perfecto";
	     print $consulta."up_usu_no_otros_mun"."<br>";
		 //$consulta = $db->Execute($txt_consulta2) or $mensaje=$mensaje."  -".$db->ErrorMsg()."-"."<br>";
	  }*/
	    
	  }
	  else if($insert!='INSERT INTO captacion' && $update!='UPDATE captacion SET  precio' && $update!="UPDATE captacion SET  id_usu")
	  {
	    //print "otra";
		 $consulta = $db->Execute($txt_consulta2) or $mensaje=$mensaje."  -".$db->ErrorMsg()."-"."<br>";
	  }
	   if(!$consulta)
	  
		  $mensaje=$mensaje."<br>".$txt_consulta2."<br>";
		    //print $txt_consulta2;
		   //print  $mensaje;
	  }

	 		
}
?>

<html><!-- InstanceBegin template="/Templates/Template.dwt.php" codeOutsideHTMLIsLocked="false" --> 
<head>  

<!--  
*** Plataforma en Software Libre PHP, PostGreSQL
*** Realizado por Ing. Raydel Ojeda Figueroa 
   --> 
<!-- InstanceBeginEditable name="doctitle" --> 
<title>IPC</title>
<!-- InstanceEndEditable --> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- InstanceBeginEditable name="head" --> <!-- InstanceEndEditable --> 

<?php if($_SESSION["estilo"]=="g"){?>
<link href="../../css/gris.css" rel="stylesheet" type="text/css"> 
<?php }elseif($_SESSION["estilo"]=="v"){?>
<link href="../../css/verde.css" rel="stylesheet" type="text/css"> 
<?php } else {?>
<link href="../../css/azul.css" rel="stylesheet" type="text/css"> 
<?php }?>
<link rel="stylesheet" href="../../css/theme.css" type="text/css" />
<link rel="shortcut icon" href="../../imagenes/flecha.ico"/> 
<link rel="stylesheet" type="text/css" href="../../css/resources/css/ext-all.css" />
</head> 

<script type="text/javascript" src="../../javascript/yui/yui-utilities.js"></script>  
<script type="text/javascript" src="../../javascript/yui/ext-yui-adapter.js"></script>
<script language="javascript" src="../../javascript/yui/ext-all.js"></script>

<script language="JavaScript" src="../../javascript/JSCookMenu_mini.js" type="text/javascript"></script> 
<script language="JavaScript" src="../../javascript/theme.js" type="text/javascript"></script>
<script language="javascript" src="../../javascript/cal2.js"></script>
<script language="javascript" src="../../javascript/cal_conf2.js"></script>
<script language="javascript" src="../../javascript/overlib_mini.js"></script>

<script src="../../javascript/funciones.js" type="text/javascript">
</script> 
<body> 
<table width="750"  border="1"  align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td>

<table width="750" border="0"  align="center" cellpadding="0" cellspacing="0" >
<tr> 
          <td><img src="../../imagenes/banner.jpg" width="750" height="35"></td>
  </tr>
  <tr>
   
   
   <table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
<tr>
	<td style="padding-left:5px;">
	
				<div id="myMenuID"></div>
		<?php 

if ($_SESSION["rol"] == 'autor')//autor municipal 
{
?>
<script language="javascript"  src="../../javascript/menu_autor_m.js">	
		</script>
<?php
}
elseif($_SESSION["rol"] == 'aut_p')
{
?>
		<script language="javascript"  src="../../javascript/menu_autor_p.js">	
		</script>
<?php
}
elseif($_SESSION["rol"] == 'edito')
{
?>
	<script language="javascript"  src="../../javascript/menu_editor.js">	
		</script>
<?php
}
elseif($_SESSION["rol"] == 'admin')
{
?>
	<script language="javascript"  src="../../javascript/menu_admin.js">	
		</script>
        
<?php
}
elseif($_SESSION["rol"] == 'super')
{
?>
	<script language="javascript"  src="../../javascript/menu_super.js">	
		</script>
        
<?php
}
elseif($_SESSION["rol"] == 'jefes')
{
?>
	<script language="javascript"  src="../../javascript/menu_jefes.js">	
		</script>


<?php
} else
{
?>
<script language="javascript"  src="../../javascript/menu_invitado.js">	
		</script>
<?php
} 
?>
	</td>
	
	<td  class="intro_sup" valign="middle" align="right" >
		<a class="intro_sup" onMouseOver="return overlib('<?php if($_SESSION["rol"]=="admin")print "Administrador";
																elseif($_SESSION["rol"]=="super")print "Súper Administrador";
																elseif($_SESSION["rol"]=="edito")print "Editor-ONE";
																elseif($_SESSION["rol"]=="autor")print "Autor Municipal";
																elseif($_SESSION["rol"]=="aut_p")print "Autor Provincial";										
																elseif($_SESSION["rol"]=="jefes")print "Directivo";
																elseif($_SESSION["rol"]=="invit")print "Invitado";
		?>', BELOW, RIGHT);" onMouseOut="return nd();"href="../../php/logout.php" style="color: #333333; font-weight: bold"><?php print $_SESSION["user"];?>&nbsp;<img style="vertical-align:bottom"  border="0"src="../../imagenes/extrasmall/exit.gif">
			&nbsp; </a>
	</td>
</tr>
</table>
   
   
   
  </tr>
  <tr>
          <td align="center" valign="middle" bgcolor="#ffffff"><!-- InstanceBeginEditable name="Body" -->
           
               <form action="" method="post" name="frm" onSubmit="MM_validateForm('sel_mercado','','Escoger','sel_cod_var','','Escoger','sel_estab','','Escoger','txt_precio','','RisNum','sel_obs','','Escoger');return document.MM_returnValue">
              <table width="100%" class="menubar" cellpadding="0" cellspacing="0" border="0">
                <tr> 
                  <td class="menudottedline" align="right"> <table width="100%" border="0" class="menubar"  id="toolbar">
                      <tr > 
                        <td width="4%" valign="middle"  ><img src="../../imagenes/admin/xml_f2.png"/></td>
                        <td width="71%" valign="middle"  class="us"><font color="#5A697E" size="4">Ejecutar consultas</font>
                          <div align="center"></div></td>
                        <td width="9%"> 
                          <div align="center"> <a  class="toolbar" href="javascript:document.frm.submit();"> 
                            <input type="image"   name="btn_save" id="btn_save"   src="../../imagenes/apply_f2.png" alt="Ejecutar" width="32" height="32" border="0">
                            <br>
                            <label>Ejecutar</label>
                            </a> </div></td>
                        <td width="9%"> 
                          <div align="center"> <a class="toolbar" href="admin.php"> 
                            <img name="imageField2" src="../../imagenes/admin/cancel_f2.png" alt="Cerrar" width="32" height="32" border="0"> 
                            <br>
                            Cancelar</a> </div></td>
                        <td width="7%"> 
                          <div align="center"><a class="toolbar" href="#" onClick="window.open('../help/n_municipal_datos.htm', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');"> 
                            <img src="../../imagenes/admin/help_f2.png"  alt="Ayuda" name="help" width="32" height="32" border="0" align="middle" /><br>
                            Ayuda</a></div></td>
                      </tr>
                      
                    </table></td>
                </tr>
              </table>
              <p><br>
                
              </p>
              <table width="75%" height="129" align="center"  class="tabla">
               
                
                <tr align="center">
                  <td height="23" align="right">DPA:</td>
                  <th align="left"><select name="sel_cod_dpa" title="C&oacute;digo DPA" onChange="javascript: mostrar_fila();"id="sel_cod_dpa">
                        <option value="0">-----------------------</option>
                        <option value="1">Ciudad Habana y La Habana</option>
                        <?php 
						
								/*$tabla="n_dpa where cod_dpa_nueva='". 2300 ."' or cod_dpa_nueva='". 2200 ."' or incluido='". 1 ."'";
								$campo0=prov_mun;
								$campo1=cod_dpa;
								$campo_id=cod_dpa;
								$id=$_POST['sel_cod_dpa'];
								include($x."php/selected.php");*/
								?>
                      </select></th>
                </tr>
                <tr align="center"> 
                  <td width="19%" height="95" align="right">Consultas:</td>
                  <th width="81%" align="left"><textarea name="txt_consulta" cols="50" rows="5" id="txt_consulta" title="id"></textarea></th>
                </tr>
              
              </table>
              <br>
		    <?php
	

			 print $mensaje;
			 
	  ?></form >
            <!-- InstanceEndEditable --></td>
  </tr>
  
	</table>
	
	 </td></tr></table>
	
<table width="754" height="21"  border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#5A697E">
  <tr> 
    <td width="30" height="21"  align="center" valign="middle"> <div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><img src="../../imagenes/down.jpg" width="30" height="26"></font></div></td>
    <td width="695"  align="center" valign="middle" bgcolor="#4B4B4B">
      <div align="center"><font color="#FFFFFF" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>ONEI - 
    IPC 2009-2012</strong></font></div></td>
    <td width="30"  align="center" valign="middle"><div align="center"><img src="../../imagenes/up.jpg" width="30" height="26"></div></td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>