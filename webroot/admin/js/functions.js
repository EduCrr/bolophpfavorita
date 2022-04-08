function alertSystem(type = 'success', title = "Feito!", mesage = '...', url = null, reload = true) {
	var classes, icon;
	switch(type) {
		case 'error':
			classes = 'message-box message-box-danger animated fadeIn';
			icon = 'fa fa-times';
			break;
		case 'warning':
			classes = 'message-box animated fadeIn';
			icon = 'fa fa-exclamation-triangle';
			break;
		default:
			classes = 'message-box message-box-success animated fadeIn';
			icon = 'fa fa-check';
			break;
	}

	$("#alert-system").attr('class', classes);
	$("#alert-system").find('.mb-title').find('span').text(title);
	$("#alert-system").find('.mb-title').find('i').attr('class', icon);

	$("#alert-system").find('.mb-content').find('p').text(mesage);

	$("#alert-system").addClass('open');

	$('#alert-system').find('button.mb-control-close').on('click', function () {
		if (reload) {
			if (!url && type == 'success') {
				location.reload();
			}
			else if (url) {
				window.open(url, '_self');
			}
		}
	});
}

function getQueryParams(qs) {
    qs = qs.split('+').join(' ');

    var params = {},
        tokens,
        re = /[?&]?([^=]+)=([^&]*)/g;

    while (tokens = re.exec(qs)) {
        params[decodeURIComponent(tokens[1])] = decodeURIComponent(tokens[2]);
    }

    return params;
}


$(function() {
	/* --- DEFAULTS --- */

	$('[data-toggle="tooltip"]').tooltip();
	
	if ($("form").length) {
		$("form").each(function() {
			$(this).get(0).reset();
		});
	}

	if ($(".select").length > 0) {
		$(".select").selectpicker("refresh");
	}

	if ($('.icheckbox').length > 0) {
		$('.icheckbox').iCheck('update');
	}
	if ($('.iradio').length > 0) {
		$('.iradio').iCheck('update');
	}

	/* --- / DEFAULTS --- */

	/* --- FILEUPLOAD --- */

	if ($('.fileupload').length) {
		var thumbs = new Array();
		$('.fileupload').fileupload().on('change.bs.fileupload', function(e) {
			onresize();

			thumb = $(this).find('.fileupload-preview');

			if (thumb && thumb.attr('data-crop') && JSON.parse(thumb.attr('data-crop'))) {
				rto = false;
				if (JSON.parse(thumb.attr('data-ratio'))) {
					var rto = parseInt(thumb.attr('data-width')) / parseInt(thumb.attr('data-height'));
				}

				thumb.find('img').cropper({
					aspectRatio: rto,
					viewMode: 3,
					zoomable: false,
					zoomOnWheel: false,
					zoomOnTouch: false,
					wheelZoomRatio: false,
					minCanvasWidth: 140,
					minCanvasHeight: 160,
					background: false,
					crop: function(data) {
						img = $(data.target).closest('.fileupload').find('input[type="file"]');
						
						$("."+img[0].id+".coord-x").val(data.detail.x);
						$("."+img[0].id+".coord-y").val(data.detail.y);
						$("."+img[0].id+".coord-w").val(data.detail.width);
						$("."+img[0].id+".coord-h").val(data.detail.height);
					},
				});
			}
		}).on('clear.bs.fileupload', function(e) {
			onresize();
		});
	}

	$(document).on('show.bs.modal', '.crop-modal', function () {
		$(".ordenable").sortable("disable");
		$(".ordenable-table").sortable("disable");

		var rto = parseInt($(this).find('img').attr('data-width')) / parseInt($(this).find('img').attr('data-height'));

		$(this).find('.crop-image').cropper({
			aspectRatio: rto,
			viewMode: 3,
			zoomable: false,
			zoomOnWheel: false,
			zoomOnTouch: false,
			wheelZoomRatio: false,
			minCanvasWidth: 140,
			minCanvasHeight: 160,
			background: false,
			crop: function(data) {
				form = $(data.target).closest('form');
				
				form.find(".coord-x").val(data.detail.x);
				form.find(".coord-y").val(data.detail.y);
				form.find(".coord-w").val(data.detail.width);
				form.find(".coord-h").val(data.detail.height);
			},
		});
	}).on('hide.bs.modal', function () {
		$(this).find('.crop-image').cropper("destroy");

		$(".ordenable").sortable("enable");
		$(".ordenable-table").sortable("enable");
	});

	/* --- / FILEUPLOAD --- */

	/* --- MASKS --- */

	if ($('input[class*="mask"]').length > 0) {
		
		$("input.mask-month").mask('00/0000', {
			clearIfNotMatch: false,
		});

		$("input.mask-date").mask('00/00/0000', {
			clearIfNotMatch: false,
		});

		$("input.mask-datetime").mask('00/00/0000 00:00', {
			clearIfNotMatch: false,
		});

		var SPMaskBehavior = function (val) {
			return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
		},
		spOptions = {
			onKeyPress: function(val, e, field, options) {
				field.mask(SPMaskBehavior.apply({}, arguments), options);
			}
		};
		$('input.mask-phone').mask(SPMaskBehavior, spOptions);

		$("input.mask-cpf").mask('000.000.000-00', {
			clearIfNotMatch: false,
		});

		$("input.mask-cnpj").mask('00.000.000/0000-00', {
			clearIfNotMatch: false,
		});

		$("input.mask-zip-code").mask('00000-000');

		$("input.mask-number").mask('0#');

		$('input.mask-number-float').mask("0zzzzzzz,zz", {
			reverse: false,
			clearIfNotMatch: false,
			translation: {
				'z': {
					pattern: /[0-9]/,
					optional: true
				}
			}
		});

		$('input.mask-long-number-float').mask("0zzzzzzzzzz,zzz", {
			reverse: false,
			clearIfNotMatch: false,
			translation: {
				'z': {
					pattern: /[0-9]/,
					optional: true
				}
			}
		});

		$('input.mask-short-number-float').mask("0zzzzzzzzzz,z", {
			reverse: false,
			clearIfNotMatch: false,
			translation: {
				'z': {
					pattern: /[0-9]/,
					optional: true
				}
			}
		});
	}

	/* --- / MASKS --- */

	/* --- CKEDITOR --- */

	var defaultToolbar = ('Bold,Italic,Cut,Copy,Paste,Anchor,Underline,Strike,Subscript,Superscript,Table,Outdent,Indent,Anchor,Font,NumberedList,BulletedList,JustifyLeft,JustifyCenter,JustifyRight,JustifyBlock,Link,Unlink,Image,FontSize,TextColor,BGColor,Youtube,Format').split(',');

	if ($(".editor").length) {
		$(".editor").each(function() {
			var that = this;

			var toolbar = $(that).data('toolbar') ? $(that).data('toolbar').split(',') : [];
			var removeButtons = defaultToolbar.filter(x => !toolbar.includes(x)).join(',');

			CKEDITOR.timestamp = 'v011';
			CKEDITOR.replace($(that).attr('id'), {
				wordcount: {
					showParagraphs: false, // Whether or not you want to show the Word Count
					showWordCount: true, // Whether or not you want to show the Char Count
					showCharCount: true, // Whether or not you want to count Spaces as Chars
					countSpacesAsChars: true, // Whether or not to include Html chars in the Char Count
					countHTML: false, // Maximum allowed Word Count, -1 is default for unlimited
					maxWordCount: -1, // Maximum allowed Char Count, -1 is default for unlimited
					maxCharCount: (typeof $(this).attr('maxlength') == 'string') ? $(this).attr('maxlength') : -1,
				},
				removeButtons: removeButtons,
			});
			CKEDITOR.add;
			CKEDITOR.on('instanceReady', function(){
				onresize();
			});
		});
	}

	if ($(".inline-editor").length) {
		$(".inline-editor").each(function(){
			var that = this;

			var toolbar = $(that).data('toolbar') ? $(that).data('toolbar').split(',') : [];
			var removeButtons = defaultToolbar.filter(x => !toolbar.includes(x)).join(',');

			CKEDITOR.inline($(that).attr('id'),{
				wordcount: {
					showParagraphs: false, // Whether or not you want to show the Word Count
					showWordCount: false, // Whether or not you want to show the Char Count
					showCharCount: false, // Whether or not you want to count Spaces as Chars
					countSpacesAsChars: false, // Whether or not to include Html chars in the Char Count
					countHTML: false, // Maximum allowed Word Count, -1 is default for unlimited
					maxWordCount: -1, // Maximum allowed Char Count, -1 is default for unlimited
					maxCharCount: (typeof $(this).attr('maxlength') == 'string') ? $(this).attr('maxlength') : -1,
				},
				removeButtons: 'Sourcedialog,' + removeButtons,
				autoParagraph: false,
				enterMode: CKEDITOR.ENTER_BR,
				shiftEnterMode: CKEDITOR.ENTER_BR,
				coreStyles_bold: {
    				element: 'b',
    			},
    			disallowedContent: 'br',
			});
			CKEDITOR.add;
			CKEDITOR.on('instanceReady', function(){
				onresize();
			});
		});
	}

	/* --- / CKEDITOR --- */

	/* --- SENDER FORM --- */

	var sending = false;
	$(document).on('submit', 'form', function(event) {
		if (!$(this).hasClass('no-ajax')) {
			event.preventDefault();
			
			var that  = this;

			if (!sending) {
				if (typeof CKEDITOR != 'undefined') {
					for (instance in CKEDITOR.instances) {
						CKEDITOR.instances[instance].updateElement();
					}
				}

				sending = true;
				var formData = new FormData(this);

				var oldPercent = 0;
				
				$.ajax({
					url: $(that).attr('action'),
					type: 'POST',
					data: formData,
					cache: false,
					contentType: false,
					processData: false,
					beforeSend: function() {
						$.mpb('show', {value: [0,0], speed: 10, state: 'success'});
					},
					xhr: function() {
						var myXhr = $.ajaxSettings.xhr();
						if (myXhr.upload) {
							myXhr.upload.addEventListener('progress', function (e) {
								if (e.lengthComputable) {
									var percentComplete = e.loaded / e.total;
									$.mpb('update',{value: [oldPercent, Math.round(percentComplete * 100)],speed: 5});
									oldPercent = Math.round(percentComplete * 100);
								}
							}, false);
						}
						return myXhr;
					},
					success: function (data) {
						// $("html").html(data);
						console.log(data);
						
						if (data) {
							alertSystem(data.type, data.title, data.msg, data.url);

							if (data.type == 'success') {
								if($(".icheckbox").length > 0) {
									$('.icheckbox').iCheck('update');
								}

								if($(".iradio").length > 0) {
									$('.iradio').iCheck('update');
								}
							}

							$.mpb('destroy');
							oldPercent = 0;
							sending = false;
						}
					},
					error: function (data) {
						console.log(data);
						sending = false;
					}
				});
			}
		}
	});

	/* --- / SENDER FORM --- */

	/* --- VISIBILITY --- */

	$(document).on('change', 'form.visibilidade', function() {
		var formData = new FormData(this);
		var that = this;
		var oldPercent = 0;

		$.ajax({
			url: $(that).attr('action'),
			type: 'POST',
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function() {
				$.mpb('show', {value: [0,0], speed: 10, state: 'success'});
			},
			xhr: function() {
				var myXhr = $.ajaxSettings.xhr();
				if (myXhr.upload) {
					myXhr.upload.addEventListener('progress', function (e) {
						if (e.lengthComputable) {
							var percentComplete = e.loaded / e.total;
							$.mpb('update',{value: [oldPercent, Math.round(percentComplete * 100)],speed: 5});
							oldPercent = Math.round(percentComplete * 100);
						}
					}, false);
				}
				return myXhr;
			},
			success: function (data) {
				if (data) {
					// data = JSON.parse(data);

					$(that).find('input[type="checkbox"]').prop('checked', data.type ==  'success' ? !!(data.active) : !(data.active));

					$.mpb('destroy');
					oldPercent = 0;
				}
			},
			error: function(data) {
				console.log(data);
			}
		});
	});

	/* --- DATETIMEPICKER --- */

	if ($('.datetime-picker').length > 0) {
		$('.datetime-picker').datetimepicker({
			locale: 'pt-br',
			// minDate: currentDate(),
			showClose: true,
			showTodayButton: true,
			showClear: true,
			icons: {
				close: 'fa fa-check'
			},
		});
	}

	if ($('.date-picker').length > 0) {
		$('.date-picker').datetimepicker({
			locale: 'pt-br',
			format: 'DD/MM/YYYY',
			// minDate: currentDate(),
			showClose: true,
			showTodayButton: true,
			showClear: true,
			icons: {
				close: 'fa fa-check'
			},
		});
	}

	if ($('.month-picker').length > 0) {
		$('.month-picker').datetimepicker({
			locale: 'pt-br',
			format: 'MM/YYYY',
			// minDate: currentDate(),
			showClose: true,
			showTodayButton: false,
			showClear: true,
			icons: {
				close: 'fa fa-check'
			},
		});
	}

	/* --- / DATETIMEPICKER --- */

	/* --- / VISIBILITY --- */

	// $(".programing-form").each(function(){
	// 	$(this).find("input").datetimepicker({
	// 		locale: 'pt-br',
	// 		// minDate: currentDate(),
	// 		showClose: true,
	// 		showTodayButton: true,
	// 		showClear: true,
	// 		icons: {
	// 			close: 'fa fa-check'
	// 		}
	// 	}).on('blur', function(){
	// 		$.ajax({
	// 			url: $(this).closest('form').attr('action'),
	// 			type: $(this).closest('form').attr('method'),
	// 			data: $(this).closest('form').serialize(),
	// 			beforeSend: function(){
	// 			},
	// 			success: function(data){
	// 				if (data) {
	// 					console.log(data);
	// 					data = JSON.parse(data);
	// 					alertSystem(data.type, data.title, data.msg);
	// 				}
	// 				else {
	// 					alertSystem('error', 'Oops...', 'Ocorreu um erro. Tente novamente mais tarde.');
	// 				}
	// 			},
	// 		});
	// 	});
	// });

	/* --- INPUT-COUNTER --- */

	if ($(".input-counter").length) {
		$(".input-counter").each(function() {
			$(this).characterCounter({
				counterWrapper: 'span',
				counterCssClass: 'input-counter',
				increaseCounting: true,
				limit: false,
			});
		});
	}

	/* --- / INPUT-COUNTER --- */

	/* --- MULTISELECT --- */

	if ($(".multiselect").length) {
		$('.multiselect').multiSelect({
			selectableHeader: '<input type="text" class="search-input form-control form-control-xs push-down-5" autocomplete="off" placeholder="Pesquisar..."> <div style="background: #f5f5f5; padding: 5px 10px; margin: 0 0 -1px 0; border: 1px solid #ccc; border-radius: 4px 4px 0 0; color: #7f7f7f;">Itens selecionáveis</div>',
			selectionHeader: '<input type="text" class="search-input form-control push-down-5" autocomplete="off" placeholder="Pesquisar..."> <div style="background: #f5f5f5; padding: 5px 10px; margin: 0 0 -1px 0; border: 1px solid #ccc; border-radius: 4px 4px 0 0; color: #7f7f7f;">Itens selecionados</div>',
			afterInit: function(ms){
				var that = this,
				$selectableSearch = that.$selectableUl.prev(),
				$selectionSearch = that.$selectionUl.prev(),
				selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
				selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

				that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
				.on('keydown', function(e){
					if (e.which === 40){
						that.$selectableUl.focus();
						return false;
					}
				});

				that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
				.on('keydown', function(e){
					if (e.which == 40){
						that.$selectionUl.focus();
						return false;
					}
				});
			},
			afterSelect: function(){
				this.qs1.cache();
				this.qs2.cache();
			},
			afterDeselect: function(){
				this.qs1.cache();
				this.qs2.cache();
			}
		});
	}

	/* --- / MULTISELECT --- */
});