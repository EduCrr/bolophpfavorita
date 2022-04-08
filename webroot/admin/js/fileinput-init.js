$(function(){
	var galeria = $("#images"), initPluginFiles = function(){

		window.errors = 0;
		window.successes = 0;

		galeria.fileinput({
			uploadExtraData: function() {
				return {
					'data[ImagemTrabalho][colunas]': $("#img_grid_configuration").val(),
				};
			},
			uploadAsync: true,
			uploadUrl: $("#images").closest("form").attr('action'), // You must set a valid URL here else you will get an error
			language: 'pt-BR',
			allowedFileExtensions : ['png', 'jpg', 'jpeg', 'gif'],
			dropZoneEnabled: true,
		});
	}

	initPluginFiles();

	$("#img_grid_configuration").on("change", function() {
		galeria.fileinput('refresh', {
			uploadExtraData: function() {
				return {
					'data[ImagemTrabalho][colunas]': $("#img_grid_configuration").val(),
				};
			},
		});
	});

	$('#images').on('fileuploaded', function(event, data, previewId, index) {
		if (data.response && data.response.status == 'success') {
			if ($("#alert-img-not-found").length) {
				$("#alert-img-not-found").remove();
			}

			// $("#imagens").append(
			// 	'<div class="thumbnail" id="odr_'+data.response.id+'">'+
			// 		'<div class="preview">'+
			// 			'<div class="image" style="background-image: url('+data.response.img+')">'+
			// 			'</div>'+
			// 		'</div>'+
			// 		'<div class="clearfix">'+
			// 			'<a href="'+data.response.excluir+'" class="btn btn-danger pull-right excluir"><span class="fa fa-trash-o"></span></a>'+
			// 		'</div>'+
			// 	'</div>'
			// );
			successes++;
		}
		else {
			errors++;
		}
	});

	$('#images').on('filebatchuploadcomplete', function(event, files, extra) {
		if (errors) {
			// swal({
			// 	// title: 'Oops..',
			// 	// text: ((errors + successes > 1)?errors+' de suas imagens não '+((errors == 1)?'pôde':'puderam')+' ser '+((errors == 1)?'adicionada':'adicionadas')+'.':'Sua imagem não pode ser adicionada.')+' Verifique se você já antigiu o limite de 10 imagens permitidas.',
			// 	// type: 'error',
			// 	// confirmButtonColor: '#27313d',
			// 	// cancelButtonColor: '#6e7e90',
			// 	// showCloseButton: true,
			// }).then(function(){
				
			// }).catch(function(){

			// });
			url = $(location).attr('href');
			alertSistem('error', 'Oops..', ((errors + successes > 1)?errors+' de suas imagens não '+((errors == 1)?'pôde':'puderam')+' ser '+((errors == 1)?'adicionada':'adicionadas')+'.':'Sua imagem não pode ser adicionada.')+' Verifique se você já antigiu o limite de 10 imagens permitidas.', url);
		}
		else{
			location.reload();
		}

		galeria.fileinput('destroy');
		$("#images").closest("form").val("");
		initPluginFiles();
	});
});