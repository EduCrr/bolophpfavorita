		
$(function() {

	var formElements = function() {
		// Bootstrap datepicker
		var feDatepicker = function(){						
			if($(".datepicker").length > 0){
				$(".datepicker").datepicker({
					language: 'pt-br',
					todayBtn: false,
					format: 'dd/mm/yyyy',
					clearBtn: true
				});
			}

			if($(".datepicker-minimal").length > 0){
				$(".datepicker-minimal").datepicker({
					language: 'pt-br',
					todayBtn: false,
					format: 'mm/yyyy',
					clearBtn: true,
					viewMode: "months",
					minViewMode: "months"
				});
			}
		}// END Bootstrap datepicker
		
		//Bootstrap timepicker
		var feTimepicker = function(){
			// Default timepicker
			if($(".timepicker").length > 0)
				$('.timepicker').timepicker();
			
			// 24 hours mode timepicker
			if($(".timepicker24").length > 0)
				$(".timepicker24").timepicker({minuteStep: 5,showSeconds: true,showMeridian: false});
			
		}// END Bootstrap timepicker
		
		//Daterangepicker 
		var feDaterangepicker = function(){
			if($(".daterange").length > 0)
				$(".daterange").daterangepicker({format: 'YYYY-MM-DD', startDate: '2013-01-01', endDate: '2013-12-31'});
		}
		// END Daterangepicker
		
		//Bootstrap colopicker		
		var feColorpicker = function(){
			if ($('#cp2').length > 0)
				$(function() { $('#cp2').colorpicker(); }); 

			// Default colorpicker hex
			if($(".color-picker").length > 0) {
				// $(".colorpicker").colorpicker({format: 'hex'});
				$(".color-picker").loads({
					layout: 'rgbhex',
					flat: false,
					enableAlpha: false,
					variant: 'small',
					onLoaded: function(ev) {
						// $(ev.el).setColor('0000ff', true);
						// var color = $(ev.el).getColor("hex", true);
						if ($(ev.el).val()) {
							$(ev.el).setColor($(ev.el).val(), true);
							$(ev.el).parent("div").find(".color-preview").css('background-color', $(ev.el).val());
						}
						else {
							$(ev.el).setColor($(ev.el).val(), true);
							$(ev.el).parent("div").find(".color-preview").css('background-color', 'transparent');	
						}
						
					},
					onChange: function(ev) {
						// $(ev.el).setColor(ev.hex, true);
						$(ev.el).val("#" + ev.hex);
						$(ev.el).parent("div").find(".color-preview").css('background-color', '#' + ev.hex);
					},
					onSubmit: function(ev) {
						// $(ev.el).css('background-color', '#' + ev.hex);
						$(ev.el).val("#" + ev.hex);
						$(ev.el).hides();
					},
					onHide: function(ev) {
						$(ev.el).setColor($(ev.el).val(), true);
						// $(ev.el).setColor(ev.hex, true);
						// $(ev.el).val("#" + ev.hex);

						// var color = $(ev.el).getColor("hex", true);
						// $(ev.el).setColor(color, true);
						// console.log(color);
					}
				});
			}
			
			// RGBA mode
			// if($(".colorpicker_rgba").length > 0)
				// $(".colorpicker_rgba").colorpicker({format: 'rgba'});
			
			// Sample
			// if($("#colorpicker").length > 0)
				// $("#colorpicker").colorpicker({format: 'hex'});
			
		}// END Bootstrap colorpicker
		
		//Bootstrap select
		var feSelect = function(){
			if($(".select").length > 0){
				// $(".select").selectpicker();
				
				// $(".select").on("change", function(){
				// 	if($(this).val() == "" || null === $(this).val()){
				// 		if(!$(this).attr("multiple"))
				// 			$(this).val("").find("option").removeAttr("selected").prop("selected",false);
				// 	}else{
				// 		$(this).find("option[value="+$(this).val()+"]").attr("selected",true);
				// 	}
				// });
			}
		}//END Bootstrap select
		
		
		//Validation Engine
		var feValidation = function(){
			if($("form[id^='validate']").length > 0){
				
				// Validation prefix for custom form elements
				var prefix = "valPref_";
				
				//Add prefix to Bootstrap select plugin
				$("form[id^='validate'] .select").each(function(){
					$(this).next("div.bootstrap-select").attr("id", prefix + $(this).attr("id")).removeClass("validate[required]");
				});
				
				// Validation Engine init
				$("form[id^='validate']").validationEngine('attach', {promptPosition : "bottomLeft", scroll: false});
			}
		}//END Validation Engine
		
		//Masked Inputs
		var feMasked = function(){			
			// if($("input[class^='mask_']").length > 0){
				// $("input.mask_tin").mask('00-0000000');
				// $("input.mask_ssn").mask('000-00-0000');		
				// $("input.mask_date").mask('0000-00-00');
				// $("input.mask_product").mask('a*-000-a000');
				// $("input.mask_phone").mask('00 (000) 000-00-00');
				// $("input.mask_phone_ext").mask('00 (000) 000-0000? x00000');
				// $("input.mask_credit").mask('0000-0000-0000-0000');
				// $("input.mask_percent").mask('00%');
				// $("input.mask_cnpj").mask('00.000.000/0000-00', {
				// 	clearIfNotMatch: true,
				// 	onInvalid: function(val, e, f, invalid, options) {
				// 		alert("Por favor, digite somente n??meros.");
				// 	}
				// });
				// $("input.mask_nfe").mask("#.##0.000", {
				// 	reverse: true,
				// 	onInvalid: function(val, e, f, invalid, options) {
				// 		alert("Por favor, digite somente n??meros.");
				// 	}
				// });
				// $("input.mask_chave_nfe").mask('00000000000000000000000000000000000000000000', {
				// 	clearIfNotMatch: false,
				// 	onInvalid: function(val, e, f, invalid, options) {
				// 		alert("Por favor, digite somente n??meros.");
				// 	}
				// });
			// }
		}//END Masked Inputs
		
		//Bootstrap tooltip
		var feTooltips = function(){			
			$("body").tooltip({selector:'[data-toggle="tooltip"]',container:"body"});
		}//END Bootstrap tooltip

		//Bootstrap Popover
		var fePopover = function(){
			if ($("[data-toggle=popover]").length) {
				$("[data-toggle=popover]").popover();
				$(".popover-dismiss").popover({trigger: 'focus'});
			}
		}//END Bootstrap Popover
		
		//Tagsinput
		var feTagsinput = function(){
			if($(".tagsinput").length > 0){
				
				$(".tagsinput").each(function(){
					
					if($(this).data("placeholder") != ''){
						var dt = $(this).data("placeholder");
					}else
						var dt = 'add a tag';
															
					$(this).tagsInput({width: '100%',height:'auto',defaultText: dt});
				});

			}
		}// END Tagsinput
		
		//iCheckbox and iRadion - custom elements
		var feiCheckbox = function(){
			if($(".icheckbox,.iradio").length > 0){
				 $(".icheckbox,.iradio").iCheck({checkboxClass: 'icheckbox_minimal-grey',radioClass: 'iradio_minimal-grey'});
			}
		}
		// END iCheckbox
		
		//Bootstrap file input
		var feBsFileInput = function(){
			
			if($("input.fileinput").length > 0){
				$("input.fileinput").bootstrapFileInput();
			}
			
		}
		//END Bootstrap file input
		
		return {// Init all form element features
			init: function(){
				// feDatepicker();
				feTimepicker();
				feColorpicker();
				feSelect();
				feValidation();
				feMasked();
				feTooltips();
				fePopover();
				feTagsinput();
				feiCheckbox();
				feBsFileInput();
				feDaterangepicker();
			}
		}
	} ();

	var uiElements = function(){

		//Datatables
		var uiDatatable = function(){
			if($(".datatable").length > 0) {
				$(".datatable").dataTable({
					'pagingType': 'full_numbers',
					'responsive': true,
					'language': {
						"sEmptyTable": "Nenhum registro encontrado",
						"sInfo": "Mostrando de _START_ at?? _END_ de _TOTAL_ registros",
						"sInfoEmpty": "Mostrando 0 at?? 0 de 0 registros",
						"sInfoFiltered": "(Filtrados de _MAX_ registros)",
						"sInfoPostFix": "",
						"sInfoThousands": ".",
						"sLengthMenu": "_MENU_ resultados por p??gina",
						"sLoadingRecords": "Carregando...",
						"sProcessing": "Processando...",
						"sZeroRecords": "Nenhum registro encontrado",
						"sSearch": "Pesquisar",
						"oPaginate": {
							"sNext": "Pr??ximo",
							"sPrevious": "Anterior",
							"sFirst": "Primeiro",
							"sLast": "??ltimo"
						},
						"oAria": {
							"sSortAscending": ": Ordenar colunas de forma ascendente",
							"sSortDescending": ": Ordenar colunas de forma descendente"
						}
					}
				});
				$(".datatable").on('page.dt',function () {
					onresize(100);
				});
			}
			
			if($(".datatable_simple").length > 0){				
				$(".datatable_simple").dataTable({"ordering": false, "info": false, "lengthChange": false,"searching": false});
				$(".datatable_simple").on('page.dt',function () {
					onresize(100);
				});				
			}			
		}//END Datatable		
		
		//RangeSlider // This function can be removed or cleared.
		var uiRangeSlider = function(){
			
			//Default Slider with start value
			if($(".defaultSlider").length > 0){				
				$(".defaultSlider").each(function(){					
					var rsMin = $(this).data("min");
					var rsMax = $(this).data("max");

					$(this).rangeSlider({						
						bounds: {min: 1, max: 200},
						defaultValues: {min: rsMin, max: rsMax}
					});					
				});								
			}//End Default
			
			//Date range slider
			if($(".dateSlider").length > 0){				
				$(".dateSlider").each(function(){
					$(this).dateRangeSlider({
						bounds: {min: new Date(2012, 1, 1), max: new Date(2015, 12, 31)},
						defaultValues:{min: new Date(2012, 10, 15),max: new Date(2014, 12, 15)}
					});
				});												
			}//End date range slider
			
			//Range slider with predefinde range			
			if($(".rangeSlider").length > 0){				
				$(".rangeSlider").each(function(){					
					var rsMin = $(this).data("min");
					var rsMax = $(this).data("max");

					$(this).rangeSlider({
						bounds: {min: 1, max: 200},
						range: {min: 20, max: 40},
						defaultValues: {min: rsMin, max: rsMax}
					});					
				});								
			}//End
			
			//Range Slider with custom step
			if($(".stepSlider").length > 0){				
				$(".stepSlider").each(function(){
					var rsMin = $(this).data("min");
					var rsMax = $(this).data("max");

					$(this).rangeSlider({						
						bounds: {min: 1, max: 200},
						defaultValues: {min: rsMin, max: rsMax},
						step: 10
					});	
				});												
			}//End
			
		}//END RangeSlider
		
		//Start Knob Plugin
		var uiKnob = function(){
			
			if($(".knob").length > 0){
				$(".knob").knob();
			}			
			
		}//End Knob
		
		// Start Smart Wizard
		var uiSmartWizard = function(){
			
			if($(".wizard").length > 0){
				
				//Check count of steps in each wizard
				$(".wizard > ul").each(function(){
					$(this).addClass("steps_"+$(this).children("li").length);
				});//end
				
				// This par of code used for example
				if($("#wizard-validation").length > 0){
					
					var validator = $("#wizard-validation").validate({
							rules: {
								login: {
									required: true,
									minlength: 2,
									maxlength: 8
								},
								password: {
									required: true,
									minlength: 5,
									maxlength: 10
								},
								repassword: {
									required: true,
									minlength: 5,
									maxlength: 10,
									equalTo: "#password"
								},
								email: {
									required: true,
									email: true
								},
								name: {
									required: true,
									maxlength: 10
								},
								adress: {
									required: true
								}
							}
						});
						
				}// End of example
				
				$(".wizard").smartWizard({						
					// This part of code can be removed FROM
					onLeaveStep: function(obj){
						var wizard = obj.parents(".wizard");

						if(wizard.hasClass("wizard-validation")){
							
							var valid = true;
							
							$('input,textarea',$(obj.attr("href"))).each(function(i,v){
								valid = validator.element(v) && valid;
							});
														
							if(!valid){
								wizard.find(".stepContainer").removeAttr("style");
								validator.focusInvalid();								
								return false;
							}		 
							
						}	
						
						return true;
					},// <-- TO
					
					//This is important part of wizard init
					onShowStep: function(obj){						
						var wizard = obj.parents(".wizard");

						if(wizard.hasClass("show-submit")){
						
							var step_num = obj.attr('rel');
							var step_max = obj.parents(".anchor").find("li").length;

							if(step_num == step_max){							 
								obj.parents(".wizard").find(".actionBar .btn-primary").css("display","block");
							}						 
						}
						return true;						 
					}//End
				});
			}			
			
		}// End Smart Wizard
		
		//OWL Carousel
		var uiOwlCarousel = function(){
			
			if($(".owl-carousel").length > 0){
				$(".owl-carousel").owlCarousel({mouseDrag: false, touchDrag: true, slideSpeed: 300, paginationSpeed: 400, singleItem: true, navigation: false,autoPlay: true});
			}
			
		}//End OWL Carousel
		
		// Summernote 
		var uiSummernote = function(){
			if ($("form").length) {
				$("form").each(function() {
					$(this).get(0).reset();
				});
			}
			
			/* Extended summernote editor */
			if($(".summernote").length > 0){
				$(".summernote").summernote({
					height: 250,
					codemirror: {
						mode: 'text/html',
						htmlMode: true,
						lineNumbers: true,
						theme: 'default'
					},
					lang: 'pt-BR',
				});
			}
			/* END Extended summernote editor */
			
			/* Lite summernote editor */
			if($(".summernote_lite").length > 0){
				$(".summernote_lite").on("focus",function() {
					$(".summernote_lite").summernote({
						height: 100,
						focus: true,
						toolbar: [
							["style", ["bold", "italic", "underline", "clear"]],
							["insert",["link","picture","video"]]
						],
						lang: 'pt-BR',
					});
				});
			}
			/* END Lite summernote editor */
			
			/* Email summernote editor */
			if($(".summernote_email").length > 0) {													
				$(".summernote_email").summernote({
					height: 400,
					focus: true,
					toolbar: [
						['style', ['bold', 'italic', 'underline', 'clear']],
						['font', ['strikethrough']],
						['fontsize', ['fontsize']],
						['color', ['color']],
						['para', ['ul', 'ol', 'paragraph']],
						['height', ['height']]
					],
					lang: 'pt-BR',
				});
				
			}
			/* END Email summernote editor */
			
		}// END Summernote 
		
		// Custom Content Scroller
		var uiScroller = function(){
			
			if($(".scroll").length > 0){
				$(".scroll").mCustomScrollbar({
					axis:"y",
					autoHideScrollbar: true,
					scrollInertia: 200,
					advanced: {
						autoScrollOnFocus: false,
						updateOnContentResize: true
					},
				});
			}

			if($(".scroll-x").length > 0) {
				$(".scroll-x").mCustomScrollbar({
					axis:"x", autoHideScrollbar: false,
					scrollInertia: 20,
					advanced: {
						autoScrollOnFocus: false,
						updateOnContentResize: true
					}
				});
			}
			
		}// END Custom Content Scroller

		// Sparkline
		var uiSparkline = function(){
			
			if($(".sparkline").length > 0)
				$(".sparkline").sparkline('html', {enableTagOptions: true, disableHiddenCheck: true});

		}// End sparkline

		$(window).resize(function(){
			if($(".owl-carousel").length > 0){
				$(".owl-carousel").data('owlCarousel').destroy();
				uiOwlCarousel();
			}
		});

		return {
			init: function(){
				uiDatatable();
				uiRangeSlider();
				uiKnob();
				uiSmartWizard();
				uiOwlCarousel();
				uiSummernote();
				uiScroller();
				uiSparkline();
			}
		}
		
	}();

	var templatePlugins = function(){
		
		var tp_clock = function(){
			
			function tp_clock_time(){
				var now	 = new Date();
				var hour	= now.getHours();
				var minutes = now.getMinutes();					
				
				hour = hour < 10 ? '0'+hour : hour;
				minutes = minutes < 10 ? '0'+minutes : minutes;
				
				$(".plugin-clock").html(hour+"<span>:</span>"+minutes);
			}
			if($(".plugin-clock").length > 0){
				
				tp_clock_time();
				
				window.setInterval(function(){
					tp_clock_time();					
				},10000);
				
			}
		}
		
		var tp_date = function(){
			
			if($(".plugin-date").length > 0){
				
				var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
				var months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
						
				var now = new Date();
				var day = days[now.getDay()];
				var date = now.getDate();
				var month = months[now.getMonth()];
				var year = now.getFullYear();
				
				$(".plugin-date").html(day+", "+month+" "+date+", "+year);
			}
			
		}
		
		return {
			init: function(){
				tp_clock();
				tp_date();
			}
		}
	}();
	
	var fullCalendar = function() {
			
		var calendar = function() {
			
			if($("#calendar").length > 0){
				
				function prepare_external_list(){
					
					$('#external-events .external-event').each(function() {
							var eventObject = {title: $.trim($(this).text())};

							$(this).data('eventObject', eventObject);
							$(this).draggable({
									zIndex: 999,
									revert: true,
									revertDuration: 0
							});
					});					
					
				}
				
				
				var date = new Date();
				var d = date.getDate();
				var m = date.getMonth();
				var y = date.getFullYear();

				prepare_external_list();

				var calendar = $('#calendar').fullCalendar({
					header: {
						left: 'prev,next today',
						center: 'title',
						right: 'month,agendaWeek,agendaDay'
					},
					editable: true,
					eventSources: {url: "assets/ajax_fullcalendar.php"},
					droppable: true,
					selectable: true,
					selectHelper: true,
					select: function(start, end, allDay) {
						var title = prompt('Event Title:');
						if (title) {
							calendar.fullCalendar('renderEvent',
							{
								title: title,
								start: start,
								end: end,
								allDay: allDay
							},
							true
							);
						}
						calendar.fullCalendar('unselect');
					},
					drop: function(date, allDay) {

						var originalEventObject = $(this).data('eventObject');

						var copiedEventObject = $.extend({}, originalEventObject);

						copiedEventObject.start = date;
						copiedEventObject.allDay = allDay;

						$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);


						if ($('#drop-remove').is(':checked')) {
							$(this).remove();
						}

					}
				});
				
				$("#new-event").on("click",function(){
					var et = $("#new-event-text").val();
					if(et != ''){
						$("#external-events").prepend('<a class="list-group-item external-event">'+et+'</a>');
						prepare_external_list();
					}
				});
				
			}			
		}
		
		return {
			init: function(){
				calendar();
			}
		}
	}();
	
	formElements.init();
	uiElements.init();
	templatePlugins.init();
	
	fullCalendar.init();
	
	/* My Custom Progressbar */
	$.mpb = function(action,options){

		var settings = $.extend({
			state: '',			
			value: [0,0],
			position: '',
			speed: 20,
			complete: null
		},options);

		if(action == 'show' || action == 'update'){
			
			if(action == 'show'){
				$(".mpb").remove();
				var mpb = '<div class="mpb '+settings.position+'">\n\
								<div class="mpb-progress'+(settings.state != '' ? ' mpb-'+settings.state: '')+'" style="width:'+settings.value[0]+'%;"></div>\n\
							</div>';
				$('body').append(mpb);
			}
			
			var i = $.isArray(settings.value) ? settings.value[0] : $(".mpb .mpb-progress").width();
			var to = $.isArray(settings.value) ? settings.value[1] : settings.value;			
			
			var timer = setInterval(function(){
				$(".mpb .mpb-progress").css('width',i+'%'); i++;
				
				if(i > to){
					clearInterval(timer);
					if($.isFunction(settings.complete)){
						settings.complete.call(this);
					}
				}
			}, settings.speed);

		}

		if(action == 'destroy'){
			$(".mpb").remove();
		}				
		
	}
	/* Eof My Custom Progressbar */
	
	
	// New selector case insensivity		
	$.expr[':'].containsi = function(a, i, m) {
		return jQuery(a).text().toUpperCase().indexOf(m[3].toUpperCase()) >= 0;
	};
});

Object.size = function(obj) {
	var size = 0, key;
	for (key in obj) {
		if (obj.hasOwnProperty(key)) size++;
	}
	return size;
};