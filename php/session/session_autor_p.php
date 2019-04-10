<?php 
session_start();
$s_md5_password=$_SESSION["md5_pass"];
$s_user=$_SESSION["user"];
$s_sql="select * from usuario where usuario='$s_user' and clave='$s_md5_password'";
$s_rs=$db->Execute($s_sql) or print($db->ErrorMsg());

$_SESSION["rol"]=$s_rs->fields["rol"];
if ($_SESSION["rol"] == 'autor' || $_SESSION["rol"] == '' ||  $_SESSION["user"] != $s_rs->fields["usuario"])
{
header("Location:".$x."seguridad/autenticacion.php");
}
?>