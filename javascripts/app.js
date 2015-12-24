angular.module('todo', [])
.controller('SearchCtrl', function ($scope, TodoService)/*probably requires 'UserService' from services*/ {

  	TodoService.getTasks()
	.then(function(tasks, status) {
		$scope.status = status;
		$scope.tasks = tasks;
		console.log(tasks);	
	});
		
	// The function that will be executed on button click (ng-click="search()")
	$scope.createTask = function() {
		TodoService.createTask($scope.name, $scope.notes)
		.then(function(data, status) {
			if (data) {
				console.log("Request success");	
			} else {
				console.log("Request failed");	
			};
		});
	};
})
.factory('TodoService', function ($http, $q) {

	function createTask (task) {
	 	return $http.post('createTask.php', { "data" : "shu"})
	 	.then(function(res){
		    // console.log("getListOfPLaylists: ",res.data);
		    return res.data;
	   	},function(error) {
	    	console.log(error);
	    	return;
	  	});;
	}

	function getTasks () {
		return $http.get('getTasks.php')
		.then(function(res){
		    // console.log("getListOfPLaylists: ",res.data);
		    return res.data;
	   	},function(error) {
	    	console.log(error);
	    	return;
	  	});
	}
	return {createTask: createTask,
		getTasks: getTasks
 };
});