var InjectEngine_Backend_Hint = InjectEngine_Backend_Hint || {};

InjectEngine_Backend_Hint = {
	_url: null,

	init: function(url) {
		console.log('InjectEngine_Backend_Hint-JS: Init');

		// Setup the URL
		this._url = url;

		// Bind to the hint add modal
		$('#hintAdd').on('show.bs.modal', function (event) {
			button = $(event.relatedTarget);
			modal = $(this);
			id = button.data('id');
			name = button.data('name');

			// Set the name
			$('#hintAdd-injectname').html(name);
			$('#hintAdd-id').html(id);

			// Fill in the form
			$('#add_op').val(1);
			$('#add_inject_id').val(id);

			// Enable WYSIWYG
			InjectEngine_Backend_Hint.enableWysiwyg($('#add_description'));
		});

		// Bind to the hint edit modal
		$('#hintEdit').on('show.bs.modal', function (event) {
			button = $(event.relatedTarget);
			modal = $(this);
			id = button.data('id');

			InjectEngine_Backend_Hint.getInfo(id, function(data) {
				$('#hintEdit-injectname').html(data.Inject.title);
				$('#hintEdit-id').html(data.Hint.id);
				$('#hintEdit-number').html(data.Hint.order);

				// Fill in the form
				$('#edit_order').val(data.Hint.id);
				$('#edit_op').val(2);
				$('#edit_inject_id').val(data.Inject.id);
				$('#edit_id').val(data.Hint.id);

				$('#edit_description').val(data.Hint.description);
				InjectEngine_Backend_Hint.enableWysiwyg($('#edit_description'));

				$('#edit_time_wait').val(data.Hint.time_wait);

				if ( data.Hint.time_available > 0 ) {
					$('#edit_time_available_datepicker').data('DateTimePicker').date(moment.unix(data.Hint.time_available));
				} else {
					$('#edit_time_available').val(data.Hint.time_available);
				}

				if ( data.Hint.active == 1 ) {
					$('#edit_activeYes').attr('checked', 'checked');
				} else {
					$('#edit_activeNo').attr('checked', 'checked');
				}
			});
		});

		$('.modal').on('hide.bs.modal', function () {
			$('.wysihtml5-sandbox, .wysihtml5-toolbar').remove();
			$("input[name='_wysihtml5_mode']").remove();
			$('.wysiwyg').show();
		});

		// Enable time
		$('.datetimepicker').datetimepicker({
			sideBySide: true,
			keepInvalid: true,
		});

		// Form bindings
		$('form').submit(function() {
			$('.datetimepicker').each(function() {
				dtp = $(this).data('DateTimePicker');
				input = $(this).children('input');

				if ( !$.isNumeric(input.val()) ) {
					// Not a number. Let's get the date from DTP
					input.val(dtp.date().unix());
				}
			});

			// Remove the mode
			$("input[name='_wysihtml5_mode']").remove()
		});
	},

	getInfo: function(id, cb) {
		$
			.getJSON(this._url+'/getHintInfo/'+id)
			.success(function(data) {
				cb(data);
			})
			.error(function() {
				alert('Failed to get hint info');
			});
	},

	enableWysiwyg: function(el) {
		el.wysihtml5({
			toolbar: {
				html: true,
				size: "xs",
			},
		});
	}
};
