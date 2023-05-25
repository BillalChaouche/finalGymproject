// the ui animartion part
const remove = document.getElementById('remove');
const cancel = document.getElementById('cancel');
const inputs = document.querySelector('.inputs');
const stats = document.querySelector('.stats');
const submitBtns = document.querySelector('.submit');
const confirmDelete = document.querySelector('.delete-coach');

 // Find the body element
const body = document.getElementsByTagName('body')[0];
// blur function for tha background
function doBlur(){
  inputs.style.filter = "blur(10px)";
  stats.style.filter = "blur(10px)";
  submitBtns.style.filter = "blur(10px)";
  
}
function removeBlur(){
  inputs.style.filter = "blur(0)";
  stats.style.filter = "blur(0)";
  submitBtns.style.filter = "blur(0)";
  
  
}

// show the delete confirmation div
remove.addEventListener('click',function(event){  
  event.preventDefault();
  doBlur();
  confirmDelete.classList.remove('remove-delete');
  confirmDelete.classList.add('show-delete');
  var start = Date.now();
  var duration = 100; // 0.5 seconds
  function animate() {
    var elapsed = Date.now() - start;
    var progress = Math.min(elapsed / duration, 1);
    confirmDelete.style.opacity = progress;
    if (progress < 1) {
      requestAnimationFrame(animate);
    }
  }
  animate();
});
cancel.addEventListener('click',function(event){
  event.preventDefault(); 
  
  confirmDelete.classList.remove('show-delete');
  confirmDelete.classList.add('remove-delete');
  removeBlur();
;
});


// Ajax part 
// get the number of session
let numSession = document.getElementById('number-of-session').textContent;

// create a new div element
var div = document.createElement("div");

// base Url 
const BaseUrl = 'http://localhost/GymFlex(v3)';

function increment(id){
   
    // Get the form data (id of the coach)
    idIn = id;
    numSession++;
    // send a server request to increment the number of session of the coach's id = id
    $.ajax({
      url: BaseUrl+'/editCoachInc',
      type: 'POST',
      data: {idIn},
      success: function(response) {
        // Handle the response from the server
        fetchNumSess(idIn);
      },
      error: function(xhr) {
        div.innerHTML = "<div class='danger'>Something went wrong</div>";
        document.body.appendChild(div);
      }
    });
    
  };
  function decrement(id){
    // Get the form data (id of the coach)
    // check the number of session to avoid negative value(we need to ad something here)
    if(numSession == 0){
        div.innerHTML = "<div class='danger'>The lowest value is 0</div>";
        document.body.appendChild(div);
        return;
    }
    // send a server request to decrement the number of session of the coach's id = id

    else{
    idDe = id;
    numSession--;
    // send a server request to increment the number of session of the coach's id = id
    $.ajax({
      url: BaseUrl+'/editCoachInc',
      type: 'POST',
      data: {idDe},
      success: function(response) {
        // Handle the response from the server
        fetchNumSess(idDe);

      },
      error: function(xhr) {
        div.innerHTML = "<div class='danger'>Something went wrong</div>";
        document.body.appendChild(div);
        

      }
    });
    
  }};
  function fetchNumSess(id){
    // send a server request to refresh only the number of session of the coach's id = id
    $.ajax({
      url:  BaseUrl+'/view/editCoach?id='+id,
      method: 'POST',
      success: function(response) {
        // update task list
        let responseDoc = new DOMParser().parseFromString(response, "text/html");
        let newNumber = responseDoc.getElementById('number-of-session');
        let newTotalFunds = responseDoc.getElementById('total-fund');
        if (newNumber) {
          document.getElementById('number-of-session').textContent = newNumber.textContent;
        }
        if (newNumber) {
            document.getElementById('total-fund').textContent = newTotalFunds.textContent;
          }

      },
      error: function(xhr) {
        console.log(xhr.statusText);
      }
    });
  }