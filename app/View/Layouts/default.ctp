<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->element('admin/estrutura/head');?>
</head>
<body>
	<?php echo $this->element('admin/estrutura/header',array('cache' => array('time' => '+1 year'))); ?>

	<!-- Start Main Wrapper -->
    <div id="mws-wrapper">
    	<?php echo $this->element('admin/estrutura/sidebar',array('cache' => array('time' => '+1 year')));?>
    	
        <!-- Main Container Start -->
        <div id="mws-container" class="clearfix">
        	<!-- Inner Container Start -->
            <div class="container">
            	<?php
					// echo $this->Form->hidden('ABS_PATH', array('value'=>getFullBaseUrl()));
					echo $this->Form->hidden('webroot', array('value'=>$this->webroot));
					
					// echo $this->element('alert_messages');

					echo $this->fetch('content'); // CONTEÚDO INDIVIDUAL DAS PÁGINAS FICAM AQUI
				?>
            </div>
            <!-- Inner Container End -->
        </div>
        <!-- Main Container End -->
    </div><!-- Main Wrapper End -->


	<?php
		$js_for_layout         = isset($js_for_layout) 			? $js_for_layout 		: array();
		$asset_js_for_layout   = isset($asset_js_for_layout) 	? $asset_js_for_layout 	: array();
		$jsExternal_for_layout = isset($jsExternal_for_layout) 	? $jsExternal_for_layout: array();
		
		echo $this->element('admin/estrutura/scripts',array('js_for_layout'=>$js_for_layout,'jsExternal_for_layout'=>$jsExternal_for_layout,'asset_js_for_layout'=>$asset_js_for_layout));
	?>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>