var InjectEngine_Dashboard_Help = InjectEngine_Dashboard_Help || {};

InjectEngine_Dashboard_Help = {
	_url: null,

	init: function(url) {
		console.log('InjectEngine_Dashboard_Help-JS: Init');

		// Setup the URL
		this._url = url;

		// Bind to the ack button
		$('#helpButton-ack').click(function() {
			$
				.post(InjectEngine_Dashboard_Help._url, {action: 1})
				.success(function() {
					$('#helpButton-ack').addClass('hidden');
					$('#helpButton-fin').removeClass('hidden');

					alert('Sucessfully acknowledged! Please click "Finish" when you are done helping!');
				})
				.error(function() {
					alert('Something went wrong. Please contact White Team and check network logs');
				});
		});

		// Bind to the fin button
		$('#helpButton-fin').click(function() {
			$
				.post(InjectEngine_Dashboard_Help._url, {action: 2})
				.success(function() {
					$('#helpButton-fin').addClass('hidden');
					$('#helpButton-done').removeClass('hidden');

					alert('Sucessfully finished!');
				})
				.error(function() {
					alert('Something went wrong. Please contact White Team and check network logs');
				});
		});
	},
};
