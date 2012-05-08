<?php
    $this->set('documentData', array('xmlns:dc' => 'http://purl.org/dc/elements/1.1/'));

    $this->set('channelData', array(
        'title'       => __(NAMESITE),
        'link'        => $this->Html->url('/', true),
        'description' => __("Últimas notícias"),
        'language'    => '´pt-br')
    );

    App::uses('Sanitize', 'Utility');

    $x=300;$y=200;
	foreach ($noticias as $noticia) {

        // print_r($noticia);exit();

        $noticiaLink = array('controller' => 'noticias','action' => 'view',$noticia['Noticia']['id'].'/'.slug($noticia['Noticia']['titulo']));

        // This is the part where we clean the body text for output as the description 
        // of the rss item, this needs to have only text to make sure the feed validates
        // $bodyText = $noticia['Noticia']['conteudo'];
        $bodyText = preg_replace('=\(.*?\)=is', '', $noticia['Noticia']['conteudo']);
        $bodyText = $this->Text->stripLinks($bodyText);
        $bodyText = Sanitize::stripAll($bodyText);
        $bodyText = $this->Text->truncate($bodyText, 400,array('ending' => '...','exact' => false,'html'=>false));
    
        
        $imgSrc = !empty($noticia['Noticia']['imagem']) ? $this->Thumbnail->render($noticia['Noticia']['imagem'], array(
                'path' => 'files'.DS.'image'.DS.'noticia'.DS.$noticia['Noticia']['codigo'],
                'cachePath' => 'files'.DS.'cache',
                'newWidth' => $x,
                'newHeight' => $y,
                'resizeOption' => 'crop'
            )
        ) : $this->Html->url('/', true).'img/preview.jpg' ;

        echo  $this->Rss->item(array(), array(
            'title' => $noticia['Noticia']['titulo'],
            'link' => $noticiaLink,
            'guid' => array('url' => $noticiaLink, 'isPermaLink' => 'true'),
            //'description' =>  '<![CDATA['.$bodyText.']]>',
			'description' =>  '<p>'.$this->Html->image($imgSrc, array('alt'=>$noticia['Noticia']['titulo'], 'width'=>$x, 'height'=>$y)).'</p>'.$bodyText,
            // 'dc:creator' => NAMESITE,
            'pubDate' => $noticia['Noticia']['created']));

        // exit;
    }//end foreach