<!DOCTYPE html>
<html ng-app>
<head>
<title>Search form with AngualrJS</title>
	<script src="http://code.angularjs.org/angular-1.0.0.min.js"></script>
	<script src="search.js"></script>
</head>

<body>
<?php
         echo "<h1>Hello, PHP!</h1>";
      ?>
	<div ng-controller="SearchCtrl">
	<form class="well form-search" action="search.php">
		<label>Search:</label>
		<input type="text" ng-model="keywords" class="input-medium search-query" placeholder="Keywords..." namw="input">
		<button type="submit" class="btn">Search</button>
		<p class="help-block">Try for example: "php" or "angularjs" or "asdfg"</p>		
    </form>
<pre ng-model="result">
{{result}}
</pre>
   </div>
</body>

</html> 