<div class="row" id="conteudo_<?php echo $conteudo->id; ?>">
	<div class="col-md-12">
		<?php echo $this->Form->create($conteudo, ['url' => ['controller' => 'conteudos', 'action' => 'editar', $conteudo->id, '?' => $this->request->getQuery()], 'class' => 'form-horizontal', 'type' => 'file', 'novalidate' => true, 'templates' => ['inputContainer' => '{{content}}']]); ?>
		<?php echo $this->Form->control('id', ['type' => 'hidden']); ?>
			<div class="panel panel-default <?php echo $conteudo->parametro->minimizavel ? 'panel-toggled' : false; ?>">
				<div class="panel-heading">
					<div class="panel-title-box">
						<?php if ($conteudo->parametro->descricao) { ?>
						<h3><?php echo $conteudo->parametro->descricao; ?></h3>
						<?php } ?>
					</div>					

					<?php if ($conteudo->parametro->minimizavel) { ?>
					<ul class="panel-controls" style="margin-top: 2px;">
						<li><a href="javascript:void(0);" class="panel-collapse"><span class="fa fa-angle-up"></span></a></li>							
					</ul>
					<?php } ?>

					<?php if ($conteudo->parametro->galeria) {
						echo $this->Html->link('<i class="fa fa-image"></i> Imagens', ['controller' => 'imagens', 'action' => 'conteudo', $conteudo->id], ['escape' => false, 'class' => 'btn btn-primary pull-right']);
					} ?>
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

					<?php if ($conteudo->parametro->habilitar_subtitulo) { ?>
					<div class="form-group">
						<div class="<?php echo $full ? 'col-md-12 col-lg-12 col-sm-10 col-xs-12' : 'col-md-8 col-lg-8 col-sm-10 col-xs-12'; ?>">
							<label>Subtítulo</label>
							<div class="input-group">
								<span class="input-group-addon">
									<?php echo $this->Html->image('/admin/img/flags/br.png', ['style' => 'max-width: 20px;']); ?>
								</span>
								<?php echo $this->Form->control('subtitulo', ['type' => 'text', 'id' => "titulo-{$conteudo->id}", 'class' => 'form-control', 'label' => false]); ?>
							</div>
							<span class="help-block with-errors"></span>
						</div>
					</div>
					<?php } ?>

					<?php if ($conteudo->parametro->habilitar_texto) { ?>
					<div class="form-group">
						<div class="<?php echo $full ? 'col-md-12 col-lg-12 col-sm-10 col-xs-12' : 'col-md-8 col-lg-8 col-sm-10 col-xs-12'; ?>">
							<label><?php echo $this->Html->image('/admin/img/flags/br.png', ['style' => 'max-width: 30px; margin: -4px 5px 0 0', 'class' => 'img-thumbnail']); ?> Conteúdo</label>
							<?php echo $this->Form->control('texto', ['type' => 'textarea', 'id' => "texto-{$conteudo->id}", 'class' => 'form-control' . $conteudo->parametro->texto_formatado ? ' editor' : null, 'label' => false, 'data-toolbar' => $toolbar]); ?>
							<span class="help-block with-errors">Utilize CTRL (Command) + Enter para quebrar a linha. Utilize Enter para inserir um novo parágrafo.</span>
						</div>
					</div>
					<?php } ?>

					<?php if ($conteudo->parametro->habilitar_endereco) { ?>
					<div class="form-group">
						<div class="<?php echo $full ? 'col-md-12 col-lg-12 col-sm-10 col-xs-12' : 'col-md-6 col-lg-6 col-sm-10 col-xs-12'; ?>">
							<label>Link</label>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-globe"></i>
								</span>
								<?php echo $this->Form->control('endereco', ['type' => 'text', 'id' => "link-{$conteudo->id}", 'class' => 'form-control', 'label' => false]); ?>
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

					<?php if ($conteudo->parametro->habilitar_img) { ?>
					<div class="form-group">
						<div class="<?php echo $full ? 'col-md-12 col-lg-12 col-sm-10 col-xs-12' : 'col-md-8 col-lg-8 col-sm-10 col-xs-12'; ?>">
							<?php if ($conteudo->parametro->recortar_imagem) {
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
									<?php echo $this->Html->image(($conteudo->conteudos_idiomas ? '/content/display/' . $conteudo->conteudos_idiomas[0]->imagem : '/admin/img/others/select.png'), ['style' => 'width: auto; max-width: 100%;']); ?>
								</div>
								<div class="fileupload-preview fileupload-exists thumbnail" data-width="<?php echo $conteudo->parametro->largura_imagem; ?>" data-height="<?php echo $conteudo->parametro->altura_imagem; ?>" data-ratio="<?php echo var_export(boolval($conteudo->parametro->recortar_imagem)); ?>" data-crop="<?php echo var_export(boolval($conteudo->parametro->recortar_imagem)); ?>"></div>
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
									<?php if ($conteudo->parametro->recortar_imagem) { ?>
										A imagem deve ter no mínimo <b><?php echo $conteudo->parametro->largura_imagem; ?>px</b> de largura e <b><?php echo $conteudo->parametro->altura_imagem; ?>px</b> de altura.
									<?php } else { ?>
										A imagem deve ter no máximo <b><?php echo $conteudo->parametro->largura_imagem; ?>px</b> de largura e <b><?php echo $conteudo->parametro->altura_imagem; ?>px</b> de altura.
									<?php } ?>
								</span>
							</div>
						</div>
					</div>
					<?php } ?>

					<?php if ($conteudo->parametro->habilitar_video) { ?>
					<div class="form-group">
						<div class="<?php echo $full ? 'col-md-12 col-lg-12 col-sm-10 col-xs-12' : 'col-md-8 col-lg-8 col-sm-10 col-xs-12'; ?>">
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
				</div>
				<div class="panel-footer">
					<div class="col-md-12 col-xs-12">
						<?php echo $this->Form->button('<i class="fa fa-save"></i> Salvar', ['escapeTitle' => false, 'class' => 'btn btn-primary btn-rounded pull-right']); ?>
					</div>
				</div>
			</div>
		<?php echo $this->Form->end(); ?>
	</div>
</div>