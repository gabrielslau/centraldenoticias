<?php
	$pageTitle = (isset($title_for_layout) && !empty($title_for_layout)) ? $title_for_layout.' : '.NAMESITE : NAMESITE;

	echo $this->Html->charset();
	echo '<title>'.$pageTitle.'</title>';
	echo $this->Html->meta('icon');
	
	// <!-- Apple iOS and Android stuff (do not remove) -->
	echo '
	<meta name="apple-mobile-web-app-capable" content="no" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />

	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no,maximum-scale=1" />';

	// Required Stylesheets
	$estilos = isset($estilos) ? $estilos : array(
		'admin/reset',
		'admin/text',
		'admin/fluid', 

		'admin/core/core',
		'admin/core/panels',
		'admin/core/table',
		'admin/core/misc',
		'admin/core/responsive',

		'admin/icons/24x24',
		'admin/jui/jquery.ui',

		'admin/mws.theme'  // Theme Stylesheet
	);

	if(isset($css_for_layout) && !empty($css_for_layout)){
		$estilos = array_merge($estilos,$css_for_layout); // Carrega os estilos específicos de cada página
	}
	//Carrega estilos para correções no IE
	// $browser = explode(' ',css_browser_selector());
	// if(in_array('ie',$browser)){
	// 	// $estilos[] = 'fix_ie';
	// 	//<!-- Shim to make HTML5 elements usable in older Internet Explorer versions -->
	// 	echo '<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>';
	// 	// echo '<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->';
	// }

	/*if(count($estilos)>15){
		$estilos = array_chunk($estilos, 15); // Separa os estilos em "pacotes" de 15 em 15
		foreach($estilos as $estilo):
			echo $this->Minify->css($estilo);
		endforeach;
	}else echo $this->Minify->css($estilos);*/

	foreach($estilos as $e=>$estilo) $estilos[$e] = $estilo.'.css';
	echo $this->Html->css($estilos);
	
	/*$this->AssetCompress->addCss($estilos);
	echo $this->AssetCompress->includeCss();*/
	
	if(isset($cssExternal_for_layout) && !empty($cssExternal_for_layout)){
		echo $this->Html->css($cssExternal_for_layout); // Carrega os estilos externos
	}

	echo $this->fetch('meta');
	echo $this->fetch('css');
?> 