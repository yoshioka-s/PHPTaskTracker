<!DOCTYPE html>
<html ng-app="todo">
<head>
<title>Tasks</title>
	<link href='https://fonts.googleapis.com/css?family=Bevan' rel='stylesheet' type='text/css'>
	<link href="css/styles.css" rel="stylesheet" type="text/css" />
	<script src="http://code.angularjs.org/angular-1.0.0.min.js"></script>
	<script src="javascripts/controller.js"></script>
	<script src="javascripts/service.js"></script>
</head>

<body>
	<h1 class="title">TASKS</h1>

	<div ng-controller="TaskCtrl">
		<div ng-hide="isTaskExist">
			<p>
				There is no task created. Create a new task below.
			</p>
		</div>

		<table ng-hide="!isTaskExist">
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
					<td>
						<button type="button" name="edit" ng-click="clickEdit(task)">edit</button>
						<button type="button" name="delete" ng-click="deleteTask(task)">delete</button></td>
				</tr>
			</tbody>
		</table>

		<form class="well form-search" id="task_form">
			<h3>{{heading}}</h3>
			<label>Task name:</label>
			<input type="text" ng-model="task.name" placeholder="name">
			<br>
			<label>Notes:</label>
			<textarea type="text" ng-model="task.notes" placeholder="notes" form="task_form"></textarea>
			<br>
			<button type="submit" ng-click="actions[action]()" ng-disabled="task.name.length < 1" class="submit-btn">{{action}}</button>
  	</form>
   </div>
</body>

</html>
