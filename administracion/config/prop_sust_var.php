<?php
$x="../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");

$ano=date("Y");
$mes=date("m");
$dia=date("d");

$sql_usuario = "select id_usuario,rol, prov_mun,usuario.cod_dpa, cod_dpa_nueva from usuario,n_dpa where usuario='".$_SESSION["user"]."' and usuario.cod_dpa=n_dpa.cod_dpa";		
$rs_usuario = $db->Execute($sql_usuario)or $mensaje=$db->ErrorMsg() ;
// print $sql_usuario;     
$id_usuario=$rs_usuario->Fields("id_usuario");
$cod_dpa=$rs_usuario->Fields("cod_dpa");
$cod_dpa_nueva=$rs_usuario->Fields("cod_dpa_nueva");
$prov_mun=$rs_usuario->Fields("prov_mun");
$rol=$rs_usuario->Fields("rol");
$cod_dpa2=substr($rs_usuario->fields["cod_dpa"],0,2);
//print $cod_dpa2;
?>
<link href="../../css/azul.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style2 {color: #FFFFFF}
.style3 {
	font-size: 10px;
	font-weight: bold;
}
-->
</style>
<form method="post" name="frm" id="frm" >
<table width="750" height="280" align="center">
<tr>
<td>
<table class="cuadro12" width="100%" height="90" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td width="145" height="90">&nbsp;&nbsp;<img src="../../imagenes/one_logo111.PNG" width="114" height="26" /></td>
    <td width="213"><div align="center">
      <p class="style3">Sistema de Informaci&oacute;n de Estad&iacute;stica Nacional (SIEN)</p>
    </div></td>
    <td width="261"><p>&nbsp;</p>
      <p align="center"><b>PROPUESTA DE </b><b>SUSTITUCI&Oacute;N DE VARIEDADES </b></p>
      <p>&nbsp;</p></td>
    <td width="114" bordercolor="#FFFFFF" bgcolor="#FFFFFF"><p align="left"><strong>Modelo No. 9011-00 DPA:</b><b><?php print $cod_dpa_nueva;echo $rs_estab->fields["dir"]."&nbsp;";?></strong><strong><span class="style2"></span> A&ntilde;o: <?php print $ano;?></strong></p>
      </td>
    <td width="1"></div>
  </tr>
</table>

<table  width="100%" border="1"   cellpadding="0" cellspacing="0" class="cuadro17" align="center">
  <tr>
    <td width="28" rowspan="2" align="center" bordercolordark="#000000">No.</td>
    <td width="62" rowspan="2" align="center" bordercolordark="#000000">C&oacute;digo Estab.</td>
    <td width="171" rowspan="2" align="center" bordercolordark="#000000">Variedad a sustituir (anterior)</td>
    <td width="204" rowspan="2" align="center" bordercolordark="#000000">Variedad sustituta(actual)</td>
	<td colspan="6" rowspan="2" align="center" bordercolordark="#000000">Características</td>
    <td colspan="2" align="center" bordercolordark="#000000">Cambio de estab.</td>
    <td width="114"align="center" bordercolordark="#000000">Precio de la variedad sustituta</td>
     <td colspan="2" align="center" bordercolordark="#000000">Variedad sustituta</td>
     <td colspan="2" align="center" bordercolordark="#000000">Fecha</td>
	 <td height="24"  colspan="5" align="center" bordercolordark="#000000">Datos del nuevo establecimiento para la variedad sustituta</td>
	 <td colspan="2" align="center" bordercolordark="#000000">Admitida</td>
  </tr>
  <tr>
      <td width="64" align="center" bordercolordark="#000000">Si</td>
    <td width="27" align="center" bordercolordark="#000000">No</td>
    <td width="114" align="center" bordercolordark="#000000">Mes actual</td>
     <td width="21" align="center" bordercolordark="#000000">Cant.</td>
     <td width="18" align="center" bordercolordark="#000000">U/M</td>
	  <td width="18" align="center" bordercolordark="#000000">D&iacute;a</td>
	  <td width="18" align="center" bordercolordark="#000000">Mes</td>
	  <td width="171" align="center" bordercolordark="#000000">Mercado.</td>
    <td width="171" align="center" bordercolordark="#000000">Tipolog&iacute;a</td>
    <td width="204" align="center" bordercolordark="#000000">Nombre</td>
	<td width="171" align="center" bordercolordark="#000000">Dirección</td>
    <td width="204" align="center" bordercolordark="#000000">Teléfono </td>
	<td width="18" align="center" bordercolordark="#000000">Si</td>
	  <td width="18" align="center" bordercolordark="#000000">No</td>
  </tr>
  <?php //print $_POST['cont'];
  $cont=$_POST['cont'];//print $_POST['cod_estab'.$cont];
  if(cont!="")
   {
   
   if($_POST['cod_estab'.$cont]!=0)
   print $cont;
   	$cont=$cont+1;
	
   }
   else
   $cont=1;
  for($i=1;$i<=$cont;$i++)
  {
  ?>
  <tr>
    <td width="28" align="center" bordercolordark="#000000"><?php print $i;?></td>
    <td width="204" align="center" bordercolordark="#000000"><select name="cod_estab<?php print $i;?>" title="Codigo de Establecimiento" id="cod_estab" onchange="document.frm.submit();" class="combo">
      <option value="0">-----</option>
      <?php 
						 $query_cod_estab = "select distinct cod_estab,estab, cod_dpa_nueva,id_estab
					 	 from n_estab, n_dpa where n_dpa.cod_dpa=n_estab.cod_dpa order by cod_estab";
						//print	$query_cod_estab;
				if($rol=='aut_p') 
                 $query_cod_estab=$query_cod_estab."  and n_estab.cod_dpa like '".$cod_dpa2."'";
                        
                 if($rol=='autor')
                 $query_cod_estab=$query_cod_estab."  and n_estab.cod_dpa='".$cod_dpa."'";
                 //print	$query_cod_estab;
						 $rs_cod_estab=$db->Execute($query_cod_estab) or die($db->ErrorMsg()) ;
						 $cod_estab=$rs_cod_estab->Fields("cod_estab");
						 //print "cod_estab:".$cod_estab;
						 /*$estab=$rs_cod_estab->Fields("estab");
						 $id_estab=$rs_cod_estab->Fields("id_estab");*/
						 
						$cant_estab=$rs_cod_estab->RecordCount();
						$cod_estab_esc=$_POST['cod_estab'.$i];
						for ($f = 0; $f < $cant_estab;$f++)
						{
						$rs_fields0=$rs_cod_estab->Fields("estab");
						$rs_fields1=$rs_cod_estab->Fields("cod_estab");
						$rs_fields_id=$rs_cod_estab->Fields("id_estab");
						//print $rs_fields_id;

						echo"<option value=";echo $rs_fields_id;if($rs_fields_id==$cod_estab_esc){echo " selected ";}else $_POST['cod_estab']=""; echo "> "; if($rs_fields1){echo $rs_fields1; print ". ";}echo $rs_fields0; echo "</option>";
						$rs_cod_estab->MoveNext();
						}
						?></select>
    </td>
    <td width="204" align="center" bordercolordark="#000000"><select name="sel_var_a_sust<?php print $i;?>" title="Variedad a Sustituir" id="sel_var_a_sust" onChange="document.frm.submit();" class="combo">
                     	<option value="0">-----</option>		
                      <?php 
						
						if($cod_estab_esc!="" && $cod_estab_esc!=0)
						{
					 	
						//print $cod_estab_esc;
						 $query_variedad = "select variedad,ecod_var,n_var_estab.idb_variedad,id_var_estab, ide_articulo, n_variedad.id_variedad
					 	 from b_variedad,n_variedad,n_var_estab,n_estab, n_dpa
						 where n_dpa.cod_dpa=n_estab.cod_dpa and
						 b_variedad.id_variedad=n_variedad.id_variedad and
						 b_variedad.idb_variedad=n_var_estab.idb_variedad and
						 n_var_estab.id_estab=n_estab.id_estab and 
						 n_estab.cod_estab='".$cod_estab."' and ide_articulo!='1' and n_var_estab.desuso='0'
						 and incluido='1' and central='0'
						 order by n_variedad.cod_var ";
						 //print $query_variedad;
						 $rs_variedad=$db->Execute($query_variedad) or die($db->ErrorMsg()) ;
						 $ide_articulo=$rs_variedad->Fields("ide_articulo");
						 $id_variedad=$rs_variedad->Fields("id_variedad");
						 
						 
						$cant_rs=$rs_variedad->RecordCount();
						$cod=$_POST['sel_var_a_sust'.$i]; print $cod; 
						for ($d = 0; $d < $cant_rs;$d++)
						{
						$rs_fields0=$rs_variedad->Fields("variedad");
						$rs_fields1=$rs_variedad->Fields("ecod_var");
						$rs_fields_id=$rs_variedad->Fields("id_var_estab");print $rs_fields_id;

						echo"<option value=";echo $rs_fields_id;if($rs_fields_id==$cod){echo " selected ";}else $_POST['sel_var_a_sust']=""; echo "> "; if($rs_fields1){echo $rs_fields1; print ". ";}echo $rs_fields0; echo "</option>";
						$rs_variedad->MoveNext();
						}
						}?></select>
				        </td>
   <td width="204" align="center" bordercolordark="#000000"><select name="sel_var_sust<?php print $i;?>" title="sel_var_sust<?php print $i;?>" id="sel_var_sust" onChange="document.frm.submit();" class="combo">
                     	<option value="1">-----</option>
						<?php
						if($cod!="" || $cod!=0)
						{
						   $var_sust=$_POST['sel_var_a_sust'.$i];
						   $query_variedad_sust="select distinct n_variedad.id_variedad, variedad,ecod_var,id_articulo,carac1, carac2, carac3, carac4, carac5, carac6 from b_variedad,n_variedad,n_var_estab 
where b_variedad.id_variedad=n_variedad.id_variedad 
and b_variedad.idb_variedad=n_var_estab.idb_variedad 
and ide_articulo!='1' 
and central='0' 
and ide_articulo='".$ide_articulo."' 
						 order by n_variedad.ecod_var ";
						//print	$query_variedad_sust;
						 $rs_variedad_sust=$db->Execute($query_variedad_sust) or die($db->ErrorMsg()) ;
						 $carac1=$rs_variedad_sust->Fields("carac1");
						 $carac2=$rs_variedad_sust->Fields("carac2");
						 $carac3=$rs_variedad_sust->Fields("carac3");
						 $carac4=$rs_variedad_sust->Fields("carac4");
						 $carac5=$rs_variedad_sust->Fields("carac5");
						 $carac6=$rs_variedad_sust->Fields("carac6");
						 
						$cant_rs_sust=$rs_variedad_sust->RecordCount();
						$cod_sust=$_POST['sel_var_sust'.$i];
						for ($c = 0; $c < $cant_rs_sust;$c++)
						{
						$rs_fields0=$rs_variedad_sust->Fields("variedad");
						$rs_fields1=$rs_variedad_sust->Fields("ecod_var");
						$rs_fields_id=$rs_variedad_sust->Fields("id_variedad");

						echo"<option value=";echo $rs_fields_id;if($rs_fields_id==$cod_sust){echo " selected";}else $_POST['sel_var_sust'.$i]=""; echo "> "; if($rs_fields1){echo $rs_fields1; print ". ";}echo $rs_fields0; echo "</option>";
						$rs_variedad_sust->MoveNext();
						}
						}?></select>
                        </td>
												
						<td <?php print "width=\"". 7*strlen($carac1)+70 ."\"" ?> align="center" bordercolordark="#000000"><?php if($carac1!=''){ print $carac1.':';$carac1="";?><input  name="carac1<?php print $i;?>"  type="text"   id="carac1" title="Carac1<?php print $i;?>"   size="10" class="text" /><?php }else print "&nbsp;";?></td>
						
						<td <?php print "width=\"". 7*strlen($carac2)+70 ."\"" ?> align="center" bordercolordark="#000000"><?php if($carac2!=''){ print $carac2.':';$carac2="";?><input  name="carac2<?php print $i;?>"  type="text"   id="carac2" title="Carac2<?php print $i;?>"   size="10" class="text" /><?php }else print "&nbsp;";?></td>
						
						<td <?php print "width=\"". 7*strlen($carac3)+70 ."\"" ?> align="center" bordercolordark="#000000"><?php if($carac3!=''){ print $carac3.':';$carac3="";?><input  name="carac3<?php print $i;?>"  type="text"   id="carac3" title="Carac3<?php print $i;?>"   size="10" class="text" /><?php }else print "&nbsp;";?></td>
						
						<td <?php print "width=\"". 7*strlen($carac4)+70 ."\"" ?> align="center" bordercolordark="#000000"><?php if($carac4!=''){ print $carac4.':';$carac4="";?><input  name="carac4<?php print $i;?>"  type="text"   id="carac4" title="Carac4<?php print $i;?>"   size="10" class="text" /><?php }else print "&nbsp;";?></td>
						
						<td <?php print "width=\"". 7*strlen($carac5)+70 ."\"" ?> align="center" bordercolordark="#000000"><?php if($carac5!=''){ print $carac5.':';$carac5="";?><input  name="carac5<?php print $i;?>"  type="text"   id="carac5" title="Carac5<?php print $i;?>"   size="10" class="text" /><?php }else print "&nbsp;";?></td>
						
						<td <?php print "width=\"". 7*strlen($carac6)+70 ."\"" ?> align="center" bordercolordark="#000000"><?php if($carac6!=''){ print $carac6.':';$carac6="";?><input  name="carac6<?php print $i;?>"  type="text"   id="carac6" title="Carac6<?php print $i;?>"   size="10" class="text" /><?php }else print "&nbsp;";?></td>
    <td width="64" align="center" bordercolordark="#000000"><input name="radio_cambio_est<?php print $i;?>" type="radio" value="1" > </td>
  <td width="27" align="center" bordercolordark="#000000"><input name="radio_cambio_est<?php print $i;?>" type="radio" value="2" checked="checked" onChange="document.frm.submit();"> </td>
    <td width="114" align="center" bordercolordark="#000000"><input  name="precio_var<?php print $i;?>"  type="text"   id="precio_var" title="Precio_var<?php print $i;?>"   size="10" class="text"/></td>
    <td width="21" align="center" bordercolordark="#000000"><input  name="cant_var<?php print $i;?>"  type="text"   id="cant_var" title="Cant_var<?php print $i;?>"   size="10" class="text"/></td>
    <td width="18" align="center" bordercolordark="#000000"><select name="sel_unidad<?php print $i;?>" title="Unidad de Medida<?php print $i;?>" id="sel_unidad" class="combo">
                       <option value="0">--------</option>  
                       <?php 
					   $sel_corr_uni="select distinct id_unidad, unidad from n_correlacionador, n_unidad where n_correlacionador.id_unidad_g=n_unidad.id_unidad or n_correlacionador.id_unidad_p=n_unidad.id_unidad";
					   //print $sel_corr_uni;
					   $rs_corr_uni=$db->Execute($sel_corr_uni) or die($db->ErrorMsg());
					   $cant_corr_uni=$rs_corr_uni->RecordCount();
					   $rs_corr_uni->MoveFirst();
					   for ($g = 0; $g < $cant_corr_uni;$g++)
							{
							    $rs_fields0=$rs_corr_uni->Fields("id_unidad");
								$rs_fields1=$rs_corr_uni->Fields("unidad");									
								echo"<option value=\"".$rs_fields0."\">".$rs_fields1."</option>";
								$rs_corr_uni->MoveNext();
							}                   
						?>
                       </select></td>
	<td width="18" align="center" bordercolordark="#000000"><?php print $dia;?> </td>
	 <td width="18" align="center" bordercolordark="#000000"><?php print $mes;?> </td>
	 <td width="171" align="center" bordercolordark="#000000">
  <select name="sel_mercado<?php print $i;?>" title="Mercado<?php print $i;?>" id="sel_mercado" onChange="document.frm.submit();"  class="combo">
                        <option value="0">-----------------------</option>
                        <?php  
					  	
                    	 $query_mercado = "select distinct n_mercado.id_mercado, mercado
						 from n_mercado, n_var_estab,b_variedad, n_estab, n_variedad
						 WHERE n_mercado.id_mercado=b_variedad.id_mercado 
						 and n_var_estab.idb_variedad=b_variedad.idb_variedad 
						 and n_estab.id_estab=n_var_estab.id_estab 
						 and b_variedad.id_variedad=n_variedad.id_variedad
						 and central='0' ";
						 //print	$query_mercado;
						 if($rol=="autor")
						 $query_mercado=$query_mercado." and n_estab.cod_dpa='".$cod_dpa."'";
						 if($rol=="aut_p")
						 $query_mercado=$query_mercado." and n_estab.cod_dpa like'".$cod_dpa2."%'";
						 
						 $query_mercado=$query_mercado." order by mercado";
						  //print	$query_mercado;
						 $rs_mercado=$db->Execute($query_mercado) or $mensaje=$db->ErrorMsg() ;
					  //print $query_mercado;
					  //else $_POST['sel_mercado']="";
					  $id=$rs_mercado->Fields("n_mercado.id_mercado"); 
					  if($rs_mercado->Fields("mercado")!="") 
						{
							$cant_rs=$rs_mercado->RecordCount();
							$mercado=$_POST['sel_mercado'.$i];	
 							for ($mer = 0; $mer < $cant_rs;$mer++)
							{
							$rs_fields0=$rs_mercado->Fields("mercado");
						    $rs_fields_id=$rs_mercado->Fields("id_mercado");
							
							
							echo"<option value=";echo $rs_fields_id;if($rs_fields_id==$mercado){echo " selected ";}else $_POST['sel_mercado']=""; echo "> "; echo $rs_fields0; echo "</option>";
							
        					$rs_mercado->MoveNext();
							}						
					    }                 
							
					?></select>
                   
  </td>
  <td width="171" align="center" bordercolordark="#000000"> <select name="sel_tipologia<?php print $i;?>" title="Tipología<?php print $i;?>" id="sel_tipologia" onChange="document.frm.submit();" class="combo">
                    <option value="0">-----------------------</option>
                    <?php 
					print $mercado;
						if($mercado!=0 && $mercado!="")
						{
                    	 $query_tipologia = "select distinct tipologia, n_tipologia.id_tipologia
						 from n_tipologia, n_estab, n_var_estab,b_variedad, n_variedad
						 WHERE n_tipologia.id_tipologia=n_estab.id_tipologia  
						 and n_var_estab.idb_variedad=b_variedad.idb_variedad 
						 and n_estab.id_estab=n_var_estab.id_estab 
						 and n_estab.id_mercado='".$mercado."' 
						 and b_variedad.id_variedad=n_variedad.id_variedad
						 and central='0'";					 
						 
						 if($rol=="autor")
						 $query_tipologia=$query_tipologia." and n_estab.cod_dpa='".$cod_dpa."'";
						 if($rol=="aut_p")
						 $query_tipologia=$query_tipologia." and n_estab.cod_dpa like '".$cod_dpa2."%'";
						 
						 $query_tipologia=$query_tipologia." order by tipologia";				 						 //print $query_tipologia;
						 $rs_tipologia=$db->Execute($query_tipologia) or die($db->ErrorMsg()) ;
					     
						 $cant_rs_tipologia=$rs_tipologia->RecordCount();
						 $id_tipologia=$_POST['sel_tipologia'.$i];
 							for ($t = 0; $t < $cant_rs_tipologia;$t++)
							{
							$rs_fields0=$rs_tipologia->Fields("tipologia");
						    $rs_fields_id=$rs_tipologia->Fields("id_tipologia");
							
							echo"<option value=";echo $rs_fields_id;if($rs_fields_id==$id_tipologia){echo " selected ";}else $_POST['sel_tipologia']=""; echo "> "; echo $rs_fields0; echo "</option>";
							
							$rs_tipologia->MoveNext();
							}	 
						} 			
					 ?></select>
                  </td>
    <td width="204" align="center" bordercolordark="#000000"><input  name="nombre_est<?php print $i;?>"  type="text"   id="nombre_est" title="Nombre_est<?php print $i;?>"   size="10" class="text"/></td>
	<td width="171" align="center" bordercolordark="#000000"><input  name="direccion<?php print $i;?>"  type="text"   id="direccion" title="Direccion<?php print $i;?>"   size="10" class="text"/></td>
    <td width="204" align="center" bordercolordark="#000000"><input  name="telefono<?php print $i;?>"  type="text"   id="telefono" title="Telefono<?php print $i;?>"   size="10" class="text"/></td>
	<td width="18" align="center" bordercolordark="#000000"><input name="autorizacion<?php print $i;?>" type="radio" value="1" ></td>
	 <td width="18" align="center" bordercolordark="#000000"><input name="autorizacion<?php print $i;?>" type="radio" value="2" ></td>
  </tr>
  
   <?php
   
  }
  ?>
  <input name="cont" type="hidden" value="<?php print $cont;?>" />
</table>
</td>
</tr>
</table>
</form>