<!DOCTYPE html>
<html lang="pt-br" class="body-full-height">
	<head>
		<!-- META SECTION -->
		<?php echo $this->Html->meta('viewport', 'width=device-width, initial-scale=1, user-scalable=0, shrink-to-fit=no'); ?>

		<?php echo $this->Html->charset('utf-8'); ?>

		<title>Favorita</title>
		
		<?php echo $this->Html->meta('favicon.ico', '/favicon.ico', ['type' => 'icon']); ?>

		<?php echo $this->Html->meta('robots', 'noindex, nofollow'); ?>
		<!-- END META SECTION -->

		<!-- CSS INCLUDE -->
		<?php echo $this->Html->css([
			'/admin/css/theme-default.css'
		]); ?>
		<!-- EOF CSS INCLUDE -->
	</head>
	<body>

		<?php echo $this->fetch('content'); ?>

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

		<?php echo $this->Html->script([
			'/admin/js/plugins/jquery/jquery.min.js',
			'/admin/js/plugins/jquery/jquery-ui.min.js',
			'/admin/js/plugins/bootstrap/bootstrap.min.js',
			'/admin/js/plugins/bootstrap/validator.min.js',
			'/admin/js/plugins.js',
		]); ?>

		<script>
			if ($("form").length) {
				$("form").each(function() {
					$(this).get(0).reset();
				});
			}
		</script>
	</body>
</html>