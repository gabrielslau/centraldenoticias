<div class="noticias view article">
<?php
	/*
	** Exibição da notícia
	*/
	echo '<div class="PageTitle">
			<h1>'.$noticia['Noticia']['titulo'].'</h1>
			<h2>'.strip_tags($noticia['Noticia']['chamada']).'</h2>
		</div><!-- end .PageTitle -->';

	echo '<p class="PageDate">Escrito em <span>'.getDay($noticia['Noticia']['created']). ' de ' .getMesExt(getMonth($noticia['Noticia']['created'])). ' de ' . getYear($noticia['Noticia']['created']).'</span> em '.utf8_decode($noticia['Noticiascategoria']['titulo']).'</p><!-- end .article-data -->';
	
	echo $this->element('estrutura/compartilhamento'); //AddThis
	

	//IMAGEM DE CAPA
	if( !empty($noticia['Noticia']['imagem']) ){
		$x=605;$y=320;$imgSrc = '';
		$imgSrc = $this->Thumbnail->render($noticia['Noticia']['imagem'], array(
                'path' => 'files'.DS.'image'.DS.'noticia'.DS.$noticia['Noticia']['codigo'],
	            'cachePath' => 'files'.DS.'cache',
                'newWidth' => $x,
                'newHeight' => $y,
                'resizeOption' => 'crop',
                'quality' => '100'
            )
        );

		echo '<div class="PageImage foto"><span class="canto-ce"></span><span class="canto-cd"></span><span class="canto-re"></span><span class="canto-rd"></span>'.$this->Html->image($imgSrc, array('alt'=>$noticia['Noticia']['titulo'], 'width'=>$x, 'height'=>$y)).'</div><!-- end .article-image -->';
	}
	

	// CONTEUDO
	echo '<div class="PageContent">'.$noticia['Noticia']['conteudo'].'</div><!-- end .article-content -->';


	// NOTICIAS RELACIONADAS
	if(isset($noticiasrelacionadas) && !empty($noticiasrelacionadas) ){
		echo '<div id="RelatedPages" class="widget noticia-preview">'.
			html_entity_decode($this->Html->tag('h4',$this->Html->tag('span', $this->Html->link('Notícias relacionadas', array('controller'=>'noticias','action'=>'index',$noticia['Noticiascategoria']['slug']) )))).

			$this->element('noticia/noticia_showcase',array('noticias'=>$noticiasrelacionadas)).
		'<div class="fix"></div></div><!-- end .noticias-relacionadas -->';
	}

	// NEIGHBORS
	if(isset($neighbors['prev']) && !empty($neighbors['prev'])){
		echo '<div class="neighbors" id="containerLeftArrow">',
			'<div class="content" id="containerContentLeftArrow"><p><strong>Anterior</strong></p>',
			html_entity_decode($this->Html->tag('p', $this->Html->link($neighbors['prev']['Noticia']['titulo'], array('controller'=>'noticias','action'=>'view',$neighbors['prev']['Noticia']['id']) ))),
			'</div></div>';
	}//end neighbors prev

	if(isset($neighbors['next']) && !empty($neighbors['next'])){
		echo '<div class="neighbors" id="containerRightArrow">',
			'<div class="content" id="containerContentRightArrow"><p><strong>Próxima</strong></p>',
			html_entity_decode($this->Html->tag('p', $this->Html->link($neighbors['next']['Noticia']['titulo'], array('controller'=>'noticias','action'=>'view',$neighbors['next']['Noticia']['id']) ))),
			'</div></div>';
	}//end neighbors next
?>
</div><!-- end .noticias .view .article -->