<!-- START BREADCRUMB -->
<ul class="breadcrumb">
	<li>Home</li>
	<li>Slides</li>
	<li>Adicionar</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
	<h2><span class="fa fa-home"></span> Adicionar</h2>
</div>
<!-- END PAGE TITLE -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
	<div class="row">
		<div class="col-md-12">
			<?php echo $this->Flash->render(); ?>

			<?php echo $this->Form->create($slide, ['url' => ['controller' => 'slides', 'action' => 'adicionar'], 'class' => 'form-horizontal', 'type' => 'file', 'novalidate' => true, 'templates' => ['inputContainer' => '{{content}}']]); ?>
			<div class="panel panel-default">
				<div class="panel-heading">
				</div>

				<div class="panel-body form-group-separated">
					<div class="form-group">
						<div class="col-md-8 col-lg-8 col-sm-10 col-xs-12">
							<?php
							$this->Form->unlockFields('coordenadas.imagem.padrao.x');
							$this->Form->unlockFields('coordenadas.imagem.padrao.y');
							$this->Form->unlockFields('coordenadas.imagem.padrao.w');
							$this->Form->unlockFields('coordenadas.imagem.padrao.h');
							echo $this->Form->control('coordenadas.imagem.padrao.x', ['type' => 'hidden', 'value' => "", 'class' => 'coord-x crop_image_1']);
							echo $this->Form->control('coordenadas.imagem.padrao.y', ['type' => 'hidden', 'value' => "", 'class' => 'coord-y crop_image_1']);
							echo $this->Form->control('coordenadas.imagem.padrao.w', ['type' => 'hidden', 'value' => "", 'class' => 'coord-w crop_image_1']);
							echo $this->Form->control('coordenadas.imagem.padrao.h', ['type' => 'hidden', 'value' => "", 'class' => 'coord-h crop_image_1']);
							?>
							<div>
								<label>Imagem</label>
							</div>
							<div class="fileupload fileupload-new">
								<div class="fileupload-new thumbnail" style="max-width: 480px;">
									<?php echo $this->Html->image('/admin/img/others/select.png', ['style' => 'width: auto; max-width: 100%;']); ?>
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
									Recurso suportado somente nos navegadores mais novos. Se você não estiver utlizando a versão mais recente do seu navegador por favor atualize-o.
								</span>
							</div>
							<div>
								<span class="label label-warning">TAMANHO!</span>
								<span>
									A imagem deve ter no mínimo <b>1739px</b> de largura e <b>479px</b> de altura.
								</span>
							</div>
						</div>

					</div>
				</div>
				<div class="panel-footer">
					<div class="col-md-12 col-xs-12">
						<div class="pull-right">
							<?php echo $this->Html->link('<i class="fa fa-arrow-left"></i> Voltar', ['controller' => 'home', 'action' => 'index'], ['escape' => false, 'class' => 'btn btn-danger btn-rounded', 'style' => 'margin-right: 10px;']); ?>
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
	'/admin/js/plugins/icheck/icheck.min.js',
	'/admin/js/plugins/bootstrap-fileupload/bootstrap-fileupload.js',
	'/admin/js/plugins/cropper/cropper.js',
	'/admin/js/plugins/cropper/jquery-cropper.js',
]);

$this->end();
?>