<?php 
class medias
{
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
    function geo($matriz)
    {	
		$producto=1;
		$cant_matriz=count($matriz);
	    for($i=0;$i<$cant_matriz;$i++)
		{
		 //print $producto." * ".$matriz[$i]."<br>"; 
		 $producto=bcmul($producto, $matriz[$i],20);//print $producto."<br><br>";
		}    
	  unset($matriz); 
	  $arg=bcdiv(1, $cant_matriz,20);
	  //print $cant_matriz."<br>";
	  $result=pow($producto, $arg); //print $result." = ".$producto."  raiz  ".$arg."<br>";
	  return $result; 
    }
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
    function ari($matriz)
    {	
		$suma=0;
		$cant_matriz=count($matriz);
	    for($i=0;$i<$cant_matriz;$i++)
		{
		 //$suma=$suma+$matriz[$i];
		 $suma=bcadd($suma, $matriz[$i],20);
		} 
      unset($matriz);    
	  //$result=$suma/$cant_matriz;
	   $result=bcdiv($suma, $cant_matriz,20);//print $result."= ".$suma."  /  ".$cant_matriz."<br>";
	  return $result; 
	  
    }
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
    function ari_pond($matriz1,$matriz2)
	//la matriz 1 tiene lo que se quiere promediar y la 2 sus pesos para hacer la media aritmética ponderada
    {	
		$cant_matriz1=count($matriz1);
		$cant_matriz2=count($matriz2);
		if($cant_matriz1==$cant_matriz2)
		{
			$numerador=0;
			$denominador=0;
			
			for($i=0;$i<$cant_matriz1;$i++)
			{
				$mul=bcmul($matriz1[$i], $matriz2[$i],20);//print "MUL:".$mul."<br><br><br>";
				$numerador=bcadd($numerador, $mul,20);//print "NUM:".$numerador."<br><br><br>";
				$denominador=bcadd($denominador, $matriz2[$i],20);//print "DEN:".$denominador."<br><br><br>";
			} 
			unset($matriz1);unset($matriz2);    
			//$result=$suma/$cant_matriz;
			$result=bcdiv($numerador, $denominador,20);//print $result."= ".$numerador."  /  ".$denominador."<br><br><br>";
			return $result; 
	    }
    }
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------	



//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------
    function geo_pond($matriz1,$matriz2)
	//la matriz 1 tiene lo que se quiere promediar y la 2 sus pesos para hacer la media geométrica ponderada
    {	
		$cant_matriz1=count($matriz1);
		$cant_matriz2=count($matriz2);
		if($cant_matriz1==$cant_matriz2)
		{
			$mul=1;
			$suma=0;
			
			for($i=0;$i<$cant_matriz1;$i++)
			{
				$potencia=bcpow($matriz1[$i], $matriz2[$i],20);//print "POT:".$potencia."<br><br><br>";
				$mul=bcmul($mul, $potencia,20);//print "MUL:".$mul."<br><br><br>";		
				$suma=$suma+$matriz2[$i];//print "SUM:".$suma."<br><br><br>";			
			} 
			unset($matriz1);unset($matriz2);    
			//$result=$suma/$cant_matriz;
			$pot=bcdiv(1, $suma,20);
			$result=bcpow($mul, $pot,20); //print $result."= ".$mul."  /  ".$pot."<br><br><br>";
			return $result; 
	    }
    }
//--------------------------------------------------------------------------------
//--------------------------------------------------------------------------------	

}
?>