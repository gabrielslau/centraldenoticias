<div class="mws-panel grid_3">
	<div class="mws-panel-header">
    	<span class="mws-i-24 i-home-2">Seja bem vindo</span>
    </div>
    <div class="mws-panel-body">
    	<div class="mws-panel-content">Utilize o menu ao lado para escolher a operação</div>
    </div>
</div>

<div class="mws-panel grid_3">
    <div class="mws-panel-header">
        <span class="mws-i-24 i-graph">Resumo do sistema</span>
    </div>
    <div class="mws-panel-body">
        <ul class="mws-summary">
        <?php
            echo '<li><span>'.$countItens['Noticia'].'</span> '.$this->Html->link( 'Noticias' , array('controller'=>'noticias','action' => 'index','admin'=>true)).' cadastradas</li>';
            echo '<li><span>'.$countItens['Categoria'].'</span> '.$this->Html->link( 'Categorias' , array('controller'=>'categorias','action' => 'index','admin'=>true)).' cadastradas</li>';
            echo '<li><span>'.$countItens['Tag'].'</span> '.$this->Html->link( 'Tags' , array('controller'=>'tags','action' => 'index','admin'=>true)).' cadastradas</li>';
        ?>
        </ul>
    </div>
</div>