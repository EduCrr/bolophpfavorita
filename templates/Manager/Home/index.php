<!-- START BREADCRUMB -->
<ul class="breadcrumb">
	<li>Home</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
	<h2><span class="fa fa-home"></span> Home</h2>

</div>
<!-- END PAGE TITLE -->

<!-- PAGE CONTENT WRAPPER -->
<div /* class="page-content-wrap">
	<?php echo $this->element('page_settings', [
		'pagina' => $pagina,
	]); ?>

	<div class="row">
		<div class="col-md-12">
			<?php echo $this->Flash->render(); ?>
			
			<div class="panel panel-default">
				<div class="panel-heading clearfix">
					<div class="panel-title-box">
						<h3>Slides</h3>
					</div>
					<?php echo $this->Html->link('<span class="fa fa-plus"></span> Novo slide', ['controller' => 'slides', 'action' => 'adicionar'], ['escape' => false, 'class' => 'btn btn-primary pull-right']); ?>
				</div>
				<div class="panel-body padding-bottom-0">
					<div class="row">
						<?php if ($slides->count()) { ?>
							<div class="ordenable" data-action="<?php echo $this->Url->build(['controller' => 'slides', 'action' => 'ordenar']) ?>">
								<?php foreach ($slides as $key => $value) { ?>
									
									<div class="col-md-3 col-lg-3 col-sm-6 col-xs-12 push-down-20" id="odr_<?php echo $value->id; ?>">
										<div class="panel panel-primary push-down-0">
											<div class="panel-heading">
												<?php echo $this->Form->create($value, ['url' => ['controller' => 'slides', 'action' => 'visibilidade', $value->id], 'class' => 'pull-left visibilidade', 'type' => 'file']); ?>
												<label class="switch switch-small" style="margin-top: 8px;">
													<?php echo $this->Form->checkbox('visivel', ['hiddenField' => true, 'value' => $value->id, 'checked' => $value->visivel]); ?>
													<span></span>
												</label>
												<?php echo $this->Form->end(); ?>
											</div>

											<div class="panel-body" style=" width: 100%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
												<?php echo $this->Html->image('/content/slides/' . $value->imagem, array('class' => 'center img-thumbnail')); ?>
											</div>

											<div class="panel-footer">
												<ul class="panel-controls" style="margin-top: 2px;">
													<li><?php echo $this->Html->link('<i class="fa fa-edit"></i>', ['controller' => 'slides', 'action' => 'editar', $value->id], ['escape' => false]); ?></li>
													<li><?php echo $this->Html->link('<i class="fa fa-trash"></i>', 'javascript:void(0);', ['escape' => false, 'class' => 'text-danger mb-control', 'data-box' => '#delete-slide-' . $value->id]); ?></li>
												</ul>
											</div>

											<!-- MESSAGE BOX-->
											<div class="message-box animated fadeIn message-box-warning" id="delete-slide-<?php echo $value->id; ?>">
												<div class="mb-container">
													<div class="mb-middle">
														<div class="mb-title"><span class="fa fa-warning"></span> Excluir?</div>
														<div class="mb-content">
															<p>Tem certeza que deseja excluir? Isso não poderá ser desfeito.<br>Pressione [Não] se quiser cancelar a operação. Pressione [Sim] para excluir o registro.</p>
														</div>
														<div class="mb-footer">
															<div class="pull-right">
																<?php echo $this->Form->postLink('Sim', ['controller' => 'slides', 'action' => 'excluir', $value->id], ['class' => 'btn btn-primary btn-lg']); ?>
																<button class="btn btn-default btn-lg mb-control-close">Não</button>
															</div>
														</div>
													</div>
												</div>
											</div>
											<!-- END MESSAGE BOX-->
										</div>
									</div>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
				</div>
				<div class="panel-footer"></div>
			</div>
		</div>
		<div class="col-md-12">
			<?php echo $this->Flash->render(); ?>
			
			<div class="panel panel-default">
				<div class="panel-heading clearfix">
					<div class="panel-title-box">
						<h3>Estilos</h3>
					</div>
					<?php echo $this->Html->link('<span class="fa fa-plus"></span> Novo estilo', ['controller' => 'estilos', 'action' => 'adicionar'], ['escape' => false, 'class' => 'btn btn-primary pull-right']); ?>
				</div>
				<div class="panel-body padding-bottom-0">
					<div class="row">
						<?php if ($estilos->count()) { ?>
							<div class="ordenable" data-action="<?php echo $this->Url->build(['controller' => 'estilos', 'action' => 'ordenar']) ?>">
								<?php foreach ($estilos as $key => $value) { ?>
									
									<div class="col-md-3 col-lg-3 col-sm-6 col-xs-12 push-down-20" id="odr_<?php echo $value->id; ?>">
										<div class="panel panel-primary push-down-0">
											<div class="panel-heading">
												<?php echo $this->Form->create($value, ['url' => ['controller' => 'estilos', 'action' => 'visibilidade', $value->id], 'class' => 'pull-left visibilidade', 'type' => 'file']); ?>
												<label class="switch switch-small" style="margin-top: 8px;">
													<?php echo $this->Form->checkbox('visivel', ['hiddenField' => true, 'value' => $value->id, 'checked' => $value->visivel]); ?>
													<span></span>
												</label>
												<?php echo $this->Form->end(); ?>
											</div>

											<div class="panel-body" style=" width: 100%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
												<?php echo $this->Html->image('/content/estilos/' . $value->imagem, array('class' => 'center img-thumbnail')); ?>
											</div>

											<div class="panel-footer">
												<ul class="panel-controls" style="margin-top: 2px;">
													<li><?php echo $this->Html->link('<i class="fa fa-edit"></i>', ['controller' => 'estilos', 'action' => 'editar', $value->id], ['escape' => false]); ?></li>
													<li><?php echo $this->Html->link('<i class="fa fa-trash"></i>', 'javascript:void(0);', ['escape' => false, 'class' => 'text-danger mb-control', 'data-box' => '#delete-slide-' . $value->id]); ?></li>
												</ul>
											</div>

											<!-- MESSAGE BOX-->
											<div class="message-box animated fadeIn message-box-warning" id="delete-slide-<?php echo $value->id; ?>">
												<div class="mb-container">
													<div class="mb-middle">
														<div class="mb-title"><span class="fa fa-warning"></span> Excluir?</div>
														<div class="mb-content">
															<p>Tem certeza que deseja excluir? Isso não poderá ser desfeito.<br>Pressione [Não] se quiser cancelar a operação. Pressione [Sim] para excluir o registro.</p>
														</div>
														<div class="mb-footer">
															<div class="pull-right">
																<?php echo $this->Form->postLink('Sim', ['controller' => 'estilos', 'action' => 'excluir', $value->id], ['class' => 'btn btn-primary btn-lg']); ?>
																<button class="btn btn-default btn-lg mb-control-close">Não</button>
															</div>
														</div>
													</div>
												</div>
											</div>
											<!-- END MESSAGE BOX-->
										</div>
									</div>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
				</div>
				<div class="panel-footer"></div>
			</div>
		</div>

		<?php echo $this->cell('FormContent', [
			'conteudo' => $conteudos[0],
			'toolbar' => ['Bold,Italic'],
			'full' => false,
		]); ?>

		<?php echo $this->cell('FormContent', [
			'conteudo' => $conteudos[1],
			'toolbar' => ['Bold,Italic,Underline,Strike,Subscript,BulletedList'],
			'full' => false,
		]); ?>
	</div>

	<?php
	$this->start('scripts');

	echo $this->Html->script([
		'/admin/js/plugins/ckeditor/ckeditor.js',
		'/admin/js/plugins/bootstrap-fileupload/bootstrap-fileupload.js',
		'/admin/js/plugins/cropper/cropper.js',
		'/admin/js/plugins/cropper/jquery-cropper.js',
		'/admin/js/plugins/icheck/icheck.min.js',
		'/admin/js/plugins/charactercounter/jquery.charactercounter.js',
		'/admin/js/portlet.js',
	]);

	$this->end();
?>