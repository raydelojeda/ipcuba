<?php 
session_start();


include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
include($x."adodb/adodb-navigator.php");

	if ($_GET["regis_cant"]!="" && $_POST['sel_#']=="")
{	
	$_POST['sel_#'] = $_GET["regis_cant"];//para volver al listado con la misma cantidad de filas
	$_GET["regis_cant"]="";
}

if (isset($_GET["order"])) $order = $_GET["order"]; //else $order=orden;
if (isset($_GET["type"])) $ordtype = $_GET["type"];// else $ordtype=asc;
if ($_GET["txt_filtro"]!="") $txt_filtro = $_GET['txt_filtro'];
if (isset($_POST["txt_filtro"])) $txt_filtro = $_POST['txt_filtro'];
if ($_GET["ver"]!="") $ver = $_GET['ver'];
if (isset($_POST["sel_#"])) $ver = $_POST['sel_#'];
if ($_GET["sel_filtro"]!="") $sel_filtro = $_GET['sel_filtro'];
if (isset($_POST["sel_filtro"])) $sel_filtro = $_POST['sel_filtro'];
/*
 if (!isset($filter) && isset($_SESSION["filter"])) $filter = $_SESSION["filter"];
  if (!isset($filterfield) && isset($_SESSION["filter_field"])) $filterfield = $_SESSION["filter_field"];
global $order;
  global $ordtype;
  global $filter;
  global $filterfield;*/
if ($txt_filtro!='') $campo_filtro =  "%" .$txt_filtro ."%";

//$t = mail("mariselah@cimex.com.cu","No correo fuera de cimex...","Esto no acaba de poder mandar correos que sean de fuera del dominio del SMTP, es decir, de dominio Cimex"); 
//print $t;
 //print $_SESSION["filter_field"];
 // $filterstr = sqlstr($filter);
/*if($_POST['sel_cam']!="")
$query = "select * from $tabla order by ".$_POST['sel_cam']." Asc";
else*/
$query = "select * from $tabla ";

if($sel_filtro=="no")$txt_filtro='';
if (isset($txt_filtro) && $txt_filtro!='' && isset($sel_filtro) && $sel_filtro!='' && $sel_filtro!="no") {
   $query .= " where $sel_filtro ~* '$txt_filtro'";
  }
 if ($campo!='') {
	 if(isset($txt_filtro) && $txt_filtro!='' && isset($sel_filtro) && $sel_filtro!='' && $sel_filtro!="no")
   $query .= " and $campo"; else $query .= " where $campo";
  } 
  // elseif (isset($filterstr) && $filterstr!='') {
   // $sql .= " where (nombre like '" .$filterstr ."') or (edad like '" .$filterstr ."') or (descripcion like '" .$filterstr ."') or (roll like '" .$filterstr ."') or (email like '" .$filterstr ."') or (loguin like '" .$filterstr ."') or (pass like '" .$filterstr ."') or (id1 like '" .$filterstr ."') or (salario like '" .$filterstr ."')";
  //}
if ($ordtype == "asc") { $ordtypestr = "desc"; } else { $ordtypestr = "asc"; }
//if ($order == "asc") { $order = "desc"; } else { $ordtypestr = "asc"; }

if (isset($order) && $order!='') $query .= " order by $order"; elseif($campo_order) $query .= " order by $campo_order";
if (isset($ordtype) && $ordtype!='') $query .= " " .str_replace("'", "''", $ordtype);

// elseif (isset($filter) && $filter!='') {
   //$query .= " where (nombre like '" .$filter ."') or (edad like '" .$filter ."') or (descripcion like '" .$filterstr ."') or (roll like '" .$filterstr ."') or (email like '" .$filterstr ."') or (loguin like '" .$filterstr ."') or (pass like '" .$filterstr ."') or (id1 like '" .$filterstr ."') or (salario like '" .$filterstr ."')";
  //}
//$rec = $db->execute($query) or die($db->ErrorMsg());
//print $rec;
//$a = $rec->RecordCount();
//print $a;
//$query2 = "Select * from personal where edad = 26";
//$rec2 = $db->execute($query2) or die($db->ErrorMsg());
//print $rec2->Fields(0);
//print $_POST['sel_#'];
if($ver=="")
$ver=50;
//print $query;
$pager_nav = new CData_PagerNav($db, $query, $ver,"frm",$order,$ordtype);
//print $pager_nav;
$rs = $pager_nav->curr_rs;

//if (isset($order)) $_SESSION["order"] = $order;
//if (isset($ordtype)) $_SESSION["type"] = $ordtype;
//if (isset($filter)) $_SESSION["filter"] = $filter;
//if (isset($filterfield)) $_SESSION["filter_field"] = $filterfield;
/*function sqlstr($val)
{
  return str_replace("'", "''", $val);
}*/
?>