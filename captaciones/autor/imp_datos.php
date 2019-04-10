<?php 
$x="../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."php/session/session_autor.php");
include($x."adodb/adodb-navigator.php");
if (isset($_GET["order"])) $order = $_GET["order"]; else $order="captacion.fecha";
if (isset($_GET["type"])) $ordtype = $_GET["type"]; else $ordtype=desc;
if ($_GET["txt_filtro"]!="") $txt_filtro = $_GET['txt_filtro'];
if (isset($_POST["txt_filtro"])) $txt_filtro = $_POST['txt_filtro'];
if ($_GET["ver"]!="") $ver = $_GET['ver'];
if (isset($_POST["sel_#"])) $ver = $_POST['sel_#'];
if ($_GET["sel_filtro"]!="") $sel_filtro = $_GET['sel_filtro'];
if (isset($_POST["sel_filtro"])) $sel_filtro = $_POST['sel_filtro'];



//---------------------------------------------------					 
$sql_fecha = "select max(fecha) from b_variedad";		
$rs_fecha = $db->Execute($sql_fecha)or $mensaje=$db->ErrorMsg() ;
$fecha_base = $rs_fecha->Fields('max');//print $x;
//---------------------------------------------------

//---------------------------------------------------
$query_fecha = "select max (distinct fecha) from dato_provincial where fecha>='".$fecha_base."'";
$rs_fecha_prov = $db->Execute($query_fecha)or $mensaje=$db->ErrorMsg() ;
$fecha_prov = $rs_fecha_prov->Fields('max');//print $x;
//---------------------------------------------------
//---------------------------------------------------
$query_usuario = " where usuario='".$_SESSION["user"]."' and n_dpa.cod_dpa=usuario.cod_dpa"; 
$sql_usuario = "select id_usuario, usuario.cod_dpa,prov_mun from usuario,n_dpa".$query_usuario;	
//print 	$sql_usuario;
$rs_usuario = $db->Execute($sql_usuario)or $mensaje=$db->ErrorMsg() ;
//$id_usuario=$rs_usuario->Fields("id_usuario");
//$cod_dpa=substr($rs_usuario->Fields("cod_dpa"),0,2). 0 . 0;lo cambie para ver los municipios
$cod_dpa2=substr($rs_usuario->Fields("cod_dpa"),0,2);
$cod_dpa=$rs_usuario->Fields("cod_dpa");
$prov_mun=$rs_usuario->Fields("prov_mun");
//print $cod_dpa;
//---------------------------------------------------
$f=date("Y/m/d");
$mes=substr($f,4,4);
$año=substr($f,0,4);
$mes_actual=$año.$mes."01";

$query = "select fecha_captar,captacion.id_var_estab,id_cap, variedad, obs,cod_var, n_variedad.id_variedad, 
unidad, ,p_max,b_variedad.precio, tipologia,
cod_estab,dir,n_estab.cod_dpa, estab, prov_mun,  inc,captacion.id_inc,cantidad,
mercado, n_mercado.id_mercado, captacion.precio, captacion.fecha, captacion.id_usuario,
nombre, usuario, apellidos, ci, rol, telef, email,
captacion.valor1,captacion.valor2,captacion.valor3,captacion.valor4,captacion.valor5,captacion.valor6,valor7,valor8,valor9,valor10,
ecarac1,ecarac2,ecarac3,ecarac4,ecarac5,ecarac6,ecarac7,ecarac8,ecarac9,ecarac10

from captacion, usuario,n_dpa, n_obs, n_var_estab, b_variedad,n_variedad,n_mercado, n_estab,e_articulo, n_unidad, n_inc,n_tipologia

where e_articulo.ide_articulo=n_variedad.ide_articulo and
usuario.id_usuario=captacion.id_usuario and captacion.id_obs=n_obs.id_obs and 
captacion.id_var_estab=n_var_estab.id_var_estab and b_variedad.idb_variedad=n_var_estab.idb_variedad and 
n_var_estab.id_unidad=n_unidad.id_unidad and
captacion.id_inc=n_inc.id_inc and
n_variedad.id_variedad=b_variedad.id_variedad and n_mercado.id_mercado=b_variedad.id_mercado and 
n_var_estab.id_estab=n_estab.id_estab and 
n_estab.cod_dpa=n_dpa.cod_dpa 
AND n_tipologia.id_tipologia=n_estab.id_tipologia 
and  captacion.fecha>='".$fecha_base."' and captacion.fecha>='".$mes_actual."' and central='0'";

 if($rol!='admin')
 {
   if($rol=='aut_p') 
   {
     $query=$query."  and n_estab.cod_dpa like '".$cod_dpa2."'";
   }
   elseif($rol=='autor')
 $query=$query."  and n_estab.cod_dpa='".$cod_dpa."'";
 }
//print $query;
if($sel_filtro=="no")$txt_filtro='';
if (isset($txt_filtro) && $txt_filtro!='' && isset($sel_filtro) && $sel_filtro!='' && $sel_filtro!="no") {
   $query .= " and $sel_filtro ~* '$txt_filtro'";
  }
  if ($ordtype == "asc") { $ordtypestr = "desc"; } else { $ordtypestr = "asc"; }

if (isset($order) && $order!='') $query .= " order by $order";
if (isset($ordtype) && $ordtype!='') $query .= " " .str_replace("'", "''", $ordtype);

if($ver=="")
$ver=50;
//print $query;
$pager_nav = new CData_PagerNav($db, $query, $ver,"frm",$order,$ordtype);
$rs = $pager_nav->curr_rs;
//print $rs;

?>

<html>
<head>
<!--  
*** Plataforma en Software Libre
*** Realizado por Ing. Raydel Ojeda Figueroa
   -->
<title>IPC</title>

<link href="../../css/azul.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {
	font-size: 12px;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<table width="700" height="94"  align="center" cellpadding="0" cellspacing="0"  class="imprimir" >
<form method="post" name="frm" id="frm" >
      <tr align="center" valign="middle">
        <td height="39" colspan="16"  ><table width="713" height="40" border="0" cellpadding="0" cellspacing="0"  >
            <tr>
              <td height="20" colspan="3"><table width="100%" border="0" >
                  <tr >
                    <td valign="middle"  class="imprimir"><span class="style1">Datos a nivel Municipal</span></td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td width="263" height="20">&nbsp;</td>
              <td width="131" class="imprimir" align="right"><strong><?php echo "C&oacute;digo DPA:"." ".$cod_dpa;?></strong></td>
              <td width="319" class="imprimir" align="right"><a href="#">
                <?php
  					
  							$pager_nav->Render_Navegator();		?>
                </a>
                  <?php
				  		echo "&nbsp;&nbsp;<b>P&aacute;gina: </b>".$pager_nav->curr_page." de ". $pager_nav->count_page."&nbsp;";
 		  			  		$var=$_POST['sel_#'];		
							?>
                &nbsp;&nbsp; </td>
            </tr>
        </table></td>
      </tr>
      <tr align="center" valign="center"  >
        <td width="26" height="19" class="imp_celda"><strong>No</strong></td>
        <td width="91" class="imp_celda" ><strong>Mercado</strong></td>
        <td width="224" class="imp_celda" ><div align="left"><strong>Variedad</strong></div></td>
        <td width="168" class="imp_celda" ><strong>Establecimiento</strong></td>
        <td width="55" class="imp_celda" ><div align="right"><strong>Precio</strong></div></td>
        <td width="65" class="imp_celda" ><strong>Usuario</strong></td>
        <td width="84" class="imp_celda"><strong>Fecha digitada</strong></td>
  </tr>
      <?php
if($rs->fields[0]!='')
{	
  $cadenacheckboxp = "";
  	if ($rs->RecordCount() > 0)
  	{

	 	$rs->MoveFirst();
	
	  	while (!$rs->EOF)
	  	{
 ?>
      <tr  height="20" >
        <td height="22"   align="center" class="imp_celda">
          <?php $a=$pager_nav->index_rs++; echo $a; ?>        </td>
        <td  class="imp_celda" ><?php echo $rs->fields["mercado"];?></td>
        <td class="imp_celda"align="center"><div align="left"><?php echo $rs->fields["cod_var"]." ".$rs->fields["variedad"];?></div>        </td>
        <td class="imp_celda"align="center"><?php echo $rs->fields["estab"];?></td>
        <td align="center" class="imp_celda"><div align="right"><?php echo $rs->fields["precio"];?></div>        </td>
        <td class="imp_celda"align="center"><?php echo $rs->fields["usuario"];?></td>
        <td class="imp_celda"align="center"><?php echo $rs->fields["fecha"];?></td>
      </tr>
      <?php 
					
     

	  	$rs->MoveNext();
	  	}
  	}
  	
} 		
  ?>
</form>
</table> 

</body>
</html>
