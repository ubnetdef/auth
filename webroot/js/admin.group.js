var Admin_Group = Admin_Group || {};

Admin_Group = {
	_url: null,

	init: function(url) {
		console.log('Admin_Group-JS: Init');

		// Setup the URL
		this._url = url;

		// Bind to the team add modal
		$('#userAdd').on('show.bs.modal', function (event) {
			button = $(event.relatedTarget);
			modal = $(this);
			gid = button.data('gid');
			name = button.data('name');

			// Set the name
			$('#userAdd-groupname').html(name);
			$('#userAdd-gid').val(gid);

			// Get the teams we can add + inject it in!
			$.getJSON(Admin_Group._url+'getUsers/'+gid, function(data) {
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
