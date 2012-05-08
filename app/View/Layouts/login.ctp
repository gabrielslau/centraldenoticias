<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->element('admin/estrutura/head',array('estilos'=>array(
		'admin/reset',
		'admin/text',
		'admin/fonts/ptsans/stylesheet',
		'admin/core/form',
		'admin/core/login',
		'admin/core/button',
		'admin/mws.theme'  // Theme Stylesheet
	)));?>
</head>

<body>
	<div id="mws-login-wrapper">
        <div id="mws-login">
        	<?php
				// echo $this->Form->hidden('ABS_PATH', array('value'=>getFullBaseUrl()));
				// echo $this->Form->hidden('webroot', array('value'=>$this->webroot));
				echo $this->fetch('content'); // CONTEÚDO INDIVIDUAL DAS PÁGINAS FICAM AQUI
			?>
		</div>
	</div>
<?php
	$js_for_layout = isset($js_for_layout) ? $js_for_layout : array();
	$jsExternal_for_layout = isset($jsExternal_for_layout) ? $jsExternal_for_layout : array();
	echo $this->element('admin/estrutura/scripts',array('js_for_layout'=>$js_for_layout,'jsExternal_for_layout'=>$jsExternal_for_layout,'scripts'=>array(
		'jquery-1.7.2.min',
		//Plugin Scripts
		'plugins/placeholder/jquery.placeholder-min'

		// 'admin/login' // Core script
	)));

	echo $this->fetch('js');
	// echo $this->Js->writeBuffer(); // Write cached scripts
	echo $this->element('sql_dump');
?>
</body>
</html>