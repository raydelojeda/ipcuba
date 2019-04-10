<?php 
include("../../adodb/adodb.inc.php");
include("../../conexion/connT.php");
include("../../adodb/adodb-navigator.php");
include("../../php/session/session_admin.php");
require("../../php/PhpMailerClass.php");
if (!($_SESSION["rol"] == 'Admin') && !($_SESSION["rol"] == 'JefeOperaciones') && !($_SESSION["rol"] == 'UsuarioAvanzado'))
{
header("Location: ../../php/logout.php");
}
$name_user = $_SESSION["usuario"];
$hora_registro = date( "H:i:s");
$fecha_registro = date( "Y-m-d");
/*if(isset($_POST['Enviar']))
{

$query = "Select * from personal where roll = 'Especialista'";
$rec = $db->execute($query) or die($db->ErrorMsg());
//print $rec;
$user="";
for ($i=0;$i<$rec->RecordCount();$i++)
{
 if ($user=="")
 {
  $user=$rec->Fields(6);
 }
 else
 {
  $user.=",".$rec->Fields(6);
 }
 $rec->MoveNext();
}
//print $user;
$t = mail("$user","Test Php mail()","Test de correos con Php...");
}
*/
$query = "Select email from n_area_responsable "; 
$combo = $db->execute($query);
//print $combo;
 
/*session_start();
if (!($_SESSION["login"] == 'Admin') && !($_SESSION["login"] == 'Especialista'))
{
header("Location: Autenticacion.php");
}*/
$mens = "";
 if (isset($_GET["id"]))
 {
	$query = " where id_reg_incidencia = '".$_GET["id"]."'"; 
	$sql = "select * from reg_incidencias".$query;
    $rs = $db->Execute($sql);
	
	$id_area_resp = $rs->fields["area_resp"];
    $query2 = "select * from n_area_responsable where id_area_resp = $id_area_resp";
    $rs2 = $db->Execute($query2) or die($db->ErrorMsg());
	$area = $rs2->fields['area_resp'];
	//$query_email = "Select * from n_area_responsable Where area_resp = '$areaResp'";
	//email = $db->execute($query_email) or die($db->ErrorMsg());
	$mailTo = $rs2->fields['email']; 
	$asunto = $_POST['txtAsunto'];
	$mensaje = $rs->fields['desc_incidencia'];
	$observaciones = $rs->fields['observaciones'];
	$referencia = $rs->fields['referencia'];
	$copia = $_POST['txtCopia'];
	$copiaOculta = $_POST['txtCopiaOculta'];
	$adjunto =  $_FILES['txtFile'];
	$user=$_SESSION["user"];
	$replayTo=$user."@havanatur.cu";
		
	 if(isset($_POST['Enviar']))
     {
	 //-----------------------------
	   if($_POST['txtAsunto']=="")
	   $mens = "<b>El mensaje debe contener Asunto.</b>";
	   else {
	   if($mailTo=="" && $copia=="" && $copiaOculta=="")
	   $mens = "<b>Mensaje sin destinatario. Especifique uno.</b>";
	   else {
	   $mail = new MyMailer;

// Now you only need to add the necessary stuff
if ($mailTo != "")
$mail->AddAddress("$mailTo", $name = $area);
if ($copia != "")
$mail->AddCC("$copia", "");
if ($copiaOculta != "")
$mail->AddBCC("$copiaOculta", $name = "");
$mail->Subject = "$asunto";
$mens_enviar = $_POST['txtMensaje'];
$mail->Body    = "$mens_enviar";
copy($_FILES['txtFile']['tmp_name'], '../../adjuntos/'.$_FILES['txtFile']['name']);
$attach = $mail->AddAttachment('../../adjuntos/'.$_FILES['txtFile']['name']);  // optional name
$mail->AddReplyTo("$replayTo", $name = '');

if(!$mail->Send())
{
   echo "There was an error sending the message";
   $entry = false;
   exit;
}
else{
    if ($copia == "") 
	   {
	    //$t = mail("$user","$asunto","$mensaje");
	    $mens = "<b>El mensaje fue enviado exitosamente.</b>";
	   }
	  else
	   {
	    //$t = mail("$user,$copia","$asunto","$mensaje"); 
	    $mens = "<b>El mensaje fue enviado exitosamente a todos los destinatarios.</b>";
	   }
	   //----------Inserto la acción de la tabla de Trazas------------------------------
	   if($mailTo!=="")
	   $sentTo=$mailTo;
	   if($copia!=="")
	   $sentTo.=",".$copia;
	   if($copiaOculta!=="")
	   $sentTo.=",".$copiaOculta;
	   //print $sentTo;
	   //$sentTo=$mailTo." - ".$copia." - ".$copiaOculta;
	   $query_ref="SELECT * FROM reg_incidencias WHERE id_reg_incidencia = '".$_GET["id"]."'";
	   $rec_ref=$db->Execute($query_ref) or die($db->ErrorMsg());
	   $referencia=$rec_ref->fields['referencia'];
	   $query_traza="INSERT INTO traza_incidencia (usuario,ref_incidencia,accion,fecha,hora,sent_to) VALUES ('$name_user',$referencia,'Envió por Mail','$fecha_registro','$hora_registro','$sentTo')";
	   $rec_traza=$db->Execute($query_traza) or die($db->ErrorMsg());
	  }
	  if ($attach)
	  unlink('../../adjuntos/'.$_FILES['txtFile']['name']);
}
//echo "Message was sent successfully";
}
	 //----------------------------------------------
	  
     }}
	
 //}
 else
 {
	$mens = "<b>Debe especificar un destinatario de correo válido.</b>";
	
	die();
 }
 $entry = true;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Env&iacute;o de Mensaje::Sistema de Registro de Incidencias, Havanatur S.A.</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

</head>
<script language="JavaScript" src="../../javascript/funciones.js" type="text/javascript">
var cabecera=window.screenTop
 
if (navigator.appName == 'Microsoft Internet Explorer')
{
   window.moveTo(-6,-cabecera)
   window.resizeTo(screen.width+9,screen.height+cabecera+25)
}
</script>
<body>
<p align="left"><font size="2"><strong> Usuario: </strong><?php echo $_SESSION["user"]; ?></font><br>
  <font size="2"><strong>Nombre: </strong><?php echo $_SESSION["name_user"]; ?> </font></p>
 <form action="" method="post" enctype="multipart/form-data" name="form2">
 <table width="695" border="0" align="center" bgcolor="#E8E8E8">
     <tr>
       <td width="64" align="right"><strong>Para:</strong></td>
       <td width="621" align="left"><strong>&lt;</strong><font size="2"><b><?php if($mailTo!="") echo $mailTo;else echo "Dirección de correo no definida en el Sistema" ?></b></font><strong>&gt;<font size="2"><strong><font size="3">&nbsp;*</font>Este es el correo del &aacute;rea responsable de la Incidencia. </strong></font></strong></td>
     </tr>
     <tr>
       <td align="right"><strong>Cc:</strong></td>
       <td align="left"><input name="txtCopia" type="text" id="txtCopia" size="40"> 
         <font size="2"><strong><font size="3"> *</font>Escriba otra direcci&oacute;n de correo para notificar la incidencia. </strong></font> </td>
     </tr>
     <tr>
       <td align="right"><strong>CCo:</strong></td>
       <td align="left"><input name="txtCopiaOculta" type="text" id="txtCopiaOculta" size="40"> 
         <font size="2"><strong><font size="3"> </font></strong></font><font size="2"><strong><font size="3">*</font>Escriba otra direcci&oacute;n de correo para notificar la incidencia.</strong></font></td>
     </tr>
     <tr>
       <td align="right"><strong>Asunto:</strong></td>
       <td align="left"><input name="txtAsunto" type="text" id="txtAsunto" size="69%" value="Registro de Incidencia Havanatur. No Referencia <?php echo $referencia;?>"> </td>
     </tr>
     <tr>
       <td align="right"><strong>Mensaje:</strong></td>
       <td align="left"><textarea name="txtMensaje" cols="65%" rows="7" id="txtMensaje"><?php echo "***Descripción de la Incidencia:\n"; echo $mensaje;?><?php echo "\n\n***Observaciones:\n"; echo $observaciones;?></textarea></td>
     </tr>
     <tr align="center">
       <td><strong>Adjunto:</strong></td>
       <td align="left"><input name="txtFile" type="file" id="txtFile"> 
         <font size="2"><strong><font size="3"> *</font>Opcional</strong></font> </td>
     </tr>
     <tr align="center">
       <td colspan="2"><?php echo $mens; ?>&nbsp;</td>
     </tr>
     <tr align="center">
       <td colspan="2"><input name="Enviar" type="submit" id="Enviar" value="Enviar">
	   <input  type="hidden" name="set" value="<?php echo $entry;?>"></td>
     </tr>
   </table>
</form>
</body>
</html>
