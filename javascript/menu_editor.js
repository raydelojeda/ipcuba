var dir=document.domain;//alert(dir);
var _cmSplit;
		var myMenu =
		[
					[null,'Inicio','http://'+dir+'/IPCuba/captaciones/editor/editor.php',null,'IPCuba'],
			_cmSplit,
			
			
						[null,'Captaci�n Precios',null,null,'Captaci�n Precios',
				['<img src="http://'+dir+'/IPCuba/imagenes/menu/hmenu-unlock.png" >','No centralizados ','http://'+dir+'/IPCuba/captaciones/autor/l_datos_m.php',null,'Captaci�n de Precios No Centralizados a Nivel captaciones'],
					['<img src="http://'+dir+'/IPCuba/imagenes/menu/hmenu-lock.png"  >','Centralizados a nivel provincial ','http://'+dir+'/IPCuba/captaciones/aut_p/l_datos_p.php',null,'Captaci�n de Precios No Centralizados a Nivel captaciones'],
					['<img src="http://'+dir+'/IPCuba/imagenes/menu/hmenu-lock_nac.png" >','Centralizados a nivel nacional  ','http://'+dir+'/IPCuba/captaciones/editor/l_datos_n.php',null,'Captaci�n de Precios No Centralizados a Nivel Municipal'],
			
				
			],
			_cmSplit,			
				[null,'Listados de Precios',null,null,'Listados de precios promedios.',
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/folder_txt.gif" />','Formularios',null,null,'Formularios',
				 ['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/mydocuments.gif" />','Fichas por tipolog�a','http://'+dir+'/IPCuba/administracion/config/l_fichas.php',null,'Administrar formularios'],
				 ['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/vcalendar.gif" />','Fichas por fecha','http://'+dir+'/IPCuba/administracion/config/l_fichas_x_fecha.php',null,'Administrar formularios'],
				 ['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/vcalendar.gif" />','Fichas entre fechas','http://'+dir+'/IPCuba/administracion/config/l_fichas_entre_fechas.php',null,'Administrar formularios'],
				 ],
				 _cmSplit,
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/status_unknown.gif" />','Fuera de rango','http://'+dir+'/IPCuba/captaciones/listados/min_max_relat.php',null,'Listado de relativos de precios con variaciones.',
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/button_ok.gif" />','Aprobaciones','http://'+dir+'/IPCuba/captaciones/listados/aprobacion_min_max_relat.php',null,'Listado de relativos de precios con variaciones de m�s de un 50% para aprobar.'],
				],
				 _cmSplit,
				 ['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/editcopy.gif" >','Modificaciones','http://'+dir+'/IPCuba/captaciones/listados/espejo.php',null,'Cambios en cantidad o U/M.'],
				 _cmSplit,
				 
				
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/home.gif" />','Incidencias','http://'+dir+'/IPCuba/captaciones/listados/inc.php',null,'Listados de establecimientos con incidencias.',
				 
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/vcalendar.gif" />','Establecimientos cerrados temporalmente','http://'+dir+'/IPCuba/captaciones/listados/inc_E1.php',null,'Listados de establecimientos cerrados temporalmente.'],
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/out.gif" />','Establecimientos cerrados definitivamente','http://'+dir+'/IPCuba/captaciones/listados/inc_E2.php',null,'Listados de establecimientos cerrados definitivamente.'],
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/agt_stop.gif" />','Establecimientos no visitados','http://'+dir+'/IPCuba/captaciones/listados/inc_E3.php',null,'Listados de establecimientos no visitados.'],
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/blck16_1.gif" />','Establecimientos negados','http://'+dir+'/IPCuba/captaciones/listados/inc_E4.php',null,'Listados de establecimientos negados a brindar informaci�n.'],],
				
				
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/signature.gif" />','Observaciones','http://'+dir+'/IPCuba/captaciones/listados/obs.php',null,'Listados de establecimientos con observaciones.',
				 
				 ['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/package_application.gif" />','Variedades comparables','http://'+dir+'/IPCuba/captaciones/listados/obs_C.php',null,'Listados de variedades comparables.'],
				 ['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/2downarrow.gif" />','Variedades con rebajas','http://'+dir+'/IPCuba/captaciones/listados/obs_R.php',null,'Listados de variedades rebajadas.'],
				 ['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/3d.gif" />','Variedades con cambio de cantidad o UM','http://'+dir+'/IPCuba/captaciones/listados/obs_UM.php',null,'Listados de variedades con cambio de cantidad o UM.'],
				 ['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/insert_table_row.gif" />','Variedades con ofertas','http://'+dir+'/IPCuba/captaciones/listados/obs_O.php',null,'Listados de variedades en ofertas.'],
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/vcalendar.gif" />','Variedades con faltas estacionales','http://'+dir+'/IPCuba/captaciones/listados/obs_FE.php',null,'Listados de variedades con faltas estacionales.'],
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/out.gif" />','Variedades con faltas ocasionales','http://'+dir+'/IPCuba/captaciones/listados/obs_FO.php',null,'Listados de variedades con faltas ocasionales.'],
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/agt_stop.gif" />','Variedades con faltas definitivas','http://'+dir+'/IPCuba/captaciones/listados/obs_FD.php',null,'Listados de variedades con faltas definitivas.'],
				
				],
				
				
				
				
				_cmSplit,
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/windowlist.gif" />','Serie de precios no centralizados','http://'+dir+'/IPCuba/captaciones/listados/l_cap_serie.php',null,'Series de precios no centralizados.'],
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/windowlist.gif" />','Serie de precios centralizados provincialmente','http://'+dir+'/IPCuba/captaciones/listados/l_cap_serie_p.php',null,'Series de precios centralizados provincialmente.'],
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/windowlist.gif" />','Serie de precios centralizados nacionalmente','http://'+dir+'/IPCuba/captaciones/listados/l_cap_serie_n.php',null,'Series de precios centralizados nacionalmente.'],
				
				
			],	
						
			_cmSplit,
					
			[null,'C�lculos',null,null,'C�lculos de precios promedios e �ndices',
				/*['<img src="http://'+dir+'/IPCuba/imagenes/menu/globe1.png" />','Base',null,null,'C�lculos de datos de la base',
					['<img src="http://'+dir+'/IPCuba/imagenes/menu/edit.png" />','Calcular Valor Base','http://'+dir+'/IPCuba/administracion/base/calculo_valor.php', null,'C�lculo de valores base'],
					['<img src="http://'+dir+'/IPCuba/imagenes/menu/edit.png" />','Calcular Ponderaciones','http://'+dir+'/IPCuba/administracion/base/calculo_pond.php', null,'C�lculo de ponderaciones'],
				],*/
				['<img src="http://'+dir+'/IPCuba/imagenes/menu/globe1.png" />','Nivel Provincial',null,null,'C�lculos de datos a nivel provincial',
					['<img src="http://'+dir+'/IPCuba/imagenes/menu/edit.png" />','Calcular Datos','http://'+dir+'/IPCuba/cap_prov/calculo_provincial.php', null,'C�lculo de datos a nivel provincial'],
					['<img src="http://'+dir+'/IPCuba/imagenes/menu/edit.png" />','Recalcular Datos','http://'+dir+'/IPCuba/cap_prov/l_recalculo_provincial.php', null,'Rec�lculo de datos a nivel provincial'],
				],
				
				['<img src="http://'+dir+'/IPCuba/imagenes/menu/globe1.png" />','Nivel Nacional',null,null,'C�lculo de datos a nivel nacional',
					['<img src="http://'+dir+'/IPCuba/imagenes/menu/edit.png" />','Calcular Datos','http://'+dir+'/IPCuba/cap_nac/l_calculo_nacional.php', null,'C�lculo de datos a nivel nacional'],
					//['<img src="http://'+dir+'/IPCuba/imagenes/menu/edit.png" />','Recalcular Datos','http://'+dir+'/IPCuba/cap_nac/l_calculo_nacional.php', null,'Rec�lculo de datos a nivel nacional'],
				],
				
				['<img src="http://'+dir+'/IPCuba/imagenes/menu/globe1.png" />','�ndices',null,null,'C�lculo del �ndice a nivel nacional',
					['<img src="http://'+dir+'/IPCuba/imagenes/menu/edit.png" />','Calcular �ndices','http://'+dir+'/IPCuba/indices/calculo_indice_total.php', null,'C�lculo de �ndices.'],
					//['<img src="http://'+dir+'/IPCuba/imagenes/menu/edit.png" />','Recalcular Datos','http://'+dir+'/IPCuba/cap_nac/l_calculo_nacional.php', null,'Rec�lculo de �ndices.'],
				],
				
				
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/db_comit.gif" />','C�lculo �ndices',null,null,'C�lculo de �ndices.',
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/up.gif" />','Nivel de variedad en cada municipio','http://'+dir+'/IPCuba/indices/cal_indice_nivel_var_x_dpa.php', null,'C�lculo de �ndices a nivel de variedad en cada municipio usando media geom�trica.'],
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/up.gif" />','Nivel de art�culo en cada municipio','http://'+dir+'/IPCuba/indices/cal_indice_nivel_art_x_dpa.php', null,'C�lculo de �ndices a nivel de art�culo en cada municipio usando media geom�trica.'],
					
					_cmSplit,
					
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/up.gif" />','Nivel de art�culo nacional','http://'+dir+'/IPCuba/indices/cal_indice_nivel_art.php', null,'C�lculo de �ndices a nivel de art�culo nacional usando media aritm�tica ponderada.'],
					
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/up.gif" />','Niveles superiores','http://'+dir+'/IPCuba/indices/cal_indice_nivel_sup.php', null,'C�lculo de �ndices a niveles superiores nacional usando media aritm�tica ponderada.'],
					
					_cmSplit,
					
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/up.gif" />','&Iacute;ndice general','http://'+dir+'/IPCuba/indices/cal_indice_nivel_art_x_dpa.php', null,'C�lculo del lndice general nacional usando media aritm�tica ponderada.'],
					//['<img src="http://'+dir+'/IPCuba/imagenes/menu/edit.png" />','Recalcular Datos','http://'+dir+'/IPCuba/cap_nac/l_calculo_nacional.php', null,'Rec�lculo de �ndices.'],
				],
				
				
			],
			_cmSplit,		
				
						[null,'Reportes',null,null,'Reportes',
				
		['<img src="http://'+dir+'/IPCuba/imagenes/menu/db.png" />','Lista de bienes y servicios','http://'+dir+'/IPCuba/administracion/nomencladores/general/l_bienes_x_moneda.php', null,'Lista de bienes y servicios.'],
				
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/windows_list.gif" />','Lista de bienes y servicios y ponderaciones','http://'+dir+'/IPCuba/administracion/nomencladores/general/l_pond.php', null,'Lista de bienes y servicios y ponderaciones.'],
				_cmSplit,
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/file_temporary.gif" />','Cantidad de establecimientos por fecha','http://'+dir+'/IPCuba/administracion/base/var_estab/cant_estab_x_fecha.php', null,'Cantidad de establecimientos por fecha'],
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/package_applications.gif" />','Establecimientos por fecha','http://'+dir+'/IPCuba/administracion/base/var_estab/estab_x_fecha.php', null,'Establecimientos por fecha'],
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/agt_business.gif" />','Cantidad de precios por variedad','http://'+dir+'/IPCuba/administracion/base/var_estab/cant_precios_x_var.php', null,'Cantidad de precios por variedad'],
				
				['<img src="http://'+dir+'/IPCuba/imagenes/menu/content.png" />','Establecimientos por DPA','http://'+dir+'/IPCuba/administracion/nomencladores/estab/l_estab_asignados.php',null,'Establecimientos por DPA'],
				 _cmSplit,
				 
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/lists.gif" />','Carta de presentaci�n','http://'+dir+'/IPCuba/administracion/nomencladores/estab/l_carta.php', null,'Carta de presentaci�n'],
							
	
				 
				_cmSplit,
				
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/bell.gif" />','Faltas por variedad','http://'+dir+'/IPCuba/administracion/base/var_estab/l_faltas_x_var.php',null,'Faltas por variedad'],
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/bell.gif" />','Faltas por art�culo','http://'+dir+'/IPCuba/administracion/base/var_estab/l_faltas_x_art.php',null,'Faltas por art�culo'],
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/bell.gif" />','Faltas por art�culo por mercado','http://'+dir+'/IPCuba/administracion/base/var_estab/l_faltas_x_art_x_mer.php',null,'Faltas por art�culo por mercado.'],
				_cmSplit,
								
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/bell.gif" />','Faltas por variedad','http://'+dir+'/IPCuba/administracion/base/var_estab/l_faltas_x_var.php',null,'Faltas por variedad'],
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/bell.gif" />','Faltas por art�culo','http://'+dir+'/IPCuba/administracion/base/var_estab/l_faltas_x_art.php',null,'Faltas por art�culo'],
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/bell.gif" />','Faltas por art�culo por mercado','http://'+dir+'/IPCuba/administracion/base/var_estab/l_faltas_x_art_x_mer.php',null,'Faltas por art�culo por mercado.'],
				_cmSplit,
								
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/favorites.gif" />','Cumplimientos','http://'+dir+'/IPCuba/administracion/base/var_estab/l_inc_x_prov.php',null,'Cumplimientos'],
				_cmSplit,
				
				
				['<img src="http://'+dir+'/IPCuba/imagenes/menu/document.png" />','Micro�ndices',null,null,'Micro�ndices por rubros y mercados.',
				 ['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/folder_blue.gif" />','Por rubros',null, null,'Micro�ndices por rubros.',
				 
				 ['<img src="http://'+dir+'/IPCuba/imagenes/menu/document.png" />','Micro�ndices de variedad en cada municipio','http://'+dir+'/IPCuba/indices/general/listados/indice_var_dpa.php', null,'Micro�ndices a nivel de variedad en cada municipio.'],
				
				['<img src="http://'+dir+'/IPCuba/imagenes/menu/document.png" />','Micro�ndices de art�culo en cada municipio','http://'+dir+'/IPCuba/indices/general/listados/indice_art_dpa.php', null,'Micro�ndices a nivel de art�culo en cada municipio.'],
					
					
					
				],
					
			
				 
				 ['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/folder_green.gif" />','Por mercados',null, null,'Micro�ndices por mercado.',
				 
				
				
				 ['<img src="http://'+dir+'/IPCuba/imagenes/menu/document.png" />','Micro�ndices de variedad en cada municipio por mercado','http://'+dir+'/IPCuba/indices/x_mer/listados/indice_var_dpa_x_mer.php', null,'Micro�ndices a nivel de variedad en cada municipio por mercado.'],
				
				['<img src="http://'+dir+'/IPCuba/imagenes/menu/document.png" />','Micro�ndices de art�culo en cada municipio por mercado','http://'+dir+'/IPCuba/indices/x_mer/listados/indice_art_dpa_x_mer.php', null,'Micro�ndices a nivel de art�culo en cada municipio por mercado.'],
					
				],
				 
			 ],
				
				['<img src="http://'+dir+'/IPCuba/imagenes/menu/sysinfo.png" />','lndices por Divisiones','http://'+dir+'/IPCuba/indices/l_indices_div.php',null,'lndices y Variaciones por divisi�n'],
				['<img src="http://'+dir+'/IPCuba/imagenes/menu/sysinfo.png" />','lndices por Mercados','http://'+dir+'/IPCuba/indices/l_indices_mer.php',null,'lndices y Variaciones por mercados'],
				_cmSplit,
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/folder_green.gif" />','Historial',null,null,'Historial',
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/folder_red.gif" />','Productos Base','http://'+dir+'/IPCuba/administracion/base/l_bproducto_historial.php', null,'Historial de productos de a�os bases'],
					_cmSplit,
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/folder_blank.gif" />','Nivel Municipal','http://'+dir+'/IPCuba/captaciones/autor/l_datos_historial.php', null,'Historial a Nivel Municipal'],
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/folder_blue.gif" />','Nivel Provincial','http://'+dir+'/IPCuba/cap_prov/l_datos_historial.php', null,'Historial a Nivel Provincial'],
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/folder_grey.gif" />','Nivel Nacional','http://'+dir+'/IPCuba/cap_nac/l_datos_historial.php', null,'Historial a Nivel Nacional'],


				],],
				_cmSplit,
				
			[null,'Servicios',null,null,'Servicios',
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/exit.gif" />','Cerrar Sesi�n','http://'+dir+'/IPCuba/php/logout.php',null,'Salir del Sistema'],
				
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/password.gif" />','Cambiar Contrase�a','http://'+dir+'/IPCuba/seguridad/cambiar_clave.php',null,'Cambiar Contrase�a'],
				
			],
			_cmSplit,
			
			
		
				[null,'Ayuda',null,null,'Ayuda',
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/help.gif" />','Acerca de IPCuba','http://'+dir+'/IPCuba/help/acerca.htm',null,'Acerca de IPCuba'],
				
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/info.gif" />','Informaci�n','http://'+dir+'/IPCuba/help/informacion.htm',null,'Informaci�n'],
				
                ['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/fileimport.gif" />','Documentaci�n','http://'+dir+'/IPCuba/help/manuales.htm',null,'Documentaci�n'],				
			],
		
		];
		cmDraw ('myMenuID', myMenu, 'hbr', cmThemeOffice, 'ThemeOffice');