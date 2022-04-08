$(function() {
	$(".ordenable").sortable({
		placeholder: "scPlaceholder",
		start: function(event,ui) {
			console.log(parseInt(ui.item.css('padding-left')));
			$(".scPlaceholder").width(ui.item.width() - 2);
			$(".scPlaceholder").height(ui.item.height() - 2);
			$(".scPlaceholder").css({
				'margin-top': parseInt(ui.item.css('margin-top')),
				'margin-left': parseInt(ui.item.css('padding-left')),
				'margin-bottom': parseInt(ui.item.css('margin-bottom')),
				'margin-right': parseInt(ui.item.css('padding-right')),
				'padding-top': parseInt(ui.item.css('padding-top')),
				'padding-right': parseInt(ui.item.css('padding-right')),
				'padding-bottom': parseInt(ui.item.css('padding-bottom')),
				'padding-left': parseInt(ui.item.css('padding-left')),
			});
		},
		update: function (event, ui) {
			var data = $(this).sortable('serialize');
			var oldPercent = 0;

			$.ajax({
				url: $(this).attr('data-action'),
				type: 'POST',
				data: data,
				headers: {
					'X-CSRF-Token': csrfToken,
				},
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
					$.mpb('destroy');
					oldPercent = 0;

					if (data.type == 'error') {
						alertSystem('error', 'Oops...', 'Alguns registros não puderam ser ordenados.');
					}
				},
			});
		}
	});
	$(".ordenable").disableSelection();

	if ($(".ordenable-table").length) {
		var widths = new Array();
		$(".ordenable-table").closest('table').find('thead').find('th').each(function(){
			widths.push(Math.floor($(this).outerWidth()));
		});

		$(".ordenable-table").find('td').each(function(){
			$(this).attr('width', widths[$(this).index()]);
		});

		$(".ordenable-table").sortable({
			placeholder: 'scPlaceholderTable',
			start: function(event,ui) {
				ui.item.closest("table").find("th, td").each(function(){
					$(this).attr('width', widths[$(this).index()]);
				});
				
				colspan = $(event.target).find('td').length / $(event.target).find('tr').length;

				$(".scPlaceholderTable").empty();
				while(colspan) {
					$(".scPlaceholderTable").append('<td>&nbsp;</td>');
					colspan--;
				}

				$(".scPlaceholderTable").find('td').attr({
					'height': ui.item.find('td:first').outerHeight(),
				}).css({
					'border': '1px dashed #727272',
					'border-left': 0,
					'background-color': '#F5F5F5',
				});
				$(".scPlaceholderTable").find('td:first').css({
					'border': '1px dashed #727272',
				});
			},
			update: function (event, ui) {
				var data = $(this).sortable('serialize');

				var oldPercent = 0;

				$.ajax({
					url: $(this).attr('data-action'),
					type: 'POST',
					data: data,
					headers: {
						'X-CSRF-Token': csrfToken,
					},
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
						$.mpb('destroy');
						oldPercent = 0;

						if (data.type == 'error') {
							alertSystem('error', 'Oops...', 'Alguns registros não puderam ser ordenados.');
						}
					},
				});
			}
		});
		$(".ordenable-table").disableSelection();
	}

	var ordered;

	$(".ordenable-columns").sortable({
		placeholder: "scPlaceholder",
		start: function(event,ui) {
			$(".scPlaceholder").width(ui.item.width() - 2);
			$(".scPlaceholder").height(ui.item.height() - 2);
			$(".scPlaceholder").css({
				'margin-left' : 10,
				'margin-right' : 10,
			});
		},
		update: function (event, ui) {
			ordered = [];
			$(".ordenable-columns").each(function() {
				ordered.push($(this).sortable('serialize'));
			});
			var data = ordered.join('&');
			// $.ajax({
			// 	data: data,
			// 	type: 'post',
			// 	url: $(this).attr('data-action'),
			// 			success: function(data){
			// 		},
			// 	});
			// },
			var oldPercent = 0;

			$.ajax({
				url: $(this).attr('data-action'),
				type: 'POST',
				data: data,
				headers: {
					'X-CSRF-Token': csrfToken,
				},
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
						$.mpb('destroy');
						oldPercent = 0;
				},
			});
		}
	});
	$(".ordenable-columns").disableSelection();

	$(".ordenable-rows").sortable({
		placeholder: "scPlaceholder",
		start: function(event,ui) {
			$(".scPlaceholder").width(ui.item.width() - 2);
			$(".scPlaceholder").height(ui.item.height() - 2);
			$(".scPlaceholder").css({
				// 'margin-left' : 10,
				// 'margin-right' : 10,
			});
		},
		update: function (event, ui) {
			ordered = [];
			$(".ordenable-columns").each(function() {
				ordered.push($(this).sortable('serialize'));
			});
			var data = ordered.join('&');

			//var data = $(this).sortable('serialize');
			// $.ajax({
			// 	data: data,
			// 	type: 'post',
			// 	url: $(this).attr('data-action'),
			// 			success: function(data){
			// 		},
			// 	});
			// },
			var oldPercent = 0;

			$.ajax({
				url: $(this).attr('data-action'),
				type: 'POST',
				data: data,
				headers: {
					'X-CSRF-Token': csrfToken,
				},
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
					$.mpb('destroy');
					oldPercent = 0;
					location.reload();
				},
			});
		}
	});
	$(".ordenable-rows").disableSelection();
});