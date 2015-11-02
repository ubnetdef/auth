var InjectEngine = InjectEngine || {};

InjectEngine = {
	_injectURL: null,
	_countdownTimer: null,

	init: function(injectURL) {
		console.log('InjectEngine-JS: Init');

		// Setup the inject URL
		this._injectURL = injectURL;

		// Bind all the flag submits
		$('.inject-flag:enabled').each(function() {
			// Going up 3 levels! Damn...
			$(this).parent().parent().parent().submit(function() {
				input = $(this).find('input');

				inject_id = input.data('inject-id');
				value = input.val();

				InjectEngine.handleFlagSubmit(inject_id, value);

				return false;
			});
		});

		// Bind to the hint modal
		$('#hintModal').on('show.bs.modal', function (event) {
			button = $(event.relatedTarget);
			modal = $(this);
			injectid = button.data('inject-id');

			InjectEngine.loadHintModal(modal, injectid);
		});

		// Bind to the help modal
		$('#helpModal').on('show.bs.modal', function (event) {
			button = $(event.relatedTarget);
			modal = $(this);
			injectid = button.data('inject-id');
			injectname = button.data('inject-name');

			// Fill in some information
			$('#helpModal-injectname').html(injectname);

			// Bind to the submit button
			$('#helpModal-yesRequest').off('click');
			$('#helpModal-yesRequest').click(function() {
				InjectEngine.handleHelpRequest(injectid);
			})
		});

		// Bind to the manual check modal
		$('#manualCheckModal').on('show.bs.modal', function (event) {
			button = $(event.relatedTarget);
			modal = $(this);
			injectid = button.data('inject-id');
			injectname = button.data('inject-name');

			// Fill in some information
			$('#manualCheckModal-injectname').html(injectname);

			// Bind to the submit button
			$('#manualCheckModal-yesRequest').off('click');
			$('#manualCheckModal-yesRequest').click(function() {
				InjectEngine.handleCheckRequest(injectid);
			})
		});
	},

	loadHintModal: function(modal, injectid) {
		// Get the Inject Modal content + inject it in!
		$.get(InjectEngine._injectURL+'/hint/'+injectid, function(data) {
			modal.find('.modal-body').html(data);

			// Rebind to the new HTML
			$('.hint-btn').click(function() {
				InjectEngine.handleHintBtn(injectid);
			});

			InjectEngine._countdownTimer = setInterval(function() {
				el = $('.hint-disabled-countdown');

				now   = Math.floor(Date.now() / 1000);
				until = el.data('until');

				if ( now >= until ) {
					clearInterval(InjectEngine._countdownTimer);
					InjectEngine.loadHintModal(modal, injectid);
				} else {
					el.text('Please wait '+(until-now)+' seconds');
				}
			}, 1000);
		});
	},

	handleFlagSubmit: function(id, value) {
		$
			.post(this._injectURL+'/submit', {id: id, value: value})
			.done(function() {
				// Reload the page
				window.location.reload();
			})
			.error(function() {
				$('#inject'+id+'-invalid').hide().removeClass('hidden').fadeIn(1000);
			});
	},

	handleHintBtn: function(injectid) {
		$
			.post(this._injectURL+'/takeHint', {id: injectid})
			.done(function() {
				// Reload the modal
				$.get(InjectEngine._injectURL+'/hint/'+injectid, function(data) {
					InjectEngine.loadHintModal($('#hintModal'), injectid);
				});
			})
			.error(function() {
				alert('Request for hint failed. Please contact the White Team.');
			});
	},

	handleHelpRequest: function(injectid) {
		$
			.post(this._injectURL+'/requestHelp', {id: injectid})
			.done(function(data) {
				if ( data != '' ) {
					alert(data);
				}
			})
			.error(function() {
				alert('Request for help failed. Please contact the White Team.');
			})
			.always(function() {
				$('#helpModal').modal('hide');
			});
	},

	handleCheckRequest: function(injectid) {
		$
			.post(this._injectURL+'/requestCheck', {id: injectid})
			.done(function(data) {
				if ( data != '' ) {
					alert(data);
				}

				$('#inject'+injectid+'-requestCheckBtn')
					.addClass('disabled')
					.text('Check Requested');
			})
			.error(function() {
				alert('Request for help failed. Please contact the White Team.');
			})
			.always(function() {
				$('#manualCheckModal').modal('hide');
			});
	},
};
