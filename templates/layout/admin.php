<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<base href="<?php echo $this->Url->build('/', ['fullBase' => true]); ?>">

		<!-- META SECTION -->
		<?php echo $this->Html->charset('utf-8'); ?>
		<?php echo $this->Html->meta(['http-equiv' => 'X-UA-Compatible', 'content' => 'IE=edge']); ?>
		<?php echo $this->Html->meta(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1']); ?>

		<title>Favorita | Manager</title>

		<?php echo $this->Html->meta('favicon.ico', '/favicon.ico', ['type' => 'icon']); ?>

		<?php echo $this->Html->meta('robots', 'noindex, nofollow'); ?>
		<!-- END META SECTION -->

		<!-- CSS INCLUDE -->
		<?php echo $this->Html->css([
			'/admin/css/theme-default.css',
			'/admin/css/custom.css',
		]); ?>
		<!-- EOF CSS INCLUDE -->

		<style type="text/css">
			.tooltip-inner {
				word-wrap: break-word;
				white-space: pre-line;
			}
		</style>
	</head>
	<body>
		<!-- START PAGE CONTAINER -->
		<div class="page-container">

			<!-- START PAGE SIDEBAR -->
			<div class="page-sidebar">
				<!-- START X-NAVIGATION -->
				<ul class="x-navigation">
					<li class="xn-logo">
						<?php echo $this->Html->link('Favorita', ['controller' => 'home', 'action' => 'index']); ?>
						<?php echo $this->Html->link('Menu', 'javascript:void(0);', ['class' => 'x-navigation-control']); ?>
					</li>
					<li class="<?php echo in_array($this->name, ['Home', 'Slides', 'Destaques']) ? 'active' : null; ?>">
						<?php echo $this->Html->link('<span class="fa fa-home"></span> <span class="xn-text">Home</span>', ['controller' => 'home', 'action' => 'index'], ['escape' => false]); ?>
					</li>
					<li class="<?php echo in_array($this->name, ['Sobre']) ? 'active' : null; ?>">
						<?php echo $this->Html->link('<span class="fa fa-info-circle"></span> <span class="xn-text">Sobre</span>', ['controller' => 'sobre', 'action' => 'index'], ['escape' => false]); ?>
					</li>
					<li class="<?php echo in_array($this->name, ['Ambientes']) ? 'active' : null; ?>">
						<?php echo $this->Html->link('<span class="fa fa-bed"></span> <span class="xn-text">Ambientes</span>', ['controller' => 'ambientes', 'action' => 'index'], ['escape' => false]); ?>
					</li>
					<li class="<?php echo in_array($this->name, ['Blog']) ? 'active' : null; ?>">
						<?php echo $this->Html->link('<span class="fa fa-newspaper-o"></span> <span class="xn-text">Blog</span>', ['controller' => 'blog', 'action' => 'index'], ['escape' => false]); ?>
					</li>					
					<li class="<?php echo in_array($this->name, ['Politica']) ? 'active' : null; ?>">
						<?php echo $this->Html->link('<span class="fa fa-gavel"></span> <span class="xn-text">Política de privacidade</span>', ['controller' => 'politica', 'action' => 'index'], ['escape' => false]); ?>
					</li>
					<li class="<?php echo in_array($this->name, ['Downloads']) ? 'active' : null; ?>">
						<?php echo $this->Html->link('<span class="fa fa-arrow-down"></span> <span class="xn-text">Downloads</span>', ['controller' => 'downloads', 'action' => 'index'], ['escape' => false]); ?>
					</li>
				</ul>
				<!-- END X-NAVIGATION -->
			</div>
			<!-- END PAGE SIDEBAR -->

			<!-- PAGE CONTENT -->
			<div class="page-content" style="padding-bottom: 50px;">
				<!-- START X-NAVIGATION VERTICAL -->
				<ul class="x-navigation x-navigation-horizontal x-navigation-panel">
					<!-- TOGGLE NAVIGATION -->
					<li class="xn-icon-button">
						<?php echo $this->Html->link('<span class="fa fa-dedent"></span>', 'javascript:void(0);', ['escape' => false, 'target' => '_blank', 'class' => 'x-navigation-minimize']); ?>
					</li>

					<li class="xn-icon-button">
						<?php echo $this->Html->link('<span class="fa fa-play"></span>', ['controller' => 'home', 'action' => 'index', 'prefix' => false], ['escape' => false, 'target' => '_blank']); ?>
					</li>
					<!-- END TOGGLE NAVIGATION -->
					
					<!-- POWER OFF -->
					<li class="xn-icon-button pull-right last">
						<a href="javascript:void(0);"><span class="fa fa-power-off"></span></a>
						<ul class="xn-drop-left animated zoomIn">
							<li>
								<?php echo $this->Html->link('<span class="fa fa-sign-out"></span> Sair', 'javascript:void(0);', ['escape' => false, 'class' => 'mb-control', 'data-box' => '#mb-signout']); ?>
							</li>
						</ul>
					</li> 
					<!-- END POWER OFF -->

					<?php /* 
					<!-- MESSAGES -->
					<li class="xn-icon-button pull-right">
						<?php echo $this->Html->link('<span class="fa fa-address-book"></span>', 'javascript:void(0);', ['escape' => false]); ?>
						<?php if ($novosCurriculos) { ?>
							<div class="informer informer-danger"><?php echo count($novosCurriculos); ?></div>
						<?php } ?>
						<div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
							<div class="panel-heading">
								<h3 class="panel-title"><span class="fa fa-address-book"></span> Currículos</h3>
								<div class="pull-right">
									<?php if ($novosCurriculos) { ?>
										<span class="label label-danger"><?php echo count($novosCurriculos); ?> novo(s)</span>
									<?php } ?>
								</div>
							</div>
							<div class="panel-body list-group list-group-contacts scroll" style="max-height: 200px;">
								<?php if ($novosCurriculos) { ?>
									<?php foreach ($novosCurriculos as $key => $value) {
										echo $this->Html->link('<span class="contacts-title">'.$value['Curriculo']['nome'].'</span> <p>'.$value['Curriculo']['email'].'</p>', ['controller' => 'curriculos', 'action' => 'visualizar', $value['Curriculo']['id']], ['escape' => false, 'class' => 'list-group-item']);
									} ?>
								<?php } else { ?>
									<div class="list-group-item">
										<p class="text-center">Não há nenhum novo currículo.</p>
									</div>
								<?php } ?>
							</div>
							<div class="panel-footer text-center">
								<?php echo $this->Html->link('Ver todos', ['controller' => 'curriculos', 'action' => 'index'], ['class' => 'btn btn-sm btn-primary col-md-12']); ?>
							</div>
						</div>
					</li>
					<!-- END MESSAGES -->
					
					<!-- MESSAGES -->
					<li class="xn-icon-button pull-right">
						<?php echo $this->Html->link('<span class="fa fa-phone"></span>', 'javascript:void(0);', ['escape' => false]); ?>
						<?php if ($novosContatos) { ?>
							<div class="informer informer-danger"><?php echo count($novosContatos); ?></div>
						<?php } ?>
						<div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
							<div class="panel-heading">
								<h3 class="panel-title"><span class="fa fa-phone"></span> Contatos</h3>
								<div class="pull-right">
									<?php if ($novosContatos) { ?>
										<span class="label label-danger"><?php echo count($novosContatos); ?> novo(s)</span>
									<?php } ?>
								</div>
							</div>
							<div class="panel-body list-group list-group-contacts scroll" style="max-height: 200px;">
								<?php if ($novosContatos) { ?>
									<?php foreach ($novosContatos as $key => $value) {
										echo $this->Html->link('<span class="contacts-title">'.$value['Contato']['nome'].'</span> <p>'.$value['Contato']['email'].'</p>', ['controller' => 'contato', 'action' => 'visualizar', $value['Contato']['id']], ['escape' => false, 'class' => 'list-group-item']);
									} ?>
								<?php } else { ?>
									<div class="list-group-item">
										<p class="text-center">Não há nenhum novo contato.</p>
									</div>
								<?php } ?>
							</div>
							<div class="panel-footer text-center">
								<?php echo $this->Html->link('Ver todos', ['controller' => 'contato', 'action' => 'index'], ['class' => 'btn btn-sm btn-primary col-md-12']); ?>
							</div>
						</div>
					</li>
					<!-- END MESSAGES -->

					<!-- MESSAGES -->
					<li class="xn-icon-button pull-right">
						<?php echo $this->Html->link('<span class="fa fa-at"></span>', 'javascript:void(0);', ['escape' => false]); ?>
						<?php if ($novasNews) { ?>
							<div class="informer informer-danger"><?php echo count($novasNews); ?></div>
						<?php } ?>
						<div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
							<div class="panel-heading">
								<h3 class="panel-title"><span class="fa fa-at"></span> Newsletters</h3>
								<div class="pull-right">
									<?php if ($novasNews) { ?>
										<span class="label label-danger"><?php echo count($novasNews); ?> nova(s)</span>
									<?php } ?>
								</div>
							</div>
							<div class="panel-body list-group list-group-contacts scroll" style="max-height: 200px;">
								<?php if ($novasNews) { ?>
									<?php foreach ($novasNews as $key => $value) { ?>
										<div class="list-group-item">
											<p class="contacts-title"><?php echo $value['Newsletter']['nome']; ?></p>
											<p><?php echo $value['Newsletter']['email']; ?></p>
										</div>
									<?php } ?>
								<?php } else { ?>
									<div class="list-group-item">
										<p class="text-center">Não há nenhuma nova assinatura.</p>
									</div>
								<?php } ?>
							</div>
							<div class="panel-footer text-center">
								<?php if ($novasNews) {
									echo $this->Html->link('Exportar novas incrições', ['controller' => 'newsletter', 'action' => 'novas', 'ext' => 'csv'], ['class' => 'btn btn-sm btn-primary col-md-12']);
								} else {
									echo $this->Html->link('Exportar todas incrições', ['controller' => 'newsletter', 'action' => 'todas', 'ext' => 'csv'], ['class' => 'btn btn-sm btn-primary col-md-12']);
								} ?>
							</div>
						</div>
					</li>
					<!-- END MESSAGES -->
					*/ ?>
				</ul>
				<!-- END X-NAVIGATION VERTICAL -->

				<?php echo $this->fetch('content'); ?>

			</div>
			<!-- END PAGE CONTENT -->
		</div>
		<!-- END PAGE CONTAINER -->

		<!-- MESSAGE BOX-->
		<div class="message-box animated fadeIn" id="mb-signout">
			<div class="mb-container">
				<div class="mb-middle">
					<div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
					<div class="mb-content">
						<p>Tem certeza que deseja sair?</p>
						<p>Pressione [Não] se quiser continuar o trabalho. Pressione [Sim] para sair do usuário atual.</p>
					</div>
					<div class="mb-footer">
						<div class="pull-right">
							<?php echo $this->Html->link('Sim', array('controller' => 'usuarios', 'action' => 'logout'), array('class' => 'btn btn-success btn-lg')); ?>
							<button class="btn btn-default btn-lg mb-control-close">Não</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END MESSAGE BOX-->

		<div class="message-box animated fadeIn" id="alert-system">
			<div class="mb-container">
				<div class="mb-middle">
					<div class="mb-title"><i class=""></i> <b><span></span></b></div>
					<div class="mb-content">
						<p></p>
					</div>
					<div class="mb-footer">
						<button class="btn btn-default pull-right mb-control-close">Fechar</button>
					</div>
				</div>
			</div>
		</div>

		<?php echo $this->Html->scriptBlock(sprintf(
			'var csrfToken = %s;',
			json_encode($this->request->getAttribute('csrfToken'))
		)); ?>

		<!-- START SCRIPTS -->

		<!-- START PLUGINS -->
		<?php echo $this->Html->script([
			'/admin/js/plugins/jquery/jquery.min.js',
			'/admin/js/plugins/jquery/jquery-ui.min.js',
			'/admin/js/plugins/bootstrap/bootstrap.min.js',
			'/admin/js/plugins/jquery/jquery-migrate.min.js',
		]); ?>
		<!-- END PLUGINS -->

		<!-- START THIS PAGE PLUGINS-->
		<?php echo $this->Html->script([
			'/admin/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js',
			// '/admin/js/plugins/icheck/icheck.min.js',
			// '/admin/js/plugins/bootstrap/bootstrap-file-input.js',
			// '/admin/js/plugins/form/jquery.form.js',
			// '/admin/js/plugins/cropper/cropper.js',
			// '/admin/js/plugins/cropper/jquery-cropper.js',
			// '/admin/js/plugins/bootstrap/bootstrap-datepicker.js',
			// '/admin/js/plugins/bootstrap/bootstrap-datepicker.pt-br.js',
			// '/admin/js/plugins/moment.min.js',
			// '/admin/js/plugins/daterangepicker/daterangepicker.js',
			// '/admin/js/plugins/bootstrap-select/bootstrap-select.js',
			// '/admin/js/plugins/bootstrap-fileupload/bootstrap-fileupload.js',
			// '/admin/js/plugins/datatables/jquery.dataTables.min.js',
			// '/admin/js/plugins/jquery-mask/jquery.mask.js',
			// '/admin/js/plugins/tocify/jquery.tocify.min.js',
			// '/admin/js/plugins/ckeditor/ckeditor.js',
			// '/admin/js/plugins/bootstrap/bootstrap-colorpicker.js',
			// '/admin/js/plugins/colorpicker/wcolpick.js',
			// '/admin/js/plugins/bootstrap-datetimepicker/locales.js',
			// '/admin/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.js',
			// '/admin/js/plugins/bootstrap-fileinput-master/fileinput.js',
			// '/admin/js/plugins/bootstrap-fileinput-master/locales/pt-BR.js',
			// '/admin/js/plugins/charactercounter/jquery.charactercounter.js',
			// '/admin/js/plugins/bootstrap-typeahead/bootstrap-typeahead.js',
			// '/admin/js/plugins/typeahead/typeahead.jquery.min.js',
			// '/admin/js/plugins/typeahead/bloodhound.min.js',
			// '/admin/js/portlet.js',
		]); ?>

		<?php echo $this->fetch('scripts'); ?>
		<!-- END THIS PAGE PLUGINS-->

		<!-- START TEMPLATE -->
		<?php echo $this->Html->script([
			'/admin/js/settings.js',
			'/admin/js/plugins.js',
			'/admin/js/actions.js',
			'/admin/js/functions.js',
			// '/admin/js/fileinput-init.js',
		]); ?>
		<!-- END TEMPLATE -->

		<?php echo $this->fetch('dropzone'); ?>
		<!-- END SCRIPTS -->		
	</body>
</html>