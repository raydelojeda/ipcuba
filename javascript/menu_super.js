var dir=document.domain;//alert(dir);
var _cmSplit;
 
		var myMenu =
		[
					[null,'Inicio','http://'+dir+'/IPCuba/seguridad/autenticacion.php',null,'IPCuba'],
			_cmSplit,
			
			
						[null,'Captaci�n Precios',null,null,'Captaci�n Precios',
				['<img src="http://'+dir+'/IPCuba/imagenes/menu/hmenu-unlock.png" >','No centralizados ','http://'+dir+'/IPCuba/captaciones/autor/l_datos_m.php',null,'Captaci�n de Precios No Centralizados a Nivel captaciones'],
					['<img src="http://'+dir+'/IPCuba/imagenes/menu/hmenu-lock.png"  >','Centralizados a nivel provincial ','http://'+dir+'/IPCuba/captaciones/aut_p/l_datos_p.php',null,'Captaci�n de Precios No Centralizados a Nivel captaciones'],
					['<img src="http://'+dir+'/IPCuba/imagenes/menu/hmenu-lock_nac.png" >','Centralizados a nivel nacional  ','http://'+dir+'/IPCuba/captaciones/editor/l_datos_n.php',null,'Captaci�n de Precios No Centralizados a Nivel Municipal.'],
					
			
				
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
				 ['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/editcopy.gif" >','Modificaciones','http://'+dir+'/IPCuba/captaciones/listados/l_espejo.php',null,'Cambios en cantidad o U/M.'],
				 _cmSplit, 
				 ['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/add.gif" >','Imputadas','http://'+dir+'/IPCuba/captaciones/listados/l_imputados.php',null,'Captaciones agregadas por imputaci�n.',
				  ['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/edit_add1.gif" />','Por municipio','http://'+dir+'/IPCuba/captaciones/listados/l_cap_imp_x_mun.php',null,'Captaciones agregadas por imputaci�n en cada municipio.'],
				   ['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/edit_add2.gif" />','Por variedad','http://'+dir+'/IPCuba/captaciones/listados/l_cap_imp_x_var.php',null,'Captaciones agregadas por imputaci�n por variedad.'],
				  
				  
				  
				  ],
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
			
			[null,'Administraci�n','http://'+dir+'/IPCuba/administracion/config/admin.php',null,'Administraci�n',
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/edit_group.gif" />','Usuarios','http://'+dir+'/IPCuba/administracion/usuarios/l_usuario.php',null,'Administrar Usuarios'],
				_cmSplit,
				['<img src="http://'+dir+'/IPCuba/imagenes/menu/categories.png" />','Nomencladores',null,null,'Nomencladores',				
					['<img src="http://'+dir+'/IPCuba/imagenes/menu/weblink.png" />','DPA','http://'+dir+'/IPCuba/administracion/nomencladores/dpa/l_dpa.php', null,'Provincias-Municipios'], 
					
					_cmSplit,
					//-------------------------------------------------------------------
					
					
					['<img src="http://'+dir+'/IPCuba/imagenes/menu/component.png" />','Divisiones','http://'+dir+'/IPCuba/administracion/nomencladores/division/l_division.php', null,'Divisiones'],
						['<img src="http://'+dir+'/IPCuba/imagenes/menu/component.png" />','Grupos','http://'+dir+'/IPCuba/administracion/nomencladores/grupo/l_grupo.php', null,'Grupos'],
							['<img src="http://'+dir+'/IPCuba/imagenes/menu/component.png" />','Clases','http://'+dir+'/IPCuba/administracion/nomencladores/clase/l_clase.php', null,'Clases'],
															
								
								['<img src="http://'+dir+'/IPCuba/imagenes/menu/component.png" />','Subclases','http://'+dir+'/IPCuba/administracion/nomencladores/subclase/l_subclase.php', null,null,'Subclases'  
								
								 
								 	['<img src="http://'+dir+'/IPCuba/imagenes/menu/component.png" />','Art�culos','http://'+dir+'/IPCuba/administracion/nomencladores/articulo/l_articulo.php', null,'Art�culos'],
									 		['<img src="http://'+dir+'/IPCuba/imagenes/menu/component.png" />','ENIGH','http://'+dir+'/IPCuba/administracion/nomencladores/e_subclase/l_subclase.php', null,'ENIGH' ],  
									 
								 ],
									['<img src="http://'+dir+'/IPCuba/imagenes/menu/component.png" />','Art�culos','http://'+dir+'/IPCuba/administracion/nomencladores/articulo/l_articulo.php', null,null,'Art�culos'
									 ['<img src="http://'+dir+'/IPCuba/imagenes/menu/component.png" />','Art�culos','http://'+dir+'/IPCuba/administracion/nomencladores/articulo/l_articulo.php', null,null,'Art�culos'],
									  ['<img src="http://'+dir+'/IPCuba/imagenes/menu/component.png" />','ENIGH','http://'+dir+'/IPCuba/administracion/nomencladores/e_articulo/l_articulo.php', null,'ENIGH'],
									],
										['<img src="http://'+dir+'/IPCuba/imagenes/menu/component.png" />','Variedades','http://'+dir+'/IPCuba/administracion/nomencladores/variedad/l_variedad.php', null,'Variedades'],
											
											
									
					_cmSplit,
					//-------------------------------------------------------------------
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/exec.gif" />','Tipolog�a','http://'+dir+'/IPCuba/administracion/nomencladores/tipologia/l_tipologia.php', null,'Tipolog�a'],
					['<img src="http://'+dir+'/IPCuba/imagenes/menu/home.png" />','Establecimientos','http://'+dir+'/IPCuba/administracion/nomencladores/estab/l_estab.php', null,'Establecimientos',
					 
					 ['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/lists.gif" />','Carta de presentaci�n','http://'+dir+'/IPCuba/administracion/nomencladores/estab/l_carta.php', null,'Carta de presentaci�n'],
					 
					 ],
					//['<img src="http://'+dir+'/IPCuba/imagenes/menu/user.png" />','Vendedores','http://'+dir+'/IPCuba/administracion/nomencladores/productor_estab/l_productor_estab.php', null,'Vendedores'],
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/package.gif" />','Mercados','http://'+dir+'/IPCuba/administracion/nomencladores/mercado/l_mercado.php', null,'Mercados'],
					['<img src="http://'+dir+'/IPCuba/imagenes/menu/document.png" />','Unidad Medida','http://'+dir+'/IPCuba/administracion/nomencladores/unidad/l_unidad.php', null,'Unidad Medida',
					 
					 ['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/agt_business.gif" />','Correlacionador','http://'+dir+'/IPCuba/administracion/nomencladores/correlacionador/l_correlacionador.php', null,'Correlacionador de U/M'],
					 
					 ],
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/cache.gif" />','Observaciones','http://'+dir+'/IPCuba/administracion/nomencladores/obs/l_obs.php', null,'Observaciones'],
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/cache.gif" />','Incidencias','http://'+dir+'/IPCuba/administracion/nomencladores/inc/l_inc.php', null,'Incidencias'],
								
				],
				_cmSplit,
					
				//['<img src="http://'+dir+'/IPCuba/imagenes/menu/statistics.png" />','Precio M�x y M�n','http://'+dir+'/IPCuba/administracion/nomencladores/general/producto_mercado/l_producto_mercado.php',null,'Precio M�ximo y M�nimo de Productos por Mercado'],
				//['<img src="http://'+dir+'/IPCuba/imagenes/menu/controlpanel.png" />','A�o Base','http://'+dir+'/IPCuba/administracion/base/l_base.php',null,'A�o Base'],
			['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/configure.gif" />','Variedad-Establecimiento','http://'+dir+'/IPCuba/administracion/base/var_estab/l_var_estab.php',null,'Variedad-Establecimiento'],
			
			_cmSplit,
			
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/folder_public.gif" />','Ponderaciones','http://'+dir+'/IPCuba/administracion/nomencladores/general/l_canasta.php', null,'Ponderaciones.',
					
				
				
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/folder_blue.gif" />','Por rubros','http://'+dir+'/IPCuba/administracion/nomencladores/general/l_canasta.php', null,'Ponderaciones por rubros.',	
					
					
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/folder_outbox.gif" />','Insertar rubros','http://'+dir+'/IPCuba/administracion/rubros/llenar_niveles.php', null,'Insertar rubros.'],
					
					_cmSplit,
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/folder_blue.gif" />','Divisiones','http://'+dir+'/IPCuba/administracion/rubros/division/l_division.php', null,'Divisiones.'],
						['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/folder_blue.gif" />','Grupos','http://'+dir+'/IPCuba/administracion/rubros/grupo/l_grupo.php', null,'Grupos.'],
							['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/folder_blue.gif" />','Clases','http://'+dir+'/IPCuba/administracion/rubros/clase/l_clase.php', null,'Clases.'],
								['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/folder_blue.gif" />','Subclases','http://'+dir+'/IPCuba/administracion/rubros/subclase/l_subclase.php', null,'Subclases.'],
									['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/folder_blue.gif" />','Art�culos','http://'+dir+'/IPCuba/administracion/rubros/articulo/l_articulo.php', null,'Art�culos.'],
										['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/folder_blue.gif" />','Variedades','http://'+dir+'/IPCuba/administracion/rubros/variedad/l_variedad.php', null,'Variedades.'],
									/*],
								],
							],
						],*/				
				
				],
				
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/folder_green.gif" />','Por moneda','http://'+dir+'/IPCuba/administracion/nomencladores/general/l_canasta.php', null,'Ponderaciones por rubros en CUP y CUC.',	
					
					
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/folder_inbox.gif" />','Insertar rubros por moneda','http://'+dir+'/IPCuba/administracion/base/llenar_niveles.php', null,'Insertar rubros por moneda.'],
					
					_cmSplit,
					
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/folder_green.gif" />','Divisiones','http://'+dir+'/IPCuba/administracion/base/division/l_bdivision.php', null,'Divisiones.'],
						['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/folder_green.gif" />','Grupos','http://'+dir+'/IPCuba/administracion/base/grupo/l_bgrupo.php', null,'Grupos.'],
							['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/folder_green.gif" />','Clases','http://'+dir+'/IPCuba/administracion/base/clase/l_bclase.php', null,'Clases.'],
								['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/folder_green.gif" />','Subclases','http://'+dir+'/IPCuba/administracion/base/subclase/l_bsubclase.php', null,'Subclases.'],
									['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/folder_green.gif" />','Art�culos','http://'+dir+'/IPCuba/administracion/base/articulo/l_barticulo.php', null,'Art�culos.'],
										['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/folder_green.gif" />','Variedades','http://'+dir+'/IPCuba/administracion/base/variedad/l_bvariedad.php', null,'Variedades.'],
									/*],
								],
							],
						],*/				
				
				],	
				],
				
			],
			
			_cmSplit,
					
			[null,'C�lculos',null,null,'C�lculos de imputaciones, relativos e �ndices',
				/*['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/db_comit.gif" />','Base',null,null,'C�lculos de datos de la base',
					['<img src="http://'+dir+'/IPCuba/imagenes/menu/add_section.png" />','Insertar Niveles Superiores','http://'+dir+'/IPCuba/administracion/base/llenar_niveles.php', null,'Insertar Niveles Superiores'],
					_cmSplit,
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/up.gif" />','Calcular Valor Base','http://'+dir+'/IPCuba/administracion/base/calculo_valor.php', null,'C�lculo de valores base'],
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/up.gif" />','Calcular Ponderaciones','http://'+dir+'/IPCuba/administracion/base/calculo_pond.php', null,'C�lculo de ponderaciones'],
				],
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/db_comit.gif" />','Nivel Provincial',null,null,'C�lculos de datos a nivel provincial',
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/up.gif" />','Calcular Datos','http://'+dir+'/IPCuba/cap_prov/editor/l_calculo_provincial.php', null,'C�lculo de datos a nivel provincial'],
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/up.gif" />','Recalcular Datos','http://'+dir+'/IPCuba/cap_prov/editor/l_recalculo_provincial.php', null,'Rec�lculo de datos a nivel provincial'],
				],
				
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/db_comit.gif" />','Nivel Nacional',null,null,'C�lculo de datos a nivel nacional',
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/up.gif" />','Calcular Datos','http://'+dir+'/IPCuba/cap_nac/editor/l_calculo_nacional.php', null,'C�lculo de datos a nivel nacional'],
					//['<img src="http://'+dir+'/IPCuba/imagenes/menu/edit.png" />','Recalcular Datos','http://'+dir+'/IPCuba/cap_nac/l_calculo_nacional.php', null,'Rec�lculo de datos a nivel nacional'],
				],
				
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/db_comit.gif" />','�ndices',null,null,'C�lculo del �ndice a nivel nacional',
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/up.gif" />','Calcular �ndices','http://'+dir+'/IPCuba/indices/calculo_indice_total.php', null,'C�lculo de �ndices.'],
					//['<img src="http://'+dir+'/IPCuba/imagenes/menu/edit.png" />','Recalcular Datos','http://'+dir+'/IPCuba/cap_nac/l_calculo_nacional.php', null,'Rec�lculo de �ndices.'],
				],*/
				
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/db_comit.gif" />','Validar datos','http://'+dir+'/IPCuba/indices/l_valida.php', null,'Validar la existencia de precios en todos los art�culos.'],
				
				_cmSplit,
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/db_comit.gif" />','Imputaci�n','http://'+dir+'/IPCuba/indices/imputacion/l_imputacion.php', null,'Imputaci�n de precios.',
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/db_comit.gif" />','Art�culos estacionales','http://'+dir+'/IPCuba/indices/imputacion/l_imp_estac.php', null,'Imputaci�n de precios para art�culos estacionales.'],
				
				],
				
				_cmSplit,
				
				
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/db_comit.gif" />','Eliminar �ltimo mes','http://'+dir+'/IPCuba/indices/l_elim.php', null,'Eliminar los datos del �ltimo c�lculo.'],
				
				_cmSplit,
				
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/db_comit.gif" />','C�lculo �ndices',null,null,'C�lculo de �ndices.',
				//----------------------------por mercado-------------------------
				 
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/db_comit.gif" />','Por Moneda','http://'+dir+'/IPCuba/indices/x_mer/l_calculo.php',null,'C�lculo de �ndices por moneda.', 
				 
				 
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/up.gif" />','Nivel de variedad en cada municipio','http://'+dir+'/IPCuba/indices/x_mer/l_var_x_dpa.php', null,'C�lculo de �ndices a nivel de variedad en cada municipio usando media geom�trica por moneda.'],
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/up.gif" />','Nivel de art�culo en cada municipio','http://'+dir+'/IPCuba/indices/x_mer/cal_indice_nivel_art_x_dpa_x_mer.php', null,'C�lculo de �ndices a nivel de art�culo en cada municipio usando media geom�trica por moneda.'],
					
					_cmSplit,
					
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/up.gif" />','Nivel de art�culo nacional','http://'+dir+'/IPCuba/indices/x_mer/cal_indice_nivel_art_x_mer.php', null,'C�lculo de �ndices a nivel de art�culo nacional usando media geom�trica por moneda.'],
					
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/up.gif" />','Niveles superiores','http://'+dir+'/IPCuba/indices/x_mer/cal_indice_nivel_sup_x_mer.php', null,'C�lculo de �ndices a niveles superiores nacional usando media aritm�tica ponderada por moneda.'],
					
					//_cmSplit,
					
				//	['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/up.gif" />','&Iacute;ndice general','http://'+dir+'/IPCuba/indices/x_mer/cal_indice_general_x_mer.php', null,'C�lculo del lndice general nacional usando media aritm�tica ponderada por mercado.'],
					//['<img src="http://'+dir+'/IPCuba/imagenes/menu/edit.png" />','Recalcular Datos','http://'+dir+'/IPCuba/cap_nac/l_calculo_nacional.php', null,'Rec�lculo de �ndices.'],
				],
				
				
			//----------------------------general-------------------------
				
				
				
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/db_comit.gif" />','General','http://'+dir+'/IPCuba/indices/general/l_calculo.php',null,'C�lculo de �ndices.', 
				 
				 
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/up.gif" />','Nivel de variedad en cada municipio','http://'+dir+'/IPCuba/indices/general/l_var_x_dpa.php', null,'C�lculo de �ndices a nivel de variedad en cada municipio usando media geom�trica.'],
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/up.gif" />','Nivel de art�culo en cada municipio','http://'+dir+'/IPCuba/indices/general/cal_indice_nivel_art_x_dpa.php', null,'C�lculo de �ndices a nivel de art�culo en cada municipio usando media geom�trica.'],
					
					_cmSplit,
					
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/up.gif" />','Nivel de art�culo nacional','http://'+dir+'/IPCuba/indices/general/cal_indice_nivel_art.php', null,'C�lculo de �ndices a nivel de art�culo nacional usando media aritm�tica simple.'],
					
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/up.gif" />','Niveles superiores','http://'+dir+'/IPCuba/indices/general/cal_indice_nivel_sup.php', null,'C�lculo de �ndices a niveles superiores nacional usando media aritm�tica ponderada.'],
					
					//_cmSplit,
					
					//['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/up.gif" />','&Iacute;ndice general','http://'+dir+'/IPCuba/indices/general/cal_indice_general.php', null,'C�lculo del lndice general nacional usando media aritm�tica ponderada.'],
					//['<img src="http://'+dir+'/IPCuba/imagenes/menu/edit.png" />','Recalcular Datos','http://'+dir+'/IPCuba/cap_nac/l_calculo_nacional.php', null,'Rec�lculo de �ndices.'],
				],
				
				//----------------------------general-------------------------
				
			],
				
				
				
		],
			_cmSplit,		
				
				[null,'Reportes',null,null,'Reportes',
				
		['<img src="http://'+dir+'/IPCuba/imagenes/menu/db.png" />','Lista de bienes y servicios','http://'+dir+'/IPCuba/administracion/nomencladores/general/l_bienes_x_moneda.php', null,'Lista de bienes y servicios.'],
				
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/windows_list.gif" />','Lista de bienes y servicios y ponderaciones','http://'+dir+'/IPCuba/administracion/nomencladores/general/l_pond.php', null,'Lista de bienes y servicios y ponderaciones.'],
				_cmSplit,
				//['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/package_programs.gif" />','Canasta B�sica','http://'+dir+'/IPCuba/administracion/nomencladores/general/canasta_basica.php', null,'Todos los nomencladores de canastas b�sicas'],
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/list.gif" />','Cat�logo de Productos','http://'+dir+'/IPCuba/administracion/nomencladores/general/catalogo.php', null,'Cat�logo de Productos'],
				_cmSplit,
				
				
				 ['<img src="http://'+dir+'/IPCuba/imagenes/menu/statistics.png" />','Estad�sticas sobre distribuci�n',null, null,'Estad�sticas sobre distribuci�n de variedades y establecimientos.',
				
				
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/file_temporary.gif" />','Cantidad de establecimientos por fecha','http://'+dir+'/IPCuba/administracion/base/var_estab/cant_estab_x_fecha.php', null,'Cantidad de establecimientos por fecha'],
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/package_applications.gif" />','Establecimientos por fecha','http://'+dir+'/IPCuba/administracion/base/var_estab/estab_x_fecha.php', null,'Establecimientos por fecha'],
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/agt_business.gif" />','Cantidad de precios por variedad','http://'+dir+'/IPCuba/administracion/base/var_estab/cant_precios_x_var.php', null,'Cantidad de precios por variedad'],
				
				['<img src="http://'+dir+'/IPCuba/imagenes/menu/content.png" />','Establecimientos por DPA','http://'+dir+'/IPCuba/administracion/nomencladores/estab/l_estab_asignados.php',null,'Establecimientos por DPA'],
				
				
				],
				['<img src="http://'+dir+'/IPCuba/imagenes/menu/statistics.png" />','Estad�sticas sobre la captaci�n',null, null,'Estad�sticas sobre la captaci�n sobre la captaci�n de precios.',
				
				
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/bell.gif" />','Faltas por variedad','http://'+dir+'/IPCuba/administracion/base/var_estab/l_faltas_x_var.php',null,'Faltas por variedad'],
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/bell.gif" />','Faltas por art�culo','http://'+dir+'/IPCuba/administracion/base/var_estab/l_faltas_x_art.php',null,'Faltas por art�culo'],
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/bell.gif" />','Faltas por art�culo por mercado','http://'+dir+'/IPCuba/administracion/base/var_estab/l_faltas_x_art_x_mer.php',null,'Faltas por art�culo por mercado.'],
				_cmSplit,
								
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/favorites.gif" />','Cumplimientos','http://'+dir+'/IPCuba/administracion/base/var_estab/l_inc_x_prov.php',null,'Cumplimientos'],
				
				
					],
				_cmSplit,
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/configure.gif" />','Comprobaci�n del c�lculo',null,null,'Comprobaci�n del c�lculo con el Excel.',
				
				['<img src="http://'+dir+'/IPCuba/imagenes/menu/document.png" />','�ndices sin encadenar de art�culo a nivel nacional por mercado','http://'+dir+'/IPCuba/indices/x_mer/l_art_x_mer.php', null,'�ndices sin encadenar de art�culo a nivel nacional por mercado.'],
				
				
				
				_cmSplit,
				['<img src="http://'+dir+'/IPCuba/imagenes/menu/document.png" />','�ndices de art�culo a nivel nacional por mercado','http://'+dir+'/IPCuba/indices/x_mer/comprobacion/indice_art_x_mer.php', null,'�ndices de art�culo a nivel nacional por mercado.'],
					
				['<img src="http://'+dir+'/IPCuba/imagenes/menu/document.png" />','�ndices generales a nivel nacional por mercado','http://'+dir+'/IPCuba/indices/x_mer/comprobacion/indice_general_x_mer.php', null,'�ndices generales a nivel nacional por mercado.'],
				_cmSplit,
				['<img src="http://'+dir+'/IPCuba/imagenes/menu/document.png" />','�ndices de art�culo a nivel nacional','http://'+dir+'/IPCuba/indices/general/comprobacion/indice_art.php', null,'�ndices de art�culo a nivel nacional por mercado.'],
				['<img src="http://'+dir+'/IPCuba/imagenes/menu/document.png" />','�ndices generales a nivel nacional','http://'+dir+'/IPCuba/indices/general/comprobacion/indice_general.php', null,'�ndices generales a nivel nacional.'],
				],
				
				
				
				
				
				_cmSplit,
				
				
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/3d.gif" />','�ndices, micro�ndices, variaciones e incidencias',null,null,'�ndices, micro�ndices, variaciones e incidencias por rubros y mercados.',
				 
					
			
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/folder_blue.gif" />','Por rubros',null, null,'�ndices, micro�ndices, variaciones e incidencias por rubros.',
				 
				 ['<img src="http://'+dir+'/IPCuba/imagenes/menu/document.png" />','Micro�ndices de variedad en cada municipio','http://'+dir+'/IPCuba/indices/general/listados/indice_var_dpa.php', null,'Micro�ndices a nivel de variedad en cada municipio.'],
				
				['<img src="http://'+dir+'/IPCuba/imagenes/menu/document.png" />','Micro�ndices de art�culo en cada municipio','http://'+dir+'/IPCuba/indices/general/listados/indice_art_dpa.php', null,'Micro�ndices a nivel de art�culo en cada municipio.'],
					
					_cmSplit,
					
					['<img src="http://'+dir+'/IPCuba/imagenes/menu/document.png" />','�ndices de art�culoa nivel nacional','http://'+dir+'/IPCuba/indices/general/listados/indice_art.php', null,'�ndices de art�culo a nivel nacional.'],
					
					['<img src="http://'+dir+'/IPCuba/imagenes/menu/document.png" />','�ndices, variaciones e incidencias a nivel nacional','http://'+dir+'/IPCuba/indices/general/listados/indice_general.php', null,'�ndices, variaciones e incidencias a nivel nacional.'],
					
				],
			
			
			
			
			
				 
				 ['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/folder_green.gif" />','Por moneda',null, null,'�ndices, micro�ndices, variaciones e incidencias por moneda.',
				 
				
				
				 ['<img src="http://'+dir+'/IPCuba/imagenes/menu/document.png" />','Micro�ndices de variedad en cada municipio por moneda','http://'+dir+'/IPCuba/indices/x_mer/listados/indice_var_dpa_x_mer.php', null,'Micro�ndices a nivel de variedad en cada municipio por moneda.'],
				
				['<img src="http://'+dir+'/IPCuba/imagenes/menu/document.png" />','Micro�ndices de art�culo en cada municipio por moneda','http://'+dir+'/IPCuba/indices/x_mer/listados/indice_art_dpa_x_mer.php', null,'Micro�ndices a nivel de art�culo en cada municipio por moneda.'],
					
					_cmSplit,
					
					['<img src="http://'+dir+'/IPCuba/imagenes/menu/document.png" />','�ndices de art�culo a nivel nacional por moneda','http://'+dir+'/IPCuba/indices/x_mer/listados/indice_art_x_mer.php', null,'�ndices de art�culo a nivel nacional por moneda.'],
					
					['<img src="http://'+dir+'/IPCuba/imagenes/menu/document.png" />','�ndices, variaciones e incidencias a nivel nacional por moneda','http://'+dir+'/IPCuba/indices/x_mer/listados/indice_general_x_mer.php', null,'�ndices, variaciones e incidencias a nivel nacional por moneda.'],
				],
				
				
				
				
				
				
			],	
				
				['<img src="http://'+dir+'/IPCuba/imagenes/menu/globe1.png" />','Gr�ficos',null,null,'Gr�ficos de series de precios, �ndices, micro�ndices, variaciones, etc.',
				
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/cookie.gif" />','Ponderaciones de divisi�n por rubro','http://'+dir+'/IPCuba/graficas/pag/g_pond.php', null,'Ponderaciones de divisi�n por rubro.'],
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/cookie.gif" />','Ponderaciones de divisi�n en CUP','http://'+dir+'/IPCuba/graficas/pag/g_pond_cup.php', null,'Ponderaciones de divisi�n en CUP.'],
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/cookie.gif" />','Ponderaciones de divisi�n en CUC','http://'+dir+'/IPCuba/graficas/pag/g_pond_cuc.php', null,'Ponderaciones de divisi�n en CUC.'],
				_cmSplit,
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/oscilloscope.gif" />','Serie de precios por variedad','http://'+dir+'/IPCuba/graficas/pag/l_precios_x_var.php', null,'Micro�ndices a nivel de variedad en cada municipio por moneda.'],
				_cmSplit,
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/oscilloscope.gif" />','Serie del �ndice de Precios al Consumidor','http://'+dir+'/IPCuba/graficas/pag/l_serie_ipc.php', null,'Serie del �ndice de Precios al Consumidor.'],
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/oscilloscope.gif" />','Variaci�n mensual y acumulada en un a�o','http://'+dir+'/IPCuba/graficas/pag/l_var_men_acum.php', null,'Variaci�n mensual y acumulada en un a�o.'],
				
				
			
				
				 ],
				
				
		 	
				
			/*	
				['<img src="http://'+dir+'/IPCuba/imagenes/menu/document.png" />','�ndices y variaciones',null,null,'�ndices y variaciones por rubros y mercados.',
				 ['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/folder_blue.gif" />','Por rubros','http://'+dir+'/IPCuba/indices/general/listados/indice_general.php', null,'�ndices y variaciones por rubros.'],
				 
				 
				 ['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/folder_green.gif" />','Por mercados','http://'+dir+'/IPCuba/indices/general/listados/indice_general_x_mer.php', null,'�ndices y variaciones por mercados.']
				 
				 
				 ],
				_cmSplit,
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/folder_green.gif" />','Historial',null,null,'Historial',
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/folder_red.gif" />','Productos Base','http://'+dir+'/IPCuba/administracion/base/l_bproducto_historial.php', null,'Historial de productos de a�os bases'],
					_cmSplit,
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/folder_blank.gif" />','Nivel Municipal','http://'+dir+'/IPCuba/captaciones/autor/l_datos_historial.php', null,'Historial a Nivel Municipal'],
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/folder_blue.gif" />','Nivel Provincial','http://'+dir+'/IPCuba/cap_prov/l_datos_historial.php', null,'Historial a Nivel Provincial'],
					['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/folder_grey.gif" />','Nivel Nacional','http://'+dir+'/IPCuba/cap_nac/l_datos_historial.php', null,'Historial a Nivel Nacional'],


				],*/
				],
				_cmSplit,
				
			[null,'Servicios',null,null,'Servicios',
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/exit.gif" />','Cerrar Sesi�n','http://'+dir+'/IPCuba/php/logout.php',null,'Salir del Sistema'],
				
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/password.gif" />','Cambiar Contrase�a','http://'+dir+'/IPCuba/seguridad/cambiar_clave.php',null,'Cambiar Contrase�a'],
				
                ['<img src="http://'+dir+'/IPCuba/imagenes/menu/restore.png" />','Ejecutar Consulta','http://'+dir+'/IPCuba/administracion/config/execute.php',null,'Ejecutar Consulta'],				
			],
			_cmSplit,
			
			[null,'Ayuda',null,null,'Ayuda',
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/help.gif" />','Acerca de IPCuba','http://'+dir+'/IPCuba/help/acerca.htm',null,'Acerca de IPCuba'],
				
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/info.gif" />','Informaci�n','http://'+dir+'/IPCuba/help/informacion.htm',null,'Informaci�n'],
				
                ['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/fileimport.gif" />','Documentaci�n','http://'+dir+'/IPCuba/help/manuales.htm',null,'Documentaci�n'],				
			],
		
				
		
		];
		cmDraw ('myMenuID', myMenu, 'hbr', cmThemeOffice, 'ThemeOffice');