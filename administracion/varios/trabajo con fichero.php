<?php 
$x="";
include($x."adodb/adodb.inc.php");
include($x."coneccion/conn.php");                                                                 include($x."php/camino.php");
//include("php/clases/medias.php");
$x="rrr";
?> 
<script language="javascript"      type="text/javascript">
function ShowFileAccessInfo(filespec)
{ 
var fs, a, ForAppending;
ForAppending = 8;
fs = new ActiveXObject("Scripting.FileSystemObject");
a = fs.OpenTextFile("c:\\testfile.txt", ForAppending, false);
a.WriteLine("<?php print $x;?>");
a.Close();

}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Untitled Document</title>
</head>

<body onLoad="ShowFileAccessInfo('D://1.txt')">

</body>
</html>
