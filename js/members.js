// get element of add coach
const add = document.getElementById('add');
const done = document.getElementById('done');
const exit = document.getElementById('exit');
const addMember = document.getElementById('add-member');
const doneMember = document.getElementById('done-member');
const exitMember = document.getElementById('exit-member');

const formAddOffer = document.querySelector('.form-add-offer');
const formAddMember = document.querySelector('.form-add-member');
// Find the body element
const body = document.getElementsByTagName('body')[0];
// create a new div element
var div = document.createElement("div");


// blur the background
const side = document.querySelector('.side');
const above = document.querySelector('.above');
const offers = document.querySelector(".offers");
const table = document.querySelector('.members-table'); 



// blur function for tha background
function doBlur(){
    above.style.filter = "blur(10px)";
    offers.style.filter = "blur(10px)";
    side.style.filter = "blur(10px)";
    table.style.filter = "blur(10px)";
}
function removeBlur(){
    above.style.filter = "blur(0)";
    offers.style.filter = "blur(0)";
    side.style.filter = "blur(0)";
    table.style.filter = "blur(0)";

}

// add form
add.addEventListener('click',function(){
  showAddForm(formAddOffer);
});
addMember.addEventListener('click',function(){
  showAddForm(formAddMember);
});
function showAddForm(form){
    
    doBlur();
    form.classList.remove('remove');
    form.classList.add('show');
}

exit.addEventListener('click',function(){

  formAddOffer.classList.remove('show');
  formAddOffer.classList.add('remove');
  formAddMember.classList.remove('show');
  formAddMember.classList.add('remove');
    removeBlur();
})
done.addEventListener('click',function(){
  hideAddForm(formAddOffer);
});
doneMember.addEventListener('click',function(){
  hideAddForm(formAddMember);
});
exit.addEventListener('click',function(){
  hideAddForm(formAddOffer);
});
exitMember.addEventListener('click',function(){
  hideAddForm(formAddMember);
});

function hideAddForm(form){
  form.classList.remove('show');
  form.classList.add('remove');
    removeBlur();
}


// this code when the user click on the offer title it shows him all availabe offers

isShown = false;   //initiale is hidden
const offerTitle = document.getElementById('offer-title');
offerTitle.addEventListener('click', function() {
  if(!isShown){
  offers.classList.remove('shrink');
  offers.classList.add('tall');
  isShown = true;
  }
  else{
    offers.classList.remove('tall');
    offers.classList.add('shrink');
    isShown = false;
  }
});

// the Ajax code

// get the common URL

const BaseUrl = 'http://localhost/GymFlex(v3)';

// handle form submission
  
$('.form-add-offer').on('submit', function(event) {
    event.preventDefault(); // prevent form submission   
    // get input values
    var nameOff = $("#add-name").val();
    var durationOff = $("#add-duration").val();
    var placesOff = $("#add-places").val();
    var sessionsOff = $("#add-session").val();
    var colorOff = $("input[name='color']:checked").val();
    var priceOff = $("#add-price").val();
      // Send the form data to the PHP file using AJAX
      
      $.ajax({
        type: 'POST',
        url: BaseUrl+'/offersInc',
        data:{
          name: nameOff,
          duration: durationOff,
          places: placesOff,
          sessions: sessionsOff,
          color: colorOff,
          price: priceOff
        },
        success: function(response) {
          // Handle the response from the PHP file
          if (response === 'done') {
            div.innerHTML = "<div class='success'>the offer is added</div>";
            document.body.appendChild(div);
            fetchOffers();
            // Clear the input values
            $("#add-name").val("");
            $("#add-duration").val("");
            $("#add-places").val("");
            $("#add-session").val("");
            $("input[name='color']").prop("checked", false);
            $("#add-price").val("");
          } 
          else if(response === 'error: Offer name already exists'){
            div.innerHTML = "<div class='danger'>Offer name already exists, try another one</div>";
            document.body.appendChild(div);
            // Clear the name input
            $("#add-name").val("");
          }
          else {
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
    //fetch offers form the server side
    function fetchOffers() {
      $.ajax({
        url:  BaseUrl+'/members',
        method: 'POST',
        success: function(response) {
          // update task list
          let responseDoc = new DOMParser().parseFromString(response, "text/html");
          let offers = responseDoc.querySelector('.body');
          document.querySelector('.body').innerHTML = offers.innerHTML;
         
          
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
      var selectEl = $('select');
      var divsToShow = $('.input-free, .input-price');
      
      // hide the divs by default
      divsToShow.hide();
      
      // check initial value of select element and show or hide the divs accordingly
      if (selectEl.val() === 'free') {
        divsToShow.fadeIn();
      } else {
        divsToShow.fadeOut();
      

      }
      
      selectEl.on('change', function() {
        if (selectEl.val() === 'free') {
          // show the divs with fadeIn animation
          divsToShow.fadeIn();
        } else {
          // hide the divs with fadeOut animation
          divsToShow.fadeOut();
        }
      });
    });
    // Ajax to add member
      $('.form-add-member').on('submit', function(event) {
        event.preventDefault(); // Prevent default form submit behavior
        
        // Get form data
          var name = $('#add-name-member').val();
          var email = $('#add-email-member').val();
          var offer= $('select').val();
          var selectedOfferId = $('select option:selected').data('id');
          var session = $('#add-session-member').val();
          var price = $('#add-price-member').val();
          
        // Send AJAX POST request
        $.ajax({
          type: 'POST',
          url: BaseUrl+'/membersInc',
          data:{
            name: name,
            email: email,
            offer: offer,
            offerId : selectedOfferId,
            session: session,
            price: price
          },
          success: function(response) {
            // Handle the response from the PHP file
            if (response.includes('done')) {
              div.innerHTML = "<div class='success'>the member is added</div>";
              document.body.appendChild(div);
              fetchMembers();
              // clear the inputs
              $('#add-name-member').val("");
              $('#add-email-member').val("");
              $('#add-birthday-member').val("");
              $('select').val("");
              $('#add-session-member').val("");
              $('#add-price-member').val("");

             
            }
            else if(response == 'error: Member email already exist'){
              div.innerHTML = "<div class='danger'>Member's email already exist</div>";
              document.body.appendChild(div);
              // clear email input
              $('#add-email-member').val("");


            }
            else {
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
      //fetch members form the server side
    function fetchMembers() {
      $.ajax({
        url:  BaseUrl+'/members',
        method: 'POST',
        success: function(response) {
          // update task list
          let responseDoc = new DOMParser().parseFromString(response, "text/html");
          let members = responseDoc.querySelector('.show-members');
          document.querySelector('.show-members').innerHTML = members.innerHTML;
         
          
        },
        error: function(xhr, status, error) {
          // handle error
          div.innerHTML = "<div class='danger'>Something went wrong</div>";
          document.body.appendChild(div);
        }
      });
    }
    function increment(id){
      id = id;
      // send a server request to increment the number of session of the coach's id = id
      $.ajax({
        url: BaseUrl+'/membersInc',
        type: 'POST',
        data: {id: id},
        success: function(response) {
          if (response === 'error: excced the limited number of sessions') {
            div.innerHTML = "<div class='danger'>error: excced the limited number of sessions</div>";
            document.body.appendChild(div);
        }},
        error: function(xhr) {
          div.innerHTML = "<div class='danger'>Something went wrong</div>";
          document.body.appendChild(div);
        }
      });
    // send a server request to refresh only the number of session of the member's id = id
    $.ajax({
    url:  BaseUrl+'/members',
    method: 'POST',
    success: function(response) {
      // update task list
      let responseDoc = new DOMParser().parseFromString(response, "text/html");
      let incrementedNumber = responseDoc.getElementById(`${id}`);
      document.getElementById(`${id}`).innerHTML = incrementedNumber.innerHTML;
     
    }
    });
      
    
    };


    // Get the input field and table body
const input = document.querySelector('.search-member input');
const tableBody = document.querySelector('.show-members');

// Add an event listener to the input field
input.addEventListener('input', () => {
  // Get the search query
  const query = input.value.toLowerCase();

  // Loop through each row in the table body
  for (const row of tableBody.rows) {
    // Get the code cell and its text content
    const codeCell = row.cells[0];
    const codeText = codeCell.textContent.toLowerCase();

    // If the code text matches the query, show the row; otherwise, hide it
    if (codeText.includes(query)) {
      row.style.display = '';
    } else {
      row.style.display = 'none';
    }
  }
});

confirmDelete = document.getElementById('delete-m');
function deleteMember(code){
  // show the delete confirmation div

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
  // Add event listener to the delete button
  document.getElementById('delete').addEventListener('click', function(event) {
    event.preventDefault();

    // Send the delete request with the code
    // You can use AJAX or any other method to send the request
    // Example using AJAX with jQuery:
    $.ajax({
      url: BaseUrl+'/membersInc',
      method: 'POST',
      data: { code: code },
      success: function(response) {

        fetchMembers();
      },
      error: function(xhr, status, error) {
        div.innerHTML = "<div class='danger'>Something went wrong</div>";
        document.body.appendChild(div);
      }
    });

    // Hide the delete confirmation div
    confirmDelete.classList.remove('show-delete');
    confirmDelete.classList.add('remove-delete');
    removeBlur();
  });
}

cancel.addEventListener('click',function(event){
  event.preventDefault(); 
  
  confirmDelete.classList.remove('show-delete');
  confirmDelete.classList.add('remove-delete');
  removeBlur();
;
});