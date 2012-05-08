<div class="mws-panel grid_8 categorias index">
	<div class="mws-panel-header">
    	<span class="mws-i-24 i-list"><?php echo $title_for_layout;?></span>
    </div>
    <div class="mws-panel-body">

    	<div class="mws-panel-toolbar top clearfix">
        	<ul>
        	<?php
        		echo $this->Html->tag('li', $this->Html->link(__('Adicionar nova categoria', true), array('action' => 'add'), array('class'=>'mws-button blue')));

        		echo $this->Html->tag('li', $this->Html->link(__('Ver todas as notícias', true), array('controller'=>'noticias', 'action' => 'index'),array('class'=>'mws-button gray')));
        	?>
            </ul>
        </div>

		<div class="dataTables_wrapper">
			<?php 
				if(empty($categorias)):
					echo '<div class="mws-message info">Nenhuma categoria foi adicionada ainda. '.$this->Html->link(__('Que tal adicionar uma agora?', true), array('action' => 'add'),array('class'=>'mws-button blue')).'	</div>';
				else:
			?>
				<table class="mws-datatable mws-table">
					<thead>
						<tr class="thead column-thumbnail">
							<!-- <th class="column-thumbnail">Código</th> -->
							<th class="sorting column-title"><?php echo $this->Paginator->sort('nome');?></th>
							<th class="column-thumbnail">Notícias</th>
							<th class="sorting allcenter column-actions"><?php 
								echo html_entity_decode($this->Paginator->sort('created',$this->Html->image('/css/admin/icons/32/calendar.png',array('width'=>32,'height'=>32,'alt'=>'Data')) )); 
							?></th>
							<!-- <th>&nbsp;</th> -->
						</tr>
					</thead><!-- cabeçalho -->
					<tbody>
					<?php
					$i = 0;
					foreach ($categorias as $categoria):
						$class = (++$i % 2 == 0) ? ' class="gradeA odd"' : ' class="gradeA even"';
					?>
					<tr <?php echo $class;?>>
						<!-- <td class="column-thumbnail"> -->
						<?php 
							// echo $categoria['Categoria']['codigo'];
						?>
						<!-- </td> -->
						<td class="column-title">
						<?php 
							echo '<strong>'.$this->Html->link( $categoria['Categoria']['nome'], array('action' => 'admin_edit', $categoria['Categoria']['id']) ).'</strong>';
						?>
						</td>

						<td class="column-thumbnail">
						<?php 
							echo $categoria['Categoria']['noticia_count'];
						?>
						</td>

						<td class="column-actions">
							<div class="row-actions">
								<?php
									echo $this->Html->link(__('Editar'), array('action' => 'edit', $categoria['Categoria']['id']),array('class'=>'mws-button gray small'));

									echo $this->Form->postLink(__('Excluir'), array('action' => 'admin_delete', $categoria['Categoria']['id'],'admin'=>true), array('id'=>'del-'.$categoria['Categoria']['id'],'class'=>'submitdelete  mws-button red small'), __('Are you sure you want to delete # %s?', $categoria['Categoria']['nome']));
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