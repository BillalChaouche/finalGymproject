// get element of add coach
const add = document.getElementById('add');
const done = document.getElementById('done');
const exit = document.getElementById('exit');
const formAdd = document.querySelector('.form-add');
// Find the body element
const body = document.getElementsByTagName('body')[0];
// create a new div element
var div = document.createElement("div");


// blur the background
const side = document.querySelector('.side');
const above = document.querySelector('.above');
const table = document.querySelector(".coaches-table");



// blur function for tha background
function doBlur(){
    above.style.filter = "blur(10px)";
    table.style.filter = "blur(10px)";
    side.style.filter = "blur(10px)";
}
function removeBlur(){
    above.style.filter = "blur(0)";
    table.style.filter = "blur(0)";
    side.style.filter = "blur(0)";
}

// add form
add.addEventListener('click',function(){
    
    doBlur();
    formAdd.classList.remove('remove');
    formAdd.classList.add('show');
})
exit.addEventListener('click',function(){
    formAdd.classList.remove('show');
    formAdd.classList.add('remove');
    removeBlur();
})
done.addEventListener('click',function(){
    formAdd.classList.remove('show');
    formAdd.classList.add('remove');
    removeBlur();
})



// the Ajax code

// get the common URL

const BaseUrl = 'http://gymflex.online';

  // handle form submission
  
  $('.form-add').on('submit', function(event) {
    event.preventDefault(); // prevent form submission   
    // Get the form data
      
        nameAdd = $('#add-name').val();
        emailAdd = $('#add-email').val();
        numberAdd = $('#add-number').val();
        addressAdd = $('#add-address').val();
        statusAdd =  $('input[id="option"]:checked').val();
        priceAdd = $('#add-price').val();
      // Send the form data to the PHP file using AJAX
      
      $.ajax({
        type: 'POST',
        url: BaseUrl+'/src/coaches.inc.php',
        data:{
          name: nameAdd,
          email: emailAdd,
          number: numberAdd,
          address: addressAdd,
          status: statusAdd,
          price: priceAdd
        },
        success: function(response) {
          // Handle the response from the PHP file
          if (response) {
            div.innerHTML = "<div class='success'>the coach is added</div>";
            document.body.appendChild(div);
            fetchTasks();
          } else {
            div.innerHTML = "<div class='danger'>Something went wrong</div>";
            document.body.appendChild(div);
          }
        },
        error: function(xhr, status, error) {
          div.innerHTML = "<div class='danger'>Something went wrong</div>";
            document.body.appendChild(div);
        }
      });
    });

function fetchTasks() {
  $.ajax({
    url:  BaseUrl+'/view/coaches.php',
    method: 'POST',
    success: function(response) {
      // update task list
      let responseDoc = new DOMParser().parseFromString(response, "text/html");
      let coaches = responseDoc.querySelector('.show-coaches');
      document.querySelector('.show-coaches').innerHTML = coaches.innerHTML;
     
      
    },
    error: function(xhr, status, error) {
      // handle error
      div.innerHTML = "<div class='danger'>Something went wrong</div>";
      document.body.appendChild(div);
    }
  });
}

// fetch tasks on page load
$(document).ready(function() {
  fetchTasks();
});


// implement the logic of increment button of sesssion
function increment(id){
  id = id;
  // send a server request to increment the number of session of the coach's id = id
  $.ajax({
    url: BaseUrl+'/src/coaches.inc.php',
    type: 'POST',
    data: {id: id},
    success: function(response) {
      // Handle the response from the server
    },
    error: function(xhr) {
      div.innerHTML = "<div class='danger'>Something went wrong</div>";
      document.body.appendChild(div);
    }
  });
  // send a server request to refresh only the number of session of the coach's id = id
  $.ajax({
    url:  BaseUrl+'/view/coaches.php',
    method: 'POST',
    success: function(response) {
      // update task list
      let responseDoc = new DOMParser().parseFromString(response, "text/html");
      let incrementedNumber = responseDoc.getElementById(`${id}`);
      document.getElementById(`${id}`).innerHTML = incrementedNumber.innerHTML;
     
    }
    });

};
