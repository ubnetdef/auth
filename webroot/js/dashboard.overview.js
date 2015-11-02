var InjectEngine_Dashboard_Overview = InjectEngine_Dashboard_Overview || {};

InjectEngine_Dashboard_Overview = {
	_url: null,

	_refreshMin: (30*1000), // 30 seconds
	_refreshMax: (45*1000), // 45 seconds

	_loadMin: (100),  // 1 ms
	_loadMax: (1000), // 1 second

	_teamInjectStandingsChart: null,
	_teamInjectCompletionRates: null,

	init: function(url) {
		console.log('InjectEngine_Dashboard_Overview-JS: Init');

		// Setup the URL
		this._url = url;

		// Setup charts
		this._teamInjectStandingsChart  = new google.visualization.PieChart(document.getElementById('team-inject-standings'));
		this._teamInjectCompletionRates = new google.visualization.ColumnChart(document.getElementById('inject-completion-rates'));
		this._hintUsagePerTeam          = new google.visualization.ColumnChart(document.getElementById('hint-usage-per-team'));

		// Load the initial data
		setTimeout(InjectEngine_Dashboard_Overview.loadTeamStatus,            this.randomLoad());
		setTimeout(InjectEngine_Dashboard_Overview.loadTeamInjectStandings,   this.randomLoad());
		setTimeout(InjectEngine_Dashboard_Overview.loadInjectCompletionRates, this.randomLoad());
		setTimeout(InjectEngine_Dashboard_Overview.loadHintUsagePerTeam,      this.randomLoad());

		// Setup the intervals
		setInterval(InjectEngine_Dashboard_Overview.loadTeamStatus,            this.randomRefresh());
		setInterval(InjectEngine_Dashboard_Overview.loadTeamInjectStandings,   this.randomRefresh());
		setInterval(InjectEngine_Dashboard_Overview.loadInjectCompletionRates, this.randomRefresh());
		setInterval(InjectEngine_Dashboard_Overview.loadHintUsagePerTeam,      this.randomRefresh());
	},

	// This exists so we can "stagger" refresh requests to the server
	randomRefresh: function() {
		return Math.floor(Math.random() * (this._refreshMax - this._refreshMin + 1)) + this._refreshMin;
	},

	randomLoad: function() {
		return Math.floor(Math.random() * (this._loadMax - this._loadMin + 1)) + this._loadMin;
	},

	loadTeamStatus: function() {
		that = InjectEngine_Dashboard_Overview;
		url = that._url+'/getTeamsStatus';

		$
			.get(url)
			.done(function(data) {
				$('#teamStatus-group').html(data);
			});
	},

	loadTeamInjectStandings: function() {
		that = InjectEngine_Dashboard_Overview;
		url = that._url+'/getTeamsInjectStandings';

		$
			.getJSON(url)
			.done(function(data) {
				dt = new google.visualization.DataTable(data);

				that._teamInjectStandingsChart.draw(dt, {
					width: 300,
					height: 200,
				});
			});
	},

	loadInjectCompletionRates: function() {
		that = InjectEngine_Dashboard_Overview;
		url = that._url+'/getInjectCompletionRates';

		$
			.getJSON(url)
			.done(function(data) {
				dt = new google.visualization.DataTable(data);

				that._teamInjectCompletionRates.draw(dt, {
					width: 700,
					height: 400,
					legend: {
						position: 'none',
					},
				});
			});
	},

	loadHintUsagePerTeam: function() {
		that = InjectEngine_Dashboard_Overview;
		url = that._url+'/getHintUsagePerTeam';

		$
			.getJSON(url)
			.done(function(data) {
				dt = new google.visualization.DataTable(data);

				that._hintUsagePerTeam.draw(dt, {
					width: 300,
					height: 200,
					legend: {
						position: 'none',
					},
				});
			});
	},
};
