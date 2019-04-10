<?php 
$x="../";
include($x."adodb/adodb.inc.php") ;
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."php/session/session_admin.php") ;

//---------------------------------------------------
$sql_fecha_i_articulo = "select max(fecha) from i_art_dpa";
$rs_fecha_i_articulo = $db->Execute($sql_fecha_i_articulo) ;
$fecha_i_articulo = $rs_fecha_i_articulo->Fields('max') or die($db->ErrorMsg());
//---------------------------------------------------

$db->Execute("delete from d_division where fecha>='$fecha_i_articulo'") or die($db->ErrorMsg());
$db->Execute("delete from d_grupo where fecha>='$fecha_i_articulo'") or die($db->ErrorMsg());
$db->Execute("delete from d_clase where fecha>='$fecha_i_articulo'") or die($db->ErrorMsg());
$db->Execute("delete from d_subclase where fecha>='$fecha_i_articulo'") or die($db->ErrorMsg());
$db->Execute("delete from d_articulo where fecha>='$fecha_i_articulo'") or die($db->ErrorMsg());
$db->Execute("delete from d_art_dpa where fecha>='$fecha_i_articulo'") or die($db->ErrorMsg());
$db->Execute("delete from d_var_dpa where fecha>='$fecha_i_articulo'") or die($db->ErrorMsg());
$db->Execute("delete from d_general where fecha>='$fecha_i_articulo'") or die($db->ErrorMsg());

$db->Execute("delete from i_division where fecha>='$fecha_i_articulo'") or die($db->ErrorMsg());
$db->Execute("delete from i_grupo where fecha>='$fecha_i_articulo'") or die($db->ErrorMsg());
$db->Execute("delete from i_clase where fecha>='$fecha_i_articulo'") or die($db->ErrorMsg());
$db->Execute("delete from i_subclase where fecha>='$fecha_i_articulo'") or die($db->ErrorMsg());
$db->Execute("delete from i_articulo where fecha>='$fecha_i_articulo'") or die($db->ErrorMsg());
$db->Execute("delete from i_art_dpa where fecha>='$fecha_i_articulo'") or die($db->ErrorMsg());
$db->Execute("delete from i_var_dpa where fecha>='$fecha_i_articulo'") or die($db->ErrorMsg());
$db->Execute("delete from i_general where fecha>='$fecha_i_articulo'") or die($db->ErrorMsg());

header("Location:../administracion/config/admin.php?msg=Todos los datos de índices y microíndices han sido eliminados para el mes de ".$fecha_text.". Puede realizar el cálculo nuevamente.");
?>

