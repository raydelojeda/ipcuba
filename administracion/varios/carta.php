<?php 
$x="../../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."php/session/session_super.php");


if ($_GET["tipologia"]!="") $id_tipologia = $_GET['tipologia'];
if (isset($_POST["tipologia"])) $id_tipologia = $_POST['tipologia'];

if ($_GET["mercado"]!="") $id_mercado = $_GET['mercado'];
if (isset($_POST["mercado"])) $id_mercado = $_POST['mercado'];

$query = "select distinct ecod_var,cod_var,variedad, n_estab.cod_dpa, prov_mun, cod_estab, estab, dir, mercado 
from n_var_estab,b_variedad,n_variedad,n_mercado,n_estab, n_dpa,n_unidad, n_articulo,e_articulo,n_tipologia
where 
n_articulo.id_articulo=n_variedad.id_articulo and
n_var_estab.idb_variedad=b_variedad.idb_variedad and b_variedad.id_variedad=n_variedad.id_variedad 
and b_variedad.id_mercado=n_mercado.id_mercado and n_var_estab.id_estab=n_estab.id_estab
and n_estab.cod_dpa=n_dpa.cod_dpa
and n_unidad.id_unidad=n_var_estab.id_unidad
and n_variedad.ide_articulo=e_articulo.ide_articulo
and n_estab.id_tipologia=n_tipologia.id_tipologia and n_dpa.incluido='1' ";
if($id_tipologia)
$query=$query." and n_tipologia.id_tipologia='".$id_tipologia."'";
if($id_mercado)
$query=$query." and n_mercado.id_mercado='".$id_mercado."'";

$query=$query." order by n_estab.cod_dpa, estab, cod_estab, ecod_var";//and n_mercado.id_mercado!='3'and org_sup='Otros'

//print $query;
$rs = $db->Execute($query)or die($db->ErrorMsg());
?>

<html>
<head>
<title>IPC</title>
<link href="../../../css/azul.css" rel="stylesheet" type="text/css">
</head>

<body>



<?php
$rs->MoveFirst();
while (!$rs->EOF)
{
$merc=$rs->fields["mercado"];
$dpa=$rs->fields["cod_dpa"].". ".$rs->fields["prov_mun"];
$estab=$rs->fields["cod_estab"].". ".$rs->fields["estab"];
$dir=$rs->fields["dir"];
$var=$rs->fields["ecod_var"].". ".$rs->fields["variedad"];
if($rs->fields["ecod_var"]=="")
$var=$rs->fields["cod_var"].". ".$rs->fields["variedad"];

if($aux_e!=$estab)
{
?>
<br class="pag">
<table  align="center"width="750" border="0" cellspacing="0" cellpadding="0" class="cuadro4">

<tr>
<td height="21" colspan="4"  align="left" >&nbsp;</td>

</tr>
<?php }else{?>
<table  align="center"width="750" border="0" cellspacing="0" cellpadding="0" class="cuadro4">
<?php }?>

  <tr>
        <td width="166" height="7" align="center"  class="cuadro2"><div align="center">
          <?php if($aux_p!=$dpa || $aux_e!=$estab){echo $dpa;$aux_p=$dpa;}?>
        </div></td>
        <td width="221"align="center" class="cuadro2"><div align="center">
          <?php if($aux_e!=$estab){echo $estab;}?>
        </div></td>
<td width="290"align="center" class="cuadro2"><div align="center">
          <?php if($aux_d!=$dir || $aux_e!=$estab){echo $dir;$aux_d=$dir;}?>
	</div></td>                   
<td width="73"align="center" class="cuadro3"><div align="center">
          <?php if($aux_e!=$estab){echo $merc;$aux_m=$merc;}$aux_e=$estab;//
		  ?>
        </div></td>                    
  </tr>
  <tr>
    <td height="7" colspan="2"><div align="left">
		<?php echo $var;?>
        </div></td>
        <?php $rs->MoveNext();
        $estab=$rs->fields["cod_estab"].". ".$rs->fields["estab"];
        $var=$rs->fields["ecod_var"].". ".$rs->fields["variedad"];
        if($rs->fields["ecod_var"]=="")
        $var=$rs->fields["cod_var"].". ".$rs->fields["variedad"];
        if($aux_e!=$estab)$var="";
        ?> 
    <td height="18" colspan="2"><div align="left"><?php echo $var;?></div>
    </td>
  </tr>
</table>
<?php 
if($aux_e==$estab)
$rs->MoveNext();
}	
?>        

</body>
</html>
<?php 
/*
<tr>
<td height="21" colspan="4"  align="left" ><font face="Verdana, Arial, Helvetica, sans-serif"size="2">
Direcci&oacute;n General<br><br>
J ONEI -       /2010<br><br>

La Habana, 15 de septiembre de 2010<br><br>
&quot;A&Ntilde;O 52 DE LA REVOLUCI&Oacute;N&quot;<br><br>

<b>
Ref.: Captaci&oacute;n de Precios en las entidades seleccionadas, por parte de la Oficina Nacional de Estad&iacute;sticas
</b>
<br><br>

Estimado compa&ntilde;ero (a):<br><br>
</font>

<font face="Verdana, Arial, Helvetica, sans-serif" size="2">El &Iacute;ndice de Precios al Consumidor (IPC) es un indicador cuya finalidad es la de medir la evoluci&oacute;n de los precios de una lista de bienes y servicios que en promedio consumen las familias entre dos per&iacute;odos de tiempos determinados.
<br><br>
En estos momentos debe comenzar la captaci&oacute;n de precios en diferentes establecimientos seleccionados seg&uacute;n una muestra intencional, en todas las provincias del pa&iacute;s, en sus municipios cabecera  (excepto en Ciudad de la Habana que se recoge en los 15 municipios por la condici&oacute;n de capital que tiene la misma).
<br><br>
Los precios se toman en el establecimiento; en la fecha seg&uacute;n corresponda; observando directamente el art&iacute;culo; comprobando las especificaciones y caracter&iacute;sticas; anotando el precio del art&iacute;culo y cualquier observaci&oacute;n pertinente.
<br><br>
Para esta tarea se tiene un listado que contiene la lista de bienes y servicios a recoger precio en cada establecimiento de la muestra. Dicha relaci&oacute;n de productos asignados est&aacute; pendiente de posibles cambios en correspondencia con los movimientos de mercados existentes.
<br><br>
Los datos observados son confidenciales y de base para c&aacute;lculos macroecon&oacute;micos a nivel nacional.
<br><br>
Atentamente
<br><br>
<br><img src="../../../imagenes/firma.JPG"><br>
Oscar Mederos Mesa<br>
Jefe<br>
Oficina Nacional de Estad&iacute;sticas<br><br>


Relaci&oacute;n de productos asignados a recoger en el centro informante de la lista de bienes y servicios del IPC. </font></td>

</tr>*/?> 