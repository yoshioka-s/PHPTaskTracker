angular.module('todo', [])
.controller('SearchCtrl', function ($scope, TodoService)/*probably requires 'UserService' from services*/ {

  var getTasks = function() {
    TodoService.getTasks()
  	.then(function(tasks, status) {
  		$scope.status = status;
      $scope.tasks = tasks;
  		// console.log(tasks);
  	});
  };

  getTasks();
	// send a new task to the server
	$scope.createTask = function() {
    var task = {
      name: $scope.name,
      notes: $scope.notes
    };
		TodoService.createTask(task)
		.then(function(data) {
      // update the task list
      getTasks();
		});
	};
})

/*
  TodoService
  manages ajax requests
*/
.factory('TodoService', function ($http, $q) {

	function createTask (task) {
	  return $http.post('createTask.php', task)
	  .then(function successCallback(res){
      console.log('successCallback');
      console.log(res);
		    return res.data;
	  }, function errorCallback (error) {
      console.log('ERRRRR');
    	console.log(error);
    });
	}

	function getTasks () {
		return $http.get('getTasks.php')
		.then(function successCallback (res){
		    return res.data;
	  }, function errorCallback(error) {
      console.log('ERRRRR');
    	console.log(error);
  	});
	}

	return {
    createTask: createTask,
		getTasks: getTasks
  };
});
