// get the common URL

const BaseUrl = 'http://gymflex.online';
  
  // handle form submission
$('.enter-task').on('submit', function(event) {
  event.preventDefault(); // prevent form submission

  // get the task content
  var task = $('#task-input').val();

  // send AJAX request to insert the task
  if(task){
  $.ajax({
    url: BaseUrl+'/homeInc',
    method: 'POST',
    data: { task: task },
    success: function(response) {
       
      // clear task input
      $('#task-input').val('');

      // refresh task list
      fetchTasks();
    },
    error: function(xhr, status, error) {
      // handle error
      alert('Error inserting task');

    }
  });
}
else{
  return
}});
// delete task
function deleteTask(id){
  // get the task id
  var taskId = id;

  // send AJAX request to delete task
  $.ajax({
    url:  BaseUrl+'/homeInc',
    method: 'POST',
    data: { task_id: taskId },
    success: function(response) {

      // refresh task list
      fetchTasks();
    },
    error: function(xhr, status, error) {
      // handle error
      alert('Error deleting task');
    }
  });
};


// fetch tasks from the database
function fetchTasks() {
  $.ajax({
    url:  BaseUrl+'/home',
    method: 'POST',
    success: function(response) {
      // update task list
      let responseDoc = new DOMParser().parseFromString(response, "text/html");
      let tasks = responseDoc.querySelector('.show-tasks');
        document.querySelector('.show-tasks').innerHTML = tasks.innerHTML;
     
      
    },
    error: function(xhr, status, error) {
      // handle error
      alert('Error fetching tasks');
    }
  });
}

// fetch tasks on page load
$(document).ready(function() {
  fetchTasks();
});


  

