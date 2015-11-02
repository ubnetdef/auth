var InjectEngine_Dashboard_Timeline = InjectEngine_Dashboard_Timeline || {};

InjectEngine_Dashboard_Timeline = {
	_url: null,

	_refreshRate: (30*1000), // 30 seconds

	init: function(url) {
		console.log('InjectEngine_Dashboard_Timeline-JS: Init');

		// Setup the URL + teams
		this._url = url;

		// Load the initial data
		this.loadTeamTimeline();

		// Setup the intervals
		setInterval(InjectEngine_Dashboard_Timeline.loadTeamTimeline, this._refreshRate+1);
	},

	loadTeamTimeline: function() {
		that = InjectEngine_Dashboard_Timeline;
		url = that._url+'/getTeamsTimeline';

		$
			.get(url)
			.done(function(data) {
				$('#teams-inject-timeline').html(data);
			});
	},
};
