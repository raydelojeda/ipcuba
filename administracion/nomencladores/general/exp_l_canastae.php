<?php 
$x="../../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."adodb/adodb-navigator.php");
include($x."php/session/session_invitado.php");
include($x."php/generar_excel_apis.php");
$f=0;

if ($_GET["ver"]!="") $ver = $_GET['ver'];
if (isset($_POST["sel_#"])) $ver = $_POST['sel_#'];


$query = "select * from 

n_division,
n_grupo,
n_clase,
e_subclase,
e_articulo
,n_variedad
WHERE 
(n_division.id_division = n_grupo.id_division) 
AND  (n_grupo.id_grupo=n_clase.id_grupo) 
AND  (n_clase.id_clase=e_subclase.id_clase)  
AND  (e_subclase.ide_subclase=e_articulo.ide_subclase)  
and (e_articulo.ide_articulo = n_variedad.ide_articulo)
and  e_subclase.subclase!='generico'

ORDER BY cod_division,cod_grupo,cod_clase,cod_subclase,ecod_articulo,ecod_var";
//print $query;,n_variedad AND  (e_articulo.ide_articulo = n_variedad.ide_articulo),cod_var 


$rs = $db->Execute($query)or die($db->ErrorMsg());




header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel");
header ("Content-Disposition: attachment; filename=Lista de bienes y servicios IPC.xls" );
header ("Content-Description: PHP/INTERBASE Generated Data" );
xlsBOF(); // begin Excel stream



xlsWriteLabel(0,0,"Lista de bienes y servicios del IPC.");

//$f=1;
xlsWriteLabel(1,1,"Nivel");
xlsWriteLabel(1,2,"Código");
xlsWriteLabel(1,3,"Agregado");
$f=1;

while (!$rs->EOF)
{



if($cod_division_0!=$rs->fields["cod_division"]) {
$f=$f+1;
$cod_division_0=$rs->fields["cod_division"];
xlsWriteLabel($f,2,$rs->fields["cod_division"]);
xlsWriteLabel($f,3,$rs->fields["division"]);
xlsWriteNumber($f,1,1);
$corrimiento=6;

} if($cod_grupo_0!=$rs->fields["cod_grupo"]) {
$f=$f+1;
$cod_grupo_0=$rs->fields["cod_grupo"];
xlsWriteLabel($f,2,$rs->fields["cod_grupo"]);
xlsWriteLabel($f,3,$rs->fields["grupo"]);
xlsWriteNumber($f,1,2);


} if($cod_clase_0!=$rs->fields["cod_clase"]) {
$f=$f+1;
$cod_clase_0=$rs->fields["cod_clase"];
xlsWriteLabel($f,2,$rs->fields["cod_clase"]);
xlsWriteLabel($f,3,$rs->fields["clase"]);
xlsWriteNumber($f,1,3);


} if($cod_subclase_0!=$rs->fields["cod_subclase"]) {
$f=$f+1;
$cod_subclase_0=$rs->fields["cod_subclase"];
xlsWriteLabel($f,2,$rs->fields["cod_subclase"]);
xlsWriteLabel($f,3,$rs->fields["subclase"]);
xlsWriteNumber($f,1,4);


} if($ecod_articulo_0!=$rs->fields["ecod_articulo"]) {
$f=$f+1;
$ecod_articulo_0=$rs->fields["ecod_articulo"];
xlsWriteLabel($f,2,$rs->fields["ecod_articulo"]);
xlsWriteLabel($f,3,$rs->fields["earticulo"]);
xlsWriteNumber($f,1,5);
$f=$f+1;
}
else
$f=$f+1;
//
xlsWriteLabel($f,2,$rs->fields["ecod_var"]);
xlsWriteLabel($f,3,$rs->fields["variedad"]);
xlsWriteNumber($f,1,6);



$rs->MoveNext();
}
xlsEOF();  


?>

