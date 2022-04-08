<div class="row">
	<div class="col-md-12">
		<?php echo $this->Form->create($conteudo, ['url' => ['controller' => 'conteudos', 'action' => 'editar', $conteudo->id], 'class' => 'form-horizontal', 'type' => 'file', 'novalidate' => true, 'templates' => ['inputContainer' => '{{content}}']]); ?>
			<div class="panel panel-default <?php echo $conteudo->parametro->minimizavel ? 'panel-toggled' : false; ?>">
				<div class="panel-heading">
					<?php if ($conteudo->parametro->descricao) { ?>
					<div class="panel-title-box">
						<h3><?php echo $conteudo->parametro->descricao; ?></h3>
					</div>
					<?php } ?>

					<?php if ($conteudo->parametro->minimizavel) { ?>
					<ul class="panel-controls" style="margin-top: 2px;">
						<li><a href="javascript:void(0);" class="panel-collapse"><span class="fa fa-angle-up"></span></a></li>							
					</ul>
					<?php } ?>
				</div>

				<div class="panel-body form-group-separated">
					<?php echo $this->Form->hidden('id'); ?>

					<?php if ($conteudo->parametro->habilitar_titulo) { ?>
					<div class="form-group">
						<div class="<?php echo $full ? 'col-md-12 col-lg-12 col-sm-10 col-xs-12' : 'col-md-8 col-lg-8 col-sm-10 col-xs-12'; ?>">
							<label>Título</label>
							<div class="input-group">
								<span class="input-group-addon">
									<?php echo $this->Html->image('/admin/img/flags/br.png', ['style' => 'max-width: 20px;']); ?>
								</span>
								<?php echo $this->Form->control('titulo', ['type' => 'text', 'id' => "titulo-{$conteudo->id}", 'class' => 'form-control', 'label' => false]); ?>
							</div>
							<span class="help-block with-errors"></span>
						</div>
					</div>
					<?php } ?>

					<?php if ($conteudo->parametro->habilitar_texto) { ?>
					<div class="form-group">
						<div class="<?php echo $full ? 'col-md-12 col-lg-12 col-sm-10 col-xs-12' : 'col-md-8 col-lg-8 col-sm-10 col-xs-12'; ?>">
							<label><?php echo $this->Html->image('/admin/img/flags/br.png', ['style' => 'max-width: 30px; margin: -4px 5px 0 0', 'class' => 'img-thumbnail']); ?> Conteúdo</label>
							<?php echo $this->Form->control('texto', ['type' => 'textarea', 'id' => "texto-{$conteudo->id}", 'class' => 'form-control' . ($conteudo->parametro->texto_formatado ? ' editor' : null), 'label' => false, 'data-toolbar' => isset($toolbar) ? $toolbar : 'Bold,Italic']); ?>
							<span class="help-block with-errors">Utilize CTRL (Command) + Enter para quebrar a linha. Utilize Enter para inserir um novo parágrafo.</span>
						</div>
					</div>
					<?php } ?>

					<?php if ($conteudo->parametro->habilitar_link) { ?>
					<div class="form-group">
						<div class="<?php echo $full ? 'col-md-12 col-lg-12 col-sm-10 col-xs-12' : 'col-md-6 col-lg-6 col-sm-10 col-xs-12'; ?>">
							<label>Link</label>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-globe"></i>
								</span>
								<?php echo $this->Form->control('link', ['type' => 'text', 'id' => "link-{$conteudo->id}", 'class' => 'form-control', 'label' => false]); ?>
							</div>
							<span class="help-block with-errors"></span>
						</div>
						<div class="<?php echo $full ? 'col-md-12 col-lg-12 col-sm-10 col-xs-12' : 'col-md-2 col-lg-2 col-sm-4 col-xs-4'; ?>">
							<label>Abrir link em nova aba?</label>
							<div>
								<label class="check">
									<?php echo $this->Form->checkbox('nova_aba', ['hiddenField' => true, 'value' => 1, 'class' => 'icheckbox']); ?> Sim
								</label>
							</div>
						</div>
					</div>
					<?php } ?>

					<?php if ($conteudo->parametro->habilitar_img || $conteudo->parametro->habilitar_img_mobile) { ?>
					<div class="form-group">
						<?php if ($conteudo->parametro->habilitar_img) { ?>
						<div class="<?php echo $full ? 'col-md-12 col-lg-12 col-sm-10 col-xs-12' : 'col-md-8 col-lg-8 col-sm-10 col-xs-12'; ?>">
							<?php if ($conteudo->parametro->recortar_img) {
								$this->Form->unlockFields('coordenadas.desktop.x');
								$this->Form->unlockFields('coordenadas.desktop.y');
								$this->Form->unlockFields('coordenadas.desktop.w');
								$this->Form->unlockFields('coordenadas.desktop.h');
								echo $this->Form->control('coordenadas.desktop.x', ['type' => 'hidden', 'value' => "", 'class' => 'coord-x crop_image_' . $conteudo->id]);
								echo $this->Form->control('coordenadas.desktop.y', ['type' => 'hidden', 'value' => "", 'class' => 'coord-y crop_image_' . $conteudo->id]);
								echo $this->Form->control('coordenadas.desktop.w', ['type' => 'hidden', 'value' => "", 'class' => 'coord-w crop_image_' . $conteudo->id]);
								echo $this->Form->control('coordenadas.desktop.h', ['type' => 'hidden', 'value' => "", 'class' => 'coord-h crop_image_' . $conteudo->id]);
							} ?>
							<div>
								<label>Imagem</label>
							</div>
							<div class="fileupload fileupload-new">
								<div class="fileupload-new thumbnail" style="max-width: 480px;">
									<?php echo $this->Html->image('/content/display/' . $conteudo->imagem, ['style' => 'width: auto; max-width: 100%;']); ?>
								</div>
								<div class="fileupload-preview fileupload-exists thumbnail" data-width="<?php echo $conteudo->parametro->largura_img; ?>" data-height="<?php echo $conteudo->parametro->altura_img; ?>" data-ratio="<?php echo var_export(boolval($conteudo->parametro->recortar_img)); ?>" data-crop="<?php echo var_export(boolval($conteudo->parametro->recortar_img)); ?>"></div>
								<div>
									<span class="btn btn-white btn-file">
										<span class="fileupload-new"><i class="fa fa-paperclip"></i> Selecionar imagem</span>
										<span class="fileupload-exists"><i class="fa fa-undo"></i> Trocar</span>
										<?php echo $this->Form->control('img', ['type' => 'file', 'id' => "img-{$conteudo->id}", 'label' => false, 'id' => 'crop_image_' . $conteudo->id]); ?>
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
									A imagem deve ter no mínimo <b><?php echo $conteudo->parametro->largura_img; ?>px</b> de largura e <b><?php echo $conteudo->parametro->altura_img; ?>px</b> de altura.
								</span>
							</div>
						</div>
						<?php } if ($conteudo->parametro->habilitar_img_mobile) { ?>
						<div class="<?php echo $full ? 'col-md-12 col-lg-12 col-sm-10 col-xs-12' : 'col-md-4 col-lg-4 col-sm-10 col-xs-12'; ?>">
							<?php if ($conteudo->parametro->recortar_img_mobile) {
								$this->Form->unlockFields('coordenadas.mobile.x');
								$this->Form->unlockFields('coordenadas.mobile.y');
								$this->Form->unlockFields('coordenadas.mobile.w');
								$this->Form->unlockFields('coordenadas.mobile.h');
								echo $this->Form->control('coordenadas.mobile.x', ['type' => 'hidden', 'value' => "", 'class' => 'coord-x crop_image_m_' . $conteudo->id]);
								echo $this->Form->control('coordenadas.mobile.y', ['type' => 'hidden', 'value' => "", 'class' => 'coord-y crop_image_m_' . $conteudo->id]);
								echo $this->Form->control('coordenadas.mobile.w', ['type' => 'hidden', 'value' => "", 'class' => 'coord-w crop_image_m_' . $conteudo->id]);
								echo $this->Form->control('coordenadas.mobile.h', ['type' => 'hidden', 'value' => "", 'class' => 'coord-h crop_image_m_' . $conteudo->id]);
							} ?>
							<div>
								<label>Imagem para celulares</label>
							</div>
							<div class="fileupload fileupload-new">
								<div class="fileupload-new thumbnail" style="max-height: 480px;">
									<?php echo $this->Html->image('/content/display/' . $conteudo->imagem_mobile, ['style' => 'width: auto; max-width: 100%; height: auto; max-height: inherit;']); ?>
								</div>
								<div class="fileupload-preview fileupload-exists thumbnail" data-width="<?php echo $conteudo->parametro->largura_img_mobile; ?>" data-height="<?php echo $conteudo->parametro->altura_img_mobile; ?>" data-ratio="<?php echo var_export(boolval($conteudo->parametro->recortar_img_mobile)); ?>" data-crop="<?php echo var_export(boolval($conteudo->parametro->recortar_img_mobile)); ?>"></div>
								<div>
									<span class="btn btn-white btn-file">
										<span class="fileupload-new"><i class="fa fa-paperclip"></i> Selecionar imagem</span>
										<span class="fileupload-exists"><i class="fa fa-undo"></i> Trocar</span>
										<?php echo $this->Form->control('img_mobile', ['type' => 'file', 'id' => "img-mobile-{$conteudo->id}", 'label' => false, 'id' => 'crop_image_m_' . $conteudo->id]); ?>
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
									A imagem deve ter no mínimo <b><?php echo $conteudo->parametro->largura_img_mobile; ?>px</b> de largura e <b><?php echo $conteudo->parametro->altura_img_mobile; ?>px</b> de altura.
								</span>
							</div>
						</div>
						<?php } ?>
					</div>
					<?php } ?>

					<?php if ($conteudo->parametro->habilitar_video) { ?>
					<div class="form-group">
						<div class="col-md-8 col-lg-8 col-sm-10 col-xs-12">
							<label>Vídeo</label>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-youtube"></i>
								</span>
								<?php echo $this->Form->control('video', ['type' => 'text', 'id' => "video-{$conteudo->id}", 'class' => 'form-control', 'label' => false]); ?>
							</div>
							<span class="help-block with-errors"></span>
						</div>
					</div>
					<?php } ?>

					<?php if ($conteudo->parametro->habilitar_arq) { ?>
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
										<?php if ($conteudo->arquivo) { ?>
										<?php echo $this->Html->link('Ver documento', ['controller' => 'conteudos', 'action' => 'baixarArquivo', $conteudo->id]); ?>

										<?php echo $this->Html->link('<i class="fa fa-trash"></i>', 'javascript:void(0);', ['escape' => false, 'class' => 'text-danger mb-control', 'target' => '_blank', 'data-box' => '#delete-file-' . $conteudo->id]); ?>

										<?php } else { ?>
										<span class="font-sm">Nenhum arquivo selecionado</span>
										<?php } ?>
									</span>
									<a href="#" class="close fileupload-exists fileupload-remove" data-dismiss="fileupload" style="float: none; font-size: inherit;">&nbsp;<i class="fa fa-times"></i></a>
								</div>
							</div>
						</div>

						<?php if ($conteudo->arquivo) { ?>
						<!-- MESSAGE BOX-->
						<div class="message-box animated fadeIn message-box-warning" id="delete-file-<?php echo $conteudo->id; ?>">
							<div class="mb-container">
								<div class="mb-middle">
									<div class="mb-title"><span class="fa fa-warning"></span> Excluir?</div>
									<div class="mb-content">
										<p>Tem certeza que deseja excluir? Isso não poderá ser desfeito.<br>Pressione [Não] se quiser cancelar a operação. Pressione [Sim] para excluir o registro.</p>
									</div>
									<div class="mb-footer">
										<div class="pull-right">
											<?php echo $this->Form->postLink('Sim', ['controller' => 'conteudos', 'action' => 'excluirArquivo', $conteudo->id], ['block' => true, 'class' => 'btn btn-primary btn-lg']); ?>
											<button class="btn btn-default btn-lg mb-control-close">Não</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- END MESSAGE BOX-->
						<?php } ?>
					</div>
					<?php } ?>
				</div>
				<div class="panel-footer">
					<div class="col-md-12 col-xs-12">
						<?php echo $this->Form->button('<i class="fa fa-save"></i> Salvar', ['escapeTitle' => false, 'class' => 'btn btn-primary btn-rounded pull-right']); ?>
					</div>
				</div>
			</div>
		<?php echo $this->Form->end(); ?>
		<?php echo $this->fetch('postLink'); ?>
	</div>
</div>