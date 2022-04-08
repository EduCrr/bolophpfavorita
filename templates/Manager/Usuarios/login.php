<div class="login-container">
	<div class="login-box animated fadeInDown">
		<h1 class="login-logo">Dell Anno | Manager</h1>
		<div class="login-body">
			<h2 class="login-title"><strong>Administrador</strong>! Autentique-se.</h2>
			<?php echo $this->Form->create(null, ['class' => 'form-horizontal no-ajax', 'novalidate' => true, 'templates' => ['inputContainer' => '{{content}}']]); ?>
				<div class="form-group">
					<div class="col-md-12">
						<?php echo $this->Form->control('email', ['type' => 'text', 'div' => false, 'label' => false, 'placeholder' => 'E-mail', 'class' => 'form-control', 'autocomplete' => 'off']); ?>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-12">
						<?php echo $this->Form->input('senha', ['type' => 'password', 'div' => false, 'label' => false, 'placeholder' => 'Senha', 'class' => 'form-control']); ?>
					</div>
				</div>

				<div class="col-md-12">
					<?php echo $this->Flash->render(); ?>
				</div>

				<div class="form-group">
					<div class="col-md-6">
						<?php echo $this->Html->link('<i class="fa fa-arrow-left"></i> Ir para o site', ['controller' => 'home', 'action' => 'index', 'Manager' => false], ['escape' => false, 'class' => 'btn btn-link text-left']); ?>
					</div>
					<div class="col-md-6">
						<?php echo $this->Form->button('<i class="fa fa-sign-in"></i> Login', ['escapeTitle' => false, 'div' => false, 'class' => 'btn btn-info btn-block']); ?>
					</div>
				</div>
			<?php echo $this->Form->end(); ?>
		</div>
		<div class="login-footer">
			<div class="pull-left">
				<small>
					&copy; 2022 8poroito.<br>
					Desenvolvido por <?php echo $this->Html->link('8poroito', 'http://www.8poroito.com.br', array('target' => '_blank')); ?>.
				</small>
			</div>
		</div>
	</div>
</div>