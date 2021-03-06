<?php include "includes/header.php" ?>

	<nav class="navbar navbar-default navbar-static-top">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">App Store Search</a>
			</div>
		</div>
	</nav>

	<div class="jumbotron">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-sm-offset-3">
					<form>
						<div class="input-group input-group-lg">
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
							</span>
							<input id="search-input" type="text" class="form-control" placeholder="Search">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-3">
				<ul id="facets" class="list-group">

				</ul>
			</div>
			<div id="results" class="col-xs-12 col-sm-9">

			</div>
		</div>
	</div>

	<div class="container">
		<nav id="pager">

		</nav>
	</div>

	<div class="container">
		<hr>
		<footer>
			<p>&copy; Josh Sephton 2015</p>
		</footer>
	</div>

	<script type="application/javascript">
		window._ALGOLIA_SEARCH_API_KEY = '<?php
			echo $view_data['algolia_search_key'];
		?>';
	</script>

<?php include "includes/footer.php" ?>
