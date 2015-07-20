'use strict';

var _             = require("underscore"),
	$             = require("jquery"),
	algoliasearch = require('algoliasearch');

var apptemplate   = require("../../templates/app.html"),
	facettemplate = require("../../templates/facet.html"),
	pagertemplate = require("../../templates/pager.html");


module.exports = {

	query: '',


	category: '',


	page: 0,


	defaults: {
		resultsPanelSelector: '#results',
		facetsPanelSelector: '#facets',
		pagerPanelSelector: '#pager',
		searchInputSelector: '#search-input',
		facetInputSelector: '#facets a',
		pagerInputSelector: '#pager a',
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

		this.decodeURL();
		this.handleSearch();

		$('body').on(
			'input',
			this.options.searchInputSelector,
			function () {

				self.query = $(this).val();

				self.page = 0;

				self.handleSearch();
				self.encodeURL();

			}
		);

		$('body').on(
			'click',
			this.options.facetInputSelector,
			function (e) {

				e.preventDefault();

				var category = $(this).html();

				if (self.category !== category) {
					self.category = category;
				} else {
					self.category = '';
				}

				self.page = 0;

				self.handleSearch();
				self.encodeURL();

			}
		);

		$('body').on(
			'click',
			this.options.pagerInputSelector,
			function (e) {

				e.preventDefault();

				self.page = $(this).data('page');

				self.handleSearch();
				self.encodeURL();

			}
		);

	},


	decodeURL: function () {

		var urlParams = {};

		var match,
			pl     = /\+/g, // Regex for replacing addition symbol with a space
			search = /([^&=]+)=?([^&]*)/g,
			decode = function (s) {
				return decodeURIComponent(s.replace(pl, " "));
			},
			query  = window.location.search.substring(1);

		urlParams = {};
		while (match = search.exec(query)) {
			urlParams[decode(match[1])] = decode(match[2]);
		}

		if ('category' in urlParams) {
			this.category = urlParams.category;
		}

		if ('query' in urlParams) {
			this.query = urlParams.query;
			$(this.options.searchInputSelector).val(this.query);
		}

		if ('page' in urlParams) {
			this.page = parseInt(urlParams.page) - 1;
		}

	},


	encodeURL: function () {

		var url = '/';
		var query = [];

		if (this.category !== '') {
			query.push("category=" + encodeURIComponent(this.category));
		}

		if (this.query !== '') {
			query.push("query=" + encodeURIComponent(this.query));
		}

		if (this.page !== 0) {
			query.push("page=" + encodeURIComponent(this.page + 1));
		}

		var queryString = query.join("&");

		if (queryString.length > 0) {
			url = url + '?' + queryString;
		}

		var stateObj = { query: query };
		history.replaceState(stateObj, document.title, url);

	},


	handleSearch: function () {

		this.searchIndex.search(
			this.query,
			{
				facets: '*',
				facetFilters: ['category:' + this.category],
				page: this.page
			},
			this.handleResponse.bind(this)
		);

	},


	handleResponse: function (err, content) {

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
