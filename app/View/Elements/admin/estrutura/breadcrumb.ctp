<?php
	if( isset($breadcrumb) ){ 
		//print_r($breadcrumb);exit;
		
		$this->Html->addCrumb('Página inicial', '/', array('class'=>"index", 'title'=>"Voltar ao início"));

		foreach($breadcrumb as $l=>$link){
			if( !empty($link) ) $this->Html->addCrumb( ucfirst($l), $link);
			else html_entity_decode($this->Html->addCrumb( $this->Html->tag('span',ucfirst($l))));

			
		}//end foreach
		echo '<div id="breadcrumb">'.$this->Html->getCrumbs('').'</div>';
	}	
?>