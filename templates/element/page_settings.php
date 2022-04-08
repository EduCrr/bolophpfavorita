<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default panel-toggled">
			<div class="panel-heading">
				<div class="panel-title-box">
					<h3>Configurações da página</h3>
					<span>Utilize essa seção se você possui conhecimentos sobre SEO.</span>
				</div>

				<ul class="panel-controls">
					<li>
						<?php echo $this->Html->link('<span class="fa fa-cogs"></span>', 'javascript:void(0)', array('data-toggle' => 'modal', 'data-target' => '#modal_info', 'escape' => false)); ?>
					</li>
				</ul>
			</div>

			<div class="modal" id="modal_info" tabindex="-1" role="dialog" aria-labelledby="largeModalHead" aria-hidden="true">
				<div class="modal-dialog modal-lg form-group-separated">
					<?php echo $this->Form->create($pagina, ['url' => ['controller' => 'paginas', 'action' => 'editar', $pagina->id, '?' => $this->request->getQuery()], 'class' => 'form-horizontal modal-content', 'type' => 'file', 'novalidate' => true, 'templates' => ['inputContainer' => '{{content}}']]); ?>
						<?php echo $this->Form->control('paginas_idiomas.0.id', ['type' => 'hidden']); ?>
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
							<h4 class="modal-title" id="largeModalHead">Configurações da página</h4>
						</div>
						<div class="modal-body padding-0">
							<?php
							$this->Form->unlockFields('coordenadas.desktop.x');
							$this->Form->unlockFields('coordenadas.desktop.y');
							$this->Form->unlockFields('coordenadas.desktop.w');
							$this->Form->unlockFields('coordenadas.desktop.h');
							echo $this->Form->control('coordenadas.desktop.x', ['type' => 'hidden', 'value' => "", 'class' => 'coord-x crop_image_info']);
							echo $this->Form->control('coordenadas.desktop.y', ['type' => 'hidden', 'value' => "", 'class' => 'coord-y crop_image_info']);
							echo $this->Form->control('coordenadas.desktop.w', ['type' => 'hidden', 'value' => "", 'class' => 'coord-w crop_image_info']);
							echo $this->Form->control('coordenadas.desktop.h', ['type' => 'hidden', 'value' => "", 'class' => 'coord-h crop_image_info']);
							?>

							<div class="form-group">
								<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
									<label><?php echo $this->Html->image('/admin/img/flags/' . $idioma->icone, ['style' => 'max-width: 30px; margin: -4px 5px 0 0', 'class' => 'img-thumbnail']); ?> Título</label>
									<?php echo $this->Form->control('paginas_idiomas.0.titulo', ['type' => 'text', 'class' => 'form-control input-counter', 'label' => false]); ?>
									<span class="help-block with-errors"></span>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
									<label><?php echo $this->Html->image('/admin/img/flags/' . $idioma->icone, ['style' => 'max-width: 30px; margin: -4px 5px 0 0', 'class' => 'img-thumbnail']); ?> Meta descrição</label>
									<?php echo $this->Form->control('paginas_idiomas.0.descricao', ['type' => 'textarea', 'class' => 'form-control input-counter', 'label' => false, 'div' => false, 'style' => 'max-height: 72px;']); ?>
									<span class="help-block with-errors"></span>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
									<label><?php echo $this->Html->image('/admin/img/flags/' . $idioma->icone, ['style' => 'max-width: 30px; margin: -4px 5px 0 0', 'class' => 'img-thumbnail']); ?> Título exibido ao compartilhar</label>
									<?php echo $this->Form->control('paginas_idiomas.0.titulo_compartilhamento', ['type' => 'text', 'class' => 'form-control input-counter', 'label' => false]); ?>
									<span class="help-block with-errors"></span>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
									<label><?php echo $this->Html->image('/admin/img/flags/' . $idioma->icone, ['style' => 'max-width: 30px; margin: -4px 5px 0 0', 'class' => 'img-thumbnail']); ?> Meta descrição exibida ao compartilhar</label>
									<?php echo $this->Form->control('paginas_idiomas.0.descricao_compartilhamento', ['type' => 'textarea', 'class' => 'form-control input-counter', 'label' => false, 'div' => false, 'style' => 'max-height: 72px;']); ?>
									<span class="help-block with-errors"></span>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-11 col-lg-11 col-sm-12 col-xs-12">
										<div>
											<label>Imagem</label>
										</div>
										<div class="fileupload fileupload-new">
											<div class="fileupload-new thumbnail">
												<?php echo $this->Html->image('/content/pages/' . $pagina->imagem, ['style' => 'max-width: 480px;']); ?>
											</div>
											<div class="fileupload-preview fileupload-exists thumbnail" data-width="1280" data-height="720" data-ratio="true" data-crop="true"></div>
											<div>
												<span class="btn btn-white btn-file">
													<span class="fileupload-new"><i class="fa fa-paperclip"></i> Selecionar imagem</span>
													<span class="fileupload-exists"><i class="fa fa-undo"></i> Trocar</span>
													<?php echo $this->Form->input('img', ['type' => 'file', 'div' => false, 'label' => false, 'id' => 'crop_image_info']); ?>
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
												A imagem deve ter no mínimo <b>1280px</b> de largura e <b>720px</b> de altura.
											</span>
										</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<?php echo $this->Form->button('<i class="fa fa-save"></i> Salvar', ['escapeTitle' => false, 'class' => 'btn btn-default']); ?>
						</div>
					<?php echo $this->Form->end(); ?>
				</div>
			</div>

			<div class="panel-body form-group-separated">
				
			</div>
			<div class="panel-footer"></div>
		</div>
	</div>
</div>