<?php 

include("../adodb/adodb.inc.php");
include("../coneccion/conn.php");



$estab= "select * from n_estab where id_mercado='3' and estab like '%3'";	
$rs = $db->Execute($estab)or $mensaje=$db->ErrorMsg() ;

$cant_estab=$rs->RecordCount();
//print  $cant_estab;

$a=0;
for($i=0;$i<$cant_estab;$i++)
{
$id_estab=$rs->Fields("id_estab");
$dir=$rs->Fields("dir");
$cod_dpa=$rs->Fields("cod_dpa");
$id_tipologia=$rs->Fields("id_tipologia");
$id_mercado=$rs->Fields("id_mercado");

$estab2=str_replace("3", "4", $rs->Fields("estab"));

$cod_estab2=str_replace("3", "4", $rs->Fields("cod_estab"));
$cod_estab3=str_replace("3", "5", $rs->Fields("cod_estab"));
$estab3=str_replace("3", "5", $rs->Fields("estab"));

/*$update="update n_estab set estab='".$uestab."', cod_estab='".$cod_estab."' where id_estab='".$id_estab."'";
$rs_u=$db->Execute($update)or $mensaje=$db->ErrorMsg() ;*/

$insert="insert into n_estab (cod_estab,estab,dir,cod_dpa,id_tipologia,id_mercado) values ('".$cod_estab2."','".$estab2."','".$dir."','".$cod_dpa."','".$id_tipologia."','".$id_mercado."') ";
//print $insert;
$rs_insert=$db->Execute($insert)or $mensaje=$db->ErrorMsg() ;
$insert2="insert into n_estab (cod_estab,estab,dir,cod_dpa,id_tipologia,id_mercado) values ('".$cod_estab3."','".$estab3."','".$dir."','".$cod_dpa."','".$id_tipologia."','".$id_mercado."') ";
//print $insert;
$rs_insert2=$db->Execute($insert2)or $mensaje=$db->ErrorMsg() ;


if($rs_insert && $rs_insert2 && $rs_u)
{
$a=$a+1;

}  
$rs->MoveNext();	
}
print $a;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
