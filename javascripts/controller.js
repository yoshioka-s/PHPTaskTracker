angular.module('todo', [])
/*
  TaskCtrl
  manages user input and data
*/
.controller('TaskCtrl', function ($scope, TodoService)/*probably requires 'UserService' from services*/ {

  // get active tasks and initialize the form
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
      $scope.isTaskExist = tasks.length > 0;
      console.log($scope.isTaskExist);
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

});
