var InjectEngine_Backend_Group = InjectEngine_Backend_Group || {};

InjectEngine_Backend_Group = {
	_url: null,

	init: function(url) {
		console.log('InjectEngine_Backend_Group-JS: Init');

		// Setup the URL
		this._url = url;

		// Bind to the team add modal
		$('#teamAdd').on('show.bs.modal', function (event) {
			button = $(event.relatedTarget);
			modal = $(this);
			gid = button.data('gid');
			name = button.data('name');

			// Set the name
			$('#teamAdd-groupname').html(name);
			$('#teamAdd-gid').val(gid);

			// Get the teams we can add + inject it in!
			$.getJSON(InjectEngine_Backend_Group._url+'getTeams/'+gid, function(data) {
				$('#teamAdd-select')
					.find('option')
					.remove();

				$.each(data, function(key, val) {
					$('#teamAdd-select').append('<option value="'+val.Team.id+'">'+val.Team.name+'</option');
				});
			});
		});
	},
};
