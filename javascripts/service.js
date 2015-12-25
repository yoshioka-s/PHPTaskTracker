angular.module('todo')
/*
  TodoService
  manages ajax requests
*/
.factory('TodoService', function ($http, $q) {
  var url = 'tasks.php';

  // send an ajax POST request to create a task
	function createTask (task) {
	  return $http.post(url, task)
	  .then(function successCallback(res){
	    return res.data;
	  }, function errorCallback (error) {
      console.log('ERRRRR');
    	console.log(error);
    });
	}

  // send an ajax GET request to load tasks
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

  // send an ajax DELETE request to inactivate the task
  function deleteTask(id) {
    return $http.delete(url, {params: {id:id}})
		.then(function successCallback (res){
	    return res.data;
	  }, function errorCallback(error) {
      console.log('ERRRRR');
    	console.log(error);
  	});
  }

  // send an ajax PUT request to update the task
  function updateTask(task) {
    return $http.put(url, task)
		.then(function successCallback (res){
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
