<?php
$x="../../";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");

$ano=date("Y");
$mes=date("m");
$dia=date("d");
$fecha=date("Y,m,d");
$sql_usuario = "select id_usuario,rol, prov_mun,usuario.cod_dpa, cod_dpa_nueva from usuario,n_dpa where usuario='".$_SESSION["user"]."' and usuario.cod_dpa=n_dpa.cod_dpa";		
$rs_usuario = $db->Execute($sql_usuario)or $mensaje=$db->ErrorMsg() ;
// print $sql_usuario;     
$id_usuario=$rs_usuario->Fields("id_usuario");

$cod_dpa=$rs_usuario->Fields("cod_dpa");
$cod_dpa_nueva=$rs_usuario->Fields("cod_dpa_nueva");
$prov_mun=$rs_usuario->Fields("prov_mun");
$rol=$rs_usuario->Fields("rol");
$cod_dpa2=substr($rs_usuario->fields["cod_dpa"],0,2);


$sel_mercado = $db->qstr($_POST['sel_mercado'], $magic_quotes);
$sel_tipologia = $db->qstr($_POST['sel_tipologia'], $magic_quotes);
$sel_estab = $db->qstr($_POST['sel_estab'], $magic_quotes);
$nombre_est = $_POST['nombre_est'];
$direccion = $_POST['direccion'];
$contacto = $_POST['contacto'];
$telefono = $_POST['telefono'];
$autorizacion = $_POST['autorizacion'];
//print "mercado:".$sel_mercado;
//print "tipologia:".$sel_tipologia;
//print "estab:".$sel_estab;
//print "nombre_estab:".$nombre_est;
//print "dir:".$direccion;
//print "contacto:".$contacto;
//print "telef:".$telefono;
//print "aut:".$autorizacion;

if($_POST['sel_mercado']!="0" && $_POST['sel_mercado']!="" && $_POST['sel_tipologia']!="0" && $_POST['sel_tipologia']!="" /*&&  $autorizacion=="1"*/)
				{	
		
					$tip="select * from n_tipologia where id_tipologia=".$sel_tipologia."";
					//print $tip;
					$rs_tip= $db->Execute($tip)or $mensaje=$db->ErrorMsg();
					$tip_nueva=$rs_tip->Fields("id_tipologia_nueva"); 
					$sel_cod_dpa="select n_estab.cod_dpa,org_sup, cod_dpa_nueva from n_estab, n_dpa where n_estab.cod_dpa=n_dpa.cod_dpa and n_estab.id_estab=".$sel_estab."";
					//print $sel_cod_dpa;
					$rs_cod_dpa=$db->Execute($sel_cod_dpa)or $mensaje=$db->ErrorMsg();
					$cod_dpa_estab=$rs_cod_dpa->Fields("cod_dpa");
					$org_sup=$rs_cod_dpa->Fields("org_sup");
					$dpa_nueva=$rs_cod_dpa->Fields("cod_dpa_nueva");
					
					$sel_cod_estab="select max(cod_estab) from n_estab,n_dpa,n_tipologia,n_mercado 
					where n_mercado.id_mercado=n_estab.id_mercado and n_estab.cod_dpa=n_dpa.cod_dpa and  n_estab.id_tipologia=n_tipologia.id_tipologia and incluido ='1' and n_mercado.id_mercado=".$sel_mercado." and n_tipologia.id_tipologia_nueva='$tip_nueva'";
					if($rol=="autor")
					$sel_cod_estab=$sel_cod_estab." and n_estab.cod_dpa='".$cod_dpa."'";
									
					if($rol=="aut_p")
					
					$sel_cod_estab=$sel_cod_estab." and n_estab.cod_dpa like '".$cod_dpa2."%'";
					
					if($rol=="admin" || $rol=="edito")
					
					$sel_cod_estab=$sel_cod_estab." and n_estab.cod_dpa='".$cod_dpa_estab."'";	
					
					//print $sel_cod_estab;
					$rs_cod_estab= $db->Execute($sel_cod_estab)or $mensaje=$db->ErrorMsg() ;//print $rs_tip."<br>";
					$cant_cod_estab=substr($rs_cod_estab->Fields("max"),6,3);
					
					//print $cant_tip."<br>";
					$cont=$cant_cod_estab+1;//print $cont;
					if($cont<=9)
					$cont="0".$cont;
					$cod=$dpa_nueva.$sel_mercado.$tip_nueva.$cont;
					//print $dpa_nueva;
					//print $sel_mercado;
					//print $tip_nueva;
					//print $cont;
					//print $cod;
				}

//if($sel_mercado=="1" && $sel_tipologia=="1" && $sel_estab=="1" && $nombre_est!=''&& $direccion!='' && $contacto!='' && $telefono!='')
{
	$sql="INSERT INTO n_estab (cod_estab,estab,dir,cod_dpa,id_tipologia,id_mercado,desuso,id_estab_sustituido,fecha_sus, org_sup, contacto) 
	VALUES ($cod,$nombre_est,$direccion,$cod_dpa_estab,$sel_tipologia,$sel_mercado,'0',$sel_estab,'$fecha',$org_sup, $contacto)";//print $sql;
	//$rs=$db->Execute($sql) or $mensaje=$db->ErrorMsg();
			$mensaje="Guardado satisfactoriamente.";
			
			
			 if($rs)
		{
		$gestor = @fopen($camino, "a");
			if ($gestor) 
			{
			   
			   if (fwrite($gestor, $sql.";\r\n") === FALSE) 
				{
					echo "No se puede escribir al archivo.";
					exit;
				}
				fclose($gestor);
			}
		}
}



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
    <td width="148" height="90">&nbsp;&nbsp;<img src="../../imagenes/one_logo111.PNG" width="114" height="26" /></td>
    <td width="230"><div align="center">
      <p class="style3">Sistema de Informaci&oacute;n de Estad&iacute;stica Nacional (SIEN)</p>
    </div></td>
    <td width="276"><p>&nbsp;</p>
      <p align="center"><b>PROPUESTA DE </b><b>SUSTITUCI&Oacute;N DE ESTABLECIMIENTOS </b></p>
      <p>&nbsp;</p></td>
    <td width="120" bordercolor="#FFFFFF" bgcolor="#FFFFFF"><p align="left"><strong>Modelo No. 9011-00 DPA:</b><b><?php print $cod_dpa_nueva;echo $rs_estab->fields["dir"]."&nbsp;";?></strong><strong><span class="style2">111 k k k</span> A&ntilde;o: <?php print $ano;?></strong></p>
      </td>
    <td width="3"></div>  </tr>
</table>

<table  width="100%" border="1"   cellpadding="0" cellspacing="0" class="cuadro17" align="center">
  <tr>
    <td width="171" rowspan="2" align="center" bordercolordark="#000000">Mercado</td>
    <td width="204" rowspan="2" align="center" bordercolordark="#000000">Tipología</td>
    <td width="204" rowspan="2" align="center" bordercolordark="#000000"><div align="center">C&oacute;digo establecimiento a sustituir</div></td>
    <td colspan="4" align="center" bordercolordark="#000000">Establecimiento sustituto</td>
    <td colspan="2" align="center" bordercolordark="#000000">Fecha</td>
    
	 <td rowspan="2" align="center" bordercolordark="#000000">Guardar</td>
     
  </tr>
  <tr>
    
      <td width="18" height="27" align="center" bordercolordark="#000000"><div align="center">Nombre</div></td>
	  <td width="18" align="center" bordercolordark="#000000"><div align="center">Direcci&oacute;n</div></td>
	  <td width="18" align="center" bordercolordark="#000000"><div align="center">Persona de contacto, cargo</div></td>
	  <td width="18" align="center" bordercolordark="#000000"><div align="center">Tel&eacute;fono</div></td>
      <td width="18" align="center" bordercolordark="#000000">D&iacute;a</td>
	  <td width="18" align="center" bordercolordark="#000000">Mes</td>
      <?php  if($rol=="admin" || $rol=="edito"){?>
	  <?php }?>
  </tr>

<?php 

$contador=$_POST['contador'];
if($contador=="")$contador=1;
  for($i=1;$i<=$contador;$i++)
  {print $i."  -  ".$contador;
  ?>
  <tr>
    <td width="171" height="20" align="center" bordercolordark="#000000"><select name="sel_mercado" title="Mercado" id="sel_mercado" onChange="document.frm.submit();" class="combo">
                        <option value="0">-----------------------</option>
                        <?php  
					  	
                    	 $query_mercado = "select distinct n_mercado.id_mercado, mercado
						 from n_mercado, n_var_estab,b_variedad, n_estab, n_variedad
						 WHERE n_mercado.id_mercado=b_variedad.id_mercado 
						 and n_var_estab.idb_variedad=b_variedad.idb_variedad 
						 and n_estab.id_estab=n_var_estab.id_estab 
						 and b_variedad.id_variedad=n_variedad.id_variedad
						 and central='0'";
						 //print $query_mercado;
						 if($rol=="autor")
						 $query_mercado=$query_mercado." and n_estab.cod_dpa='".$cod_dpa."'";
						 if($rol=="aut_p")
						 $query_mercado=$query_mercado." and n_estab.cod_dpa like'".$cod_dpa2."%'";
						 
						 $query_mercado=$query_mercado." order by mercado";
						  //print	$query_mercado;
						 $rs_mercado=$db->Execute($query_mercado) or $mensaje=$db->ErrorMsg() ;
					  //print $query_mercado;
					  //else $_POST['sel_mercado']=""; 
					  if($rs_mercado->Fields("mercado")!="") 
						{
							$cant_rs=$rs_mercado->RecordCount();
 							for ($s= 0; $s < $cant_rs;$s++)
							{
							$rs_fields0=$rs_mercado->Fields("mercado");
							$rs_fields1="";
							$rs_fields_id=$rs_mercado->Fields("id_mercado");
							$id=$_POST['sel_mercado'];//print $rs_fields_id;	
							
							echo"<option value=";echo $rs_fields_id;if($rs_fields_id==$id){echo " selected ";} echo "> "; if($rs_fields1){echo $rs_fields1; print ". ";}echo $rs_fields0; echo "</option>";
							
        					$rs_mercado->MoveNext();
							}						
					   }                 
							
					?>
                   </select></td>
<td width="204" align="center" bordercolordark="#000000"><select name="sel_tipologia" title="Tipología" id="sel_tipologia" onChange="document.frm.submit();" class="combo">
                    <option value="0">-----------------------</option>
                    <?php 
						
						if($_POST['sel_mercado']!=0 && $_POST['sel_mercado']!="")
						{
                    	 $query_tipologia = "select distinct tipologia, n_tipologia.id_tipologia
						 from n_tipologia, n_estab, n_var_estab,b_variedad, n_variedad
						 WHERE n_tipologia.id_tipologia=n_estab.id_tipologia  
						 and n_var_estab.idb_variedad=b_variedad.idb_variedad 
						 and n_estab.id_estab=n_var_estab.id_estab 
						 and n_estab.id_mercado='".$_POST['sel_mercado']."' 
						 and b_variedad.id_variedad=n_variedad.id_variedad
						 and central='0'";					 
						 
						 if($rol=="autor")
						 $query_tipologia=$query_tipologia." and n_estab.cod_dpa='".$cod_dpa."'";
						 if($rol=="aut_p")
						 $query_tipologia=$query_tipologia." and n_estab.cod_dpa like '".$cod_dpa2."%'";
						 
						 $query_tipologia=$query_tipologia." order by tipologia";				 						//print $query_tipologia;
						 $rs_tipologia=$db->Execute($query_tipologia) or die($db->ErrorMsg()) ;
					     
						 $cant_rs_tipologia=$rs_tipologia->RecordCount();
 							for ($t = 0; $t < $cant_rs_tipologia;$t++)
							{
							$rs_fields0=$rs_tipologia->Fields("tipologia");
							$rs_fields1="";
							$rs_fields_id=$rs_tipologia->Fields("id_tipologia");
							$id_tipologia=$_POST['sel_tipologia'];	
							
							echo"<option value=";echo $rs_fields_id;if($rs_fields_id==$id_tipologia){echo " selected ";} echo "> "; if($rs_fields1){echo $rs_fields1; print ". ";}echo $rs_fields0; echo "</option>";
							
							$rs_tipologia->MoveNext();
							}	 
						} 			
					 ?>
            </select></td>
    <td width="204" align="center" bordercolordark="#000000"><select name="sel_estab" title="Establecimiento" id="sel_estab" onChange="document.frm.submit();" class="combo">
                        <option value="0">-----------------------</option> 
                        <?php 
									if($_POST['sel_tipologia']!=0 && $_POST['sel_mercado']!=0)
								    {
									$id=$_POST['sel_estab'];	
                     				$id_tipologia =$_POST['sel_tipologia'];
									$id_mercado =$_POST['sel_mercado'];
									//
									$query_estab = "select distinct cod_estab, estab, n_estab.id_estab, dir, contacto
									from n_estab, n_tipologia, n_mercado, n_var_estab, n_dpa, b_variedad, n_variedad
									where n_dpa.cod_dpa=n_estab.cod_dpa and
									n_var_estab.id_estab=n_estab.id_estab and
									n_estab.id_mercado=n_mercado.id_mercado and 
									n_estab.id_tipologia=n_tipologia.id_tipologia and 
									n_estab.id_tipologia='$id_tipologia'  
									and n_var_estab.idb_variedad=b_variedad.idb_variedad 
									and n_estab.id_mercado='$id_mercado'
									and b_variedad.id_variedad=n_variedad.id_variedad
									and incluido='1' and central='0'";
									
									 if($rol=="autor")
									 $query_estab=$query_estab." and n_estab.cod_dpa='".$cod_dpa."'";
									
									 if($rol=="aut_p")
									 {
									 $query_estab=$query_estab." and n_estab.cod_dpa like '".$cod_dpa2."%'";
									 }
										 
									$query_estab=$query_estab." order by estab"; print $query_estab;									
									$rs_estab=$db->Execute($query_estab) or $mensaje=$db->ErrorMsg() ;
									$nombre=$rs_estab->Fields("estab");
						            $direccion=$rs_estab->Fields("dir");
						            $contacto=$rs_estab->Fields("contacto");
						      
									$cant_estab=$rs_estab->RecordCount();
										for ($d = 0; $d < $cant_estab;$d++)
										{
											$rs_fields0=$rs_estab->Fields('estab');
											$rs_fields1=$rs_estab->Fields('cod_estab');
											$rs_fields_id=$rs_estab->Fields('id_estab');
												
											echo"<option value=";echo $rs_fields_id;if($rs_fields_id==$id){echo " selected ";$aux=$rs_fields_id;} echo "> "; if($rs_fields1){echo $rs_fields1; print ". ";}echo $rs_fields0; echo "</option>";
											
											
											$rs_estab->MoveNext();
										}
									}
								    ?></select>
            </td>
   <td <?php print "width=\"". 7*strlen($nombre)+70 ."\"" ?> align="center" bordercolordark="#000000"><input  name="nombre_est<?php print $i;?>"  type="text"   id="nombre_est" title="Nombre del Establecimiento<?php print $i;?>"   size="10" class="text" value="<?php echo $_POST['nombre_est'.$i];?>"  /></td>
						
						<td <?php print "width=\"". 7*strlen($direccion)+70 ."\"" ?> align="center" bordercolordark="#000000"><input  name="direccion<?php print $i;?>"  type="text"   id="direccion" title="Direccion<?php print $i;?>"   size="10" class="text"/> </td>
						
						<td <?php print "width=\"". 7*strlen($contacto)+70 ."\"" ?> align="center" bordercolordark="#000000"><input  name="contacto<?php print $i;?>"  type="text"   id="contacto" title="Contacto<?php print $i;?>"   size="10" class="text"/> </td>
						
						<td <?php print "width=\"". 7*strlen($telefono)+70 ."\"" ?> align="center" bordercolordark="#000000"><input  name="telefono<?php print $i;?>"  type="text"   id="telefono" title="Telefono<?php print $i;?>"   size="10" class="text" /></td>
						
			<td width="18" align="center" bordercolordark="#000000"><?php print $dia;?> </td>
	 <td width="18" align="center" bordercolordark="#000000"><?php print $mes;?> </td>
      
	 <td height="20" align="center" bordercolordark="#000000"><div align="center"> <a  class="toolbar"  href="#"> 
                            <input type="image"   name="btn_save" id="btn_save" onClick="cont=document.frm.contador.value;
                            cont=parseFloat(cont);
                            cont=cont+1;
                            document.frm.contador.value=cont;"  src="../../imagenes/tick2.png" alt="Guardar" border="0" />
                            </a> </div> </td>
	 <?php }//print $contador; ?>
  </tr>
    
  <input name="contador" type="hidden" value="<?php print $contador;?>" />
</table>
</td>
</tr>
</table>
</form>