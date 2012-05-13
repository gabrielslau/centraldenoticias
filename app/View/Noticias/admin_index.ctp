<div class="mws-panel grid_8 noticias index">
	<div class="mws-panel-header">
    	<span class="mws-i-24 i-table-1"><?php echo $title_for_layout;?></span>
    </div>
    <div class="mws-panel-body">

    	<div class="mws-panel-toolbar top clearfix">
        	<ul>
        	<?php
        		echo $this->Html->tag('li', $this->Html->link(__('Adicionar nova notícia', true), array('action' => 'add'),array('class'=>'mws-button blue')));

        		echo $this->Html->tag('li', $this->Html->link(__('Adicionar nova categoria', true), array('controller'=>'categorias', 'action' => 'add'),array('class'=>'mws-button gray')));
        		
        		echo $this->Html->tag('li', $this->Html->link(__('Adicionar nova tag', true), array('controller'=>'tags', 'action' => 'add'),array('class'=>'mws-button gray')));

        		echo $this->Html->tag('li', $this->Html->link(__('Ver todas as categorias', true), array('controller'=>'categorias', 'action' => 'index'),array('class'=>'mws-button gray')));
        	?>
            </ul>
        </div>

		<div class="dataTables_wrapper">
			<?php 
				if(empty($noticias)):
					echo '<div class="mws-message info">Nenhuma notícia foi adicionada ainda. '.$this->Html->link(__('Que tal adicionar uma agora?', true), array('action' => 'add'),array('class'=>'mws-button blue')).'	</div>';
				else:
			?>
				<table class="mws-datatable mws-table">
					<thead>
						<tr class="thead column-thumbnail">
							<th class="allcenter"><?php echo $this->Html->image('/css/admin/icons/32/slideshow.png',array('width'=>32,'height'=>32,'alt'=>'icon')) ?></th>
							<th class="sorting"><?php echo $this->Paginator->sort('titulo','Título');?></th>
							<th>Resumo</th>
							<th class="column-tags">Categoria</th>
							<th class="sorting allcenter column-actions"><?php 
								echo html_entity_decode($this->Paginator->sort('created',$this->Html->image('/css/admin/icons/32/calendar.png',array('width'=>32,'height'=>32,'alt'=>'Data')) )); 
							?></th>
							<!-- <th>&nbsp;</th> -->
						</tr>
					</thead><!-- cabeçalho -->
					<tbody>
					<?php
					$i = 0;
					foreach ($noticias as $noticia):
						$class = (++$i % 2 == 0) ? ' class="gradeA odd"' : ' class="gradeA even"';
					?>
					<tr <?php echo $class;?>>
						<td class="capa allcenter column-thumbnail">
						<?php
							$x = $y = 50;
							if( !empty($noticia['Noticia']['imagem']) ){
								$imgSrc = $this->Thumbnail->render($noticia['Noticia']['imagem'], array(
					                    'path' => 'image/noticia/'.$noticia['Noticia']['codigo'],
					                    'absoluteCachePath' => WWW_ROOT . 'files',
					                    'cachePath' => 'files/cache',
					                    'newWidth' => $x,
					                    'newHeight' => $y,
					                    'resizeOption' => 'crop'
				                    )
				                );
							}else{
								$imgSrc = $this->Thumbnail->render('preview.jpg', array(
					                    'path' => 'img',
					                    'cachePath' => 'files/cache',
					                    'newWidth' => $x,
					                    'newHeight' => $y,
					                    'resizeOption' => 'crop'
					                )
					            );	
							}
							echo $this->Html->image($imgSrc, array('alt'=>$noticia['Noticia']['codigo']) );
						?>
						</td>
						<td class="name column-title">
							<?php 
								echo '<strong>'.$this->Html->link( $noticia['Noticia']['titulo'], array('action' => 'admin_edit', $noticia['Noticia']['id']) ).'</strong>';

								if($noticia['Noticia']['destaque']) echo ' <span class="hg-yellow">destaque</span> ';
								if(!$noticia['Noticia']['status']) echo ' <span class="hg-gray">rascunho</span> ';
							?>
						</td>
						<td><?php
							App::uses('String', 'Utility');

							$texto = !empty($noticia['Noticia']['chamada']) ? $noticia['Noticia']['chamada'] : $noticia['Noticia']['conteudo'];

							echo String::truncate(
							    $texto,
							    27,
							    array(
							        'ending' => '...',
							        'exact' => false
							    )
							);
						?></td>
						<td class="column-tags">
						<?php
							foreach ($noticia['Categoria'] as $categoria) {
								echo ' <span class="hg-green">'.utf8_decode(utf8_decode($categoria['nome'])).'</span>';
							}
						?>
						</td>
						<td class="column-actions">
							<div class="date" style="padding:10px;text-align:center">
							<?php
								App::uses('CakeTime', 'Utility');
								list($dia, $mes,$ano) = explode(' ', CakeTime::format('d F Y', $noticia['Noticia']['created']));

								echo $dia. ' de '. __($mes) .' de '.$ano;
							?>
							</div>
							<div class="row-actions">
								<?php 
									echo $this->Html->link(__('Ver'), array('action' => 'view', $noticia['Noticia']['id'],'admin'=>false),array('class'=>'mws-button gray small'));
									echo $this->Html->link(__('Editar'), array('action' => 'edit', $noticia['Noticia']['id']),array('class'=>'mws-button gray small'));

									echo $this->Form->postLink(__('Excluir'), array('action' => 'delete', $noticia['Noticia']['id'],'admin'=>true), array('id'=>'del-'.$noticia['Noticia']['id'],'class'=>'submitdelete  mws-button red small'), __('Are you sure you want to delete # %s?', $noticia['Noticia']['id']));
								?>
							</div>
						</td>
					</tr>
					<?php endforeach; ?>
					</tbody><!-- conteudo -->
				</table>
				<div class="dataTables_info">
					<?php 
						echo $this->Paginator->counter(array('format' => __('Exibindo {:start} - {:end} de aproximadamente {:count}', true)))
					?>
				</div>
				<?php 
					echo $this->element('admin/pagination/navigate');
				?>
			<?php endif;?>
		</div>
    </div>
</div>