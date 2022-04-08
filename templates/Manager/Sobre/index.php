<!-- START BREADCRUMB -->
<ul class="breadcrumb">
	<li>Sobre</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
	<h2><span class="fa fa-info-circle"></span> Sobre</h2>

</div>
<!-- END PAGE TITLE -->

<!-- PAGE CONTENT WRAPPER -->
<div /* class="page-content-wrap">
	<?php echo $this->element('page_settings', [
		'pagina' => $pagina,
	]); ?>

	<div class="row">
		
		<?php echo $this->cell('FormContent', [
			'conteudo' => $conteudos[0],
			'toolbar' => ['Bold,Italic'],
			'full' => false,
		]); ?>

		<?php echo $this->cell('FormContent', [
			'conteudo' => $conteudos[1],
			'toolbar' => ['Bold,Italic,Underline,Strike,Subscript,BulletedList'],
			'full' => false,
		]); ?>
			<?php echo $this->cell('FormContent', [
			'conteudo' => $conteudos[2],
			'toolbar' => ['Bold,Italic,Underline,Strike,Subscript,BulletedList'],
			'full' => false,
		]); ?>
		
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