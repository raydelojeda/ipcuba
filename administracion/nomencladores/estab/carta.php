<?php 
$x="../../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."php/session/session_autor.php");


if ($_GET["tipologia"]!="") $id_tipologia = $_GET['tipologia'];
if ($_GET["mercado"]!="") $id_mercado = $_GET['mercado'];
if ($_GET["cod_dpa"]!="") $cod_dpa = $_GET['cod_dpa'];
if ($_GET["cbx_listado"]!="") $cbx_listado = $_GET['cbx_listado'];
//print $cbx_listado;
$query = "select distinct ecod_var,cod_var,variedad, n_estab.cod_dpa, prov_mun, cod_estab, estab, dir, mercado 
from n_var_estab,b_variedad,n_variedad,n_mercado,n_estab, n_dpa,n_unidad, n_articulo,e_articulo,n_tipologia
where 
n_articulo.id_articulo=n_variedad.id_articulo and
n_var_estab.idb_variedad=b_variedad.idb_variedad and b_variedad.id_variedad=n_variedad.id_variedad 
and b_variedad.id_mercado=n_mercado.id_mercado and n_var_estab.id_estab=n_estab.id_estab
and n_estab.cod_dpa=n_dpa.cod_dpa
and n_unidad.id_unidad=n_var_estab.id_unidad
and n_variedad.ide_articulo=e_articulo.ide_articulo and n_variedad.ide_articulo!='1'
and n_estab.id_tipologia=n_tipologia.id_tipologia and n_dpa.incluido='1'";
if($id_tipologia)
$query=$query." and n_tipologia.id_tipologia='".$id_tipologia."'";
if($id_mercado)
$query=$query." and n_mercado.id_mercado='".$id_mercado."'";
if($cod_dpa)
$query=$query." and n_dpa.cod_dpa='".$cod_dpa."'";

$query=$query." order by n_estab.cod_dpa, estab, cod_estab, ecod_var";//and n_mercado.id_mercado!='3'

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
<td height="21" colspan="4"  align="left" ><font face="Verdana, Arial, Helvetica, sans-serif"size="2">
<?php if($cbx_listado!="on")
{?>
<img src="../../../imagenes/3.jpg"><br><br>

<br>

A:_____________________________<br><br>
</font>

<font face="Verdana, Arial, Helvetica, sans-serif" size="2">La Oficina Nacional de Estad&iacute;sticas e Informaci&oacute;n calcula el &Iacute;ndice de Precios al Consumidor (IPC) sistem&aacute;ticamente como herramienta importante para medir la evoluci&oacute;n de los precios de una lista de bienes y servicios que en promedio consumen las familias cubanas. 
<br><br>

A partir de noviembre de 2010, la ONEI calcula el IPC con una nueva estructura. La
construcci&oacute;n de este &iacute;ndice supone, que se capten los precios de los bienes y servicios
identificados, en todos los tipos de establecimientos y lugares donde se ofertan en el pa&iacute;s.
<br><br>
Luego de un exhaustivo trabajo, la ONEI ha seleccionado una muestra intencional de unos 2500
lugares que abarcan 298 productos con unos 23000 precios a los que le
da seguimiento.
<br><br>
La instituci&oacute;n que usted dirige ha sido seleccionada en una muestra representativa a nivel nacional y ello requiere la observaci&oacute;n peri&oacute;dica de un conjunto de precios seg&uacute;n el anexo a la presente.
<br><br>
Los precios se recolectan en el establecimiento, en la fecha correspondiente, observando directamente el art&iacute;culo y comprobando sus especificaciones y caracter&iacute;sticas.
<br><br>
El personal que realizar&aacute; esta observaci&oacute;n estar&aacute; debidamente identificado como trabajador de la Oficina Nacional de Estad&iacute;sticas e Informaci&oacute;n y mandatado por ella.
<br><br>
Llamo su atenci&oacute;n que los datos observados son confidenciales y sirven solo de base para c&aacute;lculos macroecon&oacute;micos nacionales, por lo que no se utilizar&aacute;n para otras funciones.
<br><br>
Agradezco su colaboraci&oacute;n<br><br>
	
Delegado Provincial<br><br>


Firma y cu&ntilde;o:<br><br>
Oficina Nacional de Estad&iacute;sticas e Informaci&oacute;n<br><br>
<table cellpadding="0" cellspacing="0" border="1"  bordercolor="#000000" width="750"  ><tr><td align="center">
<br><font face="Verdana, Arial, Helvetica, sans-serif" color="#000000" size="2">
&nbsp;&nbsp;Para cualquier informaci&oacute;n o pregunta sobre este trabajo debe dirigirse a:
<br><br>
&nbsp;&nbsp;__________________________________________________________________________________<br><br>
&nbsp;&nbsp;__________________________________________________________________________________<br><br>
&nbsp;&nbsp;Tel&eacute;fono:__________________________________________________________________________<br><br><br>

</font>

</td></tr></table>

<br><br>
<?php }?>
<br>
Relaci&oacute;n de productos asignados a recoger en el centro informante de la lista de bienes y servicios del IPC. </font></td>

</tr>
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
