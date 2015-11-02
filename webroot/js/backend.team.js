var InjectEngine_Backend_Team = InjectEngine_Backend_Team || {};

InjectEngine_Backend_Team = {
	_url: null,

	init: function(url) {
		console.log('InjectEngine_Backend_Team-JS: Init');

		// Setup the URL
		this._url = url;

		// Bind to the team add modal
		$('#userAdd').on('show.bs.modal', function (event) {
			button = $(event.relatedTarget);
			modal = $(this);
			tid = button.data('tid');
			name = button.data('name');

			// Set the name
			$('#userAdd-teamname').html(name);
			$('#userAdd-tid').val(tid);

			// Get the teams we can add + inject it in!
			$.getJSON(InjectEngine_Backend_Team._url+'getUsers/'+tid, function(data) {
				$('#userAdd-select')
					.find('option')
					.remove();

				$.each(data, function(key, val) {
					$('#userAdd-select').append('<option value="'+val.User.id+'">'+val.User.username+'</option');
				});

				if ( data.length == 0 ) {
					$('#userAdd-select').append('<option disabled="disabled">No users available to add!</option');
				}
			});
		});
	},
};
