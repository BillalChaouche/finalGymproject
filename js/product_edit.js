const BaseUrl = 'http://gymflex.online';



$(document).on('click', '.delete-btn', function () {
    var $tr = $(this).closest('tr');
    var id = $tr.attr('data-id');
    var confirmMsg = '<tr id="' + id + '-confirm" ><td colspan="6">Are you sure you want to delete this item?<br>' +
        '<button class="confirm-yes" style="opacity: 0.8; color: #FF585A; border: none; font-weight: bold; border-radius: 5px; cursor: pointer; box-shadow: 1px 1px 20px rgba(128, 128, 128, 0.144);transition: all 0.4s ease;">Yes <style>.confirm-yes:hover {background-color: #ff9e61b3;transform: scale(1.1);}</style></button>&nbsp&nbsp' +
        '<button class="confirm-no" style="opacity: 0.8; border: none; font-weight: bold; border-radius: 5px; cursor: pointer; box-shadow: 1px 1px 20px rgba(128, 128, 128, 0.144);transition: all 0.4s ease;">No <style>.confirm-no:hover {background-color: #ff9e61b3;transform: scale(1.1);}</style></button></td></tr>';

    $tr.replaceWith(confirmMsg);
    console.log("The product price is: " + id);


    $(document).on('click', '.confirm-yes', function () {

        // Send the AJAX request to delete the row from the database
        $.ajax({
            type: "POST",
            url: BaseUrl+"/deleteStock",
            data: { id_quant: id },
            success: function (response) {
                // Remove the confirmation message and the row from the table
                $('#' + id + '-confirm').remove();
                $tr.remove();
            },

            error: function (xhr, status, error) {
                // Display an error message if the AJAX request fails
                alert("An error occurred while deleting the row: " + error);
            }
        });


    });

    $(document).on('click', '.confirm-no', function () {
        $('#' + id + '-confirm').replaceWith($tr);
    });
});


// Get a reference to the "Edit" button
var idStock = null;


// Add a click event listener to the "Edit" button
$(document).on('click', '.edit-btn', function () {    // Prevent the default behavior of the button
    var row = $(this).closest('tr');
    var id = row.attr('data-id');
    idStock = id;

    var id_quant = row.find('.id-quant').text();
    var supplier = row.find('.supplier-quant').text();
    var price = row.find('.price-quant').text();
    var expire_date = row.find('.expire-quant').text();
    var quantity = row.find('.quantity-quant').text();

    // Populate the form fields with the row data
    $('#id_quant').val(id_quant);
    $('#supplier').val(supplier);
    $('#price').val(price);
    $('#expire-date').val(expire_date);
    $('#quantity').val(quantity);

    console.log("The product price is: " + idStock);

    // Show the edit form overlay
    const overlay = document.querySelector('#edit-form-overlay');
    overlay.style.display = 'block';
});

$('#cancelEDIT-form-submit').click(function () {
    $('#edit-form-overlay').hide();
});

$('#edit-form-content').submit(function (event) {
    event.preventDefault(); // prevent the form from submitting normally

    var formData = new FormData(this); // get the form data

    formData.append('id_quant', idStock);

    console.log(formData);


    $.ajax({
        url: BaseUrl+"/editStock",
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            location.reload();

        },
        error: function (xhr, status, error) {
            // handle the error response
            console.error(error);
            // you may want to show an error message here
        }
    });
});








// main.js

// Get the table body and add button
const tableBody = document.getElementById('stocks-table-body');
const addBtn = document.getElementById('add');
const addFormOverlay = document.getElementById('add-form-overlay');

// Add event
addBtn.addEventListener("click", function () {
    // Show the add form overlay
    addFormOverlay.style.display = 'block';
});

$('#cancel-form-submit').click(function () {
    $('#add-form-overlay').hide();
});





$('.delete-coach').hide();

// Show the delete confirmation message when delete button is clicked
$('#delete_btn').click(function (event) {
    event.preventDefault();
    $('.delete-coach').show();
});

// Hide the delete confirmation message when cancel button is clicked
$('#cancel').click(function () {
    $('.delete-coach').hide();
});

// Handle delete button confirmation
$('#delete_confirm').click(function () {
    const div = document.createElement('div');
    const idProd = $('#idProd').val();

    // Send the product id to the PHP file using AJAX
    $.ajax({
        type: 'POST',
        url: BaseUrl +'/deleteProduct',
        data: {
            id: idProd
        },
        success: function (response) {
            // Handle the response from the PHP file
            if (response) {
                window.location.href = BaseUrl +'/products'; // Redirect to the products page
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



$('.form-edit').on('submit', function (event) {
    const div = document.createElement('div');

    event.preventDefault(); // prevent form submission  
    // Get the form data

    nameAdd = $('#add-name').val();
    priceAdd = $('#add-price').val();
    idProd = $('#idProd').val();

    console.log("The product price is: " + priceAdd);
    console.log("The product price is: " + nameAdd);



    // Send the form data to the PHP file using AJAX

    $.ajax({
        type: 'POST',
        url: BaseUrl +'/productE',
        data: {
            name: nameAdd,
            price: priceAdd,
            id: idProd
        },
        success: function (response) {
            // Handle the response from the PHP file
            if (response) {
                window.location.href = BaseUrl + '/products';
                div.innerHTML = "<div class='success'>the product is edited</div>";
                document.body.appendChild(div);



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



$('#delete').on('click', function (event) {
    event.preventDefault();

    // Get the product ID
    idProd = $('#idProd').val();
    console.log("The product price is: " + idProd);

    // Send an AJAX request to delete the product
    $.ajax({
        type: 'POST',
        url: BaseUrl +'/deleteProduct',
        data: {
            id: idProd
        },
        success: function (response) {
            // Handle the response from the PHP file
            if (response) {
                // Redirect to the products page
                window.location.href = BaseUrl +'/products';
            } else {
                // Handle the error case
                alert('Error: product could not be deleted.');
            }
        },
        error: function (xhr, status, error) {
            // Handle the error case
            alert('Error: product could not be deleted.');
        }
    });
});



