<div class="gallery-item" id="odr_<?php echo $imagem->id; ?>">
	<div class="image">
		<?php echo $this->Html->image('/content/ambients/gallery/s/' . $imagem->nome); ?>
		<ul class="gallery-item-controls">
			<li>
				<?php echo $this->Form->create($imagem, ['url' => ['controller' => 'imagens', 'action' => 'visibilidade', $imagem->id], 'class' => 'pull-left visibilidade', 'type' => 'file']); ?>
					<label class="switch switch-small" style="margin-top: 4px; transform: scale(-.8);">
						<?php echo $this->Form->checkbox('visivel', ['hiddenField' => true, 'value' => $imagem->id, 'checked' => $imagem->visivel]); ?>
						<span></span>
					</label>
				<?php echo $this->Form->end(); ?>
			</li>
			<li><?php echo $this->Html->link('<i class="fa fa-crop"></i>', 'javascript:void(0);', ['escape' => false, 'data-toggle' => 'modal', 'data-target' => '#modal-crop-photo-' . $imagem->id]); ?></li>
			<li><?php echo $this->Html->link('<i class="fa fa-trash"></i>', 'javascript:void(0);', ['escape' => false, 'class' => 'mb-control', 'data-box' => '#delete-image-' . $imagem->id]); ?></li>
		</ul>
	</div>
	<div class="push-up-5">
		<?php echo $this->Form->create($imagem, ['url' => ['controller' => 'imagens', 'action' => 'editar', $imagem->id], 'type' => 'file', 'class' => 'form-horizontal', 'novalidate' => true, 'templates' => ['inputContainer' => '{{content}}']]); ?>
		<div class="form-group">
			<div class="input-group input-group-sm">
				<?php echo $this->Form->control('categoria', [
						'type' => 'select',
					'options' => [
						-1 => 'Selecione a categoria',
						'natural' => 'Natural',
						'moderno' => 'Moderno',
						'classico' => 'Clássico',
						'vintage' => 'Vintage',
						'industrial' => 'Industrial'
					],
					'multiple' => false,
					'disabled' => [-1],
					'default' => [-1],
					'class' => 'form-control ',
					'label' => false,
				]); ?>
				<span class="input-group-btn">
					<?php echo $this->Form->button('<i class="fa fa-save"></i>', ['escapeTitle' => false, 'type' => 'submit', 'class' => 'btn btn-primary btn-sm']); ?>
				</span>
			</div>
		</div>
		<?php echo $this->Form->end(); ?>
	</div>

	<div class="modal animated fadeIn crop-modal" id="modal-crop-photo-<?php echo $imagem->id; ?>" tabindex="-1" role="dialog" aria-labelledby="smallModalHead" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<?php echo $this->Form->create($imagem, ['url' => ['controller' => 'imagens', 'action' => 'cortar', $imagem->id, 'atualiza' => true], 'type' => 'file', 'novalidate' => true]); ?>
				<?php
				$this->Form->unlockFields('coordenadas.desktop.x');
				$this->Form->unlockFields('coordenadas.desktop.y');
				$this->Form->unlockFields('coordenadas.desktop.w');
				$this->Form->unlockFields('coordenadas.desktop.h');
				echo $this->Form->control('coordenadas.desktop.x', ['type' => 'hidden', 'value' => "", 'class' => 'coord-x']);
				echo $this->Form->control('coordenadas.desktop.y', ['type' => 'hidden', 'value' => "", 'class' => 'coord-y']);
				echo $this->Form->control('coordenadas.desktop.w', ['type' => 'hidden', 'value' => "", 'class' => 'coord-w']);
				echo $this->Form->control('coordenadas.desktop.h', ['type' => 'hidden', 'value' => "", 'class' => 'coord-h']);
				?>

				<div class="modal-header">
					<?php echo $this->Html->link('<span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span>', 'javascript:void(0);', array('escape' => false, 'class' => 'close', 'data-dismiss' => 'modal')); ?>
					<h4 class="modal-title" id="smallModalHead">Cortar foto</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<?php echo $this->Html->image('/content/ambients/gallery/b/' . $imagem->nome, ['class' => 'crop-image img-thumbnail', 'data-width' => '480', 'data-height' => '680']); ?>
					</div>
				</div>

				<div class="modal-footer">
					<?php echo $this->Form->button('<i class="fa fa-save"></i> Salvar', ['type' => 'submit', 'escapeTitle' => false, 'class' => 'btn btn-success']); ?>
					<?php echo $this->Html->link('Fechar', 'javascript:void(0);', ['escape' => false, 'class' => 'btn btn-default', 'data-dismiss' => 'modal']); ?>
				</div>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>

	<!-- MESSAGE BOX-->
	<div class="message-box animated fadeIn message-box-warning" id="delete-image-<?php echo $imagem->id; ?>">
		<div class="mb-container">
			<div class="mb-middle">
				<div class="mb-title"><span class="fa fa-warning"></span> Excluir?</div>
				<div class="mb-content">
					<p>Tem certeza que deseja excluir? Isso não poderá ser desfeito.<br>Pressione [Não] se quiser cancelar a operação. Pressione [Sim] para excluir o registro.</p>
				</div>
				<div class="mb-footer">
					<div class="pull-right">
						<?php echo $this->Form->postLink('Sim', ['controller' => 'imagens', 'action' => 'excluir', $imagem->id], ['class' => 'btn btn-primary btn-lg']); ?>
						<button class="btn btn-default btn-lg mb-control-close">Não</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END MESSAGE BOX-->
</div>