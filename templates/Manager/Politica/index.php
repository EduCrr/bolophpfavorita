<!-- START BREADCRUMB -->
<ul class="breadcrumb">
	<li>Política de privacidade</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">
	<h2><span class="fa fa-gavel"></span> Política de privacidade</h2>
</div>
<!-- END PAGE TITLE -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
	<?php echo $this->element('page_settings', [
		'pagina' => $pagina
	]); ?>

	<?php echo $this->element('form_content', [
		'conteudo' => $conteudos[0],
		'full' => false,
		'toolbar' => 'Bold,Italic,Link,Unlink,BulletedList,NumberedList',
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