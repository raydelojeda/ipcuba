<?php
$x="../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");

require($x."php/PHPMailerv2/class.phpmailer.php");


$query_usuario = " where usuario='".$_SESSION["user"]."' and usuario.cod_dpa=n_dpa.cod_dpa"; 
$sql_usuario = "select * from usuario,n_dpa".$query_usuario;		
$rs_usuario = $db->Execute($sql_usuario)or $mensaje=$db->ErrorMsg() ;
$id_usuario=$rs_usuario->Fields("id_usuario");
$nombre=$rs_usuario->Fields("nombre");
$cod_dpa=$rs_usuario->Fields("cod_dpa");
$prov_mun=$rs_usuario->Fields("prov_mun");
$apellidos=$rs_usuario->Fields("apellidos");
$usuario=$rs_usuario->Fields("email");

$asunto = "IPC"." ".$nombre." ".$apellidos." "."-"." ".$cod_dpa." ".$prov_mun." "."-"." ".date("Y/m/d h:i A");	
//$cabeceras = 'From: '.$usuario.'' . "\r\n" .'Reply-To: roger@one.cu' . "\r\n" .'X-Mailer: PHP/' . phpversion();	

//------------------------------------------------------------------------------------------------
$gestion = @fopen("c:\ip.txt", "r");
if ($gestion) 
{
	while (!feof($gestion)) 
	{
		$ip = $ip.fgets($gestion);	
																
	}
	fclose ($gestion);
}

if($ip=="") {$mostrar="No se ha enviado el mensaje porque ha habido algún error con el servidor.<br>Compruebe la dirección IP del servidor de correos.";
   header("Location: servidor.php?mostrar=".$mostrar);}


//-------------------------------------------------------------------------------------------------

class MyMailer extends PHPMailer {
    // Set default variables for all new objects
    var $From     = "usuario@one.cu";
    var $FromName = "IPC";
	var $Host     = "192.168.150.13";
    var $Mailer   = "smtp";                         // Alternative to IsSMTP()
    var $WordWrap = 75;
	var $SMTPAuth = true;
	var $Username = "usuario";
	var $Password ="";
 function set_host($ip) 
 	{
       $this->Host=$ip;print $this->Host;
    }

}



$mail = new MyMailer;

//$mail->set_host($ip);	
	
	
$gestor = @fopen($camino, "r");
if ($gestor) 
{
	while (!feof($gestor)) 
	{
		$bufer = $bufer.fgets($gestor);	
																
	}
	fclose ($gestor);
}





if($gestor)	
{
	
	if($bufer)
			{
			$file = @fopen("c:\salva_historica.txt", "a");
				if ($file) 
				{
				   
				   if (fwrite($file, $bufer."\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n//IPC"." ".$nombre." ".$apellidos." "."-"." ".$cod_dpa." ".$prov_mun." "."-"." ".date("Y/m/d h:i A")." ---------------------------------------------------------------------------------\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n") === FALSE) 
					{
						echo "No se puede escribir al archivo.";
						exit;
					}
					fclose($file);
				}
			}		
	
	
	//ini_set(SMTP,$ip);	
	$msj = wordwrap($bufer,70);							
	
	
	$mailTo="raydel@one.cu";
	$copia="roger@one.cu";
	
	
	if($mailTo!="")
	$mail->AddAddress("$mailTo",$name = "");
	if ($copia!="")
	$mail->AddCC("$copia",$name = "");
	$mail->Subject="$asunto";
	$mail->Body="$msj";
	$mail->Send();

	if(!$mail->Send())
		{
		  $mostrar2="No se ha enviado el mensaje porque ha habido algún error con el servidor.<br>Consulte al admistrador de la provincia.";
		   header("Location: ../../captaciones/autor/autor.php?mostrar=".$mostrar2);
		}
	else
		{
		//unlink($camino);
		$mostrar2="Mensaje enviado correctamente";
 		header("Location: ../../captaciones/autor/autor.php?mostrar=".$mostrar2);
		}
}
elseif (!$gestor)
{	
   $mostrar2="No se ha enviado el mensaje porque no ha realizado ningún cambio en la base de datos.";
   header("Location: ../../captaciones/autor/autor.php?mostrar=".$mostrar2);
}



/*



if($msj!="")
{$bool=mail('raydel@one.cu', $asunto, $msj , $cabeceras);}
	if($bool==1){unlink($camino);} 
	else {$mostrar="No se ha enviado el mensaje porque ha habido algún error con el servidor.<br>Compruebe la dirección IP del servidor de correos.";
   header("Location: servidor.php?mostrar=".$mostrar);}
}
if (!$gestor)
{	
   $mostrar2="No se ha enviado el mensaje porque no ha realizado ningún cambio en la base de datos.";
   header("Location: ../../cap_mun/autor/autor.php?mostrar=".$mostrar2);
}
else
{
if (!$gestion)
{ 		
		unlink("c:\ip.txt");
		$mostrar="Antes de enviar el mensaje rectifique la dirección IP de su servidor de correos.";
		header("Location: servidor.php?mostrar=".$mostrar);
}
}
if(($gestion)&&($gestor)&& ($bool==1))	
{
$mostrar2="Mensaje enviado correctamente";
 header("Location: ../../captaciones/autor/autor.php?mostrar=".$mostrar2);
}			
							
*/
?>

							