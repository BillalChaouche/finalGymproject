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
const table = document.querySelector(".material-table");



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


/*
// the Ajax code

// get the common URL

const BaseUrl = 'http://localhost/GymFlex';

  // handle form submission
  
  $('.form-add').on('submit', function(event) {
    event.preventDefault(); // prevent form submission   
    // Get the form data
      
        idAdd = $('#add-id').val();
        brandAdd = $('#add-brand').val();
        dateAdd = $('#add-date').val();
        
      // Send the form data to the PHP file using AJAX
      
      $.ajax({
        type: 'POST',
        url: BaseUrl+'/src/material.inc.php',
        data:{
          id: idAdd,
          brand: brandAdd,
          date: dateAdd,
          
        },
        success: function(response) {
          // Handle the response from the PHP file
          if (response) {
            div.innerHTML = "<div class='success'>the material is added</div>";
            document.body.appendChild(div);
            fetchmaterial();
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

function fetchmaterial() {
  $.ajax({
    url:  BaseUrl+'/view/material.php',
    method: 'POST',
    success: function(response) {
      // update task list
      let responseDoc = new DOMParser().parseFromString(response, "text/html");
      let material = responseDoc.querySelector('.show-material');
      document.querySelector('.show-material').innerHTML = material.innerHTML;
     
      
    },
    error: function(xhr, status, error) {
      // handle error
      div.innerHTML = "<div class='danger'>Something went wrong</div>";
      document.body.appendChild(div);
    }
  });
}

// fetch tasks on page load



// implement the logic of increment button of quantity
*/
