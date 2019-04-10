<?php 
session_start();
$s_md5_password=$_SESSION["md5_pass"];
$s_user=$_SESSION["user"];
$s_sql="select * from usuario where usuario='$s_user' and clave='$s_md5_password'";
$s_rs=$db->Execute($s_sql) or print($db->ErrorMsg());
//print $s_rs->fields["rol"];
if (($s_rs->fields["rol"] == 'super') and $_SESSION["user"] == $s_rs->fields["usuario"])
{
$_SESSION["rol"]=$s_rs->fields["rol"];
}else
header("Location:".$x."seguridad/autenticacion.php");
?>
