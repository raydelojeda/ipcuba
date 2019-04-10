// @utor: Ing. Raydel Ojeda Figueroa

var scrtxt="ONEI - Oficina Nacional de Estadísticas e Información";
var lentxt=scrtxt.length;
var width=100;
var pos=1-width;

function scroll() {

  pos++;
  var scroller="";
  if (pos==lentxt) {
    pos=1-width;
  }
  if (pos<0) {
    for (var i=1; i<=Math.abs(pos); i++) {
      scroller=scroller+" ";}
    scroller=scroller+scrtxt.substring(0,width-i+1);
  }
  else {
    scroller=scroller+scrtxt.substring(pos,width+pos);
  }
  window.status = scroller;
  setTimeout("scroll()",100);
  }
    function openwindow(hlpfile)
{
	window.open (hlpfile,"Help","toolbar=no,location=no,directories=no,status=no,scrol0lbars=yes,resizable=no,copyhistory=no,width=600,height=400");
}


function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_validateForm() 
{ //v4.0
  var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
  for (i=0; i<(args.length-2); i+=3) 
  	{ 
		test=args[i+2]; val=MM_findObj(args[i]);
    	if (val) 
		{ nm=val.title; 
		  val=val.value;
		  lenght=val.length;
		  No=false;
			if (val!="") 
			{
				if (test.indexOf('Letras')!=-1) 
					{
							for(j=0; j<lenght; j++)
							{				
							aux=val.substring(j,j+1);

								if((isNaN(aux))==false && aux!=" ")
									{
									No=true;
									}
							}
							if(No)
							errors+='El campo '+nm+' debe contener solo letras.\n';										
					}
					
				else if (test.indexOf('Escoger')!=-1) //alert (val);
					{ if(val==0)
						errors+='Debe escoger el campo '+nm+'.\n';											
					}
								
     		    else if (test.indexOf('isEmail')!=-1) 
		 		{ 
					p=val.indexOf('@');
     	  			if (p<1 || p==(val.length-1)) errors+='El campo '+nm+' es una dirección de correo.\n';
    			} 	  
				else if (test!='R') 
		  		{ num = parseFloat(val);
     			 if (isNaN(val)) errors+='El campo '+nm+' debe contener solo números.\n';
       			 if (test.indexOf('inRange') != -1) 
				 	{ p=test.indexOf(':');
         			 min=test.substring(8,p); max=test.substring(p+1);
         			 if (num<min || max<num) errors+='El campo '+nm+' debe contener números entre '+min+' y '+max+'.\n';
   					} 
				} 
			}
			else if (test.charAt(0) == 'R') errors += 'El campo '+nm+' es requerido.\n'; 
		}
  } 
  if (errors)  //Ext.MessageBox.alert('Mensaje', 'El siguiente error ocurrió:\n'+errors);//alert('El siguiente error ocurrió:\n'+errors);
  alert('El siguiente error ocurrió:\n'+errors);//alert('El siguiente error ocurrió:\n'+errors);
  document.MM_returnValue = (errors == ''); 
}

//----------------------------------------------------------------------------------------------
function validar_obs_m(aparece, desaparece) 
{ 
		inc=eval("document.frm.sel_inc.value");
		obs=eval("document.frm.sel_obs.value");
		//alert(obs);
		
		if(inc!=1)
		{var div2 = document.getElementById(desaparece).style;//alert(div2);//alert("dd");
		div2.display = "none";
		document.frm.txt_precio.value='0.00';}
		else if(inc==1)
		{var div2 = document.getElementById(desaparece).style;//alert("dd");
		div2.display = "block";
		 if(obs==2 || obs==3 || obs==5)
		 {document.frm.txt_precio.value='0.00';}
		 else if((obs==4 || obs==6 || obs==8 || obs==9) && document.frm.txt_precio.value==0)
		 {alert("Esta observación no puede tener precio '0'");}
		 
	  var prec=document.frm.txt_precio.value;
	  lenght=prec.length;
	// aux=prec.substring(0,3);
	  
	  
	  
	  for(j=0; j<lenght; j++)
	{				
					aux=prec.substring(j,j+1);
					if((aux)=='.')
					{//alert(j);
					var punto=true;
					if(j==0)
						{
						prec='0'+prec;						
						lenght=prec.length;
						}
					if(j==lenght-1)
						{
						prec=prec+'00';						
						lenght=prec.length;
						}
					if(j==lenght-2)
						{
						prec=prec+'0';						
						lenght=prec.length;
						}
						
					}
					
					
					
					if(punto!=true && j==lenght-1 && !isNaN(prec))	
						{prec=prec+'.00';
						
						}
						//alert(prec);
	}
/*if(isNaN(suma_control)){alert('El campo precio debe contener solo números.');
suma_control='';letras=true;}
//alert(p);
else if(suma_control=='')
{suma_control='';letras=true;
alert('Debe escribir correctamente la suma control.');}*/
		 
		 
		 
		}
}
//----------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------

function validar_obs(hide1,hide2) 
{ 
		inc=eval("document.frm.sel_inc.value");
		obs=eval("document.frm.sel_obs.value");
		var div1 = document.getElementById(hide1).style;//alert(div);
		var div2 = document.getElementById(hide2).style;//alert("dd");
		div1.display = "block";
		div2.display = "block";
		mostrar_fila();
		var observ = document.getElementById("observ").style;
	    observ.display = "block";
		//alert(inc);
		if(inc !="1")
		{//alert("edfe");
		eval("document.frm.sel_obs.options[0].selected=true");
		div1.display = "none";
		div2.display = "none";
		document.frm.txt_precio_observado.value=0;
		var observ = document.getElementById("observ").style;
	    observ.display = "none";
		var uni = document.getElementById("unidades").style;
	    uni.display = "none";
		var pre = document.getElementById("presentacion").style;
	    pre.display = "none" ;
		var var_reg = document.getElementById("var_reg").style;
        var_reg.display = "none";
		var tam_reg = document.getElementById("tam_reg").style;
		tam_reg.display = "none";
		var porc_grat = document.getElementById("porc_grat").style;
		porc_grat.display = "none";
		var val_desc = document.getElementById("val_desc").style;
		val_desc.display = "none";
		var porc_desc = document.getElementById("porc_desc").style;
		porc_desc.display = "none";
		}
		else if(obs=="2" || obs=="3" || obs=="5")
		{//alert(obs);
		var observ = document.getElementById("observ").style;
	    observ.display = "block";
		document.frm.txt_precio_observado.value=0;
		//eval("document.frm.sel_obs.options[0].selected=true");
		div1.display = "none";
		div2.display = "none";
		var uni = document.getElementById("unidades").style;
	    uni.display = "none" ;
		var pre = document.getElementById("presentacion").style;
	    pre.display = "none" ;
		var var_reg = document.getElementById("var_reg").style;
        var_reg.display = "none";
		var tam_reg = document.getElementById("tam_reg").style;
		tam_reg.display = "none";
		var porc_grat = document.getElementById("porc_grat").style;
		porc_grat.display = "none";
		var val_desc = document.getElementById("val_desc").style;
		val_desc.display = "none";
		var porc_desc = document.getElementById("porc_desc").style;
		porc_desc.display = "none";
		}
}




function Carnet()
{
var value;
value=document.frm.txt_ci.value;
	if (isNaN(value))
	{
	alert("El campo debe contener solo números.");
	document.frm.txt_ci.value=""
	}

aux=value.substring(2,4);
	if(aux>12 || aux==00 )
	{
	alert("Debe introducir un mes correcto (01-12) en el campo Carnet Id.");
	document.frm.txt_ci.value=""
	}
aux=value.substring(4,6);
	if(aux>31 || aux==00)
	{
	alert("Debe introducir un día correcto (01-31) en el campo Carnet Id.");
	document.frm.txt_ci.value=""
	}
aux=value.length;
	if(aux<11)
	{
	alert("Debe introducir un Carnet Id. correcto");
	document.frm.txt_ci.value=""
	}	
	
}

<!---------------------------------------------------------------------------------------------------------------------------


function dia(name)
{
var value;
if(name)
	{
		value=eval("document.frm.txt_fecha_"+name+".value");
		if (isNaN(value))
		{
		alert("El campo debe contener solo números.");
		aux=eval("document.frm.txt_fecha_"+name);aux.value="";
		}
		
		if(value>28 || value<=00)
		{
		alert("Debe introducir un día correcto (01-28) en el campo Día a captar.");
		aux=eval("document.frm.txt_fecha_"+name);aux.value="";
		}
	}
else
	{
		value=document.frm.txt_fecha.value;
		if (isNaN(value))
		{
		alert("El campo debe contener solo números.");
		document.frm.txt_fecha.value="";
		}
		
		if(value>28 || value<=00)
		{
		alert("Debe introducir un día correcto (01-28) en el campo Día a captar.");
		document.frm.txt_fecha.value="";
		}
	}
}

<!---------------------------------------------------------------------------------------------------------------------------


/*
function Validar_Precio(id_img, limpiar)
{
var  ;var p_max;var precio;
 =parseFloat(document.frm. .value);
p_max=parseFloat(document.frm.p_max.value);
precio=parseFloat(document.frm.txt_precio_observado.value);

	if(precio <  )	
	{
		if(limpiar=="1")
		document.frm.txt_precio_observado.value="";	
		if (document.getElementById && document.images)
		 {	  
		   var tabla = document.getElementById(id_img).style;	   
		   tabla.display = "block";	    
		 }  
		 alert("El precio captado está por debajo del precio mínimo.");
	}
	
	else if(p_max < precio)	
	{
		if(limpiar=="1")
		document.frm.txt_precio_observado.value="";	
		if (document.getElementById && document.images)
		{	  
		  var tabla = document.getElementById(id_img).style;	   
		  tabla.display = "block";	    
		}  
		 alert("El precio captado está por encima del precio máximo.");	
	}
	else 
	{var tabla = document.getElementById(id_img).style;
	tabla.display = "none";}
}*/
<!---------------------------------------------------------------------------------------------------------------------------

function Validar_Varios_Precios(id_img)
{
	
cod=id_img.substring(7,25);	
var letras=false;	
lenght=eval("document.frm.txt_precio_"+cod+".value").length;
p=eval("document.frm.txt_precio_"+cod+".value");
o=eval("document.frm.sel_obs_"+cod+".value");
	
for(j=0; j<lenght; j++)
	{				
					aux=p.substring(j,j+1);
					if((aux)=='.')
					{//alert(j);
					var punto=true;
					if(j==0)
						{eval("document.frm.txt_precio_"+cod+".value='0'+p");
						p=eval("document.frm.txt_precio_"+cod+".value");
						lenght=eval("document.frm.txt_precio_"+cod+".value").length;}
					if(j==lenght-1)
						{eval("document.frm.txt_precio_"+cod+".value=p+'00'");
						p=eval("document.frm.txt_precio_"+cod+".value");
						lenght=eval("document.frm.txt_precio_"+cod+".value").length;}
					if(j==lenght-2)
						{eval("document.frm.txt_precio_"+cod+".value=p+'0'");
						p=eval("document.frm.txt_precio_"+cod+".value");
						lenght=eval("document.frm.txt_precio_"+cod+".value").length;}
						
					}
					
					
					
					if(punto!=true && j==lenght-1 && !isNaN(p))	
						{eval("document.frm.txt_precio_"+cod+".value=p+'.00'");
						p=eval("document.frm.txt_precio_"+cod+".value");
						lenght=eval("document.frm.txt_precio_"+cod+".value").length;}
	}
if(isNaN(p)){alert('El campo precio debe contener solo números.');
eval("document.frm.txt_precio_"+cod+".value=''");letras=true;}
//alert(p);

if((p=='' || p=='0.00') && (o==6 || o==4 || o==8 || o==9))
{eval("document.frm.txt_precio_"+cod+".value=''");letras=true;
eval("document.frm.sel_obs_"+cod+".value='6'");
alert('Debe escoger observación correcta o escribir correctamente el precio.');
}
	
if(o==1 || o==2 || o==3 || o==5)
{eval("document.frm.txt_precio_"+cod+".value=''");}
	
	
	//alert(p);alert(o);
/*	
var p_min ;var p_max;var precio;
//alert(id_img);

//alert(" "+cod);



 p_min=parseFloat(eval("document.frm. "+cod+".value"));
p_max=parseFloat(eval("document.frm.p_max"+cod+".value"));
precio=parseFloat(eval("document.frm.txt_precio_"+cod+".value"));//alert( );alert(precio);alert(p_max);
	if(precio <   || letras==true)	
	{
	if (document.getElementById && document.images)
	 {	  
	   var tabla = document.getElementById(id_img).style;	   
	   tabla.display = "block";	    
	 }  //alert("El precio captado está por debajo del precio mínimo.");
	}
	
	else if(p_max < precio || letras==true)	
	{		
	 if (document.getElementById && document.images)
	 {	  
	   var tabla = document.getElementById(id_img).style;	   
	   tabla.display = "block";	    
	 }  //alert("El precio captado está por encima del precio máximo.");	
	}
	else 
	{var tabla = document.getElementById(id_img).style;
	tabla.display = "none";}
	
	*/
	
}


<!---------------------------------------------------------------------------------------------------------------------------




function modif_aux(){
 sel = ""; 
arr_a = String(document.frm.var_checkbox.value).split(","); //arreglo con los id_noticia en la forma
for (i=0;i<arr_a.length;i++){//alert(arr_a[i]);
  art_sel = eval("document.frm.checkbox_"+arr_a[i]+".checked"); //alert(art_sel);// noticia seleccionada
  if (art_sel){ 
  
  
 //------------sección------------------------------------------------------
 id = eval("document.frm.checkbox_"+arr_a[i]+".id");  
 //alert(id);
  if(id==1)
   {document.frm.action="m_productor.php";}
	 else if(id==2)
	{document.frm.action="m_establecimiento.php";}
	 else if(id==3)
	{document.frm.action="m_mercado.php";}
	 else if(id==4)
	{document.frm.action="m_unidad.php";}
	
//------------sección------------------------------------------------------

  
    
	  sel = arr_a[i];
	  i= arr_a.length;
	 //alert(sel);
  }	
} 
return(sel);
}

function modif(act){ 

// msg = "";
  // document.frm.action=act; //asigno dinamicamente la pagina de acción de la forma
   //document.frm.var_aux_mod.value = modif_aux();
   
	msg = "Debe seleccionar al menos una casilla para modificar una fila.";
	       
   if(modif_aux() != ""){    
	 document.frm.action=act;
     document.frm.var_aux_mod.value = modif_aux();
	 document.frm.submit();    
   }else{
     if (msg) alert(msg);
   } 
}
<!---------------------------------------------------------------------------------------------------------------------------



function elim_aux(){
 sel = "";
arr_a = String(document.frm.var_checkbox.value).split(","); //arreglo con los id_noticia en la forma

for (i=0;i<arr_a.length;i++){
  art_sel = eval("document.frm.checkbox_"+arr_a[i]+".checked"); // noticia seleccionada
  if (art_sel){
 
//------------sección------------------------------------------------------
 id = eval("document.frm.checkbox_"+arr_a[i]+".id");  
  
	 if(id==3)
	{document.frm.tabla.value = "n_mercado";
	document.frm.campo.value = "id_mercado";}
	 else if(id==4)
	{document.frm.tabla.value = "n_unidad";
	document.frm.campo.value = "unidad";}
//------------sección------------------------------------------------------
	
	if (String(sel) != ""){
	  sel += ","+arr_a[i]; //se guarda id_noticia seleccionado
    }else{
	  sel = arr_a[i]; //se guarda id_noticia seleccionado
 
	}
  }	
} 
return(sel);
}

function elim(act){ 
 msg = "";
   //document.frm.action=act; //asigno dinamicamente la pagina de acción de la forma
  // document.frm.var_aux_mod.value = elim_aux();
   
	msg = "Por favor haga una selección de la lista para ejecutar la acción.";
	       
   if(elim_aux() != ""){
   if(confirm("¿Confirma que desea ejecutar la acción para los elementos seleccionados?"))
   //var text='¿Confirma que desea eliminar los elementos seleccionados?';
   //Ext.MessageBox.confirm('Confirmación', text, eliminar);
	{
	 document.frm.action=act;
     document.frm.var_aux_mod.value = elim_aux();
	 document.frm.submit();
    }
   }else{
     if (msg) //alert(msg);
	 Ext.MessageBox.alert('Mensaje', msg);
   } 
}

//function eliminar(act){alert (act); }

//---------------------------------------------------------------------------------------------------------------------




function art_estab_aux(){
 sel = "";
arr_a = String(document.frm.var_checkbox.value).split(","); //arreglo con los id_noticia en la forma
for (i=0;i<arr_a.length;i++){
  art_sel = eval("document.frm.checkbox_"+arr_a[i]+".checked"); // noticia seleccionada
  if (art_sel){
  
	if (String(sel) != ""){
	  sel += ","+arr_a[i]; //se guarda id_noticia seleccionado
    }else{
	  sel = arr_a[i]; //se guarda id_noticia seleccionado
 
	}//alert(sel);
  }	
} 
return(sel);
}

function art_estab(act){ 
 msg = "";
   //document.frm.action=act; //asigno dinamicamente la pagina de acción de la forma
   //document.frm.var_aux_mod.value = var_estab_aux();
   
	msg = "Por favor haga una selección de la lista para guardar.";
	       
   if(art_estab_aux() != ""){
   if(confirm("¿Confirma que desea guardar los elementos seleccionados?"))
	{
	 document.frm.action=act;
     document.frm.var_aux_mod.value = art_estab_aux();
	 document.frm.submit();
    }
   }else{
     if (msg) alert(msg);
   } 
}
//---------------------------------------------------------------------------------------------------------------------




function var_estab_aux(){
 sel = "";
arr_a = String(document.frm.var_checkbox.value).split(","); //arreglo con los id_noticia en la forma
for (i=0;i<arr_a.length;i++){
  art_sel = eval("document.frm.checkbox_"+arr_a[i]+".checked");
 // fecha = eval("document.frm.txt_fecha_"+arr_a[i]);alert(fecha);
  if (art_sel){
  
	if (String(sel) != ""){
	  sel += ","+arr_a[i]; //se guarda id_noticia seleccionado
    }else{
	  sel = arr_a[i]; //se guarda id_noticia seleccionado
 
	}//alert(sel);
  }	
} 
return(sel);
}

function var_estab(act){ 
 msg = "";
 
   //document.frm.action=act; //asigno dinamicamente la pagina de acción de la forma
   //document.frm.var_aux_mod.value = var_estab_aux();
   
	msg = "Por favor haga una selección de la lista para guardar.";
	       
   if(var_estab_aux() != ""){
   if(confirm("¿Confirma que desea guardar los elementos seleccionados?"))
	{
	 document.frm.action=act;
     document.frm.var_aux_mod.value = var_estab_aux();
	 document.frm.submit();
    }
   }else{
     if (msg) alert(msg);
   } 
}
//---------------------------------------------------------------------------------------------------------------------





function estab_var_aux(){
 sel = "";
arr_a = String(document.frm.var_checkbox.value).split(","); //arreglo con los id_noticia en la forma
for (i=0;i<arr_a.length;i++){
  art_sel = eval("document.frm.checkbox_"+arr_a[i]+".checked");
 // fecha = eval("document.frm.txt_fecha_"+arr_a[i]);alert(fecha);
  if (art_sel){
  
	if (String(sel) != ""){
	  sel += ","+arr_a[i]; //se guarda id_noticia seleccionado
    }else{
	  sel = arr_a[i]; //se guarda id_noticia seleccionado
 
	}//alert(sel);
  }	
} 
return(sel);
}

function estab_var(act){ 
 msg = "";
 
   //document.frm.action=act; //asigno dinamicamente la pagina de acción de la forma
   //document.frm.var_aux_mod.value = var_estab_aux();
   
	msg = "Por favor haga una selección de la lista para guardar.";
	       
   if(estab_var_aux() != ""){
   if(confirm("¿Confirma que desea guardar los elementos seleccionados?"))
	{
	 document.frm.action=act;
     document.frm.var_aux_mod.value = estab_var_aux();
	 document.frm.submit();
    }
   }else{
     if (msg) alert(msg);
   } 
}
//---------------------------------------------------------------------------------------------------------------------



function marcar()
{arr_a = String(document.frm.var_checkbox.value).split(","); //alert(document.frm.var_checkbox.value);
	for (i=0;i<arr_a.length;i++)
	{//alert (arr_a[i]);
	eval('checkbox = document.frm.checkbox_'+arr_a[i]);
	chequeado = eval("document.frm.checkbox.checked");
	  if (chequeado)
	 checkbox.checked = true; 
	 else
	 checkbox.checked = false; 
	} 
}


//---------------------------------------------------------------------------------------------------------------------




function espec_estab_aux(){
 sel = "";
arr_a = String(document.frm.var_checkbox.value).split(","); //arreglo con los id_noticia en la forma
for (i=0;i<arr_a.length;i++){
  art_sel = eval("document.frm.checkbox_"+arr_a[i]+".checked"); //alert(art_sel)// noticia seleccionada
  if (art_sel){
  
	if (String(sel) != ""){
	  sel += ","+arr_a[i]; //se guarda id_noticia seleccionado
    }else{
	  sel = arr_a[i]; //se guarda id_noticia seleccionado
 
	}//alert(sel);
  }	
} 
return(sel);
}

function espec_estab(act){ 
 msg = "";
   //document.frm.action=act; //asigno dinamicamente la pagina de acción de la forma
   //document.frm.var_aux_mod.value = var_estab_aux();
   
	msg = "Por favor haga una selección de la lista para guardar.";
	       
   if(espec_estab_aux() != ""){
   if(confirm("¿Confirma que desea guardar los elementos seleccionados?"))
	{
	 document.frm.action=act;
     document.frm.var_aux_mod.value = espec_estab_aux();
	 document.frm.submit();
    }
   }else{
     if (msg) alert(msg);
   } 
}



<!---------------------------------------------------------------------------------------------------------------------------



function recalc_prov(){
 sel = ""; 
arr_a = String(document.frm.var_checkbox.value).split(","); //arreglo con los id_noticia en la forma
for (i=0;i<arr_a.length;i++){//alert(arr_a[i]);
  art_sel = eval("document.frm.chec"+arr_a[i]+".checked"); //alert("document.frm.chec"+arr_a[i]+".checked");// noticia seleccionada
  if (art_sel){ 
  
  sel = arr_a[i];
	  i= arr_a.length;
	// alert(sel);
  }	
} 
return(sel);
}

function recalculo_prov(act){ 
 msg = "";
   //document.frm.action=act; //asigno dinamicamente la pagina de acción de la forma
   document.frm.var_aux_mod.value = recalc_prov();
   
	msg = "Por favor haga una selección de la lista para recalcular.";
	       
   if(recalc_prov() != ""){
   
	 document.frm.action=act;
     document.frm.var_aux_mod.value = recalc_prov();
	 document.frm.submit();
    
   }else{
     if (msg) alert(msg);
   } 
}
//---------------------------------------------------------------------------------------------------------------------

<!---------------------------------------------------------------------------------------------------------------------------



function calc_prov(){
 sel = ""; 
arr_a = String(document.frm.var_checkbox.value).split(","); //arreglo con los id_noticia en la forma
for (i=0;i<arr_a.length;i++){//alert(arr_a[i]);
  art_sel = eval("document.frm.chec"+arr_a[i]+".checked"); //alert("document.frm.chec"+arr_a[i]+".checked");// noticia seleccionada
  if (art_sel){ 
  
  sel = arr_a[i];
	  i= arr_a.length;
	// alert(sel);
  }	
} 
return(sel);
}

function calculo_prov(act){ 
 msg = "";
   //document.frm.action=act; //asigno dinamicamente la pagina de acción de la forma
   document.frm.var_aux_mod.value = calc_prov();
   
	msg = "Por favor haga una selección de la lista para calcular.";
	       
   if(calc_prov() != ""){
   
	 document.frm.action=act;
     document.frm.var_aux_mod.value = calc_prov();
	 document.frm.submit();
    
   }else{
     if (msg) alert(msg);
   } 
}
//---------------------------------------------------------------------------------------------------------------------



<!---------------------------------------------------------------------------------------------------------------------------



function calc_nac(){
 sel = ""; 
arr_a = String(document.frm.var_checkbox.value).split(","); //arreglo con los id_noticia en la forma
for (i=0;i<arr_a.length;i++){//alert(arr_a[i]);
  art_sel = eval("document.frm.chec"+arr_a[i]+".checked"); //alert("document.frm.chec"+arr_a[i]+".checked");// noticia seleccionada
  if (art_sel){ 
  
  sel = arr_a[i];
	  i= arr_a.length;
	// alert(sel);
  }	
} 
return(sel);
}

function calculo_nac(act){ 
 msg = "";
   //document.frm.action=act; //asigno dinamicamente la pagina de acción de la forma
   document.frm.var_aux_mod.value = calc_nac();
   
	msg = "Por favor haga una selección de la lista para recalcular.";
	       
   if(calc_nac() != ""){
   
	 document.frm.action=act;
     document.frm.var_aux_mod.value = calc_nac();
	 document.frm.submit();
    
   }else{
     if (msg) alert(msg);
   } 
}
//---------------------------------------------------------------------------------------------------------------------



 /**
   * función para ocultar o mostrar componentes de formularios, recibe como argumento el id del componente y el id de la imagen
   */  

function ocultar(id_tabla, id_imagen)
  {
    imagen1=new Image
    imagen1.src="../../../imagenes/collapsebtn2.png";
    imagen2=new Image
    imagen2.src="../../../imagenes/expandbtn2.png";

    if (document.getElementById && document.images)
	 {	  
	   var tabla = document.getElementById(id_tabla).style;
	   
	   (tabla.display == "none" ) ? tabla.display = "block" : tabla.display = "none";

	   if(document.images[id_imagen].src == imagen1.src)
		document.images[id_imagen].src = imagen2.src;
	   else
	 	document.images[id_imagen].src = imagen1.src;   
	 }    
  }  

//----------------------------------------------------------------------------------------------------
 /**
   * función para ocultar o mostrar filas de una tabla, recibe como argumento el id de la filacomponente y el id de la imagen
   */  






function mostrar_fila()
{
  if (document.getElementById)
  {
	  if(document.frm.sel_precio.value==1 )
	   { 
	    var uni = document.getElementById("unidades").style;
	    uni.display = "" ;
		var um = document.getElementById("um").style;
	    um.display = "" ;
		var pre = document.getElementById("presentacion").style;
	    pre.display = "" ;
		
		
		var var_reg = document.getElementById("var_reg").style;
        var_reg.display = "none";
		var tam_reg = document.getElementById("tam_reg").style;
		tam_reg.display = "none";
		var porc_grat = document.getElementById("porc_grat").style;
		porc_grat.display = "none";
		var val_desc = document.getElementById("val_desc").style;
		val_desc.display = "none";
		var porc_desc = document.getElementById("porc_desc").style;
		porc_desc.display = "none";
		
	   }
	   
	   //---------------------------------------------------------------------------------------------
	   
	   else if(document.frm.sel_precio.value==2 )
	   {
		 var var_reg = document.getElementById("var_reg").style;
         var_reg.display = ""
		 
		var uni = document.getElementById("unidades").style;
	    uni.display = "none" ;
		var pre = document.getElementById("presentacion").style;
	    pre.display = "none" ;
		var tam_reg = document.getElementById("tam_reg").style;
		tam_reg.display = "none";
		var porc_grat = document.getElementById("porc_grat").style;
		porc_grat.display = "none";
		var val_desc = document.getElementById("val_desc").style;
		val_desc.display = "none";
		var porc_desc = document.getElementById("porc_desc").style;
		porc_desc.display = "none";
		var um = document.getElementById("um").style;
	    um.display = "none" ;
		
	   }
	   else if(document.frm.sel_precio.value==3 )
	   {
		var tam_reg = document.getElementById("tam_reg").style;
		tam_reg.display = "";
		
		var uni = document.getElementById("unidades").style;
	    uni.display = "none" ;
		var pre = document.getElementById("presentacion").style;
	    pre.display = "none" ;
		var var_reg = document.getElementById("var_reg").style;
        var_reg.display = "none";
		var porc_grat = document.getElementById("porc_grat").style;
		porc_grat.display = "none";
		var val_desc = document.getElementById("val_desc").style;
		val_desc.display = "none";
		var porc_desc = document.getElementById("porc_desc").style;
		porc_desc.display = "none";
		var um = document.getElementById("um").style;
	    um.display = "none" ;
		
	   }
	   else if(document.frm.sel_precio.value==4 )
	   {
		var porc_grat = document.getElementById("porc_grat").style;
		porc_grat.display = "";
		
		var uni = document.getElementById("unidades").style;
	    uni.display = "none" ;
		var pre = document.getElementById("presentacion").style;
	    pre.display = "none" ;
		var var_reg = document.getElementById("var_reg").style;
        var_reg.display = "none";
		var tam_reg = document.getElementById("tam_reg").style;
		tam_reg.display = "none";
		var val_desc = document.getElementById("val_desc").style;
		val_desc.display = "none";
		var porc_desc = document.getElementById("porc_desc").style;
		porc_desc.display = "none";
		var um = document.getElementById("um").style;
	    um.display = "none" ;
	   }
	   
	   else if(document.frm.sel_precio.value==5 )
	   {
		   var val_desc = document.getElementById("val_desc").style;
		   val_desc.display = "";
		   
		   var uni = document.getElementById("unidades").style;
	       uni.display = "none" ;
		   var pre = document.getElementById("presentacion").style;
	       pre.display = "none" ;
		   var var_reg = document.getElementById("var_reg").style;
           var_reg.display = "none";
		   var tam_reg = document.getElementById("tam_reg").style;
		   tam_reg.display = "none";
		   var porc_grat = document.getElementById("porc_grat").style;
		   porc_grat.display = "none";
		   var porc_desc = document.getElementById("porc_desc").style;
		   porc_desc.display = "none";
		   var um = document.getElementById("um").style;
	       um.display = "none" ;
	   }
	   else if(document.frm.sel_precio.value==6)
	   {
		   var porc_desc = document.getElementById("porc_desc").style;
		   porc_desc.display = "";
		   
		   var uni = document.getElementById("unidades").style;
	       uni.display = "none" ;
		   var pre = document.getElementById("presentacion").style;
	       pre.display = "none" ;
		   var var_reg = document.getElementById("var_reg").style;
           var_reg.display = "none";
		   var tam_reg = document.getElementById("tam_reg").style;
		   tam_reg.display = "none";
		   var porc_grat = document.getElementById("porc_grat").style;
		   porc_grat.display = "none";
		   var val_desc = document.getElementById("val_desc").style;
		   val_desc.display = "none";
		   var um = document.getElementById("um").style;
	       um.display = "none" ;
	   }
	   else 
	   {
		var uni = document.getElementById("unidades").style;
	    uni.display = "none" ;
		var pre = document.getElementById("presentacion").style;
	    pre.display = "none" ;
		var var_reg = document.getElementById("var_reg").style;
        var_reg.display = "none";
		var tam_reg = document.getElementById("tam_reg").style;
		tam_reg.display = "none";
		var porc_grat = document.getElementById("porc_grat").style;
		porc_grat.display = "none";
		var val_desc = document.getElementById("val_desc").style;
		val_desc.display = "none";
		var porc_desc = document.getElementById("porc_desc").style;
		porc_desc.display = "none";
		var um = document.getElementById("um").style;
	    um.display = "none" ;
		
	   }
	   
  }
	   
	   
}  


//----------------------------------------------------------------------------------------------------
 /**
   * función para ocultar o mostrar filas de una tabla, recibe como argumento el id de la filacomponente y el id de la imagen
   */  
function ocultar_fila(id_tr)
  {

    if (document.getElementById)
	 {	  
	   var tr = document.getElementById(id_tr).style;
	   
	   (tr.display == "none" ) ? tr.display = "block" : tr.display = "none";
        
	 }    
  }  

//------------------------------------Provincias-Municipios----------------------------------------------------------------------


var array_provincias=new Array();

 var provincias2=new Array();
provincias2[0]=new Array('[Municipio]');
array_provincias[0]=provincias2;

var Pinar_del_Río=new Array();
Pinar_del_Río[0]=new Array('-----Seleccionar-----');
Pinar_del_Río[1]=new Array('2101. Sandino');
Pinar_del_Río[2]=new Array('2102. Mantua');
Pinar_del_Río[3]=new Array('2103. Minas de Matahambre');
Pinar_del_Río[4]=new Array('2104. Viñales');
Pinar_del_Río[5]=new Array('2105. La Palma');
Pinar_del_Río[6]=new Array('2106. Los Palacios');
Pinar_del_Río[7]=new Array('2107. Consolación del Sur');
Pinar_del_Río[8]=new Array('2108. Pinar del Río');
Pinar_del_Río[9]=new Array('2109. San Luis');
Pinar_del_Río[10]=new Array('2110. San Juan y Martinez');
Pinar_del_Río[11]=new Array('2111. Guane');
array_provincias[1]=Pinar_del_Río;

var Artemisa=new Array();
Artemisa[0]=new Array('-----Seleccionar-----');
Artemisa[1]=new Array('2201. Bahía Honda');
Artemisa[2]=new Array('2202. Mariel');
Artemisa[3]=new Array('2203. Guanajay');
Artemisa[4]=new Array('2204. Caimito');
Artemisa[5]=new Array('2205. Bauta');
Artemisa[6]=new Array('2206. San Antonio de los Baños');
Artemisa[7]=new Array('2207. Guira de Melena');
Artemisa[8]=new Array('2208. Alquizar');
Artemisa[9]=new Array('2209. Artemisa');
Artemisa[10]=new Array('2210. Candelaria');
Artemisa[11]=new Array('2211. San Cristóbal');
array_provincias[2]=Artemisa;


var La_Habana=new Array();
La_Habana[0]=new Array('-----Seleccionar-----');
La_Habana[1]=new Array('2301. Playa');
La_Habana[2]=new Array('2302. Plaza de la Revolución');
La_Habana[3]=new Array('2303. Centro Habana');
La_Habana[4]=new Array('2304. Habana Vieja');
La_Habana[5]=new Array('2305. Regla');
La_Habana[6]=new Array('2306. Habana del Este');
La_Habana[7]=new Array('2307. Guanabacoa');
La_Habana[8]=new Array('2308. San Miguel del Padrón');
La_Habana[9]=new Array('2309. Diez de Octubre');
La_Habana[10]=new Array('2310. Cerro');
La_Habana[11]=new Array('2311. Marianao');
La_Habana[12]=new Array('2312. Lisa');
La_Habana[13]=new Array('2313. Boyeros');
La_Habana[14]=new Array('2314. Arroyo Naranjo');
La_Habana[15]=new Array('2315. Cotorro');
array_provincias[3]=La_Habana;

var Mayabeque=new Array();
Mayabeque[0]=new Array('-----Seleccionar-----');
Mayabeque[1]=new Array('2401. Bejucal');
Mayabeque[2]=new Array('2402. San José de las Lajas');
Mayabeque[3]=new Array('2403. Jaruco');
Mayabeque[4]=new Array('2404. Santa Cruz del Norte');
Mayabeque[5]=new Array('2405. Madruga');
Mayabeque[6]=new Array('2406. Nueva Paz');
Mayabeque[7]=new Array('2407. San Nicolás de Bari');
Mayabeque[8]=new Array('2408. Güines');
Mayabeque[9]=new Array('2409. Melena del Sur');
Mayabeque[10]=new Array('2410. Batabanó');
Mayabeque[11]=new Array('2411. Quivicán');

array_provincias[4]=Mayabeque;


var Matanzas=new Array();
Matanzas[0]=new Array('-----Seleccionar-----');
Matanzas[1]=new Array('2501. Matanzas');
Matanzas[2]=new Array('2502. Cárdenas');
Matanzas[3]=new Array('2503. Martí');
Matanzas[4]=new Array('2504. Colón');
Matanzas[5]=new Array('2505. Perico');
Matanzas[6]=new Array('2506. Jovellanos');
Matanzas[7]=new Array('2507. Pedro Betancourt');
Matanzas[8]=new Array('2508. Limonar');
Matanzas[9]=new Array('2509. Unión de Reyes');
Matanzas[10]=new Array('2510. Ciénaga de Zapata');
Matanzas[11]=new Array('2511. Jagüey Grande');
Matanzas[12]=new Array('2512. Calimete');
Matanzas[13]=new Array('2513. Los Arabos');
array_provincias[5]=Matanzas;

var Villa_Clara=new Array();
Villa_Clara[0]=new Array('-----Seleccionar-----');
Villa_Clara[1]=new Array('2601. Corralillo');
Villa_Clara[2]=new Array('2602. Quemado de Güines');
Villa_Clara[3]=new Array('2603. Sagua la Grande');
Villa_Clara[4]=new Array('2604. Encrucijada');
Villa_Clara[5]=new Array('2605. Camajuaní');
Villa_Clara[6]=new Array('2606. Caibarién');
Villa_Clara[7]=new Array('2607. Remedios');
Villa_Clara[8]=new Array('2608. Placetas');
Villa_Clara[9]=new Array('2609. Santa Clara');
Villa_Clara[10]=new Array('2610. Cifuentes');
Villa_Clara[11]=new Array('2611. Santo Domingo');
Villa_Clara[12]=new Array('2612. Ranchuelo');
Villa_Clara[13]=new Array('2613. Manicaragua');
array_provincias[6]=Villa_Clara;

var Cienfuegos=new Array();
Cienfuegos[0]=new Array('-----Seleccionar-----');
Cienfuegos[1]=new Array('2701. Aguada de Pasajeros');
Cienfuegos[2]=new Array('2702. Rodas');
Cienfuegos[3]=new Array('2703. Palmira');
Cienfuegos[4]=new Array('2704. Santa Isabel de las Lajas');
Cienfuegos[5]=new Array('2705. Cruces');
Cienfuegos[6]=new Array('2706. Cumanayagua');
Cienfuegos[7]=new Array('2707. Cienfuegos');
Cienfuegos[8]=new Array('2708. Abreus');
array_provincias[7]=Cienfuegos;

var Sancti_Spíritus=new Array();
Sancti_Spíritus[0]=new Array('-----Seleccionar-----');
Sancti_Spíritus[1]=new Array('2801. Yaguajay');
Sancti_Spíritus[2]=new Array('2802. Jatibonico');
Sancti_Spíritus[3]=new Array('2803. Taguasco');
Sancti_Spíritus[4]=new Array('2804. Cabaiguán');
Sancti_Spíritus[5]=new Array('2805. Fomento');
Sancti_Spíritus[6]=new Array('2806. Trinidad');
Sancti_Spíritus[7]=new Array('2807. Sancti Spíritus');
Sancti_Spíritus[8]=new Array('2808. La Sierpe');
array_provincias[8]=Sancti_Spíritus;

var Ciego_de_Avila=new Array();
Ciego_de_Avila[0]=new Array('-----Seleccionar-----');
Ciego_de_Avila[1]=new Array('2901. Chambas');
Ciego_de_Avila[2]=new Array('2902. Morón');
Ciego_de_Avila[3]=new Array('2903. Bolivia');
Ciego_de_Avila[4]=new Array('2904. Primero de Enero');
Ciego_de_Avila[5]=new Array('2905. Ciro Redondo');
Ciego_de_Avila[6]=new Array('2906. Florencia');
Ciego_de_Avila[7]=new Array('2907. Majagua');
Ciego_de_Avila[8]=new Array('2908. Ciego de Avila');
Ciego_de_Avila[9]=new Array('2909. Venezuela');
Ciego_de_Avila[10]=new Array('2910. Baraguá');
array_provincias[9]=Ciego_de_Avila;


var Camagüey=new Array();
Camagüey[0]=new Array('-----Seleccionar-----');
Camagüey[1]=new Array('3001. Carlos Manuel de Céspedes');
Camagüey[2]=new Array('3002. Esmeralda');
Camagüey[3]=new Array('3003. Sierra de Cubitas');
Camagüey[4]=new Array('3004. Minas');
Camagüey[5]=new Array('3005. Nuevitas');
Camagüey[6]=new Array('3006. Guáimaro');
Camagüey[7]=new Array('3007. Sibanicú');
Camagüey[8]=new Array('3008. Camagüey');
Camagüey[9]=new Array('3009. Florida');
Camagüey[10]=new Array('3010. Vertientes');
Camagüey[11]=new Array('3011. Jimaguayú');
Camagüey[12]=new Array('3012. Najasa');
Camagüey[13]=new Array('3013. Santa Cruz del Sur');
array_provincias[10]=Camagüey;

var Las_Tunas=new Array();
Las_Tunas[0]=new Array('-----Seleccionar-----');
Las_Tunas[1]=new Array('3101. Manatí');
Las_Tunas[2]=new Array('3102. Puerto Padre');
Las_Tunas[3]=new Array('3103. Jesús Menéndez');
Las_Tunas[4]=new Array('3104. Majibacoa');
Las_Tunas[5]=new Array('3105. Las Tunas');
Las_Tunas[6]=new Array('3106. Jobabo');
Las_Tunas[7]=new Array('3107. Colombia');
Las_Tunas[8]=new Array('3108. Amancio Rodríguez');
array_provincias[11]=Las_Tunas;

var Holguin=new Array();
Holguin[0]=new Array('-----Seleccionar-----');
Holguin[1]=new Array('3201. Gibara');
Holguin[2]=new Array('3202. Rafael Freyre');
Holguin[3]=new Array('3203. Banes');
Holguin[4]=new Array('3204. Antilla');
Holguin[5]=new Array('3205. Báguanos');
Holguin[6]=new Array('3206. Holguín');
Holguin[7]=new Array('3207. Calixto García');
Holguin[8]=new Array('3208. Cacocum');
Holguin[9]=new Array('3209. Urbano Noris');
Holguin[10]=new Array('3210. Cueto');
Holguin[11]=new Array('3211. Mayarí');
Holguin[12]=new Array('3212. Frank País');
Holguin[13]=new Array('3213. Sagua de Tánamo');
Holguin[14]=new Array('3214. Moa');
array_provincias[12]=Holguin;


var Granma=new Array();
Granma[0]=new Array('-----Seleccionar-----');
Granma[1]=new Array('3301. Río Cauto');
Granma[2]=new Array('3302. Cauto Cristo');
Granma[3]=new Array('3303. Jiguaní');
Granma[4]=new Array('3304. Bayamo');
Granma[5]=new Array('3305. Yara');
Granma[6]=new Array('3306. Manzanillo');
Granma[7]=new Array('3307. Campechuela');
Granma[8]=new Array('3308. Media Luna');
Granma[9]=new Array('3309. Niquero');
Granma[10]=new Array('3310. Pilón');
Granma[11]=new Array('3311. Bartolomé Masó');
Granma[12]=new Array('3312. Buey Arriba');
Granma[13]=new Array('3313. Guisa');
array_provincias[13]=Granma;

var Santiago_de_Cuba=new Array();
Santiago_de_Cuba[0]=new Array('-----Seleccionar-----');
Santiago_de_Cuba[1]=new Array('3401. Contramaestre');
Santiago_de_Cuba[2]=new Array('3402. Mella');
Santiago_de_Cuba[3]=new Array('3403. San Luis');
Santiago_de_Cuba[4]=new Array('3404. Segundo Frente');
Santiago_de_Cuba[5]=new Array('3405. Songo-La Maya');
Santiago_de_Cuba[6]=new Array('3406. Santiago de Cuba');
Santiago_de_Cuba[7]=new Array('3407. Palma Soriano');
Santiago_de_Cuba[8]=new Array('3408. Tercer Frente');
Santiago_de_Cuba[9]=new Array('3409. Guamá');
array_provincias[14]=Santiago_de_Cuba;

var Guantanamo=new Array();
Guantanamo[0]=new Array('-----Seleccionar-----');
Guantanamo[1]=new Array('3501. El Salvador');
Guantanamo[2]=new Array('3502. Manuel Tames');
Guantanamo[3]=new Array('3503. Yateras');
Guantanamo[4]=new Array('3504. Baracoa');
Guantanamo[5]=new Array('3505. Maisí');
Guantanamo[6]=new Array('3506. Imías');
Guantanamo[7]=new Array('3507. San Antonio del Sur');
Guantanamo[8]=new Array('3508. Caimanera');
Guantanamo[9]=new Array('3509. Guantánamo');
Guantanamo[10]=new Array('3510. Niceto Pérez');
array_provincias[15]=Guantanamo;


var Isla_de_la_Juventud=new Array();
Isla_de_la_Juventud[0]=new Array('4001. Isla de la Juventud');
array_provincias[16]=Isla_de_la_Juventud;






    function clear_comboBox( cb )
    {
        count = cb.options.length;
        for(i=0;i<count;i++)
        {
          cb.options[0] = null;
        }
    }

   function fil_comboBox( cb, grupo, var_mun)
    {//var_mun=eval(var_mun);
		//alert(var_mun);
      clear_comboBox( cb );
      var array=array_provincias[grupo] ;
	  for( i = 0 ; i < array.length ; i++ )
		{
			var value=array[i][0].substring(0,4);//alert(value);
			cb.options[i] = new Option(array[i][0],value,false,false);
			if(value==var_mun)
			{cb.options[i].selected=true;}
		}//document.frm.municipio.options[4].selected;
		//cb.options[3].selected=true;
		//alert(var_mun);
    }
	
	//--------------------------------------------------------------------------------------------------------------------------
	
	//--------------------------------------------------------------------------------------------------------------------------------
	/*function Validar_Tipo_Precio()
    {
	 var msg="";
	 if(document.frm.sel_precio.value==1 )
	{
	    if(document.frm.txt_numero_unidades.value=="")
		{
			msg="Debe llenar la cantidad.";
	       return(msg);
		}
        if(document.frm.radio_perm.value !="1" && document.frm.radio_perm.value!="2")
		{
			msg="Debe marcar si la presentacion permanecerá";
	       return(msg);
		}
					  
	}
					
	else if(document.frm.sel_precio.value==2)
	   if(document.frm.txt_prec_reg.value=="")
	   {
		   msg="Debe llenar precio del regalo.";
		 return(msg);
					 
   else if(document.frm.sel_precio.value==3)
	  if(document.frm.txt_cant_reg.value=="")
	  {
		  msg="Debe llenar la cantidad del regalo.";
		  return(msg);
		 
	  }
					  
  else if(document.frm.sel_precio.value==4)
	 if(document.frm.txt_porc_grat.value=="")
	 {
		 msg="Debe llenar el porciento del regalo."; 
	    return(msg);
	 }
					
  else if(document.frm.sel_precio.value==5)
     if(document.frm.txt_val_desc.value=="")
	 {
		 msg="Debe llenar el valor de descuento.";  
		return(msg);
	 }
						 
 else if(document.frm.sel_precio.value==6)
	if(document.frm.txt_porc_desc.value=="")
	{
		msg="Debe llenar el porciento de descuento.";  
	   return(msg);
	}
	   	  
 }*/	
 