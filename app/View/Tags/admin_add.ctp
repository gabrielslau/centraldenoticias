<?php echo $this->Form->create('Tag', array('class'=>'mws-form', 'id'=>'form_contentpost')) ?>
	<div class="mws-panel grid_8 tags form">
		<div class="mws-panel-header">
	    	<span class="mws-i-24 i-list"><?php echo $title_for_layout?></span>
	    </div>
	    <div class="mws-panel-body">
			<div class="mws-form-inline">
			<?php
				if($this->action == 'edit') {
					echo $this->Form->hidden('id', array('value'=>$this->Form->value('Tag.id')));
					echo $this->Form->hidden('slug', array('value'=>$this->Form->value('Tag.slug')));
				}

				echo $this->Form->input('nome', array('type'=>'text', 'label' => array('text'=>'Nome *'), 'div'=>array('class'=>'mws-form-row'), 'between'=>'<div class="mws-form-item small">', 'after'=>'</div>', 'class'=>'mws-textinput', 'value'=> $this->Form->value('Tag.nome') ));

				/*if(isset($invalidFields['slug'])){
					echo '<div class="error-message">'.$invalidFields['slug'][0].'</div>';
				}*/
			?>


			<div class="mws-form-row notice">Todos os campos marcados com <span style="color:red">*</span> são de preenchimento obrigatório.</div>

    		</div>
    		<div class="mws-button-row">
    		<?php
				echo $this->Html->link(__('Cancelar', true), array('action' => 'index'),array('class'=>'mws-button gray small fl'));

				echo $this->action == 'admin_edit' ? $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Tag.id')), array('id'=>'del-'.$this->Form->value('Tag.id'),'class'=>'mws-button red small fl '), __('Tem certeza que deseja excluir a Tag # %s?', $this->Form->value('Tag.id'))) : '';

				echo $this->action == 'admin_add' ? '<input type="submit" value="Cadastrar" class="mws-button blue" />' : '<input type="submit" value="Atualizar" class="mws-button blue" />';
    		?>
    		</div>
    </div>    	
</div>
<?php echo $this->Form->end();?>