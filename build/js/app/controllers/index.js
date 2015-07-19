'use strict';

var _             = require("underscore"),
	$             = require("jquery"),
	algoliasearch = require('algoliasearch');

var apptemplate   = require("../../templates/app.html"),
	facettemplate = require("../../templates/facet.html"),
	pagertemplate = require("../../templates/pager.html");


module.exports = {


	defaults: {
		resultsPanelSelector: '#results',
		facetsPanelSelector: '#facets',
		pagerPanelSelector: '#pager',
		algoliaAppId: '889MEAME3D',
		algoliaAppSecret: '294131e978cd8a96fb46d929b28baf9c',
		algoliaIndexName: 'Apps'
	},


	init: function (options) {

		var self = this;

		this.options = _.extend(this.defaults, options);

		this.$resultsPanel = $(this.options.resultsPanelSelector);
		this.$facetsPanel = $(this.options.facetsPanelSelector);
		this.$pagerPanel = $(this.options.pagerPanelSelector);

		this.searchClient = algoliasearch(
			this.options.algoliaAppId,
			this.options.algoliaAppSecret
		);

		this.searchIndex = this.searchClient.initIndex(
			this.options.algoliaIndexName
		);

		this.handleSearch('');

		$('#search-input').on('input', function () {
			self.handleSearch($(this).val());
		});

	},


	handleSearch: function (query) {

		this.searchIndex.search(
			query,
			{ facets: '*' },
			this.handleResponse.bind(this)
		);

	},


	handleResponse: function (err, content) {
console.log(content);
		this.redrawResultsPanel(content.hits);
		this.redrawFacetsPanel(content.facets.category);
		this.redrawPagerPanel({
			nbPages: content.nbPages,
			page: content.page
		});

	},


	redrawResultsPanel: function (results) {

		var appResults = [];

		_.each(results, function (result) {

			var mappedResult = {
				name: result._highlightResult.name.value,
				image: result.image,
				link: result.link,
				category: result.category,
			};

			appResults.push(apptemplate(mappedResult));

		});

		var html = $(appResults.join(""));

		this.$resultsPanel.html("");
		html.appendTo(this.$resultsPanel);

	},


	redrawFacetsPanel: function (facets) {

		var facetResults = [];

		_.each(facets, function (count, facet) {
			facetResults.push(facettemplate({
				name: facet,
				count: count
			}));
		});

		var html = $(facetResults.join(""));

		this.$facetsPanel.html("");
		html.appendTo(this.$facetsPanel);

	},


	redrawPagerPanel: function (paging) {

		var html = $(pagertemplate(paging));

		this.$pagerPanel.html("");
		html.appendTo(this.$pagerPanel);

	}


}
