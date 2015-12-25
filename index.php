<!DOCTYPE html>
<html ng-app="todo">
<head>
<title>Tasks</title>
	<script src="http://code.angularjs.org/angular-1.0.0.min.js"></script>
	<script src="javascripts/app.js"></script>
</head>

<body>
	<?php
         echo "<h1>TASKS</h1>";
    ?>
	<div ng-controller="SearchCtrl">
		<table>
			<tr>
				<th>name</th>
				<th>notes</th>
				<th>date created</th>
				<th>actions</th>
			</tr>
			<tbody>
				<tr ng-repeat="task in tasks">
					<td>{{task.name}}</td>
					<td>{{task.notes}}</td>
					<td>{{task.created}}</td>
					<td><button type="button" name="delete" ng-click="deleteTask(task.id)">delete</button></td>
				</tr>
			</tbody>
		</table>
		<form class="well form-search" id="task_form">
			<label>Task name:</label>
			<input type="text" ng-model="name" placeholder="name">
			<br>
			<label>Notes:</label>
			<textarea type="text" ng-model="notes" placeholder="notes" form="task_form"></textarea>
			<br>
			<button type="submit" ng-click="createTask()">submit</button>
  	</form>
<pre ng-model="result">
{{result}}
</pre>
   </div>
</body>

</html>
