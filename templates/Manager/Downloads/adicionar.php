<!-- START BREADCRUMB -->
<ul class="breadcrumb">
	<li>Downloads</li>
	<li>Adicionar</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
	<h2><span class="fa fa-arrow-down"></span> Adicionar</h2>
</div>
<!-- END PAGE TITLE -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
	<div class="row">
		<div class="col-md-12">
			<?php echo $this->Flash->render(); ?>

			<?php echo $this->Form->create($download, ['url' => ['controller' => 'downloads', 'action' => 'adicionar'], 'class' => 'form-horizontal', 'type' => 'file', 'novalidate' => true, 'templates' => ['inputContainer' => '{{content}}']]); ?>
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
							<div>
								<label><?php echo $this->Html->image('/admin/img/flags/br.png', array('style' => 'max-width: 30px; margin: -4px 5px 0 0', 'class' => 'img-thumbnail')); ?> Arquivo</label>
							</div>
							<div class="fileupload fileupload-new" data-provides="fileupload">
								<span class="btn btn-default btn-file">
									<span class="fileupload-new">
										<i class="fa fa-paperclip"></i> Selecionar arquivo
									</span>
									<span class="fileupload-exists"><i class="fa fa-undo"></i> Trocar</span>
									<?php echo $this->Form->input('arq', array('type' => 'file', 'div' => false, 'label' => false)); ?>
								</span>
								<div class="btn btn-white">
									<span class="fileupload-filename">
										<span class="font-sm">Nenhum arquivo selecionado</span>
									</span>
									<a href="#" class="close fileupload-exists fileupload-remove" data-dismiss="fileupload" style="float: none; font-size: inherit;">&nbsp;<i class="fa fa-times"></i></a>
								</div>
							</div>
						</div>

						<!-- MESSAGE BOX-->
						<div class="message-box animated fadeIn message-box-warning" id="delete-file-<?php echo $marcas_valores->id; ?>">
							<div class="mb-container">
								<div class="mb-middle">
									<div class="mb-title"><span class="fa fa-warning"></span> Excluir?</div>
									<div class="mb-content">
										<p>Tem certeza que deseja excluir? Isso não poderá ser desfeito.<br>Pressione [Não] se quiser cancelar a operação. Pressione [Sim] para excluir o registro.</p>
									</div>
									<div class="mb-footer">
										<div class="pull-right">
											<?php echo $this->Form->postLink('Sim', ['controller' => 'downloads', 'action' => 'excluirArquivo', $download->id], ['block' => true, 'class' => 'btn btn-primary btn-lg']); ?>
											<button class="btn btn-default btn-lg mb-control-close">Não</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="panel-footer">
						<div class="col-md-12 col-xs-12">
							<div class="pull-right">
								<?php echo $this->Html->link('<i class="fa fa-arrow-left"></i> Voltar', ['controller' => 'downloads', 'action' => 'index'], ['escape' => false, 'class' => 'btn btn-danger btn-rounded', 'style' => 'margin-right: 10px;']); ?>
								<?php echo $this->Form->button('<i class="fa fa-save"></i> Salvar', ['escapeTitle' => false, 'class' => 'btn btn-primary btn-rounded']); ?>
							</div>
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
	'/admin/js/plugins/bootstrap-fileupload/bootstrap-fileupload.js',
	'/admin/js/plugins/bootstrap-select/bootstrap-select.js',
	'/admin/js/portlet.js',
]);

$this->end();
?>