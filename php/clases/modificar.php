<?php 
class modificar
{
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
    function seleccionar($tabla,$campo,$valor,$id_campo,$id_valor)
    {	
	 $sql = "select * from $tabla where $campo = '".$valor."' and $id_campo != '".$id_valor."'" ;
	 //print $sql;
	 $rs = $db->Execute($sql)or die($db->ErrorMsg());
	 return $rs;  
    }
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
    function ari($matriz)
    {	
		$suma=0;
		$cant_matriz=count($matriz);
	    for($i=0;$i<$cant_matriz;$i++)
		{
		 $suma=$suma+$matriz[$i];
		} 
      unset($matriz);    
	  return $suma/$cant_matriz; 
    }
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
	
}
?>