var dir=document.domain;//alert(dir);
var _cmSplit;
		var myMenu =
		[
					[null,'Inicio','http://'+dir+'/IPCuba/seguridad/autenticacion.php',null,'IPCuba'],
			_cmSplit,
			
				
			/*	
				[null,'Reportes',null,null,'Reportes',
				
		['<img src="http://'+dir+'/IPCuba/imagenes/menu/db.png" />','Lista de bienes y servicios','http://'+dir+'/IPCuba/administracion/nomencladores/general/l_bienes_x_moneda.php', null,'Lista de bienes y servicios'],
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/package_programs.gif" />','Canasta B�sica','http://'+dir+'/IPCuba/administracion/nomencladores/general/canasta_basica.php', null,'Todos los nomencladores de canastas b�sicas'],
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/list.gif" />','Cat�logo de Productos','http://'+dir+'/IPCuba/administracion/nomencladores/general/catalogo.php', null,'Cat�logo de Productos'],
				_cmSplit,
				['<img src="http://'+dir+'/IPCuba/imagenes/menu/content.png" />','Establecimientos por DPA','http://'+dir+'/IPCuba/administracion/nomencladores/estab/l_estab_asignados.php',null,'Establecimientos por DPA'],
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
				_cmSplit,*/
				
			[null,'Servicios',null,null,'Servicios',
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/exit.gif" />','Cerrar Sesi�n','http://'+dir+'/IPCuba/php/logout.php',null,'Salir del Sistema'],
				
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/password.gif" />','Cambiar Contrase�a','http://'+dir+'/IPCuba/seguridad/cambiar_clave.php',null,'Cambiar Contrase�a'],
				
			],
			_cmSplit,
			
			
		
				[null,'Ayuda','index2.php?option=com_admin&task=help',null,null,
				['<img src="http://'+dir+'/IPCuba/imagenes/extrasmall/info.gif" />','Acerca de IPCuba','http://'+dir+'/IPCuba/help/acerca.htm',null,'Acerca de IPCuba'],
				],
		
		];
		cmDraw ('myMenuID', myMenu, 'hbr', cmThemeOffice, 'ThemeOffice');