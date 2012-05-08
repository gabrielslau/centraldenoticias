<div class="users form">
<?php 
	echo '<h1>Área restrita</h1>'; 
	echo '<div class="mws-login-lock">'.$this->Html->image('/css/admin/icons/24/locked-2.png').'</div>';

	echo '<div id="mws-login-form">';
		echo $this->Form->create('User' , array('url' => array('controller' => 'users','action' =>'login','admin'=>true), 'id'=>'form-login', 'class'=>'mws-form'));

		echo $this->Form->input('username', array( 'label' => false, 'div'=>array('class'=>'mws-form-row'), 'placeholder'=>'Nome de usuário', 'class'=>'mws-login-username mws-textinput required','before'=>'<div class="mws-form-item large">','after'=>'</div>' ));
		echo $this->Form->input('password',array('type'=>'password','div'=>array('class'=>'mws-form-row'),'label' => false, 'placeholder'=>'Senha de acesso', 'class'=>'mws-login-password mws-textinput required','before'=>'<div class="mws-form-item large">','after'=>'</div>'));
		
		// echo $this->Form->input('remember_me', array('type' => 'checkbox','label' => 'Remember Me','div'=>array('class'=>'mws-form-row mws-inset') ));

		$options = array(
			'label' => 'Acessar',
			'class'=>'mws-button blue mws-login-button',
			'div' => array(
				'class' => 'mws-form-row',
			)
		);
		echo $this->Form->end($options);
	echo '</div>';
?>
<div class="fix"></div>
<?php
	/*$salt = Configure::read('Security.salt');
	$minhasenha = 'admin';
	echo sha1($salt.$minhasenha);
	*/
	// echo '<br>'.Security::hash('admin', 'sha1', true);
	
	echo $this->Session->flash();
	echo $this->Session->flash('auth'); // Exibimos qualquer erro que possa ter ocorrido
?>
</div>