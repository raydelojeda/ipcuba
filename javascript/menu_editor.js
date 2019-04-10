var dir=document.domain;//alert(dir);
var _cmSplit;
		var myMenu =
		[
					[null,'Inicio','http://'+dir+'/IPCuba/captaciones/editor/editor.php',null,'IPCuba'],
			_cmSplit,
			
			
						[null,'Captación Precios',null,null,'Captación Precios',
				['<img src="http://'+dir+'/IPCuba/imagenes/menu/hmenu-unlock.png" >','No centralizados ','http://'+dir+'/IPCuba/captaciones/autor/l_datos_m.php',null,'Captación de Precios No Centralizados a Nivel captaciones'],
					['<img src="http://'+dir+'/IPCuba/imagenes/menu/hmenu-lock.png"  >','Centralizados a nivel provincial ','http://'+dir+'/IPCuba/captaciones/aut_p/l_datos_p.php',null,'Captación de Precios No Centralizados a Nivel captaciones'],
					['<img src="http://'+dir+'/IPCuba/imagenes/menu/hmenu-lock_nac.png" >','Centralizados a nivel nacional  ','http://'+dir+'/IPCuba/captaciones/editor/l_datos_n.php',null,'Captación de Precios No Centralizados a Nivel Municipal'],
			
				
			],
			_cmSplit,			
				[null,'Listados de Precios',null,null,'Listados de precios promedios.',
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/folder_txt.gif" />','Formularios',null,null,'Formularios',
				 ['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/mydocuments.gif" />','Fichas por tipología','http://'+dir+'/IPCuba/administracion/config/l_fichas.php',null,'Administrar formularios'],
				 ['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/vcalendar.gif" />','Fichas por fecha','http://'+dir+'/IPCuba/administracion/config/l_fichas_x_fecha.php',null,'Administrar formularios'],
				 ['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/vcalendar.gif" />','Fichas entre fechas','http://'+dir+'/IPCuba/administracion/config/l_fichas_entre_fechas.php',null,'Administrar formularios'],
				 ],
				 _cmSplit,
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/status_unknown.gif" />','Fuera de rango','http://'+dir+'/IPCuba/captaciones/listados/min_max_relat.php',null,'Listado de relativos de precios con variaciones.',
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/button_ok.gif" />','Aprobaciones','http://'+dir+'/IPCuba/captaciones/listados/aprobacion_min_max_relat.php',null,'Listado de relativos de precios con variaciones de más de un 50% para aprobar.'],
				],
				 _cmSplit,
				 ['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/editcopy.gif" >','Modificaciones','http://'+dir+'/IPCuba/captaciones/listados/espejo.php',null,'Cambios en cantidad o U/M.'],
				 _cmSplit,
				 
				
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/home.gif" />','Incidencias','http://'+dir+'/IPCuba/captaciones/listados/inc.php',null,'Listados de establecimientos con incidencias.',
				 
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/vcalendar.gif" />','Establecimientos cerrados temporalmente','http://'+dir+'/IPCuba/captaciones/listados/inc_E1.php',null,'Listados de establecimientos cerrados temporalmente.'],
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/out.gif" />','Establecimientos cerrados definitivamente','http://'+dir+'/IPCuba/captaciones/listados/inc_E2.php',null,'Listados de establecimientos cerrados definitivamente.'],
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/agt_stop.gif" />','Establecimientos no visitados','http://'+dir+'/IPCuba/captaciones/listados/inc_E3.php',null,'Listados de establecimientos no visitados.'],
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/blck16_1.gif" />','Establecimientos negados','http://'+dir+'/IPCuba/captaciones/listados/inc_E4.php',null,'Listados de establecimientos negados a brindar información.'],],
				
				
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
					
			[null,'Cálculos',null,null,'Cálculos de precios promedios e índices',
				/*['<img src="http://'+dir+'/IPCuba/imagenes/menu/globe1.png" />','Base',null,null,'Cálculos de datos de la base',
					['<img src="http://'+dir+'/IPCuba/imagenes/menu/edit.png" />','Calcular Valor Base','http://'+dir+'/IPCuba/administracion/base/calculo_valor.php', null,'Cálculo de valores base'],
					['<img src="http://'+dir+'/IPCuba/imagenes/menu/edit.png" />','Calcular Ponderaciones','http://'+dir+'/IPCuba/administracion/base/calculo_pond.php', null,'Cálculo de ponderaciones'],
				],*/
				['<img src="http://'+dir+'/IPCuba/imagenes/menu/globe1.png" />','Nivel Provincial',null,null,'Cálculos de datos a nivel provincial',
					['<img src="http://'+dir+'/IPCuba/imagenes/menu/edit.png" />','Calcular Datos','http://'+dir+'/IPCuba/cap_prov/calculo_provincial.php', null,'Cálculo de datos a nivel provincial'],
					['<img src="http://'+dir+'/IPCuba/imagenes/menu/edit.png" />','Recalcular Datos','http://'+dir+'/IPCuba/cap_prov/l_recalculo_provincial.php', null,'Recálculo de datos a nivel provincial'],
				],
				
				['<img src="http://'+dir+'/IPCuba/imagenes/menu/globe1.png" />','Nivel Nacional',null,null,'Cálculo de datos a nivel nacional',
					['<img src="http://'+dir+'/IPCuba/imagenes/menu/edit.png" />','Calcular Datos','http://'+dir+'/IPCuba/cap_nac/l_calculo_nacional.php', null,'Cálculo de datos a nivel nacional'],
					//['<img src="http://'+dir+'/IPCuba/imagenes/menu/edit.png" />','Recalcular Datos','http://'+dir+'/IPCuba/cap_nac/l_calculo_nacional.php', null,'Recálculo de datos a nivel nacional'],
				],
				
				['<img src="http://'+dir+'/IPCuba/imagenes/menu/globe1.png" />','Índices',null,null,'Cálculo del índice a nivel nacional',
					['<img src="http://'+dir+'/IPCuba/imagenes/menu/edit.png" />','Calcular Índices','http://'+dir+'/IPCuba/indices/calculo_indice_total.php', null,'Cálculo de índices.'],
					//['<img src="http://'+dir+'/IPCuba/imagenes/menu/edit.png" />','Recalcular Datos','http://'+dir+'/IPCuba/cap_nac/l_calculo_nacional.php', null,'Recálculo de índices.'],
				],
				
				
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/db_comit.gif" />','Cálculo Índices',null,null,'Cálculo de índices.',
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/up.gif" />','Nivel de variedad en cada municipio','http://'+dir+'/IPCuba/indices/cal_indice_nivel_var_x_dpa.php', null,'Cálculo de índices a nivel de variedad en cada municipio usando media geométrica.'],
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/up.gif" />','Nivel de artículo en cada municipio','http://'+dir+'/IPCuba/indices/cal_indice_nivel_art_x_dpa.php', null,'Cálculo de índices a nivel de artículo en cada municipio usando media geométrica.'],
					
					_cmSplit,
					
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/up.gif" />','Nivel de artículo nacional','http://'+dir+'/IPCuba/indices/cal_indice_nivel_art.php', null,'Cálculo de índices a nivel de artículo nacional usando media aritmética ponderada.'],
					
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/up.gif" />','Niveles superiores','http://'+dir+'/IPCuba/indices/cal_indice_nivel_sup.php', null,'Cálculo de índices a niveles superiores nacional usando media aritmética ponderada.'],
					
					_cmSplit,
					
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/up.gif" />','&Iacute;ndice general','http://'+dir+'/IPCuba/indices/cal_indice_nivel_art_x_dpa.php', null,'Cálculo del lndice general nacional usando media aritmética ponderada.'],
					//['<img src="http://'+dir+'/IPCuba/imagenes/menu/edit.png" />','Recalcular Datos','http://'+dir+'/IPCuba/cap_nac/l_calculo_nacional.php', null,'Recálculo de índices.'],
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
				 
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/lists.gif" />','Carta de presentación','http://'+dir+'/IPCuba/administracion/nomencladores/estab/l_carta.php', null,'Carta de presentación'],
							
	
				 
				_cmSplit,
				
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/bell.gif" />','Faltas por variedad','http://'+dir+'/IPCuba/administracion/base/var_estab/l_faltas_x_var.php',null,'Faltas por variedad'],
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/bell.gif" />','Faltas por artículo','http://'+dir+'/IPCuba/administracion/base/var_estab/l_faltas_x_art.php',null,'Faltas por artículo'],
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/bell.gif" />','Faltas por artículo por mercado','http://'+dir+'/IPCuba/administracion/base/var_estab/l_faltas_x_art_x_mer.php',null,'Faltas por artículo por mercado.'],
				_cmSplit,
								
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/bell.gif" />','Faltas por variedad','http://'+dir+'/IPCuba/administracion/base/var_estab/l_faltas_x_var.php',null,'Faltas por variedad'],
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/bell.gif" />','Faltas por artículo','http://'+dir+'/IPCuba/administracion/base/var_estab/l_faltas_x_art.php',null,'Faltas por artículo'],
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/bell.gif" />','Faltas por artículo por mercado','http://'+dir+'/IPCuba/administracion/base/var_estab/l_faltas_x_art_x_mer.php',null,'Faltas por artículo por mercado.'],
				_cmSplit,
								
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/favorites.gif" />','Cumplimientos','http://'+dir+'/IPCuba/administracion/base/var_estab/l_inc_x_prov.php',null,'Cumplimientos'],
				_cmSplit,
				
				
				['<img src="http://'+dir+'/IPCuba/imagenes/menu/document.png" />','Microíndices',null,null,'Microíndices por rubros y mercados.',
				 ['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/folder_blue.gif" />','Por rubros',null, null,'Microíndices por rubros.',
				 
				 ['<img src="http://'+dir+'/IPCuba/imagenes/menu/document.png" />','Microíndices de variedad en cada municipio','http://'+dir+'/IPCuba/indices/general/listados/indice_var_dpa.php', null,'Microíndices a nivel de variedad en cada municipio.'],
				
				['<img src="http://'+dir+'/IPCuba/imagenes/menu/document.png" />','Microíndices de artículo en cada municipio','http://'+dir+'/IPCuba/indices/general/listados/indice_art_dpa.php', null,'Microíndices a nivel de artículo en cada municipio.'],
					
					
					
				],
					
			
				 
				 ['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/folder_green.gif" />','Por mercados',null, null,'Microíndices por mercado.',
				 
				
				
				 ['<img src="http://'+dir+'/IPCuba/imagenes/menu/document.png" />','Microíndices de variedad en cada municipio por mercado','http://'+dir+'/IPCuba/indices/x_mer/listados/indice_var_dpa_x_mer.php', null,'Microíndices a nivel de variedad en cada municipio por mercado.'],
				
				['<img src="http://'+dir+'/IPCuba/imagenes/menu/document.png" />','Microíndices de artículo en cada municipio por mercado','http://'+dir+'/IPCuba/indices/x_mer/listados/indice_art_dpa_x_mer.php', null,'Microíndices a nivel de artículo en cada municipio por mercado.'],
					
				],
				 
			 ],
				
				['<img src="http://'+dir+'/IPCuba/imagenes/menu/sysinfo.png" />','lndices por Divisiones','http://'+dir+'/IPCuba/indices/l_indices_div.php',null,'lndices y Variaciones por división'],
				['<img src="http://'+dir+'/IPCuba/imagenes/menu/sysinfo.png" />','lndices por Mercados','http://'+dir+'/IPCuba/indices/l_indices_mer.php',null,'lndices y Variaciones por mercados'],
				_cmSplit,
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/folder_green.gif" />','Historial',null,null,'Historial',
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/folder_red.gif" />','Productos Base','http://'+dir+'/IPCuba/administracion/base/l_bproducto_historial.php', null,'Historial de productos de años bases'],
					_cmSplit,
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/folder_blank.gif" />','Nivel Municipal','http://'+dir+'/IPCuba/captaciones/autor/l_datos_historial.php', null,'Historial a Nivel Municipal'],
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/folder_blue.gif" />','Nivel Provincial','http://'+dir+'/IPCuba/cap_prov/l_datos_historial.php', null,'Historial a Nivel Provincial'],
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/folder_grey.gif" />','Nivel Nacional','http://'+dir+'/IPCuba/cap_nac/l_datos_historial.php', null,'Historial a Nivel Nacional'],


				],],
				_cmSplit,
				
			[null,'Servicios',null,null,'Servicios',
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/exit.gif" />','Cerrar Sesión','http://'+dir+'/IPCuba/php/logout.php',null,'Salir del Sistema'],
				
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/password.gif" />','Cambiar Contraseña','http://'+dir+'/IPCuba/seguridad/cambiar_clave.php',null,'Cambiar Contraseña'],
				
			],
			_cmSplit,
			
			
		
				[null,'Ayuda',null,null,'Ayuda',
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/help.gif" />','Acerca de IPCuba','http://'+dir+'/IPCuba/help/acerca.htm',null,'Acerca de IPCuba'],
				
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/info.gif" />','Información','http://'+dir+'/IPCuba/help/informacion.htm',null,'Información'],
				
                ['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/fileimport.gif" />','Documentación','http://'+dir+'/IPCuba/help/manuales.htm',null,'Documentación'],				
			],
		
		];
		cmDraw ('myMenuID', myMenu, 'hbr', cmThemeOffice, 'ThemeOffice');