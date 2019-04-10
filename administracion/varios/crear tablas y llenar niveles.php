<?php 
$x="";
include($x."adodb/adodb.inc.php");
$l="postgres";
$p="1234567";
$db = NewADOConnection('pgsql');
$db->Connect("localhost",$l,$p,"prueba") or die($db->ErrorMsg());
$root = $_SERVER['SERVER_NAME'];
	$url = "http://".$root."/IPCuba/imagenes/";print $url;
$cant_niveles=$_POST["cant_niveles"];
//--------------------para comprobar que están llenos los niveles---------------------	
	if(isset($_POST["btn_llenar"]))
	{
	   for($i=1;$i<$cant_niveles;$i++)
		{
			if($_POST["txt".$i]=="")
			{
			print "Debe llenar el nivel ".$i.".<br>";
			$permiso=0;
			}
			else
			$permiso=1;
		}
	}
//--------------------para comprobar que están llenos los niveles---------------------		
		
			if($permiso==1)
			{
			 for($i=1;$i<$cant_niveles;$i++)
				{
				$niveles=$_POST["txt".$i];				
				$sql ='
				
				--------------------------------------------------------------
				--------para la base menos el nivel de especificación---------
				--------------------------------------------------------------
				
				-- Function: fn_tu_b_'.$niveles.'()
				
				-- DROP FUNCTION fn_tu_b_'.$niveles.'();
				
				CREATE OR REPLACE FUNCTION fn_tu_b_'.$niveles.'()
				  RETURNS "trigger" AS
				$BODY$
				declare
					nRows integer;	
					maxCard integer;										 
				begin
					 
					/* Check parent table "n_'.$niveles.'", when child table "b_'.$niveles.'" changes. */
				 if new."id_'.$niveles.'" != old."id_'.$niveles.'" then
					select count(*) into nRows
					from "n_'.$niveles.'"
					where new."id_'.$niveles.'" = "n_'.$niveles.'"."id_'.$niveles.'";
					if (nRows = 0) then
						raise exception \'No existe el Id en la tabla padre  "n_'.$niveles.'". No se puede modificar en la tabla hija "b_'.$niveles.'".\';
					end if;
				 end if;	
				 /* Check parent table "n_mercado", when child table "b_'.$niveles.'" changes. */
				 if new."id_mercado" != old."id_mercado" then
					select count(*) into nRows
					from "n_mercado"
					where new."id_mercado" = "n_mercado"."id_mercado";
					if (nRows = 0) then
						raise exception \'No existe el Id en la tabla padre  "n_mercado". No se puede modificar en la tabla hija "b_'.$niveles.'".\';
					end if;
				 end if;	
				 
				return old;
				end;$BODY$
				  LANGUAGE \'plpgsql\' VOLATILE;
				ALTER FUNCTION fn_tu_b_'.$niveles.'() OWNER TO postgres;
				
				
				-----------------------------------------------------------
				-----------------------------------------------------------
				
				
				-- Function: fn_ti_b_'.$niveles.'()
				
				-- DROP FUNCTION fn_ti_b_'.$niveles.'();
				
				CREATE OR REPLACE FUNCTION fn_ti_b_'.$niveles.'()
				  RETURNS "trigger" AS
				$BODY$
				declare
					nRows integer;	
					maxCard integer;										 
				begin
					/* Check parent table "n_'.$niveles.'" when values inserted into child table "b_'.$niveles.'" */
				 if new."id_'.$niveles.'" is not null then
					select count(*) into nRows
					from "n_'.$niveles.'"
					where new."id_'.$niveles.'" = "n_'.$niveles.'"."id_'.$niveles.'";
					if (nRows = 0) then
						raise exception \'No existe el Id en la tabla padre  "n_'.$niveles.'". No se puede insertar los datos en la tabla hija "b_'.$niveles.'".\';
					end if;	
				 end if;	
				 /* Check parent table "n_mercado" when values inserted into child table "b_'.$niveles.'" */
				 if new."id_mercado" is not null then
					select count(*) into nRows
					from "n_mercado"
					where new."id_mercado" = "n_mercado"."id_mercado";
					if (nRows = 0) then
						raise exception \'No existe el Id en la tabla padre  "n_mercado". No se puede insertar los datos en la tabla hija "b_'.$niveles.'".\';
					end if;	
				 end if;	
				 
				return new;
				end;$BODY$
				  LANGUAGE \'plpgsql\' VOLATILE;
				ALTER FUNCTION fn_ti_b_'.$niveles.'() OWNER TO postgres;
				
				
				-----------------------------------------------------------
				-----------------------------------------------------------				
				/*
				-- Sequence: b_'.$niveles.'_idb_'.$niveles.'_seq
				
				-- DROP SEQUENCE b_'.$niveles.'_idb_'.$niveles.'_seq;
				
				CREATE SEQUENCE b_'.$niveles.'_idb_'.$niveles.'_seq
				  INCREMENT 1
				  MINVALUE 1
				  MAXVALUE 9223372036854775807
				  START 1
				  CACHE 1;
				ALTER TABLE b_'.$niveles.'_idb_'.$niveles.'_seq OWNER TO postgres;
				*/
				-----------------------------------------------------------
				-----------------------------------------------------------
				
				
				-- Table: b_'.$niveles.'
				
				-- DROP TABLE b_'.$niveles.';
				
				CREATE TABLE b_'.$niveles.'
				(
				  idb_'.$niveles.' bigserial NOT NULL,
				  fecha date NOT NULL,
				  valor numeric,
				  peso numeric,
				  id_'.$niveles.' bigint NOT NULL,
				  id_mercado bigint NOT NULL,
				  CONSTRAINT b_'.$niveles.'_pkey PRIMARY KEY (idb_'.$niveles.')
				) 
				WITHOUT OIDS;
				ALTER TABLE b_'.$niveles.' OWNER TO postgres;
				
				
				-----------------------------------------------------------
				
				
				-- Trigger: ti_b_'.$niveles.' on b_'.$niveles.'
				
				-- DROP TRIGGER ti_b_'.$niveles.' ON b_'.$niveles.';
				
				CREATE TRIGGER ti_b_'.$niveles.'
				  BEFORE INSERT
				  ON b_'.$niveles.'
				  FOR EACH ROW
				  EXECUTE PROCEDURE fn_ti_b_'.$niveles.'();
				  
				  
				-----------------------------------------------------------
				
				
				-- Trigger: tu_b_'.$niveles.' on b_'.$niveles.'
				
				-- DROP TRIGGER tu_b_'.$niveles.' ON b_'.$niveles.';
				
				CREATE TRIGGER tu_b_'.$niveles.'
				  AFTER UPDATE
				  ON b_'.$niveles.'
				  FOR EACH ROW
				  EXECUTE PROCEDURE fn_tu_b_'.$niveles.'();
				  
				
				--------------------------------------------------------------
				--------para la base menos el nivel de especificación---------
				--------------------------------------------------------------
				  
				';		
				$rs = $db->Execute($sql)or die($db->ErrorMsg()) ;
				}
			}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>prueba</title>
</head>
<body>
<form name="frm" method="post" action="">
  <table width="75%" border="1">
    <tr>
      <td width="31%">&nbsp;</td>
      <td width="31%"> <select name="cant_niveles" id="cant_niveles" onChange="document.frm.submit();">
          <option <?php if($cant_niveles==1){echo "selected";}?>>1</option>
          <option <?php if($cant_niveles==2){echo "selected";}?>>2</option>
          <option <?php if($cant_niveles==3){echo "selected";}?>>3</option>
          <option <?php if($cant_niveles==4){echo "selected";}?>>4</option>
          <option <?php if($cant_niveles==5){echo "selected";}?>>5</option>
          <option <?php if($cant_niveles==6){echo "selected";}?>>6</option>
          <option <?php if($cant_niveles==7){echo "selected";}?>>7</option>
          <option <?php if($cant_niveles==8){echo "selected";}?>>8</option>
          <option <?php if($cant_niveles==9){echo "selected";}?>>9</option>
          <option <?php if($cant_niveles==10){echo "selected";}?>>10</option>
          <option <?php if($cant_niveles==11){echo "selected";}?>>11</option>
          <option <?php if($cant_niveles==12){echo "selected";}?>>12</option>
          <option <?php if($cant_niveles==13){echo "selected";}?>>13</option>
          <option <?php if($cant_niveles==14){echo "selected";}?>>14</option>
          <option <?php if($cant_niveles==15){echo "selected";}?>>15</option>
        </select></td>
      <td width="69%"><input name="btn_llenar" type="submit" id="btn_llenar" value="Llenar Base Dato"></td>
    </tr>
    <?php for($z=1;$z<$cant_niveles;$z++){?>
    <tr>
      <td>Nivel <?php print $z;?>:</td>
      <td><input type="text"  title="Nivel <?php print $z;?>" mname="txt<?php print $z;?>"></td>
      <td>&nbsp;</td>
    </tr>
    <?php }?>
  </table>
  <strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">
  <textarea accesskey="4" wrap="soft" name="textarea" cols="2"  onClick="" rows="2"></textarea>
  </font></strong>
</form>
</body>
</html>
