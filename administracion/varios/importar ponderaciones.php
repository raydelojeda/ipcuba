<?php 
include("../../adodb/adodb.inc.php");
include("../../coneccion/conn.php");
include("../../adodb/adodb-navigator.php");

$sql = "select * from pond_nivel_5";
//print $sql;
$rs = $db->Execute($sql);
$cant=$rs->RecordCount();

for($i=0;$i<$cant;$i++)
{
$ide=$rs->Fields("ide");
$n1=$rs->Fields("n1");
$n2=$rs->Fields("n2");
$n3=$rs->Fields("n3");
$n4=$rs->Fields("n4");
$n5=$rs->Fields("n5");
$n6=$rs->Fields("n6");

$sql1 = "UPDATE b_articulo SET  g_peso='$n1', r_peso='$n4' where id_mercado_nuevo='1' and ide_articulo='$ide'";//print $sql1."<br>";//CUP	
$db->Execute($sql1) or die($db->ErrorMsg());

$sql2 = "UPDATE b_articulo SET  g_peso='$n2', r_peso='$n5' where id_mercado_nuevo='2' and ide_articulo='$ide'";//print $sql2."<br>";//CUC	
$db->Execute($sql2) or die($db->ErrorMsg());

$sql3 = "UPDATE g_articulo SET  g_peso='$n3', r_peso='$n6' where ide_articulo='$ide'";//print $sql3;//CUP	
$db->Execute($sql3) or die($db->ErrorMsg());
//die();
$rs->MoveNext();
	
}

//-------------------------------------------------------------------------
$sql = "select * from pond_nivel_4";
//print $sql;
$rs = $db->Execute($sql);
$cant=$rs->RecordCount();

for($i=0;$i<$cant;$i++)
{
$ide=$rs->Fields("id");
$n1=$rs->Fields("n1");
$n2=$rs->Fields("n2");
$n3=$rs->Fields("n3");

$sql1 = "UPDATE b_subclase SET  r_peso='$n1' where id_mercado_nuevo='1' and ide_subclase='$ide'";print $sql1."<br>";//CUP	
$db->Execute($sql1) or die($db->ErrorMsg());

$sql2 = "UPDATE b_subclase SET  r_peso='$n2' where id_mercado_nuevo='2' and ide_subclase='$ide'";//print $sql2."<br>";//CUC	
$db->Execute($sql2) or die($db->ErrorMsg());

$sql3 = "UPDATE g_subclase SET  r_peso='$n3' where ide_subclase='$ide'";//print $sql3;//CUP	
$db->Execute($sql3) or die($db->ErrorMsg());
//die();
$rs->MoveNext();
	
}
//-------------------------------------------------------------------------
$sql = "select * from pond_nivel_3";
//print $sql;
$rs = $db->Execute($sql);
$cant=$rs->RecordCount();

for($i=0;$i<$cant;$i++)
{
$ide=$rs->Fields("id");
$n1=$rs->Fields("n1");
$n2=$rs->Fields("n2");
$n3=$rs->Fields("n3");

$sql1 = "UPDATE b_clase SET  r_peso='$n1' where id_mercado_nuevo='1' and id_clase='$ide'";//print $sql1."<br>";//CUP	
$db->Execute($sql1) or die($db->ErrorMsg());

$sql2 = "UPDATE b_clase SET  r_peso='$n2' where id_mercado_nuevo='2' and id_clase='$ide'";//print $sql2."<br>";//CUC	
$db->Execute($sql2) or die($db->ErrorMsg());

$sql3 = "UPDATE g_clase SET  r_peso='$n3' where id_clase='$ide'";//print $sql3;//CUP	
$db->Execute($sql3) or die($db->ErrorMsg());
//die();
$rs->MoveNext();
	
}
//-------------------------------------------------------------------------
$sql = "select * from pond_nivel_2";
//print $sql;
$rs = $db->Execute($sql);
$cant=$rs->RecordCount();

for($i=0;$i<$cant;$i++)
{
$ide=$rs->Fields("id");
$n1=$rs->Fields("n1");
$n2=$rs->Fields("n2");
$n3=$rs->Fields("n3");

$sql1 = "UPDATE b_grupo SET  r_peso='$n1' where id_mercado_nuevo='1' and id_grupo='$ide'";//print $sql1."<br>";//CUP	
$db->Execute($sql1) or die($db->ErrorMsg());

$sql2 = "UPDATE b_grupo SET  r_peso='$n2' where id_mercado_nuevo='2' and id_grupo='$ide'";//print $sql2."<br>";//CUC	
$db->Execute($sql2) or die($db->ErrorMsg());

$sql3 = "UPDATE g_grupo SET  r_peso='$n3' where id_grupo='$ide'";//print $sql3;//CUP	
$db->Execute($sql3) or die($db->ErrorMsg());
//die();
$rs->MoveNext();
	
}

//-------------------------------------------------------------------------
$sql = "select * from pond_nivel_1";
//print $sql;
$rs = $db->Execute($sql);
$cant=$rs->RecordCount();

for($i=0;$i<$cant;$i++)
{
$ide=$rs->Fields("id");
$n1=$rs->Fields("n1");
$n2=$rs->Fields("n2");
$n3=$rs->Fields("n3");

$sql1 = "UPDATE b_division SET  r_peso='$n1' where id_mercado_nuevo='1' and id_division='$ide'";//print $sql1."<br>";//CUP	
$db->Execute($sql1) or die($db->ErrorMsg());

$sql2 = "UPDATE b_division SET  r_peso='$n2' where id_mercado_nuevo='2' and id_division='$ide'";//print $sql2."<br>";//CUC	
$db->Execute($sql2) or die($db->ErrorMsg());

$sql3 = "UPDATE g_division SET  r_peso='$n3' where id_division='$ide'";//print $sql3;//CUP	
$db->Execute($sql3) or die($db->ErrorMsg());
//die();
$rs->MoveNext();
	
}//die();

?>
