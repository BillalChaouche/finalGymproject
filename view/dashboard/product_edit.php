

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/static/css/products_edit.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>Products</title>

</head>

<body>


    <section class="edit_div">
        <form class="form-edit" method="POST">
            <div class="prodimg">
                        <img src="<?php echo BASE_URL ?>/static/images/logo.png" alt="" id="product_img">
                        <h3><?php echo $_GET['prodname']; ?></h3>

            </div>
        <div class="inputs">
        <input type="hidden" id="idProd"  value=<?php echo $_GET['id_prod']; ?>>

            <div class="input-name">
                <p>Name:
                </p>
                <div class="req"></div>
                <p></p>
                <input type="text" placeholder="enter the product new name"  name="nameAdd" id="add-name" required value="<?php echo $_GET['prodname']; ?>">
            </div>

            <div class="input-price">
                <p>Product price:
                </p>
                <input type="number" placeholder="enter the new price" name="priceAdd" id="add-price" required value="<?php echo getProductPrice($_GET['id_prod'], $conn); ?>">
            </div>
        </div>
        <div class="choice">
            <div class="buttons">
                    <button id="delete_btn"  style="background-color: #FF585A;">
                        Delete
                    </button>
                    <button type="submit" style="  background-color: #FF9D61;">
                    &nbspSave&nbsp
                    </button>
            </div>
        
        </div>
        
        <div class="delete-coach">
    <p>Are you sure you want to delete this product from your gym?</p> <br>
    <div class="choose-btn">
      <button id="cancel" >Cancel</button>
      <button type="button" id="delete_confirm" style="color: red;">YES</button>
    </div>
  </div>
        </form>

    </section>



    

    <section class="coaches-table">
    <div class="header">
            <h1>Stocks for '<?php echo $_GET['prodname']; ?>'</h1>
            <button  id="add"> <i class="bi bi-plus"></i></button>
        </div>
        <table>
            <thead>
                <tr>
                    <th> Stock ID </th>
                    <th> Supplier </th>
                    <th> Price </th>
                    <th id="address"> Expire date </th>
                    <th> Quantity </th>
                    <th>Action</th>
                </tr>
            </thead>
            <?php
            displayStocks($_GET['id_prod'], $conn);
            ?>

        </table>
    </section>



    <!-- The overlay form -->
<div id="edit-form-overlay">
  <div id="edit-form">
    <h2>Edit stock</h2>
    <form id="edit-form-content" action="<?php echo BASE_URL ?>/src/addStock.php" method="post">
      
    <input type="hidden" name="id_prod"  value=<?php echo $_GET['id_prod']; ?>>
    <input type="hidden" name="prodname"  value=<?php echo $_GET['prodname']; ?>>


      <label for="supplier">Supplier:</label>
      <input type="text" id="supplier" name="supplier"><br>

      <label for="price">Price:</label>
      <input type="text" id="price" name="price"><br>

      <label for="expire-date">Expire date:</label>
      <input type="date" id="expire-date" name="expire_date"><br>

      <label for="quantity">Quantity:</label>
      <input type="number" id="quantity" name="quantity"><br><br>
      <div>      
        <button type="button" id="cancelEDIT-form-submit">Cancel</button>
        <button type="submit" id="edit-form-submit" style="  background-color: #FF9D61;">Save</button>
      </div>
      
    </form>
  </div>
</div>

    <!-- The overlay form -->
<div id="add-form-overlay">
  <div id="add-form">
    <h2>Add New Stock</h2>
    <form id="add-form-content" action="<?php echo BASE_URL ?>/addStock" method="POST">
      
    <input type="hidden" name="id_prod"  value=<?php echo $_GET['id_prod']; ?>>
    <input type="hidden" name="prodname"  value=<?php echo $_GET['prodname']; ?>>


      <label for="supplier">Supplier:</label>
      <input type="text" id="supplier" name="supplier"><br>

      <label for="price">Price:</label>
      <input type="text" id="price" name="price" value='<?php echo getProductPrice($_GET['id_prod'], $conn); ?>'><br>

      <label for="expire-date">Expire date:</label>
      <input type="date" id="expire-date" name="expire_date"><br>

      <label for="quantity">Quantity:</label>
      <input type="number" id="quantity" name="quantity"><br><br>
      <div>      
        <button type="button" id="cancel-form-submit">Cancel</button>
        <button type="submit" id="add-form-submit" style="  background-color: #FF9D61;" name="add-quant">Add</button>
      </div>
      
    </form>
  </div>
</div>


    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo BASE_URL ?>/js/product_edit.js"></script>
</body>

</html>
