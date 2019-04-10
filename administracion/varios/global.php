<?php
 /*  //	if (!defined('_DIR')) define('_DIR',dirname(__FILE__));
   
   class AdministrarCargo
{
//----------------------------------------------------------------------------
//------------------VARIABLES-------------------------------------------------
//----------------------------------------------------------------------------
 private static $connection;

//----------------------------------------------------------------------------
//------------------CONSTRUCTOR-----------------------------------------------
//---------------------------------------------------------------------------- 
 public function AdministrarCargo()
    { 
     AdministrarCargo::$connection =$GLOBALS['coneccion'];
    }
//----------------------------------------------------------------------------
//--------------------------FUNCIONES-----------------------------------------
//----------------------------------------------------------------------------    
   function ListarCargo()
    {
	     $conndb=AdministrarCargo::$connection;
         $sp = $conndb->Prepare('qqq');
		 print $sp;
         $salida=$conndb->Execute($sp) or $x=$GLOBALS['coneccion']->ErrorMsg();print $x; print $salida;
		 return $salida; 
    }
   //ErrorNative();
   }
   
   
   
  
   $x="";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."php/session/session_super.php");
  $sql_mun = "select * from entrada_municipal where  cod_dpa like '03%' ";		
$rs_mun = $db->Execute($sql_mun)or die($db->ErrorMsg());print $rs_mun;
    */
   
   $fecha_ant=date("Y/m/d");
   
   $ano_ant=substr($fecha_ant,0,4);//print $ano_ant;
$mes_ant=substr($fecha_ant,5,2);
$dia_ant=substr($fecha_ant,8,3);
	if($mes_ant==12)
	{$mes_next=01;$ano_ant=$ano_ant+1;}
	else
	{$mes_next=$mes_ant+1;}
$fecha=$ano_ant."/".$mes_next."/".$dia_ant;print $fecha;
   
		
?>