<!-- START BREADCRUMB -->
<ul class="breadcrumb">
	<li>Ambientes</li>
	<li>Editar</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
	<h2><span class="fa fa-bed"></span> Editar</h2>
	<div class="pull-right">
		<?php echo $this->Html->link('<i class="fa fa-list-ul"></i> Imagens', ['controller' => 'imagens', 'action' => 'visualizar', $ambiente->id], ['escape' => false, 'class' => 'btn btn-primary']); ?>
	</div>
</div>
<!-- END PAGE TITLE -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
	<div class="row">
		<div class="col-md-12">
			<?php echo $this->Flash->render(); ?>

			<?php echo $this->Form->create($ambiente, ['url' => ['controller' => 'ambientes', 'action' => 'editar', $ambiente->id], 'class' => 'form-horizontal', 'type' => 'file', 'novalidate' => true, 'templates' => ['inputContainer' => '{{content}}']]); ?>
			<div class="panel panel-default">
				<div class="panel-heading">
				</div>

				<div class="panel-body form-group-separated">
					<div class="form-group">
						<div class="col-md-8 col-lg-8 col-sm-10 col-xs-12">
							<label>Nome</label>
							<div class="input-group">
								<span class="input-group-addon">
									<?php echo $this->Html->image('/admin/img/flags/br.png', ['style' => 'max-width: 20px;']); ?>
								</span>
								<?php echo $this->Form->control('nome', ['type' => 'text', 'class' => 'form-control', 'label' => false]); ?>
							</div>
							<span class="help-block with-errors"></span>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-8 col-lg-8 col-sm-10 col-xs-12">
							<label><?php echo $this->Html->image('/admin/img/flags/br.png', ['style' => 'max-width: 30px; margin: -4px 5px 0 0', 'class' => 'img-thumbnail']); ?> Estilo</label>
							<?php echo $this->Form->control('estilo', ['type' => 'textarea', 'class' => 'form-control editor', 'label' => false, 'data-toolbar' => 'Bold,Italic']); ?>
							<span class="help-block with-errors">Utilize CTRL (Command) + Enter para quebrar a linha. Utilize Enter para inserir um novo par??grafo.</span>
						</div>
					</div>				

					<div class="form-group">
						<div class="col-md-8 col-lg-8 col-sm-10 col-xs-12">
							<label><?php echo $this->Html->image('/admin/img/flags/br.png', ['style' => 'max-width: 30px; margin: -4px 5px 0 0', 'class' => 'img-thumbnail']); ?> Descri????o</label>
							<?php echo $this->Form->control('descricao', ['type' => 'textarea', 'class' => 'form-control editor', 'label' => false, 'data-toolbar' => 'Bold,Italic']); ?>
							<span class="help-block with-errors">Utilize CTRL (Command) + Enter para quebrar a linha. Utilize Enter para inserir um novo par??grafo.</span>
						</div>
					</div>
						
				
					<div class="form-group">
						<div class="col-md-8 col-lg-8 col-sm-10 col-xs-12">
							<?php
							$this->Form->unlockFields('coordenadas.imagem.desktop.x');
							$this->Form->unlockFields('coordenadas.imagem.desktop.y');
							$this->Form->unlockFields('coordenadas.imagem.desktop.w');
							$this->Form->unlockFields('coordenadas.imagem.desktop.h');
							echo $this->Form->control('coordenadas.imagem.desktop.x', ['type' => 'hidden', 'value' => "", 'class' => 'coord-x crop_image_1']);
							echo $this->Form->control('coordenadas.imagem.desktop.y', ['type' => 'hidden', 'value' => "", 'class' => 'coord-y crop_image_1']);
							echo $this->Form->control('coordenadas.imagem.desktop.w', ['type' => 'hidden', 'value' => "", 'class' => 'coord-w crop_image_1']);
							echo $this->Form->control('coordenadas.imagem.desktop.h', ['type' => 'hidden', 'value' => "", 'class' => 'coord-h crop_image_1']);
							?>
							<div>
								<label>Imagem</label>
							</div>
							<div class="fileupload fileupload-new">
								<div class="fileupload-new thumbnail" style="max-width: 480px;">
									<?php echo $this->Html->image('/content/ambients/' . $ambiente->imagem, ['style' => 'width: auto; max-width: 100%;']); ?>
								</div>
								<div class="fileupload-preview fileupload-exists thumbnail" data-width="500" data-height="300" data-ratio="true" data-crop="true"></div>
								<div>
									<span class="btn btn-white btn-file">
										<span class="fileupload-new"><i class="fa fa-paperclip"></i> Selecionar imagem</span>
										<span class="fileupload-exists"><i class="fa fa-undo"></i> Trocar</span>
										<?php echo $this->Form->control('img', ['type' => 'file', 'label' => false, 'id' => 'crop_image_1']); ?>
									</span>
									<a href="#" class="btn btn-danger fileupload-exists fileupload-remove"><i class="fa fa-trash"></i> Remover</a>
								</div>
							</div>
							<div>
								<span class="label label-danger">NOTA!</span>
								<span>
									Recurso suportado somente nos navegadores mais novos. Se voc?? n??o estiver utlizando a vers??o mais recente do seu navegador por favor atualize-o.
								</span>
							</div>
							<div>
								<span class="label label-warning">TAMANHO!</span>
								<span>
									A imagem deve ter no m??nimo <b>1920px</b> de largura e <b>300px</b> de altura.
								</span>
							</div>
						</div>

						<!--BANNER-->
						<div class="col-md-4 col-lg-4 col-sm-10 col-xs-12">
							<?php
							$this->Form->unlockFields('coordenadas.imagem.banner.x');
							$this->Form->unlockFields('coordenadas.imagem.banner.y');
							$this->Form->unlockFields('coordenadas.imagem.banner.w');
							$this->Form->unlockFields('coordenadas.imagem.banner.h');
							echo $this->Form->control('coordenadas.imagem.banner.x', ['type' => 'hidden', 'value' => "", 'class' => 'coord-x crop_image_2']);
							echo $this->Form->control('coordenadas.imagem.banner.y', ['type' => 'hidden', 'value' => "", 'class' => 'coord-y crop_image_2']);
							echo $this->Form->control('coordenadas.imagem.banner.w', ['type' => 'hidden', 'value' => "", 'class' => 'coord-w crop_image_2']);
							echo $this->Form->control('coordenadas.imagem.banner.h', ['type' => 'hidden', 'value' => "", 'class' => 'coord-h crop_image_2']);
							?>
							<div>
								<label>Banner para celulares</label>
							</div>
							<div class="fileupload fileupload-new">
								<div class="fileupload-new thumbnail" style="max-width: 480px; max-height: 480px;">
									<?php echo $this->Html->image('/content/ambients/banner/' . $ambiente->banner, ['style' => 'width: auto; max-width: 100%; height: auto; max-height: inherit;']); ?>
								</div>
								<div class="fileupload-preview fileupload-exists thumbnail" data-width="500" data-height="300" data-ratio="1" data-crop="1"></div>
								<div>
									<span class="btn btn-white btn-file">
										<span class="fileupload-new"><i class="fa fa-paperclip"></i> Selecionar banner</span>
										<span class="fileupload-exists"><i class="fa fa-undo"></i> Trocar</span>
										<?php echo $this->Form->control('img_banner', ['type' => 'file', 'label' => false, 'id' => 'crop_image_2']); ?>
									</span>
									<a href="#" class="btn btn-danger fileupload-exists fileupload-remove"><i class="fa fa-trash"></i> Remover</a>
								</div>
							</div>
							<div>
								<span class="label label-danger">NOTA!</span>
								<span>
									Recurso suportado somente nos navegadores mais novos. Se voc?? n??o estiver utlizando a vers??o mais recente do seu navegador por favor atualize-o.
								</span>
							</div>
							<div>
								<span class="label label-warning">TAMANHO!</span>
								<span>
									A imagem deve ter no m??nimo <b>680px</b> de largura e <b>360px</b> de altura.
								</span>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-8 col-lg-8 col-sm-10 col-xs-12">
							<label>T??tulo da p??gina</label>
							<div class="input-group">
								<span class="input-group-addon">
									<?php echo $this->Html->image('/admin/img/flags/br.png', ['style' => 'max-width: 20px;']); ?>
								</span>
								<?php echo $this->Form->control('titulo_pagina', ['type' => 'text', 'class' => 'form-control input-counter', 'label' => false]); ?>
							</div>
							<span class="help-block with-errors"></span>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-8 col-lg-8 col-sm-10 col-xs-12">
							<label><?php echo $this->Html->image('/admin/img/flags/br.png', ['style' => 'max-width: 30px; margin: -4px 5px 0 0', 'class' => 'img-thumbnail']); ?> Descri????o da p??gina</label>
							<?php echo $this->Form->control('descricao_pagina', ['type' => 'textarea', 'class' => 'form-control input-counter', 'label' => false]); ?>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-8 col-lg-8 col-sm-10 col-xs-12">
							<label>T??tulo exibido ao compartilhar</label>
							<div class="input-group">
								<span class="input-group-addon">
									<?php echo $this->Html->image('/admin/img/flags/br.png', ['style' => 'max-width: 20px;']); ?>
								</span>
								<?php echo $this->Form->control('titulo_compartilhamento', ['type' => 'text', 'class' => 'form-control input-counter', 'label' => false]); ?>
							</div>
							<span class="help-block with-errors"></span>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-8 col-lg-8 col-sm-10 col-xs-12">
							<label><?php echo $this->Html->image('/admin/img/flags/br.png', ['style' => 'max-width: 30px; margin: -4px 5px 0 0', 'class' => 'img-thumbnail']); ?> Descri????o exibida ao compartilhar</label>
							<?php echo $this->Form->control('descricao_compartilhamento', ['type' => 'textarea', 'class' => 'form-control input-counter', 'label' => false]); ?>
						</div>
					</div>	
				</div>

				<div class="panel-footer">
					<div class="col-md-12 col-xs-12">
						<div class="pull-right">
							<?php echo $this->Html->link('<i class="fa fa-arrow-left"></i> Voltar', ['controller' => 'ambientes', 'action' => 'index'], ['escape' => false, 'class' => 'btn btn-danger btn-rounded', 'style' => 'margin-right: 10px;']); ?>
							<?php echo $this->Form->button('<i class="fa fa-save"></i> Salvar', ['escapeTitle' => false, 'class' => 'btn btn-primary btn-rounded']); ?>
						</div>
					</div>
				</div>
			</div>
		<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>
<!-- END PAGE CONTENT WRAPPER -->

<?php
$this->start('scripts');

echo $this->Html->script([
	'/admin/js/plugins/ckeditor/ckeditor.js',
	'/admin/js/plugins/bootstrap-fileupload/bootstrap-fileupload.js',
	'/admin/js/plugins/cropper/cropper.js',
	'/admin/js/plugins/cropper/jquery-cropper.js',
	'/admin/js/plugins/charactercounter/jquery.charactercounter.js',
]);

$this->end();
?>