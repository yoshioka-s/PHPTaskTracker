angular.module('todo', [])
.controller('SearchCtrl', function ($scope, TodoService)/*probably requires 'UserService' from services*/ {

  var getTasks = function() {
    $scope.heading = 'New Task';
    $scope.action = 'Create';
    // reset task
    $scope.task = {
      name: '',
      notes: '',
      id: null
    };
    TodoService.getTasks()
  	.then(function(tasks) {
      $scope.tasks = tasks;
  	});
  };

  // on clicking delete button of each task
  $scope.deleteTask = function (task) {
    if (confirm('Are you sure to delete the task "' + task.name + '"?')) {
      TodoService.deleteTask(task.id)
  		.then(function(data) {
        // update the task list
        getTasks();
  		});
    }
  };

  // on clicking edit button of each task
  $scope.clickEdit = function (task) {
    $scope.task = {
      name: task.name,
      notes: task.notes,
      id: task.id
    };
    $scope.heading = 'Edit Task';
    $scope.action = 'Save';
  };

  // on clicking Create button on the form
  var createTask = function() {
    TodoService.createTask($scope.task)
    .then(function(data) {
      getTasks();
    });
  };

  // on clicking Save button on the form
  var updateTask = function () {
    TodoService.updateTask($scope.task)
    .then(function(data) {
      getTasks();
    });
  };

  // manages submit actions depending on the state (create or save)
  $scope.actions = {
    Create: createTask,
    Save: updateTask
  };

  getTasks();

})

/*
  TodoService
  manages ajax requests
*/
.factory('TodoService', function ($http, $q) {
  var url = 'tasks.php';

	function createTask (task) {
	  return $http.post(url, task)
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
		return $http.get(url)
		.then(function successCallback (res){
      console.log(res.data);
	    return res.data;
	  }, function errorCallback(error) {
      console.log('ERRRRR');
    	console.log(error);
  	});
	}

  function deleteTask(id) {
    return $http.delete(url, {params: {id:id}})
		.then(function successCallback (res){
      console.log(res);
	    return res.data;
	  }, function errorCallback(error) {
      console.log('ERRRRR');
    	console.log(error);
  	});
  }

  function updateTask(task) {
    return $http.put(url, task)
		.then(function successCallback (res){
      console.log(res);
	    return res.data;
	  }, function errorCallback(error) {
      console.log('ERRRRR');
    	console.log(error);
  	});
  }

	return {
    createTask: createTask,
		getTasks: getTasks,
    deleteTask: deleteTask,
    updateTask: updateTask
  };
});
