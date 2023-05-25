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



// blur function for tha background
function doBlur() {
  above.style.filter = "blur(10px)";
  side.style.filter = "blur(10px)";
}
function removeBlur() {
  above.style.filter = "blur(0)";
  side.style.filter = "blur(0)";
}

// add form
add.addEventListener('click', function () {

  doBlur();
  formAdd.classList.remove('remove');
  formAdd.classList.add('show');
})
exit.addEventListener('click', function () {
  formAdd.classList.remove('show');
  formAdd.classList.add('remove');
  removeBlur();
})
done.addEventListener('click', function () {
  formAdd.classList.remove('show');
  formAdd.classList.add('remove');
  removeBlur();
})



// the Ajax code

// get the common URL

const BaseUrl = 'http://localhost/GymFlex(v3)';

// handle form submission

$('.form-add').on('submit', function (event) {
  const div = document.createElement('div');

  event.preventDefault(); // prevent form submission  
  // Get the form data

  nameAdd = $('#add-name').val();
  priceAdd = $('#add-price').val();

  



  // Send the form data to the PHP file using AJAX

  $.ajax({
    type: 'POST',
    url: BaseUrl +'/addProduct',
    data: {
      name: nameAdd,
      price: priceAdd
    },
    success: function (response) {
      // Handle the response from the PHP file
      if (response) {
        div.innerHTML = "<div class='success'>the product is added</div>";
        document.body.appendChild(div);
        $('.products').append(
          "<div id='product'>" +
          "<button class='more' onclick=\"location.href='/productEdit?id_prod="+ priceAdd+ "&prodname=" +nameAdd+ "'\"><i class='bi bi-arrow-right'></i></button>" +
          "<img src='http://localhost/GymFlex/static/images/logo.png' alt='' id='product_img'>" +
          "<h3>" +
          nameAdd + "</h3>" +


          "<h1> Qt. : 0 </h1>" +
          "</div>"
        );
      } else {
        div.innerHTML = "<div class='danger'>Something went wrong</div>";
        document.body.appendChild(div);
      }
    },
    error: function (xhr, status, error) {
      div.innerHTML = "<div class='danger'>Something went wrong</div>";
      document.body.appendChild(div);
    }
  });
});




/*
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

};*/
