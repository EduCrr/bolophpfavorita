<!-- START BREADCRUMB -->
<ul class="breadcrumb">
	<li>Downloads</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
	<h2><span class="fa fa-arrow-down"></span> Downloads</h2>

	<div class="pull-right">
		<div class="btn-group dropleft">
			<ul class="dropdown-menu">
				<?php foreach ($idiomas as $key => $value) { ?>
					<li class="navi-item">
						<?php echo $this->Html->link(
							$this->Html->image('/admin/img/flags/br.png', ['class' => 'img-thumbnail', 'style' => 'max-width: 30px;']) . '&nbsp;' . $value->nome,
							['?' => ['lang' => $value->codigo]],
							['escape' => false, 'class' => 'navi-link']
						); ?>
					</li>
				<?php } ?>
			</ul>
		</div>
	</div>
</div>
<!-- END PAGE TITLE -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
	<?php echo $this->element('page_settings', [
		'pagina' => $pagina,
	]); ?>

	<?php echo $this->cell('FormContent', [
		'conteudo' => $conteudos[0],
		'toolbar' => ['Bold,Italic'],
		'full' => false,
	]); ?>
	
	<div class="row">
		<div class="col-md-12">		
			<?php echo $this->Flash->render(); ?>	
			<div class="panel panel-default">
				<div class="panel-heading clearfix">
				</div>
				<div class="panel-body padding-bottom-0">
					<div class="panel-title-box">
						<h3>Catálogo</h3>
						<?php echo $this->Html->link('<span class="fa fa-plus"></span> Novo download', ['controller' => 'downloads', 'action' => 'adicionar'], ['escape' => false, 'class' => 'btn btn-primary pull-right']); ?>
					</div>

					<div class="row push-up-20">
						<table class="table table-bordered table-condensed push-down-25">
							<thead>
								<tr>
									<th>#</th>
									<th>Catálogo</th>
									<th>Visível</th>
									<th><i class="fa fa-minus"></i></th>
								</tr>
							</thead>
							<tbody class="<?php echo $downloads->count() ? 'ordenable-table':null; ?>" data-action="<?php echo $this->Url->build(['controller' => 'downloads', 'action' => 'ordenar']) ?>">
								<div class="ordenable" data-action="<?php echo $this->Url->build(['controller' => 'downloads', 'action' => 'ordenar']) ?>">
									<?php foreach ($downloads as $key => $value) { ?>
										<tr id="odr_<?php echo $value->id; ?>">
											<td class="order-column" style="vertical-align: middle;"><?php echo $key + 1 ?></td>
											<td style="vertical-align: middle;"><?php echo $value->nome; ?> 
											</td>
											<td style="vertical-align: middle;">
												<?php echo $this->Form->create($value, ['url' => ['controller' => 'downloads', 'action' => 'visibilidade', $value->id], 'class' => 'pull-left visibilidade', 'type' => 'file']); ?>
												<label class="switch switch-small" style="margin-top: 8px;">
													<?php echo $this->Form->checkbox('visivel', ['hiddenField' => true, 'value' => $value->id, 'checked' => $value->visivel]); ?>
													<span></span>
												</label>
												<?php echo $this->Form->end(); ?>
											</td>
											<td>
												<?php echo $this->Html->link('<i class="fa fa-edit"></i>', ['controller' => 'downloads', 'action' => 'editar', $value->id], ['escape' => false, 'class' => 'btn btn-primary btn-rounded']); ?>
												<?php echo $this->Html->link('<i class="fa fa-trash"></i>', 'javascript:void(0);', ['escape' => false, 'class' => 'btn btn-danger btn-rounded mb-control', 'data-box' => '#delete-stages-' . $value->id]); ?>

												<!-- MESSAGE BOX-->
												<div class="message-box animated fadeIn message-box-warning" id="delete-stages-<?php echo $value->id; ?>">
													<div class="mb-container">
														<div class="mb-middle">
															<div class="mb-title"><span class="fa fa-warning"></span> Excluir?</div>
															<div class="mb-content">
																<p>Tem certeza que deseja excluir? Isso não poderá ser desfeito.<br>Pressione [Não] se quiser cancelar a operação. Pressione [Sim] para excluir o registro.</p>
															</div>
															<div class="mb-footer">
																<div class="pull-right">
																	<?php echo $this->Form->postLink('Sim', ['controller' => 'downloads', 'action' => 'excluir', $value->id], ['class' => 'btn btn-primary btn-lg']); ?>
																	<button class="btn btn-default btn-lg mb-control-close">Não</button>
																</div>
															</div>
														</div>
													</div>
												</div>
												<!-- END MESSAGE BOX-->
											</td>
										</tr>
									<?php } ?>
								</div>
							</tbody>
							<tfoot>
								<tr>
									<td>#</td>
									<td>Catálogo</td>
									<td>Visível</td>
									<td><i class="fa fa-minus"></i></td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
				<div class="panel-footer"></div>
			</div>
		</div>
	</div>
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